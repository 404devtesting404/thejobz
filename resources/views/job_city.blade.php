@extends('layouts.app1')
@php
    $fullUrl = url()->full();

    $path = parse_url($fullUrl, PHP_URL_PATH);
    $segments = explode('/', $path);
    $city_Name = end($segments);
    $cityName = strtoupper(trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $city_Name))));

    if ($city_Name == 'lahore') {
        $title = 'Find Latest Jobs in Lahore | Apply for Govt, Private & Online Roles';
        $description = 'Search and apply for the best jobs in Lahore 2025. From private companies to government sectors — find verified openings and apply instantly on TheJobz.pk.';
        $keywords = 'Jobs in Lahore, Lahore jobs today, latest jobs Lahore 2025, government jobs Lahore, private jobs Lahore, IT jobs Lahore, bank jobs Lahore, teaching jobs Lahore';
        $H1title = 'Latest Jobs in Lahore 2025 – Government, Private & Online Openings';
        $H1Paragraph =  'Find the latest jobs in Lahore from top private companies and government sectors. Browse verified openings in IT, teaching, marketing, and online work. Apply instantly on TheJobz.pk and start your career in Lahore today!';
    } elseif ($city_Name == 'karachi') {
        $title = 'Karachi Jobs 2025 | Private, Govt & Online Openings Near You';
        $description = 'Explore fresh Karachi job openings near your area. Discover opportunities in marketing, teaching, IT & more. Apply online today with TheJobz.pk!';
        $keywords =  'Jobs in Karachi, Karachi jobs today, latest jobs Karachi 2025, government jobs Karachi, bank jobs Karachi, private jobs Karachi, IT jobs Karachi, teaching jobs Karachi';
        $H1title = 'Latest Jobs in Karachi 2025 – Private, Government & Online Vacancies';
        $H1Paragraph = 'Find the latest jobs in Karachi from top private companies and government sectors. Explore daily updated openings in IT, teaching, marketing, and online work. Apply now on TheJobz.pk to start your career in Karachi!';
    } elseif ($city_Name == 'islamabad') {
        $title = 'Jobs in Islamabad 2025 – Govt, Private & Online Openings';
        $description =  'Explore the latest job openings in Islamabad across government, private, and online sectors. Apply instantly for verified positions in IT, education, healthcare, and more on TheJobz.pk.';
        $keywords =  'Jobs in Islamabad, Islamabad jobs today, latest jobs Islamabad 2025, government jobs Islamabad, private jobs Islamabad, teaching jobs Islamabad, IT jobs Islamabad, bank jobs Islamabad';
        $H1title = 'Find Latest Jobs in Islamabad – Start Your Career Today';
        $H1Paragraph = 'Find the latest jobs in Islamabad across government, private, and online sectors. Explore openings in IT, education, healthcare, and more, filter by type or location, and apply instantly on TheJobz.pk to start your career today.';
    } elseif ($city_Name == 'peshawar') {
        $title = 'Explore Jobs in Peshawar 2025 – Government, Private & Online Roles';
        $description = 'Browse Peshawar jobs 2025 today. Updated with government vacancies, NGO careers, teaching, IT, and private sector jobs. Apply online for fresh opportunities in Peshawar.';
        $keywords = 'Jobs in Peshawar, Peshawar jobs today, latest jobs Peshawar 2025, government jobs Peshawar, NGO jobs Peshawar, teaching jobs Peshawar, private jobs Peshawar, IT jobs Peshawar';
        $H1title = 'Find the Latest Jobs in Peshawar – Start Your Career Today';
        $H1Paragraph = 'Looking for a job in Peshawar? Discover fresh openings in government, private, and online sectors across IT, education, healthcare, and marketing. Use TheJobz.pk to filter jobs by type, experience, or location and apply instantly to start your career with trusted employers.';
    } elseif ($city_Name == 'rawalpindi') {
        $title = 'Jobs in Rawalpindi 2025 – Government, Private & Remote Opportunities | TheJobz.pk';
        $description = 'Discover Rawalpindi jobs 2025 today. Daily updates on army, government, and private sector jobs. Apply online for teaching, IT, and bank job opportunities in Rawalpindi.';
        $keywords = 'Jobs in Rawalpindi, Rawalpindi jobs today, latest jobs Rawalpindi 2025, army jobs Rawalpindi, government jobs Rawalpindi, private jobs Rawalpindi, IT jobs Rawalpindi, teaching jobs Rawalpindi';
        $H1title = 'Find the Latest Jobs in Rawalpindi – Start Your Career Today';
        $H1Paragraph = 'Discover verified job openings in Rawalpindi across government, private, IT, education, healthcare, and remote sectors. Use TheJobz.pk’s smart filters to search by job title, skill, experience, or area, and apply instantly to trusted employers hiring in Rawalpindi for 2025.';
    } elseif ($city_Name == 'quetta') {
        $title = 'Explore Jobs in Quetta 2025 – Government, Private & Online Roles';
        $description =  'Find jobs in Quetta 2025 today. Updated listings for teaching jobs, private companies, IT careers, and government vacancies. Apply online for new Quetta opportunities.';
        $keywords = 'Jobs in Quetta, Quetta jobs today, latest jobs Quetta 2025, government jobs Quetta, teaching jobs Quetta, private jobs Quetta, IT jobs Quetta, NGO jobs Quetta';
        $H1title = 'Find the Latest Jobs in Quetta – Start Your Career Today';
        $H1Paragraph = 'Looking for the latest jobs in Quetta? Explore verified openings in government, private, and online sectors across IT, healthcare, education, and banking. With TheJobz.pk, you can filter by job type, experience level, or location and apply directly to trusted employers in Quetta.';
    } elseif ($city_Name == 'multan') {
        $title = 'Explore Jobs in Multan 2025 – Government, Private & Online Roles';
        $description = 'Find verified jobs in Multan 2025 across government, private, and online sectors. Apply instantly to trusted employers in IT, teaching, healthcare, banking, and more — only on TheJobz.pk.';
        $keywords = 'Jobs in Multan, Multan jobs today, latest jobs Multan 2025, government jobs Multan, teaching jobs Multan, private jobs Multan, IT jobs Multan, bank jobs Multan';
        $H1title = 'Find the Latest Jobs in Multan – Apply Today';
        $H1Paragraph = 'Searching for a job in Multan? Discover daily-updated opportunities from trusted private companies and government sectors, including roles in education, IT, retail, healthcare, and administration. Filter job listings based on your experience, location, or job type — and apply directly on TheJobz.pk to kickstart your career in Multan.';
    } elseif ($city_Name == 'riyadh') {
        $title = 'Jobs in Riyadh | Latest Riyadh Jobs 2025 | Apply Online Today';
        $description = 'Find latest jobs in Riyadh for Pakistanis & international candidates. Search fresh job openings in construction, driving, IT, labor, security & more. Apply online today on TheJobz.pk!';
        $keywords =  'Jobs in Riyadh, Riyadh jobs today, expat jobs Riyadh 2025, latest jobs Riyadh, private jobs Riyadh, IT jobs Riyadh, engineering jobs Riyadh, oil and gas jobs Riyadh';
        $H1title = 'Jobs in Riyadh – Latest Job Vacancies 2025';
        $H1Paragraph = 'Discover daily updated job opportunities in Riyadh for skilled and unskilled workers, Pakistanis, and international talent. Whether you want labor jobs, driver jobs, IT jobs, security roles, construction work — TheJobz.pk helps you apply fast with trusted listings and verified employer details.';
    } elseif ($city_Name == 'faisalabad') {
        $title = 'Jobs in Faisalabad | Latest Faisalabad Jobs 2025 | Apply Online Today';
        $description = 'Find latest jobs in Faisalabad for freshers and experienced candidates. Search government & private job openings in IT, banking, education, healthcare & more. Apply online on TheJobz.pk!';
        $keywords = 'Jobs in Faisalabad, Faisalabad jobs today, latest jobs Faisalabad 2025, government jobs Faisalabad, private jobs Faisalabad, teaching jobs Faisalabad, IT jobs Faisalabad, bank jobs Faisalabad';
        $H1title = 'Jobs in Faisalabad – Latest Job Vacancies 2025';
        $H1Paragraph = 'Discover fresh and updated job opportunities in Faisalabad across private and government sectors. Whether you want IT jobs, industrial jobs, textile jobs, or online/remote work — TheJobz.pk helps you apply fast with trusted listings and zero hassle.';
    } elseif ($city_Name == 'dammam') {
        $title = 'Jobs in Dammam | Latest Dammam Jobs 2025 | Apply Online Today';
        $description = 'Find latest jobs in Dammam for Pakistanis & international workers. Fresh vacancies in driving, labor, factory, construction, security & more. Apply online now on TheJobz.pk!';
        $keywords = 'Jobs in Dammam, Dammam jobs today, expat jobs Dammam 2025, oil and gas jobs Dammam, IT jobs Dammam, private jobs Dammam, engineering jobs Dammam, latest jobs Dammam';
        $H1title = 'Jobs in Dammam – Latest Job Vacancies 2025';
        $H1Paragraph = 'Explore the latest job opportunities in Dammam for skilled and unskilled workers from Pakistan and other countries. Whether you"re looking for labor, driving, security, or IT jobs — TheJobz.pk makes applying simple with verified listings and trusted employers.';
    } else {
        $title = "Jobs in {$cityName} 2025 Today | Government & Private Vacancies";
        $description = "Find the latest jobs in {$cityName} 2025 today. Updated daily with government jobs, private sector careers, IT, teaching, and bank vacancies. Apply online now.";
        $keywords = "Jobs in {$cityName}, {$cityName} jobs today, latest jobs {$cityName} 2025, government jobs {$cityName}, private jobs {$cityName}, IT jobs {$cityName}, teaching jobs {$cityName}, bank jobs {$cityName}";
    }
