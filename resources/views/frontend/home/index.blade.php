@extends('frontend.layouts.index')

@section('title', empty(language('general.title')) ? language('general.home') : language('general.title'))
@section('keywords', language('general.keyword'))
@section('description', language('general.description'))

@section('content')

    <div role="main" class="main home">
        {{-- 4 banner starts --}}
        <div class="banner-container">
            @foreach ($slides as $slide)
                <div class="banner-item">
                    <div class="container">
                        <div class="banner-content">
                            <h1 class="title">
                                <i class="fa-solid fa-check-double"></i>
                                <div>{!! $slide->title !!}</div>
                            </h1>
                            <div class="sub-title">{!! $slide->sub_title !!}</div>
                            @if ($slide->button_text && $slide->button_link)
                                <a href="{{ $slide->button_link }}" class="btn btn-primary">{{ $slide->button_text }}</a>
                            @endif
                        </div>
                        <img src="{{ $slide->image }}" alt="Banner Image" class="banner-image"/>
                    </div>
                </div>
            @endforeach {{-- Hover image container --}}
            <div class="hover-container">
                <img src="{{ $slides[0]->image }}" alt="Hover Image" class=hover-image">"
            </div>
            {{-- Hover image container --}}
        </div>
        {{-- 4 banner ends --}}

        <div id="about">
            <h2>Biz Kimik!</h2>
            <div class="about-container">
                <div class="about-content">
                    <div class="image">
                        <img src="https://hbngroup.az/image/cache/catalog/1_new_design/market_analysis_on_big_screen_570x267-570x267.webp" class="about-image"/>
                    </div>
                    <div class="content">
                        <div class="title">BIAR GLOBAL</div>
                        <div class="description">Peşəkar inkişafı dəstəkləyən və fərdlərə yeni bacarıqlar qazandıran innovativ bir təlim və məsləhət mərkəzidir. Biz təhsil, biznes inkişafı və insan
                            resursları sahələrində ən
                            son trendləri və metodologiyaları tətbiq edərək iştirakçılarımızın uğur qazanmasına dəstək oluruq.
                        </div>
                    </div>
                </div>
                <div class="about-content">
                    <div class="image">
                        <img src="https://hbngroup.az/image/cache/catalog/1_new_design/market_analysis_on_big_screen_570x267-570x267.webp" class="about-image"/>
                    </div>
                    <div class="content">
                        <div class="title">BIAR GLOBAL</div>
                        <div class="description">Peşəkar inkişafı dəstəkləyən və fərdlərə yeni bacarıqlar qazandıran innovativ bir təlim və məsləhət mərkəzidir. Biz təhsil, biznes inkişafı və insan
                            resursları sahələrində ən
                            son trendləri və metodologiyaları tətbiq edərək iştirakçılarımızın uğur qazanmasına dəstək oluruq.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 8 banner services starts --}}
        <div class="services-container">
            <h2 class="services-title">İstiqamətlərimiz</h2>
            <div class="services">
                @foreach ($services as $service)
                    <div class="service-item">
                        <div class="service-content">
                            <h2 class="service-title">
                                {!! $service->icon !!}
                                <span>{{ $service->name }}</span>

                            </h2>
                            <p class="service-description">{{ $service->text }}</p>
                            @if ($service->button_text && $service->button_link)
                                {{--                                <a href="{{ $service->button_link }}"--}}
                                {{--                                   class="btn btn-secondary">{{ $service->button_text }}</a>--}}
                            @endif
                        </div>
                        {{--                        <img src="{{ $service->image }}" alt="{{ $service->title }}" class="service-image"/>--}}
                    </div>
                @endforeach
            </div>
        </div>
        {{-- 8 banner services starts --}}


    </div>


    <style>
        .main.home {
            .banner-container {
                position: relative;
                width: 100%;
                height: 600px;
                overflow: hidden;
                display: flex;
                justify-content: center;
                gap: 2px;

                .hover-container {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    width: 100%;
                    height: 100%;

                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }

                .banner-item {
                    width: calc(100% / 4 - 2px);
                    height: 100%;
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    @media (max-width: 1200px) {
                        width: calc(100% / 3 - 2px);
                        &:nth-child(4) {
                            display: none;
                        }
                    }

                    @media (max-width: 900px) {
                        width: calc(100% / 2 - 2px);
                        &:nth-child(3) {
                            display: none;
                        }
                    }

                    @media (max-width: 768px) {
                        width: calc(100%);
                        &:nth-child(2) {
                            display: none;
                        }
                    }

                    &:hover {
                        .container .banner-content {
                            .title {
                                transform: translateY(0);
                                height: min-content;
                                margin-bottom: 2%;
                            }

                            .sub-title {
                                transform: translateY(0);
                                height: auto;
                                margin-bottom: 8%;
                                font-weight: 500;
                                font-size: 0.7rem;
                                line-height: 1.5;
                            }
                        }
                    }

                    &::before {
                        content: "";
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: rgba(0, 0, 0, 0.5);
                        z-index: 1;
                    }

                    .container {
                        z-index: 2;
                        width: 100%;
                        height: 100%;
                        display: flex;
                        justify-content: end;
                        flex-direction: column;

                        .banner-content {
                            width: 100%;
                            height: 100%;
                            display: flex;
                            flex-direction: column;
                            justify-content: flex-end;
                            align-items: start;

                            .title {
                                display: flex;
                                flex-direction: column;
                                gap: 15px;
                                font-size: 1.5rem;
                                color: #fff;
                                margin-bottom: 100px;
                                transform: translateY(100%);
                                transition: 800ms;
                            }

                            .sub-title {
                                font-size: 1rem;
                                color: #fff;
                                /*margin-bottom: -50%;*/
                                transform: translateY(100%) scaleY(0);
                                height: 1%;
                                overflow: hidden;
                                transition: 200ms;
                                line-height: 5;
                                /*display: none;*/
                            }
                        }

                        /**/

                        img {
                            display: none !important;
                        }


                    }
                }


            }

            #about {
                padding: 60px 0px;
                background-color: #212121;

                h2 {
                    font-size: 2rem;
                    text-align: center;
                    margin-bottom: 60px;
                    color: #fff;
                }

                .about-container {
                    width: 100%;
                    display: flex;
                    gap: 20px;
                    justify-content: center;

                    .about-content {
                        width: calc(100% / 2 - 20px);
                        display: flex;
                        gap: 20px;
                        align-items: start;
                        justify-content: center;
                        padding: 20px;
                        border-radius: 10px;

                        .image {
                            width: 50%;
                            height: 200px;

                            img {
                                width: 100%;
                                height: 100%;
                                border-radius: 10px;
                                object-fit: cover;
                            }
                        }

                        .content {
                            width: 50%;
                            text-align: left;

                            .title {
                                font-size: 1.5rem;
                                font-weight: bold;
                                margin-bottom: 10px;
                                color: #fff;
                            }

                            .description {
                                font-size: 0.9rem;
                                line-height: 1.2;
                                text-align: justify;
                                color: #fff;
                            }
                        }
                    }
                }
            }

            .services-container {
                width: 100%;
                padding: 50px 30px;
                background-color: #f8f9fa;
                display: flex;
                flex-direction: column;
                align-items: center;


                .services-title {
                    text-align: center;
                    font-size: 2rem;
                    margin-bottom: 60px;
                }

                .services {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: start;
                    gap: 25px;
                    width: 100%;


                    .service-item {
                        width: calc(100% / 4 - 20px);
                        background-color: #fff;
                        border-radius: 20px;
                        overflow: hidden;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        position: relative;
                        height: auto;
                        border: 2px solid #007bff;
                        padding: 20px;

                        .service-content {
                            padding: 20px;
                            z-index: 2;
                            background: #fff;
                            border-radius: 15px;
                            transition: 500ms;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            flex-direction: column;
                            height: 100%;

                            .service-title {
                                font-size: 0.9rem;
                                margin-bottom: 10px;
                                text-transform: uppercase;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                flex-direction: column;
                                gap: 20px;

                                i {
                                    font-size: 1.5rem;
                                    color: #007bff;
                                }
                            }

                            .service-description {
                                font-size: 0.65rem;
                                color: #6c757d;
                                overflow: hidden;
                                line-height: 1.5;
                                text-overflow: ellipsis;
                                display: -webkit-box;
                                -webkit-line-clamp: 4; /* Number of lines to show */
                                -webkit-box-orient: vertical;
                                transition: 500ms;

                            }
                        }

                        @media (max-width: 1100px) {
                            width: calc(100% / 3 - 20px);
                        }

                        @media (max-width: 900px) {
                            width: calc(100% / 2 - 20px);
                        }

                        @media (max-width: 768px) {
                            width: calc(100%);
                        }
                    }


                }
            }
        }


    </style>

