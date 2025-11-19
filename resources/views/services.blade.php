@extends('layouts.app')
@section('content')
    <section id="hero" class="d-flex align-items-center cus-about-us">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <h1 class="text-left">Services</h1>

            <!-- <div class="d-flex">
                            <a href="#about" class="btn-get-started scrollto">Get Started</a>
                            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                          </div> -->
        </div>
    </section><!-- End Hero -->


    <!-- ======= services start ======= -->
    <section class="services_custom">
        <div class="container">
            <div class="row service-frow">
                <div class="col-lg-12">
                    <div class="ser-intero">
                        <div>
                            <h2>Entities We Offer EIN Filing Services</h2>
                            <p>We’re all about easing out your process of filing EINs. Following are the entities we offer
                                services in. </p>
                        </div>
                        <a href="{{ url('contact_us') }}">Contact Us</a>
                    </div>
                </div>
            </div>

            <div class="row ser-row">
                <!-- 1st -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img class="img-height-changes"
                                src="{{ asset('resources/assets/img/site_images/service-1.png') }}" alt="">
                            <h5>01</h5>
                        </div>
                        <h3>Personal Services Corporation</h3>
                        <p>If the firm owner himself offers services then it needs its own EIN for tax purposes. </p>
                        <a href="{{ url('personal_service_corporation') }}">
                            <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt="">
                        </a>


                    </div>
                </div>
                <!-- 2nd -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-2.png') }}" alt="">
                            <h5>02</h5>
                        </div>
                        <h3>Limited Liability Company (LLC)</h3>
                        <p>If your LLC has more than one member, it needs an EIN in order to file excise forms.</p>
                        <a href="{{ url('limited_liability_company') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
                <!-- 3rd -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-3.png') }}" alt="">
                            <h5>03</h5>
                        </div>
                        <h3>Property of Deceased Person</h3>
                        <p>Estate owned by a deceased person needs an EIN to carry out the distribution process. </p>
                        <a href="{{ url('property_of_deceased_person') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
            </div>


            <div class="row ser-row">
                <!-- 4th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-4.png') }}" alt="">
                            <h5>04</h5>
                        </div>
                        <h3>Sole Proprietorship </h3>
                        <p>As a sole proprietor, you don’t need EIN in certain cases but getting it can benefit you.</p>
                        <a href="{{ url('sole_proprietorship') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
                <!-- 5th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-5.png') }}" alt="">
                            <h5>05</h5>
                        </div>
                        <h3>Non-Profit Organization</h3>
                        <p>Despite being non-profit, these firms need EIN to carry out routine business proceedings.</p>
                        <a href="{{ url('non_profit_organization') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
                <!-- 6th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-6.png') }}" alt="">
                            <h5>06</h5>
                        </div>
                        <h3>Trust</h3>
                        <p>Apart from revocable trusts, all other types of trusts need an EIN to file for taxes. </p>
                        <a href="{{ url('trust') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="row ser-row">
                <!-- 7th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-7.png') }}" alt="">
                            <h5>07</h5>
                        </div>
                        <h3>C-Corporation </h3>
                        <p>A C-Corporation should have an EIN unique to its business to pay taxes, debts, etc.</p>
                        <a href="{{ url('c_corporation') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
                <!-- 8th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-8.png') }}" alt="">
                            <h5>08</h5>
                        </div>
                        <h3>S-Corporation</h3>
                        <p>S-Corps don’t need an EIN legally, but getting one can help you achieve business goals.</p>
                        <a href="{{ url('s_corporation') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
                <!-- 9th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-9.png') }}" alt="">
                            <h5>09</h5>
                        </div>
                        <h3>Partnership</h3>
                        <p>Partnership firms need EIN to file taxes and a new EIN upon changes in the partnership. </p>
                        <a href="{{ url('partnership') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="row ser-row">
                <!-- 10th -->
                <div class="col-md-4">
                    <div class="service-container">
                        <div class="icon-row-serinner">
                            <img src="{{ asset('resources/assets/img/site_images/service-10.png') }}" alt="">
                            <h5>10</h5>
                        </div>
                        <h3>Church </h3>
                        <p>Even though they are tax-exempted firms, church organizations still need an EIN.</p>
                        <a href="{{ url('church') }}"> <img class="normal-arow"
                                src="{{ asset('resources/assets/img/site_images/solid-arrow.png') }}" alt="">
                            <img class="hover-arow"
                                src="{{ asset('resources/assets/img/site_images/hover-right-arrow.png') }}" alt=""></a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ======= services end ======= -->
@endsection
