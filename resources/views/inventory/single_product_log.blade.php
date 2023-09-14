@extends('layouts.master')

@section('content')
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Product</h4>
                    <div class="flex-shrink-0">
                        <button class="btn btn-success btn-label btn-sm" id="add_new_inventory">
                            <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add Product Inventory
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Product Details</th>
                                    {{-- <th scope="col">Item Price</th> --}}
                                    <th scope="col">Total Quantity</th>
                                    <th scope="col">Minmum Quantity</th>
                                    {{-- <th scope="col">Markup</th> --}}
                                    {{-- <th scope="col" class="text-end">Product Price</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                <img src="{{ $product->product_picture_url }}" alt=""
                                                    class="img-fluid d-block">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-15"><a class="link-primary">{{ $product->name }}</a>
                                                </h5>
                                                <p class="text-muted mb-0">SKU: <span
                                                        class="fw-medium">{{ $product->sku }}</span></p>
                                                <p class="text-muted mb-0">Category: <span
                                                        class="fw-medium">{{ $product->category->name }}</span>
                                                </p>
                                                <p class="text-muted mb-0">Manufacturer: <span
                                                        class="fw-medium">{{ $product->manufacturer->name }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- {{ dd($product->toArray()) }} --}}
                                    <td>{{ $total_units }}</td>
                                    <td>{{ $product->on_hold }} </td>
                                    {{-- <td>{{ $product->mark_up }}</td> --}}
                                    {{-- <td class="fw-medium text-end">
                                        {{ $product->getProductPrice() }} USD
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12" id="add_new_inv_div" style="display: none">
            <div class="card">
                <div class="card-body">
                    <form class="row  needs-validation" action="{{ route('inventories.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="col-md-4">
                            <div class="form-label-group in-border">
                                <label for="user_id" class="form-label">Products</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('product_id')) is-invalid @endif" name=""
                                    value="{{ $product->name }}" disabled>
                                <input type="text" class="form-control" name="product_id" value="{{ $product->id }}"
                                    hidden>
                                <div class="invalid-tooltip">{{ $errors->first('product_id') }}</div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-label-group in-border">
                                <label for="user_id" class="form-label">Units</label>
                                <input type="number"
                                    class="form-control @if ($errors->has('units')) is-invalid @endif" id="units"
                                    name="units" placeholder="Units" value="{{ old('units') }}">
                                <div class="invalid-tooltip">
                                    {{ $errors->first('units') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-label-group in-border">
                                <label for="user_id" class="form-label">Added By</label>
                                <input type="text"
                                    class="form-control @if ($errors->has('user_id')) is-invalid @endif"
                                    value="{{ \Auth::user()->name }}" readonly>
                                <input type="number" name="user_id" value="{{ \Auth::user()->id }}" hidden>
                                <div class="invalid-tooltip">
                                    {{ $errors->first('user_id') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group in-border">
                                <label for="remarks" class="form-label">Remarks</label>

                                <textarea name="remarks" class="form-control @if ($errors->has('remarks')) is-invalid @endif" id="remarks"
                                    id="" cols="30" rows="10">{{ old('remarks') }}</textarea>
                                <div class="invalid-tooltip">
                                    {{ $errors->first('remarks') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <button id="inv_close_button" type="reset"
                                class="btn btn-light bg-gradient waves-effect waves-light">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Product Inventory Logs / 產品庫存日誌 / 产品库存日志</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="shareholders" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Inventory ID</th>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>Added By</th>
                                <th>Units</th>
                                <th>Action</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                {{-- <th>Delivery Method</th> --}}
                                <th>Spot Price</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $inventories)
                                <tr>
                                    <td>{{ $inventories->id }}</td>
                                    <td>{{ $inventories->product->sku }}</td>
                                    <td>{{ $inventories->product->name }}</td>
                                    @if (isset($inventories->user))
                                        <td>{{ $inventories->user->name }}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    <td>{{ $inventories->units }}</td>
                                    @if ($inventories->order != null)
                                        <td><span class="badge bg-warning">Sold</span></td>
                                        <td>{{ $inventories->order->id }}</td>
                                        <td>{{ $inventories->order->customer->full_name }}</td>
                                        <td>{{ $inventories->order->spot_price }} USD</td>
                                    @else
                                        <td><span class="badge bg-success">Added</span></td>
                                        <td>N /A</td>
                                        <td>N /A</td>
                                        <td>N /A</td>
                                    @endif
                                    <td>{{ $inventories->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __('home_page.no_record_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer_scripts')
    <script type="text/javascript">
        $(document).on('click', '#add_new_inventory', function(e) {
            e.preventDefault();
            document.getElementById('add_new_inv_div').style.display = "block";
        });

        $(document).on('click', '#inv_close_button', function(e) {
            e.preventDefault();
            document.getElementById('add_new_inv_div').style.display = "none";
        });
    </script>
@endpush
