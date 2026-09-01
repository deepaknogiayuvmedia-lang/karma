@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('return_policy'))

@push('css_or_js')
    <meta property="og:image" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Terms & conditions of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Terms & conditions of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

@endpush

@section('content')
    <div class=" rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">

  <style>

    :root{
      --primary-color:#00695C;
      --secondary-color:#26350F;
      --light-green:#6B8E23;
      --accent-color:#E67E22;
      --yellow-color:#F4B53F;
      --bg-light:#F8F6EF;
      --white:#ffffff;
      --text-dark:#1E1E1E;
      --text-gray:#666666;
    }

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    body{
      font-family:'Poppins',sans-serif;
      background:var(--bg-light);
      color:var(--text-dark);
      line-height:1.7;
    }


    a{
      text-decoration:none;
    }

    /* HERO */

    .hero{
      background:
      linear-gradient(rgba(38,53,15,0.88),rgba(38,53,15,0.88)),
      url('https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=1400&auto=format&fit=crop');

      background-size:cover;
      background-position:center;
      padding:120px 20px;
      text-align:center;
      color:var(--white);
    }

    .hero h1{
      font-size:55px;
      margin-bottom:15px;
    }

    .hero p{
      max-width:700px;
      margin:auto;
      font-size:17px;
      opacity:0.95;
    }

    /* POLICY SECTION */

    .policy-section{
      padding:80px 0;
    }

    .policy-box{
      background:var(--white);
      padding:50px;
      border-radius:22px;
      box-shadow:0 10px 30px rgba(0,0,0,0.06);
    }

    .policy-box h2{
      color:var(--primary-color);
      margin-top:35px;
      margin-bottom:15px;
      font-size:28px;
    }

    .policy-box h2:first-child{
      margin-top:0;
    }

    .policy-box p{
      color:var(--text-gray);
      margin-bottom:18px;
      font-size:15px;
    }

    .policy-box ul{
      padding-left:20px;
      margin-bottom:20px;
    }

    .policy-box ul li{
      margin-bottom:12px;
      color:var(--text-gray);
    }

    .highlight{
      background:rgba(230,126,34,0.1);
      border-left:5px solid var(--accent-color);
      padding:20px;
      border-radius:12px;
      margin:25px 0;
    }

    .highlight p{
      margin:0;
      color:var(--text-dark);
      font-weight:500;
    }

    /* CONTACT BOX */

    .contact-box{
      margin-top:40px;
      background:var(--primary-color);
      color:var(--white);
      padding:35px;
      border-radius:20px;
    }

    .contact-box h3{
      font-size:28px;
      margin-bottom:15px;
    }

    .contact-box p{
      color:#f2f2f2;
      margin-bottom:10px;
    }

    /* FOOTER */
.page-footer.font-small.mdb-color.rtl{
    margin-top: 0;
    padding-top: 0;
}
    /* RESPONSIVE */

    @media(max-width:768px){

      .hero h1{
        font-size:38px;
      }

      .policy-box{
        padding:30px 20px;
      }

      .policy-box h2{
        font-size:24px;
      }

    }

  </style>


  <!-- HERO -->

  <section class="hero">
    <div class="container">

      <h1 class="text-white">Return Policy</h1>

      <p>
        PRO KISSAN is committed to delivering high-quality agricultural and farming products. Please read our return policy carefully before placing an order.
      </p>

    </div>
  </section>

  <!-- POLICY CONTENT -->

  <section class="policy-section">
    <div class="container">

      <div class="policy-box">

        <h2>1. Return Eligibility</h2>

        <p>
          Customers may request a return for eligible products if the item received is damaged, defective, incorrect, or expired.
        </p>

    

        <h2>2. Items Eligible for Return</h2>

        <ul>
          <li>Damaged agricultural products during delivery.</li>
          <li>Defective farming equipment or tools.</li>
          <li>Wrong products delivered.</li>
          <li>Expired seeds, fertilizers, or organic items.</li>
          <li>Missing items from the order package.</li>
        </ul>

        <h2>3. Non-Returnable Products</h2>

        <ul>
          <li>Used or partially consumed products.</li>
          <li>Products damaged after delivery by the customer.</li>
          <li>Items without original packaging.</li>
          <li>Special discounted or clearance sale products.</li>
          <li>Returns requested after the allowed timeframe.</li>
        </ul>

        <h2>4. Return Process</h2>

        <p>
          To initiate a return, customers must contact our support team with order details, product images, and the reason for return.
        </p>

        <p>
            Customers can return the product within 7 days after receiving the product.
        </p>

        <h2>5. Return Shipping</h2>

        <p>
          If the return is due to vendor error, damaged goods, or incorrect products, return shipping charges will be covered by PRO KISSAN or the vendor.
        </p>

        <p>
          Customers may need to bear shipping charges for returns not caused by product defects or vendor issues.
        </p>

        <h2>6. Refund After Return</h2>

        <p>
          Once the returned item is received and inspected, refunds will be processed within 5–7 business days to the original payment method or wallet balance.
        </p>

        <h2>7. Vendor Responsibility</h2>

        <p>
          Vendors are responsible for maintaining accurate product information, proper packaging, and delivering quality farming products.
        </p>

        <!-- CONTACT -->

        <div class="contact-box">

          <h3 class="text-white">Contact Support</h3>
             <p><strong>Company Name:</strong> CROP SHOP INDIA PRIVATE LIMITED</p>
          <p><strong>Email:</strong>  cropshopind@gmail.com</p>

          <p><strong>Phone:</strong> 6283444803</p>

          <p><strong>Working Hours:</strong> Monday - Saturday | 9:00 AM - 6:00 PM</p>

        </div>

      </div>

    </div>
  </section>


    </div>
@endsection
