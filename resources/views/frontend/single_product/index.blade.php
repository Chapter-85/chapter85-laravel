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

                <div class="col-md-6 mb-md-30">
                    <div class="slider-for">
                        @forelse ($product->product_images as $image)
                            <div><img src="{{ $image->product_picture_url }}" alt="Image 1"></div>
                        @empty
                            <div class="post-prev-img">
                                <a href="{{ $product->product_picture_url }}" class="lightbox-gallery-3 mfp-image"><img
                                        src="{{ $product->product_picture_url }}" alt="" /></a>
                            </div>
                        @endforelse

                    </div>
                    <div class="slider-nav mt-10">
                        @forelse ($product->product_images as $image)
                            <div><img src="{{ $image->product_picture_url }}" alt="Thumbnail 1"></div>
                        @empty
                            <div class="post-prev-img">
                                <a href="{{ $product->product_picture_url }}" class="lightbox-gallery-3 mfp-image"><img
                                        src="{{ $product->product_picture_url }}" alt="" /></a>
                            </div>
                        @endforelse

                    </div>
                </div>

                <div class="col-sm-12 col-md-6 mb-xs-20">
                    <h3 class="mt-0 mb-10">{{ $product->name }} </h3>
                    <div class="section-text small">
                        <div>SKU: {{ $product->sku }}</div>
                        <div>{{ __('home_page.Category') }}:
                            <a href="{{ route('shop', ['category' => $product->category->id]) }}">
                                {{ $product->category->name }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 lead mt-10 mb-20">
                            <strong>{{ $product->getProductPrice() }}</strong>
                        </div>
                    </div>
                    @if ($product->productsQuantity() != null)
                        <div class="intro-label">
                            <span class="badge badge-primary bg-green">In Stock</span>
                        </div>
                    @else
                        <div class="intro-label">
                            <span class="badge badge-danger bg-red">NOT AVAILABLE</span>
                        </div>
                    @endif

                    <div class="mb-30 mt-20 btns">
                        <hr class="mt-0 mb-30" />
                        <form method="post" action="{{ route('shop-cart.store') }}" class="form" id="shor_cart_form">
                            {{-- <form method="post" action="{{ route('customer-products.store') }}" class="form"> --}}
                            @csrf
                            <div class="custom-checkbox-cover mb-20">
                                @forelse ($product->product_sizes as $size)
                                    <div class="custom-checkbox">
                                        <label>
                                            <input type="radio" name="product_size_id" value="{{ $size->id }}"
                                                @if ($size->product_quantity() == null) disabled @endif />
                                            <span>{{ $size->size }}</span>
                                        </label>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <input name="quantity" id="quantity" type="number" class="input-lg round" min="1"
                                max="5" value="1" />
                            @if (isset(\Auth::user()->id))
                                <input type="text" id="user_id" value="{{ \Auth::user()->id }}" name="user_id" hidden>
                                <input type="text" id="customer_type" value="auth" name="customer_type" hidden>
                            @else
                                <input type="text" id="customer_type" value="walk-in" name="customer_type" hidden>
                            @endif
                            <input type="text" id="product_id" value="{{ $product->id }}" name="product_id" hidden>
                            <input type="text" id="status" value="pending" name="status" hidden>
                            <input type="text" id="spot_price" value="{{ $product->getProductPrice($type = 'number') }}"
                                name="spot_price" hidden>

                            <button type="submit"
                                class="btn btn-mod btn-large btn-round full-width">{{ __('home_page.ad_to_cart') }}</button>
                        </form>
                    </div>
                    <p class="mt-0">
                        {!! $product->description !!}
                    </p>
                    @if ($product->show_size_chart == 1)
                        <p>&nbsp;<img
                                src="https://shopstar-images.s3.amazonaws.com/uploads/ckeditor/pictures/20938/content_Length_large.png"
                                style="display: block; margin-left: auto; margin-right: auto;"></p>
                        <table style="table-layout: fixed" style="border-collapse: collapse">
                            <tbody>
                                <tr>
                                    <td rowspan="2" width="208" style="text-align: center;">
                                        <p><span style="color: #000000;"><strong>US/PAK Size</strong></span></p>
                                    </td>
                                    <td rowspan="2" width="208" style="text-align: center;">
                                        <p><span style="color: #000000;"><strong>US/PAK Size</strong></span></p>
                                    </td>
                                    {{-- <td rowspan="2" width="208" style="text-align: center;">
                                            <p><span style="color: #000000;"><strong>US/PAK Size</strong></span></p>
                                        </td> --}}
                                    {{-- <td width="208" style="text-align: center;"></td> --}}
                                    <td colspan="4" width="208" style="text-align: center;">
                                        <p><span style="color: #000000;"><strong>Foot Length</strong></span></p>
                                    </td>
                                </tr>
                                <tr>
                                    {{-- <td width="208" style="text-align: center;">
                                            <p><strong><span style="color: #000000;">US/PAK Size</span></strong></p>
                                        </td>
                                        <td width="208" style="text-align: center;">
                                            <p><strong><span style="color: #000000;">Euro Size</span></strong></p>
                                        </td> --}}
                                    <td width="208" style="text-align: center;">
                                        <p><strong><span style="color: #000000;">cm</span></strong></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><strong><span style="color: #000000;">Inch</span></strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">6</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">39</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">23.7</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">9.33</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">7</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">40</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">24.6</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">9.67</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">8</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">41</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">25.4</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">10.00</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">9</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">42</td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">26.2</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">10.31</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">10</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">43</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">27.1</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">10.67</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">11</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">44</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">27.9</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">10.98</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">12</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">45</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">28.8</span></p>
                                    </td>
                                    <td width="208" style="text-align: center;">
                                        <p><span style="color: #000000;">11.34</span></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <hr class="mt-0 mb-30" />
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    {{-- <p class="text-muted mb-0">Manufacturer: <span
                                            class="fw-medium">{{ $product->manufacturer->name }}</span>
                                    </p> --}}
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
        document.addEventListener('DOMContentLoaded', function() {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });

            $('.slider-nav').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true
            });
        });
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
                let customer_type = $('#customer_type').val();
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
                        created_at: now,
                        customer_type: customer_type
                    },
                    success: function(response) {
                        // alert('hello')
                        console.log(response.error);
                        if (response.success) {
                            console.log(response.cart_count)
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
