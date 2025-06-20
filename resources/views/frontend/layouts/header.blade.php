<!DOCTYPE html>
<html lang="{{ request('currentLang') }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage') }}/{{ setting('favicon') }}">

    @if(setting('disable_site_index') == 1)
    <meta name="robots" content="noindex,nofollow"/>
    @endif


    <!-- Stylesheets -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/plugins/revolution/css/settings.css') }}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
    <link href="{{ asset('frontend/assets/plugins/revolution/css/layers.css') }}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
    <link href="{{ asset('frontend/assets/plugins/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->


    <!--  SOCICON  -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/socicon/css/socicon.min.css?ver=1.0.2') }}">

    <link href="{{ asset('frontend/assets/css/style.css?ver=').time() }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive.css?ver=').time() }}" rel="stylesheet">

    <link href="{{ asset('frontend/assets/css/custom.css?ver=40') }}" rel="stylesheet">


    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="{{ asset('frontend/assets/js/respond.js') }}"></script><![endif]-->

    <style>
        .preloader:before {
            content: "";
        }


        .main-header .outer-box .ui-btn-outer {
            padding: 6px 12px !important;
        }



        /*   ONLY SVG SEETINGS START   */

        .fill {
            fill: #fff
        }

        .logo-scale .fill {
            fill: rgb(251, 98, 25);
        }


        .animation-fill {
            fill: rgb(251, 98, 25);
            animation-name: strokeYellow;
            animation-duration: 2s;
            animation-fill-mode: both;
        }

        .animation-step-2 {
            animation-delay: 0.1s;
        }

        .animation-step-3 {
            animation-delay: 0.2s;
        }

        .animation-step-4 {
            animation-delay: 0.3s;
        }

        .animation-step-5 {
            animation-delay: 0.4s;
        }

        .animation-step-6 {
            animation-delay: 0.5s;
        }

        .animation-step-7 {
            animation-delay: 0.6s;
        }

        .animation-step-8 {
            animation-delay: 0.9s;
        }

        @keyframes strokeWhite {
            0% {
                fill: rgba(72, 138, 20, 0);
                stroke: rgba(255, 255, 255, 1);
                stroke-dashoffset: 25%;
                stroke-dasharray: 0 50%;
                stroke-width: 2;
            }
            70% {
                fill: rgba(72, 138, 20, 0);
                stroke: rgba(255, 255, 255, 1);
            }
            80% {
                fill: rgba(72, 138, 20, 0);
                stroke: rgba(255, 255, 255, 1);
                stroke-width: 3;
            }
            100% {
                fill: rgba(255, 255, 255, 1);
                stroke: rgba(54, 95, 160, 0);
                stroke-dashoffset: -25%;
                stroke-dasharray: 50% 0;
                stroke-width: 0;
                animation-play-state: paused;
            }
        }

        @keyframes strokeYellow {
            0% {
                fill: rgba(72, 138, 20, 0);
                stroke: #E4D602;
                stroke-dashoffset: 25%;
                stroke-dasharray: 0 50%;
                stroke-width: 2;
            }
            70% {
                fill: rgba(72, 138, 20, 0);
                stroke: #E4D602;
            }
            80% {
                fill: rgba(72, 138, 20, 0);
                stroke: #E4D602;
                stroke-width: 3;
            }
            100% {
                fill: #E4D602;
                stroke: rgba(54, 95, 160, 0);
                stroke-dashoffset: -25%;
                stroke-dasharray: 50% 0;
                stroke-width: 0;
                animation-play-state: paused;
            }
        }

       /*   ONLY SVG SEETINGS END   */
    </style>

    @yield('CSS')

    <style>
        {!! setting('custom_code_css') !!}
    </style>

    {!! setting('custom_code_header') !!}

</head>

<body>

<!-- Preloader -->
{{--<div class="spinner-container2">--}}
{{--    <div class="spinner2"></div>--}}
{{--</div>--}}


