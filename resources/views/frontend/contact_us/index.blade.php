@extends('frontend.layouts.master')

@section('content')
    @include('frontend.contact_us.header')


    <section class="page-section" id="about">
        <div class="container relative">

            <div class="section-text mb-60 mb-sm-40 contact-us ">
                <div class="row mt-40">
                    <div class="col-12 col-md-12">

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="contact-form row ">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('home_page.first_name') }}</label>
                                        <input name="fname" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('home_page.last_name') }}</label>
                                        <input name="lname" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('home_page.email') }} <span>*</span></label>
                                        <input name="email" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('home_page.message') }}</label>
                                        <textarea name="message" class="form-control" type="text"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <button type="submit"
                                        class="btn btn-mod btn-w btn-medium">{{ __('home_page.send') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    {{-- <div class="col-12 col-md-5">
                        <div class="google-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14767.075238273756!2d114.1376148!3d22.2867458!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3404007cb92c5e2b%3A0xdd9c69eed655455!2sMG%20Group!5e0!3m2!1sen!2s!4v1662377564190!5m2!1sen!2s"
                                width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
