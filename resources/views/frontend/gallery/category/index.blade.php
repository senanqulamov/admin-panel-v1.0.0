@extends('frontend.layouts.index')

@section('title',empty(language('frontend.portfolio.title'))?language('general.title'):language('frontend.portfolio.title'))
@section('keywords', language('frontend.portfolio.keywords') )
@section('description', language('frontend.portfolio.description') )

@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title"
             style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.portfolio.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.portfolio.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.portfolio.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection
@section('content')

    <!-- Gallery Section -->
    <section>
        <div class="container" style="padding-bottom: 45px !important;">
            <div class="gallery-card-container">
                <div class="row">

                    @foreach($galleryCategories as $galleryCategory)
                    <div class="col-lg-6 col-md-12 category-card-item mb-50">
                        <a href="{{ route('frontend.portfolio.index',$galleryCategory->slug) }}" class="category-card-box">
                            <div class="gallery-category-circle"></div>
                            <h2>{{ $galleryCategory->name }}</h2>
                            <p>{{  Str::limit($galleryCategory->text, 90, '...') }}</p>
                            {!! $galleryCategory->icon !!}</i>
                        </a>
                    </div>
                    @endforeach

                </div>
            </div>


                @if(language('frontend.portfolio.content') != null)
                <div class="gallery-category-content mt-50">
                    {{ language('frontend.portfolio.content') }}
                </div>
                @endif

        </div>
    </section>
    <!-- End Gallery Section -->



    <!-- Projects section two-->
    <section class="projects-section-two p-0 mb-100">
        <div class="bg-image" style="background-image: url({{  \App\Services\ImageService::customImageReSize( asset('frontend/assets/images/background/portfolio-bg-4.jpg'), 1894, 663, 80, 'webp') }});  background-position: top center;"></div>
        <div class="auto-container">
            <div class="sec-title text-center light" style="padding-top: 25px">
                @if(language('frontend.home.portfolio.sub_title') != null)
                    <h2 >{{ language('frontend.home.portfolio.sub_title') }}</h2>
                @endif
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
