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
                <li class="breadcrumb-item"><a href="{{ route('admin.author.index') }}">Authors</a></li>
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
                                            Author</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.author.store') }}" method="POST" enctype="multipart/form-data">


                                        @csrf

                                        <!----------------- Name -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="name" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Name </label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" aria-describedby="emailHelp" placeholder="Type Author Name..." autocomplete="nope" />
                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- slug -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="slug" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Permalink </label>
                                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" aria-describedby="emailHelp" placeholder="Ex: precision-accounting-international" autocomplete="nope" />
                                            @error('slug')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- Job title -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="job_title" class="capitalize"> <i class="fa-solid fa-user-tie"></i> Job Title </label>
                                            <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}" aria-describedby="emailHelp" placeholder="Type Author Job Title..." autocomplete="nope" />
                                            @error('job_title')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- LinkedIn Account Link -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="linkedin" class="capitalize"> <i class="fa-brands fa-linkedin"></i> LinkedIn Account </label>
                                            <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin') }}" aria-describedby="emailHelp" placeholder="Type Author LinkedIn Account..." autocomplete="nope" />
                                            @error('linkedin')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Author Info -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="info" class="capitalize"> <i class="fa-solid fa-align-left"></i> Info </label>
                                            <textarea type="text" name="info" rows="5" class="ckeditor form-control @error('info') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Type Author Info..." autocomplete="nope" >{{ old('info') }}</textarea>
                                            @error('info')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- Img -------------------->
                                        <div class="mb-3 input-content">
                                            <label for="img_src" class="form-label"> <i class="fa-solid fa-image"></i> Image </label>
                                            <input name="img[src]" type="file" class="form-control @error('img.src') is-invalid @enderror" id="img_src"  />
                                            @error('img.src')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- Img Alternative Text -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="alt_text" class="capitalize"> <i class="fa-solid fa-image"></i> Image Alternative Text </label>
                                            <input type="text" name="img[alt]" id="alt_text" class="form-control @error('img.alt') is-invalid @enderror" value="{{ old('img.alt') }}" aria-describedby="emailHelp" placeholder="Type Image Alt Text..." autocomplete="nope" />
                                            @error('img.alt')
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