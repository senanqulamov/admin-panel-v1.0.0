@extends('frontend.layouts.index')

@section('title',empty(language('general.title'))?language('general.home'):language('general.title'))
@section('keywords', language('general.keyword') )
@section('description', language('general.description') )

@section('content')

    <!--Main Slider-->
    <!-- slider Section -->
    <section class="banner-section">
        {{--        <video  autoplay muted loop>--}}
        {{--            <source src="{{ language('frontend.home.header.video.webm') }}" type="video/webm">--}}
        {{--            <source src="{{ language('frontend.home.header.video.mp4') }}" type="video/mp4">--}}
        {{--            Your browser does not support the video tag.--}}
        {{--        </video>--}}

        {{--        <div class="banner-carousel owl-carousel owl-theme" >--}}

        {{--            @foreach($slides as  $slide)--}}
        {{--            <!-- Slide Item -->--}}
        {{--            <div class="slide-item">--}}
        {{--                <div class="bg-image" ></div>--}}
        {{--                <div class="auto-container">--}}
        {{--                    <div class="content-box">--}}
        {{--                        <h1 class="title animate-2">--}}
        {{--                            {!! $slide->title !!}--}}
        {{--                        </h1>--}}
        {{--                        <div class="btn-box animate-3">--}}
        {{--                            @if(!empty($slide->button_name))--}}
        {{--                            <a href="{{ $slide->button_url }}" class="theme-btn btn-style-one "><span class="btn-title">{{ $slide->button_name }}</span></a>--}}
        {{--                            @endif--}}
        {{--                            @if(!empty(language('frontend.home.header.contact_text'))) <a href="{{ route('frontend.home.contact') }}" class="theme-btn btn-style-one light"><span class="btn-title">{!! language('frontend.home.header.contact_text') !!}</span></a>@endif--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            @endforeach--}}
        {{--        </div>--}}


        <section class="home-banner">
            <div class="custom-container">

                <div class="anim_line">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="row">
                    <div
                        class="col-lg-5 col-xl-7 d-flex flex-column justify-content-center align-items-start first-child">
                        <div class="text-carousel" id="banner-text-carousel">
                            @foreach($slides as $slide)

                                <div class="passive
                                 @if($loop->first)
                                    active
                                 @endif
                                 text-slide text-slide-{{$slide->id}}">
                                    @if( $slide->title != null)
                                        <span class="banner-title">
                                        {!! $slide->title !!}
                                        </span>
                                    @endif

                                    @if( $slide->sub_title != null)
                                        <span class="banner-subtitle">
                                    {!! $slide->sub_title !!}
                                    </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @foreach($slides as $slide)
                            <div class="buttons-container passiveButtons buttons-slide-{{$slide->id}}
                            @if($loop->first)
                             activeButtons
                            @endif
                            ">
                                <a href="{{$slide->button_url}}">
                                    <i class="fa-regular fa-arrow-right"></i>
                                    {{$slide->button_name}}
                                </a>
                                <a href="/contact" >
                                    <i class="fa-regular fa-phone"></i>
                                    {{language('frontend.home.header.contact_text')}}
                                </a>
                            </div>

                        @endforeach
                    </div>
                    <div class="col-lg-7 col-xl-5 relative d-flex justify-content-center align-items-center last-child">
                        <div class="image-container">

                        </div>

                        <div class="slide-container">
                            <img
                                src="{{language('frontend.home.header.backgroundImage_phone')}}"
                                alt="bg-image"
                                class="bg-image"/>
                            {{--Slides--}}
                            <div class="banner-carousel owl-carousel owl-theme">

                                @foreach($slides as  $slide)
                                    <!-- Slide Item -->
                                    <div class="slide-item" data-slide="{{$slide->id}}" data-color="{{$slide->color}}">
                                        <img
                                            src="{!! \App\Services\ImageService::customImageReSize($slide->image, null, null, 100, 'webp')  !!}"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <!-- wave animation start -->
        {{--        <div class="marginTopMinus">--}}
        {{--            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
        {{--                 viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">--}}
        {{--                <defs>--}}
        {{--                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />--}}
        {{--                </defs>--}}
        {{--                <g class="parallax">--}}
        {{--                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />--}}
        {{--                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />--}}
        {{--                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />--}}
        {{--                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#f6f4fe" />--}}
        {{--                </g>--}}
        {{--            </svg>--}}
        {{--        </div>--}}
        <!-- wave animation end -->

    </section>
    <!-- End slider Section -->
    <!-- End Main Slider-->

    <!-- Features Section -->
    <section class="features-section-two">
        <div class="auto-container">
            <div class="outer-box">
                <div class="row">
                    <!-- Feature Block Two -->
                    <div class="feature-block-two col-lg-4 col-md-12 col-sm-12">
                        <div class="inner-box overlay-anim">
                            <div class="content">
                                <span class="icon">{!! language('frontend.home.slider.alt.box.icon_1') !!}</span>
                                <h6 class="title">{!! language('frontend.home.slider.alt.box.title_1') !!}</h6>
                                <div class="text">{!! language('frontend.home.slider.alt.box.sub_title_1') !!}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Block Two -->
                    <div class="feature-block-two col-lg-4 col-md-12 col-sm-12">
                        <div class="inner-box overlay-anim">
                            <div class="content">
                                <span class="icon">{!! language('frontend.home.slider.alt.box.icon_2') !!}</span>
                                <h6 class="title">{!! language('frontend.home.slider.alt.box.title_2') !!}</h6>
                                <div class="text">{!! language('frontend.home.slider.alt.box.sub_title_2') !!}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Feature Block Two -->
                    <div class="feature-block-two col-lg-4 col-md-12 col-sm-12">
                        <div class="inner-box overlay-anim">
                            <div class="content">
                                <span class="icon">{!! language('frontend.home.slider.alt.box.icon_3') !!}</span>
                                <h6 class="title">{!! language('frontend.home.slider.alt.box.title_3') !!}</h6>
                                <div class="text">{!! language('frontend.home.slider.alt.box.sub_title_3') !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Offer Section -->


    <!-- About Section -->
    <section class="about-section">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight"
                     data-wow-delay="600ms">
                    <div class="inner-column">
                        <div class="sec-title">
                            @if(language('frontend.home.about_us.sub_title') != null)
                                <span class="sub-title">{{ language('frontend.home.about_us.sub_title') }}</span>
                            @endif
                            <h2>{!! language('frontend.home.about_us.title') !!}</h2>
                            <div class="text">{!! language('frontend.home.about_us.content') !!}</div>
                        </div>

                        {!! str_replace(['<ul>','<li>'], ['<ul class="list-style-two">','<li><i class="fa fa-check-circle"></i>'],language('frontend.home.about_us.content_list')) !!}

                        <div class="btn-box">
                            @if(json_decode(setting('tel'))[0]->tel)
                                <a href="tel:{{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[0] }}"
                                   class="info-btn">
                                    <i class="icon fa fa-phone"></i>
                                    <small>{!! language('frontend.home.header.call_anytime') !!}</small>
                                    {{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[1] }}
                                </a>
                            @endif

                            {{--                            <a href="{{ route('frontend.home.contact') }}" class="theme-btn btn-style-one"><span class="btn-title">{!! language('frontend.home.about_us.contact_text') !!}</span></a>--}}
                        </div>


                    </div>
                </div>


                <!-- Image Column -->
                <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <figure class="image-1 overlay-anim wow fadeInUp">
                            <img
                                src="{!! \App\Services\ImageService::customImageReSize(language('frontend.home.about_us.image_1'), 460, 494, 100, 'webp')  !!}"
                                alt="{{ language('general.title') }}">
                        </figure>
                        <figure class="image-2 overlay-anim wow fadeInRight">
                            <img
                                src="{!! \App\Services\ImageService::customImageReSize(language('frontend.home.about_us.image_2'), 200, 254, 100, 'webp')  !!}"
                                alt="{{ language('general.title') }}">
                        </figure>
                        <div class="experience bounce-y">
                            <div class="inner">

                                {!! str_replace(['class="'], ['class="icon '],language('frontend.home.about_us.image.box.icon')) !!}
                                <div class="text">
                                    {!! language('frontend.home.about_us.image.box.text') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Emd About Section -->

    <!-- Services Section -->
    @isset($services[0]->id)
        <section class="services-section pt-0">
            <div class="auto-container">
                <div class="sec-title text-center">
                    @if(language('frontend.home.services.sub_title') != null)
                        <span class="sub-title">{{ language('frontend.home.services.sub_title') }}</span>
                    @endif
                    <h2>{!! language('frontend.home.services.title') !!}</h2>
                </div>

                <div class="row">

                    <!-- Service Block -->
                    @foreach($services as $service)
                        <div class="service-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                            <div class="inner-box">
                                <div class="icon-box">{!! str_replace('class="','class="icon ',$service->icon) !!}</div>
                                <h5 class="title"><a
                                        href="{{ route('frontend.service.detail',$service->slug) }}">{{ $service->name }}</a>
                                </h5>
                                <div class="text">{{  Str::limit($service->text, 60, '...') }}</div>
                                <a href="{{ route('frontend.service.detail',$service->slug) }}" class="read-more"><i
                                        class="fa fa-long-arrow-alt-right"></i> {{ language('general.read_more') }}
                                </a>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="bottom-box">
                    <div class="text">{!! language('frontend.home.services.text') !!}</div>
                    <a href="{{ route('frontend.service.index') }}" class="theme-btn btn-style-one"><span
                            class="btn-title">{{ language('frontend.home.services.button_text') }}</span></a>
                </div>
            </div>
        </section>
    @endisset
    <!-- End Services Section-->

    <!-- Why Choose Us Two -->
    <section class="why-choose-us-two pt-0">
        <div class="auto-container">
            <div class="sec-title">
                <div class="row">
                    <div class="col-lg-6">
                        @if(language('frontend.home.how_we_do.sub_title') != null)
                            <span class="sub-title">{{ language('frontend.home.how_we_do.sub_title') }}</span>
                        @endif
                        <h2>{!! language('frontend.home.how_we_do.title') !!}</h2>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end">
                        <div class="text">
                            {!! language('frontend.home.how_we_do.content') !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight"
                     data-wow-delay="600ms">
                    <div class="inner-column">
                        <!-- Feature Block Six -->
                        <div class="feature-block-six">
                            <div class="inner-box">
                                <span class="icon">{!! language('frontend.home.how_we_do.section_1.icon') !!}</span>
                                <h5 class="title">{{ language('frontend.home.how_we_do.section_1.title') }}</h5>
                                <div class="text">{{ language('frontend.home.how_we_do.section_1.text') }}</div>
                            </div>
                        </div>

                        <!-- Feature Block Six -->
                        <div class="feature-block-six">
                            <div class="inner-box">
                                <span class="icon">{!! language('frontend.home.how_we_do.section_2.icon') !!}</span>
                                <h5 class="title">{{ language('frontend.home.how_we_do.section_2.title') }}</h5>
                                <div class="text">{{ language('frontend.home.how_we_do.section_2.text') }}</div>
                            </div>
                        </div>

                        {{--                        <!-- Feature Block Six -->--}}
                        {{--                        <div class="feature-block-six">--}}
                        {{--                            <div class="inner-box">--}}
                        {{--                                <span class="icon">{!! language('frontend.home.how_we_do.section_3.icon') !!}</span>--}}
                        {{--                                <h5 class="title">{{ language('frontend.home.how_we_do.section_3.title') }}</h5>--}}
                        {{--                                <div class="text">{{ language('frontend.home.how_we_do.section_3.text') }}</div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="image-box">
                            <figure class="image-1 overlay-anim wow fadeInUp">
                                <img
                                    src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.how_we_do.image_1'), 280, 526, 80, 'webp') }}"
                                    alt="{!! language('frontend.home.how_we_do.title') !!}">
                            </figure>
                            <figure class="image-2 overlay-anim wow fadeInRight">
                                <img
                                    src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.how_we_do.image_2'), 280, 526, 80, 'webp') }}"
                                    alt="{!! language('frontend.home.how_we_do.title') !!}">
                            </figure>
                            {{--                            <figure class="logo">--}}
                            {{--                                <img width="192" src="{{ asset('frontend/assets/images/logo-light.svg') }}" alt="{!! language('frontend.home.how_we_do.title') !!}">--}}
                            {{--                            </figure>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Emd Why Choose Us -->

    <!-- Projects section two-->
    <section class="projects-section-two p-0">
        <div class="bg-image"
             style="background-image: url({{  \App\Services\ImageService::customImageReSize( asset('frontend/assets/images/background/portfolio-bg-4.jpg'), 1894, 663, 80, 'webp') }});  background-position: top center;"></div>
        <div class="auto-container">
            <div class="sec-title text-center light" style="padding-top: 50px">
                @if(language('frontend.home.portfolio.sub_title') != null)
                    <span class="sub-title">{{ language('frontend.home.portfolio.sub_title') }}</span>
                @endif
                <h2>{{ language('frontend.home.portfolio.title') }}</h2>
            </div>

            <div class="carousel-outer">
                <div class="projects-carousel owl-carousel owl-theme">

                    @foreach($galleries as $gallery)
                        <div class="project-block">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a
                                            href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">
                                            <img
                                                src="{{ \App\Services\ImageService::customImageReSize( $gallery->image, 400, 270, 80, 'webp') }}"
                                                alt="{{ $gallery->name }}">
                                        </a>
                                    </figure>
                                    <div class="info-box">
                                        <a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}"
                                           class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        <span class="cat">
                                        @foreach($gallery->galleriesCategoriesCheck as $galleryCategory)
                                                {{ $galleryCategory->name }}
                                                @if(!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach

                                    </span>
                                        <h6 class="title"><a
                                                href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">{{ $gallery->name }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Projects Section -->

    <!-- Why Choose Us -->
    <section class="why-choose-us">
        <div class="bg bg-pattern-2"></div>
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight"
                     data-wow-delay="600ms">
                    <div class="inner-column">
                        <div class="sec-title">
                            @if(language('frontend.home.what_do_we_get.sub_title') != null)
                                <span class="sub-title">{{ language('frontend.home.what_do_we_get.sub_title') }}</span>
                            @endif
                            <h2>{{ language('frontend.home.what_do_we_get.title') }}</h2>
                            <div class="text">
                                {!! language('frontend.home.what_do_we_get.content_1') !!}
                            </div>
                        </div>

                        @if(language('frontend.home.what_do_we_get.content_2') != null)
                            <blockquote
                                class="blockquote-one">{!! language('frontend.home.what_do_we_get.content_2') !!}</blockquote>
                        @endif
                        <div class="btn-box">
                            {{--                            @if(language('frontend.home.what_do_we_get.video') != null)--}}
                            {{--                            <a href="{!!  language('frontend.home.what_do_we_get.video') !!}" class="play-now-two lightbox-image"><i class="icon fa fa-play"></i> {!! language('frontend.home.what_do_we_get.video_txt') !!}</a>--}}
                            {{--                            @endif--}}
                            <a href="{{ route('frontend.custom.page.aboutUs') }}" class="theme-btn btn-style-one"><span
                                    class="btn-title">{{ language('frontend.home.what_do_we_get.about_us_btn_txt') }}</span></a>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="image-box">
                            {{--                            <span class="bg-shape"></span>--}}
                            <figure class="image-1 overlay-anim wow fadeInUp">
                                <img
                                    src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.what_do_we_get.image_1'), 280, 277, 80, 'webp') }}"
                                    alt="{!! language('frontend.home.what_do_we_get.title') !!}">
                            </figure>
                            <figure class="image-2 overlay-anim wow fadeInRight">
                                <img
                                    src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.what_do_we_get.image_2'), 280, 277, 80, 'webp') }}"
                                    alt="{!! language('frontend.home.what_do_we_get.title') !!}">
                            </figure>
                            <figure class="image-3 overlay-anim wow fadeInRight">
                                <img
                                    src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.what_do_we_get.image_3'), 280, 423, 80, 'webp') }}"
                                    alt="{!! language('frontend.home.what_do_we_get.title') !!}">
                            </figure>
                            {{--                            <figure class="logo">--}}
                            {{--                                <img width="250" src="{{ asset('frontend/assets/images/logo-light.svg') }}" alt="{!! language('frontend.home.how_we_do.title') !!}">--}}
                            {{--                            </figure>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Emd Why Choose Us -->


    <!-- Clients Section   -->
    <section class="clients-section">
        <div class="auto-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sec-title text-center">
                        @if(language('frontend.home.partners.sub_title') != null)
                            <span class="sub-title">{{ language('frontend.home.partners.sub_title') }}</span>
                        @endif
                        <h2>{{ language('frontend.home.partners.title') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Sponsors Outer -->
            <div class="sponsors-outer">
                <!--clients carousel-->
                <ul class="clients-carousel owl-carousel owl-theme">
                    @foreach($partners as $partner)
                        <li class="slide-item"><img src="{{ $partner->image }}" alt="{{ $partner->name }}"></li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <a href="{{ route('frontend.partner.index') }}" class="theme-btn btn-style-one"><span
                        class="btn-title">{{ language('frontend.home.partners.btn_text') }}</span></a>
            </div>
        </div>
    </section>
    <!--End Clients Section -->



    <!-- News Section -->
    <section class="news-section">
        <div class="bg bg-pattern-6"></div>
        <div class="auto-container">
            <div class="sec-title text-center">
                @if(language('frontend.home.blog.sub_title') != null)
                    <span class="sub-title">{{ language('frontend.home.blog.sub_title') }}</span>
                @endif
                <h2>{{ language('frontend.home.blog.title') }}</h2>
            </div>

            <div class="row">

                @foreach($blogs as $blog)
                    <!-- News Block -->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('frontend.post.detail',$blog->slug) }}">
                                        <img
                                            src="{{ \App\Services\ImageService::customImageReSize($blog->image, 374, 299, 80, 'webp') }}"
                                            alt="{{ $blog->name }}">
                                    </a>
                                </figure>
                            </div>
                            <div class="content-box">
                                <span class="date">{{ Carbon\Carbon::parse($blog->created_at)->format('d.m.Y') }}</span>
                                <h5 class="title"><a
                                        href="{{ route('frontend.post.detail',$blog->slug) }}">{{ $blog->name }}</a>
                                </h5>
                                <div class="text">{!!   strip_tags(Str::limit($blog->text,60,'...'))  !!}</div>
                                <a href="{{ route('frontend.post.detail',$blog->slug) }}" class="read-more"><i
                                        class="fa fa-long-arrow-alt-right"></i>
                                    {{ language('general.read_more') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--End News Section -->

    <!-- Contact Section -->
    <section class="contact-section pt-0 pb-0">
        <div class="auto-container">
            <div class="row">
                <!-- Form Column -->
                <div class="form-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Contact Form -->
                        <div class="contact-form wow fadeInLeft">
                            <div class="sec-title">
                                @if(language('frontend.home.contact.sub_title') != null)
                                    <span class="sub-title">{{ language('frontend.home.contact.sub_title') }}</span>
                                @endif
                                <h2>{{ language('frontend.home.contact.title') }}</h2>
                            </div>

                            <!--Contact Form-->
                            <form id="contact-form">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" class="checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_name') }}"
                                               autocomplete="OFF" id="name" name="name"
                                               placeholder="{{ language('frontend.contact.form_name') }}">
                                    </div>

                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" class=""
                                               data-validation-message="{{ language('frontend.contact.form_error_email') }}"
                                               autocomplete="OFF" id="email" name="email"
                                               placeholder="{{ language('frontend.contact.form_email') }}">

                                    </div>
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" class="checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_tel') }}"
                                               autocomplete="OFF" id="mobil" name="mobil"
                                               placeholder="{{ language('frontend.contact.form_mobil') }}">

                                    </div>
                                    <div class="form-group col-lg-6 col-md-12 col-sm-12">
                                        <input type="text" class="checkForm"
                                               data-validation-message="{{ language('frontend.contact.form_error_subject') }}"
                                               autocomplete="OFF" id="subject" name="subject"
                                               placeholder="{{ language('frontend.contact.form_subject') }}">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <textarea class="checkForm"
                                                  data-validation-message="{{ language('frontend.contact.form_error_text') }}"
                                                  autocomplete="OFF" id="text" name="text"
                                                  placeholder="{{ language('frontend.contact.form_text') }}"></textarea>
                                    </div>

                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="cf-box">
                                            <div class="submit-form-error mb-4" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger">
                                                            <ul></ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="submit-form-success mb-4" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-success"></div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group col-lg-12 mb-5">

                                                <button id="submitForm"
                                                        class="cont-submit btn-contact theme-btn btn-style-one">
                                                    <span
                                                        class="submitForm btn-title">{{ language('frontend.contact.form_submit') }}</span>
                                                    <div class="spinner-box">
                                                        <span>{{ language('frontend.contact.form_submit_sending') }}</span>
                                                        <span><div id="spinner"></div></span>
                                                    </div>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!--End Contact Form -->

                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12">
                    <div class="inner-column">
                        <figure class="image">
                            {{--                            <img src="{{ asset('frontend/assets/images/resource/contact.jpg') }}" alt="">--}}
                            {!! setting('map') !!}
                        </figure>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Info Section -->

    <!-- Call To Action -->
    <section class="call-to-action">
        <div class="bg bg-pattern-8"></div>
        <div class="auto-container">
            <div class="outer-box wow fadeIn">
                <div class="title-box">
                    <h2 class="title">{!! language('frontend.home.contact.text') !!}</h2>
                </div>
                <div class="btn-box">
                    <a href="{{ route('frontend.home.contact') }}" class="theme-btn btn-style-one light"><span
                            class="btn-title">{{ language('frontend.home.contact.btn_txt') }}</span></a>
                </div>
            </div>
        </div>
    </section>
    <!--End Call To Action -->

@endsection

@section('CSS')
    <style>

        .spinner-box {
            display: none;
            justify-content: center;
            align-items: center;
        }

        .spinner-box span:first-child {
            margin-right: 10px;
        }

        @keyframes spinner {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }


        #spinner {
            position: relative;
            width: 30px;
            height: 30px;
            min-width: 30px;
            min-height: 30px;
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-right: 5px solid #ffffff;
            border-radius: 50%;
            animation: spinner 1s linear infinite;
        }
    </style>
@endsection

@section('JS')
    <!--  SUBMIT START  -->
    <script>
        var nameFieldRequiredTranslate = "{!! language('frontend.contact.form_error_name') !!}";
        var emailFieldRequiredTranslate = "{!!  language('frontend.contact.form_error_email') !!}";
        var subjectFieldRequiredTranslate = "{!!  language('frontend.contact.form_error_subject') !!}";
        var telFieldRequiredTranslate = "{!! language('frontend.contact.form_error_tel') !!}";
        var textFieldRequiredTranslate = "{!! language('frontend.contact.form_error_text') !!}";
        var successTranslate = "{!! language('frontend.contact.form_submit_success') !!}";
    </script>

    <script>
        $(function () {

            /*   ERROR MESSAGE   */
            function errorFormSend(text) {
                $('.submit-form-error ul').append('<li>' + text + '</li>');
            }


            /*   INPUTLRA TIKLANDIQDA ALERTLERI BAGLA   */
            $(document).on('click', 'input, textarea', function () {
                $('.submit-form-error').hide();
                $('.submit-form-error ul').html('');
                $('.submit-form-success').hide();
                $('.submit-form-error .alert-success').html('');
            })


            /*   SUBMIT BUTTONUNA TIKLANDIQDA   */
            $(document).on('click', '#submitForm', function (event) {
                event.preventDefault();

                /*   SUBMIT BUTTONUNA TIKLANDIQDA ALERTLERI BAGLA   */
                $('.submit-form-error ul').html('');
                $('.submit-form-error').hide();
                $('.submit-form-error .alert-success').html('');
                $('.submit-form-success').hide();


                /*   DATALARI AL   */
                var name = $('#name').val();
                var subject = $('#subject').val();
                var email = $('#email').val();
                var mobil = $('#mobil').val();
                var text = $('#text').val();


                /*   ERROR OLDUQUNU CHECK ET   */
                $(".checkForm").each(function () {
                    if ($(this).val() == "") {
                        $('.submit-form-error').fadeIn();
                        errorFormSend($(this).attr('data-validation-message'))
                    }
                });

                /*   EGER ERROR YOXDURSA SUBMIT ET   */
                if (name != "" && subject != "" && mobil != "" && text != "") {

                    $('.submitForm').hide();
                    $('.spinner-box').css('display', 'flex');

                    $.ajax({
                        url: "{{ route('frontend.home.contactSendAjax') }}",
                        type: 'POST',
                        data: {
                            name: name,
                            subject: subject,
                            email: email,
                            mobil: mobil,
                            text: text,
                        },
                        dataType: 'JSON',
                        success: function (data) {

                            /*   EGER ERROR VARSA RESPONSE OLARAQ ALERTE YAZ   */
                            if (data.error == true) {
                                $('.submit-form-error ul').html('');
                                $.each(data.data, function (index, value) {
                                    $('.submit-form-error').fadeIn();
                                    errorFormSend(value)
                                });

                                $('.submitForm').show();
                                $('.spinner-box').css('display', 'none');
                            }

                            /*   EGER DOGRUDURSA ALERTE YAZ VE TEMIZLE   */
                            if (data.success == true) {
                                $('.submit-form-success').fadeIn();
                                $('.submit-form-success .alert-success').html(successTranslate);

                                $(".checkForm").each(function () {
                                    $(this).val('');
                                });

                                $('#subject').val('');
                                $('#email').val('');

                                $('.submitForm').show();
                                $('.spinner-box').css('display', 'none');
                            }


                        }
                    });
                }


            })

        })
    </script>
    <!--  SUBMIT END  -->

@endsection
