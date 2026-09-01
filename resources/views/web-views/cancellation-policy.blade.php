@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('cancellation_policy'))

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
    <div class="  rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
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
         background: linear-gradient(rgb(0 105 92 / 58%), rgb(15 99 82 / 83%)),
      url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=1400&auto=format&fit=crop');

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

    /* POLICY */

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

    /* CONTACT */

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
      color:#f1f1f1;
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
</head>
<body>

  <!-- HERO -->

  <section class="hero">
    <div class="container">

      <h1 class="text-white">Cancellation Policy</h1>

      <p>
        PRO KISSAN values customer satisfaction and provides a transparent cancellation policy for all farming and agricultural product orders.
      </p>

    </div>
  </section>

  <!-- POLICY CONTENT -->

  <section class="policy-section">
    <div class="container">

      <div class="policy-box">

        <h2>1. Order Cancellation</h2>

        <p>
          Customers can cancel their orders before the products are shipped or dispatched by the vendor.
        </p>

        <div class="highlight">
          <p>
            Once an order has been shipped, cancellation requests may not be accepted.
          </p>
        </div>

        <h2>2. Cancellation Eligibility</h2>

        <ul>
          <li>Orders not yet processed by the vendor.</li>
          <li>Orders awaiting shipment confirmation.</li>
          <li>Duplicate or mistakenly placed orders.</li>
          <li>Products unavailable due to stock issues.</li>
        </ul>

        <h2>3. Non-Cancellable Orders</h2>

        <ul>
          <li>Orders already shipped or out for delivery.</li>
          <li>Customized or special farming equipment orders.</li>
          <li>Perishable agricultural products already packed for delivery.</li>
          <li>Bulk or wholesale orders processed by vendors.</li>
        </ul>

        <h2>4. Vendor Cancellation</h2>

        <p>
          Vendors may cancel orders due to product unavailability, pricing errors, delivery limitations, or unforeseen circumstances.
        </p>

        <p>
          In such cases, customers will receive a full refund to their original payment method or wallet balance.
        </p>

        <h2>5. Refund for Cancelled Orders</h2>

        <p>
          Refunds for successfully cancelled orders are generally processed within 5–7 business days depending on the payment provider or banking system.
        </p>

        <h2>6. How to Cancel an Order</h2>

        <p>
          Customers can cancel eligible orders directly from their account dashboard or by contacting PRO KISSAN customer support.
        </p>

        <ul>
          <li>Login to your account.</li>
          <li>Go to "My Orders".</li>
          <li>Select the order you want to cancel.</li>
          <li>Click on the "Cancel Order" button.</li>
        </ul>

        <h2>7. Important Note</h2>

        <p>
          PRO KISSAN reserves the right to refuse cancellation requests if misuse, repeated cancellations, or fraudulent activities are detected.
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
