<?php

namespace App\CPU;


use Illuminate\Support\Facades\Http;

class Tallymethod
{
  private static $url = null;

  public static function isSyncEnabled($authid)
  {
    $userId = $authid;
    $user = null;

    if (auth('seller')->check() && auth('seller')->id() == $userId) {
      $user = \App\Model\Seller::find($userId);
    } elseif (auth('admin')->check() && auth('admin')->id() == $userId) {
      $user = \App\Model\Admin::find($userId);
    } else {
      // Fallback
      $user = \App\Model\Seller::find($userId) ?: \App\Model\Admin::find($userId);
    }
    
    return $user ? (bool)$user->tally_sync : false;
  }

  private static function getCompany($authid)
  {
    $active = \Illuminate\Support\Facades\DB::table('tally_companies')
      ->where(['seller_id' => $authid, 'status' => 1])
      ->first();
    
    return $active ? $active->company_name : 'Deepak';
  }

  private static function getUrl()
  {
    if (self::$url === null) {
      self::$url = env('TALLY_URL', 'http://localhost:9000');
    }

    return self::$url;
  }

  private static function send($xml)
  {
  
    try {
      $response = Http::timeout(5)->withHeaders([
        'Content-Type' => 'text/xml',
      ])->withBody($xml, 'text/xml')
        ->post(self::getUrl());

      return $response->body();
    } catch (\Exception $e) {
      return '<RESPONSE><ERRORS>1</ERRORS><LINEERROR>Connection Error: ' . $e->getMessage() . '</LINEERROR></RESPONSE>';
    }
  }

  public static function isSuccess($responseXml)
  {
    if (empty($responseXml)) {
      return false;
    }
    // dd($responseXml);
    try {
      $created = 0;
      $altered = 0;
      $deleted = 0;
      $errors = 0;
      // Find counts even if wrapped in ENVELOPE/BODY/IMPORTDATA
      if (preg_match('/<CREATED>(\d+)<\/CREATED>/', $responseXml, $m1)) {
        $created = (int) $m1[1];
      }
      if (preg_match('/<ALTERED>(\d+)<\/ALTERED>/', $responseXml, $m2)) {
        $altered = (int) $m2[1];
      }
      if (preg_match('/<DELETED>(\d+)<\/DELETED>/', $responseXml, $m3)) {
        $deleted = (int) $m3[1];
      }
      if (preg_match('/<ERRORS>(\d+)<\/ERRORS>/', $responseXml, $m4)) {
        $errors = (int) $m4[1];
      }

      return ($created > 0 || $altered > 0 || $deleted > 0) && $errors === 0;
    } catch (\Exception $e) {
      return false;
    }
  }

  public static function parseError($responseXml)
  {
    if (empty($responseXml)) {
      return 'No response from Tally';
    }

    // Find LINEERROR
    if (preg_match('/<LINEERROR>(.*?)<\/LINEERROR>/s', $responseXml, $m)) {
      return $m[1];
    }

    // Check if ignored
    if (preg_match('/<IGNORED>(\d+)<\/IGNORED>/', $responseXml, $m) && (int) $m[1] > 0) {
      return 'Data Ignored by Tally (Nothing to update or item already exists)';
    }

    return 'Unknown Tally Error (Please check Tally logs)';
  }

  private static function envelope($body, $requestType = 'Import Data', $reportName = 'All Masters', $authid)
  {
    return "
        <ENVELOPE>
          <HEADER>
            <TALLYREQUEST>$requestType</TALLYREQUEST>
          </HEADER>
          <BODY>
            <IMPORTDATA>
              <REQUESTDESC>
                <REPORTNAME>$reportName</REPORTNAME>
                <STATICVARIABLES>
                  <SVCURRENTCOMPANY>" . self::getCompany($authid) . "</SVCURRENTCOMPANY>
                </STATICVARIABLES>
              </REQUESTDESC>
              <REQUESTDATA>
                <TALLYMESSAGE xmlns:UDF=\"TallyUDF\">
                    $body
                </TALLYMESSAGE>
              </REQUESTDATA>
            </IMPORTDATA>
          </BODY>
        </ENVELOPE>";
  }

