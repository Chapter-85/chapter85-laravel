<section class="small-section bg-gray-lighter" style="display:none !Important">
    <div class="container relative">

        <form class="form align-center" id="mailchimp">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">

                    <div class="newsletter-label font-alt">
                        {{ __('home_page.Stay informed with our newsletter') }}
                    </div>

                    <div class="mb-20">
                        <input placeholder="{{ __('home_page.Enter your email') }}"
                            class="newsletter-field form-control input-md round mb-xs-10" type="email"
                            pattern=".{5,100}" required aria-required="true">

                        <button type="submit" aria-controls="subscribe-result"
                            class="btn btn-mod btn-medium btn-round mb-xs-10">
                            {{ __('home_page.Subscribe') }}
                        </button>
                    </div>

                    <div class="form-tip">
                        <i class="fa fa-info-circle"></i>
                        {{ __('home_page.Please trust us, we will never send you spam') }}
                    </div>

                    <div id="subscribe-result" role="region" aria-live="polite" aria-atomic="true"></div>

                </div>
            </div>
        </form>

    </div>
</section>
