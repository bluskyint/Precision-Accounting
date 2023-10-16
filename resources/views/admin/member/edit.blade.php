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
                <li class="breadcrumb-item"><a href="{{ route('admin.member.index') }}">Members</a></li>
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
                                            Member </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.member.update' , $member->slug) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- Name -------------------->
                                        <x-forms.text-input label="Name" name="name" value="{{ $member->name }}" icon-class="fa-solid fa-heading" placeholder="Type Name..." />

                                        <!----------------- slug -------------------->
                                        <x-forms.text-input label="Permalink" name="slug" value="{{ $member->slug }}" icon-class="fa-solid fa-link" placeholder="Ex: precision-accounting-international" />

                                        <!-----------------job title -------------------->
                                        <x-forms.text-input label="Job Title" name="job_title" value="{{ $member->job_title }}" icon-class="fa-solid fa-user-tie" placeholder="Type Job Title..." />

                                        <!----------------- LinkedIn Account Link -------------------->
                                        <x-forms.text-input label="LinkedIn Account" name="linkedin" value="{{ $member->linkedin }}" icon-class="fa-brands fa-linkedin" placeholder="Type LinkedIn Account..." />

                                        <!----------------- Info -------------------->
                                        <x-forms.ck-editor id="editor-no-upload" label="info" name="info" value="{!! $member->info !!}" />

                                        <!----------------- Seo Title -------------------->
                                        <x-forms.text-input label="SEO Title" name="seo_title" value="{{ $member->seo_title }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Title..." />

                                        <!----------------- Seo Description -------------------->
                                        <x-forms.text-input label="SEO Description" name="seo_description" value="{{ $member->seo_description }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Description..." />

                                        <!----------------- Seo Keywords -------------------->
                                        <x-forms.text-input label="SEO Keywords" name="seo_keywords" value="{{ $member->seo_keywords }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Keywords..." />

                                        <!----------------- Seo Robots -------------------->
                                        <x-forms.text-input label="SEO Robots" name="seo_robots" value="{{ $member->seo_robots }}" icon-class="fa-solid fa-chart-line" placeholder="Type SEO Robots..." />

                                        <!----------------- OpenGraph Title -------------------->
                                        <x-forms.text-input label="OpenGraph Title" name="og_title" value="{{ $member->og_title }}" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Title..." />

                                        <!----------------- OpenGraph Type -------------------->
                                        <x-forms.text-input label="OpenGraph Type" name="og_type" value="{{ $member->og_type }}" icon-class="fa-solid fa-chart-line" placeholder="Type OpenGraph Type..." />

                                        <!----------------- Show In Slider -------------------->
                                        <x-forms.select-option label="Show In Slider" name="slider_show" icon-class="fa-solid fa-panorama">
                                            <option value="1" {{ $member->slider_show == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $member->slider_show == '0' ? 'selected' : '' }}>No</option>
                                        </x-forms.select-option>

                                        <!----------------- Img -------------------->
                                        <x-forms.upload-img-input label="Image" name="img" altTextValue="{{ $member->img['alt'] }}">
                                            <div class="show-img-container">
                                                <a href="{{ asset("storage/members/".$member->img['src']) }}"  target="_blank">
                                                    <img src="{{ asset("storage/members/".$member->img['src']) }}" alt="{{ $member->img['alt'] }}">
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
