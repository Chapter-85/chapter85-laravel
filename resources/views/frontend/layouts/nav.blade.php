<nav class="main-nav js-stick">
    <div class="full-wrapper relative clearfix">
        <!-- Logo ( * your text or image into link tag *) -->
        <div class="nav-logo-wrap local-scroll">
            <a href="{{ route('home') }}" class="logo">
                <img class="gold" src="{{ asset('frontend/images/logo-black.png') }}" alt="" />
                <img class="white" src="{{ asset('frontend/images/logo-c-white.png') }}" alt="" />
            </a>
        </div>
        <div class="mobile-nav" role="button" tabindex="0">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Menu</span>
        </div>

        <!-- Main Menu -->
        <div class="inner-nav desktop-nav">
            <ul class="clearlist">

                <!-- Item With Sub -->
                <li>
                    <a href="{{ route('home') }}" role="button" class="">{{ __('home_page.home') }}</i></a>
                </li>
                <li>
                    <a href="{{ route('about_us') }}" class="">{{ __('home_page.about_us') }}</i></a>
                </li>
                <li>
                    <a href="{{ route('shop') }}" class="">{{ __('home_page.Rental Shop') }}</i></a>
                </li>
                <li>
                    <a href="{{ route('contact_us') }}" class="">{{ __('home_page.contact_us') }}</i></a>
                </li>
                @if (\Auth::user())
                    <li>
                        <a href="#"
                            class="mn-has-sub">{{ isset(\Auth::user()->customer->full_name) ? \Auth::user()->customer->full_name : \Auth::user()->name }}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="mn-sub">
                            <li><a href="{{ route('customer_profile') . '?tab=individual' }}"
                                    class="text-center">{{ __('home_page.profile') }}</a></li>
                            <li>
                            <li><a href="{{ route('customer-orders') }}"
                                    class="text-center">{{ __('home_page.my_orders') }}</a></li>

                            @if (\Auth::user()->hasRole('admin'))
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="text-center">{{ __('home_page.admin_panel') }}</i></a>
                                </li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class=""
                                        onclick="event.preventDefault(); this.closest('form').submit();">{{ __('home_page.logout') }}</i></a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ route('customer_login') }}" class="">
                            <img src="{{ asset('frontend/images/user-avatar.png') }}" class="avatar" alt="">
                            {{ __('home_page.login') }}</i></a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('shop-cart.index') }}"><i class="fa fa-shopping-cart"></i>
                        Cart (<span
                            id="shop_cart_count">{{ \Auth::user() ? \Auth::user()->cart_count : $cart_count }}</span>)
                    </a>
                </li>

            </ul>
        </div>
        <!-- End Main Menu -->

        </ul>
    </div>
    <!-- End Main Menu -->

    </div>
</nav>
