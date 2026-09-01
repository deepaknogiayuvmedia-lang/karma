@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('About Us'))

@push('css_or_js')

    <meta property="og:image" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="About {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="about {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
@endpush

@section('content')
    <div class=" rtl __inlini-51">
        <div class="for-padding">
            <!DOCTYPE html>

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    body{
      font-family:'Poppins',sans-serif;
      background:#f8faf7;
      color:#222;
      line-height:1.6;
    }

    a{
      text-decoration:none;
    }

    img{
      width:100%;
      display:block;
    }


    /* HERO SECTION */

    .hero{
      height:70vh;
      background:
      linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)),
      url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?q=80&w=1400&auto=format&fit=crop');
      background-size:cover;
      background-position:center;
      display:flex;
      align-items:center;
      justify-content:center;
      text-align:center;
      color:#fff;
      padding:20px;
    }

    .hero-content h1{
      font-size:60px;
      margin-bottom:15px;
    }

    .hero-content p{
      max-width:750px;
      margin:auto;
      font-size:18px;
      opacity:0.95;
    }

    /* ABOUT */

    .about{
      padding:90px 0;
    }

    .about-wrapper{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
      gap:50px;
      align-items:center;
    }

    .about-image img{
      border-radius:20px;
      height:100%;
      object-fit:cover;
      box-shadow:0 10px 30px rgba(0,0,0,0.12);
    }

    .section-title{
      color:#2e7d32;
      font-size:18px;
      font-weight:600;
      margin-bottom:10px;
      text-transform:uppercase;
      letter-spacing:1px;
    }

    .about-content h2{
      font-size:42px;
      margin-bottom:20px;
      line-height:1.2;
    }

    .about-content p{
      margin-bottom:18px;
      color:#555;
    }

    .about .btn{
      display:inline-block;
      background:#2e7d32;
      color:#fff;
      padding:14px 32px;
      border-radius:50px;
      font-weight:500;
      margin-top:10px;
      transition:0.3s;
    }

    .about .btn:hover{
      background:#1b5e20;
      transform:translateY(-3px);
    }

    /* FEATURES */

    .features{
      padding:90px 0;
      background:#edf6ee;
    }

    .heading{
      text-align:center;
      margin-bottom:60px;
    }

    .heading h2{
      font-size:42px;
      margin-bottom:12px;
    }

    .heading p{
      max-width:700px;
      margin:auto;
      color:#666;
    }

    .feature-grid{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
      gap:30px;
    }

    .feature-card{
      background:#fff;
      padding:35px 30px;
      border-radius:20px;
      text-align:center;
      transition:0.3s;
      box-shadow:0 5px 20px rgba(0,0,0,0.05);
    }

    .feature-card:hover{
      transform:translateY(-8px);
    }

    .feature-icon{
      width:80px;
      height:80px;
      margin:auto;
      margin-bottom:20px;
      background:#e8f5e9;
      border-radius:50%;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:35px;
    }

    .feature-card h3{
      margin-bottom:12px;
      font-size:22px;
    }

    .feature-card p{
      color:#666;
      font-size:15px;
    }

    /* STATS */

    .stats{
      padding:90px 0;
    }

    .stats-wrapper{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
      gap:25px;
    }

    .stat-box{
      background:#fff;
      border-radius:20px;
      padding:40px 25px;
      text-align:center;
      box-shadow:0 5px 20px rgba(0,0,0,0.05);
    }

    .stat-box h2{
      font-size:48px;
      color:#2e7d32;
      margin-bottom:10px;
    }

    .stat-box p{
      color:#666;
      font-weight:500;
    }

    /* TEAM */

    .team{
      padding:90px 0;
      background:#edf6ee;
    }

    .team-grid{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
      gap:30px;
    }

    .team-card{
      background:#fff;
      border-radius:20px;
      overflow:hidden;
      text-align:center;
      box-shadow:0 5px 20px rgba(0,0,0,0.05);
      transition:0.3s;
    }

    .team-card:hover{
      transform:translateY(-8px);
    }

    .team-card img {
    height: 500px;
    object-fit: cover;
    object-position: top;
}

    .team-content{
      padding:25px;
    }

    .team-content h3{
      margin-bottom:6px;
    }

    .team-content span{
      color:#2e7d32;
      font-size:14px;
      font-weight:500;
    }

    .team-content p{
      margin-top:14px;
      color:#666;
      font-size:14px;
    }

    /* CTA */

    .cta{
      padding:100px 20px;
      background:linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1400&auto=format&fit=crop');
      background-size:cover;
      background-position:center;
      text-align:center;
      color:#fff;
    }

    .cta h2{
      font-size:48px;
      margin-bottom:20px;
    }

    .cta p{
      max-width:700px;
      margin:auto;
      margin-bottom:30px;
      opacity:0.95;
    }

    /* FOOTER */
