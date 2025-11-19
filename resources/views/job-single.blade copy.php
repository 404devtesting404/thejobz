@extends('layouts.app1')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

@section('title')
    {{ $job_single->title }} | Jobs in Pakistan 2025 - TheJobz.pk
@endsection

@section('meta')
    <meta name="description" content="{{ Str::limit(strip_tags($job_single->meta_description), 160) }}">
    <meta name="keywords" content="{{ $job_single->title }}, jobs in Pakistan, latest jobs 2025, TheJobz.pk">
@endsection

@section('content')
    <style>
        #job-title {
            color: #ffffff !important;
            font-weight: bold !important;
        }



        .hero h1.job-title-text {
            color: #ffffff !important;
            font-weight: bold !important;
        }

        .job-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        .hero2 {
            background-color: #504d4d;
            padding: 20px 20px;
            color: #fff;
        }

        .job-img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .job-summary p {
            font-size: 15px;
            margin-bottom: 8px;
        }

        .job-summary strong {
            color: #28a745;
        }

        .contact-box {
            background: #f0fdf4;
            border: 1px solid #d1fae5;
            padding: 20px;
            border-radius: 10px;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 15px;
            text-align: center;
        }

        .section-title {
            border-left: 5px solid #28a745;
            padding-left: 10px;
            margin-bottom: 20px;
        }

        .related-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .related-card:hover {
            background: #f9f9f9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 767.98px) {
            .hero h1 {
                font-size: 22px;
            }

            .job-summary {
                padding: 15px;
            }
        }
    </style>

    <!-- ✅ Hero Section -->
    <section class="hero2 d-flex align-items-center justify-content-center text-center">
        <div class="container">
            <h1 id="job-title">
                {{ $job_single->title }}
            </h1>



        </div>
    </section>

    @if ($job_single->img)
        <div class="container my-5">
            <!-- ✅ Full Width Image -->
            <div class="text-center">
                <img src="{{ asset('storage/app/public/jobs/' . $job_single->img) }}"
                    alt="{{ $job_single->title }} - {{ $job_single->department }}"
                    class="img-fluid job-img rounded shadow-sm">
            </div>
        </div>
    @endif

    <!-- ✅ Job Summary -->
    <div class="container my-5">
        <h2 class="section-title">Job Summary</h2>
        <div class="job-summary shadow-sm">
            <p><strong>Department:</strong> {{ $job_single->department ?? 'N/A' }}</p>
            <p><strong>Location:</strong> {{ $job_single->city ?? 'Multiple Cities' }}</p>
            <p><strong>Source:</strong> {{ $job_single->paper_name ?? 'TheJobz.pk' }}</p>
            <p><strong>Posted on:</strong> {{ $job_single->posted }}</p>
            <p><strong>Views:</strong> {{ $job_single->views ?? 0 }}</p>
        </div>
    </div>

    <!-- ✅ Job Description -->
    <div class="container my-5">
        <h2 class="section-title">Job Description</h2>
        <div class="card card-body shadow-sm">
            {!! $job_single->meta_description !!}
        </div>
    </div>

    <!-- ✅ Full Width Contact Us -->
<div class="container-fluid py-5" style="background:#f9f9f9;">
    <div class="container">
        <h2 class="section-title">Contact Us</h2>
        <div class="card shadow-sm p-4" style="border-radius: 12px;">
            <form method="post" action="{{ route('contactus_submit') }}">
                @csrf
                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-md-6">
                        <input type="text" name="name" maxlength="20" placeholder="Full Name *"
                            value="{{ old('name') }}" class="form-control form-control-lg" required />
                        @error('name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <input type="email" name="email" maxlength="30" placeholder="Email *"
                            value="{{ old('email') }}" class="form-control form-control-lg" required />
                        @error('email')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <input type="text" name="mobile_number" maxlength="11" placeholder="Phone *"
                            value="{{ old('mobile_number') }}"
                            onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                            class="form-control form-control-lg" required />
                        @error('mobile_number')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="col-md-12">
                        <textarea name="message" minlength="20" maxlength="300" placeholder="Your Message *"
                            class="form-control form-control-lg" rows="5" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="col-md-12 d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- ✅ Related Jobs -->
    <div class="container my-5">
        <h2 class="section-title">Related Jobs</h2>
        <table id="related-jobs" class="display" style="width:100%">
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
    <script>
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
    </script>
@endsection
