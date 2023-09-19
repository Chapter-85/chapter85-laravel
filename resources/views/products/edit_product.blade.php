@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Update Product</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('products.index') }}" class="btn btn-success btn-label btn-sm">
                            <i class="bx bx-arrow-back label-icon align-middle fs-16 me-2"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form class="row  needs-validation" action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')


                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="form-label-group in-border">
                                <label for="sku" class="form-label">SKU </label>
                                <input type="text"
                                    class="form-control @if ($errors->has('sku')) is-invalid @endif" id="sku"
                                    name="sku" placeholder="Enter SKU" value="{{ $product->sku }}">
                                <div class="invalid-tooltip">
                                    @if ($errors->has('sku'))
                                        {{ $errors->first('sku') }}
                                    @else
                                        SKU is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12  mb-3">
                            <div class="form-label-group in-border">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('name')) is-invalid @endif" id="name"
                                    name="name" placeholder="Product Name" value="{{ $product->name }}" required>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('name'))
                                        {{ $errors->first('name') }}
                                    @else
                                        Product Name is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-label-group in-border">
                                <label for="catergory_id" class="form-label">Categories</label>
                                <select class="form-select form-control mb-3" name="catergory_id" required>
                                    <option value="" @if ($product->catergory_id == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($product->catergory_id == $category->id) {{ 'selected' }} @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">Select the Category!</div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12" style="display: none">
                            <div class="form-label-group in-border">
                                <label for="pricing_type" class="form-label">Pricing Type (價格類別)</label>
                                <select class="form-select form-control mb-3" name="pricing_type" id="pricing_type"
                                    required>
                                    <option value="" @if ($product->pricing_type == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    <option value="use_feed" @if ($product->pricing_type == 'use_feed') {{ 'selected' }} @endif>
                                        Use Feed (餵價)
                                    </option>
                                    <option value="fix_price" @if ($product->pricing_type == 'fix_price') {{ 'selected' }} @endif>
                                        Fix Price (定價)
                                    </option>
                                </select>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('pricing_type'))
                                        {{ $errors->first('pricing_type') }}
                                    @else
                                        Pricing Type is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="fixed_amount" class="form-label">Fixed Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">PKR</span>
                                    </div>
                                    <input type="decimal" step="0.001"
                                        class="form-control @if ($errors->has('fixed_amount')) is-invalid @endif"
                                        id="fixed_amount" name="fixed_amount" placeholder="Please enter Fixed Amount"
                                        value="{{ $product->fixed_amount }}">
                                </div>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('fixed_amount'))
                                        {{ $errors->first('fixed_amount') }}
                                    @else
                                        Fixed Amount is empty or incorrect!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="product_picture" class="form-label">Product Picture</label>
                                <input type="file"
                                    class="form-control @if ($errors->has('product_picture')) is-invalid @endif"
                                    id="product_picture" name="product_picture" placeholder="Please Enter Account Name"
                                    value="{{ $product->product_picture }}">
                                <div class="invalid-tooltip">
                                    @if ($errors->has('product_picture'))
                                        {{ $errors->first('product_picture') }}
                                    @else
                                        Product Picture is required!
                                    @endif
                                </div>
                                <small class="text-muted form-text m-b-none text-right"><a data-bs-toggle="modal"
                                        data-bs-target="#domicile-modal" href="" title="Domicile" data-gallery=""><i
                                            class="ri-picture-in-picture-exit-fill"></i> Preview Product
                                        Picture</a></small>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="status" class="form-label">Status</label>
                                <select id="" class="form-select form-control mb-3" name="status">
                                    <option value="" @if ($product->status == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    <option value="active" @if ($product->status == 'active') {{ 'selected' }} @endif>
                                        Active
                                    </option>
                                    <option value="inactive"
                                        @if ($product->status == 'inactive') {{ 'selected' }} @endif>
                                        In-Active
                                    </option>
                                </select>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('status'))
                                        {{ $errors->first('status') }}
                                    @else
                                        Status is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="form-label-group in-border">
                                <label for="on_hold" class="form-label">Minimum in Stock </label>
                                <input type="text"
                                    class="form-control @if ($errors->has('on_hold')) is-invalid @endif"
                                    id="on_hold" name="on_hold" placeholder="Enter Minimum in Stock"
                                    value="{{ $product->on_hold }}">
                                <div class="invalid-tooltip">
                                    @if ($errors->has('on_hold'))
                                        {{ $errors->first('on_hold') }}
                                    @else
                                        Minimum in Stock is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="valid_from" class="form-label">Valid From </label>
                                <input type="date" name="valid_from" id="valid_from"
                                    value="{{ $product->valid_from }}"
                                    class="form-control flatpickr mb-3 @if ($errors->has('valid_from')) is-invalid @endif">
                                <div class="invalid-tooltip">
                                    @if ($errors->has('valid_from'))
                                        {{ $errors->first('valid_from') }}
                                    @else
                                        Valid till is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="status" class="form-label">Valid Till </label>
                                <input type="date" name="valid_till" value="{{ $product->valid_till }}"
                                    class="form-control flatpickr mb-3 @if ($errors->has('valid_till')) is-invalid @endif">
                                <div class="invalid-tooltip">
                                    @if ($errors->has('valid_till'))
                                        {{ $errors->first('valid_till') }}
                                    @else
                                        Valid till is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control mb-3" name="description" id="description"
                                    placeholder="Enter product description here...">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <a href="{{ route('products.index') }}" type="button"
                                class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal flipInUp" id="domicile-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated flipInUp">
                <div class="modal-body">
                    <div class="text-center">
                        <img class="d-block w-100" src="{{ $product->product_picture_url }}" alt="domicile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_scripts')
    <script>
        $(document).ready(function() {
            $("#pricing_type").change(function() {
                var selected_option = $('#pricing_type').val();
                if (selected_option == 'fix_price') {
                    // document.getElementById("promo_amount_div").style.display = "none";
                    $('#fixed_amount').attr('disabled', false);
                }
                if (selected_option == 'use_feed') {
                    $('#fixed_amount').attr('disabled', true);
                    $('#fixed_amount').val(0);
                    // document.getElementById("promo_amount_div").style.display = "block";
                }
            });

            $("#weight_unit").change(function() {
                var selected_option = $('#weight_unit').val();
                if (selected_option == 'grams') {
                    // document.getElementById("promo_amount_div").style.display = "none";
                    $("#weight_in_grams").attr("readonly", false);
                    $("#weight_in_ounces").attr("readonly", true);
                    // $("#weight_in_ounces").val(0);
                }
                if (selected_option == 'ounces') {
                    $("#weight_in_grams").attr("readonly", true);
                    $("#weight_in_grams").val(0);
                    $("#weight_in_ounces").attr("readonly", false);
                    // document.getElementById("promo_amount_div").style.display = "block";
                }
            });

            $("#weight_in_grams").change(function() {
                var value = $("#weight_in_grams").val();
                value = parseFloat(value)
                $("#weight_in_ounces").val(value * 0.0321507);
            });

            $("#surcharge_at_product").change(function() {
                var selected_option = $('#surcharge_at_product').val();
                if (selected_option == 'yes') {
                    $('#markup_type').attr('disabled', false);
                    $('#mark_up').attr('disabled', false);
                }
                if (selected_option == 'no') {
                    $('#markup_type').attr('disabled', true);
                    $('#mark_up').attr('disabled', true);
                }
            });

            // $('#tier_commission_5').val(100);

            $('#tier_commission_1').change(function() {
                var tier_1 = parseInt($('#tier_commission_1').val());
                var tier_2 = $('#tier_commission_2').val();
                var tier_3 = $('#tier_commission_3').val();
                var tier_4 = $('#tier_commission_4').val();
                if (tier_2) {
                    tier_2 = parseInt(tier_2);
                }
                if (tier_3) {
                    tier_3 = parseInt(tier_3);
                }
                if (tier_4) {
                    tier_4 = parseInt(tier_4);
                }
                var sum = tier_1 + tier_2 + tier_3 + tier_4;

                if (sum <= 100) {
                    $('#submit_btn').attr('disabled', false);
                    $('#tier_commission_5').val(100 - sum);
                } else {
                    $('#submit_btn').attr('disabled', true);
                    $("#tier_commission_1").addClass("is-invalid");
                    $("#tier_commission_2").addClass("is-invalid");
                    $("#tier_commission_3").addClass("is-invalid");
                    $("#tier_commission_4").addClass("is-invalid");
                    $('#invalid-tooltip-tiers').html(`<strong>
                                    Value Exeed from the limit
                                    </strong>`);
                }
            });

            $('#tier_commission_2').change(function() {
                var tier_2 = parseInt($('#tier_commission_2').val());
                var tier_1 = $('#tier_commission_1').val();
                var tier_3 = $('#tier_commission_3').val();
                var tier_4 = $('#tier_commission_4').val();
                if (tier_1) {
                    // alert('tier1', tier_1);
                    tier_1 = parseInt(tier_1);
                }
                if (tier_3) {
                    tier_3 = parseInt(tier_3);
                }
                if (tier_4) {
                    tier_4 = parseInt(tier_4);
                }

                var sum = tier_1 + tier_2 + tier_3 + tier_4;

                if (sum <= 100) {
                    $('#submit_btn').attr('disabled', false);
                    $('#tier_commission_5').val(100 - sum);
                } else {
                    $('#submit_btn').attr('disabled', true);
                    $("#tier_commission_1").addClass("is-invalid");
                    $("#tier_commission_2").addClass("is-invalid");
                    $("#tier_commission_3").addClass("is-invalid");
                    $("#tier_commission_4").addClass("is-invalid");
                    $('#invalid-tooltip-tiers').html(`<strong>
                                    Value Exeed from the limit
                                    </strong>`);
                }
            });

            $('#tier_commission_3').change(function() {
                var tier_1 = $('#tier_commission_1').val();
                var tier_2 = $('#tier_commission_2').val();
                var tier_4 = $('#tier_commission_4').val();
                var tier_3 = parseInt($('#tier_commission_3').val());
                if (tier_2) {
                    tier_2 = parseInt(tier_2);
                }
                if (tier_1) {
                    tier_1 = parseInt(tier_1);
                }
                if (tier_4) {
                    tier_4 = parseInt(tier_4);
                }
                var sum = tier_1 + tier_2 + tier_3 + tier_4;
                // alert(sum);
                if (sum <= 100) {
                    $('#submit_btn').attr('disabled', false);
                    $('#tier_commission_5').val(100 - sum);
                } else {
                    $('#submit_btn').attr('disabled', true);
                    $("#tier_commission_1").addClass("is-invalid");
                    $("#tier_commission_2").addClass("is-invalid");
                    $("#tier_commission_3").addClass("is-invalid");
                    $("#tier_commission_4").addClass("is-invalid");
                    $('#invalid-tooltip-tiers').html(`<strong>
                                    Value Exeed from the limit
                                    </strong>`);
                }
            });

            $('#tier_commission_4').change(function() {
                var tier_1 = $('#tier_commission_1').val();
                var tier_2 = $('#tier_commission_2').val();
                var tier_3 = $('#tier_commission_3').val();
                var tier_4 = parseInt($('#tier_commission_4').val());
                if (tier_2) {
                    tier_2 = parseInt(tier_2);
                }
                if (tier_1) {
                    tier_1 = parseInt(tier_1);
                }
                if (tier_3) {
                    tier_3 = parseInt(tier_3);
                }
                var sum = tier_1 + tier_2 + tier_3 + tier_4;
                if (sum <= 100) {
                    $('#submit_btn').attr('disabled', false);
                    $('#tier_commission_5').val(100 - sum);
                } else {
                    $('#submit_btn').attr('disabled', true);
                    $("#tier_commission_1").addClass("is-invalid");
                    $("#tier_commission_2").addClass("is-invalid");
                    $("#tier_commission_3").addClass("is-invalid");
                    $("#tier_commission_4").addClass("is-invalid");
                    $('#invalid-tooltip-tiers').html(`<strong>
                                    Value Exeed from the limit
                                    </strong>`);
                }
            });
        })
    </script>
@endpush
