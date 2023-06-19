@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">


        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h4 class="subtitle "><span class="theme-gradient">Links</span></h4>
                            <h2 class="title w-600 mb--20"  data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back"> Our Resources</h2>
                            <p class="description b1"  data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back"> Access the most recent analyses and insights. </p>
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    @foreach ( $resources as $resource )
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="service service__style--2 text-center pt-5">
                                <div class="inner">
                                    <div class="image">
                                        <img src="{{ asset("images/resources/".$resource->img) }}" alt="resource-image">
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
