@extends('layouts.app1')
@php
    $fullUrl = url()->full();
    $path = parse_url($fullUrl, PHP_URL_PATH);
    $segments = explode('/', $path);
    $department = end($segments);
    $endpoint = ucfirst(preg_replace('/[^a-zA-Z ]/', ' ', $department));
    $endpoint_capital = trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $endpoint)));

    if ($department == 'management') {
        $title = 'Management Jobs in Pakistan | Latest Vacancies 2025';
        $description =
            'Find top management jobs in Pakistan. Explore HR, operations, and admin roles for freshers & professionals. Apply online today!';
        $keywords =
            'management jobs Pakistan, management jobs 2025, manager jobs Lahore, HR manager jobs Karachi, project manager vacancies Pakistan, admin manager careers, apply online management jobs';
        $H1title = 'Management Jobs in Pakistan – Latest Career Opportunities 2025';
        $H1Paragraph =
            'Looking for management jobs in Pakistan? You’re in the right place! <br> At TheJobz.pk, we help professionals and fresh graduates find the latest management roles in industries like banking, corporate, education, IT, logistics, and construction. Whether you’re a project manager, HR officer, or business analyst, our verified listings connect you directly with top employers across Pakistan. <br> From entry-level trainee jobs to executive management positions, discover opportunities that fit your experience, skills, and goals.';
    } elseif ($department == 'private-company') {
        $title = 'Private Company Jobs in Pakistan 2025 | New Vacancies Apply Online';
        $description =
            'Find the latest private company jobs in Pakistan 2025. Daily updates for IT, accounts, HR, sales, and marketing roles. Apply online now!';
        $keywords =
            'private company jobs Pakistan, private jobs 2025, IT jobs private sector, accounts jobs Pakistan, HR jobs private company, marketing vacancies private jobs, online apply private careers';
        $H1title = 'Private Company Jobs in Pakistan 2025 – Latest Career Openings';
        $H1Paragraph =
            'Searching for private company jobs in Pakistan? You’re in the right place. <br>At TheJobz.pk, we bring you daily job updates from top private firms across Pakistan — covering industries like IT, marketing, HR, sales, administration, and finance. <br>Whether you’re a fresh graduate looking to start your career or an experienced professional seeking better growth, our verified job listings connect you with trusted private employers offering competitive salaries and flexible work environments.';
    } elseif ($department == 'private-school') {
        $title = 'Private Company Jobs in Pakistan 2025 | New Vacancies Apply Online';
        $description =   'Private school jobs in Pakistan 2025. Teacher, lecturer, principal, Montessori, and staff vacancies in Lahore, Karachi & Islamabad. Apply online for school jobs.';
        $keywords = 'private school jobs Pakistan, teaching jobs private schools, Montessori jobs Pakistan, lecturer jobs schools 2025, school principal vacancies, admin jobs private schools, online apply private school jobs';
        $H1title = 'Private School Jobs in Pakistan 2025 – Teaching & Admin Openings';
        $H1Paragraph =  'Find the latest private school jobs in Pakistan 2025 for teachers, administrators, and support staff. Browse daily job updates from top private schools across major cities and apply online easily through TheJobz.pk.';
    } elseif ($department == 'house') {
        $title = 'Household Jobs in Pakistan 2025 | Maid, Cook & Driver Roles';
        $description = 'Find latest house jobs in Pakistan 2025. Apply online for maid, cook, driver, nanny & helper vacancies in top cities. Free home staff hiring portal!';
        $keywords = 'house jobs Pakistan, maid jobs 2025, driver jobs Lahore, nanny jobs Pakistan, cook jobs Karachi, home staff vacancies, household helper jobs Pakistan, apply online house jobs';
        $H1title = 'House Jobs in Pakistan 2025 – Maid, Cook & Driver Vacancies';
        $H1Paragraph = 'Looking for reliable house jobs in Pakistan 2025? Explore verified listings for maids, cooks, drivers, nannies, and helpers from trusted employers nationwide. Apply online today for free at TheJobz.pk.';
    } elseif ($department == 'education') {
        $title = 'Education Jobs in Pakistan 2025 | Teaching & Lecturer Roles';
        $description = 'Explore the latest education jobs in Pakistan 2025. Apply online for school, college, and university teaching, lecturer & academic staff vacancies today.';
        $keywords = 'education jobs Pakistan, teaching jobs 2025, lecturer jobs Pakistan, professor jobs Pakistan, school jobs Lahore, college jobs Karachi, university vacancies Pakistan, apply online education careers';
        $H1title = 'Education Jobs in Pakistan 2025 – Teaching, Lecturer & Academic Careers';
        $H1Paragraph = 'Are you looking for the latest education jobs in Pakistan 2025? Whether you’re a passionate school teacher, an experienced college lecturer, or an aspiring university professor, TheJobz.pk makes your job search simple, fast, and reliable.';
        $H2title = '🎓 Why Choose Education as a Career in Pakistan?';
        $H2Paragraph = 'Education is one of the most respected and stable career paths in Pakistan. Teachers play a vital role in shaping the next generation, and with the rise of digital learning and modern institutions, teaching jobs in Pakistan are growing rapidly.<br>From classroom teaching and academic counseling to online tutoring and school administration, the education sector offers endless growth opportunities. Qualified educators are in high demand, especially in subjects like English, Mathematics, Computer Science, and Early Childhood Education.';
        $H2title_2nd = '🏫 Popular Education Job Roles in Pakistan';
        $H2Paragraph_2nd = 'At TheJobz.pk, you can find thousands of verified listings from both private and government education sectors. Popular positions include:<br>School Teachers (Primary & Secondary), College & University Lecturers, Professors and Academic Researchers, School Principals & Vice Principals, Subject Specialists, Online Tutors & E-Learning Trainers, Education Coordinators & Academic Managers, Each role comes with unique responsibilities — from classroom instruction and syllabus design to student mentoring and progress evaluation.';

        $H3title = '🌍 Education Jobs by Location';
        $H3Paragraph = 'TheJobz.pk helps you apply for education jobs across Pakistan, including major cities like:<br>Lahore: Leading schools and colleges such as LGS, Beaconhouse, and UMT hire regularly.<br>Karachi: Great demand for private school teachers, Montessori instructors, and English lecturers.<br>Islamabad & Rawalpindi: Growing opportunities in universities and online academies.<br>Faisalabad, Multan, and Peshawar: Emerging educational hubs with private and public sector openings.<br>You can easily filter your search by city, experience level, and institution type, making your job search faster and more focused.<br>';
        $H4title = '💼 Top Institutions Hiring Teachers in 2025';
        $H4Paragraph = 'Many reputable schools and universities post jobs on TheJobz.pk, including:<br>Beaconhouse School System, The City School, Lahore Grammar School, Roots International, COMSATS University, Punjab Group of Colleges, Allied Schools & Superior Group, Whether you want to teach at a primary school, college, or university, you’ll find multiple verified openings updated daily.';
        $H5title = '🖥️ Online Teaching & Remote Education Jobs';
        $H5Paragraph =  'In 2025, online education continues to grow across Pakistan. Many private institutions and startups now offer remote teaching opportunities, especially for English language instructors, Quran tutors, and subject experts.';
        $H5title_2nd = '📋 How to Apply for Education Jobs Online';
        $H5Paragraph_2nd = 'Applying for education jobs through TheJobz.pk is quick and simple:<br> Visit <a href="https://thejobz.pk/" >TheJobz.pk</a> Go to the Education Jobs category Browse verified listings by city or subject Click Apply Online and submit your details Get contacted directly by employers or institutions Our platform ensures all job listings are verified and updated daily, keeping your job search safe and transparent.';
        $H5title_3nd = '💡 Why TheJobz.pk is the Best Platform for Teachers';
        $H5Paragraph_3nd = '✅ 100% Verified Job Listings <br>✅ Daily Updates for Schools & Universities <br>✅ Free Access for Job Seekers <br>✅ Easy Online Application <br>✅ Safe & Secure Hiring Process<br>Whether you’re a fresh graduate or an experienced educator, TheJobz.pk helps you find your ideal teaching job faster and smarter.';
        $H5title_4nd = '🧾 Conclusion';
        $H5Paragraph_4nd = 'The education sector in Pakistan is evolving — and now is the perfect time to find your next teaching opportunity. Start your journey today with TheJobz.pk, Pakistan’s most trusted platform for education, teaching, and academic jobs.👉 Apply online today for free and make a difference in the classroom tomorrow!';
    } elseif ($department == 'medical') {
        $title = 'Medical Jobs in Pakistan 2025 | Doctors, Nurses & Healthcare Staff';
        $description = 'Explore verified medical jobs in Pakistan 2025. Vacancies for doctors, nurses, lab technicians & healthcare staff in top hospitals. Apply online now.';
        $keywords = 'medical jobs Pakistan, doctor jobs 2025, nurse jobs Lahore, healthcare jobs Karachi, hospital jobs Pakistan, medical technician vacancies, paramedic jobs Pakistan, apply online medical careers';
        $H1title = 'Medical Jobs in Pakistan 2025 – Doctors, Nurses & Healthcare Roles';
        $H1Paragraph =  'Explore the latest medical jobs in Pakistan 2025 including positions for doctors, nurses, and healthcare staff. Apply online for verified openings across major cities through TheJobz.pk.';
    } elseif ($department == 'hospital-clinic') {
        $title = 'Healthcare, Hospital & Clinic Jobs Pakistan 2025 – Hiring Now';
        $description = 'Find verified hospital and clinic job openings in Pakistan 2025. Doctors, nurses, technicians & admin staff needed in major cities. Apply free at TheJobz.pk.';
        $keywords = 'hospital jobs Pakistan, clinic jobs 2025, nurse jobs Pakistan, doctor jobs Karachi, dispenser jobs Lahore, hospital staff vacancies, clinic receptionist jobs, apply online healthcare careers';
        $H1title = 'Hospital & Clinic Jobs in Pakistan 2025 – Doctors, Nurses & Healthcare Staff';
        $H1Paragraph = 'Ready for your next healthcare role? Explore verified hospital and clinic jobs in Pakistan for 2025. From doctors to nurses, technicians to admin staff—apply online today at TheJobz.pk and secure your career in healthcare.';

        $H2title= 'Why Hospital & Clinic Jobs Are Hot Right Now';
        $H2Paragraph= 'Pakistan’s healthcare sector is growing fast. Hospitals and clinics in major cities like Karachi, Lahore, Islamabad & Rawalpindi are hiring at scale for doctors, nurses, lab technicians, admin staff, and support teams. With increased patient demand and expanded facilities, now is the time to apply.';

        $H2title_2nd = 'Key Roles You Can Apply For';
        $H2Paragraph_2nd = 'Doctors & Medical Officers: MBBS, FCPS, MD qualified professionals wanted for OPD, wards, and specialist departments.Nurses & Midwives: Qualified female and male nursing staff in high demand for both public and private hospitals.Lab Technicians & Radiographers: Clinics and diagnostic centres need skilled staff for sample collection, imaging & analysis.Hospital Admin & Support Staff: Opportunities in coordination, admissions, reception, billing and patient services.Clinic Assistants & Front Desk: Entry to mid-level roles for those with relevant experience in a clinic or outpatient setting.';

        $H2title_3nd = 'Location Focus – Jobs by City';
        $H2Paragraph_3nd = 'You can filter jobs by city and find roles near you or relocate for better opportunities:<br>Karachi – Largest number of openings across private chains & large hospitals.<br>Lahore – Strong demand for nurses, technicians and admin in multi-specialty hospitals.<br>Islamabad & Rawalpindi – Government and private hospital jobs with better benefits and work environments.<br>Peshawar, Multan, Quetta – Emerging healthcare hubs offering growing job volume.';

        $H2title_3nd = 'How to Apply & Increase Your Chance of Success';
        $H2Paragraph_3nd = 'Create your free profile at TheJobz.pk – upload resume with recent photo.Use filters for “Hospital & Clinic” department, select city and job type.Click “Apply Online” — prefer listings with direct employer link to avoid middlemen.Prepare for interview: ensure you have up-to-date licenses (for doctors/nurses), certifications, and highlight your hospital or clinic experience.Set job alerts — be among the first to apply when new vacancies hit. Early applications get higher visibility.';

    $H2title_4nd = 'Why Choose TheJobz.pk for Your Healthcare Job Search';
    $H2Paragraph_4nd = '✅ 100% verified listings – no outdated adverts.<br>✅ Free to apply – no hidden fees or subscriptions.<br>✅ Daily updates – new roles added every day.<br>✅ Trusted by thousands of hospitals and clinics across Pakistan.<br>✅ Make your next career move simple, safe and fast.';
    } elseif ($department == 'security-company') {
        $title = 'Security Company Jobs in Pakistan 2025 | Apply Online Today';
        $description = 'Explore latest security company jobs in Pakistan 2025. Vacancies for guards, supervisors, managers & admin staff in top cities. Apply online now.';
        $keywords = 'security jobs Pakistan, security guard jobs 2025, supervisor jobs security, private security vacancies, guard jobs Lahore, security officer jobs Karachi, apply online security company jobs';
        $H1title = 'Security Company Jobs in Pakistan 2025 – Guards, Supervisors & Managers';
        $H1Paragraph = 'Looking for a secure career in security services? Browse verified security company jobs in Pakistan for 2025 including guards, supervisors and managers. Apply online now at TheJobz.pk and join Pakistan’s leading teams in safety and protection.';

        $H2title= 'Why Security Company Jobs Are in High Demand';
        $H2Paragraph= 'With rising commercial centres, industrial zones and corporate campuses in Pakistan, the demand for trained security staff from professional companies has soared. Listings show hundreds of roles for guards, supervisors and management-level security personnel across cities like Karachi, Lahore and Islamabad. (pk.indeed.com)';

        $H2title_2nd= 'Key Roles You Can Explore';
        $H2Paragraph_2nd= 'Security Guards & Officers: On-site at factories, malls, offices and residential compounds.<br>Supervisors & Team Leads: Oversee guard teams, coordinate shifts, maintain reports and ensure compliance.<br>Managers & Heads of Security: Leadership roles managing contracts, risk assessments, and entire security operations. (pk.indeed.com)<br>Admin & Support Staff: Roles such as control room operator, equipment coordinator, security administration.';

        $H2title_3nd= 'Top Hiring Locations';
        $H2Paragraph_3nd= 'Major job volumes are in metropolitan and industrial cities:<br>Karachi – highest openings for all levels.Lahore – strong demand for supervisors & export-zone security jobs.Islamabad/Rawalpindi – government facilities, embassies and large campuses.Faisalabad & Multan – growing manufacturing security needs.';

        $H2title_4nd= 'How to Apply & Succeed';
        $H2Paragraph_4nd= 'Create or update your profile on TheJobz.pk and upload an updated resume.Search “Security Company” department, select city and job level.Choose roles that match your experience: guards (entry), supervisors (2-5 years), managers (senior).Highlight any prior security training (armed/unarmed), shift experience, and certifications if available.Apply early: roles get filled quickly due to high demand.';

        $H2title_5nd='Why Choose TheJobz.pk for Security Jobs';
        $H2Paragraph_5nd='Daily updated and verified listings – no outdated ads.Free to apply – no hidden fees for job seekers.Direct link to employers – faster responses and interviews.Wide range of roles – from entry guard posts to senior managers.';

    } elseif ($department == 'marketing-company') {
        $title = 'Marketing Jobs in Pakistan 2025 | Sales & Digital Vacancies';
        $description = 'Find marketing jobs in Pakistan 2025. Digital marketing, sales executive, SEO, advertising & brand roles updated daily. Apply online for fresh vacancies.';
        $keywords = 'marketing jobs Pakistan, digital marketing jobs 2025, sales jobs Karachi, advertising jobs Lahore, SEO jobs Pakistan, brand manager vacancies, online apply marketing company jobs';
        $H1title = 'Marketing Jobs in Pakistan 2025 – Digital, Sales & Brand Roles';
        $H1Paragraph = 'Discover fresh marketing jobs in Pakistan for 2025 — from digital marketing and SEO to sales executives and brand managers. Browse verified vacancies from agencies, startups and corporates, and apply online instantly at TheJobz.pk.';
    } elseif ($department == 'manufacturing') {
        $title = 'Manufacturing Jobs Pakistan 2025 | Factory & Labor Hiring';
        $description = 'Discover fresh manufacturing jobs in Pakistan 2025 — factory, production, engineering & labor roles updated daily. Apply online for trusted vacancies!';
        $keywords = 'manufacturing jobs Pakistan, factory jobs 2025, labor jobs Lahore, production jobs Karachi, engineer jobs manufacturing, skilled worker vacancies Pakistan, apply online manufacturing jobs';
        $H1title ='Manufacturing Jobs in Pakistan 2025 – Factory & Production Careers';
        $H1Paragraph ='Searching for factory or production jobs in Pakistan? Browse updated hiring for engineers, skilled labor, machine operators, and plant staff across top industries. Apply online instantly with verified employers at TheJobz.pk.';
    } elseif ($department == 'pakistan-army') {
        $title = 'Pakistan Army Jobs 2025 | Soldier & Officer Vacancies';
        $description = 'Join Pakistan Army jobs 2025. Soldier, captain, major & civilian vacancies updated daily. Apply online for latest Pak Army jobs & career opportunities today.';
        $keywords = 'Pakistan Army jobs 2025, Pak Army soldier jobs, army officer jobs Pakistan, captain jobs Pak Army, major jobs Pakistan Army, army civilian vacancies, apply online army jobs Pakistan';
    } elseif ($department == 'army-public-school-college-apsc') {
        $title = 'APSC Jobs 2025 | Army Public School & College Vacancies';
        $description = 'APSC jobs in Pakistan 2025. Teacher, lecturer, admin & staff vacancies updated daily in Army Public Schools & Colleges. Apply online for APSC jobs now.';
        $keywords = 'APSC jobs Pakistan, Army Public School College jobs 2025, teaching jobs APSC, lecturer jobs Army Colleges, APS admin vacancies, school jobs army Pakistan, apply online APSC jobs';
    } elseif ($department == 'army-public-school') {
        $title = 'Army Public School Jobs 2025 | Teaching & Admin Vacancies';
        $description = 'Army Public School jobs in Pakistan 2025. Teacher, staff & admin vacancies updated daily. Apply online for APS jobs & careers in Pakistan today.';
        $keywords = 'Army Public School jobs, APS jobs 2025, teaching jobs APS Pakistan, APS teacher jobs, Army school admin jobs, latest APS vacancies Pakistan, apply online Army Public School jobs';
    } elseif ($department == 'army-public-school-aps') {
        $title = 'APS Jobs 2025 | Army Public School Careers Apply Online';
        $description = 'APS jobs in Pakistan 2025. Teacher, admin & lecturer vacancies in Army Public Schools. Updated daily with new APS careers. Apply online today.';
        $keywords = 'APS jobs Pakistan, APS jobs 2025, Army Public School vacancies, teaching jobs APS, lecturer jobs APS Pakistan, admin jobs APS, online apply APS jobs';
    } elseif ($department == 'army-burn-hall-college-for-boys') {
        $title = 'Army Burn Hall College Jobs 2025 | Teaching & Staff Vacancies';
        $description = 'Army Burn Hall College jobs 2025. Lecturer, teacher & staff vacancies updated for boys campus. Apply online now for Burn Hall College jobs.';
        $keywords = 'Army Burn Hall College jobs, Burn Hall jobs 2025, lecturer jobs Burn Hall, teaching jobs Burn Hall College, staff jobs Army Burn Hall, apply online Army Burn Hall College careers';
    } elseif ($department == 'army-welfare-trust') {
        $title = 'Army Welfare Trust Jobs 2025 | AWT Latest Vacancies';
        $description = 'Army Welfare Trust jobs in Pakistan 2025. Careers in finance, HR, management & administration updated daily. Apply online for AWT jobs today.';
        $keywords = 'Army Welfare Trust jobs, AWT jobs 2025, AWT vacancies Pakistan, management jobs AWT, HR jobs Army Welfare Trust, admin jobs AWT Pakistan, apply online AWT careers';
    } elseif ($department == 'army-model-school-college') {
        $title = 'Army Model School & College Jobs 2025 | Teaching Vacancies';
        $description = 'Army Model School & College jobs 2025. Teacher, lecturer & admin vacancies updated daily. Apply online for Army Model School careers in Pakistan.';
        $keywords = 'Army Model School jobs, Army College jobs 2025, teaching jobs Army Model School, lecturer jobs Pakistan Army Colleges, admin jobs Army Schools, apply online Army Model School jobs';
    } else {
        $title = "Jobs in {$endpoint_capital} Pakistan 2025 | Latest {$endpoint_capital} Vacancies";
        $description = "Find the latest {$endpoint_capital} jobs in Pakistan 2025. Fresh govt & private sector vacancies updated daily. Apply online now at TheJobz.pk.";
        $keywords = "{$endpoint_capital} jobs Pakistan, {$endpoint_capital} jobs 2025, latest {$endpoint_capital} vacancies, {$endpoint_capital} careers Pakistan, apply online {$endpoint_capital} jobs";
    }
