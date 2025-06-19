@extends('frontend.layouts.index')

@section('title',empty(language('frontend.partner.title'))?language('general.title'):language('frontend.partner.title'))
@section('keywords', language('frontend.partner.keywords') )
@section('description', language('frontend.partner.description') )

@section('breadcrumb')
    <!-- Start main-content -->
        <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.partner.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.partner.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.partner.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection
@section('content')

    <!-- Clients Section   -->
    <section class="clients-section">
        <div class="auto-container">

            <div class="partners-container">
                <div class="row">
                    @foreach($partners as $partner)
                        <div class="col-md-3 col-sm-6">
                            <div class="partner-card">
                                <div class="partner-image">
                                    <img src="{{ $partner->image }}" alt="{{ $partner->name }}">
                                </div>
                                <h4 class="partner-name">{{ $partner->name }}</h4>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

        </div>
    </section>
    <!--End Clients Section -->

@endsection

@section('CSS')

@endsection

@section('JS')

@endsection
