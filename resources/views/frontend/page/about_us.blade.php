@extends('frontend.layouts.index')

@section('title',empty(language('frontend.page.about_us.title'))?language('general.title'):language('frontend.page.about_us.title'))
@section('keywords', language('frontend.page.about_us.keywords') )
@section('description', language('frontend.page.about_us.description') )

@section('breadcrumb')
    <!-- Start main-content -->
        <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.page.about_us.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.page.about_us.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.page.about_us.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection
@section('content')
    <!-- About Section -->
    <section class="about-section">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight" data-wow-delay="600ms">
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
                                <a href="tel:{{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[0] }}" class="info-btn">
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
                            <img src="{!! \App\Services\ImageService::customImageReSize(language('frontend.home.about_us.image_1'), 460, 494, 80, 'webp')  !!}" alt="{{ language('general.title') }}">
                        </figure>
                        <figure class="image-2 overlay-anim wow fadeInRight">
                            <img src="{!! \App\Services\ImageService::customImageReSize(language('frontend.home.about_us.image_2'), 200, 254, 80, 'webp')  !!}" alt="{{ language('general.title') }}">
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

    @if(language('frontend.page.about_us.content') != null)
        <section class="about-us-section">
            <div class="auto-container">
                <div class="row">
                    <div class="col-md-12">
            {!! language('frontend.page.about_us.content') !!}
                    </div>
                </div>
            </div>
        </section>
    @endif


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
                                <h5 class="title"><a href="{{ route('frontend.service.detail',$service->slug) }}">{{ $service->name }}</a></h5>
                                <div class="text">{{  Str::limit($service->text, 60, '...') }}</div>
                                <a href="{{ route('frontend.service.detail',$service->slug) }}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i> {{ language('general.read_more') }}</a>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="bottom-box">
                    <div class="text">{!! language('frontend.home.services.text') !!}</div>
                    <a href="{{ route('frontend.service.index') }}" class="theme-btn btn-style-one"><span class="btn-title">{{ language('frontend.home.services.button_text') }}</span></a>
                </div>
            </div>
        </section>
    @endisset
    <!-- End Services Section-->



    <!-- Projects section two-->
    <section class="projects-section-two p-0">
        <div class="bg-image" style="background-image: url({{  \App\Services\ImageService::customImageReSize( asset('frontend/assets/images/background/portfolio-bg-4.jpg'), 1894, 663, 80, 'webp') }});  background-position: top center;"></div>
        <div class="auto-container">
            <div class="sec-title text-center light" style="padding-top: 50px">
                @if(language('frontend.home.portfolio.sub_title') != null)
                    <span class="sub-title">{{ language('frontend.home.portfolio.sub_title') }}</span>
                @endif
                <h2 >{{ language('frontend.home.portfolio.title') }}</h2>
            </div>

            <div class="carousel-outer">
                <div class="projects-carousel owl-carousel owl-theme">

                    @foreach($galleries as $gallery)
                        <div class="project-block">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">
                                            <img src="{{ \App\Services\ImageService::customImageReSize( $gallery->image, 400, 270, 80, 'webp') }}" alt="{{ $gallery->name }}">
                                        </a>
                                    </figure>
                                    <div class="info-box">
                                        <a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        <span class="cat">
                                        @foreach($gallery->galleriesCategoriesCheck as $galleryCategory)
                                                {{ $galleryCategory->name }}
                                                @if(!$loop->last),@endif
                                            @endforeach

                                    </span>
                                        <h6 class="title"><a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">{{ $gallery->name }}</a></h6>
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
                            <blockquote class="blockquote-one">{!! language('frontend.home.what_do_we_get.content_2') !!}</blockquote>
                        @endif
                        <div class="btn-box">
                            @if(language('frontend.home.what_do_we_get.video') != null)
                                <a href="{!!  language('frontend.home.what_do_we_get.video') !!}" class="play-now-two lightbox-image"><i class="icon fa fa-play"></i> {!! language('frontend.home.what_do_we_get.video_txt') !!}</a>
                            @endif
{{--                            <a href="{{ route('frontend.custom.page.aboutUs') }}" class="theme-btn btn-style-one"><span class="btn-title">{{ language('frontend.home.what_do_we_get.about_us_btn_txt') }}</span></a>--}}
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="image-box">
{{--                            <span class="bg-shape"></span>--}}
                            <figure class="image-1 overlay-anim wow fadeInUp">
                                <img src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.what_do_we_get.image_1'), 280, 277, 80, 'webp') }}" alt="{!! language('frontend.home.what_do_we_get.title') !!}">
                            </figure>
                            <figure class="image-2 overlay-anim wow fadeInRight">
                                <img src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.what_do_we_get.image_2'), 280, 277, 80, 'webp') }}" alt="{!! language('frontend.home.what_do_we_get.title') !!}">
                            </figure>
                            <figure class="image-3 overlay-anim wow fadeInRight">
                                <img src="{{ \App\Services\ImageService::customImageReSize(language('frontend.home.what_do_we_get.image_3'), 280, 423, 80, 'webp') }}" alt="{!! language('frontend.home.what_do_we_get.title') !!}">
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
                        <li class="slide-item"><img src="{{ $partner->image }}" alt="{{ $partner->name }}"> </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <a href="{{ route('frontend.partner.index') }}" class="theme-btn btn-style-one"><span class="btn-title">{{ language('frontend.home.partners.btn_text') }}</span></a>
            </div>
        </div>
    </section>
    <!--End Clients Section -->



@endsection

@section('CSS')
    <style>
        .about-us-section {
            margin-bottom: 80px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('JS')

@endsection