.page-footer.font-small.mdb-color.rtl{
    padding-top: 0 !important;
}

    /* RESPONSIVE */

    @media(max-width:768px){

      .hero-content h1{
        font-size:42px;
      }

      .about-content h2,
      .heading h2,
      .cta h2{
        font-size:32px;
      }

      .hero{
        height:auto;
        padding:120px 20px;
      }
    }

  </style>


  <!-- HERO -->

  <section class="hero">
    <div class="hero-content">
      <h1 class="text-white">About us</h1>
  
    </div>
  </section>

  <!-- ABOUT -->

  <section class="about">
    <div class="container">
      <div class="about-wrapper">

        <div class="about-image">
          <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=1200&auto=format&fit=crop" alt="">
        </div>

        <div class="about-content">
          <div class="section-title">Who We Are</div>

          <h2>Empowering Farmers Through Digital Agriculture</h2>

          <p>
            Pro Kissan is a modern agriculture multi-vendor platform designed to help local farmers and agriculture businesses sell products online with ease and transparency.
          </p>

          <p>
            We believe fresh food should come directly from farms to customers while ensuring fair pricing, better profits for farmers, and healthier choices for families.
          </p>

          <p>
            Our platform supports organic vegetables, fruits, dairy products, grains, seeds, fertilizers, farming tools, and much more.
          </p>

          
        </div>

      </div>
    </div>
  </section>

  <!-- FEATURES -->

  <section class="features">
    <div class="container">

      <div class="heading">
        <h2>Why Choose Us</h2>
        <p>
          We provide a trusted and technology-driven farming marketplace experience for both sellers and buyers.
        </p>
      </div>

      <div class="feature-grid">

        <div class="feature-card">
          <div class="feature-icon">🌱</div>
          <h3>Fresh Products</h3>
          <p>
            Freshly harvested vegetables, fruits, and organic products directly from farms.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">🚜</div>
          <h3>Verified Farmers</h3>
          <p>
            Trusted and verified vendors ensuring quality agricultural products and services.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">📦</div>
          <h3>Fast Delivery</h3>
          <p>
            Secure and fast delivery system connecting farms directly to your doorstep.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">💚</div>
          <h3>Organic Focus</h3>
          <p>
            Promoting sustainable farming and healthy organic food for a better future.
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- STATS -->

  <section class="stats">
    <div class="container">

      <div class="stats-wrapper">

        <div class="stat-box">
          <h2>500+</h2>
          <p>Farm Vendors</p>
        </div>

        <div class="stat-box">
          <h2>10K+</h2>
          <p>Happy Customers</p>
        </div>

        <div class="stat-box">
          <h2>120+</h2>
          <p>Organic Products</p>
        </div>

        <div class="stat-box">
          <h2>24/7</h2>
          <p>Customer Support</p>
        </div>

      </div>

    </div>
  </section>

  <!-- TEAM -->

  <!--<section class="team">-->
  <!--  <div class="container">-->

  <!--    <div class="heading">-->
  <!--      <h2>Meet Our Team</h2>-->
  <!--      <p>-->
  <!--        Passionate people working together to transform the future of agriculture commerce.-->
  <!--      </p>-->
  <!--    </div>-->

  <!--    <div class="team-grid">-->

  <!--      <div class="team-card">-->
  <!--        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=900&auto=format&fit=crop" alt="">-->
  <!--        <div class="team-content">-->
  <!--          <h3>Rahul Sharma</h3>-->
  <!--          <span>Founder & CEO</span>-->
  <!--          <p>-->
  <!--            Leading the mission to empower farmers through digital innovation and smart farming solutions.-->
  <!--          </p>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="team-card">-->
  <!--        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=900&auto=format&fit=crop" alt="">-->
  <!--        <div class="team-content">-->
  <!--          <h3>Anjali Verma</h3>-->
  <!--          <span>Operations Head</span>-->
  <!--          <p>-->
  <!--            Managing vendor operations and ensuring smooth customer experiences across the platform.-->
  <!--          </p>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="team-card">-->
  <!--        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=900&auto=format&fit=crop" alt="">-->
  <!--        <div class="team-content">-->
  <!--          <h3>Vikram Singh</h3>-->
  <!--          <span>Marketing Manager</span>-->
  <!--          <p>-->
  <!--            Building strong connections between local farms and customers through strategic marketing.-->
  <!--          </p>-->
  <!--        </div>-->
  <!--      </div>-->

  <!--    </div>-->

  <!--  </div>-->
  <!--</section>-->

  <!-- CTA -->

  <section class="cta">
    <div class="container">
      <h2 class="text-white">Join Our Farming Community</h2>

      <p>
        Become a vendor, support local agriculture, and enjoy Pro Kissan products delivered directly to you.
      </p>

   
    </div>
  </section>

  <!-- FOOTER -->

        </div>
    </div>
@endsection
