@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card  mt-30 mb-30">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Customer Order</h4>
                </div>
                <div class="card-body">
                    <table id="customer-orders-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Customer Type</th>
                                <th>Delivery Method</th>
                                <th>Payment Method</th>
                                <th>Total Price</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('orders.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/orders.js') }}"></script>
@endpush
