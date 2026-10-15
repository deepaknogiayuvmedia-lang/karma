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
      <h1 class="text-white">About {{ $web_config['name']->value }}</h1>
      <p>Bringing customers, farmers, and agricultural sellers together through one online marketplace.</p>
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

          <h2>A marketplace for farming and everyday agriculture needs</h2>

          <p>
            {{ $web_config['name']->value }} is a multi-vendor marketplace where customers can discover products listed by farmers, vendors, and agricultural businesses.
          </p>

          <p>
            We make it easier to explore available products online, compare listings, and place orders from participating sellers. Product details and seller information help customers make an informed choice.
          </p>

          <p>
            The marketplace includes farm produce and other agriculture-related items such as seeds, fertilizers, and farming tools. Product availability and delivery options can vary by seller and delivery location.
          </p>

          
        </div>

      </div>
    </div>
  </section>

  <!-- FEATURES -->

  <section class="features">
    <div class="container">

      <div class="heading">
        <h2>How the Marketplace Helps</h2>
        <p>
          Useful tools bring product discovery, vendor listings, and delivery information together in one place.
        </p>
      </div>

      <div class="feature-grid">

        <div class="feature-card">
          <div class="feature-icon">🌱</div>
          <h3>Explore Products</h3>
          <p>
            Browse available farm produce and agriculture-related products from participating sellers.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">🚜</div>
          <h3>Multiple Vendors</h3>
          <p>
            Discover listings from farmers, vendors, and agricultural businesses on one marketplace.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">📦</div>
          <h3>Location-Based Delivery</h3>
          <p>
            Delivery serviceability and shipping charges are checked for the delivery PIN code at checkout.
          </p>
        </div>

        <div class="feature-card">
          <div class="feature-icon">💚</div>
          <h3>Clear Product Details</h3>
          <p>
            Review product descriptions, available options, seller details, and customer feedback before ordering.
          </p>
        </div>

      </div>

    </div>
  </section>

  <!-- MARKETPLACE CATEGORIES -->

  <section class="stats">
    <div class="container">

      <div class="heading">
        <h2>Made for Agriculture</h2>
        <p>Find products for the home, the farm, and the work in between.</p>
      </div>

      <div class="stats-wrapper">
        <div class="stat-box">
          <h2><i class="fa fa-pagelines" aria-hidden="true"></i></h2>
          <p>Farm Produce</p>
        </div>

        <div class="stat-box">
          <h2><i class="fa fa-leaf" aria-hidden="true"></i></h2>
          <p>Seeds and Crop Care</p>
        </div>

        <div class="stat-box">
          <h2><i class="fa fa-flask" aria-hidden="true"></i></h2>
          <p>Fertilizers and Supplies</p>
        </div>

        <div class="stat-box">
          <h2><i class="fa fa-cogs" aria-hidden="true"></i></h2>
          <p>Farming Tools and Equipment</p>
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
      <h2 class="text-white">Discover the Marketplace</h2>

      <p>
        Explore products, review seller and delivery details for your location, and choose what works for you.
      </p>

   
    </div>
  </section>

  <!-- FOOTER -->

        </div>
    </div>
@endsection
