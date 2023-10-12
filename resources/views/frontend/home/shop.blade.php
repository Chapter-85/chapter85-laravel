<section class="page-section home-shop-web">
    <div class="container relative" style="min-height:540px !important">

        <h2 class="section-title font-alt align-left mt-50 mb-50 mb-sm-40">
            {{ __('home_page.BEST SELLERS') }}

            <a href="{{ route('shop') }}" class="section-more right">{{ __('home_page.Rental Shop') }} <i
                    class="fa fa-angle-right"></i></a>

        </h2>
        <div class="slider">
            <div id="carousel">
                <figure id="spinner">
                    <figure>
                        <img src="{{ asset('frontend/images/productImages/5-removebg-preview.png') }}" alt="">

                    </figure>
                    <figure>
                        <img src="{{ asset('frontend/images/productImages/4-removebg-preview.png') }}" alt="">

                    </figure>
                    <figure>
                        <img src="{{ asset('frontend/images/productImages/6-removebg-preview.png') }}" alt="">

                    </figure>
                    <figure>
                        <img src="{{ asset('frontend/images/productImages/7-removebg-preview.png') }}" alt="">

                    </figure>
                    <figure>
                        <img src="{{ asset('frontend/images/productImages/8-removebg-preview.png') }}" alt="">

                    </figure>

            </div>
            <span class="ss-icon left" onclick="galleryspin('-')">&lt;</span>
            <span class="ss-icon right" onclick="galleryspin('')">&gt;</span>
        </div>
        {{-- <div class="row multi-columns-row">

            @foreach ($products as $product)
                @include('frontend.products.product_section')
            @endforeach

        </div> --}}

    </div>
</section>
