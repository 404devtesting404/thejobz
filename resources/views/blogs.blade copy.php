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
    <meta name="keywords"
        content="career advice blogs, job tips, employment blogs, resume writing, interview tips, career growth, job search strategies, salary negotiation, workplace skills">
    <meta name="description"
        content="Read insightful blog posts on career advice, job search tips, resume writing, interview techniques, and more. Stay updated with employment trends and expert guidance for your professional growth.">
    <link rel="canonical" href="{{ $fullUrl }}" />
    <meta property="og:title" content="Career Advice & Job Search Tips | Blog - TheJobz.pk" />
    <meta property="og:description"
        content="Discover the latest blogs on job search strategies, interview preparation, resume building, and workplace success. Your guide to building a successful career in Pakistan.">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $fullUrl }}" />
    <meta property="og:image" content="{{ asset('images/thejobz-blog-default.jpg') }}" />
@endsection

@section('content')
    <section class="blogs-page">
        <div class="block remove-top">
            <div class="container">

                <!-- ✅ Heading -->
                <div class="heading left mt-5">
                    <h2 class="mb-4">Career Advice & Job Tips for {{ $endpoint_capital }}</h2>
                </div>

                <!-- ✅ Top Banner -->
                <div class="mb-4 text-center">
                    @include('add.Banner_728x90')
                </div>

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

                        {{-- ✅ Har 3rd blog ke baad Banner_300x250 --}}
                        @if (($index + 1) % 3 == 0)
                            <div class="col-12 text-center mb-4">
                                @include('add.Banner_300x250')
                            </div>
                        @endif

                        {{-- ✅ Har 5th blog ke baad Native ad --}}
                        @if (($index + 1) % 5 == 0)
                            <div class="col-12 text-center mb-4">
                                @include('add.Native')
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- ✅ Sidebar Ads (agar sidebar layout use karna ho to isko shift kar do) -->


                <!-- ✅ Bottom Ads -->
                {{-- <div class="text-center mt-4">
                    @include('add.Banner_468x60')
                </div>
                <div class="text-center mt-3">
                    @include('add.Banner_320x50')
                </div> --}}
                <div class="text-center mt-3">
                    @include('add.Banner_728x90')
                </div>

                <!-- ✅ Pagination -->
                <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                    {{ $blogs->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
@endsection
