@extends('frontend.layouts.index')

@section('title',empty($service->title) ? language('frontend.service.title').' - '.$service->name : $service->title)
@section('keywords', $service->keyword )
@section('description', $service->description  )


@section('breadcrumb')
    <!-- Start main-content -->
        <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.service.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ $service->name }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li><a href="{{ route('frontend.service.index') }}">{{ language('frontend.service.title') }}</a></li>
                    <li>{{ $service->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

@endsection

@section('content')

    <!--Start Services Details-->
    <section class="services-details">
        <div class="container">
            <div class="row">


                <!--Start Services Details Sidebar-->
                <div class="col-xl-4 col-lg-4">
                    <div class="service-sidebar">
                        <!--Start Services Details Sidebar Single-->
                        <div class="sidebar-widget service-sidebar-single">

                            <div class="sidebar-service-list">
                                <ul>
                                    @foreach($services as $serviceList)
                                    <li class="{{  request('slug') ==  $serviceList->slug ? 'current': '' }}"><a href="{{ route('frontend.service.detail',$serviceList->slug) }}" class="current"><i class="fas fa-angle-right"></i><span>{{ $serviceList->name }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="service-details-help">
                                <div class="help-shape-1"></div>
                                <div class="help-shape-2"></div>
                                <h2 class="help-title">{!! language('frontend.service.contact_title') !!}</h2>
                                <div class="help-icon">
                                    <span class=" lnr-icon-phone-handset"></span>
                                </div>
                                <div class="help-contact">
                                    <p>{{ language('frontend.service.need_help') }}</p>
                                    @if(json_decode(setting('tel'))[0]->tel)
                                        <a href="tel:{{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[0] }}">
                                            {{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[1] }}
                                        </a>
                                    @endif
                                </div>
                            </div>

{{--                            <!--Start Services Details Sidebar Single-->--}}
{{--                            @if(language('frontend.service.pdf') != null)--}}
{{--                            <div class="sidebar-widget service-sidebar-single mt-4">--}}
{{--                                <div class="service-sidebar-single-btn wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1200m">--}}
{{--                                    <a target="_blank" href="{!! language('frontend.service.pdf') !!}" class="theme-btn btn-style-one d-grid"><span class="btn-title"><span class="fas fa-file-pdf"></span> {{ language('frontend.service.pdf_text') }}</span></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endif--}}
                        </div>
                        <!--End Services Details Sidebar-->
                    </div>
                </div>

                <!--Start Services Details Content-->
                <div class="col-xl-8 col-lg-8">
                    <div class="services-details__content">
                        @if(!empty($service->image))
                        <img src="{{ \App\Services\ImageService::customImageReSize($service->image, 776, null, 80, 'webp') }}" alt="{{ $service->name }}">
                        @endif
                        <h3 class="mt-4">{{ $service->name }}</h3>
                        {!! $service->text !!}

                    </div>
                </div>
                <!--End Services Details Content-->
            </div>
        </div>
    </section>
    <!--End Services Details-->

@endsection

@section('CSS')
    <style>
        .sidebar-service-list li a {
            background-color: #F3F3F3;
        }
    </style>
@endsection

@section('JS')


@endsection



