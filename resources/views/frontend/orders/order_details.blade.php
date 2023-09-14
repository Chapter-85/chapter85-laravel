@extends('frontend.layouts.master')

@section('content')
    @include('frontend.orders.header')

    <section class="page-section">
        <div class="container">
            <div class="card mt-30 mb-30">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">{{ __('my_order.order') }} #{{ $order->id }}</h5>
                        <div class="flex-shrink-0">
                            <span class=""> {{ __('my_order.total_price') }}: USD
                                {{ number_format($total_price, 2) }} </span>
                            <span class="badge bg-info p-2" style="font-size: 15px">{{ __('my_order.order_status') }}:
                                {{ $order->order_status }}</span>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col">{{ __('my_order.product_details') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.total_price') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.quantity') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.total_amount') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->order_products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1"
                                                    style="height: 5.5rem;width: 5.5rem;">
                                                    <img src="{{ $product->product->product_picture_url }}" alt=""
                                                        class="img-fluid d-block">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="fs-15"><a
                                                            class="link-primary">{{ $product->product->name }}</a>
                                                    </h5>
                                                    <p class="text-muted mb-0">{{ __('my_order.sku') }}: <span
                                                            class="fw-medium">{{ $product->product->sku }}</span></p>
                                                    <p class="text-muted mb-0">{{ __('my_order.category') }}: <span
                                                            class="fw-medium">{{ $product->product->category->name }}</span>
                                                    </p>
                                                    <p class="text-muted mb-0">{{ __('my_order.manufacturer') }}: <span
                                                            class="fw-medium">{{ $product->product->manufacturer->name }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- {{ dd($product->toArray()) }} --}}
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

            <div class="card mb-30">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">{{ __('my_order.payment_invoice') }}</h5>
                        <div class="flex-shrink-0">
                            <span class="badge bg-info p-2" style="font-size: 15px">{{ __('my_order.payment_status') }}:
                                {{ $order->payment_status }}</span>
                            @if ($order->payment_status == 'PAID')
                                <span class="badge bg-success p-2" style="font-size: 15px">Received</span>
                            @else
                                <span class="badge bg-warning p-2" style="font-size: 15px">{{ __('my_order.due_date') }}:
                                    {{ $order->payment_due_date }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col" class="text-center">{{ __('my_order.payment_amount') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.payment_method') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.payment_status') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.payment_due_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="fw-medium text-center">USD {{ number_format($total_price, 2) }}</td>
                                    <td class="fw-medium text-center">{{ $order->payment_method->payment_method }}</td>
                                    <td class="fw-medium text-center">{{ $order->payment_status }}</td>
                                    <td class="fw-medium text-center">
                                        {{ $order->payment_due_date == null ? 'N/A' : $order->payment_due_date }} </td>

                                </tr>
                                @if (strtolower($order->payment_method->payment_method) != 'credit card')
                                    <tr>
                                        @if (Config::get('app.locale') == 'en')
                                            {!! $order->payment_method->description !!}
                                        @elseif (Config::get('app.locale') == 'ch')
                                            {!! $order->payment_method->description_ch !!}
                                        @else
                                            {!! $order->payment_method->description_s_ch !!}
                                        @endif

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-30">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">{{ __('my_order.delivery_information') }}</h5>
                        <div class="flex-shrink-0">
                            <span class="badge bg-info p-2" style="font-size: 15px">{{ __('my_order.delivery_status') }}:
                                {{ $order->delivery_status }}</span>
                            <span class="badge bg-warning p-2" style="font-size: 15px">{{ __('my_order.due_date') }}:
                                {{ $order->delivery_due_date }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th scope="col" class="text-center">{{ __('my_order.delivery_method') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.delivery_status') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.delivery_address') }}</th>
                                    <th scope="col" class="text-center">{{ __('my_order.delivery_due_date') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="fw-medium text-center">{{ $order->delivery_method->delivery_method }}</td>
                                    <td class="fw-medium text-center">{{ $order->delivery_status }}</td>
                                    <td class="fw-medium text-center">{{ $order->shipping_address }}</td>
                                    <td class="fw-medium text-center">
                                        {{ $order->delivery_due_date == null ? 'N/A' : $order->delivery_due_date }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
