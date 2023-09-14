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
                        <img src="https://static.wixstatic.com/media/942665_92e06b31325242d3bf7e64c956477ed5~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_92e06b31325242d3bf7e64c956477ed5~mv2.png"
                            alt="">

                    </figure>
                    <figure>
                        <img src="https://static.wixstatic.com/media/942665_597ed5891a5a42a0921e7e65a586ba9a~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_597ed5891a5a42a0921e7e65a586ba9a~mv2.png"
                            alt="">

                    </figure>
                    <figure>
                        <img src="https://static.wixstatic.com/media/942665_9af3ae93941848c0b0313659d8386002~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_9af3ae93941848c0b0313659d8386002~mv2.png"
                            alt="">

                    </figure>
                    <figure>
                        <img src="https://static.wixstatic.com/media/942665_754ec09e17da4c5dbb9cead593cbff70~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_754ec09e17da4c5dbb9cead593cbff70~mv2.png"
                            alt="">

                    </figure>
                    <figure>
                        <img src="https://static.wixstatic.com/media/942665_880c29284c0e4612a82ddd27f838b703~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_880c29284c0e4612a82ddd27f838b703~mv2.png"
                            alt="">

                    </figure>
                    <!-- <figure>
                <img src="https://static.wixstatic.com/media/942665_4c4369947bde4d4bae4c03f2d7016f5e~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_4c4369947bde4d4bae4c03f2d7016f5e~mv2.png" alt="">

                </figure>
                <figure>
                    <img src="https://static.wixstatic.com/media/942665_0df93f07b4c64809854f38f33b5ab6d0~mv2.png/v1/fill/w_506,h_314,al_c,q_80,usm_0.66_1.00_0.01/942665_0df93f07b4c64809854f38f33b5ab6d0~mv2.png" alt="">

                </figure> -->
            </div>
            <span class="ss-icon left" onclick="galleryspin('-')">&lt;</span>
            <span class="ss-icon right" onclick="galleryspin('')">&gt;</span>
        </div>
        <div class="row multi-columns-row" style="display:none">

            @forelse ($products as $product)
                @include('frontend.products.product_section')
            @empty
                <div class="alert alert-dark" role="alert"> {{ __('home_page.No_products_Found') }}</div>
            @endforelse

        </div>

    </div>
</section>
