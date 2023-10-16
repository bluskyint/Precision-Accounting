@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">
        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center sal-animate" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                            <h1 class="subtitle "><span class="theme-gradient">Partners</span></h1>
                            <h2 class="title w-600 mb--20"> Member Info </h2>
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    <div class="col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                        <div class="rn-team team-style-default">
                            <div class="inner">
                                <div class="thumbnail">
                                    <img src="{{ asset("storage/members/".$team_member->img['src']) }}" alt="{{ $team_member->img['alt'] }}">
                                </div>
                                <div class="content">
                                    <a class="title d-block" href="{{ route('team.show', $team_member->slug) }}">{{ $team_member->name }}</a>
                                    <h6 class="subtitle theme-gradient">{{ $team_member->job_title }}</h6>
                                    @if ( $team_member->linkedin )
                                        <a href="{{ $team_member->linkedin }}" target="_blank" class="d-flex justify-content-center align-items-center gap-1">
                                            <i class="fa-brands fa-linkedin"></i>
                                            <span>Follow on LinkedIn</span>
                                        </a>
                                    @endif
                                    <div class="mt--30">
                                        {!! $team_member->info !!}
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
