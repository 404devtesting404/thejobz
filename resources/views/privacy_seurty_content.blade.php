@extends('layouts.app1')

@section('title')
    Privacy & Security Policy | TheJobz.pk
@endsection

@section('meta')
    <meta name="description" content="Read TheJobz.pk Privacy & Security Policy. Learn how we protect your personal data, ensure safe online applications, and maintain transparency.">
    {{-- <meta name="keywords"  content="Privacy Policy, Security Policy, Data Protection, TheJobz.pk, Safe Job Applications, Secure Job Search, User Privacy"> --}}
    <link rel="canonical" href="https://thejobz.pk/privacy_policy" />
    <meta name="robots" content="max-image-preview:large, index, follow">
    <meta name="author" content="TheJobz">
    <meta name="publisher" content="TheJobz.pk">
    <meta property="og:locale" content="en-PK" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Thejobz.pk" />
    <meta property="og:title" content="Privacy & Security Policy | TheJobz.pk">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:description"  content="Your privacy and security are our top priorities. Learn how TheJobz.pk protects your data and ensures a safe job search experience.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('assets/images/default-privacy.webp') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@thejobzdotpk" />
    <meta name="twitter:title" content="Privacy & Security Policy | TheJobz.pk">
    <meta name="twitter:description"  content="Discover TheJobz.pk's commitment to privacy and security. We keep your personal data safe and applications secure.">
    <meta name="twitter:image" content="{{ asset('assets/images/default-privacy.webp') }}">
@endsection

@section('content')
    <!-- Hero Section -->
    <br>
    <section
        class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white pt-32 md:pt-48 pb-12 md:pb-20 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-pattern"></div>
        <div class="container mx-auto px-4 sm:px-6 text-center relative z-10">
            {{-- <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 md:mb-6 animate-fade-in"> --}}
            <h1 class="text-4xl md:text-5xl mobile-heading font-extrabold mb-4 animate-fade-in">
                Privacy &amp; Security
            </h1>


            <p class="text-base sm:text-lg md:text-xl font-light animate-fade-in-up">
                Your Privacy is Our Priority – Safe, Secure &amp; Transparent
            </p>
        </div>
    </section>

    <!-- Privacy Content -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="bg-white rounded-2xl md:rounded-3xl shadow-xl p-6 sm:p-8 md:p-12 animate-slide-up">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 md:mb-6">
                    Our Commitment to Privacy & Security
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8 md:mb-10 text-sm sm:text-base">
                    At <span class="font-semibold text-gray-900">TheJobz.pk</span>, we prioritize your privacy and data
                    security. We are dedicated to protecting the personal information you share with us while using our
                    platform to explore job opportunities. This page outlines our privacy and security policies to help you
                    understand how we handle your data.
                </p>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
                    <!-- Card -->
                    <div
                        class="p-5 sm:p-6 bg-gradient-to-br from-indigo-50 to-white rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 animate-zoom-in">
                        <h3 class="text-lg md:text-xl font-semibold text-indigo-700 mb-2 md:mb-3">🔐 Data Protection</h3>
                        <p class="text-gray-600 text-sm md:text-base">
                            We collect only the necessary information needed to provide you with a seamless job search
                            experience. All personal data is securely stored and processed using advanced security measures.
                        </p>
                    </div>

                    <!-- Card -->
                    <div
                        class="p-5 sm:p-6 bg-gradient-to-br from-indigo-50 to-white rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 animate-zoom-in">
                        <h3 class="text-lg md:text-xl font-semibold text-indigo-700 mb-2 md:mb-3">✅ User Consent</h3>
                        <p class="text-gray-600 text-sm md:text-base">
                            By accessing and using TheJobz.pk, you consent to the collection and use of your information as
                            outlined in this policy. Rest assured, we do not share your personal data with third parties
                            without your explicit consent.
                        </p>
                    </div>

                    <!-- Card -->
                    <div
                        class="p-5 sm:p-6 bg-gradient-to-br from-indigo-50 to-white rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 animate-zoom-in">
                        <h3 class="text-lg md:text-xl font-semibold text-indigo-700 mb-2 md:mb-3">💼 Secure Online
                            Application</h3>
                        <p class="text-gray-600 text-sm md:text-base">
                            Our platform allows you to apply for jobs in a secure and user-friendly manner. We utilize
                            encryption and other security protocols to protect your online applications.
                        </p>
                    </div>

                    <!-- Card -->
                    <div
                        class="p-5 sm:p-6 bg-gradient-to-br from-indigo-50 to-white rounded-xl md:rounded-2xl shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 animate-zoom-in">
                        <h3 class="text-lg md:text-xl font-semibold text-indigo-700 mb-2 md:mb-3">📢 Updates to Policy</h3>
                        <p class="text-gray-600 text-sm md:text-base">
                            We may occasionally update this Privacy & Security page to reflect changes in our practices. We
                            encourage users to periodically review this page to stay informed.
                        </p>
                    </div>
                </div>

                <!-- Contact -->
                <div class="mt-10 md:mt-12 text-center">
                    <p class="text-gray-600 text-sm md:text-base">Have questions or concerns? Contact us at:</p>
                    <p class="mt-2 md:mt-3 text-base md:text-lg font-semibold text-indigo-700">
                        <a href="mailto:support@thejobz.pk" class="underline hover:text-indigo-900">
                            📧 support@thejobz.pk
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
