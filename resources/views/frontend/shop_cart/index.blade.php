@extends('frontend.layouts.master')
@section('content')
    @include('frontend.shop_cart.header')
    @include('layouts.flash_message')
    <section class="page-section pt-5">
        <div class="container">
            <div class="row">
                <form id="customer_products_store" method="post" action="{{ route('customer-products.store') }}"
                    class="form">
                    @csrf
                    <div class="col-lg-10 offset-lg-1 col-xl-10 offset-xl-1">
                        <div class="time-block" id="time_block" style="display: none">
                            <div class="Timer"> </div>
                        </div>
                        <input type="hidden" id="now" value="{{ $now }}">
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
                                            <input type="text" id="cart_ids" name="cart_ids[]"
                                                value="{{ $cart->id }}" hidden>
                                            <input type="text" id="user_id" value="{{ \Auth::user()->id }}"
                                                name="user_id" hidden>
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
                                                    <span class="spot_price_usd"> ${{ number_format($cart->spot_price, 2) }}
                                                    </span>
                                                    <span class="spot_price_hkd" style="display: none">
                                                        HKD {{ number_format($cart->spot_price * $hkd_price, 2) }}</span>
                                                </td>
                                                <td>
                                                    <span class="price_usd"> ${{ number_format($cart->total_price, 2) }}
                                                    </span>
                                                    <span class="price_hkd" style="display: none">
                                                        HKD {{ number_format($cart->total_price * $hkd_price, 2) }}</span>

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
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- <form action="#" class="form"> --}}
                                    <div class="mb-10">
                                        <label for="" class="font-alt">Delivery Method</label>
                                        <select class="input-md form-control" name="delivery_method_id"
                                            id="delivery_method_id" required style="display:flex">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach ($delivery_methods as $delivery_method)
                                                <option value="{{ $delivery_method->id }}"
                                                    @if (old('delivery_method_id') == $delivery_method->id) {{ 'selected' }} @endif>
                                                    {{ $delivery_method->delivery_method }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="delivery_description"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label for="" class="font-alt">Payment Method</label>
                                        <select id="payment_method_id" name="payment_method_id"
                                            class="input-md form-control" style="display:flex">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach ($payment_methods as $payment_method)
                                                <option value="{{ $payment_method->id }}"
                                                    data-payment="{{ $payment_method->payment_method }}"
                                                    @if (old('payment_method_id') == $payment_method->id) {{ 'selected' }} @endif>
                                                    {{ $payment_method->payment_method }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="payment_description"></div>
                                </div>
                            </div>
                            <div class="row mb-10">
                                {{-- </form> --}}
                                <div class="col-md-12 pt-4 text-end">
                                    <div class="lead mt-0 mb-10">
                                        Order Total:
                                        <span id="total_price_usd"><strong>USD
                                                {{ number_format($total_price, 2) }}</strong></span>
                                        <span id="total_price_hkd" style="display: none"><strong>HKD
                                                {{ number_format($total_price * $hkd_price, 2) }}
                                            </strong> <br><strong>USD {{ number_format($total_price, 2) }}</strong></span>
                                    </div>
                                    <div>
                                        <div class="mb-10">
                                            <div class="form-group ht-70">
                                                <label
                                                    class="radio-inline @if ($errors->has('gender')) is-invalid @endif">
                                                    <input type="checkbox" name="termsAndConditions" value=""
                                                        id="termsAndConditions">
                                                    I accept the Terms & Conditions & Payment Policy
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" id="proceed_to_checkout"
                                            class="btn btn-mod btn-round btn-large" disabled>Proceed to
                                            Checkout</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        </form>
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
                {{-- <form method="post" id="customer_products_store" action="{{ route('customer-products.store') }}"
                    class="form">
                    @csrf --}}
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
@endsection
@push('frontend.layouts.footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // var countDownDate = moment($('#created_at').val()).add(15, 'minutes');

            // console.log('countDownDate', countDownDate.toString(), 'Now', moment().toString());
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

            if ($('#created_at').val() != undefined) {

                console.log($('#created_at').val());

                document.getElementById('time_block').style.display = "flex";

                var countDownDate = moment($('#created_at').val()).add(15, 'minutes').toString();

                var now_backend = $('#now').val();
                console.log("CountDown Date", countDownDate);
                console.log("Now: ", now_backend);

                var x = setInterval(function() {

                    var now = moment();
                    var minutes = moment(countDownDate).diff(now, 'minutes');
                    var seconds = moment(countDownDate).diff(now, 'seconds');

                    // console.log('minutes', minutes, 'seconds', seconds);


                    var now_time = countDownDate;
                    var then = now.toString();

                    var hours = moment.utc(moment(now_time).diff(moment(then))).format("mm:ss")

                    $('.Timer').text(hours);

                    if (minutes < 0 || seconds < 0) {

                        clearInterval(x);
                        $('.Timer').text("EXPIRED");

                        $.ajax({
                            url: '/remove-shop-cart/' + user_id,
                            type: "GET",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                // alert('hello')
                                console.log(response);
                                if (response) {
                                    location.reload();
                                }
                            },
                            error: function(error) {
                                console.log(error)
                            }
                        });
                    }
                }, 1000);
            }

            $('#customer_products_store').on('submit', function(e) {
                e.preventDefault();

                arrp = [];
                arrp.push($("input[name='cart_ids[]']").map(function() {
                    return $(this).val();
                }).get());

                let payment_method_id = $('#payment_method_id').val();
                let delivery_method_id = $('#delivery_method_id').val();

                let currency = 'USD';

                if (method != 'credit card') {
                    currency = 'HKD';
                }

                const url = $('#customer_products_store').attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        cart_ids: arrp[0],
                        user_id: user_id,
                        delivery_method_id: delivery_method_id,
                        payment_method_id: payment_method_id,
                        payment_method: method,
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

        $(document).on('change', '#delivery_method_id', function(e) {
            var delivery_method = $('#delivery_method_id').val();
            var method;
            $.ajax({

                url: '/get-terms-and-condition/delivery/' + delivery_method,
                type: "GET",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                cache: false,
                success: function(data) {
                    console.log(data.method.description);
                    method = data.method.delivery_method;
                    $('#delivery_description').html(data.method.description);
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
