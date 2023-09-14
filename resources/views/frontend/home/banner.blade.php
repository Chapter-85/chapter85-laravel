<section class="home-section home-section-banner bg-gray parallax-2 web-banner" id="home">
    <div class="js-height-full">

        <!-- Hero Content -->
        <div class="home-content container">
            <div class="home-text pt-450">

                <h1 class="hs-line-8 font-alt mb-30 mb-xs-30 text-white">{{ __('home_page.metals_industry') }}</h1>
                <h2 class="banner-heading hs-line-11 font-alt mb-50 mb-xs-30 text-white">
                    {{ __('home_page.precious_metals') }} </h2>

                <div class="local-scroll">
                    <a href="{{ route('contact_us') }}"
                        class="btn btn-mod btn-medium btn-round d-none d-sm-inline-block">{{ __('home_page.contact_us') }}</a>
                    <span class="d-none d-sm-inline-block">&nbsp;</span>
                    {{-- <a href="{{ route('shop') }}"
                        class="btn btn-mod btn-medium btn-round">{{ __('home_page.purchase') }}</a> --}}
                </div>

            </div>
        </div>
        <!-- End Hero Content -->

        <!-- Scroll Down -->
        <div class="local-scroll">
            <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                    class="sr-only">{{ 'home_page.scroll_to_the_next_section' }}</span></a>
        </div>
        <!-- End Scroll Down -->

    </div>

    <video class="bg-video" autoplay loop preload="metadata" >
    <source type="video/mp4" src="{{ asset('frontend/images/banners/bg-video.mp4') }}">
    </video>
    {{-- <video class="bg-video" role="presentation" crossorigin="anonymous" playsinline="" preload="auto" muted=""
        loop="" tabindex="-1" width="100%" height="100%" autoplay=""
        src="{{ asset('frontend/images/banners/bg-video.mp4') }}" style=""></video> --}}
    <!-- <img class="bg-video" src="{{ asset('frontend/images/banners/main_banner.jpg') }}" alt="">-->
    <div class="bg-back-layer"></div>
</section>


<section class="home-section bg-gray parallax-2 mobile-banner"
    data-background="{{ asset('frontend/images/mobile-banner.jpeg') }}"id="home">

    <div class="js-height-full">

        <!-- Hero Content -->
        <div class="home-content container">
            <div class="home-text">

                <h1 class="hs-line-8 font-alt mb-30 mb-xs-30 text-white">{{ __('home_page.metals_industry') }}</h1>
                <h2 class="banner-heading hs-line-11 font-alt mb-50 mb-xs-30 text-white">
                    {{ __('home_page.precious_metals') }} </h2>

                <div class="local-scroll">
                    <a href="{{ route('contact_us') }}"
                        class="btn btn-mod btn-medium btn-round d-sm-inline-block">{{ __('home_page.contact_us') }}</a>
                    <span class="d-none d-sm-inline-block">&nbsp;</span>
                    <a href="{{ route('shop') }}"
                        class="btn btn-mod btn-medium btn-round">{{ __('home_page.purchase') }}</a>
                </div>

            </div>
        </div>
        <!-- End Hero Content -->

        <!-- Scroll Down -->
        <div class="local-scroll">
            <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                    class="sr-only">{{ 'home_page.scroll_to_the_next_section' }}</span></a>
        </div>
        <!-- End Scroll Down -->
    </div>
</section>
