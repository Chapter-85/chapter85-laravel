@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Customer Products</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="customer-product-data-table"
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
    <input id="customerID" value="{{ $customerID }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script>
        $(document).ready(function() {
            var id = $("#customerID").val();
            $("#customer-product-data-table").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"],
                ],
                scrollX: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search...",
                },
                ajax: '/customer-product-ajax/' + id,
                columns: [
                    // {
                    //     data: "customer_id",
                    //     name: "customer_id",
                    // },
                    {
                        data: "customer.full_name",
                        name: "customer.full_name",
                    },
                    // {
                    //     data: "product_id",
                    //     name: "product_id",
                    // },
                    {
                        data: "product.name",
                        name: "product.name",
                    },
                    {
                        data: "purchase_price",
                        name: "purchase_price",
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        width: "15%",
                    },
                ],
            });
        });
    </script>
@endpush
