@extends('frontend.layouts.index')

@section('title',empty($category->title) ? language('frontend.portfolio.title').' - '.$category->name : $category->title)
@section('keywords', $category->keyword )
@section('description', $category->description  )

@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.portfolio.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.portfolio.title') }} - {{ $category->name }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li><a href="{{ route('frontend.portfolio.categories') }}">{{ language('frontend.portfolio.title') }}</a></li>
                    @if($parentCategory == null)
                    <li>{{ $category->name }}</li>
                    @else
                        <li><a href="{{ route('frontend.portfolio.index',$parentCategory->slug) }}">{{ $parentCategory->name }}</a></li>
                        <li>{{ $category->name }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection
@section('content')

    <!-- Gallery Section -->
    <section>
        <div class="container">


            @if(isset($category->childrens[0]->id))
                <div class="portfolio-type-container">{{ language('frontend.portfolio.type') }}</div>
                <div class="owl-carousel-categories owl-carousel owl-theme">

                    @foreach($category->childrens as $categoryChildren)

                        <a href="{{ route('frontend.portfolio.index',$categoryChildren->slug) }}" class="item">
                            <span>{{ $categoryChildren->name }}</span>
                        </a>
                    @endforeach



                </div>
            @endif


            <div class="portfolio-container">
                @foreach($galleries as $gallery)

                    <div class="portfolio-item">
                        <figure>
                            <a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">
                                <img
                                    src="{{ \App\Services\ImageService::customImageReSize($gallery->image, 680, 420, 80, 'webp') }}"
                                    alt="{{ $gallery->galleriesTranslations[0]->name }}">
                            </a>
                        </figure>
                        <div class="portfolio-title-box">
                            <div class="portfolio-title-caption">
                                <h3>
                                    <a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">
                                    {{ $gallery->galleriesTranslations[0]->name }}
                                    </a>
                                </h3>

                                @if(isset($gallery->getGalleryActivity->name))
                                <div class="gallery-activity">
                                    {{ $gallery->getGalleryActivity->name }}
                                </div>
                                @endif

                                @if(!empty($gallery->site))
                                <div class="gallery-activity">
{{--                                    {{ str_replace(['https://','http://'],['',''],$gallery->site) }}--}}
                                    {{ Carbon\Carbon::parse($gallery->created)->format('d.m.Y') }}
                                </div>
                                @endif

                            </div>
                            <div class="portfolio-title-item">
                                <div class="portfolio-name-box">
                                    <a class="portfolio-name-icon" href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}"><i class="fa fa-long-arrow-alt-right"></i></a>
                                    <h4 class="portfolio-name">

                                        @foreach($gallery->galleriesCategoriesCheck as $galleryCategory)
                                            @if($loop->first)
                                                {{ $galleryCategory->name }}
                                            @endif
                                        @endforeach

                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach

            </div>
            <!--  Paginate START -->
            <div class="my-pagination">
                <ul class="pagination">
                    {{ $galleries->appends(['search' => request('search')])
                               ->render('vendor.pagination.frontend.my-pagination') }}
                </ul>
            </div>

        </div>
    </section>
    <!-- End Gallery Section -->


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
        .container{
            padding-bottom: 0px !important;
            padding-top: 0 !important;
        }
    </style>
@endsection

@section('JS')

    <script>
        $('.owl-carousel-categories').owlCarousel({
            loop:false,
            margin:10,
            autoWidth:true,
            nav:false,
            responsive:{
                // 0:{
                //     items:2
                // },
                600:{
                    items:4
                },
                1000:{
                    items:6
                }
            }
        })
    </script>

@endsection
