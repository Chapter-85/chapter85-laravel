@extends('layouts.master')

@section('content')
    <div class="row">
        {{-- @if (isset($inventory))
            @include('inventory.edit_inventory')
        @else --}}
        {{-- @permission('add-country') --}}
        {{-- @include('inventory.add_new_inventory') --}}
        {{-- @endpermission --}}
        {{-- @endif --}}
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Products Inventory List / 產品庫存清單 / 产品库存清单</h4>
                {{-- <div class="flex-shrink-0">
                    <a href="{{ route('inventories.create') }}" class="btn btn-success btn-label btn-sm">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New
                    </a>
                </div> --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="inventories-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr.#</th>
                                <th>SKU</th>
                                {{-- <th>Product ID</th> --}}
                                <th>Product Name</th>
                                {{-- <th>Order ID</th> --}}
                                <th>Available Units</th>
                                <th>Minimum Quantity</th>
                                {{-- <th>Created At</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>Sr.#</th>
                                <th>SKU</th>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Order ID</th>
                                <th>Units</th>
                                <th>Minimum Quantity</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('inventories.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/inventories.js') }}"></script>
@endpush
