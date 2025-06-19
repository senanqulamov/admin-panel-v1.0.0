<!-- Main Footer -->
<footer class="main-footer">
{{--    <div class="bg bg-pattern-9"></div>--}}
    <!--Widgets Section-->
    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">
                <!--Footer Column-->
                <div class="footer-column col-xl-3 col-lg-12 col-md-12">
                    <div class="footer-widget about-widget">
                        <div class="logo">
                            <a href="{{ route('frontend.home.index') }}"><img src="{{ asset('storage') }}/{{ setting('logo') }}" alt="{{ language('general.title') }}"></a>
                        </div>


                        <div class="text">{!! language('frontend.footer.content') !!}</div>
                        @if(!empty(json_decode(setting('social'))))
                        <ul class="social-icon-two">
                            @foreach(json_decode(setting('social')) as $key => $value)
                            <li>
                                <a {{ isset($value->status) ? 'target="_blank"': ''  }}  href="{{ $value->link }}">
                                    <i class="socicon-{{ $value->name }}"></i>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-xl-3 col-lg-4 col-md-4">
                    <div class="footer-widget links-widget">
                        <h6 class="widget-title">{{ language('frontend.footer.service_title') }}</h6>
                        <ul class="user-links">
                            @foreach(\App\Services\ServicesService::getServices(request('languageID'),6) as $service)
                            <li>
                                <a href="{{ route('frontend.service.detail',$service->slug) }}">
                                    {{ $service->servicesTranslations[0]->name ?? '' }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-xl-3 col-lg-4 col-md-4 col-sm-8">
                    <div class="footer-widget gallery-widget">
                        <h6 class="widget-title">{{ language('frontend.footer.portfolio_title') }}</h6>
{{--                        <h6 class="widget-title">{{ language('frontend.footer.instagram') }}</h6>--}}
                        <div class="widget-content">
                            <div class="outer clearfix">



                                @foreach(\App\Services\GalleryService::getGalleriesForFooter(request('languageID'),6) as $gallery)

                                <figure class="image">
                                    <a href="{{ route('frontend.portfolio.detail',$gallery->galleriesCategoriesCheck[0]->slug.'/'.$gallery->slug) }}">
                                        <img src="{{ \App\Services\ImageService::customImageReSize( $gallery->image, 81, 81, 80, 'webp') }}" alt="{{ $gallery->name }}">
                                    </a>
                                </figure>
                                @endforeach


{{--                                @foreach(\App\Services\CommonService::getInstagramImages()['images'] as $instagramImageKey => $instagramImageValue)--}}

{{--                                    <figure class="image">--}}
{{--                                        <a target="_blank" href="{{ \App\Services\CommonService::getInstagramImages()['links'][$instagramImageKey] }}">--}}
{{--                                            <img src="{{ \App\Services\ImageService::customImageReSize( $instagramImageValue, 81, 81, 80, 'webp') }}" alt="Orange PRO">--}}
{{--                                        </a>--}}
{{--                                    </figure>--}}

{{--                                @endforeach--}}


                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer Column-->
                <div class="footer-column col-xl-3 col-lg-4 col-md-4">
                    <div class="footer-widget contacts-widget">
                        <h6 class="widget-title">{{ language('frontend.footer.contact') }}</h6>
                        @if(setting('address',true))
                        <div class="text">{{  setting('address',true) }}</div>
                        @endif
                        <ul class="contact-info">
                            @if(setting('email'))
                            <li><i class="fa fa-envelope"></i> <a href="mailto:{{  setting('email') }}">{{  setting('email') }}</a><br></li>
                            @endif
                            @if(json_decode(setting('tel'))[0]->tel)
                            <li><i class="fa fa-phone-square"></i> <a href="tel:{{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[0] }}">
                                    {{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[1] }}
                                </a><br></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container">
                <div class="copyright-text">&copy; 2018 - {{ date('Y') }} | {!! setting('copyright',true) !!}</div>
            </div>
        </div>
    </div>
</footer>
<!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
<!--Revolution Slider-->
<script src="{{ asset('frontend/assets/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('frontend/assets/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/main-slider-script.js') }}"></script>
<!--Revolution Slider-->
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
<script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
<script src="{{ asset('frontend/assets/js/knob.js') }}"></script>
<script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
<script src="{{ asset('frontend/assets/js/script.js?ver='.time()) }}"></script>

<!--  Language Change  -->
<script>
    const languageChange = "{{ route('frontend.language.change') }}";
    const fullUrl = "{{ url()->full() }}";
</script>

<script src="{{ asset('assets/js/common.js') }}"></script>

@yield('JS')

<script>
    {!! setting('custom_code_js') !!}
</script>

{!! setting('custom_code_footer') !!}

</body>
</html>

