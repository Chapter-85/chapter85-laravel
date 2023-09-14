@extends('frontend.layouts.master')

@section('content')
    @include('frontend.orders.header')

    <section class="page-section pt-5" id="about">
        <div class="container relative">
            <div class="card mt-30 mb-30">
                <div class="card-header">
                    <h5 class="card-title flex-grow-1 mb-0">{{ __('my_order.my_orders') }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped align-middle table-nowrap mb-0 mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ __('my_order.order_id') }}</th>
                                {{-- <th>Product Title</th> --}}
                                <th>{{ __('my_order.payment_status') }}</th>
                                <th>{{ __('my_order.delivery_status') }}</th>
                                <th>{{ __('my_order.sales_amount') }}</th>
                                <th>{{ __('my_order.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    {{-- <td>{{ $order->quantity }}</td> --}}
                                    <td>{{ $order->payment_status }}
                                    </td>
                                    <td>{{ $order->delivery_status }}</td>

                                    @if ($order->total_price == null)
                                        <td>USD 0 </td>
                                    @else
                                        <td>USD {{ number_format($order->total_price, 2) }} </td>
                                    @endif
                                    <td><a href="{{ route('get-customer-order-details', $order->id) }}"
                                            class="btn btn-sm btn-icon waves-effect waves-light">
                                            Details
                                        </a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">{{ __('home_page.no_record_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
