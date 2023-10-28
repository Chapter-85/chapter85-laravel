@extends('frontend.layouts.master')
@section('content')
    @include('frontend.shop_cart.header')
    @include('layouts.flash_message')
    <div id="err_div" class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert"
        style="display: none">
        <i class="ri-error-warning-line label-icon"></i><strong>Error</strong>
        -<span id="err_span"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <section class="page-section pt-5">
        <div class="container">
            <div class="row">
                @if (Auth::user())
                    <form id="customer_products_store" method="post" action="{{ route('customer-products.store') }}"
                        class="form">
                        @csrf
                @endif
                <div class="col-lg-10 offset-lg-1 col-xl-10 offset-xl-1">

                    <div class="card mt-10 mb-10">
                        <div class="card-header">
                            <h5 class="card-title flex-grow-1 mb-0">Your Cart</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped shopping-cart-table">
                                    <tr>
                                        <th> Photo </th>
                                        <th> Product </th>
                                        <th> Quantity </th>
                                        <th> Item Price </th>
                                        <th> Total </th>
                                        <th> &nbsp;</th>
                                        <th>

                                        </th>
                                    </tr>
                                    @forelse ($carts as $cart)
                                        <input type="hidden" id="created_at" value="{{ $cart->created_at }}">
                                        <input type="text" id="cart_ids" name="cart_ids[]" value="{{ $cart->id }}"
                                            hidden>
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
                                                    Rs{{ number_format($cart->spot_price, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price_usd"> Rs{{ number_format($cart->total_price, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a class="delete-cart"
                                                    href="{{ route('shop-cart.destroy', $cart->id) }}"><i
                                                        class="fa fa-times"></i>
                                                    <span class="d-none d-sm-inline-block"></span></a>
                                            </td>
                                            <td></td>
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

                    {{-- <hr /> --}}

                    <div class="row mt-10 mb-60">
                        <div class="col-sm-12  align-right">
                            <div>
                                <a href="{{ route('shop') }}" class="btn btn-mod btn-gray btn-round">Continue
                                    Shopping</a>
                            </div>

                        </div>
                    </div>

                    @if (count($carts) > 0)
                        <div class="row mb-10">
                            {{-- </form> --}}
                            <div class="col-md-12 pt-4 text-end">
                                <div class="lead mt-0 mb-10">
                                    Order Total:
                                    <span id="total_price_usd"><strong>Rs
                                            {{ number_format($total_price, 2) }}</strong></span>
                                </div>
                                <div>
                                    <div class="mb-10">
                                        <div class="form-group ht-70">
                                            <label class="radio-inline @if ($errors->has('gender')) is-invalid @endif">
                                                <input type="checkbox" name="termsAndConditions" value=""
                                                    id="termsAndConditions">
                                                I accept the Terms & Conditions & Payment Policy
                                            </label>
                                        </div>
                                    </div>
                                    @if (Auth::user())
                                        <a href="{{ route('order-delivery-details') }}" id="proceed_to_checkout"
                                            class="btn btn-mod btn-round btn-large" disabled>Proceed to
                                            Checkout</a>
                                    @else
                                        <button type="button" class="btn btn-mod btn-round btn-large"
                                            id="proceed_to_checkout" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            disabled>
                                            Proceed To Checkout
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (Auth::user())
            </form>
        @endif

        </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="panel-title">
                        Payment Details
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <div class="checkbox pull-right" style="margin: 0">
                                        <label>
                                            <input type="checkbox" />
                                            Remember
                                        </label>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="cardNumber">
                                            CARD NUMBER</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control mb-3" id="cardNumber"
                                                placeholder="Valid Card Number" autofocus />
                                            <span class="input-group-addon"><span
                                                    class="glyphicon glyphicon-lock"></span></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-7 col-md-7">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="expityMonth">
                                                        EXPIRY DATE</label>
                                                    <div class="col-xs-6 col-md-6">
                                                        <input type="text" class="form-control" id="expityMonth"
                                                            placeholder="MM" />
                                                    </div>
                                                    <div class="col-xs-6 col-md-6">
                                                        <input type="text" class="form-control" id="expityYear"
                                                            placeholder="YY" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-5 col-md-5 pull-right">
                                            <div class="form-group">
                                                <label for="cvCode">
                                                    CV CODE</label>
                                                <input type="password" class="form-control" id="cvCode"
                                                    placeholder="CV" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" id="url">
                <div class="modal-footer">
                    <button type="button" id="modal_close" class="btn btn-mod btn-gray btn-round"
                        data-dismiss="modal">Close</button>
                    <button type="button" id="modal_submit_btn" class="btn btn-mod btn-round">Save changes</button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="panel-title">
                        Add Personal Details
                    </h3>
                </div>
                <form action="{{ route('walk-in-customer.store') }}" id="create_new_customer">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                Full Name</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-3" id="fullName"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                Email</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control mb-3" id="email"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                Phone Number</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-3" id="phoneNumber"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                City</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-3" id="city"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                State</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-3" id="state"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                Country</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-3" id="country"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                Zip Code</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-3" id="zipCode"
                                                    placeholder="" autofocus />
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                Address</label>
                                            <div class="input-group">
                                                <textarea name="address" id="address" cols="50" rows="3"></textarea>
                                                <span class="input-group-addon"><span
                                                        class="glyphicon glyphicon-lock"></span></span>
                                            </div>
                                        </div>

                                        {{-- <div class="panel-heading">
                                            <div class="checkbox pull-right" style="margin: 0">
                                                <label>
                                                    <input type="checkbox" id="sameAsShipping" />
                                                    Same as Shiping address
                                                </label>
                                            </div>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal_close" class="btn btn-mod btn-gray btn-round"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-mod btn-round">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('frontend.layouts.footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var method;

            $("#termsAndConditions").on('click', function(e) {
                if ($("#termsAndConditions").is(':checked')) {
                    // alert('checked')
                    $("#proceed_to_checkout").prop('disabled', false); // checked
                } else {
                    $("#proceed_to_checkout").prop('disabled', true); // unchecked}
                }
            })

            let user_id = $('#user_id').val();

            $('#create_new_customer').on('submit', function(e) {
                e.preventDefault();
                let fullName = $('#fullName').val();
                let email = $('#email').val();
                let address = $('#address').val();
                let city = $('#city').val();
                let state = $('#state').val();
                let country = $('#country').val();
                let zipCode = $('#zipCode').val();
                let phoneNumber = $('#phoneNumber').val();

                const url = $('#create_new_customer').attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        full_name: fullName,
                        email: email,
                        address: address,
                        city: city,
                        state: state,
                        country: country,
                        zip_code: zipCode,
                        phone_number: phoneNumber
                    },
                    success: function(response) {
                        // alert('hello')
                        console.log(response);
                        if (response.url) {
                            if (method != 'credit card') {
                                window.location = response.url;
                            } else {
                                $('#exampleModalCenter').modal('show');
                                $('#url').val(response.url);
                            }
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
                        document.getElementById('err_div').style.display = "block";
                        document.getElementById('success_div').style.display = "none";
                        $('#err_span').text("Please fill all fields");
                        // $('#err_div').text(response.success);
                    }
                });
            });

            $('#customer_products_store').on('submit', function(e) {
                e.preventDefault();

                // arrp = [];
                // arrp.push($("input[name='cart_ids[]']").map(function() {
                //     return $(this).val();
                // }).get());

                // let payment_method_id = $('#payment_method_id').val();
                // let delivery_method_id = $('#delivery_method_id').val();

                let currency = 'PKR';

                const url = $('#customer_products_store').attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cart_ids: arrp[0],
                        user_id: user_id,
                        currency: currency,
                        created_at: moment().format('YYYY-MM-DD HH:mm:ss')
                    },
                    success: function(response) {
                        // alert('hello')
                        console.log(response);
                        if (response.url) {
                            if (method != 'credit card') {
                                window.location = response.url;
                            } else {
                                $('#exampleModalCenter').modal('show');
                                $('#url').val(response.url);
                            }
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
                        document.getElementById('err_div').style.display = "block";
                        document.getElementById('success_div').style.display = "none";
                        $('#err_span').text(response.error);
                        // $('#err_div').text(response.success);
                    }
                });
            });

            $(document).on('change', '#payment_method_id', function(e) {
                var payment_method = $('#payment_method_id').val();
                $.ajax({

                    url: '/get-terms-and-condition/payment/' + payment_method,
                    type: "GET",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data.method.description);
                        method = data.method.payment_method.toLowerCase();
                        console.log(method)
                        $('#payment_description').html(data.method.description);
                        if (method.toLowerCase() != 'credit card') {
                            document.getElementById('total_price_usd').style.display = "none";
                            document.getElementById('total_price_hkd').style.display =
                                "inline-block";
                            $('.spot_price_usd').css("display", "none");
                            $('.spot_price_hkd').css("display", "inline-block");
                            $('.price_usd').css("display", "none");
                            $('.price_hkd').css("display", "inline-block");
                        } else {
                            document.getElementById('total_price_usd').style.display =
                                "inline-block";
                            document.getElementById('total_price_hkd').style.display = "none";
                            $('.spot_price_usd').css("display", "inline-block");
                            $('.spot_price_hkd').css("display", "none");
                            $('.price_usd').css("display", "inline-block");
                            $('.price_hkd').css("display", "none");
                        }
                    },
                    error: function(error) {
                        // alert(error)
                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });

            });

            $('#modal_submit_btn').on('click', function(e) {
                window.location = $('#url').val();
            })

            $('#modal_close').on('click', function(e) {
                e.preventDefault()
                $('#exampleModalCenter').modal('hide')
            })
        });

        $(document).on('click', '.delete-cart', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            $.ajax({

                url: url,
                type: "DELETE",
                // data : filters,
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                cache: false,
                success: function(data) {
                    // alert('deleted')
                    location.reload(true);
                },
                error: function(error) {
                    // alert(error)
                },
                beforeSend: function() {

                },
                complete: function() {

                }
            });
        });
    </script>
@endpush
