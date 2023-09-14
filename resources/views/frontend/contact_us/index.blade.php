@extends('frontend.layouts.master')

@section('content')
    @include('frontend.contact_us.header')


    <section class="page-section" id="about">
        <div class="container relative">

            <div class="section-text mb-60 mb-sm-40 contact-us ">
                <div class="row">

                    <!-- Phone -->
                    <div class="col-12 col-lg-4 pt-sm-0 pt-md-30 pb-sm-20 pb-md-40 ">
                        <div class="contact-item" style="padding-left:0px">
                            <div class="ci-title font-alt gold pb-20" style="letter-spacing:0.15em;font-size:26px">
                                {{ __('home_page.Address') }}
                            </div>
                            <div class="ci-text" style="font-size:16px; line-height:1.8em;color:rgb(13, 33, 35)">
                                {{ __('home_page.Unit F, 18F, MG Tower, 133 Hoi Bun Road, Kwun Tong, Kowloon, Hong Kong') }}
                            </div>
                        </div>
                    </div>
                    <!-- End Phone -->

                    <!-- Address -->
                    <div class="col-12 col-lg-4 pt-sm-0 pt-md-30 pb-sm-20 pb-md-40  ">
                        <div class="contact-item">
                            <div class="ci-title font-alt gold pb-20" style="letter-spacing:0.15em;font-size:26px">
                                {{ __('home_page.contact_us') }}
                            </div>
                            <div class="ci-text" style="font-size:16px; line-height:1.8em;color:rgb(13, 33, 35)">
                                <div>(852) 3998 4916</div>
                                <a href="mailto:info@MGMetals.com">info@MGMetals.com</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Address -->

                    <!-- Email -->
                    <div class="col-12 col-lg-4 pt-sm-0 pt-md-30 pb-sm-20 pb-md-40  ">
                        <div class="contact-item">

                            <div class="ci-title font-alt gold pb-20" style="letter-spacing:0.15em;font-size:26px">
                                {{ __('home_page.open_hours') }}
                            </div>
                            <div class="ci-text" style="font-size:16px; line-height:1.8em;color:rgb(13, 33, 35)">
                                <div class="row">
                                    <div class="col-5">
                                        {{ __('home_page.Mon - Fri') }}<br>

                                        {{ __('home_page.Saturday') }}<br>

                                        {{ __('home_page.Sunday') }}<br>
                                    </div>
                                    <div class="col-7">
                                        8:00 am – 8:00 pm<br>

                                        9:00 am – 7:00 pm<br>

                                        9:00 am – 9:00 pm<br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Email -->

                </div>
                <div class="row mt-40">
                    <div class="col-12 col-md-6">

                        <div class="contact-form row ">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('home_page.first_name') }}</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('home_page.last_name') }}</label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('home_page.email') }} <span>*</span></label>
                                    <input class="form-control" type="email">
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <label>{{ __('home_page.message') }}</label>
                                    <textarea class="form-control" type="text"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <button class="btn btn-mod btn-w btn-medium">{{ __('home_page.send') }}</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-1"></div>
                    <div class="col-12 col-md-5">
                        <div class="google-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14767.075238273756!2d114.1376148!3d22.2867458!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3404007cb92c5e2b%3A0xdd9c69eed655455!2sMG%20Group!5e0!3m2!1sen!2s!4v1662377564190!5m2!1sen!2s"
                                width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
