@extends('layouts.app')

@section('pageUrl', '')

@section('content')
    <div class="main-content pt--125">

        <div class="rn-blog-details-area">
            <div class="post-page-banner" style="padding-top: 60px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="content text-center">
                                <div class="page-title" data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <p class="h1 theme-gradient"> Explore Exciting Career Opportunities </p>
                                </div>
                                <ul class="rn-meta-list" data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <li>
                                        <i class="feather-user"></i>
                                        <a href="#"> Claire Tatarian </a>
                                    </li>
                                    <li>
                                        {{-- <i class="feather-calendar"></i>
                                        {{date( 'm-d-Y', strtotime( $article->created_at) )}}
                                    </li> --}}
                                </ul>
                                <div class="thumbnail alignwide mt--60"   data-sal="slide-down" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <img class="w-100 radius"
                                        src="{{ asset("doob_template_assets/images/career.webp") }}" alt="Career Images"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-details-content pt--60 rn-section-gapBottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="content dynamic-content">
                                <div class="page-title sal-animate" data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <h1 class="theme-gradient"> Job Description </h1>
                                </div>
                                <p>
                                    Are you looking for a rewarding career in the field of accounting and finance? Precision Accounting, a leading accounting firm based in NY, USA, is seeking talented individuals like you to join our dynamic team. We offer a wide range of career opportunities and provide a supportive and collaborative work environment.
                                </p>
                                <p>
                                    At Precision Accounting, we pride ourselves on delivering exceptional accounting services to our clients, and we are committed to nurturing a talented team of professionals who share our passion for excellence. As a member of our team, you will have the opportunity to work with diverse clients, gain valuable industry experience, and contribute to the growth and success of our organization.
                                </p>
                                <p>
                                    Join us and take your career to new heights. Whether you are an experienced professional or just starting your career in accounting, we have opportunities that will challenge and inspire you. We offer competitive compensation packages, ongoing professional development, and a chance to work alongside industry experts.
                                </p>
                                <div class="button-group mt--30"><a class="btn-default" target="_blank" href="https://airtable.com/shrYDhBcYrZ38GLhf">
                                    Apply Now!
                                    <i class="fa-sharp fa-solid fa-pen"></i>
                                </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
