@extends('frontend.layouts.master')

@section('content')
    @include('frontend.home.banner')

    @include('frontend.home.shop')

    <hr class="mt-0 mb-0" />
    @include('frontend.home.about')
    <hr class="mt-0 mb-0" />

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
