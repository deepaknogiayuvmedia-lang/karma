<?php

namespace App\CPU;


use Illuminate\Support\Facades\Http;

class Tallymethod
{
  private static $url = null;

  private static $company = 'Deepak';

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

  private static function envelope($body, $requestType = 'Import Data', $reportName = 'All Masters')
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
                  <SVCURRENTCOMPANY>" . self::$company . "</SVCURRENTCOMPANY>
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

  public static function createUnit($unit)
  {
    $xml = self::envelope("
            <UNIT NAME=\"$unit\" ACTION=\"Create Or Alter\">
                <NAME>$unit</NAME>
                <ISSIMPLEUNIT>Yes</ISSIMPLEUNIT>
            </UNIT>
        ");

    return self::send($xml);
  }

  /* ================= STOCK GROUP ================= */

  public static function createGroup($group)
  {
    $group = htmlspecialchars($group, ENT_XML1, 'UTF-8');
    $xml = self::envelope("
            <STOCKGROUP NAME=\"$group\" ACTION=\"Create Or Alter\">
                <NAME>$group</NAME>
                <PARENT/>
                <ISADDABLE>Yes</ISADDABLE>
            </STOCKGROUP>
        ");
    // dump($xml);
    return self::send($xml);
  }

  /* ================= CREATE/ALTER ITEM ================= */

  public static function createOrAlterItem($name, $parent, $qty, $unit, $price)
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
    "
    );

    return self::send($xml);
  }

  /* ================= DELETE ITEM ================= */

  public static function deleteItem($name)
  {
    $name = htmlspecialchars($name, ENT_XML1, 'UTF-8');

    $xml = self::envelope("
            <STOCKITEM NAME=\"$name\" ACTION=\"Delete\">
                <NAME>$name</NAME>
            </STOCKITEM>
        ");

    return self::send($xml);
  }

  /* ================= STOCK JOURNAL (QTY UPDATE) ================= */

  public static function updateOpeningStock($name, $parent, $qty, $unit, $price)
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

    return self::send(self::envelope($body));
  }
  /* ================= SYNC ================= */

  public static function exportStockSummary()
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
                        <SVCURRENTCOMPANY>" . self::$company . "</SVCURRENTCOMPANY>
                    </STATICVARIABLES>
                </DESC>
            </BODY>
        </ENVELOPE>";

    return self::send($xml);
  }

  public static function  ($name)
  {
    $xml = '
    <ENVELOPE>
     <HEADER>
      <TALLYREQUEST>Export Data</TALLYREQUEST>
     </HEADER>
     <BODY>
      <EXPORTDATA>
       <REQUESTDESC>
        <REPORTNAME>Stock Item</REPORTNAME>
        <STATICVARIABLES>
          <SVEXPORTFORMAT>$$SysName:XML</SVEXPORTFORMAT>
          <SVSTOCKITEM>' . $name . '</SVSTOCKITEM>
        </STATICVARIABLES>
       </REQUESTDESC>
      </EXPORTDATA>
     </BODY>
    </ENVELOPE>';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:9000");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
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
}
