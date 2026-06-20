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
      linear-gradient(rgba(38, 53, 15, 0.88), rgba(38, 53, 15, 0.88)),
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
      max-width:750px;
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
      color:#f1f1f1;
      margin-bottom:10px;
    }

    /* FOOTER */

    footer{
      background:var(--secondary-color);
      color:#d8d8d8;
      text-align:center;
      padding:25px 15px;
    }

    footer p{
      font-size:14px;
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

      <h1 class="text-white">Shipping Policy</h1>

    

    </div>
  </section>

  <!-- POLICY CONTENT -->

  <section class="policy-section">
    <div class="container">

      <div class="policy-box">

        <h2>1. Shipping Coverage</h2>

        <p>
          PRO KISSAN provides shipping and delivery services across selected cities, towns, and rural areas through trusted logistics partners and local vendors.
        </p>

  
        <h2>2. Order Processing Time</h2>

        <ul>
          <li>Orders are generally processed within 24–48 hours.</li>
          <li>Fresh farm produce may be processed faster for same-day or next-day delivery.</li>
          <li>Bulk and wholesale orders may require additional processing time.</li>
        </ul>

        <h2>3. Estimated Delivery Time</h2>

        <p>
          Delivery timelines depend on product type, vendor location, and customer delivery address.
        </p>

        <ul>
          <li>The product will be delivered in 5-7 business days</li>
        </ul>

        <h2>4. Shipping Charges</h2>

        <p>
          Shipping charges may vary depending on order value, product weight, vendor location, and delivery destination.
        </p>

        <p>
          Free shipping offers may be available on selected products or minimum order values.
        </p>

        <h2>5. Fresh & Perishable Products</h2>

        <p>
          Fresh fruits, vegetables, dairy products, and other perishable goods are packed carefully to maintain quality during transportation.
        </p>

        <p>
          Customers are advised to inspect perishable items immediately upon delivery.
        </p>

        <h2>6. Delivery Delays</h2>

        <p>
          Delivery may be delayed due to weather conditions, transport issues, festivals, natural disasters, or unforeseen circumstances.
        </p>

        <p>
          PRO KISSAN will make reasonable efforts to keep customers informed about major delays.
        </p>

        <h2>7. Failed Delivery Attempts</h2>

        <ul>
          <li>Customers must provide accurate delivery details and contact information.</li>
          <li>If delivery fails due to incorrect address or unavailability, re-delivery charges may apply.</li>
          <li>Repeated failed attempts may result in order cancellation.</li>
        </ul>

        <h2>8. Damaged Packages</h2>

        <p>
          If your package arrives damaged or tampered with, please contact our support team immediately with photos and order details.
        </p>

        <h2>9. Contact Support</h2>

        <p>
          For shipping-related questions, tracking assistance, or delivery issues, feel free to contact us.
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
