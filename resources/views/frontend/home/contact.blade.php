@extends('frontend.layouts.index')

@section('title',empty(language('frontend.contact.title')) ? language('frontend.contact.name') : language('frontend.contact.title'))
@section('keywords', language('frontend.contact.keywords') )
@section('description',language('frontend.contact.description') )

@section('breadcrumb')
    <!-- Start main-content -->
    <section class="page-title"
             style="background-image: url({{ \App\Services\ImageService::customImageReSize(language('frontend.contact.header_image'), 1980, 455, 80, 'webp') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ language('frontend.contact.name') }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('frontend.home.index') }}">{{ language('general.home') }}</a></li>
                    <li>{{ language('frontend.contact.name') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->
@endsection

@section('content')

    <!--  MAP SECTION START  -->
    <section class="contact-details">
        <div class="container-fluid">

                <div class="contact-map-container">
                    <div class="contact-address-box d-none d-lg-flex">
                        <img class="contact-bg-overlay" src="{{ asset('assets/images/flags/az.svg') }}" alt="azerbaijan">
                        <div class="contact-address-item-head">
                            <div class="contact-address-item-flag">
                                <img src="{{ asset('assets/images/flags/az.svg') }}" alt="azerbaijan">
                            </div>
                            <div class="contact-address-item-content">
                                <div class="contact-address-item-content-title">{{ language('frontend.contact.azerbaijan.addres_name') }}</div>
                                <div class="contact-address-item-content-sub-title">{{ language('frontend.contact.azerbaijan.ofice') }}</div>
                            </div>
                        </div>
                        <div class="contact-address-item-body">
                            <!--  ADDRESS  -->
                            <div class="contact-address-item-body-box">
                                <div class="contact-address-item-body-box-title">
                                    {!! language('frontend.contact.address') !!}
                                </div>
                                <div class="contact-address-item-body-box-sub-title">
                                  {{  setting('address',true) }}
                                </div>
                            </div>

                            <!--  TEL  -->
                            <div class="contact-address-item-body-box">
                                <div class="contact-address-item-body-box-title">
                                    {!! language('frontend.contact.tel') !!}
                                </div>
                                <div class="contact-address-item-body-box-sub-title">
                                    @foreach( json_decode(setting('tel')) as $tel)
                                        <a  href="tel:{{ \App\Services\CommonService::telText( $tel->tel )[0] }}">
                                            {{ \App\Services\CommonService::telText( $tel->tel )[1] }}
                                        </a>
                                        @if(!$loop->last)<br> @endif
                                    @endforeach
                                </div>
                            </div>

                            <!--  E-mail  -->
                            <div class="contact-address-item-body-box">
                                <div class="contact-address-item-body-box-title">
                                    {!! language('frontend.contact.email') !!}
                                </div>
                                <div class="contact-address-item-body-box-sub-title">
                                    <a href="mailto:{{  setting('email') }}">{{  setting('email') }}</a>
                                </div>
                            </div>


                        </div>
                        <div class="contact-socials-container">
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
                    {!! setting('map') !!}
                </div>

               <div class="row">
                   <div class="col-12">
                       <div class="contact-address-box extra-adress-box  extra-adress-box-height d-flex d-lg-none">
                           <img class="contact-bg-overlay" src="{{ asset('assets/images/flags/az.svg') }}" alt="azerbaijan">
                           <div class="contact-address-item-head">
                               <div class="contact-address-item-flag">
                                   <img src="{{ asset('assets/images/flags/az.svg') }}" alt="azerbaijan">
                               </div>
                               <div class="contact-address-item-content">
                                   <div class="contact-address-item-content-title">{{ language('frontend.contact.azerbaijan.addres_name') }}</div>
                                   <div class="contact-address-item-content-sub-title">{{ language('frontend.contact.azerbaijan.ofice') }}</div>
                               </div>
                           </div>
                           <div class="contact-address-item-body">
                               <!--  ADDRESS  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.address') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       {{  setting('address',true) }}
                                   </div>
                               </div>

                               <!--  TEL  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.tel') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       @foreach( json_decode(setting('tel')) as $tel)
                                           <a  href="tel:{{ \App\Services\CommonService::telText( $tel->tel )[0] }}">
                                               {{ \App\Services\CommonService::telText( $tel->tel )[1] }}
                                           </a>
                                           @if(!$loop->last)<br> @endif
                                       @endforeach
                                   </div>
                               </div>

                               <!--  E-mail  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.email') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       <a href="mailto:{{  setting('email') }}">{{  setting('email') }}</a>
                                   </div>
                               </div>


                           </div>
                           <div class="contact-socials-container extra-margin">
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
                   </div>
                   <div class="col-lg-6">
                       <div class="contact-address-box extra-adress-box">
                           <img class="contact-bg-overlay" src="{{ asset('assets/images/flags/pl.svg') }}" alt="azerbaijan">
                           <div class="contact-address-item-head">
                               <div class="contact-address-item-flag">
                                   <img src="{{ asset('assets/images/flags/pl.svg') }}" alt="azerbaijan">
                               </div>
                               <div class="contact-address-item-content">
                                   <div class="contact-address-item-content-title">{{ language('frontend.contact.poland.name') }}</div>
                                   <div class="contact-address-item-content-sub-title">{{ language('frontend.contact.poland.ofice') }}</div>
                               </div>
                           </div>
                           <div class="contact-address-item-body">
                               <!--  ADDRESS  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.address') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       {!! language('frontend.contact.poland.address') !!}
                                   </div>
                               </div>

                               <!--  TEL  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.tel') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       <a  href="tel:{{ \App\Services\CommonService::telText( language('frontend.contact.poland.tel') )[0] }}">
                                           {{ \App\Services\CommonService::telText( language('frontend.contact.poland.tel') )[1] }}
                                       </a>
                                   </div>
                               </div>

                               <!--  E-mail  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.email') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       <a href="mailto:{{  language('frontend.contact.poland.email') }}">{{  language('frontend.contact.poland.email') }}</a>
                                   </div>
                               </div>


                           </div>
                       </div>
                   </div>
                   <div class="col-lg-6">
                       <div class="contact-address-box extra-adress-box">
                           <img class="contact-bg-overlay" src="{{ asset('assets/images/flags/cz.svg') }}" alt="azerbaijan">
                           <div class="contact-address-item-head">
                               <div class="contact-address-item-flag">
                                   <img src="{{ asset('assets/images/flags/cz.svg') }}" alt="azerbaijan">
                               </div>
                               <div class="contact-address-item-content">
                                   <div class="contact-address-item-content-title">{{ language('frontend.contact.czechia.name') }}</div>
                                   <div class="contact-address-item-content-sub-title">{{ language('frontend.contact.czechia.ofice') }}</div>
                               </div>
                           </div>
                           <div class="contact-address-item-body">
                               <!--  ADDRESS  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.address') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       {{ language('frontend.contact.czechia.address') }}
                                   </div>
                               </div>

                               <!--  TEL  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.tel') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       <a  href="tel:{{ \App\Services\CommonService::telText( language('frontend.contact.czechia.tel') )[0] }}">
                                           {{ \App\Services\CommonService::telText( language('frontend.contact.czechia.tel') )[1] }}
                                       </a>
                                   </div>
                               </div>

                               <!--  E-mail  -->
                               <div class="contact-address-item-body-box">
                                   <div class="contact-address-item-body-box-title">
                                       {!! language('frontend.contact.email') !!}
                                   </div>
                                   <div class="contact-address-item-body-box-sub-title">
                                       <a href="mailto:{{  language('frontend.contact.czechia.email') }}">{{  language('frontend.contact.czechia.email') }}</a>
                                   </div>
                               </div>


                           </div>
                       </div>
                   </div>
               </div>
        </div>
    </section>
    <!--  MAP SECTION END  -->


    <!--Contact Details Start-->
    <section class="team-contact-form">
        <div class="container pb-100">
            <div class="sec-title text-center">
                @if(!empty(language('frontend.contact.form.sub_title'))) <span class="sub-title"> {{ language('frontend.contact.form.sub_title') }}</span> @endif
                <h2 class="section-title__title">{!! language('frontend.contact.form.title') !!}</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Contact Form -->
                    <!--Contact Form-->
                    <form id="contact-form">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control checkForm"
                                           data-validation-message="{{ language('frontend.contact.form_error_name') }}"
                                           autocomplete="OFF" id="name" name="name"
                                           placeholder="{{ language('frontend.contact.form_name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control"
                                           data-validation-message="{{ language('frontend.contact.form_error_email') }}"
                                           autocomplete="OFF" id="email" name="email"
                                           placeholder="{{ language('frontend.contact.form_email') }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control checkForm"
                                           data-validation-message="{{ language('frontend.contact.form_error_subject') }}"
                                           autocomplete="OFF" id="subject" name="subject"
                                           placeholder="{{ language('frontend.contact.form_subject') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control checkForm"
                                           data-validation-message="{{ language('frontend.contact.form_error_tel') }}"
                                           autocomplete="OFF" id="mobil" name="mobil"
                                           placeholder="{{ language('frontend.contact.form_mobil') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control checkForm"
                                      data-validation-message="{{ language('frontend.contact.form_error_text') }}"
                                      autocomplete="OFF" id="text" name="text"
                                      placeholder="{{ language('frontend.contact.form_text') }}"></textarea>
                        </div>



                        <div class="row">


                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="cf-box">
                                    <div class="submit-form-error mb-4" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <ul></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="submit-form-success mb-4" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-success"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-12 mb-5 text-center">

                                        <button id="submitForm" class="cont-submit btn-contact theme-btn btn-style-one">
                                            <span class="submitForm btn-title">{{ language('frontend.contact.form_submit') }}</span>
                                            <div class="spinner-box">
                                                <span>{{ language('frontend.contact.form_submit_sending') }}</span>
                                                <span><div id="spinner"></div></span>
                                            </div>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Contact Form Validation-->
                </div>
            </div>
        </div>
    </section>
    <!--Contact Details End-->

@endsection

@section('CSS')
    <style>

        .spinner-box {
            display: none;
            justify-content: center;
            align-items: center;
        }

        .spinner-box span:first-child {
            margin-right: 10px;
        }

        @keyframes spinner {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }


        #spinner {
            position: relative;
            width: 30px;
            height: 30px;
            min-width: 30px;
            min-height: 30px;
            border: 3px solid rgba(255, 255, 255, 0.1);
            border-right: 5px solid #ffffff;
            border-radius: 50%;
            animation: spinner 1s linear infinite;
        }
    </style>

@endsection

@section('JS')

    <!--  SUBMIT START  -->
    <script>
        var nameFieldRequiredTranslate = "{!! language('frontend.contact.form_error_name') !!}";
        var emailFieldRequiredTranslate = "{!!  language('frontend.contact.form_error_email') !!}";
        var subjectFieldRequiredTranslate = "{!!  language('frontend.contact.form_error_subject') !!}";
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

@endsection



