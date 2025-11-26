@extends('layouts.app1')

@php
    $fullUrl = url()->full();
    $path = parse_url($fullUrl, PHP_URL_PATH);
    $segments = explode('/', $path);
    $endpoint = end($segments);
    // dd($endpoint);

    // $endpoint = ucfirst(preg_replace('/[^a-zA-Z ]/', ' ', $cityName));
    // $endpoint = ucfirst(preg_replace('/[^a-zA-Z ]/', ' ', $cityName));
    // $endpoint_capital = strtoupper(trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $endpoint))));
    $endpoint_capital = strtoupper(trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z0-9 ]/', ' ', $endpoint))));

    // $paper_name = strtoupper(trim(preg_replace('/\s+/', ' ', preg_replace('/[^a-zA-Z ]/', ' ', $job_single->paper_name))));
    $paper_name = strtoupper(
        trim(
            preg_replace(
                '/\s+/',
                ' ',
                preg_replace('/[^a-zA-Z0-9 ]/', ' ', str_ireplace('JOBS', '', $job_single->paper_name)),
            ),
        ),
    );
    $department = strtoupper(
        trim(
            preg_replace(
                '/\s+/',
                ' ',
                preg_replace('/[^a-zA-Z0-9 ]/', ' ', str_ireplace('JOBS', '', $job_single->department)),
            ),
        ),
    );
    $addressCountry = '';
    if ($job_single->city == 'Sharjah') {
        $addressCountry = 'AE';
    } else {
        $addressCountry = 'PK';
    }
    if (!empty($job_single->meta_description)) {
        $meta_description = $job_single->meta_description;
    } else {
        $meta_description = "Latest job $endpoint_capital, Jobs in $department, Jobs in $endpoint_capital, $department jobs, Jobs in Pakistan $endpoint_capital, Jobs, jobs pakistan, pakistan jobs, careers, Recruitment, Employment, Hiring, Banking, CVs, paper jobs, Finance, IT, Marketing, Resume, Work, naukri, Online Jobs, Newspaper Jobs";
    }
@endphp
@section('title') {!! $job_single->title !!}@endsection
@section('meta')
    @if (!empty($job_single->meta_keywords) && !empty($job_single->meta_description) && !empty($job_single->meta_canonical))
        <!--<meta name="keywords" content="{!! $job_single->meta_keywords !!}" />-->
    <meta name="description" content="{!! $job_single->meta_description !!}" />
    <link rel="canonical" href="{{ $job_single->meta_canonical }}" />
    @else
        <!--<meta  name="keywords"content="{{ $endpoint_capital }}, Jobs in {{ $department }}, Jobs in {{ $endpoint_capital }}, {{ $department }} jobs, Jobs in Pakistan {{ $endpoint_capital }}, Jobs, jobs pakistan, pakistan jobs, careers, Recruitment, Employment, Hiring, Banking, CVs, paper jobs, Finance, IT, Marketing, Resume, Work, naukri, Online Jobs, Newspaper Jobs" />-->
    <meta name="description" content="Latest job {{ $endpoint_capital }}, {{ $department }} jobs, Search latest {{ $endpoint_capital }} jobs online. Start new career by applying job advertisement of {{ \Carbon\Carbon::parse($job_single->posted)->format('d F, Y') }} in {{ $paper_name }} paper" />
    <link rel="canonical" href="{{ $fullUrl }}" />
    @endif
<meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="{!! $job_single->title !!}" />
    <meta property="og:url" content="{{ $fullUrl }}" />
    @if (!empty($job_single->meta_keywords) && !empty($job_single->meta_description) && !empty($job_single->meta_canonical))
<meta property="og:description" content="{!! $job_single->meta_description !!}">
    @else
    <meta property="og:description" content="Latest job {{ $endpoint_capital }}, {{ $department }} jobs ,Search latest {{ $endpoint_capital }} jobs online. Start new career by applying job advertisement of {{ \Carbon\Carbon::parse($job_single->posted)->format('d F, Y') }} in {{ $paper_name }} paper">
    @endif
