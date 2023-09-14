@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Products Commission / 產品委員會 </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <form method="GET" id="filterForm" class="mt-3">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label>Users / 用戶 / 用户</label>
                                        <select class="form-control filter" id="user_id" name="user_id">
                                            <option value="" selected disabled>Please Select</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <div class="form-label-group in-border">
                                        <label for="date_range" class="form-label">Date</label>
                                        <input class="form-control filter" name="date_range" id="date_range">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 col-sm-12 mb-3">
                                    <div class="form-label-group in-border">
                                        <label for="search" class="form-label">Search</label>
                                        <input class="form-control filter" placeholder="Search" name="search"
                                            id="search">
                                    </div>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                    <table id="products-commission-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>Customer ID</th> --}}
                                <th>Customer name</th>
                                <th>Tier Type</th>
                                <th>Tier Name</th>
                                <th>Product SKU</th>
                                <th>Product name</th>
                                <th>Product Price</th>
                                <th>Product Mark up</th>
                                <th>Product Tier Commission</th>
                                <th>Tier Commission</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer name</th>
                                <th>Tier Type</th>
                                <th>Product ID</th>
                                <th>Product name</th>
                                <th>Product Price</th>
                                <th>Product Mark up</th>
                                <th>Product Tier Commission</th>
                                <th>Tier Commission</th>
                                <th>Created At</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('product-commission.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/product_commission.js') }}"></script>
@endpush
