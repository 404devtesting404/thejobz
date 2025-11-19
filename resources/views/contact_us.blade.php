@extends('layouts.app1')

@section('title')
    Contact Us | TheJobz.pk
@endsection

@section('meta')
    <meta name="description"  content="Contact TheJobz.pk for support, inquiries, or feedback. Our team is here to help you with your job search and recruitment needs.">
    {{-- <meta name="keywords" content="Contact TheJobz.pk, Jobz.pk contact, support, recruitment help, job inquiries, Pakistan jobs"> --}}
    <link rel="canonical" href="https://thejobz.pk/contact" />
    <meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="Contact Us | TheJobz.pk">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:description" content="Get in touch with TheJobz.pk. We’d love to hear from you!">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('images/contact-banner.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@thejobzdotpk" />
    <meta name="twitter:title" content="Contact Us | TheJobz.pk">
    <meta name="twitter:description" content="Learn more about TheJobz.pk and our mission to connect job seekers with career opportunities.">
    <meta name="twitter:image" content="{{ asset('assets/images/default-about.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')
<style>
    @media (max-width: 740px) {
        .display-4.font-weight-bold.mb-2 {
            font-size: 2.5rem !important; /* 24px */
            white-space: nowrap; /* ek line me force */
        }
    }
</style>

    <!-- ✅ Hero Section -->
    <section class="py-5 bg-light border-bottom">
        <div class="container text-center">
            <h1 class="display-4 font-weight-bold mb-2">📞 Contact Us</h1>
            <p class="lead text-muted">We’d love to hear from you. Let’s get in touch!</p>
        </div>
    </section>

    <!-- ✅ Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">

                <!-- Left Column - Contact Info -->
                <div class="col-lg-5 col-md-6 col-12 mb-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon text-primary mr-3">
                                <i class="fa fa-map-marker fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold">Our Office</h5>
                                <p class="text-muted mb-0">Karachi, Pakistan</p>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon text-success mr-3">
                                <i class="fa fa-phone fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold">Phone</h5>
                                <p class="text-muted mb-0">+92 300 1234567</p>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon text-danger mr-3">
                                <i class="fa fa-envelope fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="font-weight-bold">Email</h5>
                                <p class="text-muted mb-0">support@thejobz.pk</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Contact Form -->
                <div class="col-lg-7 col-md-6 col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="mb-4">Send us a Message</h3>

                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            @endif

                            <form method="post" action="{{ route('contactus_submit') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control rounded-pill" id="name" name="name"
                                        maxlength="20" placeholder="Enter your name *" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control rounded-pill" id="gender" name="gender" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control rounded-pill" id="email" name="email"
                                        maxlength="30" placeholder="Enter your email *" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="mobile_number">Phone Number</label>
                                    <input type="text" class="form-control rounded-pill" id="mobile_number"
                                        name="mobile_number" placeholder="Phone Number *" maxlength="11"
                                        onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                        required>
                                    @error('mobile_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control rounded-lg" id="message" name="message" rows="4"
                                        placeholder="Write your message here..."></textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="btn btn-success btn-block rounded-pill py-2 font-weight-bold">
                                    <i class="fa fa-paper-plane mr-1"></i> Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
