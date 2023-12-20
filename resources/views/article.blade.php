@extends('layouts.app')

@section('content')
    <div class="main-content pt--125">

        <div class="rn-blog-details-area">
            <div class="post-page-banner" style="padding-top: 60px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-center">
                                <div class="subtitle">
                                    <a class="theme-gradient" href="{{ route('home') }}">Home</a>
                                    <span class="theme-gradient">/</span>
                                    <a class="theme-gradient" href="{{ route('blog') }}">Blog</a>
                                    <span class="theme-gradient">/</span>
                                    <a class="theme-gradient" href="{{ route('blog.article', $article->slug) }}">{{ $article->title }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="content text-center">
                                <div class="page-title" data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <h1 class="theme-gradient"> {{ $article->title }} </h1>
                                    <p class=""> {{ $article->subtitle }} </p>
                                </div>
                                <ul class="rn-meta-list" data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <li>
                                        <i class="feather-user"></i>
                                        <a href="{{ route('authors.show', $article->author->slug) }}"> {{ $article->author->name }} </a>
                                    </li>
                                    <li>
                                        <i class="feather-calendar"></i>
                                        {{date( 'm-d-Y', strtotime( $article->created_at) )}}
                                    </li>
                                </ul>
                                <div class="thumbnail alignwide mt--60"   data-sal="slide-down" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                                    <img class="w-100 radius" src="{{ asset("storage/blog/$article->slug/".$article->img['src']) }}" alt="{{ $article->img['alt'] }}">
                                </div>
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
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>
                    <x-social-media-btns/>
                </div>
            </div>
        </div>

    </div>
@endsection