@endphp
@section('title'){!! $title !!}@endsection
@section('meta')
    {{-- <meta name="keywords" content="{{ $keywords }}"> --}}
    <meta name="description" content="{!! $description !!}">
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
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{!! $description !!}">
    <meta name="twitter:image" content="https://thejobz.pk/resources/assets/images/resource/logo9.png" />
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
        @if (isset($H1title))
            <h1 class="section-title">{{ $H1title }}</h1>
            <p class="dec_citys">{!! $H1Paragraph !!}</p>
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
        @if (isset($H2title))
            <h2 class="section-title"> {!! $H2title !!}</h2>
            <p class="dec_citys"> {!! $H2Paragraph !!}</p>
        @endif

        @if (isset($H2title_2nd))
            <h3 class="section-title"> {!! $H2title_2nd !!}</h3>
            <p class="dec_citys"> {!! $H2Paragraph_2nd !!}</p>
        @endif

        @if (isset($H2title_3nd))
            <h3 class="section-title"> {!! $H2title_3nd !!}</h3>
            <p class="dec_citys"> {!! $H2Paragraph_3nd !!}</p>
        @endif

        @if (isset($H2title_4nd))
            <h3 class="section-title"> {!! $H2title_4nd !!}</h3>
            <p class="dec_citys"> {!! $H2Paragraph_4nd !!}</p>
        @endif

        @if (isset($H2title_5nd))
            <h4 class="section-title"> {!! $H2title_5nd !!}</h4>
            <p class="dec_citys"> {!! $H2Paragraph_5nd !!}</p>
        @endif



        @if (!empty($faqData))
            <div class="container my-5">
                <h3 class="section-title text-center mb-4 animate__animated animate__fadeInDown">
                    FAQs – Jobs in {{ ucfirst($endpoint) }}
                </h3>
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
        @if (isset($H3title))
            <h3 class="section-title"> {!! $H3title !!}</h3>
            <p class="dec_citys"> {!! $H3Paragraph !!}</p>
        @endif


        @if (isset($H5title))
            <h5 class="section-title"> {!! $H5title !!}</h51>
            <p class="dec_citys"> {!! $H5Paragraph !!}</p>
        @endif
        @if (isset($H4title))
            <h4 class="section-title"> {!! $H4title !!}</h4>
            <p class="dec_citys"> {!! $H4Paragraph !!}</p>
        @endif

        @if (isset($H5title_2nd))
            <h4 class="section-title"> {!! $H5title_2nd !!}</h4>
            <p class="dec_citys"> {!! $H5Paragraph_2nd !!}</p>
        @endif

        @if (isset($H5title_3nd))
            <h4 class="section-title"> {!! $H5title_3nd !!}</h4>
            <p class="dec_h4_p"> {!! $H5Paragraph_3nd !!}</p>
        @endif

        @if (isset($H5title_4nd))
            <h4 class="section-title"> {!! $H5title_4nd !!}</h4>
            <p class="dec_citys"> {!! $H5Paragraph_4nd !!}</p>
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
                ajax: "{{ route('ajx_featch', "$id") }}",
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
