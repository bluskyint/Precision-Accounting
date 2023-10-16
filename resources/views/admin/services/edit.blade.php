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
                                            Service</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.services.update' , $service->slug) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- title -------------------->
                                        <x-forms.text-input label="Title" name="title" value="{{ $service->title }}" icon-class="fa-solid fa-heading" placeholder="Type Title..." />

                                        <!----------------- slug -------------------->
                                        <x-forms.text-input label="Permalink" name="slug" value="{{ $service->slug }}" icon-class="fa-solid fa-link" placeholder="Ex: precision-accounting-international" />

                                        <!----------------- subtitle -------------------->
                                        <x-forms.text-input label="Subtitle" name="subtitle" value="{{ $service->subtitle }}" icon-class="fa-solid fa-quote-left" placeholder="Type Subtitle..." />

                                        <!----------------- summary -------------------->
                                        <x-forms.text-input label="Summary" name="summary" value="{{ $service->summary }}" icon-class="fa-solid fa-list" placeholder="Type Summary..." />

                                        <!----------------- Author -------------------->
                                        <x-forms.select-option label="Author" name="author_id" icon-class="fa-solid fa-marker">
                                            @foreach ( $authors as $author )
                                                <option value="{{ $author->id }}"  {{ $author->id == $service->author->id ? "selected" : "" }} >{{ $author->name }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Parent Service -------------------->
                                        <x-forms.select-option label="Parent Service (Optional)" name="parent_id" icon-class="fa-solid fa-marker">
                                            @foreach ( $services as $service_parent )
                                                <option value="{{ $service_parent->id }}"  {{ $service->parent_id == $service_parent->id ? "selected" : "" }} >{{ $service_parent->title }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Content -------------------->
                                        <x-forms.ck-editor label="Content" name="content" value="{{ $service->content }}" />

                                        <!----------------- Visibility -------------------->
                                        <x-forms.select-option label="Visibility" name="visibility" icon-class="fa-solid fa-eye">
                                            <option value="1" {{ $service->visibility === '1' ? "selected" : "" }} > Visible </option>
                                            <option value="0" {{ $service->visibility === '0' ? "selected" : "" }} > Invisible </option>
                                        </x-forms.select-option>

                                        <!----------------- Seo Title -------------------->
                                        <x-forms.text-input label="SEO Title" name="seo_title" value="{{ $service->seo_title }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Title..." />

                                        <!----------------- Seo Description -------------------->
                                        <x-forms.text-input label="SEO Description" name="seo_description" value="{{ $service->seo_description }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Description..." />

                                        <!----------------- Seo Keywords -------------------->
                                        <x-forms.text-input label="SEO Keywords" name="seo_keywords" value="{{ $service->seo_keywords }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Keywords..." />

                                        <!----------------- Seo Robots -------------------->
                                        <x-forms.text-input label="SEO Robots" name="seo_robots" value="{{ $service->seo_robots }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Robots..." />

                                        <!----------------- OpenGraph Title -------------------->
                                        <x-forms.text-input label="OpenGraph Title" name="og_title" value="{{ $service->og_title }}" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Title..." />

                                        <!----------------- OpenGraph Type -------------------->
                                        <x-forms.text-input label="OpenGraph Type" name="og_type" value="{{ $service->og_type }}" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Type..." />

                                        <!----------------- Icon -------------------->
                                        <x-forms.upload-img-input label="Icon" name="icon" altTextValue="{{ $service->icon['alt'] }}">
                                            <div class="show-img-container">
                                                <a href="{{ asset("storage/services/$service->slug/".$service->icon['src']) }}"  target="_blank">
                                                    <img src="{{ asset("storage/services/$service->slug/".$service->icon['src']) }}" alt="{{ $service->icon['alt'] }}">
                                                </a>
                                            </div>
                                        </x-forms.upload-img-input>

                                        <!----------------- Img -------------------->
                                        <x-forms.upload-img-input label="Image" name="img" altTextValue="{{ $service->img['alt'] }}">
                                            <div class="show-img-container">
                                                <a href="{{ asset("storage/services/$service->slug/".$service->img['src']) }}"  target="_blank">
                                                    <img src="{{ asset("storage/services/$service->slug/".$service->img['src']) }}" alt="{{ $service->img['alt'] }}">
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
