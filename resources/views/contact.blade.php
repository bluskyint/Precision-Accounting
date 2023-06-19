@extends('layouts.app')

@section('content')


<div class="main-content pt--125">

    <div class="rwt-contact-area rn-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb--40">
                    <div class="section-title text-center"  data-sal="slide-down" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <h4 class="subtitle "><span class="theme-gradient">Contact Form</span></h4>
                        <h2 class="title w-600 mb--20">Our Contact Address Here</h2>
                    </div>
                </div>
            </div>
            <div class="row row--15">
                <div class="col-lg-12">
                    <div class="rn-contact-address mt_dec--30"  data-sal="slide-up" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 mt-3">
                                <div class="rn-address row">
                                    <div class="col-lg-6 col-md-6 col-12 mt-3 us-box text-center">
                                        <div class="icon">
                                            <img src="{{ asset('doob_template_assets/images/icons/usa.png') }}" alt="usa-flag" width="50">
                                        </div>
                                        <div class="inner">
                                            <h4 class="title text-center">US Office</h4>
                                            <p>
                                                <strong> <i class="feather-map-pin"></i> </strong>
                                                <a href="https://g.page/PrecisionAccountingIntl?share" target="_blank"> 1035 US Highway 46 East STE B-101, Clifton, NJ 07013 </a>
                                            </p>
                                            <p>
                                                <span> <i class="feather-phone"></i> <a href="tel:+19739561040"> (973) 956-1040 </a> </span>
                                                <span> &nbsp; , &nbsp; </span>
                                                <span> <i class="feather-message-circle"></i>  <a href="sms:+19733045553"> (973) 304-5553 </a> </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 mt-3 us-box text-center">
                                        <div class="icon">
                                            <img src="{{ asset('doob_template_assets/images/icons/egypt.png') }}" alt="eg-flag" width="50">
                                        </div>
                                        <div class="inner">
                                            <h4 class="title text-center">EG Office</h4>
                                            <p>
                                                <strong> <i class="feather-map-pin"></i> </strong>
                                                <a href="https://www.google.com/maps?q=31.2119026,29.9415277&z=17&hl=en" target="_blank"> 36 Kamal el-Din Salah st, Admon Fremon, Smouha ,Alex </a>
                                            </p>
                                            <p>
                                                <span> <i class="feather-phone"></i> <a href="tel:+2034249018">(03) 4249018 </a></span>
                                                <span> &nbsp; , &nbsp; </span>
                                                <span> <i class="feather-phone"></i> <a href="tel:+2034249015">(03) 4249015 </a></span>
                                            </p>
                                        </div>
                                    </div>
                                    &nbsp;
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12 text-center">
                                            <p style="font-size: 22px; margin: 0 0 15px;">
                                                <i class="feather-mail"></i>
                                                <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt--40 row--15 pt--15">
                <div class="col-lg-7"  data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                    <form class="contact-form-1 rwt-dynamic-form" id="contact-form" action="{{ route("contact.send") }}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" placeholder="Your Name..." value="{{ old("name") }}" required/>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}.</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" placeholder="Your Phone Number..." value="{{ old("phone") }}" required/>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}.</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Your Email Address..." value="{{ old("email") }}" required/>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}.</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="messege" id="messege" placeholder="Your Message..." required>{{ old("messege") }}</textarea>
                            @error('messege')
                                <div class="invalid-feedback d-block">{{ $message }}.</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" id="submit" class="btn-default btn-large rn-btn">
                                <span>Submit Now</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 mt_md--30 mt_sm--30"  data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                    <div class="google-map-style-1">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1268.5097799282705!2d-74.17878609806533!3d40.870958812432235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2fe854565461d%3A0xdfd91d80dc47b508!2sPrecision%20Accounting%20Intl%20LLC!5e0!3m2!1sen!2seg!4v1610010205990!5m2!1sen!2seg" width="600" height="550" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
