@extends('frontend.layouts.index')

@section('title',empty($page->title) ? $page->name : $page->title)
@section('keywords', $page->keyword )
@section('description', $page->description )




@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title"
             style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.page.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ $page->name }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ $page->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

@endsection


@section('content')

    <!--Project Details Start-->
    <section class="project-details">
        <div class="container">
            <div class="row">

                <?php $pageImage = ''; ?>
                @if(!empty($page->image))
                        <?php $pageImage = \App\Services\ImageService::customImageReSize($page->image, 1176, null, 80, 'webp'); ?>
                @endif



                @if(!empty($pageImage))
                    <div class="col-xl-12">
                        <div class="project-details__top">
                            <div class="project-details__img">
                                <img src="{{ $pageImage }}" alt="{{ $page->name }}">
                            </div>
                        </div>
                    </div>
                @endif


                <div class="page-content mt-30">
                    <p>{!!  $page->text !!}</p>
                </div>


            </div>
    </section>
    <!--Project Details End-->

@endsection

@section('CSS')

@endsection

@section('JS')

@endsection

