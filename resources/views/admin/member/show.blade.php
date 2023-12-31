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
                <li class="breadcrumb-item active" aria-current="page">Show</li>
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
                                        <h2 class="fs-5 fw-bold mb-0"> <i class="fa-solid fa-eye text-primary"></i> Member Details</h2>
                                    </div>
                                    <div class="col text-end">
                                        @can('Edit Members')
                                            <a href="{{ route("admin.member.edit" , $member->slug) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                        @endcan
                                        @can('Delete Members')
                                            <a href="{{ route('admin.member.destroy', $member->slug) }}" class="btn btn-sm btn-danger delete-record">
                                                <i class="fa-solid fa-trash-can"></i> Delete
                                            </a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush show-data">
                                    <tbody>
                                    <tr>
                                        <td class="text-capitalize"> <i class="fa-solid fa-image"></i> Image </td>
                                        <td class="article-image">
                                            <a href="{{ asset("storage/members/".$member->img['src']) }}"  target="_blank">
                                                <img src="{{ asset("storage/members/".$member->img['src']) }}" alt="{{ $member->img['alt'] }}">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"> <i class="fa-solid fa-image"></i> Image Alternative Text </td>
                                        <td> {{ $member->img['alt']}} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"> <i class="fa-solid fa-heading"></i> Name </td>
                                        <td> {{ $member->name }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"> <i class="fa-solid fa-user-tie"></i> Job Title </td>
                                        <td> {{ $member->job_title }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"> <i class="fa-solid fa-link"></i> Permalink </td>
                                        <td> {{ $member->slug }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize"> <i class="fa-brands fa-linkedin"></i> LinkedIn </td>
                                        <td> {{ $member->linkedin ?? '-' }} </td>
                                    </tr>
                                    <tr>
                                        <td class="text-capitalize content"> <i class="fa-solid fa-align-left"></i> Info </td>
                                        <td> {!! $member->info !!} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
