@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">
        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center sal-animate" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                            <h4 class="subtitle "><span class="theme-gradient">Partners</span></h4>
                            <h2 class="title w-600 mb--20"> Meet Our Experts</h2>
                            {{-- <p class="description b1">Access the most recent analyses and insights. </p> --}}
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    @foreach ( $members as $member )
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rn-team team-style-default">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <img src="{{ asset('images/members/' . $member->img) }}" alt="member-image">
                                    </div>
                                    <div class="content">
                                        <h2 class="title">{{ $member->name }}</h2>
                                        <h6 class="subtitle theme-gradient">{{ $member->job_title }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
