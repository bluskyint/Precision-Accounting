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
                                        <h2 class="fs-5 fw-bold mb-0"> <i class="fa-solid fa-plus text-primary"></i> Create Testimonial </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">


                                        @csrf


                                        <!----------------- Name -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="name" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Username </label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" aria-describedby="emailHelp" placeholder="Type Usermame..." autocomplete="nope" />
                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Job Title -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="job_title" class="capitalize"> <i class="fa-solid fa-user-tie"></i> Job Title </label>
                                            <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}" aria-describedby="emailHelp" placeholder="Type Job Title..." autocomplete="nope" />
                                            @error('job_title')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Visibility -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="visibility" class="capitalize"> <i class="fa-solid fa-eye"></i> Testimonial Visibility </label>
                                            <select class="form-select form-control @error('visibility') is-invalid @enderror" name="visibility" id="visibility"  aria-label="Default select example" >
                                                <option value="1" {{ old('visibility') == '1' ? "selected" : "" }} > Visible </option>
                                                <option value="0" {{ old('visibility') == '0' ? "selected" : "" }} > Invisible </option>
                                            </select>
                                            @error('visibility')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Content -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="content" class="capitalize"> <i class="fa-solid fa-align-left"></i> Content </label>
                                            <textarea type="text" name="content"  rows="5" class="form-control @error('content') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Type Testimonial Content..." autocomplete="nope" >{{ old('content') }}</textarea>
                                            @error('content')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Img -------------------->
                                        <div class="mb-3 input-content">
                                            <label for="img" class="form-label"> <i class="fa-solid fa-image"></i> Image </label>
                                            <input name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="img"  />
                                            @error('img')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Submit Btn -------------------->
                                        <button type="submit" class="btn btn-primary float-right" > <i class="fa-solid fa-floppy-disk"></i> Submit </button>


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
