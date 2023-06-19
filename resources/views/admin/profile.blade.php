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
                <li class="breadcrumb-item active" aria-current="page"> profile</li>
            </ol>
        </nav>


        <!--------------- Session Alert ----------------->
        @if (session()->has('success'))
            <div class="notyf" style="justify-content: flex-end; align-items: end;">
                <div class="notyf__toast notyf__toast--upper notyf__toast--disappear" style="animation-delay: 3s;">
                    <div class="notyf__wrapper">
                        <div> <i class="fa-solid fa-check pr-2"></i> {{ session()->get('success') }} </div>
                    </div>
                    <div class="notyf__ripple" style="background: #0ea271;"></div>
                </div>
            </div>
        @elseif(session()->has('failed'))
            <div class="notyf" style="justify-content: flex-end; align-items: end;">
                <div class="notyf__toast notyf__toast--upper notyf__toast--disappear" style="animation-delay: 3s;">
                    <div class="notyf__wrapper">
                        <div> <i class="fa-solid fa-x pr-2"></i> {{ session()->get('failed') }} </div>
                    </div>
                    <div class="notyf__ripple" style="background: #ca1a41;"></div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-xl-7 col-xxl-8 mb-4">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h2 class="fs-5 fw-bold mb-0"> <i class="fa-solid fa-pen-to-square text-primary"></i> Edit
                                            Profile</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.profile.update') }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        
                                        @method('PUT')


                                        <!------------------- Username --------------------->
                                        <div class="mb-4 input-content">
                                            <label for="name" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Username </label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" aria-describedby="emailHelp" placeholder="Type User Name..." autocomplete="nope" />
                                            @error('name')
                                                <small class="form-text text-danger">{{$message }}</small>
                                            @enderror
                                        </div>


                                        <!------------------- Email --------------------->
                                        <div class="mb-4 input-content">
                                            <label for="email" class="capitalize"> <i class="fa-solid fa-envelope"></i> Email Address </label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" aria-describedby="emailHelp" placeholder="Type User Email..." autocomplete="nope" />
                                            @error('email')
                                                <small class="form-text text-danger">{{$message }}</small>
                                            @enderror
                                        </div>


                                        <!------------------- password --------------------->
                                        <div class="mb-4 input-content">
                                            <label for="password" class="capitalize"> <i class="fa-solid fa-lock"></i> Password </label>
                                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Type User Password..." autocomplete="nope" />
                                            @error('password')
                                                <small class="form-text text-danger">{{$message }}</small>
                                            @enderror
                                        </div>


                                        <!------------------- password_confirmation --------------------->
                                        <div class="mb-4 input-content">
                                            <label for="password_confirmation" class="capitalize"> <i class="fa-solid fa-lock"></i> Password Confirmed </label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" aria-describedby="emailHelp" placeholder="Type User Password Again..." autocomplete="nope" />
                                            @error('password_confirmation')
                                                <small class="form-text text-danger">{{$message }}</small>
                                            @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary float-right" > <i class="fa-solid fa-floppy-disk"></i> Update </button>

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
