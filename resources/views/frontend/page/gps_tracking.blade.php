@extends('frontend.layouts.index')

@section('title',empty(language('frontend.page.landing.gps_tracking.title'))?language('general.title'):language('frontend.page.landing.gps_tracking.title'))
@section('keywords', language('frontend.page.landing.gps_tracking.keywords') )
@section('description', language('frontend.page.landing.gps_tracking.description') )

@section('breadcrumb')

@endsection
@section('content')
    <!--  HEADER SLIDE START  -->
    <section class="banner-section-two">
        <div class="auto-container home-header">
            <div class="row">
                <div class="col-lg-5">
                    <h1 class="header-title-big">{{language('frontend.page.landing.gps_tracking.header.text')}}</h1>
                    <p class="header-sub-title">{{language('frontend.page.landing.gps_tracking.header.sub_text')}}</p>
                    <div class="store-buttons-container">
                        <a href="#" class="store-button">
                            <img src="{{ asset('frontend/assets/images/icons/svg/play-store.svg?ver=1') }}"
                                 alt="play store"/>
                            <div class="text-content">
                                <span>{{language('frontend.page.landing.gps_tracking.header.button')}}</span>
                                <span>Play Store</span>
                            </div>
                        </a>
                        <a href="#" class="store-button">
                            <img src="{{ asset('frontend/assets/images/icons/svg/apple-store.svg?ver=1') }}"
                                 alt="apple store"/>
                            <div class="text-content">
                                <span>{{language('frontend.page.landing.gps_tracking.header.button')}}</span>
                                <span>App Store</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="image-background-gradient">
                        <img
                                src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.gps_tracking.header.image1'),500,673,100,'webp')  }}"
                                alt="header image"/>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--  HEADER SLIDE END  -->


    <!--  ABOUT US START  -->
    <section class="about-section-four pt-0">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight animated"
                     data-wow-delay="600ms"
                     style="visibility: visible; animation-delay: 600ms; animation-name: fadeInRight;">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2>{{ language('frontend.page.landing.gps_tracking.about_us.title') }}</h2>
                            <div
                                    class="text">{{ language('frontend.page.landing.gps_tracking.about_us.content') }}</div>
                        </div>
                        @if(language('frontend.page.landing.gps_tracking.about_us.mobile.number') != null)
                            <a href="tel:{{ language('frontend.page.landing.gps_tracking.about_us.mobile.number') }}"
                               class="info-btn">
                                <i class="icon flaticon-phone-ringing"></i>
                                <small>
                                    {{ language('frontend.page.landing.gps_tracking.about_us.mobile.title') }}
                                </small>
                                {{ language('frontend.page.landing.gps_tracking.about_us.mobile.number.txt') }}
                            </a>
                        @endif
                        @if(language('frontend.page.landing.gps_tracking.about_us.button_url') != null)
                            <a target="_blank"
                               href="{{ language('frontend.page.landing.gps_tracking.about_us.button_url') }}"
                               class="theme-btn btn-style-one">
                                <span class="btn-title">
                                   {{ language('frontend.page.landing.gps_tracking.about_us.button_txt') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft animated"
                         style="visibility: visible; animation-name: fadeInLeft;">
                        <div class="image-box">
                            <span class="bg-shape"
                                  style="background-image: url({{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.gps_tracking.about_us.bg_circle'),540,540,100,'webp') }});"></span>
                            <figure class="image-1 overlay-anim wow fadeInUp animated"
                                    style="visibility: visible; animation-name: fadeInUp;"><img
                                        src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.gps_tracking.about_us.image1'),494,494,100,'webp') }}"
                                        alt=""></figure>
                            <figure class="image-2 overlay-anim wow fadeInRight animated"
                                    style="visibility: visible; animation-name: fadeInRight;"><img
                                        src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.gps_tracking.about_us.image2'),308,308,100,'webp') }}"
                                        alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  ABOUT US END  -->

    <!--  PROJECT STRAT  -->
    <section class="demo-templates">
        <div class="container-fluid">
            <div class="sec-title text-center">
                <h2>{{ language('frontend.page.landing.gps_tracking.project.title') }}</h2>
            </div>

            <div class="demo-tempaltes-carousel owl-carousel ">
                @foreach(json_decode($projects->images,true)['link'] as $project)
                    <a target="_blank" href="" class="item">
                        <img src="{{ \App\Services\ImageService::customImageReSize( $project,235,null,100,'webp') }}">
                    </a>
                @endforeach

            </div>

        </div>
    </section>
    <!--  PROJECT END  -->


    <!--  PRICE START  -->
    <section class="pricing-section">
        <div class="bg"></div>
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>{{ language('frontend.page.landing.gps_tracking.price.title') }}</h2>
            </div>
            <div class="row">

                <!--  PLAN 1  -->
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="title-box">
                            <h3 class="title">{{ language('frontend.page.landing.gps_tracking.price.plan1') }}</h3>
                            <div
                                    class="text">{{ language('frontend.page.landing.gps_tracking.price.description1') }}</div>
                        </div>
                        <h2 class="price">
                            <div class="price-left">
                                @if(language('frontend.page.landing.gps_tracking.price.discount1') == null)
                                    <span
                                            class="price-text">{{ language('frontend.page.landing.gps_tracking.price.amount1') }}</span>
                                @else
                                    @if(language('frontend.page.landing.gps_tracking.price.percent1') != null)
                                        <span class="ribbon-pop">
                                             <div
                                                     class="ribbon-pop-txt1">{{ explode('|',language('frontend.page.landing.gps_tracking.price.percent1'))[0] }}</div>
                                           <div
                                                   class="ribbon-pop-txt2">{{ explode('|',language('frontend.page.landing.gps_tracking.price.percent1'))[1] }}</div>
                                         </span>
                                    @endif
                                    <div class="discount-text">
                                        {{ language('frontend.page.landing.gps_tracking.price.discount1') }}
                                    </div>
                                    <div
                                            class="my-price price-text">{{ language('frontend.page.landing.gps_tracking.price.amount1') }}</div>
                                @endif
                            </div>
                            <div class="price-right">
                                / {{ language('frontend.page.landing.gps_tracking.price.month') }}</div>
                        </h2>
                        <h6 class="sub-title">{{ language('frontend.page.landing.gps_tracking.price.services_include') }}</h6>
                        <ul class="features">
                            {!! language('frontend.page.landing.gps_tracking.price.plan_items1') !!}
                        </ul>
                        @if(language('frontend.page.landing.gps_tracking.price.button_url1') != null)
                            <a href="{{ language('frontend.page.landing.gps_tracking.price.button_url1') }}"
                               class="theme-btn btn-style-one">
                                <span class="btn-title">
                                    {{ language('frontend.page.landing.gps_tracking.price.button_txt1') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>


                <!--  PLAN 2  -->
                <div class="pricing-block tagged  col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="title-box">
                            <h3 class="title">{{ language('frontend.page.landing.gps_tracking.price.plan2') }}</h3>
                            <div
                                    class="text">{{ language('frontend.page.landing.gps_tracking.price.description2') }}</div>
                        </div>
                        <h2 class="price">
                            <div class="price-left">
                                @if(language('frontend.page.landing.gps_tracking.price.discount2') == null)
                                    <span
                                            class="price-text">{{ language('frontend.page.landing.gps_tracking.price.amount2') }}</span>
                                @else
                                    @if(language('frontend.page.landing.gps_tracking.price.percent2') != null)
                                        <span class="ribbon-pop">
                                             <div
                                                     class="ribbon-pop-txt1">{{ explode('|',language('frontend.page.landing.gps_tracking.price.percent2'))[0] }}</div>
                                           <div
                                                   class="ribbon-pop-txt2">{{ explode('|',language('frontend.page.landing.gps_tracking.price.percent2'))[1] }}</div>
                                         </span>
                                    @endif
                                    <div class="discount-text">
                                        {{ language('frontend.page.landing.gps_tracking.price.discount2') }}
                                    </div>
                                    <div
                                            class="my-price price-text">{{ language('frontend.page.landing.gps_tracking.price.amount2') }}</div>
                                @endif
                            </div>
                            <div class="price-right">
                                / {{ language('frontend.page.landing.gps_tracking.price.month') }}</div>
                        </h2>
                        <h6 class="sub-title">{{ language('frontend.page.landing.gps_tracking.price.services_include') }}</h6>
                        <ul class="features">
                            {!! language('frontend.page.landing.gps_tracking.price.plan_items2') !!}
                        </ul>
                        @if(language('frontend.page.landing.gps_tracking.price.button_url2') != null)
                            <a href="{{ language('frontend.page.landing.gps_tracking.price.button_url2') }}"
                               class="theme-btn btn-style-one">
                                <span class="btn-title">
                                    {{ language('frontend.page.landing.gps_tracking.price.button_txt2') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

                <!--  PLAN 3  -->
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="title-box">
                            <h3 class="title">{{ language('frontend.page.landing.gps_tracking.price.plan3') }}</h3>
                            <div
                                    class="text">{{ language('frontend.page.landing.gps_tracking.price.description3') }}</div>
                        </div>
                        <h2 class="price">
                            <div class="price-left">
                                @if(language('frontend.page.landing.gps_tracking.price.discount3') == null)
                                    <span
                                            class="price-text">{{ language('frontend.page.landing.gps_tracking.price.amount3') }}</span>
                                @else
                                    @if(language('frontend.page.landing.gps_tracking.price.percent3') != null)
                                        <span class="ribbon-pop">
                                             <div
                                                     class="ribbon-pop-txt1">{{ explode('|',language('frontend.page.landing.gps_tracking.price.percent3'))[0] }}</div>
                                           <div
                                                   class="ribbon-pop-txt2">{{ explode('|',language('frontend.page.landing.gps_tracking.price.percent3'))[1] }}</div>
                                         </span>
                                    @endif
                                    <div class="discount-text">
                                        {{ language('frontend.page.landing.gps_tracking.price.discount3') }}
                                    </div>
                                    <div
                                            class="my-price price-text">{{ language('frontend.page.landing.gps_tracking.price.amount3') }}</div>
                                @endif
                            </div>
                            <div class="price-right">
                                / {{ language('frontend.page.landing.gps_tracking.price.month') }}</div>
                        </h2>
                        <h6 class="sub-title">{{ language('frontend.page.landing.gps_tracking.price.services_include') }}</h6>
                        <ul class="features">
                            {!! language('frontend.page.landing.gps_tracking.price.plan_items3') !!}
                        </ul>
                        @if(language('frontend.page.landing.gps_tracking.price.button_url3') != null)
                            <a href="{{ language('frontend.page.landing.gps_tracking.price.button_url3') }}"
                               class="theme-btn btn-style-one">
                                <span class="btn-title">
                                    {{ language('frontend.page.landing.gps_tracking.price.button_txt3') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--  PRICE END  -->

    <!--  FAQ START  -->
    <section class="faqs-section">
        <div class="bg bg-pattern-4"></div>
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>{{ language('frontend.page.landing.gps_tracking.faq.title') }}</h2>
            </div>
            <div class="row">

                <div class="faq-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <ul class="accordion-box wow fadeInRight">

                            <li class="accordion block active-block">
                                <div
                                        class="acc-btn active">{{ language('frontend.page.landing.gps_tracking.faq.item.text1') }}
                                    <div class="icon fa fa-angle-down"></div>
                                </div>
                                <div class="acc-content current">
                                    <div class="content">
                                        <div
                                                class="text">{!! language('frontend.page.landing.gps_tracking.faq.item.content1')  !!}</div>
                                    </div>
                                </div>
                            </li>

                            <li class="accordion block">
                                <div class="acc-btn">{{ language('frontend.page.landing.gps_tracking.faq.item.text2') }}
                                    <div class="icon fa fa-angle-down"></div>
                                </div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">
                                            {!! language('frontend.page.landing.gps_tracking.faq.item.content2')  !!}
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="accordion block">
                                <div class="acc-btn">{{ language('frontend.page.landing.gps_tracking.faq.item.text3') }}
                                    <div class="icon fa fa-angle-down"></div>
                                </div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">
                                            {!! language('frontend.page.landing.gps_tracking.faq.item.content3')  !!}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--  FAQ END  -->

@endsection

@section('CSS')

    <link href="{{ asset('frontend/assets/css/style-gps-tracking.css?ver='.time()) }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive-gps-tracking.css?ver='.time()) }}" rel="stylesheet">



    <style>
        /*   ONLY SVG SEETINGS START   */

        .fill {
            fill: #fff
        }

        .logo-scale .fill {
            fill: #FFFFFF;
        }


        .animation-fill {
            fill: #FFFFFF;
            animation-name: strokeOrange;
            animation-duration: 2s;
            animation-fill-mode: both;
        }

        .animation-step-2 {
            animation-delay: 0.1s;
        }

        .animation-step-3 {
            animation-delay: 0.2s;
        }

        .animation-step-4 {
            animation-delay: 0.3s;
        }

        .animation-step-5 {
            animation-delay: 0.4s;
        }

        .animation-step-6 {
            animation-delay: 0.5s;
        }

        .animation-step-7 {
            animation-delay: 0.6s;
        }

        .animation-step-8 {
            animation-delay: 0.9s;
        }

        @keyframes strokeWhite {
            0% {
                fill: rgba(72, 138, 20, 0);
                stroke: rgba(255, 255, 255, 1);
                stroke-dashoffset: 25%;
                stroke-dasharray: 0 50%;
                stroke-width: 2;
            }
            70% {
                fill: rgba(72, 138, 20, 0);
                stroke: rgba(255, 255, 255, 1);
            }
            80% {
                fill: rgba(72, 138, 20, 0);
                stroke: rgba(255, 255, 255, 1);
                stroke-width: 3;
            }
            100% {
                fill: rgba(255, 255, 255, 1);
                stroke: rgba(54, 95, 160, 0);
                stroke-dashoffset: -25%;
                stroke-dasharray: 50% 0;
                stroke-width: 0;
                animation-play-state: paused;
            }
        }

        @keyframes strokeOrange {
            0% {
                fill: rgba(72, 138, 20, 0);
                stroke: #FFFFFF;
                stroke-dashoffset: 25%;
                stroke-dasharray: 0 50%;
                stroke-width: 2;
            }
            70% {
                fill: rgba(72, 138, 20, 0);
                stroke: #FFFFFF;
            }
            80% {
                fill: rgba(72, 138, 20, 0);
                stroke: #FFFFFF;
                stroke-width: 3;
            }
            100% {
                fill: #FFFFFF;
                stroke: rgba(54, 95, 160, 0);
                stroke-dashoffset: -25%;
                stroke-dasharray: 50% 0;
                stroke-width: 0;
                animation-play-state: paused;
            }
        }

        /*   ONLY SVG SEETINGS END   */
        .about-section-four {
            margin-top: 150px;
        }


        .btn-title:hover {
            color: #FFFFFF !important;
        }

        #lg-counter {
            display: none !important;
        }

        .pricing-block .inner-box {
            background-image: url({{ asset('frontend/assets/images/icons/price-bg.jpg?ver=2') }});
        }

        .pricing-block .inner-box::before {
            background-image: url({{ asset('frontend/assets/images/icons/price-hover-bg.jpg?ver=2') }});
        }


        .header-style-one::before {
            background: linear-gradient(#2196F3, transparent) !important;

        }

        @media (max-width: 991px) {
            .header-style-one::before {
                background: transparent !important;

            }

        }

        .main-header .info-btn small {
            color: #ffffff;
        }

        .main-header .info-btn i {
            color: #000;
            background-color: #ffffff;
        }

        .main-header .info-btn:hover {
            color: #efefef;
        }


    </style>
@endsection

@section('JS')

    <script>
        {{--Owl Carousel--}}
        $(function () {
            $('.demo-tempaltes-carousel').owlCarousel({
                center: true,
                loop: true,
                margin: 0,
                items: 3,
                nav: true,
                dots: false,
                navigationText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
                responsive: {
                    0: {
                        items: 3,
                        margin: 0,
                    },
                    575: {
                        items: 4,
                        margin: 0,
                    },
                    768: {
                        items: 4,
                        margin: 0,
                    },
                    991: {
                        items: 5,
                        margin: 0,
                    },
                    1200: {
                        items: 6,
                        margin: 0,
                    },
                    1600: {
                        items: 7,
                        margin: 0,
                    },
                    1920: {
                        items: 8,
                        margin: 0,
                    }
                }
            })

        })


    </script>
@endsection
