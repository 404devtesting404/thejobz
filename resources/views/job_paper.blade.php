@extends('layouts.app1')

@php
    $fullUrl = url()->full();
    $path = parse_url($fullUrl, PHP_URL_PATH);
    $segments = explode('/', $path);
    $department = end($segments);
    $endpoint = ucfirst(preg_replace('/[^a-zA-Z ]/', ' ', $department));
    $endpoint_capital =  trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $endpoint)));


    if($department == 'jang') {
        $title = 'Jang Jobs 2025 | Latest Newspaper Jobs in Pakistan – TheJobz.pk';
        $description = 'Explore the latest Jang Jobs 2025 in Pakistan. Find updated government, private, and newspaper job ads from Jang. Apply now & start your career with TheJobz.pk.';
        $keywords = 'Jang jobs, Jang newspaper jobs, latest Jang jobs 2025, today Jang jobs, jobs in Jang Pakistan, Jang paper jobs, government jobs Jang, private jobs Jang, daily Jang jobs';
        $H1title = 'Latest Jang Newspaper Jobs in Pakistan 2025';
        $H1Paragraph = 'Find the latest Jang newspaper jobs in Pakistan updated daily. Browse government, private, and classified ads from Daily Jang and apply online instantly at TheJobz.pk.';
    }elseif ($department == 'thenews') {
        $title = 'The News Jobs 2025 | Latest Newspaper Vacancies';
        $description = 'Find updated The News Jobs 2025 in Pakistan. Browse govt & private newspaper ads with daily listings. Apply online now at TheJobz.pk.';
        $keywords = 'The News jobs, The News newspaper jobs, latest The News jobs 2025, today The News jobs, jobs in The News Pakistan, The News paper jobs, government jobs The News, private jobs The News, daily The News jobs';
        $H1title = 'Latest The News Newspaper Jobs in Pakistan 2025';
        $H1Paragraph = 'Explore fresh job ads from The News newspaper updated daily. Discover government and private career opportunities across Pakistan and apply instantly at TheJobz.pk.';
    }elseif ($department == 'dawn') {
        $title = 'Dawn Jobs 2025 | Latest Newspaper Jobs Pakistan';
        $description = 'Find the latest Dawn Jobs 2025 in Pakistan. Get daily updates for government & private newspaper job ads. Apply online now via TheJobz.pk.';
        $keywords = 'Dawn jobs, Dawn newspaper jobs, latest Dawn jobs 2025, today Dawn jobs, jobs in Dawn Pakistan, Dawn paper jobs, government jobs Dawn, private jobs Dawn, daily Dawn jobs';
        $H1title = 'Dawn Jobs 2025 – Latest Daily Newspaper Vacancies';
        $H1Paragraph = 'Explore the latest Dawn Jobs 2025 in Pakistan. Updated daily with new government, private, teaching, healthcare, banking, and technical vacancies. Apply online now on TheJobz.pk.';
    }elseif ($department == 'nawaiwaqt') {
        $title = 'Nawaiwaqt Jobs 2025 | Latest Jobs in Pakistan';
        $description = 'Find Nawaiwaqt Jobs 2025 in Pakistan. Daily updated government & private sector job ads from Nawaiwaqt newspaper. Apply online now on TheJobz.pk.';
        $keywords = 'Nawaiwaqt jobs, Nawaiwaqt newspaper jobs, latest Nawaiwaqt jobs 2025, today Nawaiwaqt jobs, jobs in Nawaiwaqt Pakistan, Nawaiwaqt paper jobs, government jobs Nawaiwaqt, private jobs Nawaiwaqt, daily Nawaiwaqt jobs';
        $H1title = 'Nawaiwaqt Jobs 2025 – Latest Daily Vacancies';
        $H1Paragraph = 'Explore the latest Nawaiwaqt Jobs 2025 in Pakistan. Find updated daily vacancies from government and private sectors, including teaching, engineering, medical, banking, and more. Apply online on TheJobz.pk.';
    }elseif ($department == 'aaj') {
        $title = 'Aaj Jobs 2025 | Latest Newspaper Jobs in Pakistan';
        $description = 'Explore the latest Aaj Jobs 2025 in Pakistan. Find daily updated government & private vacancies from Aaj newspaper. Apply online via TheJobz.pk.';
        $keywords = 'Aaj jobs, Aaj newspaper jobs, latest Aaj jobs 2025, today Aaj jobs, jobs in Aaj Pakistan, Aaj paper jobs, government jobs Aaj, private jobs Aaj, daily Aaj jobs';
        $H1title = 'Aaj Jobs 2025 – Latest Newspaper Vacancies in Pakistan';
        $H1Paragraph = 'Looking for fresh career opportunities from the Aaj newspaper? Explore verified job ads updated daily, including government, private, banking, teaching, and technical roles. Apply online today at TheJobz.pk and stay ahead in your job hunt.';
    }elseif ($department == 'dunya') {
        $title = 'Dunya Jobs 2025 | Latest Newspaper Jobs in Pakistan';
        $description = 'Find the latest Dunya Jobs 2025 in Pakistan. Explore daily updated government & private vacancies from Dunya newspaper. Apply now via TheJobz.pk.';
        $keywords = 'Dunya jobs, Dunya newspaper jobs, latest Dunya jobs 2025, today Dunya jobs, jobs in Dunya Pakistan, Dunya paper jobs, government jobs Dunya, private jobs Dunya, daily Dunya jobs';
        $H1title = 'Dunya Jobs 2025 – Latest Newspaper Vacancies in Pakistan';
        $H1Paragraph = 'Searching for new career opportunities in Pakistan? Discover verified job ads from Dunya newspaper updated daily, including government, private, banking, teaching, and technical roles. Apply instantly through TheJobz.pk and secure your next opportunity.';
    }elseif ($department == 'express') {
        $title = 'Express Jobs 2025. Latest Express Newspaper Jobs';
        $description = 'Find the latest Express Jobs 2025 in Pakistan. Daily updates from Express newspaper including government and private vacancies at TheJobz.pk.';
        $keywords = 'Express jobs, Express newspaper jobs, latest Express jobs 2025, today Express jobs, jobs in Express Pakistan, Express paper jobs, government jobs Express, private jobs Express, daily Express jobs';
        $H1title = 'Express Jobs 2025 in Pakistan';
        $H1Paragraph = 'Here you can find fresh job ads from the Express newspaper updated every day. Government and private openings are listed in one place for quick and easy browsing.';
    }elseif ($department == 'kawish') {
        $title = 'Kawish Newspaper Jobs 2025. Latest Jobs in Pakistan';
        $description = 'Find the latest Kawish Newspaper Jobs 2025 in Pakistan. Daily job ads from Kawish including government and private vacancies updated on TheJobz.pk.';
        $keywords = 'Kawish jobs, Kawish newspaper jobs, latest Kawish jobs 2025, today Kawish jobs, jobs in Kawish Pakistan, Kawish paper jobs, government jobs Kawish, private jobs Kawish, daily Kawish jobs';
        $H1title = 'Kawish Newspaper Jobs 2025 in Pakistan';
        $H1Paragraph = 'Here you can check fresh job ads published in the Kawish Newspaper. Updated daily with government and private openings so you can apply without wasting time.';
    }elseif ($department == 'nation') {
        $title = 'Nation Newspaper Jobs 2025. Latest Jobs in Pakistan';
        $description = 'Find the latest Nation Newspaper Jobs 2025 in Pakistan. Daily government and private job ads from The Nation updated regularly on TheJobz.pk.';
        $keywords = 'The Nation jobs, The Nation newspaper jobs, latest The Nation jobs 2025, today The Nation jobs, jobs in The Nation Pakistan, The Nation paper jobs, government jobs The Nation, private jobs The Nation, daily The Nation jobs';
        $H1title = 'Nation Newspaper Jobs 2025 in Pakistan';
        $H1Paragraph = 'Check fresh job ads from the Nation Newspaper. Updated daily with government and private openings so you can apply on time without missing any opportunity.';
    }elseif ($department == 'mashriq') {
        $title = 'Mashriq Newspaper Jobs 2025 | Latest Jobs in Pakistan';
        $description = 'Find the latest Mashriq Newspaper Jobs 2025 in Pakistan. Daily government and private job ads updated on TheJobz.pk. Apply online today!';
        $keywords = 'Mashriq jobs, Mashriq newspaper jobs, latest Mashriq jobs 2025, today Mashriq jobs, jobs in Mashriq Pakistan, Mashriq paper jobs, government jobs Mashriq, private jobs Mashriq, daily Mashriq jobs';
        $H1title = 'Mashriq Newspaper Jobs 2025 in Pakistan';
        $H1Paragraph = 'Explore fresh Mashriq Newspaper job ads. Get daily updates for government and private sector vacancies so you never miss a chance to apply.';
    }elseif ($department == 'khabrain') {
        $title = 'Khabrain Newspaper Jobs 2025 | Latest Jobs in Pakistan';
        $description = 'Find the latest Khabrain Newspaper Jobs 2025 in Pakistan. Daily government and private job ads updated on TheJobz.pk. Apply online today!';
        $keywords = 'Khabrain jobs, Khabrain newspaper jobs, latest Khabrain jobs 2025, today Khabrain jobs, jobs in Khabrain Pakistan, Khabrain paper jobs, government jobs Khabrain, private jobs Khabrain, daily Khabrain jobs';
        $H1title = 'Khabrain Newspaper Jobs 2025 in Pakistan';
        $H1Paragraph = 'Explore fresh Khabrain Newspaper job ads. Get daily updates for government and private sector vacancies so you never miss a chance to apply.';
    }else {
         $title = "Jobs in {$endpoint}} | Latest {$endpoint} Jobs 2025 Thejobz.pk";
         $description = "Find the latest {$endpoint_capital} jobs in Pakistan for 2025. Explore job opportunities in various sectors, including government and public services, at TheJobz.pk.";
         $keywords = "{$endpoint} jobs, latest {$endpoint} jobs 2025, today {$endpoint} jobs, jobs in {$endpoint} Pakistan, {$endpoint} paper jobs, government jobs {$endpoint}, private jobs {$endpoint}, daily {$endpoint} jobs";
   }
