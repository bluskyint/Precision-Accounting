@extends('layouts.admin')

@section('content')
    <div class="py-4 admin-page-info">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item " style="margin-top: -1px">
                    <a href="{{ route('home') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Articles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12 col-xl-7 col-xxl-8 mb-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="fs-5 fw-bold mb-0"> <i class="fa-solid fa-pen-to-square text-primary"></i> Edit
                                            Article</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.articles.update' , $article->slug) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- title -------------------->
                                        <x-forms.text-input label="Title" name="title" value="{{ $article->title }}" icon-class="fa-solid fa-heading" placeholder="Type Title..." />

                                        <!----------------- slug -------------------->
                                        <x-forms.text-input label="Permalink" name="slug" value="{{ $article->slug }}" icon-class="fa-solid fa-link" placeholder="Ex: precision-accounting-international" />

                                        <!----------------- subtitle -------------------->
                                        <x-forms.text-input label="Subtitle" name="subtitle" value="{{ $article->subtitle }}" icon-class="fa-solid fa-quote-left" placeholder="Type Subtitle..." />

                                        <!----------------- summary -------------------->
                                        <x-forms.text-input label="Summary" name="summary" value="{{ $article->summary }}" icon-class="fa-solid fa-list" placeholder="Type Summary..." />

                                        <!----------------- Author -------------------->
                                        <x-forms.select-option label="Author" name="author_id" icon-class="fa-solid fa-marker">
                                            @foreach ( $authors as $author )
                                                <option value="{{ $author->id }}"  {{ $author->id == $article->author->id ? "selected" : "" }} >{{ $author->name }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Catrgory_id -------------------->
                                        <x-forms.select-option label="Category" name="category_id" icon-class="fa-solid fa-code-branch">
                                            @foreach ( $categories as $category )
                                                <option value="{{ $category->id }}"  {{ $category->id == $article->category->id ? "selected" : "" }} >{{ $category->title }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Content -------------------->
                                        <x-forms.ck-editor label="Content" name="content" value="{{ $article->content }}" />

                                        <!----------------- pinned -------------------->
                                        <x-forms.select-option label="Pinned Article In Top" name="pinned" icon-class="fa-solid fa-thumbtack">
                                            <option value="0" {{ $article->pinned == '0' ? "selected" : "" }}> No </option>
                                            <option value="1" {{ $article->pinned == '1' ? "selected" : "" }}> Yes </option>
                                        </x-forms.select-option>

                                        <!----------------- Seo Title -------------------->
                                        <x-forms.text-input label="SEO Title" name="seo_title" value="{{ $article->seo_title }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Title..." />

                                        <!----------------- Seo Description -------------------->
                                        <x-forms.text-input label="SEO Description" name="seo_description" value="{{ $article->seo_description }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Description..." />

                                        <!----------------- Seo Keywords -------------------->
                                        <x-forms.text-input label="SEO Keywords" name="seo_keywords" value="{{ $article->seo_keywords }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Keywords..." />

                                        <!----------------- Seo Robots -------------------->
                                        <x-forms.text-input label="SEO Robots" name="seo_robots" value="{{ $article->seo_robots }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Robots..." />

                                        <!----------------- OpenGraph Title -------------------->
                                        <x-forms.text-input label="OpenGraph Title" name="og_title" value="{{ $article->og_title }}" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Title..." />

                                        <!----------------- OpenGraph Type -------------------->
                                        <x-forms.text-input label="OpenGraph Type" name="og_type" value="{{ $article->og_type }}" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Type..." />

                                        <!----------------- Img -------------------->
                                        <x-forms.upload-img-input label="Image" name="img" altTextValue="{{ $article->img['alt'] }}">
                                            <div class="show-img-container">
                                                <a href="{{ asset("storage/blog/$article->slug/".$article->img['src']) }}"  target="_blank">
                                                    <img src="{{ asset("storage/blog/$article->slug/".$article->img['src']) }}" alt="{{ $article->img['alt'] }}">
                                                </a>
                                            </div>
                                        </x-forms.upload-img-input>

                                        <!----------------- Submit Btn -------------------->
                                        <x-forms.submit-btn name="Save" />

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
