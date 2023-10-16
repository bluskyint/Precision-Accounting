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
                <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                                        <h2 class="fs-5 fw-bold mb-0"> <i class="fa-solid fa-plus text-primary"></i> Create
                                            Service</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">


                                        @csrf

                                        <!----------------- title -------------------->
                                        <x-forms.text-input label="Title" name="title" icon-class="fa-solid fa-heading" placeholder="Type Title..." />

                                        <!----------------- slug -------------------->
                                        <x-forms.text-input label="Permalink" name="slug" icon-class="fa-solid fa-link" placeholder="Ex: precision-accounting-international" />

                                        <!----------------- subtitle -------------------->
                                        <x-forms.text-input label="Subtitle" name="subtitle" icon-class="fa-solid fa-quote-left" placeholder="Type Subtitle..." />

                                        <!----------------- summary -------------------->
                                        <x-forms.text-input label="Summary" name="summary" icon-class="fa-solid fa-list" placeholder="Type Summary..." />

                                        <!----------------- Author -------------------->
                                        <x-forms.select-option label="Author" name="author_id" icon-class="fa-solid fa-marker">
                                            @foreach ( $authors as $author )
                                                <option value="{{ $author->id }}"  {{ old('author_id') == $author->id ? "selected" : "" }} >{{ $author->name }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Parent Service -------------------->
                                        <x-forms.select-option label="Parent Service (Optional)" name="parent_id" icon-class="fa-solid fa-code-branch">
                                            @foreach ( $services as $service )
                                                <option value="{{ $service->id }}"  {{ old('parent_id') == $service->id ? "selected" : "" }} >{{ $service->title }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Visibility -------------------->
                                        <x-forms.select-option label="Visibility" name="visibility" icon-class="fa-solid fa-eye">
                                            <option value="1" {{ old('visibility') == '1' ? "selected" : "" }} > Visible </option>
                                            <option value="0" {{ old('visibility') == '0' ? "selected" : "" }} > Invisible </option>
                                        </x-forms.select-option>

                                        <!----------------- Seo Title -------------------->
                                        <x-forms.text-input label="SEO Title" name="seo_title" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Title..." />

                                        <!----------------- Seo Description -------------------->
                                        <x-forms.text-input label="SEO Description" name="seo_description" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Description..." />

                                        <!----------------- Seo Keywords -------------------->
                                        <x-forms.text-input label="SEO Keywords" name="seo_keywords" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Keywords..." />

                                        <!----------------- Seo Robots -------------------->
                                        <x-forms.text-input label="SEO Robots" name="seo_robots" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Robots..." />

                                        <!----------------- OpenGraph Title -------------------->
                                        <x-forms.text-input label="OpenGraph Title" name="og_title" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Title..." />

                                        <!----------------- OpenGraph Type -------------------->
                                        <x-forms.text-input label="OpenGraph Type" name="og_type" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Type..." />

                                        <!----------------- Icon -------------------->
                                        <x-forms.upload-img-input label="Icon" name="icon" />

                                        <!----------------- Img -------------------->
                                        <x-forms.upload-img-input label="Image" name="img" />

                                        <!----------------- Submit Btn -------------------->
                                        <x-forms.submit-btn />

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
