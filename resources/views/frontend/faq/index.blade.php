@extends('frontend.layouts.index')

@section('title',empty(language('frontend.faq.title'))?language('general.title'):language('frontend.faq.title'))
@section('keywords', language('frontend.faq.keywords') )
@section('description', language('frontend.faq.description') )

@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title"
             style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.faq.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.faq.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.faq.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection

@section('content')

    <!-- FAQ Section -->
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="accordion-box wow fadeInRight">

                        @foreach($faqs as $faq)
                            <!--Block-->
                            <li class="accordion block {{ $loop->first ? 'active-block' : ''  }}">
                                <div class="acc-btn {{ $loop->first ? 'active' : ''  }}">{{ $faq->title }}
                                    <div class="icon fa fa-plus"></div>
                                </div>
                                <div class="acc-content {{ $loop->first ? 'current' : ''  }}">
                                    <div class="content">
                                        <div class="text">{!! $faq->text !!}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--End FAQ Section -->

@endsection

@section('CSS')

@endsection

@section('JS')

@endsection