<meta property="og:image" content="{{ asset('storage/app/public/jobs') . '/' . $job_single->img }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@thejobzdotpk" />
    <meta name="twitter:title" content="{!! $job_single->title !!}" />
    @if (!empty($job_single->meta_keywords) && !empty($job_single->meta_description) && !empty($job_single->meta_canonical))
<meta property="twitter:description" content="{!! $job_single->meta_description !!}">
    @else
    <meta name="twitter:description" content="Latest job {{ $endpoint_capital }}, {{ $department }} jobs ,Search latest {{ $endpoint_capital }} jobs online. Start new career by applying job advertisement of {{ \Carbon\Carbon::parse($job_single->posted)->format('d F, Y') }} in {{ $paper_name }} paper">
    @endif
<meta name="twitter:image" content="{{ asset('storage/app/public/jobs') . '/' . $job_single->img }}" />
    <meta name="twitter:image:width" content="1280" />
    <meta name="twitter:image:height" content="720" />
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="720">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
@endsection


@section('JSON_D_Schema')
    <!-- ✅ Structured Data JSON-LD for Google Jobs -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "JobPosting",
  "title": "{{$job_single->title}}",
  "description": "{{$meta_description}}",
  "datePosted": "{{$job_single->posted}}",
  "validThrough": "{{\Carbon\Carbon::parse($job_single->posted)->addWeeks(2)->format('Y-m-d')}}",
  "employmentType": "FULL_TIME",
  "hiringOrganization": {
    "@type": "Organization",
    "name": "Thejobz.pk",
    "sameAs": "{{ route('job-department', ['slug' => $job_single->department_slug]) }}"
  },
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
    <?php
            $addressFields = [];

            if ($job_single->street_address) {
                $addressFields[] = '"streetAddress": "' . $job_single->street_address . '"';
            }
            if ($job_single->address_locality) {
                $addressFields[] = '"addressLocality": "' . $job_single->address_locality . '"';
            }
            if ($job_single->address_region) {
                $addressFields[] = '"addressRegion": "' . $job_single->address_region . '"';
            }
            if ($job_single->postal_code) {
                $addressFields[] = '"postalCode": "' . $job_single->postal_code . '"';
            }
            if ($addressCountry) {
                $addressFields[] = '"addressCountry": "' . $addressCountry . '"';
            }

              echo implode(",", $addressFields);
        ?>

    }
  },
"jobBenefits": "Health Insurance, Annual Bonus, Career Growth Opportunities, Paid Leave, Flexible Hours, Provident Fund",
  @if(!empty($job_single->BaseSalaryValue))
    "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "PKR",
        "value": {
            "@type": "QuantitativeValue",
            "value": {{ $job_single->BaseSalaryValue }},
            "unitText": "Month"
        }
    }
  @endif

}
</script>
@endsection

