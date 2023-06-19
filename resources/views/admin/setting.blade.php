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
                                    <form action="{{ route('admin.setting.update') }}" class="edit-form" method="POST" enctype="multipart/form-data">

                                        @csrf

                                        @method('PUT')

                                            {{-- <div>
                                                <!----------------- Nav Tabs ------------------->
                                                <ul class="nav nav-tabs" id="myTab">
                                                    <li class="nav-item">
                                                        <a href="#general" class="nav-link active" data-bs-toggle="tab">General Setting</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#contact" class="nav-link" data-bs-toggle="tab">Contact Tools</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#social" class="nav-link" data-bs-toggle="tab">Social Media</a>
                                                    </li>
                                                </ul>
                                                <!----------------- Tab Content ------------------->
                                                <div class="tab-content">


                                                    <!----------------- general Setting ------------------->
                                                    <div class="tab-pane fade show active" id="general">

                                                        <br>

                                                        <!----------------- head_title -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="head_title" class="capitalize"> <i class="fa-solid fa-file-signature"></i> Head Title </label>
                                                            <input type="text" name="head_title" id="head_title" class="form-control @error('head_title') is-invalid @enderror" value="{{ $setting->head_title }}" aria-describedby="emailHelp" placeholder="Type Head Title..." autocomplete="nope" />
                                                            @error('head_title')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!----------------- head_title -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="head_title" class="capitalize"> <i class="fa-solid fa-chart-line"></i> SEO Title </label>
                                                            <input type="text" name="head_title" id="head_title" class="form-control @error('head_title') is-invalid @enderror" value="{{ $setting->head_title }}" aria-describedby="emailHelp" placeholder="Type SEO Title For Website..." autocomplete="nope" />
                                                            @error('head_title')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!----------------- seo_description -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="seo_description" class="capitalize"> <i class="fa-solid fa-chart-line"></i> SEO Description </label>
                                                            <input type="text" name="seo_description" id="seo_description" class="form-control @error('seo_description') is-invalid @enderror" value="{{ $setting->seo_description }}" aria-describedby="emailHelp" placeholder="Type SEO Description For Website..." autocomplete="nope" />
                                                            @error('seo_description')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- seo_keywords -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="seo_keywords" class="capitalize"> <i class="fa-solid fa-chart-line"></i> SEO Keywords </label>
                                                            <input type="text" name="seo_keywords" id="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror" value="{{ $setting->seo_keywords }}" aria-describedby="emailHelp" placeholder="Type SEO Keywords For Website..." autocomplete="nope" />
                                                            @error('seo_keywords')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                    </div>


                                                    <!----------------- Contact Tools ------------------->
                                                    <div class="tab-pane fade" id="contact">

                                                        <br>

                                                        <!----------------- address -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="address" class="capitalize"> <i class="fa-solid fa-address-card"></i> Company Address </label>
                                                            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ $setting->address }}" aria-describedby="emailHelp" placeholder="Type Address..." autocomplete="nope" />
                                                            @error('address')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- location -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="location" class="capitalize"> <i class="fa-solid fa-location-dot"></i> Company Location </label>
                                                            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ $setting->location }}" aria-describedby="emailHelp" placeholder="Type Location (URL)..." autocomplete="nope" />
                                                            @error('location')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- email -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="email" class="capitalize"> <i class="fa-solid fa-envelope"></i> Email Address </label>
                                                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $setting->email }}" aria-describedby="emailHelp" placeholder="Type Email Address..." autocomplete="nope" />
                                                            @error('email')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- phone -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="phone" class="capitalize"> <i class="fa-solid fa-phone"></i> Phone Number </label>
                                                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $setting->phone }}" aria-describedby="emailHelp" placeholder="Type Phone Number..." autocomplete="nope" />
                                                            @error('phone')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- sms -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="sms" class="capitalize"> <i class="fa-solid fa-comment-sms"></i> SMS Number </label>
                                                            <input type="text" name="sms" id="sms" class="form-control @error('sms') is-invalid @enderror" value="{{ $setting->sms }}" aria-describedby="emailHelp" placeholder="Type SMS Number..." autocomplete="nope" />
                                                            @error('sms')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                    </div>


                                                    <!----------------- Social Media ------------------->
                                                    <div class="tab-pane fade" id="social">

                                                        <br>

                                                        <!----------------- whatsapp -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="whatsapp" class="capitalize"> <i class="fa-brands fa-whatsapp"></i> WhatsApp Number </label>
                                                            <input type="text" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ $setting->whatsapp }}" aria-describedby="emailHelp" placeholder="Type WhatsApp Number..." autocomplete="nope" />
                                                            @error('whatsapp')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- linkedin -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="linkedin" class="capitalize"> <i class="fa-brands fa-linkedin"></i> Linkedin </label>
                                                            <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ $setting->linkedin }}" aria-describedby="emailHelp" placeholder="Type Linkedin Account..." autocomplete="nope" />
                                                            @error('linkedin')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- facebook -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="facebook" class="capitalize"> <i class="fa-brands fa-facebook-square"></i> Facebook </label>
                                                            <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ $setting->facebook }}" aria-describedby="emailHelp" placeholder="Type Facebook Account..." autocomplete="nope" />
                                                            @error('facebook')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- twitter -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="twitter" class="capitalize"> <i class="fa-brands fa-twitter-square"></i> Twitter </label>
                                                            <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ $setting->twitter }}" aria-describedby="emailHelp" placeholder="Type Twitter Account..." autocomplete="nope" />
                                                            @error('twitter')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                        <!----------------- youtube -------------------->
                                                        <div class="mb-4 input-content">
                                                            <label for="youtube" class="capitalize"> <i class="fa-brands fa-youtube"></i> Youtube </label>
                                                            <input type="text" name="youtube" id="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ $setting->youtube }}" aria-describedby="emailHelp" placeholder="Type Youtube Account..." autocomplete="nope" />
                                                            @error('youtube')
                                                                <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>


                                                    </div>


                                                </div>
                                            </div> --}}


                                            <!----------------- email -------------------->
                                            <div class="mb-4 input-content">
                                                <label for="email" class="capitalize"> <i class="fa-solid fa-envelope"></i> Email Address </label>
                                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $setting->email }}" aria-describedby="emailHelp" placeholder="Type Email Address..." autocomplete="nope" />
                                                @error('email')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!----------------- linkedin -------------------->
                                            <div class="mb-4 input-content">
                                                <label for="linkedin" class="capitalize"> <i class="fa-brands fa-linkedin"></i> Linkedin </label>
                                                <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ $setting->linkedin }}" aria-describedby="emailHelp" placeholder="Type Linkedin Account..." autocomplete="nope" />
                                                @error('linkedin')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <!----------------- facebook -------------------->
                                            <div class="mb-4 input-content">
                                                <label for="facebook" class="capitalize"> <i class="fa-brands fa-facebook-square"></i> Facebook </label>
                                                <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ $setting->facebook }}" aria-describedby="emailHelp" placeholder="Type Facebook Account..." autocomplete="nope" />
                                                @error('facebook')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <!----------------- twitter -------------------->
                                            <div class="mb-4 input-content">
                                                <label for="twitter" class="capitalize"> <i class="fa-brands fa-twitter-square"></i> Twitter </label>
                                                <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ $setting->twitter }}" aria-describedby="emailHelp" placeholder="Type Twitter Account..." autocomplete="nope" />
                                                @error('twitter')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <!----------------- youtube -------------------->
                                            <div class="mb-4 input-content">
                                                <label for="youtube" class="capitalize"> <i class="fa-brands fa-youtube"></i> Youtube </label>
                                                <input type="text" name="youtube" id="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ $setting->youtube }}" aria-describedby="emailHelp" placeholder="Type Youtube Account..." autocomplete="nope" />
                                                @error('youtube')
                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                        <button type="submit" class="btn btn-primary float-right" > <i class="fa-solid fa-floppy-disk"></i> Save All</button>

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
