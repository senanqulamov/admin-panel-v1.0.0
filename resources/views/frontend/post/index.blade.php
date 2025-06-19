@extends('frontend.layouts.index')

@section('title',empty(language('frontend.post.title'))?language('general.title'):language('frontend.post.title'))
@section('keywords', language('frontend.post.keywords') )
@section('description', language('frontend.post.description') )

@section('breadcrumb')
    <!-- Start main-content -->
        <section class="page-title" style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.post.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.post.title') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.post.title') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection
@section('content')

    <!-- News Section -->
    <section class="bg-silver-light">
        <div class="container pb-90">
            <div class="row">
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


            <!--  Paginate START -->
            <div class="my-pagination">
                <ul class="pagination">
                    {{ $blogs->appends(['search' => request('search')])
                               ->render('vendor.pagination.frontend.my-pagination') }}

                </ul>
            </div>

        </div>
    </section>
    <!--End News Section -->

@endsection

@section('CSS')

@endsection

@section('JS')

@endsection
