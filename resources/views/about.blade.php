@extends('layouts.app')

@section('content')


    <!-- Start Slider Area  -->
    <div class="slider-area bg_image bg_image--12 slider-style-1 height-100vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        {{-- <span class="subtitle">Certified Public Accountants</span> --}}
                        <h4 class="subtitle d-inline p-2" style="background-color: #fff; border-radius:5px"
                        data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back"><span class="theme-gradient"> Certified Public Accountants </span></h4>
                        <h1 class="title display-two"><span class="theme-gradient">We can help you with</span> <br>
                            <span class="header-caption">
                                <span class="cd-headline clip is-full-width">
                                    <span class="cd-words-wrapper">
                                        <b class="is-visible theme-gradient">Bookkeeping</b>
                                        <b class="is-hidden theme-gradient">Payroll</b>
                                        <b class="is-hidden theme-gradient">Individual Tax</b>
                                        <b class="is-hidden theme-gradient">Payroll</b>
                                        <b class="is-hidden theme-gradient">Non-profit Organization</b>
                                        <b class="is-hidden theme-gradient">Part-Time CFO</b>
                                        <b class="is-hidden theme-gradient">Consulting</b>
                                    </span>
                                </span>
                            </span>
                        </h1>
                        <p class="description">
                            Set a vision, take a decision, and do both with <strong>Precision</strong>.
                            {{-- We help your business improve its financial recordkeeping,
                            payroll and tax preparation, so you can plan your budget and your financial expenses. --}}
                        </p>
                        <div class="button-group">
                            <a class="btn-default btn-medium round btn-icon" target="_blank"  href="{{ route("consulting") }}"  data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                Consulting
                                <i class="icon feather-arrow-right"></i>
                            </a>
                            <a class="btn-default btn-medium btn-border btn-in-transparent round btn-icon" href="{{ route("contact") }}"  data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                Contact Us
                                <i class="icon feather-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Area  -->



    <!-- Start advance-tab Area  -->
    <div class="rwt-advance-tab-area rn-section-gap">
        <div class="container">
            <div class="row mb--40">
                <div class="col-lg-8 offset-lg-2"  data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                    <div class="section-title text-center">
                        <h4 class="subtitle "><span class="theme-gradient">WHAT WE DO</span></h4>
                        <h2 class="title w-600 mb--20">Most trustworthy consulting with the best CPAs</h2>
                    </div>
                </div>
            </div>

            <div class="html-tabs" data-tabs="true">
                <div class="row row--30">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 mt_md--30 mt_sm--30"  data-sal="slide-down" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <div class="advance-tab-button advance-tab-button-1">
                            <ul class="nav nav-tabs tab-button-list mb-4" id="myTab" role="tablist">
                                <li class="nav-item w-100" role="presentation">
                                    <a href="#" class="nav-link tab-button active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" role="tab" aria-controls="home" aria-selected="false">
                                        <div class="tab">
                                            <h4 class="title">Payroll management</h4>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item w-100" role="presentation">
                                    <a href="#" class="nav-link tab-button" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" role="tab" aria-controls="profile"
                                        aria-selected="false">
                                        <div class="tab">
                                            <h4 class="title">IRS problem resolution</h4>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item w-100" role="presentation">
                                    <a href="#" class="nav-link tab-button" id="contact-tab"
                                        data-bs-toggle="tab" data-bs-target="#contact" role="tab"
                                        aria-controls="contact" aria-selected="true">
                                        <div class="tab">
                                            <h4 class="title">Smart QuickBooks services</h4>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12 col-12" data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <div class="tab-content">
                            <div class="tab-pane fade advance-tab-content-1 active show" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset('doob_template_assets/images/advance-tab/payroll.jpg') }}"
                                        alt="advance-tab-image">
                                </div>

                            </div>
                            <div class="tab-pane fade advance-tab-content-1" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset('doob_template_assets/images/advance-tab/irs.jpg') }}"
                                        alt="advance-tab-image">
                                </div>
                            </div>
                            <div class="tab-pane fade advance-tab-content-1" id="contact" role="tabpanel"
                                aria-labelledby="contact-tab">
                                <div class="thumbnail">
                                    <img src="{{ asset('doob_template_assets/images/advance-tab/quick.jpg') }}"
                                        alt="advance-tab-image">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- End advance-tab Area  -->





    <!-- Start Split Style-3 Area  -->
    <div class="rwt-split-area rn-section-gap">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 mb--40">
                    <div class="section-title text-center"  data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <h4 class="subtitle "><span class="theme-gradient"> More About Us </span></h4>
                        <h2 class="title w-600 mb--20">  CPAs experts </h2>
                        <p class="description b1">
                            Need expert CPAs to run and grow your business so talk to us.
                        </p>
                    </div>
                </div>
            </div>
            <div class="rn-splite-style bg-color-blackest">
                <div class="split-wrapper">
                    <div class="row g-0 radius-10 align-items-center">
                        <div class="col-lg-12 col-xl-6 col-12"  data-sal="slide-down" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                            <div class="thumbnail">
                                <img src="{{ asset('doob_template_assets/images/split/about.jpg') }}"  alt="split Images">
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-6 col-12"  data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                            <div class="split-inner">
                                <h5 class="title sal-animate" data-sal="slide-up" data-sal-duration="400"
                                    data-sal-delay="200">PRECISION ACCOUNTING INTL LLC.</h5>
                                <p class="description sal-animate" data-sal="slide-up" data-sal-duration="400"
                                    data-sal-delay="300">
                                    For many years PRECISION ACCOUNTING INTL LLC has been helping individuals, families and
                                    small businesses in the community prepare their taxes. Our friendly service makes the
                                    process less stressful and more efficient and our experience and knowledge ensure that
                                    we're always up to date on the latest changes to Federal and state tax codes. We'll make
                                    sure your return gets filed accurately and on time, with all the deductions you're
                                    entitled to. .
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Split Style-3 Area  -->
@endsection
