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
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
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
                                        <h2 class="fs-5 fw-bold mb-0"> <i class="fa-solid fa-plus text-primary"></i> Create Role</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <form action="{{ route('admin.roles.store') }}" method="POST">

                                        @csrf

                                        <!----------------- Name -------------------->
                                        <x-forms.text-input label="Role Name" name="name" icon-class="fa-solid fa-heading" placeholder="Type Name..." />

                                        <div class="row gy-3">
                                        @foreach($permissionsGroups as $group_name => $permissions)
                                            <div class="col-4">
                                                <span class="text-capitalize fw-bolder">&nbsp;• {{ $group_name }}</span>
                                                @foreach($permissions as $permission)
                                                    <div class="form-check">
                                                        <label class="capitalize">
                                                            <input type="checkbox" name="permissions[]" class="form-check-input @error( 'permissions' ) is-invalid @enderror"
                                                                   value="{{ $permission->id }}" autocomplete="nope"/>
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                        </div>
                                        @error( 'permissions' )
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror

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
