@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Products</h4>

                    <div class="flex-shrink-0">
                        <a href="{{ route('products.index') }}" class="btn btn-success btn-label btn-sm">
                            <i class="bx bx-arrow-back label-icon align-middle fs-16 me-2"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <form class="row  needs-validation" action="{{ route('products.store') }}" method="POST"
                        enctype='multipart/form-data' novalidate>
                        @csrf

                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="form-label-group in-border">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('sku')) is-invalid @endif" id="sku"
                                    name="sku" placeholder="Enter SKU" value="{{ old('sku') }}" required>
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
                                    name="name" placeholder="Product Name" value="{{ old('name') }}" required>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('name'))
                                        {{ $errors->first('name') }}
                                    @else
                                        Product Name is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="catergory_id" class="form-label">Categories</label>
                                <select class="form-select form-control mb-3" name="catergory_id" required>
                                    <option value="" @if (old('catergory_id') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (old('catergory_id') == $category->id) {{ 'selected' }} @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('catergory_id'))
                                        {{ $errors->first('catergory_id') }}
                                    @else
                                        Select the Category!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12" style="display: none">
                            <div class="form-label-group in-border">
                                <label for="pricing_type" class="form-label">Pricing Type</label>
                                <select id="pricing_type" class="form-select form-control mb-3" name="pricing_type"
                                    required>
                                    <option value="fix_price" selected>
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
                                        value="{{ old('fixed_amount') }}">
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

                        <div class="col-md-4 col-sm-12 mb-3">
                            <div class="form-label-group in-border">
                                <label for="product_picture" class="form-label">Product Picture </label>
                                <input type="file"
                                    class="form-control @if ($errors->has('product_picture')) is-invalid @endif"
                                    id="product_picture" name="product_picture" placeholder="Please Enter Account Name"
                                    value="{{ old('product_picture') }}" required>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('product_picture'))
                                        {{ $errors->first('product_picture') }}
                                    @else
                                        Product Picture is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="status" class="form-label">Status</label>
                                <select id="" class="form-select form-control mb-3" name="status">
                                    <option value="" @if (old('status') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    <option value="active" @if (old('status') == 'active') {{ 'selected' }} @endif>
                                        Active
                                    </option>
                                    <option value="inactive" @if (old('status') == 'inactive') {{ 'selected' }} @endif>
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
                                <label for="on_hold" class="form-label">Minimum in Stock</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('on_hold')) is-invalid @endif" id="on_hold"
                                    name="on_hold" placeholder="Enter Minimum in Stock" value="{{ old('on_hold') }}">
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
                                <input type="date" name="valid_from" id="valid_from" value="{{ old('valid_from') }}"
                                    class="form-control mb-3 @if ($errors->has('valid_from')) is-invalid @endif">
                                <div class="invalid-tooltip">
                                    @if ($errors->has('valid_from'))
                                        {{ $errors->first('valid_from') }}
                                    @else
                                        Valid From is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <label for="valid_till" class="form-label">Valid Till </label>
                                <input type="date" name="valid_till" id="valid_till" value="{{ old('valid_till') }}"
                                    class="form-control mb-3 @if ($errors->has('valid_till')) is-invalid @endif">
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
                                    placeholder="Enter product description here...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button id="submit_btn" class="btn btn-primary" type="submit">Save Changes</button>
                            <a href="{{ route('products.index') }}" type="button"
                                class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_scripts')
    <script></script>
@endpush
