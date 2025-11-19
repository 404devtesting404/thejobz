@extends('layouts.app1')

@section('title')
    About Us | TheJobz.pk
@endsection

@section('meta')
    <meta name="description" content="Learn more about TheJobz.pk – Pakistan’s ultimate platform for the latest government and private job opportunities. Discover our mission, values, and what we offer.">
    <link rel="canonical" href="https://thejobz.pk/about" />
    <meta name="keywords" content="About TheJobz.pk, Jobs in Pakistan, Government Jobs, Private Jobs, Online Job Portal">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="About Us | TheJobz.pk">
    <meta property="og:description" content="Discover who we are and what we do at TheJobz.pk – your trusted source for the latest jobs in Pakistan.">
    <meta property="og:image" content="{{ asset('assets/images/default-about.webp') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="About Us | TheJobz.pk">
    <meta name="twitter:description" content="Learn more about TheJobz.pk and our mission to connect job seekers with career opportunities.">
    <meta name="twitter:image" content="{{ asset('assets/images/default-about.webp') }}">
@endsection

@section('content')
<br>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-pattern"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in">About Us</h1>
            <p class="text-lg md:text-xl font-light animate-fade-in-up">
                Learn more about who we are and what we do
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 animate-slide-up">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome to TheJobz.pk</h2>
                <p class="text-gray-600 leading-relaxed mb-10">
                    Welcome to <span class="font-semibold text-gray-900">TheJobz.pk</span>, your ultimate destination for
                    finding the latest job opportunities in Pakistan. We aim to connect job seekers with their dream jobs,
                    whether in the government or private sector, by providing a comprehensive platform for online job
                    applications.
                </p>

                <!-- Info Grid -->
                <div class="grid md:grid-cols-2 gap-10">
                    <!-- Mission -->
                    <div
                        class="p-6 bg-gradient-to-br from-indigo-50 to-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-zoom-in">
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3">🎯 Our Mission</h3>
                        <p class="text-gray-600">
                            To empower job seekers with a wide range of job listings sourced from trusted newspapers and
                            official sources, while ensuring a smooth and user-friendly experience.
                        </p>
                    </div>

                    <!-- What We Offer -->
                    <div
                        class="p-6 bg-gradient-to-br from-indigo-50 to-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-zoom-in">
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3">💡 What We Offer</h3>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li><strong>Latest Job Listings:</strong> Daily updates from government & private sectors.</li>
                            <li><strong>Easy Online Application:</strong> Apply securely through our platform.</li>
                            <li><strong>Job Alerts:</strong> Get notified about jobs matching your profile.</li>
                            <li><strong>Free Classified Ads:</strong> Post & find jobs without any cost.</li>
                        </ul>
                    </div>

                    <!-- Values -->
                    <div
                        class="p-6 bg-gradient-to-br from-indigo-50 to-white rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-zoom-in md:col-span-2">
                        <h3 class="text-xl font-semibold text-indigo-700 mb-3">🌟 Our Values</h3>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li><strong>Integrity:</strong> Transparency and honesty in all operations.</li>
                            <li><strong>Customer-Centric:</strong> Keeping users at the heart of everything.</li>
                            <li><strong>Innovation:</strong> Continuously enhancing the platform for better results.</li>
                        </ul>
                    </div>
                </div>

                <!-- Closing -->
                <div class="mt-12 text-center">
                    <p class="text-gray-600">
                        Explore opportunities at <span class="font-semibold">TheJobz.pk</span> and take a step closer to
                        your dream career.
                        Whether you are a job seeker or employer, we are here to help you connect, grow, and succeed.
                    </p>

                    <!-- Contact -->
                    <p class="mt-6 text-lg font-semibold text-indigo-700">
                        <a href="mailto:support@thejobz.pk" class="underline hover:text-indigo-900">
                            📧 support@thejobz.pk
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
