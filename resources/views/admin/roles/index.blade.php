@extends('layouts.admin')

@section('content')
    <div class="py-4 admin-page-info">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
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
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
                <h2 class="h4"> <i class="fa-solid fa-user-lock text-primary"></i> Roles List</h2>
            </div>
            @can('Add Roles')
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center">
                    <i class="fa-solid fa-plus"></i> &nbsp;New Role
                </a>
            </div>
            @endcan
        </div>

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



        @if ($roles->isEmpty())
            <!----------- No Data ------------->
            <div class="card card-body shadow border-0 d-flex justify-content-center align-items-center">
                <img src="{{ asset('volt_template_assets/images/no_data.png') }}" alt="no_data" class="img-fluid" style="max-width: 500px">
                <h5>Sorry... No Data Available !!</h5>
            </div>
        @else
            <!----------- Index Table ------------->
            <div class="card card-body shadow border-0 table-wrapper table-responsive">
                <table class="table member-table table-hover align-items-center index-table">
                        <thead>
                            <tr>
                                <th class="border-bottom">Name</th>
                                <th class="border-bottom">Date Created</th>
                                <th class="border-bottom">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <div>{{ $role->name }}</div>
                                    </td>
                                    <td><span class="fw-normal">{{ $role->created_at }}</span></td>
                                    <td class="actions d-flex align-items-center gap-2">
                                        <a href="{{ route('admin.roles.show', $role->id) }}" class="text-tertiary">
                                            <i class="fa-solid fa-eye fa-lg"></i>
                                        </a>
                                        @can('Edit Roles')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-info">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                        @endcan
                                        @can('Delete Roles')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="d-inline border-0 bg-transparent p-0">
                                                <i class="fa-solid fa-trash-can text-danger fa-lg"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        @endif



    </div>
@endsection