@endsection

@section('JS')
    <!--  SUBMIT START  -->
    <script>
        var nameFieldRequiredTranslate = "{!! language('frontend.contact.form_error_name') !!}";
        var emailFieldRequiredTranslate = "{!! language('frontend.contact.form_error_email') !!}";
        var subjectFieldRequiredTranslate = "{!! language('frontend.contact.form_error_subject') !!}";
        var telFieldRequiredTranslate = "{!! language('frontend.contact.form_error_tel') !!}";
        var textFieldRequiredTranslate = "{!! language('frontend.contact.form_error_text') !!}";
        var successTranslate = "{!! language('frontend.contact.form_submit_success') !!}";
    </script>

    <script>
        $(function () {

            /*   ERROR MESSAGE   */
            function errorFormSend(text) {
                $('.submit-form-error ul').append('<li>' + text + '</li>');
            }


            /*   INPUTLRA TIKLANDIQDA ALERTLERI BAGLA   */
            $(document).on('click', 'input, textarea', function () {
                $('.submit-form-error').hide();
                $('.submit-form-error ul').html('');
                $('.submit-form-success').hide();
                $('.submit-form-error .alert-success').html('');
            })


            /*   SUBMIT BUTTONUNA TIKLANDIQDA   */
            $(document).on('click', '#submitForm', function (event) {
                event.preventDefault();

                /*   SUBMIT BUTTONUNA TIKLANDIQDA ALERTLERI BAGLA   */
                $('.submit-form-error ul').html('');
                $('.submit-form-error').hide();
                $('.submit-form-error .alert-success').html('');
                $('.submit-form-success').hide();


                /*   DATALARI AL   */
                var name = $('#name').val();
                var subject = $('#subject').val();
                var email = $('#email').val();
                var mobil = $('#mobil').val();
                var text = $('#text').val();


                /*   ERROR OLDUQUNU CHECK ET   */
                $(".checkForm").each(function () {
                    if ($(this).val() == "") {
                        $('.submit-form-error').fadeIn();
                        errorFormSend($(this).attr('data-validation-message'))
                    }
                });

                /*   EGER ERROR YOXDURSA SUBMIT ET   */
                if (name != "" && subject != "" && mobil != "" && text != "") {

                    $('.submitForm').hide();
                    $('.spinner-box').css('display', 'flex');

                    $.ajax({
                        url: "{{ route('frontend.home.contactSendAjax') }}",
                        type: 'POST',
                        data: {
                            name: name,
                            subject: subject,
                            email: email,
                            mobil: mobil,
                            text: text,
                        },
                        dataType: 'JSON',
                        success: function (data) {

                            /*   EGER ERROR VARSA RESPONSE OLARAQ ALERTE YAZ   */
                            if (data.error == true) {
                                $('.submit-form-error ul').html('');
                                $.each(data.data, function (index, value) {
                                    $('.submit-form-error').fadeIn();
                                    errorFormSend(value)
                                });

                                $('.submitForm').show();
                                $('.spinner-box').css('display', 'none');
                            }

                            /*   EGER DOGRUDURSA ALERTE YAZ VE TEMIZLE   */
                            if (data.success == true) {
                                $('.submit-form-success').fadeIn();
                                $('.submit-form-success .alert-success').html(successTranslate);

                                $(".checkForm").each(function () {
                                    $(this).val('');
                                });

                                $('#subject').val('');
                                $('#email').val('');

                                $('.submitForm').show();
                                $('.spinner-box').css('display', 'none');
                            }


                        }
                    });
                }


            })

        })
    </script>
    <!--  SUBMIT END  -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hoverContainer = document.querySelector(".hover-container");
            const bannerItems = document.querySelectorAll(".banner-container .banner-item");

            bannerItems.forEach((item, index) => {
                item.addEventListener("mouseover", function () {
                    const hoverImage = hoverContainer.querySelector("img");
                    hoverImage.src = item.querySelector("img").src;
                });
            });
        });
    </script>

@endsection
