<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('resources/assets/images/resource/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('resources/assets/images/resource/favicon.png') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/my.css') }}" />
    @yield('JSON_D_Schema')
</head>

<body>
    @if ($web_config['whatsappJoinModal']->value == 1)
        <!-- ✅ WhatsApp Join Modal -->
        <div class="modal fade" id="whatsappJoinModal" tabindex="-1" role="dialog" aria-labelledby="whatsappJoinLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-lg">

                    <!-- Header -->
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-success font-weight-bold mx-auto" id="whatsappJoinLabel">
                            <i class="fa fa-whatsapp mr-1"></i> Join Our WhatsApp Channel
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body text-center">
                        <p class="mb-3">Get the latest job updates directly on your WhatsApp!</p>
                        <img src="{{ asset('public/assets/images/qrcode.jfif') }}" alt="WhatsApp QR Code"
                            class="img-fluid mb-3" style="max-width:200px;">
                        <a href="https://www.whatsapp.com/channel/0029VatdEVhEquiMEWJ1Ex1t" target="_blank"
                            class="btn btn-success btn-block">
                            <i class="fa fa-whatsapp"></i> Join Now
                        </a>
                    </div>

                </div>
            </div>
        </div>
    @endif

    <!-- ✅ Notification Modal -->
    <div class="modal fade" id="jobNotificationModal" tabindex="-1" role="dialog" aria-labelledby="jobNotifyLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow border-0 rounded-lg">

                <div class="modal-body text-center p-4">
                    <img alt="notification icon" class="mb-3"
                        src="{{ asset('resources/assets/images/resource/logo8.png') }}" style="max-width:70px;">
                    <h5 class="mb-3">Get Important Jobs Notifications Immediately!</h5>
                    <p class="text-muted small mb-4">Government / Private / Multinational / Overseas</p>
                    <button class="btn btn-success btn-block mb-2" id="onesignal-slidedown-allow-button">Allow</button>
                    <button class="btn btn-outline-danger btn-block" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="page-loading">
        <div class="loader">
            <div class="spinner"></div>
            <img src="https://thejobz.pk/resources/assets/images/resource/logo9.png" alt="Logo">
        </div>
    </div> --}}

    <!-- ✅ Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('resources/assets/images/resource/logo9.png') }}" alt="TheJobz Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="/jobs">Jobs</a></li> --}}

                    <!-- Cities -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="citiesDropdown"
                            data-toggle="dropdown">Cities</a>
                        <div class="dropdown-menu">
                            @php
                                $city = popular_job_city();
                            @endphp
                            @if ($city)
                                @foreach ($city as $c)
                                    @if ($c && isset($c->slug) && isset($c->name) && isset($c->city_count))
                                        @php
                                            $formattedSlug = $c->slug;
                                            $routeUrl = route('job-city', $formattedSlug);
                                        @endphp


                                        <a class="dropdown-item" href="{{ $routeUrl }}">{{ $c->name }}</a>
                                    @else
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </li>

                    <!-- Categories -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown"
                            data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                            @php
                                $categories = popular_job_categories();
                            @endphp
                            @if ($categories)
                                @foreach ($categories as $ca)
                                    @if ($ca && isset($ca->slug) && isset($ca->name) && isset($ca->department_count))
                                        <a class="dropdown-item"
                                            href="{{ route('job-department', $ca->slug) }}">{{ $ca->name }}</a>
                                    @endif
                                @endforeach
                            @endif

                        </div>
                    </li>

                    <!-- Paper -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown"
                            data-toggle="dropdown">Newspaper</a>
                        <div class="dropdown-menu">
                            @php
                                $paper_jobs = popular_job_news_paper();
                            @endphp
                            @if ($paper_jobs)
                                @foreach ($paper_jobs as $ca)
                                    @php
                                        $find = ['_', 'jobs'];
                                        $replace = [' ', ''];
                                        $result = str_replace($find, $replace, $ca->paper_name);
                                        // -------------------------------------------------------
                                        $url_find = ['_', 'jobs'];
                                        $url_replace = ['', ''];
                                        $url = str_replace($url_find, $url_replace, $ca->paper_name);
                                    @endphp
                                    <a class="dropdown-item"
                                        href="{{ route('job-newspaper', $url) }}">{{ ucfirst($result) }}</a>
                                @endforeach
                            @endif

                        </div>
                    </li>
                    <!-- Pak Army Jobs -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="armyDropdown"
                            data-toggle="dropdown">Pak
                            Army Jobs</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('pak-army-jobs')}}">Army</a>
                            <a class="dropdown-item" href="{{route('pak-navy-jobs')}}">Navy</a>
                            <a class="dropdown-item" href="{{route('pak-airforce-jobs')}}">Air Force</a>
                            <a class="dropdown-item" href="{{route('civilian-jobs')}}">Civilian Jobs</a>
                        </div>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('gold-rates') }}">Gold Rates</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blogs') }}">Blog</a></li>
                </ul>
                <!--<div class="ml-auto">-->
                <!--    @guest-->
                <!--        <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">Login</a>-->
                <!--        <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>-->
                <!--    @else-->
                <!--        {{-- <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm">Dashboard</a> --}}-->
                <!--        <a href="#" class="btn btn-success btn-sm">Dashboard</a>-->
                <!--    @endguest-->

                <!--</div>-->
            </div>
        </div>
    </nav>

    @yield('content')
                @include('auto-append')
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- ✅ About + Logo -->
                <div class="col-md-3 text-center text-md-left mb-4 mb-md-0">
                    <img src="{{ asset('resources/assets/images/resource/logo12.png') }}" alt="TheJobz Logo"
                        style="max-width:150px;" class="mb-3">
                    <p>TheJobz.pk is Pakistan’s top job portal helping job seekers and companies connect.</p>
                    <div class="social-icons mt-3">
                        <a href="https://www.facebook.com/profile.php?id=61558140501160" target="_blank"
                            aria-label="Follow us on Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://whatsapp.com/channel/0029VatdEVhEquiMEWJ1Ex1t" target="_blank"
                            aria-label="Chat with us on WhatsApp">
                            <i class="fa fa-whatsapp"></i>
                        </a>
                        {{-- <a href="https://linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a> --}}
                        {{-- <a href="https://youtube.com" target="_blank"><i class="fa fa-youtube"></i></a> --}}
                    </div>
                </div>

                <!-- ✅ Quick Links -->
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        {{-- <li><a href="{{ route('about') }}">About</a></li> --}}
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy & Security</a></li>
                        <li><a href="{{ route('contact') }}">Contact us</a></li>

                    </ul>
                </div>

                <!-- ✅ For Employers -->
                {{-- <div class="col-md-3">
                    <h5>For Employers</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Post a Job</a></li>
                        <li><a href="#">Search Resumes</a></li>
                        <li><a href="#">Employer Login</a></li>
                    </ul>
                </div> --}}

                <!-- ✅ Contact -->

                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p>Email: support@thejobz.pk</p>
                  {{--   <p>Phone:+923001234567</p>--}}
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 TheJobz.pk — All Rights Reserved</p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Agar WhatsApp modal enable hai to show karo
            // @if ($web_config['whatsappJoinModal']->value == 1)
            //     $('#whatsappJoinModal').modal('show');
            // @endif

            // Agar notification modal bhi show karna ho to yeh use karo
            // $('#jobNotificationModal').modal('show');
        });
        document.addEventListener("DOMContentLoaded", function() {
            // close button click → hide wrapper
            document.querySelectorAll(".ad-close").forEach(function(btn) {
                btn.addEventListener("click", function() {
                    this.parentElement.style.display = "none";
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Left sidebar close button
            const leftBtn = document.querySelector(".sidebar-left-ad-close");
            const rightBtn = document.querySelector(".sidebar-right-ad-close");

            if (leftBtn) {
                // 2 second baad button show hoga
                setTimeout(() => {
                    leftBtn.style.display = "block";
                }, 2000);

                // click par ad ko hide karo
                leftBtn.addEventListener("click", function() {
                    this.closest(".sidebar-ad").style.display = "none";
                });
            }

            if (rightBtn) {
                // 2 second baad button show hoga
                setTimeout(() => {
                    rightBtn.style.display = "block";
                }, 2000);

                // click par ad ko hide karo
                rightBtn.addEventListener("click", function() {
                    this.closest(".sidebar-ad").style.display = "none";
                });
            }
        });
    </script>
    @yield('scripts')

</body>

</html>
