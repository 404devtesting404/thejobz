<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('resources/assets/images/resource/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('resources/assets/images/resource/favicon.png') }}">
    <title>@yield('title')</title>
    {{-- <title>Jobs in Pakistan 2025 | Latest Job Opportunities - TheJobz.pk</title> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="XvNdxu63q5D-c2AJfVFKuFQLfpZEKxRpFh27LXuBVrM" />
    @if ($web_config['adsterra_adds']->value == 1)
        <meta name="google-adsense-account" content="ca-pub-5856686507551560">
    @endif
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap-grid.css') }}" />
    <link rel="stylesheet" href="{{ asset('resources/assets/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/chosen.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/colors/colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v21.0">
    </script>
    @yield('JSON_D_Schema')
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RD8PHG0B1R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-RD8PHG0B1R');
    </script>
</head>
<style>
    .block.double-gap-top.double-gap-bottom {
        padding: 60px 0 !important;
    }

    /* Modal container */
    .modal {
        display: none;
        /* Hide modal by default */
        position: fixed;
        /* Fixed position to overlay on top of the page content */
        z-index: 1000;
        /* Ensure it's above other content */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        /* Enable scrolling if modal content exceeds viewport */
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black background */
    }


    /* Modal content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 368px;
        position: relative;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        max-height: 90vh;
        overflow-y: auto;
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    button#onesignal-slidedown-allow-button {
        border: 2px solid #fdfbfb;
    }

    button#onesignal-slidedown-cancel-button {
        border: 2px solid #fdfbfb;
    }


    /* //lodear css start */
    .loader {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #000;
    }

    .loader img {
        width: 100px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-30px);
        }

        60% {
            transform: translateY(-15px);
        }
    }

    .loader img {
        width: 100px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.21);
        }

        100% {
            transform: scale(1);
        }
    }

    .loader {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader img {
        width: 100px;
    }

    .spinner {
        position: absolute;
        border: 8px solid #fff;
        /* Light grey */
        border-top: 8px solid #26ae61;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* //lodear css end */
    /* Modal backdrop */
    /* Modal Backdrop */
    #whatsappJoinModal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.5);

        display: flex;
        justify-content: center;
        align-items: center;
        /* ❤️ yahi center karega vertically */
    }

    /* Modal Box */
    .modal-dialog {
        max-width: 500px;
        position: relative;
        margin: 0 auto;
    }

    .btn-close-custom {
        position: absolute;
        top: 0.5rem;
        right: 0.75rem;
        font-size: 2rem;
        /* Bigger cross */
        font-weight: 700;
        background: none;
        border: none;
        color: #000;
        cursor: pointer;
        line-height: 1;
        padding: 0;
    }

    .btn-close-custom:hover,
    .btn-close-custom:focus {
        color: #dc3545;
        /* Reddish hover effect */
        outline: none;
    }

    body.modal-open {
        overflow: hidden !important;
        padding-right: 0 !important;
    }
</style>

<body>
    @if ($web_config['whatsappJoinModal']->value == 1)
        <div id="whatsappJoinModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg whatsapp-modal p-3 position-relative">

                    <!-- Top Close Button -->
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title w-100 text-center text-success fw-bold m-0" id="whatsappJoinLabel">
                            <i class="fa fa-whatsapp me-1"></i> Join Our WhatsApp Channel
                        </h5>
                        <button type="button" id="closeTop" class="btn-close-custom" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body text-center pt-2">
                        <p>Get the latest job updates directly on your WhatsApp!</p>
                        <img src="{{ asset('public/assets/images/qrcode.jfif') }}" alt="WhatsApp QR Code"
                            class="img-fluid mb-3 qr-animation" style="max-width: 200px;">
                        <a href="https://www.whatsapp.com/channel/0029VatdEVhEquiMEWJ1Ex1t" target="_blank"
                            class="btn btn-success px-4 py-2">
                            <i class="fa fa-whatsapp"></i> Join Now
                        </a>
                        {{-- <br><br> --}}
                        <!-- Bottom Close Button -->
                        {{-- <button type="button" class="btn btn-outline-danger mt-2" id="closeBottom">
                        Close
                    </button> --}}
                    </div>

                </div>
            </div>
        </div>
    @endif
    <div id="myModal" class="modal">
        <div class="modal-content">
            {{-- <span class="close">&times;</span> --}}
            <div id="normal-slidedown">
                <div class="slidedown-body" id="slidedown-body">
                    <div class="slidedown-body-icon">
                        <img alt="notification icon" src="{{ asset('resources/assets/images/resource/logo9.png') }}">
                        <div class="slidedown-body-message">
                            Get Important Jobs Notifications Immediately!<br>Government
                            /Private /Multinational /Overseas</div>
                    </div>
                </div>
                <br>
                <div class="slidedown-footer" id="slidedown-footer">
                    <button class="align-right primary slidedown-button"
                        id="onesignal-slidedown-allow-button">Allow</button>
                    {{-- <button class="align-right secondary slidedown-button close"
                        id="onesignal-slidedown-cancel-button">Close</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="page-loading">
        {{-- <img src="{{ asset('resources/assets/images/loader.gif') }}" alt="Loading animation" />
        <span>Skip Loader</span> --}}
        <div class="loader">
            <div class="spinner"></div>
            <img src="https://thejobz.pk/resources/assets/images/resource/logo9.png" alt="Logo">
        </div>
    </div>
    <div class="theme-layout" id="scrollup">

        <div class="responsive-header five">
            <div class="responsive-menubar">
                <div class="res-logo"><a href="{{ route('home') }}" title=""> <img
                            src="{{ asset('resources/assets/images/resource/logo8.png') }}" alt="Logo" /></a></div>
                <div class="menu-resaction">
                    <div class="res-openmenu">
                        <img src="{{ asset('resources/assets/images/icon.png') }}" alt="Icon" /> Menu
                    </div>
                    <div class="res-closemenu">
                        <img src="{{ asset('resources/assets/images/icon2.png') }}" alt="Icon" /> Close
                    </div>
                </div>
            </div>
            <div class="responsive-opensec">
                <div class="btn-extars">
                    {{-- <a href="#" title="" class="post-job-btn"><i class="la la-plus"></i>Post Jobs</a> --}}
                    {{-- <ul class="account-btns">
                        <li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
                        <li class="signin-popup"><a title=""><i class="la la-external-link-square"></i>
                                Login</a>
                        </li>
                    </ul> --}}
                </div><!-- Btn Extras -->
                <form class="res-search">
                    <input type="text" placeholder="Job title, keywords or company name" />
                    <button type="submit"><i class="la la-search"></i></button>
                </form>
                <div class="responsivemenu">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}" title="">Home</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#" title="">Citys</a>
                            @php
                                $city = popular_job_city();
                            @endphp
                            <ul>
                                @if ($city)
                                    @foreach ($city as $c)
                                        @if ($c && isset($c->slug) && isset($c->name) && isset($c->city_count))
                                            @php
                                                $formattedSlug = ucfirst($c->slug);
                                                $routeUrl = route('job-city', $formattedSlug);
                                            @endphp
                                            <li>
                                                <a href="{{ $routeUrl }}" title="">
                                                    {{ $c->name }}
                                                    <small>jobs ({{ $c->city_count }})</small>
                                                </a>
                                            </li>
                                        @else
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#" title="">Categories</a>
                            @php
                                $categories = popular_job_categories();
                            @endphp
                            <ul>
                                @if ($categories)
                                    @foreach ($categories as $ca)
                                        @if ($ca && isset($ca->slug) && isset($ca->name) && isset($ca->department_count))
                                            <li>
                                                <a href="{{ route('job-department', $ca->slug) }}" title="">
                                                    {{ $ca->name }}
                                                    <small>jobs ({{ $ca->department_count }})</small>
                                                </a>
                                            </li>
                                        @else
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            @php
                                // teaching
                                // garments
                                $categories_name = popular_job_categories_name('army');
                            @endphp
                            <a href="#" title="">Pak army jobs</a>
                            <ul>
                                @if ($categories_name)
                                    @foreach ($categories_name as $cn)
                                        @if ($cn && isset($cn->slug) && isset($cn->name) && isset($cn->department_count))
                                            <li>
                                                <a href="{{ route('job-department', $cn->slug) }}" title="">
                                                    {{ $cn->name }}
                                                    <small>jobs ({{ $cn->department_count }})</small>
                                                </a>
                                            </li>
                                        @else
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            @php
                                // teaching
                                // garments
                                $categories_name_t = popular_job_categories_name('teaching');
                            @endphp
                            <a href="#" title="">Teaching jobs</a>
                            <ul>
                                @if ($categories_name_t)
                                    @foreach ($categories_name_t as $cn_t)
                                        @if ($cn_t && isset($cn_t->slug) && isset($cn_t->name) && isset($cn_t->department_count))
                                            <li>
                                                <a href="{{ route('job-department', $cn_t->slug) }}" title="">
                                                    {{ $cn_t->name }}
                                                    <small>jobs ({{ $cn_t->department_count }})</small>
                                                </a>
                                            </li>
                                        @else
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <header class="style5">
            <div class="menu-sec">
                <div class="container fluid">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{ route('home') }}" title="">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#" title="">Citys</a>
                                @php
                                    $city = popular_job_city();
                                @endphp
                                <ul>
                                    @if ($city)
                                        @foreach ($city as $c)
                                            @if ($c && isset($c->slug) && isset($c->name) && isset($c->city_count))
                                                @php
                                                    $formattedSlug = ucfirst($c->slug);
                                                    $routeUrl = route('job-city', $formattedSlug);
                                                @endphp
                                                <li>
                                                    <a href="{{ $routeUrl }}" title="">
                                                        {{ $c->name }}
                                                        <small>jobs ({{ $c->city_count }})</small>
                                                    </a>
                                                </li>
                                            @else
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#" title="">Categories</a>
                                @php
                                    $categories = popular_job_categories();
                                @endphp
                                <ul>
                                    @if ($categories)
                                        @foreach ($categories as $ca)
                                            @if ($ca && isset($ca->slug) && isset($ca->name) && isset($ca->department_count))
                                                <li>
                                                    <a href="{{ route('job-department', $ca->slug) }}" title="">  {{ $ca->name }}  <small>jobs ({{ $ca->department_count }})</small>
                                                    </a>
                                                </li>
                                            @else
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                @php
                                    // teaching
                                    // garments
                                    $categories_name = popular_job_categories_name('army');
                                @endphp
                                <a href="#" title="">Pak army jobs</a>
                                <ul>
                                    @if ($categories_name)
                                        @foreach ($categories_name as $cn)
                                            @if ($cn && isset($cn->slug) && isset($cn->name) && isset($cn->department_count))
                                                <li>
                                                    <a href="{{ route('job-department', $cn->slug) }}"
                                                        title="">
                                                        {{ $cn->name }}
                                                        <small>jobs ({{ $cn->department_count }})</small>
                                                    </a>
                                                </li>
                                            @else
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- Menus -->
                    <div class="logo">
                        <a href="{{ route('home') }}" title=""><img
                                src="{{ asset('resources/assets/images/resource/logo8.png') }}" alt="Logo" /></a>
                    </div><!-- Logo -->
                    <div class="btn-extars">
                        {{-- <a href="#" title="" class="post-job-btn"><i class="la la-plus"></i>Post  Jobs</a> --}}
                        <ul class="account-btns">
                             <li>
                                <a href="{{ route('blogs') }}" title="">Blogs</a>
                            </li>
                        </ul>
                    </div><!-- Btn Extras -->
                </div>
            </div>
        </header>
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-alert">
                            {{ Session::get('alert-' . $msg) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        @yield('content')
        <footer class="style3">
            <div class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 column">
                            <div class="widget">
                                <div class="about_widget">
                                    <div class="logo">
                                        <a href="#" title=""><img
                                                src="{{ asset('resources/assets/images/resource/logo9.png') }}"
                                                alt="Logo" /></a>
                                    </div>
                                    {{-- <span>Collin Street West, Victor 8007, Australia.</span> --}}
                                    {{-- <span>+1 265-352-0455</span> --}}
                                    <span>info@demo.com</span>
                                    <div class="social">
                                        <a href="https://www.facebook.com/profile.php?id=61558140501160"
                                            title=""><i class="fa fa-facebook"></i></a>
                                        <a href="#" title=""><i class="fa fa-twitter"></i></a>
                                        <a href="#" title=""><i class="fa fa-linkedin"></i></a>
                                        <a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                        <a href="#" title=""><i class="fa fa-behance"></i></a>
                                    </div>
                                </div><!-- About Widget -->
                            </div>
                        </div>
                        <div class="col-lg-4 column">
                            <div class="widget">
                                <h3 class="footer-title">Frequently Asked Questions</h3>
                                <div class="link_widgets2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="{{ route('privacy-policy') }}" title="">Privacy &
                                                Seurty </a>
                                            <a href="#" title="">Terms of Serice</a>
                                            {{-- <a href="#" title="">Communications </a>
                                            <a href="#" title="">Referral Terms </a>
                                            <a href="#" title="">Lending Licnses </a> --}}
                                            {{-- <a href="#" title="">Disclaimers </a> --}}
                                        </div>
                                        <div class="col-lg-6">
                                            {{-- <a href="#" title="">Support </a>
                                            <a href="#" title="">How It Works </a>
                                            <a href="#" title="">For Employers </a>
                                            <a href="#" title="">Underwriting </a> --}}
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 column">
                            <div class="widget">
                                <h3 class="footer-title">
                                    {{-- Find Jobs --}}
                                </h3>
                                <div class="link_widgets2">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {{-- <a href="#" title="">US Jobs</a>
                                            <a href="#" title="">Canada Jobs</a>
                                            <a href="#" title="">UK Jobs</a>
                                            <a href="#" title="">Emplois en Fnce</a>
                                            <a href="#" title="">Jobs in Deuts</a>
                                            <a href="#" title="">Vacatures China</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 column">
                            <div class="widget">
                                <div class="download_widget">
                                    <a href="#" title="">
                                        <img src="{{ asset('resources/assets/images/resource/di.png') }}"
                                            alt="Feature coming soon" /> comming soon
                                    </a>
                                    <a href="#" title="">
                                        <img src="{{ asset('resources/assets/images/resource/di2.png') }}"
                                            alt="Feature coming soon" />comming soon
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-line style3">
                <div class="container">
                    <span>© 2025 Thejobz All rights reserved. Design by Creative Layers</span>
                    <a class="back-top" href="#scrollup" title=""><i class="la la-long-arrow-up"></i></a>
                </div>
            </div>
        </footer>
    </div>

    <div class="account-popup-area signin-popup-box">
        <div class="account-popup">
            <span class="close-popup"><i class="la la-close"></i></span>
            <h3>User Login</h3>
            <span>Click To Login With Demo User</span>
            <div class="select-user">
                <span>Candidate</span>
                <span>Employer</span>
            </div>
            <form>
                <div class="cfield">
                    <input type="text" placeholder="Username" />
                    <i class="la la-user"></i>
                </div>
                <div class="cfield">
                    <input type="password" placeholder="********" />
                    <i class="la la-key"></i>
                </div>
                <p class="remember-label">
                    <input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
                </p>
                <a href="#" title="">Forgot Password?</a>
                <button type="submit">Login</button>
            </form>
            <div class="extra-login">
                <span>Or</span>
                <div class="login-social">
                    <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                    <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div><!-- LOGIN POPUP -->
    <div class="account-popup-area signup-popup-box">
        <div class="account-popup">
            <span class="close-popup"><i class="la la-close"></i></span>
            <h3>Sign Up</h3>
            <div class="select-user">
                <span>Candidate</span>
                <span>Employer</span>
            </div>
            <form>
                <div class="cfield">
                    <input type="text" placeholder="Username" />
                    <i class="la la-user"></i>
                </div>
                <div class="cfield">
                    <input type="password" placeholder="********" />
                    <i class="la la-key"></i>
                </div>
                <div class="cfield">
                    <input type="text" placeholder="Email" />
                    <i class="la la-envelope-o"></i>
                </div>
                <div class="dropdown-field">
                    <select data-placeholder="Please Select Specialism" class="chosen">
                        <option>Web Development</option>
                        <option>Web Designing</option>
                        <option>Art & Culture</option>
                        <option>Reading & Writing</option>
                    </select>
                </div>
                <div class="cfield">
                    <input type="text" placeholder="Phone Number" />
                    <i class="la la-phone"></i>
                </div>
                <button type="submit">Signup</button>
            </form>
            <div class="extra-login">
                <span>Or</span>
                <div class="login-social">
                    <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                    <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div><!-- SIGNUP POPUP -->
    {{-- <script src="{{ asset('resources/assets/js/jquery.min.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('resources/assets/js/modernizr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/wow.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/parallax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/select-chosen.js') }}" type="text/javascript"></script>
    <script src="{{ asset('resources/assets/js/counter.js') }}" type="text/javascript"></script>
    @if ($web_config['adsterra_adds']->value == 1)
        <!-- @include('add.Popunder'); -->
    @endif
    @if ($web_config['adsterra_social_adds']->value == 1)
        @include('add.Social');
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var flashAlert = document.getElementById('flash-alert');
            if (flashAlert) {
                setTimeout(function() {
                    var alert = new bootstrap.Alert(flashAlert);
                    alert.close();
                }, 5000); // Auto-hide after 5 seconds
            }
        });
    </script>
    <script>
        // JavaScript to trigger the modal when the page loads
        // window.onload = function() {
        //     var modal = document.getElementById("myModal");
        //     var span = document.getElementsByClassName("close")[0];
        //     modal.style.display = "block";
        //     span.onclick = function() {
        //         modal.style.display = "none";
        //     }
        //     window.onclick = function(event) {
        //         if (event.target == modal) {
        //             // modal.style.display = "none";
        //         }
        //     }
        // }

        window.onload = function() {
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];

            var lastDisplayTime = localStorage.getItem("modalLastDisplayTime");
            var currentTime = new Date().getTime();


            // Function to show the modal
            function showModal() {
                //modal.style.display = "block";
                modal.style.display = "none";
                sessionStorage.setItem("modalLastDisplayTime", currentTime);
                localStorage.setItem("modalLastDisplayTime", currentTime);
            }

            function closeModal() {
                modal.style.display = "none";
            }
            if (!lastDisplayTime || (currentTime - lastDisplayTime > 3600)) { // 3600000 ms = 1 hour
                var sessionLastDisplayTime = sessionStorage.getItem("modalLastDisplayTime");
                if (!sessionLastDisplayTime || (currentTime - sessionLastDisplayTime > 3600)) {
                    // showModal();
                    @if ($web_config['adsterra_alert_adds']->value == 1)
                        showModal();
                    @endif
                } else {
                    localStorage.setItem("modalLastDisplayTime", currentTime);
                }
            }

            // Close the modal when the user clicks on the close button (x)
            // span.onclick = function() {
            //     closeModal();
            // }

            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function(event) {
                if (event.target == modal) {
                    closeModal();
                }
            }

            // Event listener for visibility change (tab focus change)
            document.addEventListener("visibilitychange", function() {
                if (!document.hidden && !sessionStorage.getItem("modalShownInCurrentTab")) {
                    // Tab has come into focus and modal hasn't been shown in this tab
                    var currentTime = new Date().getTime();
                    var sessionLastDisplayTime = sessionStorage.getItem("modalLastDisplayTime");
                    if (!sessionLastDisplayTime || (currentTime - sessionLastDisplayTime > 3600000)) {
                        // Show modal if it hasn't been shown in this session or within the last hour
                        showModal();
                        sessionStorage.setItem("modalShownInCurrentTab", true);
                    } else {
                        // Modal already shown in this session within the last hour
                        localStorage.setItem("modalLastDisplayTime", currentTime);
                    }
                }
            });
        }



        $(document).ready(function() {

            $('#example').DataTable();
            $("body").on("click", "#onesignal-slidedown-allow-button", function(event) {
                event.preventDefault();
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
                window.open(
                    "https://www.effectiveratecpm.com/bgf9d0kij?key=c45875d7b3dfdacfb4fedd2229423b26",
                    "_blank");
            });

        });
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('whatsappJoinModal').style.display = 'block';
        });

        // Close buttons
        document.getElementById('closeTop').addEventListener('click', function() {
            document.getElementById('whatsappJoinModal').style.display = 'none';
        });

        document.getElementById('closeBottom').addEventListener('click', function() {
            document.getElementById('whatsappJoinModal').style.display = 'none';
        });
    </script>


</body>

</html>
