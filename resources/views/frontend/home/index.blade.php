@extends('frontend.layouts.master')

@section('content')
    @include('frontend.home.banner')
    @include('frontend.home.best_sellers')
    <hr class="mt-0 mb-0" />

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
                        <div class="col-sm-6 col-lg-6 center-content pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home_page.call_us') }}
                                </div>
                                <div class="ci-text">
                                    (+92) 302 652 6000
                                </div>
                            </div>
                        </div>
                        <!-- End Phone -->

                        <!-- Address -->
                        {{-- <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
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
                        </div> --}}
                        <!-- End Address -->

                        <!-- Email -->
                        <div class="col-sm-6 col-lg-6 center-content pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    {{ __('home_page.Email') }}
                                </div>
                                <div class="ci-text">
                                    <a href="mailto:chapter85.pk@hotmail.com">chapter85.pk@hotmail.com</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Email -->

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection


@push('header_scripts')
@endpush

@push('frontend.layouts.footer_scripts')
    <script>
        $(document).ready(function() {
            $('.product-slider').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });
    </script>
@endpush
