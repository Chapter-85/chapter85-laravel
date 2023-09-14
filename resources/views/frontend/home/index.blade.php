@extends('frontend.layouts.master')

@section('content')
    @include('frontend.home.banner')

    @include('frontend.home.about')

    <hr class="mt-0 mb-0 " />

    @include('frontend.home.services')


    <section class="page-section pt-0 pb-0 banner-section bg-dark "
        data-background="{{ asset('frontend/images/banners/banner.jpg') }}">
        <div class="container relative">

            <div class="row interested-in ">

                <div class="col-12 col-md-8 align-self-center p-0">

                    <div class="">
                        <div class="banner-content text-center">
                            <h3 class="banner-heading font-alt bold playfare">
                                {{ __('home_page.INTERESTED IN ANY OF OUR MEMBER SERVICES?') }}</h3>
                            <div class="banner-decription">{{ __('home_page.sign_up_or_login') }}</div>
                            <div class="local-scroll">
                                <a href="{{ route('customer_login') }}"
                                    class="btn btn-mod btn-w btn-medium btn-round">{{ __('home_page.signup_login') }}</a>
                                <a href="{{ route('contact_us') }}"
                                    class="btn btn-mod btn-w btn-medium btn-round">{{ __('home_page.contact_us') }}</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-4 align-self-center">
                    <div class="card card-default">
                        <div class="card-body">
                            <h3 class="playfare mb-4">{{ __('home_page.discover_ez') }}</h3>

                            <p>{{ __('home_page.invest_smartly') }} </p>
                            <a href="{{ route('contact_us') }}"
                                class="btn btn-mod btn-w btn-medium btn-round">{{ __('home_page.learn_more') }}</a>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="page-section">
        <div class="container relative">
            <h2 class="section-title font-alt mb-80 mt-50 mt-sm-40 mb-sm-50">{{ __('home_page.why_choose_us') }}</h2>
            <div class="row alt-features-grid mb-50">

                <div class="col-md-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-descr align-left">
                            <div class="alt-tabs-icon">

                                <img src="{{ asset('frontend/images/icons/credential.png') }}"
                                    style="width:80px;height:auto;" alt="image" class="icon">
                            </div>
                            <h4 class="heading mt-20 mb-30">{{ __('home_page.CREDENTIAL') }}</h4>
                            <p style="color:#000;font-weight:normal;line-height:30px;font-size:16px;">
                                {{ __('home_page.choose_us_1') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-descr align-left">
                            <div class="alt-tabs-icon">

                                <img src="{{ asset('frontend/images/icons/sustain.png') }}" style="width:80px;height:auto;"
                                    alt="image" class="icon">
                            </div>
                            <h4 class="heading mt-20 mb-30">{{ __('home_page.SUSTAINABILITY') }}</h4>
                            <p style="color:#000;font-weight:normal;line-height:30px;font-size:16px;">
                                {{ __('home_page.choose_us_2') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-descr align-left">
                            <div class="alt-tabs-icon">

                                <img src="{{ asset('frontend/images/icons/credibility.png') }}"
                                    style="width:80px;height:auto;" alt="image" class="icon">
                            </div>
                            <h4 class="heading mt-20 mb-30">{{ __('home_page.CREDIBILITY') }}</h4>
                            <p style="color:#000;font-weight:normal;line-height:30px;font-size:16px;">
                                {{ __('home_page.choose_us_3') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <hr class="mt-0 mb-0" />
    @include('frontend.home.testimonials')
    @include('frontend.home.shop')
    <hr class="mt-0 mb-0" />

    @include('frontend.home.newsletter')


    <section class="page-section contact-footer" id="contact" style="padding:50px 0px ">
        <div class="container relative">

            <h2 class="section-title font-alt mt-50 mb-50 mb-sm-40">
                {{ __('home_page.Find us') }}
            </h2>

            <div class="row">

                <div class="col-lg-12 offset-lg-0 col-xl-10 offset-xl-1">
                    <div class="row">

                        <!-- Phone -->
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home_page.call_us') }}
                                </div>
                                <div class="ci-text">
                                    (852) 3998 4916
                                </div>
                            </div>
                        </div>
                        <!-- End Phone -->

                        <!-- Address -->
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home_page.Address') }}
                                </div>
                                <div class="ci-text">
                                    {{ __('home_page.Unit F, 18F, MG Tower, 133 Hoi Bun Road, Kwun Tong, Kowloon, Hong Kong') }}
                                </div>
                            </div>
                        </div>
                        <!-- End Address -->

                        <!-- Email -->
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home_page.Email') }}
                                </div>
                                <div class="ci-text">
                                    <a href="mailto:account@mgmetals.com.hk">account@mgmetals.com.hk</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Email -->

                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- <section class="small-section bg-dark">
        <div class="container relative">

            <div class="align-center">
                <h3 class="banner-heading font-alt">Want to discuss your new project?</h3>
                <div>
                    <a href="#" class="btn btn-mod btn-w btn-medium btn-round">Lets tallk</a>
                </div>
            </div>

        </div>
    </section> --}}
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
@endpush
