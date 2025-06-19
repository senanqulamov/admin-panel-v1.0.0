@extends('frontend.layouts.index')

@section('title',empty($gallery->galleriesTranslations[0]->title) ? $gallery->galleriesTranslations[0]->name : $gallery->galleriesTranslations[0]->title)
@section('keywords', $gallery->galleriesTranslations[0]->keyword )
@section('description', $gallery->galleriesTranslations[0]->description  )


@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title"
             style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.portfolio.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.portfolio.title') }}
                    - {{ $gallery->galleriesTranslations[0]->name }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>
                        <a href="{{ route('frontend.portfolio.categories') }}">{{ language('frontend.portfolio.title') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.portfolio.index',$category->slug) }}">{{ $category->name }}</a>
                    </li>
                    <li>{{ $gallery->galleriesTranslations[0]->name }}</li>
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
            <div class="">
                <h2 class="portfolio-title">{{ $gallery->galleriesTranslations[0]->name }}</h2>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="project-details__top">
                        <div class="project-details__img">
                            <img
                                src="{{ \App\Services\ImageService::customImageReSize($gallery->image, 1176, 540, 80, 'webp') }}"
                                alt="{{ $gallery->galleriesTranslations[0]->name }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="portfolio-detail-content-top">
                        <div class="row portfolio-detail-content-container">
                            <!--  CLIENT  -->
                            <div class="col-md-4">
                                <p class="portfolio-detail-client">{{ language('frontend.portfolio.detail.client') }}</p>
                                <h4 class="portfolio-detail-name">{{ $gallery->galleriesTranslations[0]->name }}</h4>
                            </div>

                            @if(!empty($gallery->created))
                                <!--  CREATED  -->
                                <div class="col-md-4">
                                    <p class="portfolio-detail-client">{{ language('frontend.portfolio.detail.created') }}</p>
                                    <h4 class="portfolio-detail-name">{{ Carbon\Carbon::parse($gallery->created)->format('d.m.Y') }}</h4>
                                </div>
                            @endif


                            @if(isset($gallery->galleriesCategoriesCheck[0]->name))
                                <!--  CATEGORY  -->
                                <div class="col-md-4">
                                    <p class="portfolio-detail-client">{{ language('frontend.portfolio.detail.category') }}</p>
                                    <h4 class="portfolio-detail-name">
                                        <ul>
                                            @foreach($gallery->galleriesCategoriesCheck as $galleryCategory)
                                                <li>
                                                    <a href="{{ route('frontend.portfolio.index',$galleryCategory->slug) }}">{{ $galleryCategory->name }}</a>
                                                    @if(!$loop->last)
                                                        , &nbsp;
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </h4>
                                </div>
                            @endif

                            @if(!empty($gallery->site))
                                <!--  WEBSITE  -->
                                <div class="col-md-4">
                                    <p class="portfolio-detail-client">{{ language('frontend.portfolio.detail.website') }}</p>
                                    <h4 class="portfolio-detail-name">
                                        <a target="_blank" href="{{ $gallery->site }}">{{ $gallery->site }}</a>
                                    </h4>
                                </div>
                            @endif


                            @if(isset($gallery->getGalleryActivity->name))
                                <!--  ACTIVITY  -->
                                <div class="col-md-4">
                                    <p class="portfolio-detail-client">{{ language('frontend.portfolio.detail.activity') }}</p>
                                    <h4 class="portfolio-detail-name">{{ $gallery->getGalleryActivity->name }}</h4>
                                </div>
                            @endif

                            @if(isset($gallery->getGalleryCountry->name))
                                <!--  LOCATION  -->
                                <div class="col-md-4">
                                    <p class="portfolio-detail-client">{{ language('frontend.portfolio.detail.location') }}</p>
                                    <h4 class="portfolio-detail-name">{{ $gallery->getGalleryCountry->name }}</h4>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                @if(!empty($gallery->galleriesTranslations[0]->text))
                    <div class="col-md-12 mt-40">
                        <p>{!! $gallery->galleriesTranslations[0]->text !!}</p>
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="gallery-images-container">
                        @if(!empty($gallery->images))

                                <?php $filesLinks = json_decode($gallery->images, true)['link']; ?>
                            @foreach(json_decode($gallery->images,true)['type'] as $filesDataTypeKey => $filesDataTypeValue)

                                @if($filesDataTypeValue == 1)
                                    {{--                                        <?php--}}
                                    {{--                                        $galleryImg = \App\Services\ImageService::customImageReSize($filesLinks[$filesDataTypeKey], 1176, null, 80, 'webp');--}}
                                    {{--                                        ?>--}}

                                    <img
                                        src="{{ \App\Services\ImageService::customImageReSize($filesLinks[$filesDataTypeKey], null, null, 100, 'webp') }}"
                                        alt="{{ $gallery->galleriesTranslations[0]->name }}">

                                @endif


                                @if($filesDataTypeValue == 2)

                                    <iframe  class="mt-50 portfolio-video"  src="https://www.youtube.com/embed/{{ $filesLinks[$filesDataTypeKey] }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>

                                @endif

                            @endforeach

                        @endif
                    </div>
                </div>

            </div>
    </section>
    <!--Project Details End-->

    <!-- Projects section two-->



    @if(isset($otherGalleries[0]->galleriesTranslations[0]->name))
        <section class="projects-section-two p-0 mb-100">
            <div class="bg-image"
                 style="background-image: url({{  \App\Services\ImageService::customImageReSize( asset('frontend/assets/images/background/portfolio-bg-4.jpg'), 1894, 663, 80, 'webp') }});  background-position: top center;"></div>
            <div class="auto-container">
                <div class="sec-title text-center light">
                    <h2>{{ language('frontend.portfolio.detail.similar_portfolios') }}</h2>
                </div>

                <div class="carousel-outer">
                    <div class="projects-carousel owl-carousel owl-theme">

                        @foreach($otherGalleries as $otherGallery)
                            <div class="project-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a
                                                href="{{ route('frontend.portfolio.detail',$otherGallery->galleriesCategoriesCheck[0]->slug.'/'.$otherGallery->slug) }}">
                                                <img
                                                    src="{{ \App\Services\ImageService::customImageReSize( $otherGallery->image, 400, 270, 80, 'webp') }}"
                                                    alt="{{ $otherGallery->galleriesTranslations[0]->name }}">
                                            </a>
                                        </figure>
                                        <div class="info-box">
                                            <a href="{{ route('frontend.portfolio.detail',$otherGallery->galleriesCategoriesCheck[0]->slug.'/'.$otherGallery->slug) }}"
                                               class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                            <span class="cat">
                                        @foreach($otherGallery->galleriesCategoriesCheck as $galleryCategory)
                                                    {{ $galleryCategory->name }}
                                                    @if(!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach

                                    </span>
                                            <h6 class="title"><a
                                                    href="{{ route('frontend.portfolio.detail',$otherGallery->galleriesCategoriesCheck[0]->slug.'/'.$otherGallery->slug) }}">{{ $otherGallery->galleriesTranslations[0]->name }}</a>
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
    @endif
    <!-- End Projects Section -->

@endsection

@section('CSS')

@endsection

@section('JS')


@endsection



