@extends('frontend.layouts.master')

@section('content')
    @include('frontend.shop_cart.header_delivery')
    @include('layouts.flash_message')
    <section class="page-section">
        <div class="container">
            <div class="delivery_form">
                <form method="post" id="order_update_form" action="{{ route('orders.update', $order->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-control @if ($errors->has('full_name')) is-invalid @endif"
                                name="full_name" id="full_name" value="{{ $order->customer->full_name }}"
                                placeholder="Full Name"
                                class="form-control  @if ($errors->has('full_name')) is-invalid @endif">
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('full_name') }}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" name="phone_number" id="phone_number"
                                value="{{ $order->customer->phone_number }}" placeholder="Phone Number"
                                class="form-control  @if ($errors->has('phone_number')) is-invalid @endif">
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="text" name="email" id="email" value="{{ $order->customer->user->email }}"
                                placeholder="Email"
                                class="form-control  @if ($errors->has('email')) is-invalid @endif">
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">City *</label>
                            <input type="text" name="city" id="city" value="{{ $order->customer->city }}"
                                placeholder="City" class="form-control  @if ($errors->has('city')) is-invalid @endif"
                                required>
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('city') }}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">Country *</label>
                            <input type="text" name="country" id="country" value="{{ $order->customer->country }}"
                                placeholder="Country"
                                class="form-control  @if ($errors->has('country')) is-invalid @endif" required>
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('country') }}</strong>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 mb-3">
                            <label class="form-label">Zip Code *</label>
                            <input type="text" name="zip_code" id="zip_code" value="{{ $order->customer->zip_code }}"
                                placeholder="Zip Code"
                                class="form-control  @if ($errors->has('zip_code')) is-invalid @endif" required>
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('zip_code') }}</strong>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 mb-3">
                            <label class="form-label">Shipping Address *</label>
                            <textarea id="shipping_address" name="shipping_address"
                                class="form-control  @if ($errors->has('shipping_address')) is-invalid @endif" placeholder="Shipping Address">{{ $order->customer->address }}</textarea>
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('shipping_address') }}</strong>
                            </div>
                        </div>
                        <div class="footer text-end">
                            <button class="btn btn-mod btn-gray btn-round"
                                type="reset">{{ __('home_page.cancel') }}</button>
                            <button class="btn btn-mod btn-round" type="submit">Save Changes</button>

                        </div>
                    </div>
                </form>
            </div>
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
                    type: "PUT",
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
