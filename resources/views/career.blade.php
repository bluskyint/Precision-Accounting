@extends('layouts.app')

@section('content')

    <div class="main-content pt--125 pb--125">
        <div class="rn-blog-details-area">
            <div class="post-page-banner">

                <div class="main-content">
                    <div class="rainbow-about-area rainbow-section-gap">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 mt--80">
                                    <div class="section-title text-center">
                                        <div class="section-title text-center sal-animate" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                                            <div class="subtitle">
                                                <a class="theme-gradient" href="{{ route('home') }}">Home</a>
                                                <span class="theme-gradient">/</span>
                                                <a class="theme-gradient" href="{{ route('career') }}">Career</a>
                                            </div>
                                            <h1 class="mb--40">{{ $page->heading }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row--30 align-items-center">
                                <div class="col-lg-7 mt_md--40 mt_sm--40">
                                    <div class="content sal-animate" data-sal="slide-left" data-sal-duration="800">
                                        <div class="section-title">
                                            <h3 class="title w-600 mb--20 sal-animate" data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                                Are you looking for a rewarding career in the field of accounting and finance ?
                                            </h3>
                                            <p>
                                                Precision Accounting, a leading accounting firm based in NY, USA, is seeking
                                                talented individuals like you to join our dynamic team. We offer a wide
                                                range of
                                                career opportunities and provide a supportive and collaborative work
                                                environment.</p>
                                            <p>At Precision Accounting, we pride ourselves on delivering exceptional
                                                accounting
                                                services to our clients, and we are committed to nurturing a talented team
                                                of
                                                professionals who share our passion for excellence. As a member of our team,
                                                you will have the opportunity to work with diverse clients, gain valuable
                                                industry
                                                experience, and contribute to the growth and success of our organization.
                                            </p>
                                            <p>We have opportunities that will challenge and inspire you. We offer ongoing
                                                professional development, and a chance to work alongside industry experts.
                                            </p>
                                            <p>Join us and take your career to new heights.</p>
                                            <div class="button-group mt--30">
                                                <a class="btn-default" target="_blank"
                                                    href="https://airtable.com/shrYDhBcYrZ38GLhf">
                                                    Apply Now!
                                                    <i class="fa-sharp fa-solid fa-pen"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="thumbnail sal-animate" data-sal="slide-right" data-sal-duration="800">
                                        <img class="w-100" src="{{ asset('doob_template_assets/images/career.webp') }}"
                                            alt="Careet Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