  public static function createUnit($unit, $sellerId = 0)
  {
    $xml = self::envelope("
            <UNIT NAME=\"$unit\" ACTION=\"Create Or Alter\">
                <NAME>$unit</NAME>
                <ISSIMPLEUNIT>Yes</ISSIMPLEUNIT>
            </UNIT>
        ", 'Import Data', 'All Masters', $sellerId);

    return self::send($xml);
  }

  /* ================= STOCK GROUP ================= */

  public static function createGroup($group,$authid)
  {
    $group = htmlspecialchars($group, ENT_XML1, 'UTF-8');
    $xml = self::envelope("
            <STOCKGROUP NAME=\"$group\" ACTION=\"Create Or Alter\">
                <NAME>$group</NAME>
                <PARENT/>
                <ISADDABLE>Yes</ISADDABLE>
            </STOCKGROUP>
        ", 'Import Data', 'All Masters',$authid);
    // dump($xml);
    return self::send($xml);
  }

  /* ================= CREATE/ALTER ITEM ================= */

  public static function createOrAlterItem($name, $parent, $qty, $unit, $price,$authid)
  {
    $name = htmlspecialchars($name, ENT_XML1, 'UTF-8');
    $parent = htmlspecialchars($parent, ENT_XML1, 'UTF-8');
    $unit = htmlspecialchars($unit, ENT_XML1, 'UTF-8');
    $value = $qty * $price;
    $action = 'Create Or Alter';
    $xml = self::envelope(
      "
        <STOCKITEM NAME=\"$name\" ACTION=\"$action\">
            <NAME>$name</NAME>
            <PARENT>$parent</PARENT>
            <BASEUNITS>$unit</BASEUNITS>
            <OPENINGBALANCE>$qty $unit</OPENINGBALANCE>
            <OPENINGVALUE>-$value</OPENINGVALUE>
            <STANDARDPRICELIST.LIST>
                <DATE>20240401</DATE>
                <RATE>$price/$unit</RATE>
            </STANDARDPRICELIST.LIST>
        </STOCKITEM>
    ", 'Import Data', 'All Masters',$authid 
    );

    return self::send($xml);
  }

  /* ================= DELETE ITEM ================= */

  public static function deleteItem($name,$authid)
  {
    $name = htmlspecialchars($name, ENT_XML1, 'UTF-8');

    $xml = self::envelope("
            <STOCKITEM NAME=\"$name\" ACTION=\"Delete\">
                <NAME>$name</NAME>
            </STOCKITEM>
        ", 'Import Data', 'All Masters',$authid);

    return self::send($xml);
  }

  /* ================= STOCK JOURNAL (QTY UPDATE) ================= */

  public static function updateOpeningStock($name, $parent, $qty, $unit, $price,$authid)
  {
    $name = htmlspecialchars($name, ENT_XML1, 'UTF-8');
    $parent = htmlspecialchars($parent, ENT_XML1, 'UTF-8');
    $unit = htmlspecialchars($unit, ENT_XML1, 'UTF-8');
    $value = $qty * $price;

    $body = "
    <STOCKITEM NAME=\"$name\" ACTION=\"Alter\">
        <NAME>$name</NAME>
        <PARENT>$parent</PARENT>
        <BASEUNITS>$unit</BASEUNITS>
        <OPENINGBALANCE>$qty $unit</OPENINGBALANCE>
        <OPENINGVALUE>-$value</OPENINGVALUE>
    </STOCKITEM>
    ";

    return self::send(self::envelope($body, 'Import Data', 'All Masters',$authid));
  }
  /* ================= SYNC ================= */

  public static function exportStockSummary($authid)
  {
    $xml = "
        <ENVELOPE>
            <HEADER>
                <VERSION>1</VERSION>
                <TALLYREQUEST>Export</TALLYREQUEST>
                <TYPE>Data</TYPE>
                <ID>Stock Summary</ID>
            </HEADER>
            <BODY>
                <DESC>
                    <STATICVARIABLES>
                        <SVEXPORTFORMAT>\$\$SysName:XML</SVEXPORTFORMAT>
                        <EXPLODEFLAG>Yes</EXPLODEFLAG>
                        <SVCURRENTCOMPANY>" . self::getCompany($authid) . "</SVCURRENTCOMPANY>
                    </STATICVARIABLES>
                </DESC>
            </BODY>
        </ENVELOPE>";

    return self::send($xml,$authid);
  }

  public static function checkTallyStatus()
  {
    $xml = '
            <ENVELOPE>
                <HEADER>
                    <TALLYREQUEST>Export</TALLYREQUEST>
                    <TYPE>Data</TYPE>
                    <ID>List of Companies</ID>
                </HEADER>
            </ENVELOPE>';

    try {
      $response = \Illuminate\Support\Facades\Http::timeout(2)
        ->withHeaders(['Content-Type' => 'text/xml'])
        ->withBody($xml, 'text/xml')
        ->post(self::getUrl()); 

      return $response->successful();
    } catch (\Exception $e) {
      return false;
    }
  }

  /* ================= GET ALL COMPANIES ================= */

  /**
   * Fetch all companies currently loaded/open in Tally.
   *
   * @return array  e.g. ['CompanyA', 'CompanyB'] on success, or empty array on failure.
   */
  public static function getAllCompanies(): array
  {
    // Using Collection-based approach for better compatibility with Tally Prime/ERP 9
$xml = '<ENVELOPE>
    <HEADER>
        <VERSION>1</VERSION>
        <TALLYREQUEST>Export</TALLYREQUEST>
        <TYPE>Collection</TYPE>
        <ID>Company</ID>
    </HEADER>
    <BODY>
        <DESC>
            <STATICVARIABLES>
                <SVEXPORTFORMAT>$$SysName:XML</SVEXPORTFORMAT>
            </STATICVARIABLES>
            <TDL>
                <TDLMESSAGE>
                    <COLLECTION NAME="Company">
                        <TYPE>Company</TYPE>
                        <FETCH>Name</FETCH>
                    </COLLECTION>
                </TDLMESSAGE>
            </TDL>
        </DESC>
    </BODY>
</ENVELOPE>';

    try {
      $response = \Illuminate\Support\Facades\Http::timeout(10)
        ->withHeaders(['Content-Type' => 'text/xml'])
        ->withBody($xml, 'text/xml')
        ->post(self::getUrl());

      $body = $response->body();
      // dd($body);
      if (empty(trim($body)) || strpos($body, 'Unknown Request') !== false || strpos($body, 'LINEERROR') !== false) {
        return [];
      }

      // Parse XML and extract company names
      libxml_use_internal_errors(true);

      // Try to find ENVELOPE wrapper
      if (preg_match('/<ENVELOPE>.*?<\/ENVELOPE>/s', $body, $matches)) {
        $xmlString = $matches[0];
      } else {
        $xmlString = $body;
      }

      $xmlObj = simplexml_load_string($xmlString);
      if (!$xmlObj) {
        return [];
      }

      $companies = [];

      // Tally "List of Companies" response has <COMPANY NAME="..."> or <COMPANY><NAME>...</NAME></COMPANY>
      foreach ($xmlObj->xpath('//COMPANY') as $company) {
        // Try NAME attribute first (Tally Prime style)
        $nameAttr = (string) $company->attributes()['NAME'];
        if ($nameAttr !== '') {
          $companies[] = $nameAttr;
          continue;
        }
        // Try NAME child element
        $nameEl = (string) ($company->NAME ?? '');
        if ($nameEl !== '') {
          $companies[] = $nameEl;
          continue;
        }
        // Try BASICCOMPANYNAME
        $basicName = (string) ($company->BASICCOMPANYNAME ?? '');
        if ($basicName !== '') {
          $companies[] = $basicName;
        }
      }

      // Fallback: try COMPANYINFO nodes
      if (empty($companies)) {
        foreach ($xmlObj->xpath('//COMPANYINFO') as $info) {
          $name = (string) ($info->NAME ?? '');
          if ($name !== '') {
            $companies[] = $name;
          }
        }
      }

      // Last fallback: find any NAME not inside STOCKITEM/UNIT etc
      if (empty($companies)) {
        foreach ($xmlObj->xpath('//TALLYMESSAGE/COMPANY') as $co) {
          $name = trim((string) $co);
          if ($name !== '') {
            $companies[] = $name;
          }
        }
      }

      return array_values(array_unique($companies));

    } catch (\Exception $e) {
      return [];
    }
  }
}
