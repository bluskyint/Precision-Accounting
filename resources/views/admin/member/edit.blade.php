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
                                    <form action="{{ route('admin.member.update' , $member->id) }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                        <!----------------- Name -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="name" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Name </label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $member->name }}" aria-describedby="emailHelp" placeholder="Type Member Name..." autocomplete="nope" />
                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- title -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="job_title" class="capitalize"> <i class="fa-solid fa-user-tie"></i> Job Title </label>
                                            <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ $member->job_title }}" aria-describedby="emailHelp" placeholder="Type Member Job Title..." autocomplete="nope" />
                                            @error('job_title')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        <!----------------- slider_show -------------------->
                                        <div class="mb-4 input-content">
                                            <label for="slider_show" class="capitalize"> <i class="fa-solid fa-sliders"></i> Visibile in Home Slider Show </label>
                                            <select class="form-select form-control @error('slider_show') is-invalid @enderror" name="slider_show" id="slider_show"  aria-label="Default select example" >
                                                <option></option>
                                                <option value="0" {{ $member->slider_show == '0' ? "selected" : "" }}> No </option>
                                                <option value="1" {{ $member->slider_show == '1' ? "selected" : "" }}> Yes </option>
                                            </select>
                                            @error('slider_show')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!----------------- Img -------------------->
                                        <div class="mb-3 input-content">
                                            <label for="img" class="form-label d-flex align-items-center">
                                                <i class="fa-solid fa-image"></i> &nbsp;  Image
                                                <div class="show-img-container">
                                                    <a href="{{ asset("images/members/".$member->img) }}"  target="_blank">
                                                        <img src="{{ asset("images/members/".$member->img) }}" alt="member-img">
                                                    </a>
                                                </div>
                                            </label>
                                            <input name="img" type="file" class="form-control @error('img') is-invalid @enderror" id="img"  />
                                            @error('img')
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
