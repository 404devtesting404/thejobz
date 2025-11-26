@extends('layouts.app1')
@php
    $fullUrl = url()->full();
    $path = parse_url($fullUrl, PHP_URL_PATH);
    $segments = explode('/', $path);
    $cityName = end($segments);
    // $endpoint = ucfirst(str_replace('_', ' ', $cityName));
    $endpoint = trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $cityName)));
    $endpoint_capital = strtoupper(trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $endpoint))));
@endphp

@section('title')
    {!! $data['title'] !!}
@endsection
@section('meta')
    {{-- <meta name="keywords" content="{!! $meta_data['keywords'] !!}"> --}}
    <meta name="description" content="{!! $meta_data['description'] !!}">
    <link rel="canonical" href="{!!  $fullUrl !!}" />
    <meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="{!! $meta_data['title'] !!}">
    <meta property="og:description" content="{!! $meta_data['og_description'] !!}">
    <meta property="og:url" content="{!! $meta_data['canonical'] !!}">
    <meta property="og:image" content="{!! $meta_data['og_image'] !!}">
    <meta property="og:image:alt" content="{!! $meta_data['og_title'] !!}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@thejobzdotpk">
    <meta name="twitter:title" content="{!! $meta_data['twitter_title'] !!}">
    <meta name="twitter:description" content="{!! $meta_data['twitter_description'] !!}">
    <meta name="twitter:image" content="{!! $meta_data['og_image'] !!}">
    <meta name="twitter:image:alt" content="{!! $meta_data['twitter_image_alt'] !!}">
    <link rel="icon" type="image/png" sizes="32x32" href="https://thejobz.pk/resources/assets/images/resource/favicon.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@endsection
@section('JSON_D_Schema')
@if (!empty($faqData))
<script type="application/ld+json">
{!! json_encode([
    "@context" => "https://schema.org",
    "@type" => "FAQPage",
    "mainEntity" => $faqData
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endif
@endsection
@section('content')
    @php
        $id = Request::segment(1);
    @endphp

       <div class="container my-5">
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
        @if ($web_config['adsterra_adds']->value == 1)
            <div class="col-12 text-center mb-4 Banner_300x250">
                @include('add.Banner_300x250')
            </div>
        @endif
        <!-- ✅ Heading -->
        {{-- <h2 class="job-detail-page section-title">{{ ucfirst($id) }} Jobs</h2> --}}
            @if (isset($data['h1']))
                <h1 class="section-title">{{ $data['h1'] }}</h1>
                <p class="dec_citys">{{ $data['h1Paragraph'] }}</p>
            @else
                <h2 class="job-detail-page section-title">{{ ucfirst($id) }} Jobs</h2>
            @endif
        <!-- ✅ Top Banner -->
        @if ($web_config['adsterra_adds']->value == 1)
            <div class="Banner_728x90 mb-4 text-center">
                @include('add.Banner_728x90')
            </div>
        @endif
        <table id="data-table" class="display w-100">
            <thead>
            </thead>
        </table>
        @if (!empty($faqData))
            <div class="container my-5">
                <h2 class="section-title text-center mb-4 animate__animated animate__fadeInDown">
                    FAQs – Jobs in {{ ucfirst($endpoint) }}
                </h2>
                <div class="faq-container mx-auto" style="max-width: 800px;">
                    @foreach ($faqData as $index => $faq)
                        <div class="faq-card mb-3 border rounded shadow-sm overflow-hidden">
                            <button
                                class="faq-toggle d-flex justify-content-between align-items-center w-100 p-3 bg-light border-0"
                                data-bs-toggle="collapse" data-bs-target="#faq-{{ $index }}" aria-expanded="false"
                                aria-controls="faq-{{ $index }}" style="font-size: 1.05rem;">
                                <span class="fw-semibold text-start">{{ $faq['name'] }}</span>
                                <span class="faq-icon fs-4">+</span>
                            </button>
                            <div id="faq-{{ $index }}" class="collapse">
                                <div class="faq-answer p-3 bg-white animate__animated animate__fadeInUp">
                                     {!! $faq['acceptedAnswer']['text'] !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($web_config['adsterra_adds']->value == 1)
            <div class="Banner_728x90  text-center" style="margin-top:30px; margin-bottom:20px;">
                @include('add.Banner_728x90')
            </div>
            <div class="col-12 text-center mb-4 Banner_300x250">
                @include('add.Banner_300x250')
            </div>
            <div class="col-12 text-center mb-4 Native">
                @include('add.Native')
            </div>
        @endif

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script type="text/javascript">
        $(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ordering: false,
                bLengthChange: false,

                ajax: "{{ route('ajx_featch_categorys', $id) }}",

                columns: [
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });


        $(document).ready(function() {

        });
    </script>
@endsection
