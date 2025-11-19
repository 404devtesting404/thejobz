@extends('layouts.app1')
@php
    $fullUrl = url()->full();
    $path = parse_url($fullUrl, PHP_URL_PATH);
    $segments = explode('/', $path);
    $cityName = end($segments);
    $endpoint = ucfirst(preg_replace('/[^a-zA-Z ]/', ' ', $cityName));
    $endpoint_capital = strtoupper(trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $cityName))));
@endphp

@section('title')
    Blogs {{ $endpoint_capital }} Jobs | Career Advice - TheJobz.pk
@endsection

@section('meta')
    {{-- <meta name="keywords"  content="career advice blogs, job tips, employment blogs, resume writing, interview tips, career growth, job search strategies, salary negotiation, workplace skills"> --}}
    <meta name="description" content="Read insightful blog posts on career advice, job search tips, resume writing, interview techniques, and more. Stay updated with employment trends and expert guidance for your professional growth.">
    <link rel="canonical" href="{{ $fullUrl }}" />
    <meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="Career Advice & Job Search Tips | Blog - TheJobz.pk" />
    <meta property="og:url" content="{{ $fullUrl }}" />
    <meta property="og:description"  content="Discover the latest blogs on job search strategies, interview preparation, resume building, and workplace success. Your guide to building a successful career in Pakistan.">
    <meta property="og:image" content="{{ asset('images/thejobz-blog-default.jpg') }}" />
   <meta name="twitter:card" content="summary" />
   <meta name="twitter:site" content="@thejobzdotpk" />
   <meta name="twitter:title" content="Career Advice & Job Search Tips | Blog - TheJobz.pk" />
   <meta name="twitter:description" content="Discover the latest blogs on job search strategies, interview preparation, resume building, and workplace success. Your guide to building a successful career in Pakistan.">
@endsection

@section('content')
    <section class="blogs-page">
        <div class="block remove-top">
            <div class="container position-relative">

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
                <br>
                <section
                    class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white pt-48 pb-20 overflow-hidden">
                    <div class="absolute inset-0 opacity-20 bg-pattern"></div>
                    <div class="container mx-auto px-6 text-center relative z-10">
                        <h1 class="text-4xl md:text-5xl font-extrabold mb-6 animate-fade-in">
                            Career Advice & Job Tips for {{ $endpoint_capital }}
                        </h1>
                    </div>
                </section>

                @if ($web_config['adsterra_adds']->value == 1)
                    <div class="Banner_728x90 mb-4 text-center">
                        @include('add.Banner_728x90')
                    </div>
                    <div class="col-12 text-center mb-4 Banner_300x250">
                        @include('add.Banner_300x250')
                    </div>
                @endif


                <!-- ✅ Blogs Content -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach ($blogs as $index => $blog)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="job-card shadow-sm h-100">
                                        <div class="job-img-container">
                                            @if ($blog->image)
                                                <img src="{{ asset('storage/app/public/' . $blog->image) }}"
                                                    alt="{{ $blog->title }}" class="job-img">
                                            @else
                                                <img src="{{ asset('images/default-blog.jpg') }}" alt="Default blog image"
                                                    class="job-img">
                                            @endif
                                        </div>
                                        <div class="job-content p-3">
                                            <h3 class="job-title">{{ $blog->title }}</h3>
                                            <div class="job-meta text-muted mb-2">
                                                <small>📅 {{ $blog->created_at->format('M d, Y') }}</small>
                                            </div>
                                            <p class="job-excerpt mb-3">
                                                {{ Str::limit(strip_tags($blog->description), 120) }}
                                            </p>
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-success btn-sm">
                                                Read More <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @if ($web_config['adsterra_adds']->value == 1)
                                    @if (($index + 1) % 3 == 0)
                                        <div class="col-12 text-center mb-4 Banner_300x250">
                                            @include('add.Banner_300x250')
                                        </div>
                                    @endif
                                    {{-- Har 5th blog ke baad Native ad --}}
                                    @if (($index + 1) % 5 == 0)
                                        <div class="col-12 text-center mb-4 Native">
                                            @include('add.Native')
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- ✅ Bottom Ads -->
                @if ($web_config['adsterra_adds']->value == 1)
                    <div class="Banner_728x90 mb-4 text-center">
                        @include('add.Banner_728x90')
                    </div>
                    <div class="col-12 text-center mb-4 Banner_300x250">
                        @include('add.Banner_300x250')
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
