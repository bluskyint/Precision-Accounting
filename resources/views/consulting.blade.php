@extends('layouts.app')

@section('content')


<div class="main-content pt--125">

    <div class="rwt-contact-area rn-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb--40">
                    <div class="section-title text-center">
                        <h4 class="subtitle"  data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back"> <span class="theme-gradient">FILL THE BELOW FORM TO GET YOUR
                        </span></h4>
                        <h2 class="title w-600 mb--20"  data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">Free Consulting Now
                            </h2>
                    </div>
                </div>
            </div>


            <div class="row mt--40 row--15 pt--15">
                <div class="col-lg-7" data-sal="slide-right" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                    <form class="contact-form-1 rwt-dynamic-form" id="contact-form" method="POST" action="{{ route('consulting.send') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="first_name" placeholder="Your First Name......" value="{{ old("first_name") }}" required/>
                                    @error('first_name')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="last_name" id="last_name" placeholder="Your Last Name......" value="{{ old("last_name") }}" required/>
                                    @error('last_name')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" placeholder="Your Phone Number..." value="{{ old("phone") }}" required/>
                                    @error('phone')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Your Email Address..." value="{{ old("email") }}" required/>
                                    @error('email')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="address" id="address" placeholder="Your Address..." value="{{ old("address") }}" required/>
                                    @error('address')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="business_service" id="business_service" placeholder="Your Business Service..." value="{{ old("business_service") }}" required/>
                                    @error('business_service')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="business_type" id="business_type" placeholder="Your Business Type..." value="{{ old("business_type") }}" required/>
                                    @error('business_type')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="state" id="state" required>

                                        <option selected="selected" value="" disabled="">Select a State...</option>

                                        <option value="AL">Alabama</option>

                                        <option value="AK">Alaska</option>

                                        <option value="AZ">Arizona</option>

                                        <option value="AR">Arkansas</option>

                                        <option value="CA">California</option>

                                        <option value="CO">Colorado</option>

                                        <option value="CT">Connecticut</option>

                                        <option value="DE">Delaware</option>

                                        <option value="DC">District Of Columbia</option>

                                        <option value="FL">Florida</option>

                                        <option value="GA">Georgia</option>

                                        <option value="HI">Hawaii</option>

                                        <option value="ID">Idaho</option>

                                        <option value="IL">Illinois</option>

                                        <option value="IN">Indiana</option>

                                        <option value="IA">Iowa</option>

                                        <option value="KS">Kansas</option>

                                        <option value="KY">Kentucky</option>

                                        <option value="LA">Louisiana</option>

                                        <option value="ME">Maine</option>

                                        <option value="MD">Maryland</option>

                                        <option value="MA">Massachusetts</option>

                                        <option value="MI">Michigan</option>

                                        <option value="MN">Minnesota</option>

                                        <option value="MS">Mississippi</option>

                                        <option value="MO">Missouri</option>

                                        <option value="MT">Montana</option>

                                        <option value="NE">Nebraska</option>

                                        <option value="NV">Nevada</option>

                                        <option value="NH">New Hampshire</option>

                                        <option value="NJ">New Jersey</option>

                                        <option value="NM">New Mexico</option>

                                        <option value="NY">New York</option>

                                        <option value="NC">North Carolina</option>

                                        <option value="ND">North Dakota</option>

                                        <option value="OH">Ohio</option>

                                        <option value="OK">Oklahoma</option>

                                        <option value="OR">Oregon</option>

                                        <option value="PA">Pennsylvania</option>

                                        <option value="RI">Rhode Island</option>

                                        <option value="SC">South Carolina</option>

                                        <option value="SD">South Dakota</option>

                                        <option value="TN">Tennessee</option>

                                        <option value="TX">Texas</option>

                                        <option value="UT">Utah</option>

                                        <option value="VT">Vermont</option>

                                        <option value="VA">Virginia</option>

                                        <option value="WA">Washington</option>

                                        <option value="WV">West Virginia</option>

                                        <option value="WI">Wisconsin</option>

                                        <option value="WY">Wyoming</option>

                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="meeting" id="meeting" required>

                                        <option selected="selected" value="" disabled="" style="color:#000;">Meeting Type </option>

                                        <option value="Zoom Meeting">Zoom Meeting </option>

                                        <option value="Phone Call Meeting">Phone Call Meeting </option>

                                        <option value="Office Meeting">Office Meeting </option>

                                    </select>
                                    @error('meeting')
                                        <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <textarea name="messege" id="messege" placeholder="Your Message..." required>{{ old("messege") }}</textarea>
                            @error('messege')
                                <div class="invalid-feedback d-block" style="margin-left:10px">{{ $message }}.</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button name="submit" type="submit" id="submit" class="btn-default btn-large rn-btn">
                                <span>Submit Now</span>
                            </button>
                        </div>

                    </form>
                </div>
                <div class="col-lg-5 mt_md--30 mt_sm--30"  data-sal="slide-left" data-sal-duration="700" data-sal-delay="300" data-sal-easing="ease-out-back">
                    <div>
                        <img src="{{ asset("doob_template_assets/images/free-consulting.jpg") }}" class="free-consulting rounded" alt="free-consulting">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
