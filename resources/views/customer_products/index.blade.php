@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Customers Products</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="date_range" class="form-label">Date</label>
                            <input class="form-control filter mb-3" name="date_range" id="date_range">
                        </div>
                    </div>
                    <table id="customer-products-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>CustomerID</th> --}}
                                <th>Customer name</th>
                                {{-- <th>Product id</th> --}}
                                <th>Product name</th>
                                <th>Purchase Price</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>CustomerID</th>
                                <th>Customer name</th>
                                <th>Product id</th>
                                <th>Product name</th>
                                <th>Purchase Price</th>
                                <th>Created At</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('customer-products.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/customer_products.js') }}"></script>
@endpush
