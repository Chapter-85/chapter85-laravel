@extends('frontend.layouts.master')

@section('content')
    @include('frontend.ez_gold.header')

    <section class="page-section pad-100">
        <div class="container relative ez-gold">

            <div class="row">

                <div class="col-md-7 align-self-center  mb-sm-40">

                    <!-- About Project -->
                    <div class="text">

                        <h3 class="font-alt mb-10 mb-xxs-10 playfare gold">
                            {!! __('ez_gold.h1_01') !!}</h3>
                        <p class="dark font-17"> {{ __('ez_gold.p_01') }} <br> {{ __('ez_gold.p_02') }}
                        </p>

                        <div class="mt-40 apps">
                            <a href="https://qrco.de/bcakU6" target="_blank">
                                <img src="{{ asset('frontend/images/app-store.png') }}" class="mr-0"
                                    style="width:150px;margin-right:30px" alt="logo">
                            </a>
                            <a href="https://qrco.de/bcakU6" target="_blank">
                                <img src="{{ asset('frontend/images/play-store.png') }}" class="mr-0" style="width:150px"
                                    alt="logo">
                            </a>
                        </div>

                    </div>
                    <!-- End About Project -->

                </div>

                <div class="col-md-5">

                    <!-- Work Gallery -->
                    <div class="work-full-media mt-0 white-shadow">
                        <ul class="clearlist work-full-slider owl-carousel mobile-app">
                            <li>
                                <img class="lazyOwl" src="{{ asset('/frontend/images/apppic1.png') }}"
                                    data-src="{{ asset('frontend/images/apppic1.png') }}" alt="" />
                            </li>
                            <li>
                                <img class="lazyOwl" src="{{ asset('frontend/images/apppic2.png') }}"
                                    data-src="{{ asset('frontend/images/apppic2.png') }}" alt="" />
                            </li>
                            <li>
                                <img class="lazyOwl" src="{{ asset('frontend/images/apppic3.png') }}"
                                    data-src="{{ asset('frontend/images/apppic3.png') }}" alt="" />
                            </li>
                        </ul>
                    </div>
                    <!-- End Work Gallery -->

                </div>

            </div>

        </div>
    </section>

    {{-- <hr class="mt-0 mb-0" /> --}}

    <section class="page-section pad-100 why-section" data-background="{{ asset('frontend/images/why-banner.png') }}">
        <div class="container relative">

            <h2 style=""
                class="section-title heading-two  normal font-alt playfare dark mb-10  capitalize ls-none text-center">
                {{ __('ez_gold.h1_03') }}<br>
                <span style="font-size:24px;">{{ __('ez_gold.h1_04') }}</span>
            </h2>

            <!-- Features Grid -->
            <div class="row multi-columns-row alt-features-grid mt-3">


                <!-- Features Item -->
                <div class="col-sm-6 col-md-3">
                    <div class="alt-features-item align-center">
                        <h3 class="alt-features-title font-alt playfare">{{ __('ez_gold.h1_05') }}</h3>
                        <div class="alt-features-descr align-left bg-light">
                            {{ __('ez_gold.p_03') }}
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->
                <!-- Features Item -->
                <div class="col-sm-6 col-md-3">
                    <div class="alt-features-item align-center">
                        <h3 class="alt-features-title font-alt playfare">{{ __('ez_gold.h1_06') }}</h3>
                        <div class="alt-features-descr align-left bg-light">
                            {{ __('ez_gold.p_04') }}
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->
                <!-- Features Item -->
                <div class="col-sm-6 col-md-3">
                    <div class="alt-features-item align-center">
                        <h3 class="alt-features-title font-alt playfare">{{ __('ez_gold.h1_07') }}</h3>
                        <div class="alt-features-descr align-left bg-light">
                            {{ __('ez_gold.p_05') }}
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->
                <!-- Features Item -->
                <div class="col-sm-6 col-md-3">
                    <div class="alt-features-item align-center">
                        <h3 class="alt-features-title font-alt playfare">{{ __('ez_gold.h1_08') }}</h3>
                        <div class="alt-features-descr align-left bg-light">
                            {{ __('ez_gold.p_06') }}
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->
            </div>
            <!-- End Features Grid -->

        </div>
    </section>

    {{-- <hr class="mt-0 mb-0" /> --}}

    <section class="page-section pad-100 scan-info">
        <div class="container relative">
            <div class="container relative">

                <div class="row">

                    <div class="col-md-6 align-self-center col-12">

                        <img src="{{ asset('frontend/images/person-withapp.png') }}" alt="" />

                    </div>

                    <div class="col-md-6 align-self-center">

                        <div class="row m-0">

                            <div class="col-md-12 text-center">
                                <h2 class="playfare dark bold" style="font-size:30px; line-height:normal;">
                                    <span>{{ __('ez_gold.h1_09') }}</span>
                                </h2>
                                <img src="{{ asset('frontend/images/download-scan.png') }}" alt="" />
                                <h3 class="playfare dark" style="font-size:22px;margin-top:10px;">{{ __('ez_gold.h1_10') }}
                                </h3>
                            </div>
                            <div class="col-md-4 col-12 text-center mt-3">
                                <img src="{{ asset('frontend/images/whatsapp-scan.png') }}" class="app-scan"
                                    alt="" />
                                <h3 class="playfare gold" style="font-size:16px;">{{ __('ez_gold.h1_11') }} </h3>
                            </div>
                            <div class="col-md-4 col-12 text-center mt-3">
                                <img src="{{ asset('frontend/images/wechat-scan.png') }}" class="app-scan"
                                    alt="" />
                                <h3 class="playfare gold" style="font-size:16px;">{{ __('ez_gold.h1_12') }}</h3>
                            </div>
                            <div class="col-md-4 col-12 text-center mt-3">
                                <img src="{{ asset('frontend/images/line-scan.png') }}" class="app-scan" alt="" />
                                <h3 class="playfare gold" style="font-size:16px;">{{ __('ez_gold.h1_13') }}</h3>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
@endpush
