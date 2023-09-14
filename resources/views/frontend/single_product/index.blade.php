@extends('frontend.layouts.master')

@section('content')
    @include('frontend.single_product.header')
    <div id="success_div" class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert"
        style="display: none">
        <i class="ri-notification-off-line label-icon"></i><strong>Success</strong>
        - <span id="succ_span"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div id="err_div" class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert"
        style="display: none">
        <i class="ri-error-warning-line label-icon"></i><strong>Error</strong>
        -<span id="err_span"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="page-section pt-5">
        <div class="container relative mt-2 product-card-container">

            <div class="row mb-60 mb-xs-30 product-card-main">

                <div class="col-md-4 mb-md-30">
                    <div class="post-prev-img">
                        <a href="{{ $product->product_picture_url }}" class="lightbox-gallery-3 mfp-image"><img
                                src="{{ $product->product_picture_url }}" alt="" /></a>

                    </div>
                </div>

                <div class="col-sm-12 col-md-8 mb-xs-20">
                    @if (Config::get('app.locale') == 'en')
                        <h3 class="mt-0">{{ $product->name }} </h3>
                    @elseif (Config::get('app.locale') == 'ch')
                        <h3 class="mt-0">{{ $product->name_t_ch }}</h3>
                    @else
                        <h3 class="mt-0">{{ $product->name_s_ch }}</h3>
                    @endif


                    @if ($product->productsQuantity() != null)
                        <div class="intro-label">
                            <span class="badge badge-primary bg-green">In Stock</span>
                        </div>
                    @else
                        <div class="intro-label">
                            <span class="badge badge-danger bg-red">NOT AVAILABLE</span>
                        </div>
                    @endif

                    <p class="mt-0">
                        @if (Config::get('app.locale') == 'en')
                            {{ $product->description }}
                        @elseif (Config::get('app.locale') == 'ch')
                            {{ $product->description_t_ch }}
                        @else
                            {{ $product->description_s_ch }}
                        @endif
                    </p>



                    @if (\Auth::user())
                        <hr class="mt-0 mb-30" />
                        <div class="row">
                            <div class="col-6 lead mt-0 mb-20">
                                <strong>{{ $product->getProductPrice() }}</strong>
                            </div>
                        </div>
                    @endif


                    <!-- <div class="section-text mb-30">
                        @if (Config::get('app.locale') == 'en')
                            {{ $product->description }}
                        @elseif (Config::get('app.locale') == 'ch')
                            {{ $product->description_t_ch }}
                        @else
                            {{ $product->description_s_ch }}
                        @endif

                    </div> -->

                    <div class="section-text small">
                        <div>SKU: {{ $product->sku }}</div>
                        <div>{{ __('home_page.Category') }}:
                            @if (Config::get('app.locale') == 'en')
                                <a href="{{ route('shop', ['category' => $product->category->id]) }}">
                                    {{ $product->category->name }}</a>
                            @elseif (Config::get('app.locale') == 'ch')
                                <a href="{{ route('shop', ['category' => $product->category->id]) }}">
                                    {{ $product->category->name_t_ch }}</a>
                            @else
                                <a href="{{ route('shop', ['category' => $product->category->id]) }}">
                                    {{ $product->category->name_s_ch }}</a>
                            @endif

                        </div>
                        <div>
                            {{ __('home_page.Manufacturer') }}:
                            @if (Config::get('app.locale') == 'en')
                                {{ $product->manufacturer->name }}
                            @elseif (Config::get('app.locale') == 'ch')
                                {{ $product->manufacturer->name_t_ch }}
                            @else
                                {{ $product->manufacturer->name_s_ch }}
                            @endif
                        </div>
                    </div>


                    <div class="mb-30 mt-20 btns">

                        @if (\Auth::user() && \Auth::user()->is_verified == 1)
                            <hr class="mt-0 mb-30" />
                            <form method="post" action="{{ route('shop-cart.store') }}" class="form"
                                id="shor_cart_form">
                                {{-- <form method="post" action="{{ route('customer-products.store') }}" class="form"> --}}
                                @csrf
                                <input name="quantity" id="quantity" type="number" class="input-lg round" min="1"
                                    max="5" value="1" />
                                <input type="text" id="user_id" value="{{ \Auth::user()->id }}" name="user_id" hidden>
                                <input type="text" id="product_id" value="{{ $product->id }}" name="product_id" hidden>
                                <input type="text" id="status" value="pending" name="status" hidden>
                                <input type="text" id="spot_price"
                                    value="{{ $product->getProductPrice($type = 'number') }}" name="spot_price" hidden>
                                <input type="text" id="referral_code" value="{{ \Auth::user()->referred_by }}"
                                    name="referral_code" hidden>
                                @if ($product->pricing_type == 'use_feed')
                                    <button
                                        class="btn btn-mod btn-large btn-round use_feed_btn">{{ __('home_page.ad_to_cart') }}</button>
                                @else
                                    <button type="submit"
                                        class="btn btn-mod btn-large btn-round">{{ __('home_page.ad_to_cart') }}</button>
                                @endif

                                @else
                            <a href="{{ route('customer_login') }}"
                                class="  btn btn-mod btn-large btn-round">{{ __('home_page.buy_now') }}</a>
                        @endif
                        <a href="{{ route('shop') }}" class=" btn btn-mod btn-large btn-round"
                            style="background:rgb(234 163 0) !important;color:#333 !important;margin-left:15px; margin-top:10px">{{ __('home_page.cont_shop') }}</a>
                            </form>

                            {{-- <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                                class="btn btn-mod btn-large btn-round">Buy
                                Now</button> --}}
                        
                    </div>



                </div>
            </div>


            <!-- End Tab panes -->
        </div>
    </section>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="panel-title">
                        Item Added to Cart
                    </h3>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                    <img src="{{ $product->product_picture_url }}" alt="" style="height: 145px"
                                        class="img-fluid d-block">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-0"><span class="fw-medium">{{ $product->name }}</span>
                                    </p>
                                    <p class="text-muted mb-0">SKU: <span class="fw-medium">{{ $product->sku }}</span>
                                    </p>
                                    <p class="text-muted mb-0">{{ __('home_page.Category') }}: <span
                                            class="fw-medium">{{ $product->category->name }}</span>
                                    </p>
                                    <p class="text-muted mb-0">Manufacturer: <span
                                            class="fw-medium">{{ $product->manufacturer->name }}</span>
                                    </p>
                                    <p class="text-muted mb-0">Spot Price: <span
                                            class="fw-medium">{{ $product->getProductPrice() }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('shop') }}" type="button" class="btn btn-mod btn-gray btn-round">Continue
                        shopping</a>
                    <a href="{{ route('shop-cart.index') }}" type="button" class="btn btn-mod btn-round">Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('frontend.layouts.footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.use_feed_btn').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Alert",
                    timer: 5000,
                    text: "This product is for VIP members, Please contact MG Admin at account@mgmetals.com.hk",
                    icon: "warning",
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
                    confirmButtonText: "Okay",
                    buttonsStyling: false,
                }).then(function(response) {
                    // window.location = resp.url;
                })
            })
            $('#shor_cart_form').on('submit', function(e) {
                e.preventDefault();
                var now = moment().toString();
                console.log(now);

                let spot_price = $('#spot_price').val();
                let status = $('#status').val();
                let product_id = $('#product_id').val();
                let user_id = $('#user_id').val();
                let quantity = $('#quantity').val();
                let referral_code = $('#referral_code').val();
                const url = $('#shor_cart_form').attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        spot_price: spot_price,
                        status: status,
                        product_id: product_id,
                        user_id: user_id,
                        quantity: quantity,
                        referral_code: referral_code,
                        created_at: now
                    },
                    success: function(response) {
                        // alert('hello')
                        console.log(response.error);
                        if (response.success) {
                            // document.getElementById('total_price_usd').style.display = "none";
                            document.getElementById('success_div').style.display = "block";
                            document.getElementById('err_div').style.display = "none";
                            $('#succ_span').text(response.success);
                            $("#shor_cart_form")[0].reset();
                            $('#exampleModalCenter').modal('show')
                            $('#shop_cart_count').html(response.cart_count)
                            // window.location.reload();
                        }
                        if (response.error) {
                            document.getElementById('err_div').style.display = "block";
                            document.getElementById('success_div').style.display = "none";
                            $('#err_span').text(response.error);
                            $("#shor_cart_form")[0].reset();
                        }
                    },
                    error: function(error) {
                        console.log(error)
                        // $('#err_div').text(response.success);
                    }
                });
            });


            $('#modal_close').on('click', function(e) {
                e.preventDefault()
                $('#exampleModalCenter').modal('hide')
            })
        });
    </script>
@endpush
