@extends('layouts.landing')
@push('title')
            <title>Sugo Plus - Manage Your Blood Sugar Safely & Naturally!</title>
        @endpush
@section('content')
    <div class="navbar-fixed">
        <nav class="white" role="navigation">
            <div class="nav-wrapper">
                <ul>
                    <div class="hide-on-med-and-down" style="display: flex;">
                        <li class="logo-desktop">
                            <a href="/"><img alt=""
                                    src="{{ asset('customassets/assets/logo.png') }}" /></a>
                        </li>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about1">About Sugo Plus</a></li>
                        <li><a href="#how">how to use</a></li>
                        <li><a href="#reviews">Real Results</a></li>
                        <li><a href="#cert">Certificate</a></li>
                    </div>

                    <li class="brand-logo center hide-on-large-only scroll-to-home">
                        <a href="/">
                            <img alt="" src="{{ asset('customassets/assets/logo.png') }}" class="mobile-logo"
                                style="" /></a>
                    </li>
                    <li class="btn-buy-nav right">
                        <a class="scroll-to-form">Buy now</a>
                    </li>
                </ul>
                <a id="moblenav-trigger-btn" class="sidenav-trigger">
                    <svg viewBox="0 0 24 24">
                        <path fill="#000" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"></path>
                    </svg>
                </a>
            </div>
            <div class="row no-margin">
                <ul id="nav-mobile" class="collapsible white">
                    <li class="col s12 no-padding">
                        <div class="collapsible-header" id="moblenav-trigger"></div>
                        <div class="collapsible-body collection white">
                            <a href="#home" class="collection-item black-text">Home</a>
                            <a href="#about1" class="collection-item black-text">About Sugo Plus</a>
                            <a href="#how" class="collection-item black-text">how to use</a>
                            <a href="#reviews" class="collection-item black-text">Real Results</a>
                            <a href="#cert" class="collection-item black-text">Certificate</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="background1 scrollspy" id="home">
        <div class="container">
            <div class="row home-row">
                <div class="home-col-1">
                    <div class="home-product hide-on-med-and-down">
                        <div class="home-product-img col s12 l8" style="z-index: 99">
                            <img alt="" src="{{ asset('customassets/assets/product-top.png') }}"
                                class="product-top-img" />
                        </div>
                    </div>
                    <div class="home-product hide-on-large-only">
                        <div class="home-product-img" style="z-index: 99; position: relative">
                            <img alt="" src="{{ asset('customassets/assets/product.png') }}"
                                class="product-top-img" />
                            <img alt="" src="{{ asset('customassets/assets/stamp-top.png') }}"
                                class="stamp-top" />
                        </div>
                    </div>
                </div>
                <div class="home-col-2 home-title-col"
                    style="
            background: rgb(255, 255, 255);
            background: radial-gradient(
              circle,
              rgba(255, 255, 255, 0.7035189075630253) 0%,
              rgba(255, 255, 255, 0) 58%
            );
          ">
                    <div class="home-count">
                        <div class="home-price-1" style="display: block; width: 100%">
                            <div class="product-prices" style="margin-bottom: 10px">
                                <span class="pr-oldprice">Rs 4998</span>
                                <span class="pr-newprice">Rs 2499</span>
                                <span class="pr-saveprice">you save -50%</span>
                            </div>
                            <img alt="" src="{{ asset('customassets/assets/pricetag-1.png') }}"
                                class="pricetag1" />
                        </div>

                        <div class="countdown-box-row">
                            <span class="countdown-text">Big Sale! 50% OFF</span>
                            <div class="countdown-box">
                                <span class="count-box chours">00</span><span>Hours</span>
                            </div>
                            <span class="counter-divider">:</span>
                            <div class="countdown-box">
                                <span class="count-box cminutes">10</span><span>Minutes</span>
                            </div>
                            <span class="counter-divider">:</span>
                            <div class="countdown-box">
                                <span class="count-box cseconds">00</span><span>Seconds</span>
                            </div>
                        </div>
                    </div>

                    <div class="header-text-box hide-on-med-and-down">
                        <b style="color: #2b3976">Manage Your</b>
                        <b style="color: #d81732">Blood sugar</b>
                        <i>Safely & naturaly</i>
                    </div>
                    <div class="header-text-box hide-on-large-only">
                        <b style="color: #2b3976">Manage<br />Your</b>
                        <b style="color: #d81732">Blood<br />sugar</b>
                        <i>Safely &<br />naturaly</i><br />
                        <img alt="" src="{{ asset('customassets/assets/stamp-30.png') }}"
                            style="width: 61px; margin: 0px auto" />
                    </div>
                    <div class="angle-box white hide-on-med-and-down">
                        <ul class="col l8 push-l3">
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><b>Regulates</b>&nbsp;Blood
                                Pressure
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><b>Balances</b>&nbsp;Blood
                                Sugar Levels
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><b>Lowers</b>&nbsp;Bad
                                Cholesterol (LDL)
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><b>Increases</b>&nbsp;Good
                                Cholesterol (HDL)
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><b>Reverses</b>&nbsp;Insulin
                                Resistance
                            </li>
                        </ul>
                    </div>
                    <a class="scroll-to-form btn-main hide-on-med-and-down" style="z-index: 99; margin-top: -30px">Order
                        Now</a>
                </div>
            </div>
            <div class="row home-row home-row-2 hide-on-large-only">
                <div class="col s12 home-title-col no-padding">
                    <div class="angle-box"
                        style="
              margin: 0px;
              border-radius: 0px;
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
            ">
                        <a class="scroll-to-form btn-main"
                            style="
                z-index: 99;
                justify-self: center;
                margin: 0px auto;
                margin-top: -30px;
              ">Order
                            Now</a>
                        <div class="col s12"></div>
                        <ul>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><span><b>Regulates</b>&nbsp;Blood
                                    Pressure</span>
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><span><b>Balances</b>&nbsp;Blood
                                    Sugar Levels</span>
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><span><b>Lowers</b>&nbsp;Bad
                                    Cholesterol (LDL)</span>
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><span><b>Increases</b>&nbsp;Good
                                    Cholesterol (HDL)</span>
                            </li>
                            <li>
                                <img alt=""
                                    src="{{ asset('customassets/assets/icon-check.svg') }}" /><span><b>Reverses</b>&nbsp;Insulin
                                    Resistance</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row scrollspy" id="causes">
        <div class="container">
            <h4 class="main-title">
                Do You Suffer<br />From Any of The Following Symptoms
            </h4>
            <div class="row cause-row">
                <div class="cause-box">
                    <img alt="" src="{{ asset('customassets/assets/feat-1.png') }}" /><span>Have you been
                        diagnosed with a heart problem?</span>
                </div>
                <div class="cause-box">
                    <img alt="" src="{{ asset('customassets/assets/feat-2.png') }}" /><span>Have you been
                        diagnosed with Type 2 Diabetes?</span>
                </div>
                <div class="cause-box">
                    <img alt="" src="{{ asset('customassets/assets/feat-3.png') }}" /><span>Do you suffer
                        from high blood pressure & blood sugar?</span>
                </div>
                <div class="cause-box">
                    <img alt="" src="{{ asset('customassets/assets/feat-4.png') }}" /><span>Are you
                        overweight for your age & body type?</span>
                </div>
            </div>
        </div>
    </div>

    <div class="back-2">
        <div class="row scrollspy" id="about1">
            <div class="container">
                <div class="row no-margin row-about1">
                    <div class="col s12 m6 l6 no-padding">
                        <span class="gradient-text-border">Sugo Plus Can reduce your Blood Pressure & Help You Lose Excess
                            Weight Fast & Effectively</span>
                    </div>
                    <div class="col s12 l6 hide-on-med-and-down no-padding" style="display: flex">
                        <p class="main-text"
                            style="
                text-align: left;
                max-width: 340px;
                font-size: 20px;
                align-self: center;
                margin: 0px;
                margin-left: 10px;
              ">
                            Tired of looking for remedies to manage diabetes, high blood
                            pressure, and cholesterol issues? Sugo Plus is a revolutionary
                            supplement made from all-natural and powerful ingredients
                            carefully picked and skillfully blended is what you need to fix
                            your body.
                        </p>
                    </div>
                </div>
                <div class="row"
                    style="
            display: flex;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 0px;
          ">
                    <a class="scroll-to-form btn-main" style="z-index: 99; display: flex; justify-content: center">Order
                        Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row scrollspy" id="about2">
        <div class="container">
            <h4 class="main-title">
                Introducing <b style="display: inline">Sugo Plus</b>
            </h4>

            <p class="main-text" style="padding: 0px 10vw">
                The Sugo Plus is a never before seen revolutionary formula to manage
                blood pressure and blood sugar levels better than any other product in
                the marketplace. Simply put, you will never see another product like
                this out there.
                <br /><br />
                We’ve sourced the most rare 100% natural ingredients that have been
                scientifically PROVEN to manage high blood pressure and promote
                overall healthy blood levels, and combined them into a breakthrough
                formula that is now going viral.
            </p>
        </div>
    </div>

    <div class="row scrollspy" id="formula">
        <h4 class="main-title">
            Triple Action Formula <b>For Rapid Action & Results</b>
        </h4>

        <div class="back-3">
            <div class="back-3333">
                <div class="text-back3">
                    <span class="text-back3-1">Regulates Blood Presure</span>
                    <span class="text-back3-2">Reduces Excess Weight & Obesity</span>
                    <span class="text-back3-3">Manages Blood Sugar</span>
                </div>
            </div>
        </div>
        <img alt="" src="{{ asset('customassets/assets/product.png') }}" class="back-3-product" />
    </div>

    <div class="back-4">
        <div class="container" style="width: 100%">
            <div class="midbanner scrollspy" id="midbanner">
                <div class="midbanner-inner-box">
                    <span class="midbanner-inner-text">
                        <b>Are you ready to restore your health?</b>
                        Feel the difference Sugo Plus makes!
                    </span>
                    <a class="scroll-to-form btn-main" style="z-index: 99">Order Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row scrollspy" id="ingr">
        <div class="container">
            <h4 class="main-title">Powerful Ingredients of <b>Sugo Plus</b></h4>

            <div class="row">
                <div class="col s12 ingr-with-img-row no-padding">
                    <div class="ingr-with-img">
                        <img alt="" src="{{ asset('customassets/assets/ingr-1.jpg') }}"
                            class="ingrimg2 hide-on-med-and-down" />
                        <img alt="" src="{{ asset('customassets/assets/ingr-m-1.jpg') }}"
                            class="ingrimg2 hide-on-large-only" />
                        <div class="ingr-text">
                            <span class="ingrimgtitle2"><b>Gudmar</b> Leaf</span>
                            <div class="grad-divider yellow-gradient-90"></div>
                            <span class="ingrimgtext">Powerful supplement, which supports lower blood sugar.
                            </span>
                        </div>
                    </div>
                    <div class="ingr-with-img invert-ingr">
                        <img alt="" src="{{ asset('customassets/assets/ingr-2.jpg') }}"
                            class="ingrimg2 hide-on-med-and-down" />
                        <img alt="" src="{{ asset('customassets/assets/ingr-m-2.jpg') }}"
                            class="ingrimg2 hide-on-large-only" />
                        <div class="ingr-text">
                            <span class="ingrimgtitle2"><b>Methi</b> Seed</span>
                            <div class="grad-divider yellow-gradient-90"></div>
                            <span class="ingrimgtext">Shown to reduce the risk of diabetes and decreases high blood
                                sugar levels.</span>
                        </div>
                    </div>
                    <div class="ingr-with-img">
                        <img alt="" src="{{ asset('customassets/assets/ingr-3.jpg') }}"
                            class="ingrimg2 hide-on-med-and-down" />
                        <img alt="" src="{{ asset('customassets/assets/ingr-m-3.jpg') }}"
                            class="ingrimg2 hide-on-large-only" />
                        <div class="ingr-text">
                            <span class="ingrimgtitle2"><b>Amala</b> Extract</span>
                            <div class="grad-divider yellow-gradient-90"></div>
                            <span class="ingrimgtext">Lowers cholesterol levels and reduces excessive glucose
                                production in the liver.</span>
                        </div>
                    </div>
                    <div class="ingr-with-img invert-ingr">
                        <img alt="" src="{{ asset('customassets/assets/ingr-4.jpg') }}"
                            class="ingrimg2 hide-on-med-and-down" />
                        <img alt="" src="{{ asset('customassets/assets/ingr-m-4.jpg') }}"
                            class="ingrimg2 hide-on-large-only" />
                        <div class="ingr-text">
                            <span class="ingrimgtitle2"><b>Neem</b> Extract</span>
                            <div class="grad-divider yellow-gradient-90"></div>
                            <span class="ingrimgtext">Controls inflammation levels and promotes weight loss.</span>
                        </div>
                    </div>
                    <div class="ingr-with-img">
                        <img alt="" src="{{ asset('customassets/assets/ingr-5.jpg') }}"
                            class="ingrimg2 hide-on-med-and-down" />
                        <img alt="" src="{{ asset('customassets/assets/ingr-m-5.jpg') }}"
                            class="ingrimg2 hide-on-large-only" />
                        <div class="ingr-text">
                            <span class="ingrimgtitle2"><b>Bitter</b> Melon</span>
                            <div class="grad-divider yellow-gradient-90"></div>
                            <span class="ingrimgtext">Lowers bad cholesterol and increases good cholesterol.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row scrollspy" id="benefits">
        <h4 class="main-title">
            Benefits of <b style="display: inline">Sugo Plus</b>
        </h4>
        <div class="back-5">
            <div class="container">
                <img alt="" src="{{ asset('customassets/assets/back-5-2.png') }}"
                    class="back-5-2 hide-on-med-and-down" />
                <div class="row benefits-grid benefits-slider">
                    <div class="benefit-box align-left">
                        <b>Reduces Blood Pressure</b>
                        <div class="grad-divider yellow-gradient-90"></div>
                        <span>The Sugo Plus uses an exclusive blend of the world’s most
                            exclusive ingredients that are clinically proven to lower high
                            blood pressure and reduce the risk of heart disease.</span>
                    </div>
                    <div class="benefit-box align-right">
                        <b>Increase Good Cholesterol</b>
                        <div class="grad-divider yellow-gradient-90"></div>
                        <span>In order keep your blood levels healthy and sustain, we made
                            sure to include important ingredients that promote good
                            cholesterol (HDL Cholesterol) so you can constantly keep your
                            blood pressure levels in a healthy state.</span>
                    </div>
                    <div class="benefit-box align-left">
                        <b>Regulates Blood Sugar</b>
                        <div class="grad-divider yellow-gradient-90"></div>
                        <span>The Sugo Plus is by far the absolute best formula for
                            controlling blood sugar and reducing the risk of Type 2 Diabetes
                            better than anything else in the market utilizing the specific
                            combination of ingredients and herbs inside this cutting edge
                            formula.</span>
                    </div>
                    <div class="benefit-box align-right">
                        <b>Reverses Insulin Resistancee</b>
                        <div class="grad-divider yellow-gradient-90"></div>
                        <span>The main cause of Type 2 Diabetes is becoming insulin
                            resistance. The Sugo Plus combats insulin resistance in a way no
                            other product has done in the industry.</span>
                    </div>
                    <div class="benefit-box align-left">
                        <b>Lowers Bad Cholesterol</b>
                        <div class="grad-divider yellow-gradient-90"></div>
                        <span>The clinically proven natural ingredients inside the Sugo Plus
                            have been shown to lower bad cholesterol (LDL cholesterol)
                            without the nasty side effects you see with statins.</span>
                    </div>
                    <div class="benefit-box align-right">
                        <b>Supports Weight Loss</b>
                        <div class="grad-divider yellow-gradient-90"></div>
                        <span>On top of the blood health benefits of the Sugo Plus, it also
                            promotes healthy weight loss by boosting your natural fat
                            burning metabolism so you can be confident that you’ll live a
                            longer healthier life without weight issues.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="back-6">
        <div class="container" style="width: 100%">
            <div class="row midproduct-row no-margin">
                <div class="midproduct-row-1">
                    <img alt="" src="{{ asset('customassets/assets/product.png') }}"
                        class="product-mid-img" />
                    <img alt="" src="{{ asset('customassets/assets/back-6-2.png') }}"
                        class="product-min-back" />
                </div>
                <div class="midproduct-row-2">
                    <div class="home-count">
                        <div class="home-price-1" style="display: block; width: 100%">
                            <div class="product-prices" style="margin-bottom: 10px">
                                <span class="pr-oldprice">Rs 4998</span>
                                <span class="pr-newprice">Rs 2499</span>
                                <span class="pr-saveprice">you save -50%</span>
                            </div>
                            <img alt="" src="{{ asset('customassets/assets/pricetag-2.png') }}"
                                class="pricetag2" />
                        </div>

                        <div class="countdown-box-row">
                            <span class="countdown-text">Big Sale! 50% OFF</span>
                            <div class="countdown-box">
                                <span class="count-box chours">00</span><span>Hours</span>
                            </div>
                            <span class="counter-divider">:</span>
                            <div class="countdown-box">
                                <span class="count-box cminutes">10</span><span>Minutes</span>
                            </div>
                            <span class="counter-divider">:</span>
                            <div class="countdown-box">
                                <span class="count-box cseconds">00</span><span>Seconds</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="midproduct-row-3">
                    <a class="scroll-to-form btn-main" style="margin: 0px auto; display: block">Order Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row scrollspy" id="cert">
        <div class="container">
            <div class="cert-box">
                <span class="cert-box-text">
                    <b>Sugo Plus</b> is 100%<br />
                    VMStandard<br />
                    Certified product.
                </span>
                <a href="#img1" class="lightbox-link">
                    <img alt="" class="cert-box-img" style="width: 150px" src="assets/cert.jpg" />
                </a>
                <a href="#cert" class="lightbox" id="img1">
                    <span
                        style="background-image: url('{{ asset('customassets/assets/assets/cert.jpg') }}')"></span>
                </a>
            </div>
        </div>
    </div>

    <h4 class="main-title scrollspy" id="how">How to Use</h4>
    <div class="back-4">
        <div class="container" style="width: 100%">
            <div class="midbanner scrollspy" id="">
                <div class="midbanner-inner-box"
                    style="
            justify-content: center;
            padding-left: 10px;
            clip-path: none;
            border-radius: 20px;
          ">
                    <span class="midbanner-inner-text" style="text-align: center">
                        <b>In the box, you will find 20 hard gelatin capsules.</b>
                        For excellent results, take a capsule daily, best taken in the
                        morning.
                    </span>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media only screen and (max-width: 992px) {
            .review-smallimg {
                display: flex;
            }

            .review-smallimg img {
                margin: 0px;
                margin-right: 10px;
            }

            .review-name,
            .review-ver {
                font-size: 16px;
            }

            .review-box {
                min-height: 700px;
            }
        }
    </style>
    <div class="container" style="width: 100%">
        <div class="row scrollspy" id="reviews">
            <h4 class="main-title">
                Real People. <b style="display: inline">Real results.</b>
            </h4>

            <p class="main-text" style="padding: 0px 10vw">
                Here’s what everyone else is saying about the incredible results of
                the Sugo Plus
            </p>
            <div class="review-slider review-row">
                <div class="col center">
                    <div class="review-box">
                        <div class="review-box-inner">
                            <div class="review-smallimg">
                                <img alt="" src="{{ asset('customassets/assets/rev1-profile.jpg') }}" />
                                <div class="review-info hide-on-large-only" style="text-align: left">
                                    <div class="review-name">Mary, 53 years</div>
                                    <div class="review-ver">
                                        Verified Buyer<img alt=""
                                            src="{{ asset('customassets/assets/rev-stars.svg') }}"
                                            style="
                        border-radius: 0px;
                        margin-left: 0px;
                        margin-top: 3px;
                        max-width: 80px;
                      " />
                                    </div>
                                </div>
                            </div>

                            <div class="review-text">
                                I started taking Sugo Plus about 30 days ago. My blood
                                pressure has not only been stable but also in the perfect
                                range after almost 1 year. My last reading was 120/78, whereas
                                prior to supplementation it was 140 - 160 over 90.
                            </div>
                            <div class="review-name hide-on-med-and-down">
                                Mary, 53 years
                            </div>
                            <div class="review-ver hide-on-med-and-down">
                                Verified Buyer<img alt=""
                                    src="{{ asset('customassets/assets/rev-stars.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col center">
                    <div class="review-box">
                        <div class="review-box-inner">
                            <div class="review-smallimg">
                                <img alt="" src="{{ asset('customassets/assets/rev2-profile.jpg') }}" />
                                <div class="review-info hide-on-large-only" style="text-align: left">
                                    <div class="review-name">Francesco, 67 years</div>
                                    <div class="review-ver">
                                        Verified Buyer<img alt=""
                                            src="{{ asset('customassets/assets/rev-stars.svg') }}"
                                            style="
                        border-radius: 0px;
                        margin-left: 0px;
                        margin-top: 3px;
                        max-width: 80px;
                      " />
                                    </div>
                                </div>
                            </div>

                            <div class="review-text">
                                Sugo Plus helps you control blood sugar and blood pressure
                                while also keeping your weight in check, all at once. My wife
                                and I have been using this product for over 3 months and can't
                                recommend it enough.
                            </div>
                            <div class="review-name hide-on-med-and-down">
                                Francesco, 67 years
                            </div>
                            <div class="review-ver hide-on-med-and-down">
                                Verified Buyer<img alt=""
                                    src="{{ asset('customassets/assets/rev-stars.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col center">
                    <div class="review-box">
                        <div class="review-box-inner">
                            <div class="review-smallimg">
                                <img alt="" src="{{ asset('customassets/assets/rev3-profile.jpg') }}" />
                                <div class="review-info hide-on-large-only" style="text-align: left">
                                    <div class="review-name">Lara, 69 years</div>
                                    <div class="review-ver">
                                        Verified Buyer<img alt=""
                                            src="{{ asset('customassets/assets/rev-stars.svg') }}"
                                            style="
                        border-radius: 0px;
                        margin-left: 0px;
                        margin-top: 3px;
                        max-width: 80px;
                      " />
                                    </div>
                                </div>
                            </div>

                            <div class="review-text">
                                What makes Sugo Plus the best product out there is its
                                all-natural ingredient matrix. You can take the supplement
                                with complete confidence, knowing it is free from any harmful
                                fillers, synthetics or chemicals.
                            </div>
                            <div class="review-name hide-on-med-and-down">
                                Lara, 69 years
                            </div>
                            <div class="review-ver hide-on-med-and-down">
                                Verified Buyer<img alt=""
                                    src="{{ asset('customassets/assets/rev-stars.svg') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row scrollspy" id="ship">
        <div class="container" style="width: 100%; padding: 30px 0px">
            <div class="row ship-row">
                <div class="ship-box yellow-gradient-90">
                    <img alt="" src="{{ asset('customassets/assets/icon-ship1.png') }}"
                        class="hide-on-med-and-down" />
                    <span><b>Shipping</b>DELIVERY BY COURIER WITHIN 1-7 DAYS. FREE
                        SHIPPING.</span>
                </div>
                <div class="ship-box yellow-gradient-90">
                    <img alt="" src="{{ asset('customassets/assets/icon-ship2.png') }}"
                        class="hide-on-med-and-down" />
                    <span><b>Guarantee</b>30 DAYS MONEY BACK GUARANTEE</span>
                </div>
                <div class="ship-box yellow-gradient-90">
                    <img alt="" src="{{ asset('customassets/assets/icon-ship3.png') }}"
                        class="hide-on-med-and-down" />
                    <span><b>Payment</b>CASH ON DELIVERY (COD)</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section-form back-8">
        <div class="container" style="">
            <div class="row hide-on-med-and-down">
                <div class="col s12 l6 right">
                    <div class="form-text-box" style="margin-bottom: 95px">
                        <h3>Manage Your<br />Blood sugar</h3>
                        <p class="main-text">Safely & naturaly</p>
                    </div>
                </div>
            </div>

            <div class="row scrollspy2 shortform" id="buy"
                style="display: flex; align-items: center; flex-wrap: wrap">
                <div class="col s12 l6 center">
                    <img alt="" src="{{ asset('customassets/assets/product.png') }}"
                        class="product-img-single" />
                </div>
                <div class="col s12 m12 l5 pull-l1 xl4 pull-xl2">
                    <div class="box-price activeprice center">
                        <span class="box-price-head1" style="font-weight: 700; padding: 10px 0px 0px">Place order</span>
                        <div class="box-price-in row">
                            <div class="col s12 box-price-col no-padding" style="flex-wrap: wrap">
                                <div class="col s12">
                                    <span class="box-price-old">Old Price: <span>Rs 4998</span></span>
                                    <span class="box-price-new">New Price: <span>Rs 2499</span></span>
                                </div>
                                <form action="{{ route('product-query') }}" class="row" method="POST"
                                    id="short-form" class="orderform col s12 orderForm">
                                    @csrf
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control " name="product_id" value="10"
                                            required />
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control name" name="name" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mobile">Mobile Number:</label>
                                        <input type="tel" class="form-control mobile" name="mobile" required />
                                        <span class="text-white">
                                            @error('mobile')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control email" name="email" required />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="address">Address:</label>
                                        <input name="address" class="form-control address" required></input>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn buy-btn-nav"
                                            style="background: #00695c;color:#ffffff"><i class="fa fa-shopping-bag"
                                                aria-hidden="true"></i> RUSH MY ORDER</button>
                                    </div>
                                </form>

                                <img alt="" src="{{ asset('customassets/assets/form-card.png') }}"
                                    class="form-card-pack" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 buyform-stamp center">
                    <img alt="" src="{{ asset('customassets/assets/form-stamp.png') }}"
                        class="form-stamp-pack" />
                </div>
            </div>
        </div>
    </div>
    <div class="back-9">
        <footer style="width: 100%">
            <div class="container" style="max-width: 900px">
                <div class="row no-margin">
                    <div class="col s12 no-padding hide-on-large-only">
                        <a href="/"><img alt="" src="assets/logo.png" class="scroll-to-home"
                                style="max-width: 200px; width: 100%" /></a>
                    </div>
                    <div class="col s12 l4 no-padding" style="align-self: end">
                        <ul>
                            <li><b>Menu</b></li>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about1">About Sugo Plus</a></li>
                            <li><a href="#how">how to use</a></li>
                            <li><a href="#reviews">Real Results</a></li>
                            <li><a href="#cert">Certificate</a></li>
                        </ul>
                    </div>
                    <div class="col s12 l4 no-padding" style="align-self: end">
                        <ul>
                            <li><b>Information</b></li>
                        </ul>
                    </div>
                    <div class="col s12 l4 no-padding white-text hide-on-med-and-down">
                        <a href="/"><img alt="" src="{{ asset('customassets/assets/logo.png') }}"
                                style="
                  max-width: 300px;
                  width: 100%;
                  margin: 0px auto;
                  display: block;
                " /></a>
                    </div>
                </div>
            </div>
        </footer>
        <div class="section" style="width: 100%">
            <div class="container" style="max-width: 900px">
                <div class="row no-margin">
                    <div class="col s12 center no-padding" style="font-size: 120%">
                        *<b>DISCLAIMER</b>: The results are individual. This means that
                        the information contained in this website is not intended to be
                        interpreted as a promise or guarantee. No individual results
                        should be regarded as typical. All ingredients are obtained from
                        natural sources.
                    </div>
                    <div class="col s12 center" style="margin-top: 10px">
                        © 2024 <b>Sugo Plus</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

