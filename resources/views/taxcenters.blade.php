@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">


        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                            <div class="subtitle">
                                <a class="theme-gradient" href="{{ route('home') }}">Home</a>
                                <span class="theme-gradient">/</span>
                                <a class="theme-gradient" href="{{ route('tax-centers.index') }}">Tax Centers</a>
                            </div>
                            <h1>{{ $page->heading }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    @foreach ( $taxcenters as $taxcenter )
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="service service__style--2 text-center pt-5">
                                <a class="inner" href="{{ route('tax-centers.show', $taxcenter->slug) }}">
                                    <div class="image">
                                        <img src="{{ asset("storage/tax-centers/$taxcenter->slug/".$taxcenter->img['src']) }}" alt="{{ $taxcenter->img['alt'] }}">
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            {{ $taxcenter->title }}
                                        </h4>
                                        <p class="subtitle"> {{ $taxcenter->subtitle }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>



    </div>
@endsection
