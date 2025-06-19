@extends('frontend.layouts.index')

@section('title',empty($blog->title) ? language('frontend.post.title').' - '.$blog->name : $blog->title)
@section('keywords', $blog->keyword )
@section('description', $blog->description  )


@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.post.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ $blog->name }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li><a href="{{ route('frontend.post.index') }}">{{ language('frontend.post.title') }}</a></li>
                    <li>{{ $blog->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

@endsection

@section('content')



    <!--Blog Details Start-->
    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-details__left">
                        <div class="blog-details__img">
                            <img src="{{ \App\Services\ImageService::customImageReSize($blog->image, 1176, 500, 80, 'webp') }}" alt="{{ $blog->name }}">
                            <div class="blog-details__date">
                                <span class="day">{{ Carbon\Carbon::parse($blog->created_at)->format('d') }}</span>
                                <span class="day mt-1">
                                    <?php $monday = Carbon\Carbon::parse($blog->created_at)->locale(request('currentLang'));  ?>
                                    {{ $monday->translatedFormat('M') }}
                                </span>
                                <span class="day mt-1">{{ Carbon\Carbon::parse($blog->created_at)->format('Y') }}</span>

                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h3 class="blog-details__title">{{ $blog->name }}</h3>
                            {!! $blog->text !!}
                        </div>

                    </div>
                </div>

            </div>
            <div class="row mt-70">
                <div class="sec-title">
                    <h2>{{ language('frontend.post.other_blogs') }}</h2>
                </div>

                @foreach($blogs as $blog)
                    <!-- News Block -->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('frontend.post.detail',$blog->slug) }}">
                                        <img src="{{ \App\Services\ImageService::customImageReSize($blog->image, 374, 299, 80, 'webp') }}" alt="{{ $blog->name }}">
                                    </a>
                                </figure>
                            </div>
                            <div class="content-box">
                                <span class="date">{{ Carbon\Carbon::parse($blog->created_at)->format('d.m.Y') }}</span>
                                <h5 class="title"><a href="{{ route('frontend.post.detail',$blog->slug) }}">{{ $blog->name }}</a></h5>
                                <div class="text">{!!   strip_tags(Str::limit($blog->text,60,'...'))  !!}</div>
                                <a href="{{ route('frontend.post.detail',$blog->slug) }}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i>
                                    {{ language('general.read_more') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--Blog Details End-->

@endsection

@section('CSS')

@endsection

@section('JS')


@endsection



