@extends('frontend.layouts.master')

@section('content')
    @include('frontend.shop_cart.header_delivery')
    @include('layouts.flash_message')
    <section class="page-section">
        <div class="container">
            <div class="delivery_form">
                <div class="col-lg-12 col-xl-12 ">

                </div>
            </div>

            <div class="row">

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Your Order
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped shopping-cart-table">
                                            <tr>
                                                <th> Photo </th>
                                                <th> Product </th>
                                                <th> Quantity </th>
                                                <th> Item Price </th>
                                                <th> Total </th>

                                            </tr>
                                            @forelse ($carts as $cart)
                                                <input type="hidden" id="created_at" value="{{ $cart->created_at }}">
                                                <input type="text" id="cart_ids" name="cart_ids[]"
                                                    value="{{ $cart->id }}" hidden>
                                                @if (isset(\Auth::user()->id))
                                                    <input type="text" id="user_id" value="{{ \Auth::user()->id }}"
                                                        name="user_id" hidden>
                                                @endif
                                                <tr>
                                                    <td> <img src="{{ $cart->product->product_picture_url }}" alt=""
                                                            style="height: 100px;" /> </td>
                                                    <td>
                                                        <a href="{{ route('single-product', $cart->product->id) }}"
                                                            title="">{{ $cart->product->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $cart->quantity }}
                                                    </td>
                                                    <td>
                                                        <span class="spot_price_usd">
                                                            PKR {{ number_format($cart->spot_price) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="price_usd"> PKR
                                                            {{ number_format($cart->total_price) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">No Record Found!</td>
                                                </tr>
                                            @endforelse
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingfour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                Your Informartion
                            </button>
                        </h2>
                        <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if (isset($customer))
                                    <div class="row">
                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label">Full Name *</label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('full_name')) is-invalid @endif"
                                                name="full_name" id="full_name" value="{{ $customer->full_name }}"
                                                placeholder="Full Name"
                                                class="form-control  @if ($errors->has('full_name')) is-invalid @endif">
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label">Phone Number *</label>
                                            <input type="text" name="phone_number" id="phone_number"
                                                value="{{ $customer->phone_number }}" placeholder="Phone Number"
                                                class="form-control  @if ($errors->has('phone_number')) is-invalid @endif">
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label">Email *</label>
                                            <input type="text" name="email" id="email"
                                                value="{{ isset($customer->user->email) ? $customer->user->email : $customer->email }}"
                                                placeholder="Email"
                                                class="form-control  @if ($errors->has('email')) is-invalid @endif">
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">City *</label>
                                            <input type="text" name="city" id="city"
                                                value="{{ $customer->city }}" placeholder="City"
                                                class="form-control  @if ($errors->has('city')) is-invalid @endif"
                                                required>
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Country *</label>
                                            <input type="text" name="country" id="country"
                                                value="{{ $customer->country }}" placeholder="Country"
                                                class="form-control  @if ($errors->has('country')) is-invalid @endif"
                                                required>
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Zip Code *</label>
                                            <input type="text" name="zip_code" id="zip_code"
                                                value="{{ $customer->zip_code }}" placeholder="Zip Code"
                                                class="form-control  @if ($errors->has('zip_code')) is-invalid @endif"
                                                required>
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 mb-3">
                                            <label class="form-label">Shipping Address *</label>
                                            <textarea id="shipping_address" name="shipping_address"
                                                class="form-control  @if ($errors->has('shipping_address')) is-invalid @endif" placeholder="Shipping Address">{{ $customer->address }}</textarea>
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('shipping_address') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Total Amount
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if (count($carts) > 0)
                                    <div class="row">
                                        <div class="col-md-12 pt-4 text-center">
                                            <div class="lead mt-0 mb-10">
                                                Order Total:
                                                <span id="total_price_usd"><strong>PKR
                                                        {{ number_format($total_price) }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Payment Method
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked
                                        disabled>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">COD (Cash on
                                        Delivery)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" id="order_update_form" action="{{ route('orders.store') }}">
                @csrf
                <div class="footer text-end mt-3">
                    <button class="btn btn-mod btn-gray btn-round" type="reset">{{ __('home_page.cancel') }}</button>
                    <button class="btn btn-mod btn-round" type="submit">Place Order</button>

                </div>
            </form>
        </div>
    </section>
@endsection
@push('frontend.layouts.footer_scripts')
    <script>
        $(document).ready(function() {

            $('#order_update_form').on('submit', function(e) {
                e.preventDefault();
                let full_name = $('#full_name').val();
                let phone_number = $('#phone_number').val();
                let email = $('#email').val();
                let city = $('#city').val();
                let country = $('#country').val();
                let zip_code = $('#zip_code').val();
                let shipping_address = $('#shipping_address').val();
                const url = $('#order_update_form').attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        full_name: full_name,
                        phone_number: phone_number,
                        email: email,
                        city: city,
                        country: country,
                        zip_code: zip_code,
                        shipping_address: shipping_address
                    },
                    success: function(resp) {
                        Swal.fire({
                            title: "Order Confirmed",
                            text: "Your Order is being confirmed",
                            icon: "success",
                            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
                            confirmButtonText: "Great!",
                            buttonsStyling: false,
                        }).then(function(response) {

                            if (resp.url) {
                                window.location = resp.url;
                            }
                        })
                    },
                    error: function(error) {
                        console.log(error)
                        // $('#err_div').text(response.success);
                    }
                });
            });
        });
    </script>
@endpush