@endphp
@section('title') {{$title}} @endsection

@section('meta')
{{-- <meta name="keywords" content="{{$keywords}}"> --}}
<meta name="description" content="{{$description}}">
<link rel="canonical" href="{{$fullUrl}}" />
<meta name="robots" content="max-image-preview:large, index, follow">
<meta name="author" content="TheJobz">
<meta name="publisher" content="TheJobz.pk">
<meta property="og:locale" content="en-PK" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="Thejobz.pk" />
<meta property="og:title" content="{{$title}}" />
<meta property="og:url" content="{{ $fullUrl }}" />
<meta property="og:description" content="{{$description}}">
<meta property="og:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png" />
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@thejobzdotpk"/>
<meta name="twitter:title" content="{{$title}}" />
<meta name="twitter:description" content="{{$description}}">
<meta name="twitter:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png"/>
<meta property="og:image:width" content="1280">
<meta property="og:image:height" content="720">
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
@php
    $id = Request::segment(2);
@endphp
@section('content')
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
        @if (isset($H1title))
            <h1 class="section-title">{{ $H1title }}</h1>
            <p class="dec_citys">{{ $H1Paragraph }}</p>
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
                                    {{ $faq['acceptedAnswer']['text'] }}
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
        // $('#whatsappJoinModal').modal('show');
        $(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajx_featch_paper_jobs', "$id") }}",
                pageLength: 5,
                searching: false,
                ordering: false,
                columns: [{
                    data: 'action',
                    name: 'data',
                    orderable: false,
                    searchable: false
                }, ]
            });

        });

        $(document).ready(function() {

        });
    </script>
@endsection