<div class="page-wrapper">


    <!-- Main Header-->
    <header class="main-header header-style-one">


        <div class="header-lower">
            <div class="container-fluid">
                <!-- Main box -->
                <div class="main-box">
                    <div class="logo-box">
                        <div class="logo">
                            <a href="{{ route('frontend.home.index') }}">
                                <svg id="Layer_1" data-name="Layer 1" width="173" height="48" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2551.18 819.12" class="logo-scale">
                                    <path class="fill animation-fill animation-step-1" d="M132.88,591.6H39.43v-4.08c0-71.1-.12-142.19,0-213.29.2-89.38,51.34-167.18,132.7-202.13,29-12.43,59.31-17.28,90.69-16.65,53.79,1.07,100.66,19.53,140.52,55.71,1,.89,1.9,1.81,3.08,2.93a254.21,254.21,0,0,0-47.23,86.46c-1-1.14-1.73-1.9-2.38-2.72-21.55-27-48.92-43.91-83.62-48.11-77-9.31-131.35,48.51-138.79,103.76A170.2,170.2,0,0,0,133,375.93q-.16,105.54-.07,211.1Z"/>
                                    <path class="fill animation-fill animation-step-2" d="M475.85,591.65H382.34c-.06-1.3-.16-2.47-.17-3.64-.3-75.7-.72-151.41-.8-227.11,0-21.67,5.67-42.36,13.1-62.56C418.54,233,479.38,177.57,545.41,161.93c138-32.68,236.23,56.87,263.67,145.5a213.14,213.14,0,0,1,9.59,62.94q.24,109.2.08,218.4c0,.83-.07,1.66-.12,2.75H725.14v-4.47c0-71.71.11-143.42,0-215.12-.12-50.48-31.55-96.94-78.9-114.6C565.14,227.12,493.86,279.75,479.32,344A142.09,142.09,0,0,0,476,374.58c-.28,70.86-.14,141.72-.14,212.58Z"/>
                                    <path class="fill animation-fill animation-step-3" d="M1308,591.61h-93.6v-4.43q0-47.77,0-95.57c0-32.94,0-65.89-.16-98.83-.09-12.81.3-25.78-1.51-38.4-7.41-51.5-46.1-92.13-97.25-103.22-60.54-13.12-124.72,23.57-144,82.37-22.13,67.32,13.38,137.06,81.33,159.34,28.34,9.29,56.78,10.28,85-.61,19.24-7.43,34-20.55,46.34-36.76.85-1.13,1.72-2.25,3.23-4.22v4.37c0,36.71,0,73.41.09,110.11,0,3.09-1.14,4.42-3.71,5.63a212.29,212.29,0,0,1-78.3,19.88c-32.07,2-63.22-2-93.5-13.06C956,557.73,887.19,497.77,874.36,410.08c-8.47-57.93,1-112.34,35.69-160.62,31.22-43.49,71.69-75.17,124.55-87.25,84.56-19.31,158,1.23,217.58,65.71,28.07,30.37,45.91,66,52.57,106.91a218.49,218.49,0,0,1,3.09,34.32c.28,73.16.16,146.32.17,219.48Z"/>
                                    <path class="fill animation-fill animation-step-4" d="M1459.59,280h124.33v93.56H1459.61v218h-93.55v-3.74q0-153.54,0-307.07c.11-89.58,51.73-167.72,133.36-202.45,28.22-12,60.21-16.74,84.49-16.2v93.17c-43.88.42-78.06,19.55-103.28,55C1466,231,1459.57,254.32,1459.59,280Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1857.2,62v93.31c-44.44.43-78.82,19.88-104,55.82-14.35,20.44-20.45,43.55-20.61,68.8h124.52v93.64H1732.6V591.59H1639v-4.06q0-153,0-305.95c.1-90.71,52.89-170.23,135-203.91,25.52-10.46,52.15-15.28,79.64-15.71C1854.76,61.94,1855.82,62,1857.2,62Z"/>
                                    <path class="fill animation-fill animation-step-6" d="M2008.24,199.13V591.61h-93.36v-4.07q0-157.3-.06-314.62a6.54,6.54,0,0,1,3-6q43.47-32.52,86.81-65.22C2005.66,201,2006.72,200.22,2008.24,199.13Z"/>
                                    <path class="fill animation-fill animation-step-6" d="M2156.28,591.62H2063c-.09-1.09-.23-2-.23-3,0-72.92-.64-145.84.24-218.75a217.31,217.31,0,0,1,143.38-202,213.35,213.35,0,0,1,94-11.5c84.3,8.2,142.93,53.28,180.05,127.82,13.13,26.37,18.42,55.07,18.54,84.43.31,73.4.13,146.81.14,220.21,0,.82-.07,1.65-.12,2.67H2405.8v-4.59q0-106.47,0-212.94c-.08-47.87-21.91-83.81-62.07-108.49-42.77-26.28-110.19-24.49-153.89,22.89-22.32,24.2-33.5,52.54-33.51,85.36q0,106.47,0,212.94Z"/>
                                    <path class="fill animation-fill animation-step-7" d="M1911.63,62.31,2013,151.43l-101.41,79.44Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M69.92,786.38V708.83H42.22V693H116.4v15.8H88.77v77.55Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M457.84,752.06l18.28,5.79q-4.22,15.28-14,22.7T437.33,788q-18.58,0-30.56-12.71t-12-34.72q0-23.31,12-36.21t31.65-12.89q17.13,0,27.83,10.13,6.36,6,9.55,17.19l-18.65,4.45a19.3,19.3,0,0,0-19.68-15.66A21.28,21.28,0,0,0,420.68,715q-6.45,7.46-6.46,24.13,0,17.72,6.37,25.22a20.66,20.66,0,0,0,16.55,7.51,18.85,18.85,0,0,0,12.93-4.78Q455.49,762.31,457.84,752.06Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M583.64,786.38V693h18.85v36.75h36.93V693h18.85v93.35H639.42V745.56H602.49v40.82Z"/>

                                    <path class="fill animation-fill animation-step-5" d="M1019.29,756l18.34-1.77q1.65,9.22,6.72,13.55t13.66,4.34q9.1,0,13.72-3.85t4.62-9a8.48,8.48,0,0,0-1.95-5.64c-1.3-1.55-3.55-2.89-6.78-4q-3.31-1.14-15.09-4.08-15.16-3.75-21.27-9.23a24.31,24.31,0,0,1-8.6-18.79,24,24,0,0,1,4.05-13.33,25.25,25.25,0,0,1,11.65-9.46q7.62-3.26,18.37-3.25,17.58,0,26.46,7.7t9.33,20.57l-18.85.83q-1.22-7.2-5.19-10.34T1056.54,707q-8.22,0-12.86,3.38a6.8,6.8,0,0,0-3,5.79,7.18,7.18,0,0,0,2.8,5.67q3.55,3,17.32,6.23t20.34,6.72a26.37,26.37,0,0,1,10.32,9.49q3.72,6,3.72,14.87a27.51,27.51,0,0,1-4.46,15,26.69,26.69,0,0,1-12.6,10.41q-8.16,3.4-20.31,3.4-17.71,0-27.19-8.18T1019.29,756Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1395.57,786.38V693.79h18.84v76.87h46.87v15.72Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1565.87,693h18.85v50.56q0,12,.7,15.6a15.07,15.07,0,0,0,5.76,9.2q4.56,3.48,12.45,3.47t12.1-3.27a13,13,0,0,0,4.9-8.06,103.79,103.79,0,0,0,.83-15.85V693h18.85v49q0,16.82-1.53,23.75a26.36,26.36,0,0,1-5.63,11.72,28.67,28.67,0,0,1-11,7.61q-6.87,2.82-18,2.83-13.37,0-20.27-3.08a29.06,29.06,0,0,1-10.93-8,25.65,25.65,0,0,1-5.28-10.35q-1.85-8-1.85-23.69Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1772.48,786.38V708.83h-27.7V693H1819v15.8h-27.63v77.55Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1921.83,786.38V693h18.85v93.35Zm.7-98.7V670.75h17.58v16.93Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M2046.11,740.28q0-14.25,4.26-23.95a44,44,0,0,1,8.69-12.79,36.14,36.14,0,0,1,12.07-8.4,51.11,51.11,0,0,1,20.12-3.7q20.64,0,33,12.8t12.38,35.59q0,22.62-12.29,35.37T2091.51,788q-20.84,0-33.12-12.71T2046.11,740.28Zm19.42-.64q0,15.86,7.32,24a25.17,25.17,0,0,0,37.09.06q7.21-8.12,7.22-24.35,0-16-7-23.94t-18.69-7.9q-11.66,0-18.78,8T2065.53,739.64Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M2242.83,786.38V693h18.34l38.21,62.34V693h17.51v93.35H2298l-37.63-60.88v60.88Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M2423.33,756l18.34-1.77q1.65,9.22,6.72,13.55t13.66,4.34q9.1,0,13.72-3.85t4.61-9a8.48,8.48,0,0,0-1.94-5.64c-1.3-1.55-3.55-2.89-6.78-4q-3.32-1.14-15.09-4.08-15.17-3.75-21.27-9.23a24.31,24.31,0,0,1-8.6-18.79,24,24,0,0,1,4.05-13.33,25.2,25.2,0,0,1,11.65-9.46q7.6-3.26,18.37-3.25,17.58,0,26.46,7.7t9.33,20.57l-18.85.83q-1.22-7.2-5.19-10.34T2460.58,707q-8.22,0-12.86,3.38a6.77,6.77,0,0,0-3,5.79,7.18,7.18,0,0,0,2.8,5.67q3.55,3,17.31,6.23t20.35,6.72a26.44,26.44,0,0,1,10.32,9.49q3.72,6,3.72,14.87a27.51,27.51,0,0,1-4.46,15,26.69,26.69,0,0,1-12.6,10.41q-8.16,3.4-20.31,3.4-17.71,0-27.2-8.18T2423.33,756Z"/>
                                    <rect class="fill animation-fill animation-step-5" x="214.83" y="694.15" width="85.35" height="15.93"/>
                                    <rect class="fill animation-fill animation-step-5" x="224.8" y="729.56" width="65.41" height="15.93"/>
                                    <rect class="fill animation-fill animation-step-5" x="233.68" y="769.39" width="47.65" height="15.93"/>
                                    <path class="fill animation-fill animation-step-5" d="M1296,755.94h0l-.39-.49-.65-.79h0l-2.58-3.23h-7.46a2.24,2.24,0,0,0-2.32,1.4,33.88,33.88,0,0,1-37.2,18.14c-21-4.15-33-27.05-24.42-46.61,6.94-15.8,23.16-24,39.66-19.76,10,2.58,17.41,8.72,22.1,18a2,2,0,0,0,2.07,1.25c2.53-.05,5.07-.07,7.6-.12l2.91-3.6h0l.46-.54.51-.63h0c.63-.77,1.25-1.55,1.88-2.23a1.46,1.46,0,0,0,.16-2.05c-1-1.69-2-3.44-3-5.17-.8-1.39-.79-1.38-2.34-1.11-2.63.46-5.26.92-7.9,1.28a2.57,2.57,0,0,1-1.72-.53c-.93-.74-1.71-1.66-2.57-2.48a2,2,0,0,1-.64-2c.48-2.75.9-5.51,1.4-8.26a1.31,1.31,0,0,0-.76-1.63c-1.89-1-3.76-2.11-5.59-3.24a1.56,1.56,0,0,0-2.14.21c-2,1.75-4.09,3.43-6.13,5.15a2.17,2.17,0,0,1-2.22.5,27.24,27.24,0,0,0-3.07-.82,2.32,2.32,0,0,1-1.88-1.7c-.86-2.46-1.82-4.88-2.66-7.34a1.55,1.55,0,0,0-1.73-1.26c-2.16.06-4.31,0-6.47,0a1.38,1.38,0,0,0-1.54,1.09c-.9,2.54-1.9,5.05-2.78,7.6a2.19,2.19,0,0,1-1.83,1.6,25.18,25.18,0,0,0-3.07.8,2,2,0,0,1-2.12-.44c-2.13-1.8-4.32-3.55-6.47-5.34a1.26,1.26,0,0,0-1.65-.15c-1.88,1.11-3.76,2.22-5.71,3.22a1.54,1.54,0,0,0-.93,2c.53,2.68,1,5.38,1.44,8.07a1.9,1.9,0,0,1-.61,1.9c-.9.83-1.7,1.77-2.63,2.55a2.34,2.34,0,0,1-1.6.54q-4.18-.6-8.36-1.41a1.43,1.43,0,0,0-1.79.83c-1,1.88-2.1,3.75-3.24,5.58a1.55,1.55,0,0,0,.19,2.13c1.77,2,3.46,4.15,5.22,6.2a2,2,0,0,1,.45,2.12,24.51,24.51,0,0,0-.84,3.16,2,2,0,0,1-1.48,1.7c-2.61.92-5.19,1.91-7.79,2.84a1.36,1.36,0,0,0-1,1.49c0,2.22,0,4.44,0,6.66a1.4,1.4,0,0,0,1.09,1.56c2.63.92,5.24,1.92,7.88,2.86a1.87,1.87,0,0,1,1.32,1.49c.25,1.13.54,2.25.9,3.35a2,2,0,0,1-.47,2.11c-1.79,2.1-3.52,4.26-5.32,6.36a1.32,1.32,0,0,0-.17,1.79c1.16,1.89,2.28,3.81,3.33,5.76a1.45,1.45,0,0,0,1.8.8c2.75-.52,5.51-1,8.26-1.45a1.76,1.76,0,0,1,1.79.63,24.09,24.09,0,0,0,2.32,2.31,2.28,2.28,0,0,1,.78,2.4c-.51,2.68-.94,5.38-1.44,8.07a1.23,1.23,0,0,0,.7,1.49c2,1.09,3.92,2.2,5.84,3.38a1.36,1.36,0,0,0,1.87-.14c2.08-1.77,4.22-3.46,6.31-5.23a2.22,2.22,0,0,1,2.31-.48,29.45,29.45,0,0,0,3.07.8,2.07,2.07,0,0,1,1.68,1.51c.92,2.57,1.93,5.11,2.84,7.68a1.48,1.48,0,0,0,1.66,1.1c2.16,0,4.31-.05,6.46,0A1.39,1.39,0,0,0,1257,788c.92-2.6,1.92-5.18,2.85-7.78a1.94,1.94,0,0,1,1.54-1.4,28,28,0,0,0,3.26-.87,2,2,0,0,1,2.18.48c2.13,1.82,4.31,3.57,6.44,5.38a1.22,1.22,0,0,0,1.64.13c2-1.18,3.93-2.32,5.92-3.43a1.26,1.26,0,0,0,.7-1.56c-.53-2.84-1-5.7-1.44-8.55a1.89,1.89,0,0,1,.37-1.39,24.91,24.91,0,0,1,2.89-2.83,2.45,2.45,0,0,1,1.73-.51c2.76.37,5.52.86,8.27,1.34a1.37,1.37,0,0,0,1.66-.75q1.68-3,3.47-6a1,1,0,0,0-.11-1.34C1297.59,758,1296.78,757,1296,755.94Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1280.63,740.9l-4.41,0c-.64,0-.72.28-.81.77a23.79,23.79,0,1,1-.19-9.5c.22,1,.52,1.56,1.65,1.3a5.68,5.68,0,0,1,1.16,0h2.6v-3.15c0-.08-.09-.09-.11-.19a29.35,29.35,0,1,0-23.43,36.07c3.38-.59,6.74-1.38,9.47-3.73a2.94,2.94,0,0,1,.69-.33,13.83,13.83,0,0,0,2-1,29.05,29.05,0,0,0,11.43-17Z"/>
                                    <path class="fill animation-fill animation-step-5" d="M1278.56,725.94c-1.28.72-2.55,1.45-3.83,2.16-.57.32-.49.61-.32,1.08a23.79,23.79,0,1,1-4.92-8.14c.7.78,1.23,1.1,2.09.3a5.4,5.4,0,0,1,1-.54l2.26-1.3-1.58-2.73c-.07-.06-.12,0-.19-.11a29.35,29.35,0,1,0-2.25,43c2.62-2.2,5.15-4.57,6.33-8a3.2,3.2,0,0,1,.43-.63,14.53,14.53,0,0,0,1.19-1.85,29,29,0,0,0,1.38-20.47Z"/>
                                </svg>
{{--                                <img src="{{ asset('storage') }}/{{ setting('logo') }}" alt="{{ language('general.title') }}">--}}
                            </a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer">
                        <nav class="nav main-menu">
                            <ul class="navigation">
                                <!--  MENU START  -->
                                {!! \App\Services\MenuServices::getMenu($HTTP_HOST,$languageID,1) !!}
                                <!--  MENU END  -->
                            </ul>
                        </nav>

                        <!-- Main Menu End-->
                    </div>

                    <div class="outer-box">
                        <div class="ui-btn-outer">
                            <!--  LANGUAGE START  -->
                            @foreach($allLanguages as $language)
                                @if($currentLang == $language->code)
                                    <a class="langaugeColor" href="javascript:void(0)" role="button" id="dropdownLanguage"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--                                        <img src="{{ countryFlag($language->code) }}" alt="{{ $language->short_name }}" >--}}
                                        {{ mb_strtoupper($language->short_name) }} <i
                                            class="fas fa-angle-down"></i>
                                    </a>
                                @endif
                            @endforeach
                            <div class="dropdown-menu list" aria-labelledby="dropdownLanguage">
                                @foreach($allLanguages as $language)
                                    @if($currentLang != $language->code)
                                        <div data-language-code="{{ $language->code }}"
                                             class="language-change-request">
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <img style="width: 27px" src="{{ countryFlag($language->code) }}"
                                                     alt="{{ $language->short_name }}">
                                                {{ mb_strtoupper($language->short_name) }}
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!--  LANGUAGE END  -->
                        </div>

                      @if(json_decode(setting('tel'))[0]->tel)
                        <a href="tel:{{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[0] }}" class="info-btn">
                            <i class="icon fa fa-phone"></i>
                            <small>{!! language('frontend.home.header.call_anytime') !!}</small>
                            {{ \App\Services\CommonService::telText(json_decode(setting('tel'))[0]->tel)[1] }}
                        </a>
                        @endif


                        <!-- Mobile Nav toggler -->
                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>

            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            <nav class="menu-box">
                <div class="upper-box">
                    <div class="nav-logo">
                        <a href="{{ route('frontend.home.index') }}"><img src="{{ asset('storage') }}/{{ setting('logo') }}" alt="{{ language('general.title') }}"></a>
                    </div>
                    <div class="close-btn"><i class="icon fa fa-times"></i></div>
                </div>

                <ul class="navigation clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </ul>
                <ul class="contact-list-one">
                    <!--  LOCATION  -->
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <span class="icon fa-light fa-location-dot"></span>
                            <span class="title">{!! language('frontend.contact.address') !!}</span>
                            {{  setting('address',true) }}
                        </div>
                    </li>

                    <!--  EMAIL  -->
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-envelope1"></span>
                            <span class="title">{!! language('frontend.contact.email') !!}</span>
                            <a href="mailto:{{  setting('email') }}">{{  setting('email') }}</a>
                        </div>
                    </li>

                    <!--  TEL  -->
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <i class="icon lnr-icon-phone-handset"></i>
                            <span class="title">{!! language('frontend.contact.tel') !!}</span>
                            @foreach( json_decode(setting('tel')) as $tel)
                                <a  href="tel:{{ \App\Services\CommonService::telText( $tel->tel )[0] }}">
                                    {{ \App\Services\CommonService::telText( $tel->tel )[1] }}
                                </a>
                                @if(!$loop->last)<br> @endif
                            @endforeach
                        </div>
                    </li>
                </ul>


                @if(!empty(json_decode(setting('social'))))
                    <ul class="social-links">
                        @foreach(json_decode(setting('social')) as $key => $value)
                            <li>
                                <a {{ isset($value->status) ? 'target="_blank"': ''  }}  href="{{ $value->link }}">
                                    <i class="socicon-{{ $value->name }}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif


            </nav>
        </div><!-- End Mobile Menu -->

        <!-- Header Search -->
        <div class="search-popup">
            <span class="search-back-drop"></span>
            <button class="close-search"><span class="fa fa-times"></span></button>

            <div class="search-inner">
                <form method="post" action="blog-showcase.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Search..." required="">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Header Search -->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="inner-container">
                    <!--Logo-->
                    <div class="logo">
                        <a href="{{ route('frontend.home.index') }}"><img src="{{ asset('storage') }}/{{ setting('logo_dark') }}" alt="{{ language('general.title') }}"></a>
                    </div>

                    <!--Right Col-->
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                <ul class="navigation clearfix">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </ul>
                            </div>
                        </nav><!-- Main Menu End-->

                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div><!-- End Sticky Menu -->
    </header>
    <!--End Main Header -->
