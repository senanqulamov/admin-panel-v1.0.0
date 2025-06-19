@extends('frontend.layouts.index')

@section('title',empty(language('frontend.service.title'))?language('general.title'):language('frontend.service.title'))
@section('keywords', language('frontend.service.keywords') )
@section('description', language('frontend.service.description') )

@section('breadcrumb')
    <!-- Start main-content -->
        <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.service.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.service.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.service.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection
@section('content')


    <!-- Services Section -->
    @isset($services[0]->id)
        <section class="services-section pt-0 mt-120">
            <div class="auto-container">

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

            </div>
        </section>
    @endisset
    <!-- End Services Section-->


    <!-- Call To Action -->
    <section class="call-to-action">
        <div class="bg bg-pattern-8"></div>
        <div class="auto-container">
            <div class="outer-box wow fadeIn">
                <div class="title-box">
                    <h2 class="title">{!! language('frontend.home.contact.text') !!}</h2>
                </div>
                <div class="btn-box">
                    <a href="{{ route('frontend.home.contact') }}" class="theme-btn btn-style-one light"><span class="btn-title">{{ language('frontend.home.contact.btn_txt') }}</span></a>
                </div>
            </div>
        </div>
    </section>
    <!--End Call To Action -->


@endsection

@section('CSS')

@endsection

@section('JS')

@endsection
