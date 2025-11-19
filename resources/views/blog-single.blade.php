@extends('layouts.app1')

@section('title')
    {!! $blog->meta_title ?: $blog->title !!}
@endsection

@section('meta')
    {{-- <meta name="keywords" content="{{ $blog->meta_keywords ?: '' }}"> --}}
    <meta name="description" content="{{ $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160) }}">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="{{ $blog->meta_title ?: $blog->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:description" content="{{ $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:image" content="{{ asset($blog->image ?: 'images/default-blog.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $blog->meta_title ?: $blog->title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160) }}">
    <meta name="twitter:image" content="{{ asset($blog->image ?: 'images/default-blog.jpg') }}">
@endsection

@section('content')
    <div class="blog-container">
        <div class="blog-inner">
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
            <header>
                <h1 class="blog-title">{{ $blog->title }}</h1>
                <div class="blog-meta">
                    <span>By {{ $blog->author->name ?? 'Admin' }}</span>
                    <span>{{ $blog->created_at->format('F j, Y') }}</span>
                    {{-- <span>{{ $blog->reading_time ?? ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span> --}}
                </div>
            </header>
            @if ($web_config['adsterra_adds']->value == 1)
                <div class="Banner_728x90 mb-4 text-center">
                    @include('add.Banner_728x90')
                </div>
                <div class="col-12 text-center mb-4 Banner_300x250">
                    @include('add.Banner_300x250')
                </div>
            @endif

            @if ($blog->image)
                <div class="featured-image">
                    <img src="{{ asset('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}">
                </div>
            @else
                <div class="featured-image">
                    <img src="{{ asset('images/default-blog.jpg') }}" alt="Default blog image">
                </div>
            @endif

            <article class="blog-content">
                {!! $blog->description !!}
            </article>

            @if ($blog->tags && $blog->tags->count() > 0)
                <div class="blog-tags">
                    <strong>Tags:</strong>
                    @foreach ($blog->tags as $tag)
                        <a href="{{ route('blog.tag', $tag->slug) }}" class="tag">{{ $tag->name }}</a>
                    @endforeach
                </div>
            @endif
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


    <script>
        $(document).ready(function() {
            $('.blog-content img').addClass('img-fluid');

            $('a[href^="#"]').on('click', function(event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top
                }, 500);
            });
        });
    </script>

@endsection
