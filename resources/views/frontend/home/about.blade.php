<section class="page-section" id="about">
    <div class="container relative">
        <h2 class="section-title font-alt align-left mb-50 mt-40 mb-sm-40">
            {{ __('home_page.ABOUT_COMPANY') }}
            <a target="_blank" href="{{ route('about_us') }}" class="section-more right">
                {{ __('home_page.more_about_us') }} <i class="fa fa-angle-right"></i>
            </a>
        </h2>
        <div class="section-text">
            <div class="row">
                <div class="col-md-2 col-12"></div>
                <div class="col-md-5 col-12">
                    <p>
                        {{ __('home_page.home_about_col_1') }}
                    </p>
                </div>
                <div class="col-md-5 col-12">
                    <p>
                        {{ __('home_page.home_about_col_2') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
