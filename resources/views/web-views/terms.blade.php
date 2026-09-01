@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Terms & Conditions'))

@push('css_or_js')
    <meta property="og:image" content="{{asset(env('PUBLIC_STORAGE_PATH').'company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Terms & conditions of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(env('PUBLIC_STORAGE_PATH').'company')}}/{{$web_config['web_logo']->value}}"/>
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
     background: linear-gradient(rgb(0 105 92 / 58%), rgb(15 99 82 / 83%)),
      url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1400&auto=format&fit=crop');

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

    /* TERMS SECTION */

    .terms-section{
      padding:80px 0;
    }

    .terms-box{
      background:var(--white);
      padding:50px;
      border-radius:22px;
      box-shadow:0 10px 30px rgba(0,0,0,0.06);
    }

    .terms-box h2{
      color:var(--primary-color);
      margin-top:35px;
      margin-bottom:15px;
      font-size:28px;
    }

    .terms-box h2:first-child{
      margin-top:0;
    }

    .terms-box p{
      color:var(--text-gray);
      margin-bottom:18px;
      font-size:15px;
    }

    .terms-box ul{
      padding-left:20px;
      margin-bottom:20px;
    }

    .terms-box ul li{
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

      .terms-box{
        padding:30px 20px;
      }

      .terms-box h2{
        font-size:24px;
      }

    }

  </style>
</head>
<body>

  <!-- HERO -->

  <section class="hero">
    <div class="container">

      <h1>Terms & Conditions</h1>

      <p>
        Welcome to PRO KISSAN. By accessing or using our platform, you agree to comply with the following terms and conditions.
      </p>

    </div>
  </section>

  <!-- TERMS CONTENT -->

  <section class="terms-section">
    <div class="container">

      <div class="terms-box">

        <h2>1. Introduction</h2>

        <p>
          PRO KISSAN is a multi-vendor farming marketplace that connects farmers, vendors, and customers for agricultural products and services.
        </p>

        <p>
          These Terms & Conditions govern your access to and use of our website, mobile application, and related services.
        </p>

        <div class="highlight">
          <p>
            By using PRO KISSAN, you agree to follow all platform policies, rules, and applicable laws.
          </p>
        </div>

        <h2>2. User Accounts</h2>

        <ul>
          <li>Users must provide accurate registration details.</li>
          <li>You are responsible for maintaining account confidentiality.</li>
          <li>Unauthorized use of accounts is strictly prohibited.</li>
          <li>PRO KISSAN reserves the right to suspend accounts violating policies.</li>
        </ul>

        <h2>3. Vendor Responsibilities</h2>

        <ul>
          <li>Vendors must provide genuine and high-quality products.</li>
          <li>Product descriptions and pricing must be accurate.</li>
          <li>Vendors are responsible for packaging and timely delivery.</li>
          <li>Sale of prohibited or illegal products is not allowed.</li>
        </ul>

        <h2>4. Orders & Payments</h2>

        <p>
          Customers agree to pay all applicable charges for products purchased through the platform.
        </p>

        <p>
          Payment transactions are processed through secure third-party payment gateways.
        </p>

        <h2>5. Shipping & Delivery</h2>

        <p>
          Delivery timelines may vary depending on vendor location, product availability, and logistics conditions.
        </p>

        <p>
          PRO KISSAN is not liable for delays caused by natural disasters, transport issues, or unforeseen events.
        </p>

        <h2>6. Returns & Refunds</h2>

        <p>
          Refunds, returns, and cancellations are subject to our separate Refund Policy, Return Policy, and Cancellation Policy pages.
        </p>

        <h2>7. Prohibited Activities</h2>

        <ul>
          <li>Fraudulent orders or fake transactions.</li>
          <li>Uploading false, harmful, or misleading information.</li>
          <li>Attempting unauthorized access to the platform.</li>
          <li>Violation of applicable laws or regulations.</li>
        </ul>

        <h2>8. Intellectual Property</h2>

        <p>
          All content, branding, logos, images, and platform materials are the property of PRO KISSAN and may not be copied or reused without permission.
        </p>

        <h2>9. Limitation of Liability</h2>

        <p>
          PRO KISSAN shall not be held responsible for indirect losses, damages, or issues arising from vendor products, delivery delays, or misuse of the platform.
        </p>

        <h2>10. Changes to Terms</h2>

        <p>
          We reserve the right to update or modify these Terms & Conditions at any time without prior notice.
        </p>

        <h2>11. Contact Information</h2>

        <p>
          If you have any questions regarding these Terms & Conditions, feel free to contact us.
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
