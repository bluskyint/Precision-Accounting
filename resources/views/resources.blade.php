@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">


        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                            <div class="subtitle">
                                <a class="theme-gradient" href="{{ route('home') }}">Home</a>
                                <span class="theme-gradient">/</span>
                                <a class="theme-gradient" href="{{ route('contact') }}">Resources</a>
                            </div>
                            <h1>{{ $page->heading }}</h1>
                            <p class="description b1"> Access the most recent analyses and insights. </p>
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    @foreach ( $resources as $resource )
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="service service__style--2 text-center pt-5">
                                <div class="inner">
                                    <div class="image">
                                        <img src="{{ asset("storage/resources/".$resource->img['src']) }}" alt="{{ $resource->img['alt'] }}">
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            {{ $resource->title }}
                                        </h4>
                                        <div class="description b1 color-gray mb--0 dynamic-content">
                                            {!! $resource->content !!}
                                        </div>
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
