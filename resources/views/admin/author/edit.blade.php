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
                <li class="breadcrumb-item"><a href="{{ route('admin.member.index') }}">Authors</a></li>
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
                                            Author </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.author.update' , $author->id) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- Name -------------------->
                                        <x-forms.text-input label="Name" name="name" value="{{ $author->name }}" icon-class="fa-solid fa-heading" placeholder="Type Name..." />

                                        <!----------------- slug -------------------->
                                        <x-forms.text-input label="Permalink" name="slug" value="{{ $author->job_title }}" icon-class="fa-solid fa-link" placeholder="Ex: precision-accounting-international" />

                                        <!-----------------job title -------------------->
                                        <x-forms.text-input label="Job Title" name="job_title" value="{{ $author->slug }}" icon-class="fa-solid fa-user-tie" placeholder="Type Job Title..." />

                                        <!----------------- LinkedIn Account Link -------------------->
                                        <x-forms.text-input label="LinkedIn Account" name="linkedin" value="{{ $author->linkedin }}" icon-class="fa-solid fa-linkedin" placeholder="Type LinkedIn Account..." />

                                        <!----------------- Author Info -------------------->
                                        <x-forms.ck-editor label="info" name="info" value="{!! $author->info !!}" />

                                        <!----------------- Img -------------------->
                                        <x-forms.upload-img-input label="Image" name="img" altTextValue="{{ $author->img['alt'] }}">
                                            <div class="show-img-container">
                                                <a href="{{ asset("storage/authors/".$author->img['src']) }}"  target="_blank">
                                                    <img src="{{ asset("storage/authors/".$author->img['src']) }}" alt="{{ $author->img['alt'] }}">
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
