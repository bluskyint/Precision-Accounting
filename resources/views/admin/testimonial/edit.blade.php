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
                <li class="breadcrumb-item"><a href="{{ route('admin.testimonial.index') }}">Testimonials</a></li>
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
                                            Testimonial</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.testimonial.update' , $testimonial->id) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- Name -------------------->
                                        <x-forms.text-input label="Name" name="name" value="{{ $testimonial->name }}" icon-class="fa-solid fa-heading" placeholder="Type Name..." />

                                        <!----------------- Job Title -------------------->
                                        <x-forms.text-input label="Job Title" name="job_title" value="{{ $testimonial->job_title }}" icon-class="fa-solid fa-user-tie" placeholder="Type Job Title..." />

                                        <!----------------- Visibility -------------------->
                                        <x-forms.select-option label="Visibility" name="visibility" icon-class="fa-solid fa-eye">
                                            <option value="1" {{ $testimonial->visibility === '1' ? "selected" : "" }} > Visible </option>
                                            <option value="0" {{ $testimonial->visibility === '0' ? "selected" : "" }} > Invisible </option>
                                        </x-forms.select-option>

                                        <!----------------- Content -------------------->
                                        <x-forms.ck-editor id="editor-no-upload" label="Content" name="content" value="{!! $testimonial->content !!}" />

                                        <!----------------- Img -------------------->
                                        <div class="mb-3 input-content">
                                            <label for="img" class="form-label d-flex align-items-center">
                                                <i class="fa-solid fa-image"></i> &nbsp;  Image
                                                <div class="show-img-container">
                                                    <a href="{{ asset("storage/testimonials/".$testimonial->img) }}"  target="_blank">
                                                        <img src="{{ asset("storage/testimonials/".$testimonial->img) }}" alt="testimonial-img">
                                                    </a>
                                                </div>
                                            </label>
                                            <input name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="img"  />
                                            @error('img')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

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
