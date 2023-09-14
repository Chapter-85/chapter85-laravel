@extends('frontend.layouts.master')

@section('content')
    @include('frontend.services.header')

    <section class="page-section">
        <div class="container relative">
            <div class="row section-text mt-40 mb-30">
                <div class="col-12 col-md-4 pr-0 quote">
                    <h3 class="playfare bold dark-light" style="font-size: 26px;line-height: 1.88em;">
                        {{ __('home_page.service_para_1') }}</h3>
                    <p style="letter-spacing:0.1em;">{{ __('home_page.Warren Buffett') }}</p>
                </div>
                <div class="col-12 col-md-4">
                    <p>{{ __('home_page.service_col_1') }}</p>
                </div>
                <div class="col-12 col-md-4">
                    <p>{{ __('home_page.service_col_2') }} </p>
                </div>
            </div>
            <div class="row mt-30 mb-30">
                <div class="col-md-12">
                    <ul role="tablist" class="nav nav-tabs tpl-alt-tabs font-alt pt-30 pt-sm-0 pb-30 pb-sm-0">
                        <li>
                            <a href="#service-branding" class="nav-link active" data-bs-toggle="tab" role="tab"
                                aria-selected="true">

                                <div class="alt-tabs-icon">

                                    <img src="{{ asset('frontend/images/icons/phy-gold.png') }}" alt="image">
                                </div>

                                <div class="dark mb-3  mh-90"> {{ __('home_page.service_title_1') }}</div>
                                <p class="text-p font-alt">
                                    {{ __('home_page.service_desc_02') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="#service-web-design" class="nav-link" data-bs-toggle="tab" role="tab"
                                aria-selected="false">

                                <div class="alt-tabs-icon">

                                    <img src="{{ asset('frontend/images/icons/casting.png') }}" alt="image">
                                </div>

                                <div class="dark mb-3  mh-90"> {{ __('home_page.service_title_2') }}</div>
                                <p class="text-p font-alt"> {{ __('home_page.service_desc_13') }} </p>
                            </a>
                        </li>
                        <li>
                            <a href="#service-graphic" class="nav-link" data-bs-toggle="tab" role="tab"
                                aria-selected="false">

                                <div class="alt-tabs-icon">

                                    <img src="{{ asset('frontend/images/icons/ex-sol.png') }}" alt="image">
                                </div>

                                <div class="dark mb-3  mh-90"> {{ __('home_page.service_title_4') }}</div>
                                <p class="text-p font-alt">{{ __('home_page.service_desc_22') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="#service-development" class="nav-link" data-bs-toggle="tab" role="tab"
                                aria-selected="false">

                                <div class="alt-tabs-icon">
                                    <img src="{{ asset('frontend/images/icons/network.png') }}" alt="image">
                                </div>

                                <div class="dark mb-3 mh-90"> {{ __('home_page.service_title_3') }}</div>
                                <p class="text-p font-alt">{{ __('home_page.service_desc_32') }}</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section class="page-section pt-0 pb-0 banner-section bg-dark "
        data-background="{{ asset('frontend/images/service-bg-2.png') }}">
        <div class="container relative">

            <div class="row interested-in ">
                <div class="col-12 col-md-6 align-self-center p-0">
                    {{-- <h2 class="font-alt text-center"
                        style="transform: translate(-30px, 70px);;color: #DCA674;font-weight:bold;font-size:38px">MG Metals
                    </h2> --}}
                </div>
                <div class="col-12 col-md-6 align-self-center p-0">

                    <div class="">
                        <div class="banner-content text-center">
                            <h3 class="banner-heading font-alt bold playfare dark">
                                {{ __('home_page.INTERESTED IN ANY OF OUR MEMBER SERVICES?') }}</h3>
                            <div class="banner-decription dark text-center">
                                {{ __('home_page.INTERESTED IN ANY OF OUR MEMBER SERVICES?') }}
                                {{ __('home_page.sign_up_or_login') }}</div>
                            <div class="local-scroll">
                                <a href="{{ route('customer_login') }}" class="btn btn-mod btn-w btn-medium btn-round"
                                    style="background:#959595">{{ __('home_page.signup_login') }}</a>
                                <a href="{{ route('contact_us') }}" class="btn btn-mod btn-w btn-medium btn-round"
                                    style="background:#959595">{{ __('home_page.contact_us') }}</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection
