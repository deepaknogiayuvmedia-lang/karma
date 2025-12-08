@extends('layouts.landing')
@section('content')
    @push('title')
        <title>बिना रसायन, भूख और शारीरिक श्रम के 10 दिन में 5 किलो वजन घटाएँ</title>
    @endpush
    <meta property="og:image" content="{{ asset('public/customassets/customassetsketoplus/prod.png') }}">
    <link href="{{ asset('public/customassets/customassetsketoplus/herbanix-ok.png') }}" rel="shortcut icon"
        type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('public/customassets/customassetsketoplus/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/customassets/customassetsketoplus/popup.css') }}/">
    <script type="text/javascript"
        src="{{ asset('public/customassets/customassetsketoplus/jquery-3.3.1.min.js.download') }}/"></script>
    <script type="text/javascript" src="{{ asset('public/customassets/customassetsketoplus/dr-dtime.min.js.download') }}">
    </script>
    <script>
        function blockBackPage() {
            window.addEventListener('popstate', function(e) {
                for (i = 0; i < 40; i++) {
                    window
                        .history
                        .pushState('target', '', location.href);
                }
            });
            window
                .history
                .pushState('target', '', location.href);
        }
        blockBackPage();
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="./बिना रसायन, भूख और शारीरिक श्रम के 10 दिन में 5 किलो वजन घटाएँ_files/js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-BWN1V3X31R');
    </script>
    <style>
        .content__pic a {
            display: block;
        }

        .notice {
            margin: 10px 0;
            font-size: 0.8em;
        }
    </style>

    <style type="text/css">
        .pushUp {
            position: fixed;
            top: 0;
            left: 0;
            border: none;
            width: 100%;
            height: 100%;
            z-index: 5000;
            background-color: rgba(0, 0, 0, .85);
            font: 700 18px 'PT Sans', sans-serif
        }

        .pushUp div {
            position: absolute;
            top: 170px;
            left: 120px;
            background-color: #fff;
            width: 440px;
            border: 1px solid #c7c7c7;
            border-radius: 3px;
            padding: 30px
        }

        .pushUp div:before {
            content: '';
            display: block;
            width: 25px;
            height: 29px;
            position: absolute;

            top: -29px;
            left: 145px
        }

        .pushUp p {
            font-size: 15px;
            font-weight: 400;

            padding: 0 0 0 75px;
            min-height: 62px;
            margin: 0 0 15px;
            display: flex;
            align-items: center
        }

        .pushUp.opera div {
            left: calc(50% - 220px);
            top: 200px
        }

        .pushUp.opera div:before {
            left: 335px
        }

        .pushUp.firefox div {
            left: 270px;
            top: 200px
        }

        .pushUp.firefox div:before {
            left: 85px
        }

        .pushUp.chrome.android div {
            left: 5%;
            top: 15px;
            width: 90%;
            font-size: 25px
        }

        .pushUp.chrome.android p {
            font-size: 20px
        }

        .pushUp.chrome.android div:before {
            left: 415px;
            transform: rotate(180deg);
            top: auto;
            bottom: -29px
        }

        @media only screen and (orientation:landscape) {
            .pushUp.chrome.android div {
                left: calc(50% - 270px);
                top: 15px;
                width: 540px;
                padding: 15px;
                min-height: 95px;
                font-size: 15px
            }

            .pushUp.chrome.android p {
                background-size: 40px;
                padding-left: 50px;
                min-height: 40px;
                margin-bottom: 10px;
                font-size: 15px
            }

            .pushUp.chrome.android div:before {
                display: none
            }
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        button {
            border-radius: 0;
        }

        button:focus {
            outline: 1px dotted;
            outline: 5px auto -webkit-focus-ring-color;
        }

        button,
        input {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button,
        input {
            overflow: visible;
        }

        button {
            text-transform: none;
        }

        [type=submit],
        button {
            -webkit-appearance: button;
        }

        [type=submit]::-moz-focus-inner,
        button::-moz-focus-inner {
            padding: 0;
            border-style: none;
        }

        .col-12,
        .col-lg-6,
        .col-md-12,
        .col-md-4,
        .col-md-6 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .order-1 {
            -ms-flex-order: 1;
            order: 1;
        }

        @media (min-width:768px) {
            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }

            .col-md-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-12 {
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

            .order-md-2 {
                -ms-flex-order: 2;
                order: 2;
            }
        }

        @media (min-width:992px) {
            .col-lg-6 {
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        @media (prefers-reduced-motion:reduce) {
            .form-control {
                transition: none;
            }
        }

        .form-control::-ms-expand {
            background-color: transparent;
            border: 0;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }

        .form-control::-webkit-input-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control::-moz-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control:-ms-input-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control::-ms-input-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control:disabled {
            background-color: #e9ecef;
            opacity: 1;
        }

        .form-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }

        .form-row>[class*=col-] {
            padding-right: 5px;
            padding-left: 5px;
        }

        .border {
            border: 1px solid #dee2e6 !important;
        }

        .d-block {
            display: block !important;
        }

        .d-flex {
            display: -ms-flexbox !important;
            display: flex !important;
        }

        .flex-wrap {
            -ms-flex-wrap: wrap !important;
            flex-wrap: wrap !important;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .position-relative {
            position: relative !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-white {
            color: #fff !important;
        }

        @media print {

            *,
            ::after,
            ::before {
                text-shadow: none !important;
                box-shadow: none !important;
            }

            img {
                page-break-inside: avoid;
            }
        }

        .text-white {
            color: #fff;
        }

        /*! end @import */
        #loading {
            display: none;
            justify-content: center;
            align-items: flex-end;
            position: absolute;
            top: 9%;
            left: 4%;
            right: 4%;
            bottom: 9%;
            z-index: 100;
            background-color: #ccc;
            border-radius: 15px;
            background-image: url(images/FhHRx.gif);
            background-repeat: no-repeat;
            background-position: top 12px center;
        }

        /*! CSS Used from: https://ketogen.in/css/lander.css */
        .ps-bg-image {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        #formbottom {
            margin-top: 48px;
            background: #273536;
            border-radius: 10px;
        }

        .custom-title {
            color: #fff;
            margin: 10px;
            text-align: center;
            font-size: 17px;
            font-weight: 400;
        }

        .emphasis {
            color: #a2d408;
        }

        .ps-bg-image {
            padding-bottom: 3em;
        }

        .form-control {

            height: calc(1.5em + .75rem + 8px);
        }

        #submitForm.disabled {
            background-image: url(images/Rolling.gif) !important;
            background-size: 22px !important;
            background-repeat: no-repeat !important;
            background-position: 58% center !important;
            pointer-events: none;
            background: #fb031b;
            opacity: .4;
        }

        .frmError {
            border: 1px solid red !important;
        }

        .msgError {
            color: red !important;
            position: absolute;
            right: 15px;
            bottom: 15px;
        }

        .form-group {
            position: relative;
            margin: 0;
        }
    </style>

    </head>

    <div class="">
        <div class="wrapper">
            <header class="header">
                <div class="container">
                    <div class="row jcs">
                        <div class="logo"><img
                                src="{{ asset('public/customassets/customassetsketoplus/herbanix-ok.png') }}" alt=""
                                style="width: 133px;"> </div>
                        <a href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                            target="_top" class="btn order-btn scroll"> हमारी लॉटरी में भाग लें! </a>
                    </div>
                </div>
            </header>
            <div class="main">
                <div class="container">
                    <div class="video-wrap">
                        <div class="video-cover">
                            <div class="video-text"> </div>
                        </div>

                        <video class="video-inner" preload="auto" rel="preload" as="video" controls=""
                            muted="muted" autoplay="" poster="images/poster.jpg">

                            <source src="{{ asset('public/customassets/customassetsketoplus/video.mp4') }}"
                                type="video/mp4">
                        </video>

                    </div>
                    <div class="content zoom-gallery">
                        <div class="lead">
                            <h1 class="lead__title accent"> देहरादून के एक प्रतिभाशाली छात्र को 10 दिन में बिना रसायन, भूख
                                और शारीरिक श्रम के 5 किलो वजन कम करने का तरीका ढूंढ निकालने के लिए राष्ट्रीय स्तर पर पहचान
                                मिली। </h1>
                            <figure class="lead__pic"> <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                                    data-mfp-src="images/photo_2020-09-18_14-17-31.jpg"> <img
                                        src="{{ asset('public/customassets/customassetsketoplus/photo_2020-09-18_14-17-31.jpg') }}">
                                </a>
                                <figcaption class="lead__caption"> एक युवा डॉक्टर सुनिधि रावत </figcaption>
                            </figure>
                            <div class="lead__text"> 2021 के मार्च के महीने में एंडोक्राइन सोसाइटी ऑफ इंडिया में कुछ बेहद
                                आश्चर्यजनक हुआ। वहाँ एक सम्मेलन में आए सारे डॉक्टर खड़े होकर 10 मिनट तक ताली बजाते रहे। हम
                                बात कर रहे हैं अपने देश की छात्रा सुनिधि रावत के बारे में। इस लड़की ने एक ऐसा फॉर्मूला इज़ाद
                                किया जिसके जरिए बड़ी तेजी से और बिना किसी परहेज के वजन कम किया जा सकता है। </div>

                            <p> <em> सुनिधि एक बहुत ही नया आइडिया लेकर आई थी जिसके ऊपर भारत के वैज्ञानिक वर्तमान में काम कर
                                    रहे हैं। </em> </p>
                            <p> <em> इस आइडिया के बारे में न सिर्फ भारत के बल्कि दुनिया भर के लोगों को पता चल गया। </em>
                            </p>
                            <p> <em> देहरादून के एंडोक्राइनोलॉजी डिपार्टमेंट ऑफ द पॉलीक्लीनिक और कई प्राइवेट क्लीनिक इस दवाई
                                    को बनाने की कोशिश कर रहे थे। और एक दिन यह संभव हो गया! यह दवाई बन गई है लेकिन वर्तमान
                                    में सिर्फ भारत के नागरिक ही इसे खरीद सकते हैं! </em> </p>
                            <div class="lead__title accent2"> यह नया फॉर्मूला कैसे लाखों ज़िंदगियाँ बचाने में कामयाब हो रहा
                                है और भारत के लोग कैसे इस पर बड़ा डिस्काउंट पा सकते हैं। आज हम इसी के बारे में चर्चा करेंगे।
                            </div>
                        </div>
                        <div class="interview">
                            <blockquote> परिवार में एक त्रासदी के बाद सुनिधि को एहसास हुआ कि डाइटिंग, शारीरिक मेहनत और
                                दवाइयाँ और लिपोसक्शन भी मोटापे के आधे से ज़्यादा मामलों में खतरनाक साबित होते हैं और इनसे
                                समस्या हल नहीं होती। </blockquote>
                            <p> <b> रिपोर्टर: </b> सुनिधि जी, आपको दुनिया के शीर्ष 10 सबसे बुद्धिमान मेडिकल छात्रों में गिना
                                जाता है। आपने मोटापे की समस्या से लड़ने का ही फैसला क्यों किया? </p>
                            <p> <em> <b> सुनिधि रावत: </b> </em> मैं इस बारे में सार्वजनिक रूप से ज़्यादा बात नहीं करना
                                चाहती और मेरी प्रेरणा पूरी तरह से निजी कारणों से थी। कुछ सालों पहले मेरी माँ की हाई ब्लड
                                प्रेशर के कारण मौत हो गई थी। वे इससे कई सालों से परेशान थीं। वे बहुत परहेज से रहती थीं और
                                वैसे ठीक थीं और वजन घटाने के लिए बहुत मेहनत भी कर रही थीं। लेकिन एक दिन अचानक उन्हें लकवा लग
                                गया और उनकी मौत हो गई। मेरी दादी की भी इसी कारण से मौत हुई थी। इसके बाद मैंने मोटापे से
                                संबन्धित समस्याओं के बारे में गहराई से पढ़ाई शुरू की और इनसे निजात पाने के तरीके ढूँढने लगी।
                                जब मैंने पाया कि डाइटिंग, एक्सर्साइज़ और दवाइयों और यहाँ तक कि लिपोसक्शन भी 50% लोगों के लिए
                                खतरनाक होते हैं और समस्या को हल नहीं कर पाते। मेरी मम्मी भी डाइटिंग कर रही थीं और 5 साल से
                                नियमित एरोबिक्स एक्सर्साइज़ भी करती थीं। </p>
                            <p> पिछले कुछ सालों में मैंने इस मुद्दे पर बहुत काम किया है। वजन कम करने के मेरे नए तरीके के
                                बारे में आज बहुत चर्चा हो रही है और यह मेरी थीसिस के दौरान ही सामने आई। मैंने अचानक पाया कि
                                मैंने प्रयोग करते-करते कुछ ऐसा बना लिया है जिसके बारे में पूरी दुनिया में चर्चा हो रही है।
                            </p>
                            <blockquote> अमेरिका की एक बड़ी दवाई कंपनी ने सुनिधि को एक फोर्मूले के बदले में 10 लाख डॉलर देने
                                की पेशकश की और वे इससे बनी दवाई प्रति डोज़ एक हजार डॉलर में बेचना चाहते थे। लेकिन सुनिधि ने
                                मना कर दिया और उसे पता था कि आम लोग इतना महंगा प्रोडक्ट नहीं खरीद पाएंगे। सुनिधि के जीवन का
                                उद्देश्य था मोटापे से लड़ रहे अधिक से अधिक लोगों की मदद करना। </blockquote>
                            <p> <b> रिपोर्टर: </b> हम कैसे सौदों की बात कर रहे हैं? </p>
                            <p> <em> <b> सुनिधि रावत: </b> </em> जैसे ही अधिक वजन कम करने के बारे में मेरी रिसर्च प्रकाशित
                                हुई, मुझे मेरे आइडिया को बेचने के ऑफर आने लगे। सबसे पहले फ्रांस के लोग आए जिन्होंने एक लाख
                                बीस हजार डॉलर की पेशकश की। इसके बाद आई एक अमेरिकन दवाई कंपनी जो दस लाख डॉलर तक देने के लिए
                                तैयार थी। मुझे इतने फोन आते थे कि अपना फोन नंबर बदलकर सोशल नेटवर्क छोड़ने पड़े क्योंकि लोग
                                मेरा पीछा ही नहीं छोड़ते थे। </p>
                            <p> <b> रिपोर्टर: </b> लेकिन जहाँ तक मुझे पता है आपने फॉर्मूला नहीं बेचा, है न? </p>
                            <p> <em> <b> सुनिधि रावत: </b> </em> हाँ, यह अजीब लग सकता है पर मैंने ये फॉर्मूला विदेशी लोगों
                                को अमीर बनाने के लिए नहीं बनाया। यदि मैंने ये विदेशी लोगों को बेच दिया होता तो क्या होता? ये
                                लोग हर चीज पेटेंट करवाने के बाद दवाई बनाकर महंगे रेट पर बेचने लगते। मैं उम्र में छोटी हूँ पर
                                बेवकूफ़ नहीं हूँ। ऐसे में तो भारत के लोगों को अपने मोटापे का इलाज करवाने का इतना बढ़िया
                                जरिया मिलेगा ही नहीं। विदेश के एक डॉक्टर ने मुझे बताया कि ये नुस्खा कम से कम एक हजार डॉलर का
                                मिलेगा। अब बताइए भारत में कितने लोग एक हजार डॉलर देकर इसे खरीद सकेंगे? </p>
                            <p> यही कारण है कि मुझे सरकार के स्वास्थ्य मंत्रालय ने प्रस्ताव दिया कि मैं इससे भारत में ही
                                दवाई बनाऊँ और मैंने ये तुरंत स्वीकार कर लिया। हमने ये इंस्टीट्यूट ऑफ एंडोक्राइनोलॉजी,
                                देहरादून के पॉलीक्लीनिक और प्राइवेट क्लीनिकों के विशेषज्ञों के साथ मिलकर बनाई है। इसे बनाकर
                                बहुत अच्छा लगा। अब इसकी क्लीनिकल टेस्टिंग चल रही है और यह सार्वजनिक रूप से उपलब्ध है। </p>
                            <p class="accent"> सरकार की ओर से इसके उत्पादन में अग्रणी योगदान रहा था <b> रश्मि गुप्ता जी का
                                </b> , जो इंडस्ट्री की एक जानी-मानी शख्सियत हैं हमने इनसे इस <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    नए फोर्मूले </a> और इसके आगे के प्लान के बारे में पूछा। </p>
                            <p> <b> रिपोर्टर: </b> सुनिधि का आइडिया आप संक्षिप्त में बता सकती हैं? क्या यह सच है कि आप बिना
                                डाइटिंग और जिम के मोटापे से मुक्ति पा सकते हैं? </p>
                            <p> <em> <b> रश्मि गुप्ता: </b> </em> सुनिधि का आइडिया बहुत शानदार है, इसे निर्देश खोज भी कहा जा
                                सकता है क्योंकि यह वजन कम करने का सबसे तेज तरीका देती है। और हम एक ऐसे तरीके की बात कर रहे
                                हैं जो पूरी जिंदगी मदद कर सकता है... </p>
                            <p> सुनिधि के आइडिया से बने फोर्मूले में <em> सुपर ऑक्सीडेंट हैं जो हमारे मस्तिष्क के एक विशेष
                                    हिस्से (एमिडाला) को संकेत भेजते हैं कि वह कैलोरी और चर्बी जमा करना बंद कर दे जिससे "जंक
                                    फूड" खाने की इच्छा ही खत्म हो जाती है। </em> इसका नाम था <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> . </p>
                            <p> <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> ही वह नुस्खा है और इसे कड़ाई से निर्देशों के अनुसार लेना होता है। इसमें
                                25 तरह के अर्क हैं जिनके कारण वसा जलने की प्रक्रिया 10 गुना तक तेज हो जाती है! इस नुस्खे से
                                मेटाबॉलिज़्म तेज हो जाता है और एंडोक्राइन सिस्टम का काम ठीक होता है, ऊतकों का पुनर्निर्माण
                                उत्प्रेरित होता है और इसके भूख घटाने पर बहुत अच्छे प्रभाव पड़ते हैं। यह मानव शरीर की
                                प्राकृतिक प्रक्रियाओं को सक्रिय रूप से उत्प्रेरित कर देता है। चूंकि मैटाबॉलिक प्रक्रिया तेज
                                होने के कारण वसा जलना शुरू हो जाता है, इसलिए डाइटिंग की कोई जरूरत नहीं पड़ती। नतीजतन, त्वचा
                                के नीचे जमी वसा और समस्या वाली जगहें हमेशा के लिए ठीक हो जाती हैं और वसा <b> 500 ग्राम प्रति
                                    दिन की दर से जलती है </b> ! लेकिन मुख्य चीज यह है कि <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> के कोई साइड-इफेक्ट नहीं हैं! </p>
                            <blockquote> इस प्रोडक्ट का नाम है <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> इसमें 25 तरह के अर्क हैं जिसे वसा जलने की प्रक्रिया 10 गुना तेज हो जाती
                                है और 500 ग्राम प्रतिदिन की दर से वसा जलती है! लेकिन मुख्य चीज यह है कि <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> के कोई साइड-इफेक्ट नहीं हैं! </blockquote>
                            <p> <em> <b> रश्मि गुप्ता: </b> </em> ये देखिए एक महिला के रिज़ल्ट जिसने «Keto Plus» के
                                परीक्षणों में हिस्सा लिया था: </p>
                            <figure class="content__pic"> <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                                    data-mfp-src="images/foto1.jpg?v=1"> <img
                                        src="{{ asset('public/customassets/customassetsketoplus/foto1.jpg') }}">
                                </a>
                                <figcaption class="content__pic-caption"> परिणाम <b> 14 दिन </b> Keto Plus लेने के बाद <b> -
                                        8 किलो </b> </figcaption>
                            </figure>
                            <figure class="content__pic"> <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                                    data-mfp-src="images/7.jpg?v=1"> <img
                                        src="{{ asset('public/customassets/customassetsketoplus/7.jpg') }}">
                                </a>
                                <figcaption class="content__pic-caption"> परिणाम <b> 28 दिन </b> Keto Plus लेने के बाद <b> -
                                        16 किलो </b> </figcaption>
                            </figure>
                            <figure class="content__pic"> <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                                    data-mfp-src="images/6.jpg?v=1"> <img
                                        src="{{ asset('public/customassets/customassetsketoplus/6.jpg') }}">
                                </a>
                                <figcaption class="content__pic-caption"> परिणाम <b> 60 दिन </b> Keto Plus लेने के बाद <b> -
                                        32 किलो </b> </figcaption>
                            </figure>
                            <figure class="content__pic"> <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                                    data-mfp-src="images/9.jpg?v=1"> <img
                                        src="{{ asset('public/customassets/customassetsketoplus/9.jpg') }}">
                                </a>
                                <figcaption class="content__pic-caption"> अंतिम परिणाम: <b> 60 दिन में -32 किलो </b> !
                                </figcaption>
                            </figure>
                            <p> <b> रिपोर्टर: </b> जबर्दस्त! ये फॉर्मूला दवाई बनकर दुकानों में कब आएगा? और किस रेट पर? </p>
                            <blockquote> वजन कम करने की दवाइयाँ सिर्फ अमेरिका में हर साल करोड़ों डॉलर की कमाई लाती हैं।
                                सुनिधि का बनाया ये प्रोडक्ट मार्केट में बड़ा बदलाव ला सकता है। </blockquote>
                            <p> <em> <b> रश्मि गुप्ता: </b> </em> देखिए जैसे ही इन लोगों को इस नुस्खे के असर का पता चलेगा,
                                दवाई की कंपनियाँ हमारे ऊपर हर तरह से हमला करेंगे। इन लोगों ने सुनिधि को तो पहले ही पैसे देकर
                                इसे खरीदने की कोशिश की थी। लेकिन ये लोग इसे बेचने के लिए इसे नहीं खरीद रहे थे। ये बस ये
                                चाहते थे कि किसी को ये बेचा न जाए। मोटापे का इलाज दवाई कंपनियों के लिए करोड़ों का बिजनेस है।
                                सिर्फ अमेरिका में करोड़ों डॉलर का मार्केट है। हमारे नुस्खे से मार्केट पूरा पलट जाएगा। असल
                                में, जब Keto Plus के एक कोर्स से हमेशा के लिए समस्या खत्म हो जाएगी तो कोई हर महीने दवाइयों
                                में पैसे क्यों लगाएगा। </p>
                            <p> दवाई की दुकान वाले भी कंपनियों के ही पार्टनर हैं और इसलिए मिलकर काम करते हैं। इनके लिए अपना
                                प्रोडक्ट बेचना ही सबसे बड़ी चीज है। इसलिए ये हमारे इलाज के बारे में सुनना भी नहीं चाहते जबकि
                                यह भारत की वैज्ञानिक संस्थाओं द्वारा सुझाया एक मात्र आधिकारिक उत्पाद है जिससे मोटापा घटाया
                                जा सकता है। </p>
                            <p> <b> रिपोर्टर: </b> और जब ये नुस्खा दवाई की दुकानों में मिलेगा ही नहीं तो लोग कहाँ से लेंगे?
                            </p>
                            <p> <em> <b> रश्मि गुप्ता: </b> </em> हमने फैसला किया कि यदि दवाई की कंपनियाँ बीच में आएंगी तो
                                हम इनके बिना भी काम कर लेंगे। हमने <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> का सीधा डिस्ट्रिब्यूशन शूरु किया और इन बिचौलियों को हटा डिया। हमने कई
                                तरीकों पर विचार किया और सबसे असरदार तरीके को लाए। Keto Plus को फार्मेसियों में नहीं बेचा
                                जाता! इसलिए, जिन लोगों को <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> 50% डिस्काउंट पर पाना है वे लकी ड्रॉ में हिस्सा ले सकते हैं! आप किस जगह
                                हैं, यह महत्वपूर्ण नहीं है, हम प्रोडक्ट को पूरे भारत में कहीं भी भेज सकते हैं। </p>
                            <blockquote> Keto Plus को दवाई की दुकानों में नहीं बेचा जाता! इसलिए जिन लोगों को <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> 50% डिस्काउंट पर पाना है वे लकी ड्रॉ में हिस्सा ले सकते हैं! आप किस जगह
                                हैं, यह महत्वपूर्ण नहीं है, हम प्रोडक्ट को पूरे भारत में कहीं भी भेज सकते हैं। </blockquote>
                            <p> हमने बड़े स्टार पर मीडिया में विज्ञापन शुरू किए हैं ताकि लोगों को प्रोडक्ट के बारे में पता
                                चले और <a
                                    href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                    Keto Plus </a> के 100 पैक लकी ड्रॉ में डिस्काउंट में दे रहे हैं <b>
                                    <script>
                                        dtime_nums(-1, true)
                                    </script>25.01.2024
                                </b> </p>
                            <p> <b> सभी इसमें हिस्सा लेकर पहला प्राइज़ जी सकते हैं: 50% डिस्काउंट! </b> यह ऑफर भारत के लोगों
                                के लिए ही है ताकि लोग इस प्रोडक्ट के बारे में जान सकें। </p>
                            <p> <b> रिपोर्टर: </b> लेकिन इसकी कीमत कितनी होगी? </p>
                            <p> <em> <b> रश्मि गुप्ता: </b> </em> हमने भारत सरकार के साथ ऐसी सहमति कर ली है कि हमें इतना
                                पैसा मिल जाएगा कि हमारा सारा खर्च निकाल आए। हमारा उद्देश्य है इस नुस्खे को जनता तक पहुंचाना
                                और सिर्फ अमीरों तक सीमित नहीं रखना। इसके बदले हमने यह सहमति दी है कि हम प्रोडक्ट एक्सपोर्ट
                                नहीं करेंगे और सिर्फ भारत में डिस्ट्रीब्यूट करेंगे। </p>
                            <p> <b> रिपोर्टर: </b> धन्यवाद रश्मि जी! इस अनोखे प्रोडक्ट के बारे में जानकार बहुत अच्छा लगा!
                                क्या आप हमारे पाठकों के लिए कुछ कहना चाहेंगी? </p>
                            <p> <em> <b> रश्मि गुप्ता: </b> </em> आपका भी धन्यवाद। हम अपने सभी पाठकों को मोटापे से निजात
                                पाने की सलाह देंगे क्योंकि यह कई तरह की बीमारियों की जड़ होता है जैसे: </p>
                            <ul>
                                <li> उच्च रक्तचाप </li>
                                <li> मधुमेह </li>
                                <li> आर्थ्रोसिस </li>
                                <li> वेरिकोज़ नसें </li>
                                <li> फैटी लीवर </li>
                            </ul>
                            <p></p>
                            <p> दुबले होने का इंतज़ार ही न करते रहें, अपनी समस्या से लड़ना अभी शुरू करें! </p>
                            <!--<p style="font-size: 20px;">सामग्री</p>
                                    <div class="table-row">
                                       <table class="table"><tbody><tr><td><strong>पोषक तत्व </strong></td><td><strong>मात्रा प्रति 100 ग्राम </strong></td></tr><tr><td>एनर्जी</td><td>500 kcal</td></tr><tr><td>प्रोटीन</td><td>12.5 g</td></tr><tr><td>टोटल लिपिड फैट</td><td>25 g</td></tr><tr><td>कार्बोहाइड्रेट</td><td>57.5 g</td></tr><tr><td>फाइबर टोटल डाईट्री</td><td>7.5 g</td></tr><tr><td>शुगर (एनएलईए)</td><td>25 g</td></tr><tr><td>शुगर एडेड</td><td>22.5 g</td></tr><tr><td colspan="2"><strong>मिनरल्स </strong></td></tr><tr><td>कैल्शियम</td><td>92 mg</td></tr><tr><td>आयरन</td><td>2.55 mg</td></tr><tr><td>पोटेशियम</td><td>625 mg</td></tr><tr><td>सोडियम</td><td>138 mg</td></tr><tr><td colspan="2"><strong>लिपिड </strong></td></tr><tr><td>फैटी एसिड (सैचुरेटेड)</td><td>6.25 g</td></tr></tbody></table>
                                    <table class="table">
                                        <tbody>
                                           <tr>
                                              <td>कैफीन अनिदरौस</td>
                                              <td>कैपसैक्स पाउडर</td>
                                           </tr>
                                           <tr>
                                              <td>क्रोमियम पिकोलिनेट</td>
                                              <td>Α-LACYS रिसेट ®</td>
                                           </tr>
                                           <tr>
                                              <td>ओपनटीए वल्गारिस</td>
                                              <td>ल-कार्निटिन फुमारते</td>
                                           </tr>
                                        </tbody>
                                     </table>
                                  </div>-->
                            <style>
                                .table {
                                    width: 100%;
                                    max-width: 100%;
                                    margin-bottom: 20px;
                                }

                                table {
                                    border-spacing: 0;
                                    border-collapse: collapse;
                                }

                                .table>thead>tr>th,
                                .table>tbody>tr>th,
                                .table>tfoot>tr>th,
                                .table>thead>tr>td,
                                .table>tbody>tr>td,
                                .table>tfoot>tr>td {
                                    padding: 8px;
                                    line-height: 1.42857143;
                                    vertical-align: top;
                                    border-top: 1px solid #ddd;
                                }

                                .table-row td {
                                    border: 1px solid #dee2e6;
                                    vertical-align: middle;
                                }
                            </style>
                        </div>
                        <div class="wheel" id="form">
                            <p class="order__title accent2"> लकी ड्रॉ चालू हो चुका है! </p>
                            <h2 class="wheel__title"> याद रखें, स्पेशल ऑफर इस दिन तक ही मान्य है: <span class="accent2">
                                    <script>
                                        dtime_nums(-1, true)
                                    </script>25.01.2024
                                </span></h2>
                            <!-- wheel -->
                            <div class="wheel__wrapper">
                                <h2 class="wheel__title"> अपनी किस्मत आज़माएँ! </h2>
                                <p class="wheel__title"> हमारी वेबसाइट Keto Plus पर अतिरिक्त छूट दे रही है। अपनी किस्मत
                                    आज़माएँ और घुमाएँ बटन दबाएँ। यदि आपकी किस्मत अच्छी होगी तो आप पैक 50% डिस्काउंट पर ऑर्डर
                                    कर सकेंगे! गुड लक! </p>
                                <div class="wheel__pic">
                                    <div class="custom-title">हमें बताएं कि आपकी माचा चाय कहां भेजनी है
                                    </div>
                                    <form action="{{ route('product-query') }}" class="row" method="POST"
                                        id="short-form" class="orderform col s12 orderForm">
                                        @csrf
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control " name="product_id" value="14"
                                                required />
                                            <label for="name" style="float: left; font-size: 18px;">Name:</label>
                                            <input type="text" class="form-control name" name="name" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mobile" style="float: left; font-size: 18px;">Mobile
                                                Number:</label>
                                            <input type="tel" class="form-control mobile" name="mobile" required />
                                            <span class="text-white">
                                                @error('mobile')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" style="float: left; font-size: 18px;">Email:</label>
                                            <input type="email" class="form-control email" name="email" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="address" style="float: left; font-size: 18px;">Pin
                                                Code/Address:</label>
                                            <input name="address" class="form-control address" required />
                                        </div>
                                        <div class="col-md-6  d-flex justify-content-center">
                                            <div class="">
                                                <button type="submit" class="btn buy-btn-nav"
                                                    style="background: #00695c;color:#ffffff"><i
                                                        class="fa fa-shopping-bag" aria-hidden="true"></i> RUSH MY
                                                    ORDER</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="qqq" class="order">
                                <div class="order__afisha">
                                    <div class="order__product"> <span class="sale" style="color: #000;"> -50%
                                            OFF</span>
                                        <a href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form"
                                            data-mfp-src="images/keto-power-front.jpg"> <img
                                                src="./बिना रसायन, भूख और शारीरिक श्रम के 10 दिन में 5 किलो वजन घटाएँ_files/keto-power-front.jpg">
                                        </a>
                                    </div>
                                    <!--<div class="order__info">
                                                <div class="order__lead"> आपकी सेल! </div>
                                                <div class="order__price old"> ₹4,998   </div>
                                                <br>
                                                <div class="order__price new">  ₹2,499 </div>
                                            </div>-->
                                </div>
                                <h2 class="order__title"> बधाई हो! </h2>
                                <p class="accent2" style="margin: 15px 0 25px 0; padding-bottom:0; font-size:1.5em;"> आपने
                                    प्राइज़ जीत लिया है - Keto Plus 50% डिस्काउंट पर! </p>
                                <p> आपका ऑफर खत्म होने में शेष समय: </p>
                                <div class="timer"> <span class="time accent" data-minutes="10" data-seconds="00">
                                        00:00 </span> </div>

                                <div class="">
                                    <div id="formbottom" class="col-12 border p-3">
                                        <div class="custom-title">हमें बताएं कि आपकी माचा चाय कहां भेजनी है
                                        </div>
                                        <form action="{{ route('product-query') }}" class="row" method="POST"
                                            id="short-form" class="orderform col s12 orderForm">
                                            @csrf
                                            <div class="col-md-6">
                                                <input type="hidden" class="form-control " name="product_id"
                                                    value="14" required />
                                                <label for="name" style="float: left; font-size: 18px;">Name:</label>
                                                <input type="text" class="form-control name" name="name"
                                                    required />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="mobile" style="float: left; font-size: 18px;">Mobile
                                                    Number:</label>
                                                <input type="tel" class="form-control mobile" name="mobile"
                                                    required />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" style="float: left; font-size: 18px;">Email:</label>
                                                <input type="email" class="form-control email" name="email"
                                                    required />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="address" style="float: left; font-size: 18px;">Pin
                                                    Code/Address:</label>
                                                <input name="address" class="form-control address" required />
                                            </div>
                                            <div class="col-md-6  d-flex justify-content-center">
                                                <div class="">
                                                    <button type="submit" class="btn buy-btn-nav"
                                                        style="background: #00695c;color:#ffffff"><i
                                                            class="fa fa-shopping-bag" aria-hidden="true"></i> RUSH MY
                                                        ORDER</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comments">
                        <h2 class="comments__title"> टिप्पणियाँ: </h2>
                        <div class="comments__list">
                            <div class="comments__item load visible" id="comment-load">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/c1.jpg') }}">
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> सरिता </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-1, true)
                                            </script>25.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> किस्मत खराब है, कुछ नहीं जीता, मैंने बिना डिस्काउंट के Keto Plus फुल रेट पर
                                            ऑर्डर की। लेकिन पूरी उम्मीद है कि इससे 7 से 8 किलो कम हो जाएंगे! सबको गुड लक
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item" id="teaser-comment">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/c6.jpg') }}">
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> महिमा </span> &lt;<span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-10, true)
                                            </script>16.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> ये पूरा नया प्रोडक्ट है। मैंने क्लीनिकल ट्रायल में हिस्सा लिया है। हम करीब 100
                                            लोग थे। और मैंने न सिर्फ वजन घटाया, मेनटेन भी है। </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/c5.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> चेतना </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-12, true)
                                            </script>14.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> चेतना, ये वाकई में जबर्दस्त है! मैंने पतले होने का फैसला कर लिया है और इस साल
                                            होकर रहूँगी! मुझे बस एक चीज समझ नहीं आती: यदि Keto Plus ले लूँ तो भी डाइटिंग
                                            करनी पड़ेगी क्या? </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/c23.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> जरीना </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-5, true)
                                            </script>21.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> जरीना, मैं जिस क्लीनिकल स्टडी ग्रुप में थी उसमें ऐसे कई लोग थे जो इसे ले रहे थे
                                            और कोई डाइटिंग नहीं कर रहे थे, और सबके रिज़ल्ट शानदार थे! हाँ मुझे कहा गया था कि
                                            हर महीने 15 किलो वजन कम होगा पर "सिर्फ" 12.8 किलो घटा। इसके पहले इतना वजन कम
                                            नहीं हुआ! मैं इस रिज़ल्ट से बहुत खुश हूँ! हाँ, यदि डाइटिंग और एक्सर्साइज़ शामिल
                                            करेंगे तो और अच्छे रिज़ल्ट आएंगे! </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_03.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> अनीता </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-7, true)
                                            </script>19.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> मैंने इस प्रोडक्ट के बारे में इंटरनेट पर बहुत पढ़ और मैंने और मेरे पति इसे ट्राय
                                            करना चाहते हैं, हम पतले होना चाहते हैं। हम बहुत एक्साइटेड हैं, और सेल शुरू होने
                                            का इंतज़ार कर रहे हैं... </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_04.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> मंजूषा </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-3, true)
                                            </script>23.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> मंजूषा, मैंने आपकी पोस्ट देखी, और एक चीज चाहती हूँ: आपने <a
                                                href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#form">
                                                Keto Plus </a> कितने दिन ली? </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_05.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> रागिनी </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-1, true)
                                            </script>25.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> रागिनी, मैंने इसे एक महीने लिया, ग्रुप में कुछ लोगों ने थोड़े ज़्यादा दिन लिया
                                            था। लेकिन रिज़ल्ट 7 दिन के बाद भी दिखने लगे थे। ये रहे मेरे फोटो। आप देख सकते हो
                                            मैंने पतली हो गई हून। </p>
                                        <p><img
                                                src="{{ asset('public/customassets/customassetsketoplus/foto1(1).jpg') }}" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_06.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> रजनी </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-1, true)
                                            </script>25.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> अपने रिज़ल्ट सबसे शेयर करना चाहती हूँ, मैं मोहिनी के साथ ग्रुप में थी। हमें बहुत
                                            बढ़िया रिज़ल्ट मिले। मैं इसका असर देखकर दंग रह गई हूँ, ये प्रोडक्ट वाकई में काम
                                            करता है। किस्मत अच्छी है कि क्लीनिकल ट्रायल में हिस्सा लिया। मेरी ज़िंदगी अब
                                            बेहतर हो गई है! देखिए, ये रहे मेरे रिज़ल्ट। प्रयोग शुरू होने से लेकर अंत तक।
                                        </p>
                                        <p><img src="{{ asset('public/customassets/customassetsketoplus/foto2.jpg') }}" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_07.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> काजल </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-1, true)
                                            </script>25.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> वाह, मुझे भी ऑर्डर करना है! यदि आज ऑर्डर करूंगी तो हो सकता है डिस्काउंट मिल जाए!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/c17.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> सीता </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-4, true)
                                            </script>22.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> मैं भी ऑर्डर करूंगी। इसके रिज़ल्ट शानदार हैं! मुझे भी ये प्रोडक्ट चाहिए। इसकी
                                            संख्या सीमित है, चूंकि ये भारत में अभी-अभी बननी शुरू हुई है। </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_08.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> तान्या </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-6, true)
                                            </script>20.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> तान्या, हम लोगों की किस्मत अच्छी है! डिस्काउंट पर! मैं भी ऑर्डर करूंगी! मेरी
                                            मम्मी, दादी और सहेली के लिए भी लूँगी जो कई महीनों से मोटापे से परेशान है और किसी
                                            चीज से कोई फायदा नहीं हो रहा... </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/autoAva.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> अंजलि </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-11, true)
                                            </script>15.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> मैं भी दवाई के टेस्ट वाले ग्रुप में थी! भारत में सेल चालू होने की घोषणा हो गई
                                            है! आपको पता नहीं होता पर मैंने अपना साइज़ काफी कम कर लिया है: 82 से 52 हो गया
                                            है! और मैं इसे दिखाने में भी नहीं शर्माती! ये रहे मेरे रिज़ल्ट! अब मेरे कई दोस्त
                                            खुद के लिए ऑर्डर करना चाहते हैं! मैं भी अपने लिए और पैक ऑर्डर करूंगा! </p>
                                        <p><img src="{{ asset('public/customassets/customassetsketoplus/foto3.jpg') }}" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_09.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> करिश्मा </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-2, true)
                                            </script>24.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> मैं तो चकरा गई हूँ! क्या शानदार रिज़ल्ट है! </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/autoAva.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> सुनील </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-3, true)
                                            </script>23.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> दोस्तों मैं क्लीनिकल ट्रायल के ग्रुप में था और मेरा भी वजन कम हुआ! ये प्रोडक्ट
                                            मेरे लिए बिल्कुल सही है। मैं मोटा था और कोई मुझे नहीं चाहता था... अब मेरी एक
                                            गर्लफ्रेंड है। मैं तेजी से वजन कम कर रहा हूँ। ये रही मेरी फोटो! </p>
                                        <p><img src="{{ asset('public/customassets/customassetsketoplus/foto4.jpg') }}" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="comments__item">
                                <div class="comments__avatar"><img
                                        src="{{ asset('public/customassets/customassetsketoplus/commit_02.jpg') }}" />
                                </div>
                                <div class="comments__body">
                                    <div class="comments__info"> <span class="comments__name"> राहुल </span> <span
                                            class="comments__date">
                                            <script>
                                                dtime_nums(-16, true)
                                            </script>10.01.2024
                                        </span> </div>
                                    <div class="comments__text">
                                        <p> मैं इसे तुरंत ऑर्डर कर रहा हूँ! मेरा भी वजन थोड़ा ज़्यादा है... किस्मत से ये
                                            प्रोडक्ट पुरुषों के लिए भी ठीक है। </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <style>
                        .result_sec {
                            margin-bottom: 30px;
                        }

                        .result_sec p {
                            color: #374048;
                            font-size: 20px;
                            margin: 0 0 33px;
                            font-weight: 500;
                        }

                        .result_row {
                            display: flex;
                            align-items: center;
                            margin: 10px 0;
                        }

                        .result_sec .result_row p {
                            color: #374048;
                            font-size: 16px;
                            margin: 0;
                            font-weight: 400;
                            text-align: left;
                            padding: 0 0 0 10px;
                        }
                    </style>

                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <p> </p>
                <p class="notice"> दवा नहीं, खाद्य पूरक </p>
            </div>
        </footer>
        <footer id="main-footer" class="py-4">
            <div class="container">
                <!--<div class="row">
                            <div class="col text-white">
                                <p style="font-weight:400 !important; font-size: 16px; background:#222; padding:15px;">
                                    <strong>Note:</strong> Due to restrictions on movement of goods have been enforced by the Government
                                    of India to prevent the spread of Covid-19. This has resulted in longer than usual time for delivery
                                    of the orders to our customers. We are working hard to ensure timely delivery, if you wish to cancel
                                    or have any queries please free to contact us.
                                </p>
                            </div>
                        </div>-->
                <div class="row">
                    <div class="col text-white  text-center" style="color: #fff; ">
                        <h6>WARNINGS - Promoted product is Dietary Supplement</h6>
                        <p style="font-weight:400 !important; font-size: 16px; "><span style="color: red;">Caution:</span>
                            Not intended for use by persons under age 18. Do not
                            exceed recommended dose. Do not take for more than eight (8) consecutive weeks. Do not use if
                            you are pregnant or nursing. Discontinue use two weeks prior to surgery or if upset stomach
                            occurs. Get the consent of a licensed physician before using this product, especially if you are
                            taking medication, have a medical condition, or thinking about becoming pregnant. Do not take
                            this product close to bedtime. KEEP THIS PRODUCT AND ALL SUPPLEMENTS OUT OF THE REACH OF
                            CHILDREN. </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-white text-center">

                        <h5>Our Partners:</h5>
                        <img src="{{ asset('public/customassets/customassetsketoplus/courier-icon.png') }}"
                            class="p-1"> <br>
                        <br>

                        <h6>For Any Queries Contact Customer Support</h6>
                        Send an email us to: <a href="mailto:support@herbanix.in">support@herbanix.co</a><br>
                        <!--Contact us - +91-9959959999-->
                        <br>
                        <a href="https://healthylives.life/ads/privacy.html" target="_blank" style="color: #fff;">Privacy
                            Policy</a> &nbsp;&nbsp;<a href="https://healthylives.life/ads/terms.html"
                            style="color: #fff;">Terms &amp; Conditions</a><br>

                        <p class="mb-0">© 2019 Keto Plus, All Rights Reserved.</p>
                        <p class="mb-0" style="font-size:10px;"></p>


                    </div>
                </div>
            </div>
        </footer>

        <style>
            footer {
                padding: 0 0 !important;
            }

            *,
            ::after,
            ::before {
                box-sizing: border-box;
            }

            footer {
                display: block;
            }

            h5,
            h6 {
                margin-top: 0;
                margin-bottom: .5rem;
            }

            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            ul {
                margin-top: 0;
                margin-bottom: 1rem;
            }

            strong {
                font-weight: bolder;
            }

            a {
                color: #007bff;
                text-decoration: none;
                background-color: transparent;
            }

            a:hover {
                color: #0056b3;
                text-decoration: underline;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            h5,
            h6 {
                margin-bottom: .5rem;
                font-weight: 500;
                line-height: 1.2;
            }

            h5 {
                font-size: 1.25rem;
            }

            h6 {
                font-size: 1rem;
            }

            .list-unstyled {
                padding-left: 0;
                list-style: none;
            }

            .container {
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }

            @media (min-width:576px) {
                .container {
                    max-width: 540px;
                }
            }

            @media (min-width:768px) {
                .container {
                    max-width: 720px;
                }
            }

            @media (min-width:992px) {
                .container {
                    max-width: 960px;
                }
            }

            @media (min-width:1200px) {
                .container {
                    max-width: 1140px;
                }
            }

            .row {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }

            .col {
                position: relative;
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
            }

            .col {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%;
            }

            .mb-0 {
                margin-bottom: 0 !important;
            }

            .p-1 {
                padding: .25rem !important;
            }

            .py-4 {
                padding-top: 1.5rem !important;
            }

            .py-4 {
                padding-bottom: 1.5rem !important;
            }

            .text-center {
                text-align: center !important;
            }

            .text-white {
                color: #fff !important;
            }

            @media print {

                *,
                ::after,
                ::before {
                    text-shadow: none !important;
                    box-shadow: none !important;
                }

                a:not(.btn) {
                    text-decoration: underline;
                }

                img {
                    page-break-inside: avoid;
                }

                p {
                    orphans: 3;
                    widows: 3;
                }

                .container {
                    min-width: 992px !important;
                }
            }

            .text-white {
                color: #fff;
            }

            #page-nav+* {
                margin-top: 81px;
            }

            #main-footer {
                background-color: #000;
                font-size: 1.1rem;
                line-height: 1.3;
                color: #bbb !important;
            }

            #main-footer .footer-links li {
                display: inline-block;
            }

            #main-footer .footer-links li span {
                padding-left: 5px;
                padding-right: 5px;
            }

            @media (min-width:576px) {
                #page-nav+* {
                    margin-top: 94px;
                }
            }

            @media (max-width:575px) {
                #page-nav+* {
                    margin-top: 93px;
                }
            }

            @media (max-width:444px) {
                #main-footer p {
                    font-size: 14px;
                }

                #main-footer .footer-links li {
                    font-size: 14px;
                }
            }
        </style>


        <div class="overlay overlay-prize">
            <div class="popup">
                <!-- <button class="close close-popup" type="button"> &nbsp; </button> -->
                <div class="popup__body">
                    <div class="popup__title shown"> बधाई हो! </div>
                    <p class="popup__text shown"> आपने हमारा पहला पुरस्कार जीता - Keto Plus 50% छूट के साथ! </p>
                    <a
                        href="https://healthylives.life/ads/keto1/?utm_source=HB&amp;clickId=FLBuKbYWDV63dwvezm6Bed&amp;campaignId=af21cf0e-7d80-4316-9258-cd944ac07ce8&amp;widget_id=utmsandbox#">
                        <div class="btn btn--submit btn-popup eventClick" data-target="#"> Ok </div>
                    </a>
                    <div class="popup__icon prize">&nbsp;</div>
                </div>
            </div>
        </div>


        <script src="./बिना रसायन, भूख और शारीरिक श्रम के 10 दिन में 5 किलो वजन घटाएँ_files/popup.js.download"></script>

        <script type="text/javascript"
            src="./बिना रसायन, भूख और शारीरिक श्रम के 10 दिन में 5 किलो वजन घटाएँ_files/packs.js.download"></script>
        <script>
            $('.zoom-gallery').magnificPopup({
                delegate: 'a[href*="img"]',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function(element) {
                        return element.find('img');
                    }
                }
            });
        </script>


        <script>
            function getURLParameter(name) {
                return (RegExp(name + '=([^&#]*)').exec(location.search) || [, null])[1] || '';
            }
            document.querySelectorAll('input[name="px"]').forEach(element => {
                element.value = getURLParameter('px');
            });
            $(document).ready(function() {
                $('.video-inner').get(0).play();
                $('.video-inner')[0].play();
            });


            $("#calcweight").click(function(a) {
                a.preventDefault();
                a = Math.ceil(Number($("#minus_weight").val()) / .666666);
                Number($("#weight").val()) > Number($("#minus_weight").val()) + 40 ?
                    $(".formResult").html(
                        "<p><b>If you follow the instructions below, you will be able to lose " + $("#minus_weight")
                        .val() +
                        "kg in just " + a + " days without any diet or exercise!</b></p><p>" +
                        "Do you think it's impossible? Read the article below until the end and you will change your mind. I hope this will change your life!</p>"
                    ) :
                    $(".formResult").html(
                        "<p><b>Incorrect Data" +
                        "</b></p>"
                    );
                $(".formResult").css({
                    transition: "background 1s",
                    backgroundColor: "#bcc74d73",
                    border: '2px solid #bcc74d'
                });
                setTimeout(function() {
                    $(".formResult").css({
                        backgroundColor: "#fff"
                    })
                }, 2E3)
            });
        </script>






    </div>
@endsection
