@extends('layouts.app1')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@section('title') Pakistan’s #1 Job Portal | Find Latest Jobs Online – TheJobz.pk @endsection
@section('meta')
    <!--<meta name="keywords" content="Jobs in Pakistan, latest jobs Pakistan, government jobs Pakistan, private jobs Pakistan, newspaper jobs Pakistan, banking jobs Pakistan, IT jobs Pakistan, marketing jobs Pakistan, finance jobs Pakistan, online jobs Pakistan 2025">-->
    <meta name="description" content="Discover thousands of verified job listings in Pakistan. Search by city or industry and apply online through Pakistan’s most trusted job portal – TheJobz.pk.">
    <link rel="canonical" href="https://thejobz.pk/" />
    <meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="Pakistan’s #1 Job Portal | Find Latest Jobs Online – TheJobz.pk" />
    <meta property="og:url" content="https://thejobz.pk/" />
    <meta property="og:description"  content="Discover thousands of verified job listings in Pakistan. Search by city or industry and apply online through Pakistan’s most trusted job portal – TheJobz.pk.">
    <meta property="og:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@thejobzdotpk" />
    <meta name="twitter:title" content="Pakistan’s #1 Job Portal | Find Latest Jobs Online – TheJobz.pk" />
    <meta name="twitter:description" content="Discover thousands of verified job listings in Pakistan. Search by city or industry and apply online through Pakistan’s most trusted job portal – TheJobz.pk.">
    <meta name="twitter:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png" />
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="720">
@endsection
@section('JSON_D_Schema')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "TheJobz.pk",
      "url": "https://thejobz.pk/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://thejobz.pk/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "TheJobz.pk",
      "url": "https://thejobz.pk/",
      "logo": "https://thejobz.pk/resources/assets/images/resource/logo9.png",
      "sameAs": [
        "https://www.facebook.com/thejobzdotpk",
        "https://twitter.com/thejobzdotpk",
        "https://www.linkedin.com/company/thejobzpk"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+92-300-1234567",
        "contactType": "customer support",
        "areaServed": "PK",
        "availableLanguage": "Urdu, English"
      }
    }
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://thejobz.pk/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Latest Jobs",
          "item": "https://thejobz.pk/latest-jobs"
        }
      ]
    }
    </script>
