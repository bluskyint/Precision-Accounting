@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">
        <div class="rn-service-area rn-section-gap ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <div class="subtitle">
                                <a class="theme-gradient" href="{{ route('home') }}">Home</a>
                                <span class="theme-gradient">/</span>
                                <a class="theme-gradient" href="{{ route('authors.index') }}">Authors</a>
                                <span class="theme-gradient">/</span>
                                <a class="theme-gradient" href="{{ route('authors.show', $author->slug) }}">{{ $author->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row--15 service-wrapper">
                    <div class="col-12  mt-3sal-animate mt--30" data-sal="slide-up" data-sal-duration="700">
                        <div class="rn-team team-style-default">
                            <div class="inner">
                                <div class="thumbnail">
                                    <img src="{{ asset("storage/users/".$author->img['src']) }}" alt="{{ $author->img['alt'] }}">
                                </div>
                                <div class="content">
                                    <h1 class="title d-block">{{ $author->name }}</h1>
                                    <h6 class="subtitle theme-gradient">{{ $author->job_title }}</h6>
                                    <a href="{{ $author->linkedin }}" target="_blank" class="d-flex justify-content-center align-items-center gap-1">
                                        <i class="fa-brands fa-linkedin"></i>
                                        <span>Follow on LinkedIn</span>
                                    </a>
                                    <div class="mt--30 text-start">
                                        {!! $author->info !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row--15">
                        @foreach ( $author->articles as $article )
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
                                                <li><a href="#"> {{ $article->author->name }} </a></li>
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
            </div>
        </div>
    </div>
@endsection
