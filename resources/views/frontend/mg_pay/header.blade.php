@extends('frontend.layouts.master')

@section('content')
    <section class="home-section home-section-banner mg-pay bg-gray parallax-2 web-banner" id="home">
        <div class="js-height-full">

            <!-- Hero Content -->
            <div class="home-content container comming-soon">
                <div class="home-text">

                    <h1 class="hs-line-11 font-alt mb-50 mb-xs-30 text-white playfare">{{ __('home_page.coming_soon') }}</h2>
                        <p class="hs-line-8 font-alt mb-50 mb-xs-30 text-white">{{ __('home_page.notify_signup') }}</p>

                        {{-- <div class="local-scroll">
                        <a href="{{ route('contact_us') }}"
                            class="btn btn-mod btn-medium btn-round d-none d-sm-inline-block">{{ __('home_page.contact_us') }}</a>
                        <span class="d-none d-sm-inline-block">&nbsp;</span>
                        <a href="{{ route('shop') }}"
                            class="btn btn-mod btn-medium btn-round">{{ __('home_page.purchase') }}</a>
                    </div> --}}

                        <div class="mb-20 mb-md-10">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="d-flex">
                                        <input type="text" name="email" id="name-2" class="input-md form-control"
                                            placeholder="{{ __('home_page.enter_email') }}" maxlength="100">
                                        <a href="#" class="btn btn-mod btn-border-w btn-round btn-large">
                                            {{ __('home_page.notify_me') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- End Hero Content -->

            <!-- Scroll Down -->
            <div class="local-scroll">
                <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                        class="sr-only">Scroll to the next section</span></a>
            </div>
            <!-- End Scroll Down -->

        </div>

        <!-- <video class="bg-video" autoplay loop preload="metadata" >
                                                <source type="video/mp4" src="{{ asset('frontend/images/banners/bg-video.mp4') }}">
                                                </video> -->
        <video class="bg-video" style="transform: translateX(-1px);" role="presentation" crossorigin="anonymous"
            playsinline="" preload="auto" muted="" loop="" tabindex="-1" width="100%" height="100%"
            autoplay="" src="{{ asset('frontend/images/banners/bg-video-2.mp4') }}" style=""></video>
    </section>


    <section class="home-section bg-gray parallax-2 mobile-banner"
        data-background="{{ asset('frontend/images/mobile-banner.jpeg') }}"id="home">

        <div class="js-height-full">

            <!-- Hero Content -->
            <div class="home-content container comming-soon">
                <div class="home-text">

                    <h1 class=" font-alt mb-50 mb-xs-30 text-white playfare">MGPay Coming Soon</h1>
                    <h2 class="font-alt mb-50 mb-xs-30 text-white">Sign up to be the first to know when we go live.</h2>

                    <div class="mb-20 mb-md-10">
                        <!-- Name -->
                        <input type="text" name="email" id="name-2" class="input-md form-control"
                            placeholder="{{ __('home_page.enter_email') }}" maxlength="100">
                        <a href="#" class="btn btn-mod btn-border-w btn-round">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Notify Me
                        </a>
                    </div>

                </div>
            </div>
            <!-- End Hero Content -->

            <!-- Scroll Down -->
            <div class="local-scroll">
                <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                        class="sr-only">Scroll to the next section</span></a>
            </div>
            <!-- End Scroll Down -->

        </div>
    </section>
@endsection
