@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Privacy policy'))

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
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }
    :root{
      --primary:#00695C;
      --secondary:#26350F;
      --accent:#E67E22;
      --yellow:#F4B53F;
      --bg:#F8F6EF;
      --white:#ffffff;
      --text:#1f1f1f;
      --gray:#666666;
    }
    body{
      font-family:'Poppins',sans-serif;
      background:var(--bg);
      color:var(--text);
      line-height:1.8;
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
      font-size:60px;
      margin-bottom:15px;
    }
    .hero p{
      max-width:750px;
      margin:auto;
      font-size:18px;
      opacity:0.95;
    }
    /* CONTENT */
    .policy-section{
      padding:80px 0;
    }
    .policy-wrapper{
      background:var(--white);
      padding:60px;
      border-radius:24px;
      box-shadow:0 10px 30px rgba(0,0,0,0.06);
    }
    .policy-wrapper h2{
      color:var(--primary);
      margin-bottom:18px;
      margin-top:40px;
      font-size:30px;
    }
    .policy-wrapper h2:first-child{
      margin-top:0;
    }
    .policy-wrapper p{
      color:var(--gray);
      margin-bottom:18px;
      font-size:16px;
    }
    .policy-wrapper ul{
      margin-bottom:20px;
      padding-left:20px;
    }

    .policy-wrapper ul li{
      margin-bottom:12px;
      color:var(--gray);
    }

    .highlight{
      background:rgba(230,126,34,0.08);
      border-left:5px solid var(--accent);
      padding:20px;
      border-radius:12px;
      margin:25px 0;
    }

    .highlight p{
      margin:0;
      color:var(--text);
      font-weight:500;
    }

    /* CONTACT */

    .contact-box{
      margin-top:50px;
      padding:30px;
      background:rgba(61,79,23,0.05);
      border-radius:18px;
    }

    .contact-box h3{
      color:var(--primary);
      margin-bottom:10px;
    }

    .contact-box p{
      margin-bottom:8px;
    }

    /* FOOTER */
.page-footer.font-small.mdb-color.rtl{
    margin-top: 0;
    padding-top: 0;
}
    /* RESPONSIVE */

    @media(max-width:768px){

      .hero h1{
        font-size:40px;
      }

      .policy-wrapper{
        padding:35px 25px;
      }

      .policy-wrapper h2{
        font-size:24px;
      }

    }

  </style>


  <!-- HERO -->

  <section class="hero">
    <div class="container">
      <h1 class="text-white">Privacy Policy</h1>

      <p>
        Your privacy matters to Pro Kissan. Learn how we collect, use, and protect your personal information on our farming multi-vendor marketplace.
      </p>
    </div>
  </section>

  <!-- POLICY CONTENT -->

  <section class="policy-section">

    <div class="container">

      <div class="policy-wrapper">

        <h2>Introduction</h2>

        <p>
          Welcome to Pro Kissan. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website and services.
        </p>

        <p>
          By accessing or using our platform, you agree to the practices described in this Privacy Policy.
        </p>

        <div class="highlight">
          <p>
            We are committed to protecting your personal data and ensuring a secure farming marketplace experience.
          </p>
        </div>

        <h2>Information We Collect</h2>

        <p>
          We may collect the following types of information:
        </p>

        <ul>
          <li>Full name and contact details</li>
          <li>Email address and phone number</li>
          <li>Shipping and billing addresses</li>
          <li>Payment and transaction details</li>
          <li>Vendor store information</li>
          <li>Device information and IP address</li>
          <li>Website usage and browsing activity</li>
        </ul>

        <h2>How We Use Your Information</h2>

        <p>
          We use collected information for various purposes, including:
        </p>

        <ul>
          <li>Processing orders and transactions</li>
          <li>Managing vendor and customer accounts</li>
          <li>Providing customer support</li>
          <li>Improving platform performance and security</li>
          <li>Sending updates, offers, and notifications</li>
          <li>Preventing fraud and unauthorized activities</li>
        </ul>

        <h2>Cookies & Tracking Technologies</h2>

        <p>
          Pro Kissan uses cookies and similar technologies to improve user experience, analyze traffic, and personalize content.
        </p>

        <p>
          You can disable cookies through your browser settings, but some platform features may not function properly.
        </p>

        <h2>Vendor Information</h2>

        <p>
          Vendor profiles, product listings, store names, and contact information may be publicly visible to customers on the marketplace.
        </p>

        <p>
          Vendors are responsible for ensuring the accuracy of the information they provide.
        </p>

        <h2>Payment Security</h2>

        <p>
          We use secure payment gateways and industry-standard encryption methods to protect your payment data.
        </p>

        <p>
          However, no online system is completely secure, and we cannot guarantee absolute security.
        </p>

        <h2>Third-Party Services</h2>

        <p>
          Our platform may contain links to third-party websites or services such as payment gateways, delivery partners, or analytics providers.
        </p>

        <p>
          We are not responsible for the privacy practices of external websites or services.
        </p>

        <h2>Data Retention</h2>

        <p>
          We retain your information only for as long as necessary to provide services, comply with legal obligations, resolve disputes, and enforce agreements.
        </p>

        <h2>Your Rights</h2>

        <p>
          Depending on your region and applicable laws, you may have the right to:
        </p>

        <ul>
          <li>Access your personal data</li>
          <li>Request correction of inaccurate information</li>
          <li>Delete your account and personal data</li>
          <li>Withdraw marketing communication consent</li>
          <li>Request data portability</li>
        </ul>

        <h2>Children’s Privacy</h2>

        <p>
          Pro Kissan does not knowingly collect personal information from children under the age of 13.
        </p>

        <h2>Policy Updates</h2>

        <p>
          We may update this Privacy Policy periodically. Any changes will be posted on this page with an updated revision date.
        </p>

        <h2>Contact Us</h2>

        <div class="contact-box">

          <h3>Pro Kissan Support</h3>
             <p><strong>Company Name:</strong> CROP SHOP INDIA PRIVATE LIMITED</p>
          <p>Email:  cropshopind@gmail.com</p>

          <p>Phone: 6283444803</p>

          <p>Address: New grain market Malout, shri muktsar sahib Punjab 152107</p>

        </div>

      </div>

    </div>

  </section>


            </div>
@endsection
