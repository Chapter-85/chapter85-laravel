<section class="page-section" id="services">
    <div class="container relative">

        <h2 class="section-title font-alt mb-50 mb-sm-40">{{ __('home_page.service') }}</h2>

        <!-- Nav tabs -->
        <ul role="tablist" class="nav nav-tabs tpl-alt-tabs font-alt pt-30 pt-sm-0 pb-30 pb-sm-0">
            <li>
                <a href="#service-branding" class="nav-link active" data-bs-toggle="tab" role="tab"
                    aria-selected="true">

                    <div class="alt-tabs-icon">

                        <img src="{{ asset('frontend/images/icons/phy-gold.png') }}" alt="image" class="icon">
                        <img src="{{ asset('frontend/images/icons/phy-gold-h.png') }}" alt="image"
                            class="icon hover">
                    </div>
                    <div class="title">
                        {{ __('home_page.service_title_1') }}
                    </div>
                </a>
            </li>
            <li>
                <a href="#service-web-design" class="nav-link" data-bs-toggle="tab" role="tab"
                    aria-selected="false">

                    <div class="alt-tabs-icon">

                        <img src="{{ asset('frontend/images/icons/casting.png') }}" alt="image" class="icon">
                        <img src="{{ asset('frontend/images/icons/casting-h.png') }}" alt="image" class="icon hover">
                    </div>

                    <div class="title">
                        {{ __('home_page.service_title_2') }}
                    </div>
                </a>
            </li>
            <li>
                <a href="#service-graphic" class="nav-link" data-bs-toggle="tab" role="tab" aria-selected="false">

                    <div class="alt-tabs-icon">

                        <img src="{{ asset('frontend/images/icons/ex-sol.png') }}" alt="image" class="icon">
                        <img src="{{ asset('frontend/images/icons/ex-sol-h.png') }}" alt="image" class="icon hover">
                    </div>

                    <div class="title">
                        {{ __('home_page.service_title_4') }}
                    </div>
                </a>
            </li>
            <li>
                <a href="#service-development" class="nav-link" data-bs-toggle="tab" role="tab"
                    aria-selected="false">

                    <div class="alt-tabs-icon">
                        <img src="{{ asset('frontend/images/icons/network.png') }}" alt="image" class="icon">
                        <img src="{{ asset('frontend/images/icons/network-h.png') }}" alt="image"
                            class="icon hover">
                    </div>

                    <div class="title">
                        {{ __('home_page.service_title_3') }}
                    </div>
                </a>
            </li>

        </ul>
        <!-- End Nav tabs -->
        <div class="row section-text mb-md-30 mb-sm-10">
            <div class="col-12 col-md-4 pr-0 quote">
                <h3 class="playfare bold dark-light " style="font-size: 26px;line-height: 1.88em;">
                    {{ __('home_page.service_para_1') }}</h3>
                <p style="letter-spacing:0.1em;">{{ __('home_page.Warren Buffett') }}</p>
            </div>
            <div class="col-12 col-md-4">
                <p>{{ __('home_page.service_col_1') }} </p>
            </div>
            <div class="col-12 col-md-4">
                <p>{{ __('home_page.service_col_2') }} </p>
            </div>
        </div>

        <!-- Tab panes -->
        <div class="tab-content tpl-tabs-cont" style="display:none">

            <!-- Service Item -->
            <div role="tabpanel" class="tab-pane fade show active" id="service-branding">
                <div class="section-text">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-sm-50 mb-xs-30 text-center">
                            {{ __('home_page.service_desc_01') }}
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="service-web-design">

                <div class="section-text">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-sm-50 mb-xs-30 text-center">
                            {{ __('home_page.service_desc_11') }}
                        </div>


                    </div>
                </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="service-graphic">

                <div class="section-text">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-sm-50 mb-xs-30 text-center">
                            {{ __('home_page.service_desc_21') }}
                        </div>
                    </div>
                </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="service-development">

                <div class="section-text">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mb-sm-50 mb-xs-30 text-center">
                            {{ __('home_page.service_desc_31') }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- End Tab panes -->

        <div class="align-center mb-md-40 mb-sm-20">
            <a href="{{ route('services') }}"
                class="section-more font-alt playfare">{{ __('home_page.VIEW ALL SERVICES') }}
                <i class="fa fa-angle-right"></i></a>
        </div>

    </div>
</section>
