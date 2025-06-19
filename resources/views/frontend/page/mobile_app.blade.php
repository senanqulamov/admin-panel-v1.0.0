@extends('frontend.layouts.index')

@section('title',empty(language('frontend.page.landing.mobile_app.title'))?language('general.title'):language('frontend.page.landing.mobile_app.title'))
@section('keywords', language('frontend.page.landing.mobile_app.keywords') )
@section('description', language('frontend.page.landing.mobile_app.description') )

@section('breadcrumb')

@endsection
@section('content')
    <!--  HEADER SLIDE START  -->
    <section class="banner-section-two">
        <div class="banner-carousel owl-carousel owl-theme">

            <div class="slide-item">
                <div class="bg-image" style="background-image: url('{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.mobile_app.header.bg_image'),1894,870,100,'webp') }}');"></div>
                <div class="auto-container">
                    <div class="row">
                        <div class="content-column col-lg-6 col-md-12">
                            <div class="content-box">
{{--                                <span class="arrow-icon"><img src="https://html.kodesolution.com/2023/amiso-html/images/main-slider/arrow.png" alt></span>--}}
                                <h1 class="title animate-1">{{ language('frontend.page.landing.mobile_app.header.text') }}</h1>
                                <div class="btn-box animate-3">
                                    @if(language('frontend.page.landing.mobile_app.header.button_url') != null)
                                    <a target="_blank" href="{{ language('frontend.page.landing.mobile_app.header.button_url') }}" class="theme-btn btn-style-one">
                                        <span class="btn-title">
                                            {{ language('frontend.page.landing.mobile_app.header.button_txt') }}
                                        </span>
                                    </a>
                                    @endif
{{--                                    <a href="https://www.youtube.com/watch?v=Fvae8nxzVz4" class="play-btn lightbox-image"><i class="icon fa fa-play"></i> Work <br>Showcase</a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="image-column col-lg-6 col-md-12">
                            <div class="image-box">
                                <figure class="image-1 overlay-anim"><img src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.mobile_app.header.image1'),362,478,100,'webp') }}" alt></figure>
                                <figure class="image-2 overlay-anim"><img src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.mobile_app.header.image2'),362,478,100,'webp') }}" alt></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <ul class="banner-social-links">--}}
{{--            <li><a href="#">facebook</a></li>--}}
{{--            <li><a href="#">twitter</a></li>--}}
{{--            <li><a href="#">instagram</a></li>--}}
{{--        </ul>--}}
    </section>
    <!--  HEADER SLIDE END  -->

    <!--  ABOUT US START  -->
    <section class="about-section-four pt-0">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight animated" data-wow-delay="600ms" style="visibility: visible; animation-delay: 600ms; animation-name: fadeInRight;">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2>{{ language('frontend.page.landing.mobile_app.about_us.title') }}</h2>
                            <div class="text">{{ language('frontend.page.landing.mobile_app.about_us.content') }}</div>
                        </div>
                        @if(language('frontend.page.landing.mobile_app.about_us.mobile.number') != null)
                            <a href="tel:{{ language('frontend.page.landing.mobile_app.about_us.mobile.number') }}" class="info-btn">
                                <i class="icon flaticon-phone-ringing"></i>
                                <small>
                                    {{ language('frontend.page.landing.mobile_app.about_us.mobile.title') }}
                                </small>
                                {{ language('frontend.page.landing.mobile_app.about_us.mobile.number.txt') }}
                            </a>
                        @endif
                        @if(language('frontend.page.landing.mobile_app.about_us.button_url') != null)
                            <a target="_blank" href="{{ language('frontend.page.landing.mobile_app.about_us.button_url') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">
                                   {{ language('frontend.page.landing.mobile_app.about_us.button_txt') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
                        <div class="image-box">
                            <span class="bg-shape" style="background-image: url({{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.mobile_app.about_us.bg_circle'),540,540,100,'webp') }});"></span>
                            <figure class="image-1 overlay-anim wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><img src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.mobile_app.about_us.image1'),494,494,100,'webp') }}" alt=""></figure>
                            <figure class="image-2 overlay-anim wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;"><img src="{{ \App\Services\ImageService::customImageReSize( language('frontend.page.landing.mobile_app.about_us.image2'),308,308,100,'webp') }}" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  ABOUT US END  -->

    <!--  PROJECT STRAT  -->
    <section class="projects-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>{{ language('frontend.page.landing.mobile_app.project.title') }}</h2>
            </div>
            <div class="carousel-outer">
                <div id="lightgallery" class="my-projects-carousel owl-carousel owl-theme ">

                    @foreach(json_decode($projects->images,true)['link'] as $project)
{{--                        <a href="https://www.hasan-oglu.az/storage/filemanager/images/Paneller/1711-Brush-champagne.jpg">--}}
{{--                            <img src="https://www.hasan-oglu.az/storage/filemanager/images/Paneller/1711-Brush-champagne.jpg" alt="">--}}
{{--                        </a>--}}
                        <div data-src="{{ \App\Services\ImageService::customImageReSize( $project,600,653,100,'webp') }}"  class="project-block">
                            <div class="inner-box">
                                <div  class="image-box">
                                    <figure  class="image">
                                            <img src="{{ \App\Services\ImageService::customImageReSize( $project,400,435,100,'webp') }}" >
                                    </figure>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>
    <!--  PROJECT END  -->


    <!--  PRICE START  -->
    <section class="pricing-section">
        <div class="bg"></div>
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>{{ language('frontend.page.landing.mobile_app.price.title') }}</h2>
            </div>
            <div class="row">

                <!--  PLAN 1  -->
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="title-box">
                            <h3 class="title">{{ language('frontend.page.landing.mobile_app.price.plan1') }}</h3>
                            <div class="text">{{ language('frontend.page.landing.mobile_app.price.description1') }}</div>
                        </div>
                        <h2 class="price">
                            <div class="price-left">
                                @if(language('frontend.page.landing.mobile_app.price.discount1') == null)
                                    <span class="price-text">{{ language('frontend.page.landing.mobile_app.price.amount1') }}</span>
                                @else
                                    @if(language('frontend.page.landing.mobile_app.price.percent1') != null)
                                        <span class="ribbon-pop">
                                             <div class="ribbon-pop-txt1">{{ explode('|',language('frontend.page.landing.mobile_app.price.percent1'))[0] }}</div>
                                           <div class="ribbon-pop-txt2">{{ explode('|',language('frontend.page.landing.mobile_app.price.percent1'))[1] }}</div>
                                         </span>
                                    @endif
                                    <div class="discount-text">
                                        {{ language('frontend.page.landing.mobile_app.price.discount1') }}
                                    </div>
                                    <div class="my-price price-text">{{ language('frontend.page.landing.mobile_app.price.amount1') }}</div>
                                @endif
                            </div>
                            <div class="price-right">/ {{ language('frontend.page.landing.mobile_app.price.month') }}</div>
                        </h2>
                        <h6 class="sub-title">{{ language('frontend.page.landing.mobile_app.price.services_include') }}</h6>
                        <ul class="features">
                           {!! language('frontend.page.landing.mobile_app.price.plan_items1') !!}
                        </ul>
                        @if(language('frontend.page.landing.mobile_app.price.button_url1') != null)
                            <a href="{{ language('frontend.page.landing.mobile_app.price.button_url1') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">
                                    {{ language('frontend.page.landing.mobile_app.price.button_txt1') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>


                <!--  PLAN 2  -->
                <div class="pricing-block tagged  col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="title-box">
                            <h3 class="title">{{ language('frontend.page.landing.mobile_app.price.plan2') }}</h3>
                            <div class="text">{{ language('frontend.page.landing.mobile_app.price.description2') }}</div>
                        </div>
                        <h2 class="price">
                            <div class="price-left">
                                @if(language('frontend.page.landing.mobile_app.price.discount2') == null)
                                    <span class="price-text">{{ language('frontend.page.landing.mobile_app.price.amount2') }}</span>
                                @else
                                    @if(language('frontend.page.landing.mobile_app.price.percent2') != null)
                                        <span class="ribbon-pop">
                                             <div class="ribbon-pop-txt1">{{ explode('|',language('frontend.page.landing.mobile_app.price.percent2'))[0] }}</div>
                                           <div class="ribbon-pop-txt2">{{ explode('|',language('frontend.page.landing.mobile_app.price.percent2'))[1] }}</div>
                                         </span>
                                    @endif
                                    <div class="discount-text">
                                        {{ language('frontend.page.landing.mobile_app.price.discount2') }}
                                    </div>
                                    <div class="my-price price-text">{{ language('frontend.page.landing.mobile_app.price.amount2') }}</div>
                                @endif
                            </div>
                            <div class="price-right">/ {{ language('frontend.page.landing.mobile_app.price.month') }}</div>
                        </h2>
                        <h6 class="sub-title">{{ language('frontend.page.landing.mobile_app.price.services_include') }}</h6>
                        <ul class="features">
                            {!! language('frontend.page.landing.mobile_app.price.plan_items2') !!}
                        </ul>
                        @if(language('frontend.page.landing.mobile_app.price.button_url2') != null)
                            <a href="{{ language('frontend.page.landing.mobile_app.price.button_url2') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">
                                    {{ language('frontend.page.landing.mobile_app.price.button_txt2') }}
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

                <!--  PLAN 3  -->
                <div class="pricing-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="title-box">
                            <h3 class="title">{{ language('frontend.page.landing.mobile_app.price.plan3') }}</h3>
                            <div class="text">{{ language('frontend.page.landing.mobile_app.price.description3') }}</div>
                        </div>
                        <h2 class="price">
                            <div class="price-left">
                                @if(language('frontend.page.landing.mobile_app.price.discount3') == null)
                                    <span class="price-text">{{ language('frontend.page.landing.mobile_app.price.amount3') }}</span>
                                @else
                                    @if(language('frontend.page.landing.mobile_app.price.percent3') != null)
                                        <span class="ribbon-pop">
                                             <div class="ribbon-pop-txt1">{{ explode('|',language('frontend.page.landing.mobile_app.price.percent3'))[0] }}</div>
                                           <div class="ribbon-pop-txt2">{{ explode('|',language('frontend.page.landing.mobile_app.price.percent3'))[1] }}</div>
                                         </span>
                                    @endif
                                    <div class="discount-text">
                                        {{ language('frontend.page.landing.mobile_app.price.discount3') }}
                                    </div>
                                    <div class="my-price price-text">{{ language('frontend.page.landing.mobile_app.price.amount3') }}</div>
                                @endif
                            </div>
                            <div class="price-right">/ {{ language('frontend.page.landing.mobile_app.price.month') }}</div>
                        </h2>
                        <h6 class="sub-title">{{ language('frontend.page.landing.mobile_app.price.services_include') }}</h6>
                        <ul class="features">
                            {!! language('frontend.page.landing.mobile_app.price.plan_items3') !!}
                        </ul>
                        @if(language('frontend.page.landing.mobile_app.price.button_url3') != null)
                            <a href="{{ language('frontend.page.landing.mobile_app.price.button_url3') }}" class="theme-btn btn-style-one">
                                <span class="btn-title">
                                    {{ language('frontend.page.landing.mobile_app.price.button_txt3') }}
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
                <h2>{{ language('frontend.page.landing.mobile_app.faq.title') }}</h2>
            </div>
            <div class="row">

                <div class="faq-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <ul class="accordion-box wow fadeInRight">

                            <li class="accordion block active-block">
                                <div class="acc-btn active">{{ language('frontend.page.landing.mobile_app.faq.item.text1') }}
                                    <div class="icon fa fa-angle-down"></div>
                                </div>
                                <div class="acc-content current">
                                    <div class="content">
                                        <div class="text">{!! language('frontend.page.landing.mobile_app.faq.item.content1')  !!}</div>
                                    </div>
                                </div>
                            </li>

                            <li class="accordion block">
                                <div class="acc-btn">{{ language('frontend.page.landing.mobile_app.faq.item.text2') }}
                                    <div class="icon fa fa-angle-down"></div>
                                </div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">
                                            {!! language('frontend.page.landing.mobile_app.faq.item.content2')  !!}
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="accordion block">
                                <div class="acc-btn">{{ language('frontend.page.landing.mobile_app.faq.item.text3') }}
                                    <div class="icon fa fa-angle-down"></div>
                                </div>
                                <div class="acc-content">
                                    <div class="content">
                                        <div class="text">
                                            {!! language('frontend.page.landing.mobile_app.faq.item.content3')  !!}
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

    <!--  LIGHT GALLERY  -->
    <link rel='stylesheet' href='{{ asset('assets/plugins/photoswipe/4.1.1/css/photoswipe.min.css') }}'>
    <link rel='stylesheet' href='{{ asset('assets/plugins/lightgallery/css/lightgallery.min.css') }}'>

    <link href="{{ asset('frontend/assets/css/style-mobileapp.css?ver=10') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive-mobileapp.css?ver=8') }}" rel="stylesheet">



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
        .about-section-four{
            margin-top: 150px;
        }



        .btn-title:hover{
            color: #FFFFFF !important;
        }

        #lg-counter {
            display: none !important;
        }

        .pricing-block .inner-box{
            background-image: url({{ asset('frontend/assets/images/icons/price-bg.jpg?ver=2') }});
        }

        .pricing-block .inner-box::before {
            background-image: url({{ asset('frontend/assets/images/icons/price-hover-bg.jpg?ver=2') }});
        }


        .header-style-one::before {
            background: linear-gradient(#e76f32, transparent) !important;

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




    <!--  LIGHT GALLERY  -->
    <script src="{{ asset('assets/plugins/lightgallery/js/lightgallery-all-new.min.js') }}"></script>
    <script src='{{ asset('assets/plugins/lightgallery/js/picturefill.min.js') }}'></script>

    <script>
       $(function () {
           $('.my-projects-carousel').owlCarousel({
               rtl: THEMEMASCOT.isRTL.check(),
               loop: true,
               margin: 30,
               nav: false,
               smartSpeed: 400,
               autoplay: false,
               navText: ['<span class="fa fa-long-arrow-alt-left"></span>', '<span class="fa fa-long-arrow-alt-right"></span>'],
               responsive: {
                   0: {
                       items: 1
                   },
                   600: {
                       items: 1
                   },
                   767: {
                       items: 2
                   },
                   1023: {
                       items: 3
                   },
                   1200: {
                       items: 4
                   }
               },
               onInitialized: function() {

                   $('.project-block').each(function (index) {
                       $('.owl-item').eq(index + 1).attr('data-src',$(this).attr('data-src'));
                   })

                   $('.my-projects-carousel .owl-stage').lightGallery({
                       thumbnail: false,
                       share: false,
                       rotate: false,
                       download: false,
                   });
               }
           });


       })



    </script>
@endsection