@endphp
@section('meta')
@section('title')
    {!! $title !!}
@endsection
<!--<meta name="keywords"  content="{{ $cityName }} jobs, jobs in {{ $cityName }}, jobs {{ $cityName }}, pakistan jobs, paper jobs in {{ $cityName }}, Newspaper Jobs in {{ $cityName }}">-->
<meta name="description" content="{!! $description !!}" />
<link rel="canonical" href="{{ $fullUrl }}" />
<meta name="robots" content="max-image-preview:large, index, follow">
<meta name="author" content="TheJobz">
<meta name="publisher" content="TheJobz.pk">
<meta property="og:locale" content="en-PK" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="Thejobz.pk" />
<meta property="og:title" content="{!! $title !!}" />
<meta property="og:url" content="{{ $fullUrl }}" />
<meta property="og:description" content="{!! $description !!}">
<meta property="og:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@thejobzdotpk" />
<meta name="twitter:title" content="{!! $title !!}" />
<meta name="twitter:description" content="{!! $description !!}">
<meta name="twitter:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<meta property="og:image:width" content="1280">
<meta property="og:image:height" content="720">
@endsection
{{-- city.blade.php --}}

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
    $id = Request::segment(2);
@endphp
<!-- ✅ Related Jobs -->
<div class="container my-5">
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

    @if ($web_config['adsterra_adds']->value == 1)
        <div class="col-12 text-center mb-4 Banner_300x250">
            @include('add.Banner_300x250')
        </div>
    @endif
    <!-- ✅ Heading -->
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
    <table id="related-jobs" class="display w-100">
        <thead>

        </thead>
    </table>

@if (!empty($faqData))
<div class="container my-5">
    <h2 class="section-title text-center mb-4 animate__animated animate__fadeInDown">
        FAQs – Jobs in {{ ucfirst($city_Name) }}
    </h2>
    <div class="faq-container mx-auto" style="max-width: 800px;">
        @foreach ($faqData as $index => $faq)
            <div class="faq-card mb-3 border rounded shadow-sm overflow-hidden">
                <button class="faq-toggle d-flex justify-content-between align-items-center w-100 p-3 bg-light border-0"
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
<script>
    $(function() {
        // $('#whatsappJoinModal').modal('show');
        $('#related-jobs').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ajx_city', "$id") }}",
            pageLength: 5,
            searching: false,
            ordering: false,
            columns: [{
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }]
        });
    });
    // Optional smooth animation control for icons
    document.querySelectorAll('.faq-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const icon = btn.querySelector('.faq-icon');
            setTimeout(() => {
                document.querySelectorAll('.faq-icon').forEach(i => {
                    if (i !== icon) i.textContent = '+';
                });
                icon.textContent = (btn.getAttribute('aria-expanded') === 'true') ? '+' : '−';
            }, 150);
        });
    });
</script>
@endsection
