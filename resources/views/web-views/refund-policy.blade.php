@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('refund_policy'))

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
      background: linear-gradient(rgb(0 105 92 / 58%), rgb(15 99 82 / 83%)), url(https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1400&auto=format&fit=crop);

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
      opacity:0.95;
      font-size:17px;
    }

    /* POLICY SECTION */

    .policy-section{
      padding:80px 0;
    }

    .policy-box{
      background:var(--white);
      padding:50px;
      border-radius:20px;
      box-shadow:0 10px 30px rgba(0,0,0,0.06);
    }

    .policy-box h2{
      color:var(--primary-color);
      margin-bottom:15px;
      margin-top:35px;
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
      border-radius:10px;
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
      margin-bottom:15px;
      font-size:28px;
    }

    .contact-box p{
      color:#f1f1f1;
      margin-bottom:10px;
    }

    /* FOOTER */

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
      <h1 class="text-white">Refund Policy</h1>

      <p>
        At PRO KISSAN, customer satisfaction is our priority. Please read our refund and return policy carefully before making any purchase on our platform.
      </p>
    </div>
  </section>

  <!-- POLICY CONTENT -->

  <section class="policy-section">
    <div class="container">

      <div class="policy-box">

        <h2>1. Overview</h2>

        <p>
          PRO KISSAN is a multi-vendor farming marketplace connecting customers with farmers and agricultural product sellers. We strive to ensure that all products delivered are fresh, authentic, and of high quality.
        </p>

        <p>
          If you are not satisfied with your order, you may request a refund or replacement according to the terms below.
        </p>

        <div class="highlight">
          <p>
            Refund requests must be submitted within 24 hours of product delivery.
          </p>
        </div>

        <h2>2. Eligible Refund Cases</h2>

        <ul>
          <li>Damaged or defective products received.</li>
          <li>Expired or spoiled agricultural products.</li>
          <li>Wrong item delivered.</li>
          <li>Missing products in the order.</li>
          <li>Order canceled by vendor or delivery partner.</li>
        </ul>

        <h2>3. Non-Refundable Items</h2>

        <ul>
          <li>Products damaged after delivery due to customer handling.</li>
          <li>Refund requests submitted after the allowed timeframe.</li>
          <li>Items purchased during special clearance or discount sales.</li>
          <li>Partially consumed or used products.</li>
        </ul>

        <h2>4. Refund Process</h2>

        <p>
          Once your refund request is received, our support team will review the issue and may ask for product images or additional details.
        </p>

        <p>
          Approved refunds are processed within 5–7 business days and credited back to the original payment method or wallet balance.
        </p>

        <h2>5. Order Cancellation</h2>

        <p>
          Orders can only be canceled before they are shipped by the vendor. Once dispatched, cancellation requests may not be accepted.
        </p>

        <h2>6. Vendor Responsibility</h2>

        <p>
          Vendors on PRO KISSAN are responsible for maintaining product quality, packaging standards, and accurate product descriptions.
        </p>

        <h2>7. Contact Support</h2>

        <p>
          If you face any issue related to refunds, returns, or damaged products, feel free to contact our support team.
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
