@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">
        <div class="rn-blog-details-area">
            <div class="post-page-banner" style="padding-top: 60px">
                <div class="container">
                    <div class="row">
                        <div class="row">
                            <div class="col-lg-12" data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                <div class="section-title text-center">
                                    <h4 class="subtitle "><span class="theme-gradient">Services . {{ $service->title }}                            </span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 offset-lg-2">
                            <div class="content text-center">
                                <div class="page-title"  data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <h1 class="theme-gradient"> {{ $service->title }} </h1>
                                </div>
                                <div class="thumbnail alignwide mt--60"  data-sal="slide-down" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <img class="w-100 radius"
                                        src="{{ asset("images/services/".$service->img) }}" alt="Blog Images"></div>
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
                                {!! $service->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
