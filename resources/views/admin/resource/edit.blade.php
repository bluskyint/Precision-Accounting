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
                <li class="breadcrumb-item"><a href="{{ route('admin.resource.index') }}">Resources</a></li>
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
                                            Resource</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.resource.update' , $resource->id) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- title -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="title" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Title </label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $resource->title }}" aria-describedby="emailHelp" placeholder="Type Resource Title..." autocomplete="nope" />
                                            @error('title')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- slug -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="slug" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Permalink </label>
                                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ $resource->slug }}" aria-describedby="emailHelp" placeholder="Ex: precision-accounting-international" autocomplete="nope" />
                                            @error('slug')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- subtitle -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="subtitle" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Subtitle </label>
                                            <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ $resource->subtitle }}" aria-describedby="emailHelp" placeholder="Type Resource Subtitle..." autocomplete="nope" />
                                            @error('subtitle')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- summary -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="summary" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Summary </label>
                                            <input type="text" name="summary" id="title" class="form-control @error('summary') is-invalid @enderror" value="{{ $resource->summary }}" aria-describedby="emailHelp" placeholder="Type Resource Summary..." autocomplete="nope" />
                                            @error('summary')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- Content -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="content" class="capitalize"> <i class="fa-solid fa-align-left"></i> Resource Content </label>
                                            <textarea type="text" name="content" rows="5" class="ckeditor form-control @error('content') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Type Resource Content..." autocomplete="nope" >{{ $resource->content }}</textarea>
                                            @error('content')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- Img -------------------->
                                        <div class="mb-3 input-content">
                                            <label for="img" class="form-label d-flex align-items-center">
                                                <i class="fa-solid fa-image"></i> &nbsp;  Image
                                                <div class="show-img-container">
                                                    <a href="{{ asset("storage/resources/".$resource->img['src']) }}"  target="_blank">
                                                        <img src="{{ asset("storage/resources/".$resource->img['src']) }}" alt="{{ $resource->img['alt'] }}">
                                                    </a>
                                                </div>
                                            </label>
                                            <input name="img[src]" type="file" class="form-control @error('img.src') is-invalid @enderror" id="img"  />
                                            @error('img.src')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- Img Alternative Text -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="alt_text" class="capitalize"> <i class="fa-solid fa-image"></i> Image Alternative Text </label>
                                            <input type="text" name="img[alt]" id="alt_text" class="form-control @error('img.alt') is-invalid @enderror" value="{{ $resource->img['alt'] }}" aria-describedby="emailHelp" placeholder="Type Image Alt Text..." autocomplete="nope" />
                                            @error('img.alt')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary float-right" > <i class="fa-solid fa-floppy-disk"></i> Save </button>

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
