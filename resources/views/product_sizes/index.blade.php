@extends('layouts.master')

@section('content')
    <div class="row">
        @if (isset($product_sizes))
            @include('product_sizes.edit')
        @else
            @include('product_sizes.add_new')
        @endif
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Product Sizes</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="product-sizes-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('product-sizes.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/product_sizes.js') }}"></script>
@endpush
