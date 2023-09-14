@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->id }}</h5>
                        <div class="flex-shrink-0">
                            <span class="badge bg-success p-2" style="font-size: 15px">Total Price: USD
                                {{ number_format($total_price, 2) }}</span>
                            <span class="badge bg-info p-2" style="font-size: 15px">Order Status:
                                {{ $order->order_status }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">Product Details /產品詳情 </th>
                                    <th scope="col" class="text-center">Spot Price / 現貨價格 </th>
                                    <th scope="col" class="text-center">Markup / 加價金額 </th>
                                    <th scope="col" class="text-center">Total Markup / 總加價金額 </th>
                                    <th scope="col" class="text-center">Total Price / 總價 </th>
                                    <th scope="col" class="text-center">Quantity / 數量 </th>
                                    <th scope="col" class="text-center">Total Amount / 總金額 </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->order_products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                    <img src="{{ $product->product->product_picture_url }}" alt=""
                                                        class="img-fluid d-block">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-15"><a
                                                            class="link-primary">{{ $product->product->name }}</a>
                                                    </h5>
                                                    <p class="text-muted mb-0">SKU: <span
                                                            class="fw-medium">{{ $product->product->sku }}</span></p>
                                                    <p class="text-muted mb-0">Category: <span
                                                            class="fw-medium">{{ $product->product->category->name }}</span>
                                                    </p>
                                                    <p class="text-muted mb-0">Manufacturer: <span
                                                            class="fw-medium">{{ $product->product->manufacturer->name }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- {{ dd($product->toArray()) }} --}}
                                        <td class="fw-medium text-center">USD {{ number_format($product->spot_price, 2) }}
                                        </td>
                                        <td class="fw-medium text-center">
                                            @if ($product->markup_type == 'percentage')
                                                {{ $product->mark_up }} %
                                            @else
                                                USD {{ number_format($product->mark_up, 2) }}
                                            @endif

                                        </td>
                                        {{-- {{ dd($product->toArray()) }} --}}
                                        <td class="fw-medium text-center">
                                            USD {{ number_format($product->product->getProductCommission(), 2) }}
                                        </td>
                                        <td class="fw-medium text-center">USD
                                            {{ number_format($product->price_with_markup, 2) }}</td>
                                        <td class="fw-medium text-center">{{ $product->quantity }}</td>
                                        <td class="fw-medium text-center">
                                            USD {{ number_format($product->total_price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user"
                                    src="{{ asset('theme/dist/default/assets/images/users/user-dummy-img.jpg') }}"
                                    alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <h6 class="fs-14 mb-1">{{ $order->customer->full_name }}</h6>
                                    <p class="text-muted mb-0">Customer</p>
                                </span>
                            </span>
                        </li>
                        <li>
                            <span class="d-flex align-items-center">
                                <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                                <span class="text-start ms-xl-2">
                                    {{ $order->customer->user->email }}
                                </span>
                            </span>
                        </li>
                        <li>
                            <span class="d-flex align-items-center">
                                <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                <span class="text-start ms-xl-2">
                                    {{ $order->phone_number }}
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Commission / 訂單佣金 </h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    {{-- <th scope="col" class="text-center">Tier ID</th> --}}
                                    <th scope="col" class="text-center">Tier Type / 層類型 </th>
                                    <th scope="col" class="text-center">Tier Name / 層名稱 </th>
                                    <th scope="col" class="text-center">Product Name / 產品名稱 </th>
                                    <th scope="col" class="text-center">Product Tier Commission / 產品層級佣金 </th>
                                    <th scope="col" class="text-center">Tier Commission / 層級佣金 </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($order->order_products as $product) --}}
                                @foreach ($order->product_commissions as $commission)
                                    <tr>
                                        {{-- <td class="fw-medium text-center">
                                            {{ isset($commission->tier_id) ? $commission->tier_id : 0 }}
                                        </td> --}}
                                        <td class="fw-medium text-center">
                                            {{ str_replace('_', ' ', ucwords($commission->tier_type)) }}</td>
                                        <td class="fw-medium text-center">
                                            {{ isset($commission->tier->name) ? $commission->tier->name : 'MG Metals' }}
                                        </td>
                                        <td class="fw-medium text-center">{{ $commission->product->name }}</td>
                                        <td class="fw-medium text-center">{{ $commission->tier_commission_percentage }} %
                                            @if (isset($commission->commission_got_percentage))
                                                | {{ $commission->commission_got_percentage }} %
                                            @endif
                                        </td>
                                        <td class="fw-medium text-center">USD
                                            {{ number_format($commission->tier_commission, 2) }}
                                            @if (isset($commission->commission_got))
                                                | USD {{ number_format($commission->commission_got, 2) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @endforeach --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Payment & Invoice Information / 付款和發票信息 </h5>
                        <div class="flex-shrink-0">
                            @if ($order->payment_status == 'UNPAID')
                                <button id="change_payment_status" data-value="{{ $order->id }}"
                                    class="btn btn-warning btn-sm">UN-PAID</button>
                            @endif
                            <span class="badge bg-info p-2" style="font-size: 15px">Payment Status / 支付狀態 :
                                {{ $order->payment_status }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col" class="text-center">Payment Amount / 支付金額 </th>
                                    <th scope="col" class="text-center">Payment Method / 付款方式 </th>
                                    <th scope="col" class="text-center">Payment Status / 支付狀態 </th>
                                    <th scope="col" class="text-center">Payment Due Date / 付款截止日期 </th>
                                    <th scope="col" class="text-center">Remarks / 評論 </th>
                                    <th scope="col" class="text-center">Status Updated By / 狀態更新者 </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="fw-medium text-center">USD {{ number_format($total_price, 2) }}</td>
                                    <td class="fw-medium text-center">{{ $order->payment_method->payment_method }}</td>
                                    <td class="fw-medium text-center">{{ $order->payment_status }}</td>
                                    <td class="fw-medium text-center">
                                        {{ $order->payment_due_date == null ? 'N/A' : Carbon\Carbon::parse($order->payment_due_date)->format('D, M d, Y - h:m A') }}
                                    </td>
                                    <td class="fw-medium text-center">
                                        {{ $order->payment_remarks == null ? 'N/A' : $order->payment_remarks }} </td>
                                    <td class="fw-medium text-center">
                                        {{ $order->payment_status_updated_by == null ? 'N/A' : $order->payment_status_updated_by_relation->name }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0"><i
                                class="ri-map-pin-line align-middle me-1 text-muted"></i> Delivery Information / 配送信息 </h5>
                        <div class="flex-shrink-0">
                            @if ($order->delivery_status == 'PENDING')
                                <button id="change_delivery_status" data-value="{{ $order->id }}"
                                    class="btn btn-warning btn-sm">PENDING</button>
                            @endif
                            <span class="badge bg-info p-2" style="font-size: 15px">Delivery Status / 送達狀態 :
                                {{ $order->delivery_status }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Delivery Method / 運輸方式 - <span
                                    class="fw-normal">{{ ucwords($order->delivery_method->delivery_method) }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Delivery Address / 郵寄地址 - <span
                                    class="fw-medium fs-14">{{ $order->shipping_address }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Customer Name / 顧客姓名 - <span
                                    class="fw-normal">{{ $order->full_name }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Customer Mobile Number / 客戶手機號碼 - <span
                                    class="fw-normal">{{ $order->phone_number }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Customer Email /客戶電子郵件 - <span
                                    class="fw-normal">{{ $order->email }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> City / 城市 - <span
                                    class="fw-normal">{{ $order->city }}-{{ $order->zip_code }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Country / 國家 - <span
                                    class="fw-normal">{{ $order->country }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold">Delivery Due Date / 交貨截止日期 - <span
                                    class="fw-normal">{{ Carbon\Carbon::parse($order->delivery_due_date)->format('D, M d, Y - h:m A') }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Remarks / 評論 - <span
                                    class="fw-normal">{{ $order->delivery_remarks == null ? 'N/A' : ucwords($order->delivery_remarks) }}</span>
                            </h6>
                        </li>
                        <li>
                            <h6 class="fs-15 mb-0 fw-semibold"> Status Updated By / 狀態更新者 - <span
                                    class="fw-normal">{{ $order->delivery_status_updated_by == null ? 'N/A' : $order->delivery_status_updated_by_relation->name }}</span>
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status /訂單狀態 </h5>
                        {{-- <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javasccript:void(0;)" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                    class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span
                                                        class="fw-normal">{{ $order->created_at->format('D, M d, Y - h:m A') }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">An order has been placed.</h6>
                                        <p class="text-muted">{{ $order->created_at->format('D, M d, Y - h:m A') }}</p>

                                        @if ($order->payment_status == 'UNPAID')
                                            <h6 class="mb-1">Customer payment is pending</h6>
                                            <p class="text-muted">
                                                {{ $order->updated_at->format('D, M d, Y - h:m A') }}
                                            </p>
                                        @else
                                            <h6 class="mb-1">Customer payment has been received</h6>
                                            <p class="text-muted">
                                                {{ Carbon\Carbon::parse($order->payment_status_updated_at)->format('D, M d, Y - h:m A') }}
                                            </p>

                                            <h6 class="mb-1">Customer Order is being Confirmed</h6>
                                            <p class="text-muted">
                                                {{ Carbon\Carbon::parse($order->payment_status_updated_at)->format('D, M d, Y - h:m A') }}
                                            </p>
                                        @endif
                                        @if ($order->delivery_status != 'PENDING')
                                            <h6 class="mb-1">Customer delivery is confirmed</h6>
                                            <p class="text-muted">
                                                {{ Carbon\Carbon::parse($order->delivery_status_updated_at)->format('D, M d, Y - h:m A') }}
                                            </p>
                                        @endif
                                        {{-- <h6 class="mb-1">Staff has confirmed your order.</h6>
                                        <p class="text-muted mb-0">
                                            {{ $order->updated_at->format('D, M d, Y - h:m A') }}
                                        </p> --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="mdi mdi-gift-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Packed - <span class="fw-normal">Thu,
                                                        16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">Your Item has been picked up by courier patner</h6>
                                        <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle">
                                                    <i class="ri-truck-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu,
                                                        16 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseFour" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="ri-takeaway-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                        href="#collapseFile" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-light text-success rounded-circle">
                                                    <i class="mdi mdi-package-variant"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).on("click", "#change_payment_status", function(e) {
            var order_id = $(this).data("value");
            e.preventDefault();

            Swal.fire({
                title: "Change Payment Status",
                input: 'text',
                inputLabel: 'Payment Status Remarks',
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
                confirmButtonText: "Change Status",
                cancelButtonClass: 'btn btn-danger w-xs mb-1',
                buttonsStyling: false,
                showCloseButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to write remarks!'
                    }
                }
            }).then(function(response) {
                if (response.value) {
                    $.ajax({
                        url: '/change-payment-state',
                        headers: {
                            "X-CSRF-Token": "{{ csrf_token() }}",
                        },
                        type: "POST",
                        data: {
                            order_id: order_id,
                            remarks: response.value,
                            updated_at: moment().format('YYYY-MM-DD HH:mm:ss')
                        },
                        cache: false,
                        success: function(data) {
                            location.reload(true);
                        },
                        error: function() {},
                    });
                }
            })
        });

        $(document).on("click", "#change_delivery_status", function(e) {
            var order_id = $(this).data("value");
            e.preventDefault();

            Swal.fire({
                title: "Change Delivery Status",
                input: 'text',
                inputLabel: 'Delivery Status Remarks',
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
                confirmButtonText: "Change Status",
                cancelButtonClass: 'btn btn-danger w-xs mb-1',
                buttonsStyling: false,
                showCloseButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to write remarks!'
                    }
                }
            }).then(function(response) {
                if (response.value) {
                    $.ajax({
                        url: '/change-delivery-state',
                        headers: {
                            "X-CSRF-Token": "{{ csrf_token() }}",
                        },
                        type: "POST",
                        data: {
                            order_id: order_id,
                            remarks: response.value,
                            updated_at: moment().format('YYYY-MM-DD HH:mm:ss')
                        },
                        cache: false,
                        success: function(data) {
                            location.reload(true);
                        },
                        error: function() {},
                    });
                }
            })
        });
    </script>
@endpush
