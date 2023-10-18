  <section class="home-section home-section-banner bg-gray parallax-2 web-banner" id="home">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <div class="js-height-full">
                      <div class="home-content container">
                          <div class="home-text pt-450">
                              <h1 class="hs-line-8 font-alt mb-30 mb-xs-30 text-white">Chapter 85</h1>
                              <h2 class="banner-heading hs-line-11 font-alt mb-50 mb-xs-30 text-white">
                                  Where Comfort Meets Class </h2>
                              <div class="local-scroll">
                                  <a href="{{ route('contact_us') }}"
                                      class="btn btn-mod btn-medium btn-round d-none d-sm-inline-block">{{ __('home_page.contact_us') }}</a>
                                  <span class="d-none d-sm-inline-block">&nbsp;</span>
                              </div>
                          </div>
                      </div>
                      <div class="local-scroll">
                          <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                                  class="sr-only">{{ 'home_page.scroll_to_the_next_section' }}</span></a>
                      </div>
                  </div>
                  <img src="{{ asset('frontend/images/head.jpg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                  <div class="js-height-full">
                      <div class="home-content container">
                          <div class="home-text pt-450">
                              <h1 class="hs-line-8 font-alt mb-30 mb-xs-30 text-white">Chapter 85</h1>
                              <h2 class="banner-heading hs-line-11 font-alt mb-50 mb-xs-30 text-white">
                                  Where Comfort Meets Class </h2>
                              <div class="local-scroll">
                                  <a href="{{ route('contact_us') }}"
                                      class="btn btn-mod btn-medium btn-round d-none d-sm-inline-block">{{ __('home_page.contact_us') }}</a>
                                  <span class="d-none d-sm-inline-block">&nbsp;</span>
                              </div>
                          </div>
                      </div>
                      <div class="local-scroll">
                          <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                                  class="sr-only">{{ 'home_page.scroll_to_the_next_section' }}</span></a>
                      </div>
                  </div>
                  <img src="{{ asset('frontend/images/head.jpg') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                  <div class="js-height-full">
                      <div class="home-content container">
                          <div class="home-text pt-450">
                              <h1 class="hs-line-8 font-alt mb-30 mb-xs-30 text-white">Chapter 85</h1>
                              <h2 class="banner-heading hs-line-11 font-alt mb-50 mb-xs-30 text-white">
                                  Where Comfort Meets Class </h2>
                              <div class="local-scroll">
                                  <a href="{{ route('contact_us') }}"
                                      class="btn btn-mod btn-medium btn-round d-none d-sm-inline-block">{{ __('home_page.contact_us') }}</a>
                                  <span class="d-none d-sm-inline-block">&nbsp;</span>
                              </div>
                          </div>
                      </div>
                      <div class="local-scroll">
                          <a href="#services" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i><span
                                  class="sr-only">{{ 'home_page.scroll_to_the_next_section' }}</span></a>
                      </div>
                  </div>
                  <img src="{{ asset('frontend/images/head.jpg') }}" class="d-block w-100" alt="...">
              </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
  </section>


  <section class="home-section bg-gray parallax-2 mobile-banner"
      data-background="{{ asset('frontend/images/head.jpg') }}"id="home">
      <div class="js-height-full">
          <div class="home-content container">
              <div class="home-text">
                  <h1 class="hs-line-8 font-alt mb-30 mb-xs-30 text-white">Chapter 85</h1>
                  <h2 class="banner-heading hs-line-11 font-alt mb-50 mb-xs-30 text-white">
                      Where Comfort Meets Class </h2>
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
