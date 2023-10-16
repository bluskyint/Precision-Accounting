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
                <li class="breadcrumb-item active" aria-current="page"> Settings</li>
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
                                            Settings</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    @foreach( $pages as $page )
                                    <div class="accordion" id="accordion{{ $page->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed text-capitalize fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $page->id }}" aria-expanded="true" aria-controls="collapse{{ $page->id }}">
                                                    {{ $page->name }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $page->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion{{ $page->id }}">
                                                <form class="accordion-body" action="{{ route('admin.pages.update', $page->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-4 input-content">
                                                        <label for="seo_title" class="capitalize"> Seo Title </label>
                                                        <input type="text" name="seo_title" id="seo_title" class="form-control" value="{{ $page->seo_title ?: '' }}" placeholder="Type Seo Title..." />
                                                        @error('seo_title')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4 input-content">
                                                        <label for="heading" class="capitalize"> Heading (H1) </label>
                                                        <input type="text" name="heading" id="heading" class="form-control" value="{{ $page->heading ?: '' }}" placeholder="Type Page Heading (H1)..." />
                                                        @error('heading')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4 input-content">
                                                        <label for="seo_keywords" class="capitalize"> Seo Keywords </label>
                                                        <textarea name="seo_keywords" id="seo_keywords" rows="4" class="form-control @error('seo_keywords') is-invalid @enderror" placeholder="Type Page Keywords...">{{ $page->seo_keywords ?: '' }}</textarea>
                                                        @error('seo_keywords')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4 input-content">
                                                        <label for="seo_description" class="capitalize"> Seo Description </label>
                                                        <textarea name="seo_description" id="seo_description" rows="4" class="form-control @error('seo_description') is-invalid @enderror" placeholder="Type Page Description...">{{ $page->seo_description ?: '' }}</textarea>
                                                        @error('seo_description')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4 input-content">
                                                        <label for="seo_robots" class="capitalize"> Seo Robots </label>
                                                        <input type="text" name="seo_robots" id="seo_robots" class="form-control" value="{{ $page->seo_robots ?: '' }}" placeholder="Type Seo Robots..." />
                                                        @error('seo_robots')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4 input-content">
                                                        <label for="og_title" class="capitalize"> OpenGraph Title </label>
                                                        <input type="text" name="og_title" id="og_title" class="form-control" value="{{ $page->og_title ?: '' }}" placeholder="Type OpenGraph Title..." />
                                                        @error('og_title')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-4 input-content">
                                                        <label for="og_type" class="capitalize"> OpenGraph Type </label>
                                                        <input type="text" name="og_type" id="og_type" class="form-control" value="{{ $page->og_type ?: '' }}" placeholder="Type OpenGraph Type..." />
                                                        @error('og_type')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary mb-2" > <i class="fa-solid fa-floppy-disk"></i> Save </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