@section('content')
    <!-- ✅ Hero Section -->
    <section class="job-detail-page hero2 d-flex align-items-center justify-content-center text-center">
        <div class="container job-detail-page">
            <h1 id="job-title">{{ $job_single->title }}</h1>
        </div>
    </section>

    <!-- ✅ Contact Us + Job Image -->
    <div class="container my-5">
        <div class="row g-4 align-items-center">
            <!-- Left Job Image -->
            <!-- Left Job Image -->
            <div class="col-md-6 animate__animated animate__fadeInLeft">
                @if ($job_single->img)
                    <!-- ✅ Image only -->
                    <div class="job-detail-page job-image-wrapper">
                        <img id="jobImage" src="{{ asset('storage/app/public/jobs/' . $job_single->img) }}"
                            alt="{{ $job_single->title }} - {{ $job_single->department }}"
                            class="img-fluid job-img rounded shadow-sm">
                    </div>

                    <!-- ✅ Separate Button Div -->
                    <div class="text-center mt-3">
                        <a href="{{ asset('storage/app/public/jobs/' . $job_single->img) }}"
                            download="{{ $job_single->slug }}.jpg" class="btn btn-success w-100">
                            📥 Download Image
                        </a>
                    </div>
                @else
                    <img id="jobImage" src="https://cdn-icons-png.flaticon.com/512/2950/2950651.png" alt="Job Image"
                        class="img-fluid job-img rounded shadow-sm">
                @endif
            </div>



            <!-- Right Contact Form -->
            <div class="col-md-6 animate__animated animate__fadeInRight">
                <div class="card job-detail-page contact-box shadow-sm p-4">
                    <h2 class="h5 mb-3">Contact Us</h2>
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif
                    <form method="post" action="{{ route('contactus_submit') }}">
                        @csrf
                        <div class="mb-3">
                            <input value="{{ $job_single->id }}" name="job_id" hidden>
                            <input type="text" name="name" maxlength="20" placeholder="Your Name *"
                                value="{{ old('name') }}" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender *</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" maxlength="30" placeholder="Email *"
                                value="{{ old('email') }}" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <input type="text" name="mobile_number" maxlength="11" placeholder="Phone *"
                                value="{{ old('mobile_number') }}"
                                onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <textarea name="message" minlength="20" maxlength="300" placeholder="Message *" class="form-control"
                                rows="4" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Job Summary -->
    <div class="container my-5">
        <h2 class="job-detail-page section-title">Job Summary</h2>
        <div class="row g-4">
            <div class="col-md-4 col-12">
                <div class="card shadow-sm p-3 text-center animate__animated animate__fadeInUp job-detail-page">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="card-icon"
                        alt="Department Icon">
                    <h5 class="fw-bold">Department</h5>
                    <p class="text-muted">{{ $job_single->department ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card shadow-sm p-3 text-center animate__animated animate__fadeInUp job-detail-page"
                    style="animation-delay:0.2s;">
                    <img src="https://cdn-icons-png.flaticon.com/512/854/854894.png" class="card-icon"
                        alt="Location Icon">
                    <h5 class="fw-bold">Location</h5>
                    <p class="text-muted">{{ $job_single->city ?? 'Multiple Cities' }}</p>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card shadow-sm p-3 text-center animate__animated animate__fadeInUp job-detail-page"
                    style="animation-delay:0.4s;">
                    <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" class="card-icon"
                        alt="Calendar Icon">
                    <h5 class="fw-bold">Posted On</h5>
                    <p class="text-muted">{{ $job_single->posted }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ✅ Job Description -->
    <div class="container my-5">
        <h2 class="job-detail-page section-title">Job Description</h2>
        <div class="card card-body shadow-sm">
            @if($job_single->content)
                {!! $job_single->content !!}
            @else
                {!! $job_single->meta_description !!}
            @endif 

        </div>
    </div>

    <!-- ✅ Related Jobs -->
    <div class="container my-5">
        <h2 class="job-detail-page section-title">Related Jobs</h2>
        <table id="related-jobs" class="display w-100">
            <thead>
                <tr>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- ✅ Panzoom for Image Zoom -->
    <script src="https://cdn.jsdelivr.net/npm/@panzoom/panzoom@4.4.3/dist/panzoom.min.js"></script>

    <script>
        // ✅ Related Jobs DataTable
        $(function() {
            $('#related-jobs').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('related.jobs', $job_single->id) }}",
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

        // ✅ Panzoom (Double Click Zoom + Drag)
        const elem = document.getElementById('jobImage');
        const panzoom = Panzoom(elem, {
            maxScale: 4,
            minScale: 1,
            contain: 'outside'
        });

        // Double click zoom in/out
        elem.addEventListener('dblclick', function(e) {
            e.preventDefault();
            if (panzoom.getScale() > 1) {
                panzoom.reset();
            } else {
                panzoom.zoomIn({
                    animate: true
                });
            }
        });

        // Mouse wheel zoom
        elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel);
    </script>
@endsection
