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
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
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
                                            User</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        <!----------------- Name -------------------->
                                        <x-forms.text-input label="Name" name="name" icon-class="fa-solid fa-heading" placeholder="Type Name..." />

                                        <!----------------- Email -------------------->
                                        <x-forms.text-input label="Email" name="email" icon-class="fa-solid fa-envelope" placeholder="Type Email..." />

                                        <!----------------- Password -------------------->
                                        <x-forms.text-input label="Password" name="password" icon-class="fa-solid fa-lock" placeholder="Type Password..." />

                                        <!----------------- Password Confirmation -------------------->
                                        <x-forms.text-input label="Confirm Password " name="password_confirmation" icon-class="fa-solid fa-lock" placeholder="Retype Password..." />

                                        <!----------------- Job title -------------------->
                                        <x-forms.text-input label="Job Title" name="job_title" icon-class="fa-solid fa-user-tie" placeholder="Type Job Title..." />

                                        <!----------------- User Role -------------------->
                                        <x-forms.select-option label="Role" name="role_id" icon-class="fa-solid fa-lock">
                                            @foreach ( $roles as $role )
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? "selected" : "" }} >{{ $role->name }}</option>
                                            @endforeach
                                        </x-forms.select-option>

                                        <!----------------- Active User -------------------->
                                        <x-forms.select-option label="Status" name="active" icon-class="fa-solid fa-bolt">
                                            <option value="1" {{ old('role_id') == 1 ? "selected" : "" }} >Active</option>
                                            <option value="0" {{ old('role_id') == 0 ? "selected" : "" }} >Inactive</option>
                                        </x-forms.select-option>

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
