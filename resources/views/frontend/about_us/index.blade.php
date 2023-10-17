@extends('frontend.layouts.master')

@section('content')
    @include('frontend.about_us.header')

    <section class="page-section" id="about">
        <div class="container relative">
            <h2 class="section-title font-alt mb-50 mt-40 mb-sm-40">About Chapter 85</h2>
            <div class="section-text mb-60 mb-sm-40">
                <div class="row">
                    <div class="col-sm-6 pr-md-5">
                        <p style="color:#254345">At Chapter 85, we are more than just leather craftsmen; we are passionate
                            artisans dedicated to the art of transforming the finest leathers into exquisite, handcrafted
                            products.</p>
                    </div>
                    <div class="col-sm-6 pl-md-5">
                        <p style="color:#254345">{{ __('about_us.para_04') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container relative mt-40">
            <h2 class="section-title font-alt mb-50 mt-50 mb-sm-40">A Legacy of Craftsmanship</h2>
            <div class="section-text mb-50 mt-40 mb-sm-40">
                <div class="row">
                    <div class="col-sm-12 pr-md-5">
                        <p style="color:#254345">For over 30 years, we have been weaving a legacy of craftsmanship. Our
                            journey began with a vision to create leather goods that not only stand the test of time but
                            also exude timeless elegance.</p>
                        <p style="color:#254345"> With every stitch, cut, and burnish, we pour our hearts and souls into
                            crafting leather products that tell a story of tradition, precision, and love for what we do.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container relative mt-40">
            <div class="section-text mb-60 mb-sm-40">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="section-title font-alt mb-50 mt-30 ">Unrivaled Quality and Style</h2>
                    </div>
                    <div class="col-sm-6 pr-md-5">

                        <p style="color:#254345">Our extensive range of leather products, including shoes, wallets, and
                            belts, are a testament to our unwavering commitment to quality and style.</p>
                        <p style="color:#254345">We meticulously select the finest leathers and materials to ensure that
                            every piece we create is a work of art</p>
                        <p style="color:#254345">Each product embodies the essence of sophistication and showcases the
                            uniqueness of genuine leather.
                        </p>
                    </div>
                    <div class="col-sm-6 pl-md-5">

                        <div class="d-flex">
                            <img src="{{ asset('frontend/images/milestone.png') }}" style="height: 26px;margin-right: 15px;"
                                alt="logo">
                            <p style="color:#254345">{{ __('about_us.para_4') }}</p>
                        </div>
                        <div class="d-flex">
                            <img src="{{ asset('frontend/images/milestone.png') }}" style="height: 26px;margin-right: 15px;"
                                alt="logo">
                            <p style="color:#254345">{{ __('about_us.para_5') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
