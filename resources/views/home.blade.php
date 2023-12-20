@extends('layouts.app')

@section('content')



    <!-- Start Slider Area  -->
    <div class="rwt-testimonial-area home-slider slider-style-4  slider-activation slider-dot rn-slick-dot rn-slick-arrow">


        <div class="single-rn-slider height-100vh slider-bg-image bg-overlay bg_image bg_image--6  d-flex align-items-center">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="order-2 order-lg-1 col-lg-7">
                        <div class="inner text-left">
                            <p class="title h2"> Certifying Acceptance <br> Agents </p>
                            <p class="fs-3">
                                Applying for an ITIN? We will help you obtain your ITIN if you are not qualified for an SSN. We simplify the application process by reviewing the essential documents and redirecting completed Forms to IRS.
                            </p>
                            <div class="button-group mt--30">
                                <a class="btn-default" target="_blank" href="https://www.irs.gov/individuals/international-taxpayers/acceptance-agents-new-jersey">
                                    IRS Acceptance in US
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </a>
                                <a class="btn-default" target="_blank" href="https://www.irs.gov/individuals/international-taxpayers/acceptance-agents-egypt">
                                    IRS Acceptance in EG
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-rn-slider slider-bg-image bg-overlay bg_image bg_image--7 height-100vh d-flex align-items-center">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="order-2 order-lg-1 col-lg-7">
                        <div class="inner text-left">
                            <p class="title h2">Making <br> Accounting Marvels</p>
                            <p class="fs-3">We aim to establish a long-lasting partnership with you from the beginning to the end.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-rn-slider height-100vh slider-bg-image bg-overlay bg_image bg_image--8  d-flex align-items-center">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="order-2 order-lg-1 col-lg-7">
                        <div class="inner text-left">
                            <p class="title h2">Helping  <br> Your Business Grow</p>
                            <p class="fs-3">Our main goal is to optimize your business processes, and minimize your taxes payable and liabilities. Your books and payroll processes are taken good care of.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-rn-slider height-100vh slider-bg-image bg-overlay bg_image bg_image--9  d-flex align-items-center">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="order-2 order-lg-1 col-lg-7">
                        <div class="inner text-left">
                            <p class="title h2">Free <br> Consulting</p>
                            <p class="fs-3">
                            You’ll find us providing you with reasonable advice to meet your best interests and supporting you with all your concerns.</p>
                            <div class="button-group mt--30"><a class="btn-default" target="_blank" href="{{ route("consulting") }}">
                                Consulting Now
                                    <i class="fa-solid fa-handshake-angle"></i>
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Slider Area  -->










    <!-- Start Service Area  -->
    <div class="rn-service-area rn-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                        <h1 class="subtitle ">
                            <span class="theme-gradient">{{ $page->heading }}</span>
                        </h1>
                        <h2 class="title w-600 mb--20">Services provided for you</h2>
                    </div>
                </div>
            </div>

            <div class="row row--15 service-wrapper">

                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <div class="service service__style--1 icon-circle-style text-center">
                            <div class="service-icon pb-3">
                                <a href="{{ route('services.show', $service->slug) }}">
                                    <img src="{{ asset("storage/services/$service->slug/".$service->icon['src']) }}" width="100"
                                    alt="{{ $service->icon['alt'] }}">
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title w-600"><a href="{{ route('services.show', $service->slug) }}">
                                        {{ $service->title }} </a></h4>
                                <p class="description b1 color-gray mb--0">
                                    {{ $service->summary }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
    <!-- End Service Area  -->










    <!----------- YouTube Video  ------------->
    <div class="rwt-video-area rn-section-gap rn-section-gapBottom" data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rn-gallery icon-center video-gallery-content slider-bg-image bg-image4" data-black-overlay="7">
                        <div class="overlay-content"><a class="btn-default rounded-player sm-size popup-video"
                                href="https://www.youtube.com/watch?v=8tgU-kdAw_k"><span>
                                    <i class="feather-play"></i>
                                </span></a>
                            <h3 class="title">WATCH VIDEO <br> Precision Accounting International Presentation</h3>
                        </div>
                        <div class="video-lightbox-wrapper"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- Start Team-Style-Default Area  -->
    <div class="rwt-team-area rn-section-gap">
        <div class="wrapper">
            <div class="container">
                <div class="row mb--20">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700"
                            data-sal-delay="100">
                            <h4 class="subtitle "><span class="theme-gradient">Partners</span></h4>
                            <h2 class="title w-600 mb--20">Our Experts Team</h2>
                            <p class="description b1">
                                Our Experts team is at your service at all times.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="rn-slick-dot rn-slick-arrow team-slider mb--60" data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back" >
                    @foreach ($members as $member)
                        <div class="mt--30 sal-animate me-3 ms-3">
                            <div class="rn-team team-style-default">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <img src="{{ asset('storage/members/'.$member->img['src']) }}" alt="{{ $member->img['alt'] }}">
                                    </div>
                                    <div class="content">
                                        <a class="title d-block" href="{{ route('team.show', $member->slug) }}">{{ $member->name }}</a>
                                        <h6 class="subtitle theme-gradient">{{ $member->job_title }}</h6>
                                        @if ( $member->linkedin )
                                            <a href="{{ $member->linkedin }}" target="_blank" class="d-flex justify-content-center align-items-center gap-1">
                                                <i class="fa-brands fa-linkedin"></i>
                                                <span>Follow on LinkedIn</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-12 text-center">
                    <div class="rwt-load-more text-center">
                        <a class="btn-default mt--30" href="{{ route("team.index") }}">View Full Team
                            <i class="feather-loader"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Team-Style-Default Area  -->












    <!-- Start Seperator Area  -->
    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>
    <!-- End Seperator Area  -->













    <!-- Start testimonial Four -->
    <div class="rwt-testimonial-area rn-section-gap" id="customized-testimonial">
        <div class="container">
            <div class="row mb--20">
                <div class="col-lg-12">
                    <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700"
                        data-sal-delay="100">
                        <h4 class="subtitle "><span class="theme-gradient">Client Feedback</span></h4>
                        <h2 class="title w-600 mb--20">Our Clients Feedback</h2>
                        <p class="description b1">
                            We're constantly building features from clients feedback and want
                            <br>
                            the client experience to be second to none.
                        </p>
                    </div>
                </div>
            </div>

            <div class="rn-slick-dot rn-slick-arrow testimonial-activation mb--60"  data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">



                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-style-two">
                        <div class="row align-items-center row--20">
                            <div class="order-2 order-md-1 col-lg-8 col-md-8 offset-lg-1">
                                <div class="content mt_sm--40"><span class="form">&nbsp;</span>
                                    <p class="description">
                                        {!! $testimonial->content !!}
                                    </p>
                                    <div class="client-info">
                                        <h4 class="title">{{ $testimonial->name }}</h4>
                                        <h6 class="subtitle">{{ $testimonial->job_title }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="order-1 d-flex justify-content-center order-md-2 col-lg-2 col-md-4">
                                <div class="thumbnail"><img class="w-100"
                                        src="{{ asset('storage/testimonials/'.$testimonial->img) }}" alt="testimonial">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
    <!-- End testimonial Four  -->







    <!-- Start Seperator Area  -->
    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>
    <!-- End Seperator Area  -->














    <!-- Start Blog Area  -->
    <div class="blog-area rn-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center"  data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <h4 class="subtitle "><span class="theme-gradient">Latests News</span></h4>
                        <h2 class="title w-600 mb--20">Our Latest News</h2>
                        <p class="description b1">
                            We provide all what you need to know whether you <br> are a large firm or a startup.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt_dec--30">
                <div class="col-lg-12">
                    <div class="row row--15">
                        @foreach ($articles as $article)
                            <div class="col-lg-4 col-md-6 col-12 mt--30 "  data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                <div class="rn-card box-card-style-default">
                                    <div class="inner">
                                        <div class="thumbnail"><a class="image"
                                                href="{{ route('blog.article', $article->slug) }}"><img class="w-100"
                                                    src="{{ asset("storage/blog/$article->slug/".$article->img['src']) }}"
                                                    alt="{{ $article->img['alt'] }}"></a>
                                        </div>
                                        <div class="content">
                                            <ul class="rn-meta-list">
                                                <li><a href="{{ route('authors.show', $article->author->slug) }}"> {{ $article->author->name }} </a></li>
                                                <li class="separator">/</li>
                                                <li> {{ date('m-d-Y', strtotime($article->created_at)) }} </li>
                                            </ul>
                                            <h4 class="title"><a href="{{ route('blog.article', $article->slug) }}">
                                                    {{ $article->title }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div class="rwt-load-more text-center mt--60">
                        <a class="btn-default" href="{{ route('blog') }}">View More Post
                            <i class="feather-loader"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Area  -->






















    <!-- Start Seperator Area  -->
    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>
    <!-- End Seperator Area  -->




















    <!-- Start Main Counter Up Area  -->
    <div class="rwt-counterup-area rn-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700"
                        data-sal-delay="100">
                        <h4 class="subtitle "><span class="theme-gradient">Clients </span></h4>
                        <h2 class="title w-600 mb--20">Global Clients Around the World</h2>
                        <p class="description b1">Let’s See Our Valuable Clients Feedback about our services. </p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="count-box counter-style-2 text-center">
                        <div>
                            <div class="count-number"><span class="counter">301</span>+</div>
                        </div>
                        <h5 class="title">Bookkeeping service</h5>
                        <p class="description">
                            More than satisfied clients with our Bookkeeping service.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="count-box counter-style-2 text-center">
                        <div>
                            <div class="count-number"><span class="counter">251</span>+</div>
                        </div>
                        <h5 class="title">Payroll service</h5>
                        <p class="description">
                            More than satisfied clients
                            with our Payroll service.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="count-box counter-style-2 text-center">
                        <div>
                            <div class="count-number"><span class="counter">321</span>+</div>
                        </div>
                        <h5 class="title">Taxes service</h5>
                        <p class="description">
                            More than satisfied clients
                            with our Taxes service.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Counter Up Area  -->














    <!-- Start Call To Action Area  -->
    <div class="rwt-callto-action-area rn-section-gapBottom">
        <div class="wrapper">
            <div class="rn-callto-action clltoaction-style-default style-5">
                <div class="container">
                    <div class="row row--0 align-items-center content-wrapper theme-shape">
                        <div class="col-lg-12">
                            <div class="inner">
                                <div class="content text-center"  data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <h2 class="title">Keep in touch with our expert CPAs</h2>
                                    {{-- <h6 class="subtitle">MEET WITH US</h6> --}}
                                    <div class="call-to-btn">
                                        <a class="btn-default btn-icon" href="{{ route('contact') }}">MEET WITH US
                                            <i class="feather-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Call To Action Area  -->














@endsection