@endsection
@section('content')
    <section class="hero d-flex align-items-center justify-content-center text-center">
        <div class="container">
            <div class="inner">
                <h1 class="text-white mb-4">Find the Best Jobs in Pakistan — Apply Online Today</h1>
                <p class="dec_main">TheJobz.pk is Pakistan’s #1 online job platform connecting employers and job seekers. Browse thousands of fresh job listings in IT, marketing, engineering, sales, and more — start your career journey today!</p>
                <form method="post" action="{{ route('search') }}">
                    @csrf
                    <input type="text" name="keyword" class="form-control" placeholder="Search jobs...">
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
        </div>
    </section>

    <!-- ✅ Top Banner -->
    @if ($web_config['adsterra_adds']->value == 1)
        <div class="Banner_728x90 text-center my-4">
            @include('add.Banner_728x90')
        </div>
    @endif



    <div class="container my-5">
        <h2 class="section-title">Popular Categories</h2>
        <div class="row">
            @foreach ($popular_job_department as $pjd)
                @if ($pjd && isset($pjd->slug) && isset($pjd->name) && isset($pjd->department_count))
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card card-simple text-center p-3">
                            <a href="{{ url('job-department/' . $pjd->slug) }}" class="text-dark text-decoration-none">
                                <img src="{{ asset('resources/assets/images/job_department/' . $pjd->icon) }}"
                                    alt="{{ $pjd->name }} Icon" class="mb-2" width="40" height="40">
                                <h5 class="mb-1">{{ $pjd->name }}</h5>
                            </a>
                            <p class="text-muted small">{{ $pjd->department_count }} Jobs</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- ✅ Left Sidebar Ads -->
    @if ($web_config['adsterra_adds']->value == 1)
        <div class="sidebar-left">
            <div class="sidebar-ad mb-3 text-center" style="position: relative;">
                <button type="button" class="sidebar-left-ad-close">
                    &times;
                </button>
                @include('add.Banner_160x600')
            </div>
            <div class="sidebar-ad mb-3 text-center">
                {{-- @include('add.Banner_160x300') --}}
            </div>
        </div>
    @endif


    <!-- Right Sidebar Ads -->
    @if ($web_config['adsterra_adds']->value == 1)
        <div class="sidebar-right">
            <div class="sidebar-ad mb-3 text-center" style="position: relative;">
                <button type="button" class="sidebar-right-ad-close">
                    &times;
                </button>
                @include('add.Banner_160x600')
            </div>
            <div class="sidebar-ad mb-3 text-center">
                {{-- @include('add.Banner_160x300') --}}
            </div>
        </div>
    @endif

    <!-- ✅ Popular Cities -->
    <div class="container my-5">
        <h2 class="section-title">Top Job Opportunities by City</h2>
        <p class="dec_citys">Looking for jobs near your location? Explore thousands of openings in Karachi, Lahore, Islamabad, Faisalabad, Rawalpindi, and other major cities of Pakistan. Whether you’re starting your career or switching roles, find verified employers hiring in your city today.</p>
        <div class="row">
            @foreach ($popular_job_city as $pjc)
                <div class="col-md-2 col-6 mb-3">
                    <div class="card card-simple py-3 text-center">
                        <a href="{{ route('job-city', strtolower($pjc->name)) }}" class="text-dark text-decoration-none">
                            <img src="{{ asset('resources/assets/images/job_city/' . $pjc->icon) }}"
                                alt="{{ $pjc->name }} Icon" class="mb-2 mx-auto d-block" width="40" height="40">
                            <h6 class="mb-1">{{ $pjc->name }}</h6>
                        </a>
                        <span class="text-muted small">{{ $pjc->city_count }} Jobs</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if ($web_config['adsterra_adds']->value == 1)
        <div class="col-12 text-center my-4 Banner_300x250">
            @include('add.Banner_300x250')
        </div>
    @endif
    <!-- ✅ Featured Jobs -->
    <div class="container my-5">

            <h3 class="section-title">Featured Openings from Trusted Employers</h3>
            <p class="dec_featured">Discover the most in-demand job openings selected by our career experts. Browse featured jobs from verified companies across industries like IT, marketing, finance, healthcare, and education. Apply today and take the next step in your professional journey.</p>

        @if ($web_config['adsterra_adds']->value == 1)
            <div class="Banner_728x90 text-center my-4">
                @include('add.Banner_728x90')
            </div>
        @endif
        <div class="job-listings-sec style2">
            <table id="data-table"></table>
        </div>
        @if ($web_config['adsterra_adds']->value == 1)
            <div class="col-12 text-center my-4 Banner_300x250">
                @include('add.Banner_300x250')
            </div>

            <!-- ✅ Native Ad -->
            <div class="col-12 text-center my-4 Native">
                @include('add.Native')
            </div>

            <div class="Banner_728x90 text-center my-4">
                @include('add.Banner_728x90')
            </div>
        @endif
    </div>

    <!-- ✅ How It Works -->
    <div class="container my-5">
        <h4 class="section-title">Find Jobs, Apply Online & Get Hired — It’s Simple!</h4>
        <p class="dec_featured">Get hired by top companies across Pakistan.</p>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-simple text-center">
                    <i class="fa fa-search fa-2x text-success mb-3"></i>
                    <h5>Search Jobs</h5>
                    <p class="small text-muted">Find jobs across multiple categories and cities.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-simple text-center">
                    <i class="fa fa-user-plus fa-2x text-success mb-3"></i>
                    <h5>Create Account</h5>
                    <p class="small text-muted">Register for free and upload your CV.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-simple text-center">
                    <i class="fa fa-paper-plane fa-2x text-success mb-3"></i>
                    <h5>Apply & Get Hired</h5>
                    <p class="small text-muted">Apply on your desired jobs and get hired quickly.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Stats -->
    <!-- ✅ Stats Section -->
    <div class="stats py-5 bg-light">
        <div class="container">
            <div class="row text-center">

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-box shadow-sm p-4 rounded">
                        <h4 class="count" data-target="{{ $jobsCount }}">0</h4>
                        <p>Total Jobs</p>
                    </div>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-box shadow-sm p-4 rounded">
                        <h4 class="count" data-target="{{ $departmentCount }}">0</h4>
                        <p>Companies</p>
                    </div>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-box shadow-sm p-4 rounded">
                        <h4 class="count" data-target="{{ $job_cityCount }}">0</h4>
                        <p>Cities</p>
                    </div>
                </div>

                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-box shadow-sm p-4 rounded">
                        <h4 class="count" data-target="1212">0</h4>
                        <p>Users</p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- ✅ Hiring Banner -->
    <div class="container my-5">
        <div class="card bg-success text-white text-center p-5">
            <h3 class="mb-3">Looking to Hire?</h3>
            <p class="mb-4">Post your job today and connect with thousands of candidates instantly.</p>
            <a href="{{ url('post-job') }}" class="btn btn-light">Post a Job</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".count");
            const speed = 200; // animation speed

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute("data-target");
                    const count = +counter.innerText;

                    const increment = Math.ceil(target / speed);

                    if (count < target) {
                        counter.innerText = count + increment;
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        });
        $(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ordering: false,
                bLengthChange: false,
                ajax: "{{ route('home') }}",
                columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>
@endsection
