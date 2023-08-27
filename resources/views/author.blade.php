@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">
        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center sal-animate" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                            <h4 class="subtitle "><span class="theme-gradient">Partners</span></h4>
                            <h2 class="title w-600 mb--20"> Author Info </h2>
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    <div class="col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                        <div class="rn-team team-style-default">
                            <div class="inner">
                                <div class="thumbnail">
                                    <img src="{{ asset("storage/authors/$author->img") }}" alt="member-image">
                                </div>
                                <div class="content">
                                    <a class="title d-block" href="{{ route('authors.show', $author->slug) }}">{{ $author->name }}</a>
                                    <h6 class="subtitle theme-gradient">{{ $author->job_title }}</h6>
                                    <a href="{{ $author->linkedin }}" target="_blank" class="d-flex justify-content-center align-items-center gap-1">
                                        <i class="fa-brands fa-linkedin"></i>
                                        <span>Follow on LinkedIn</span>
                                    </a>
                                    <div class="mt--30">
                                        {!! $author->info !!}
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
