@extends('frontend.layouts.master')

@section('content')
    @include('frontend.customer_commissions.header')

    <section class="page-section pt-5" id="about">
        <div class="container relative">
            <div class="card mt-30 mb-30">
                <div class="card-header">
                    <h5 class="card-title flex-grow-1 mb-0">{{ __('my_commissions.my_commissions') }}</h5>
                </div>
                <div class="card-body">
                    <table class="table  table-striped align-middle table-nowrap mb-0 mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ __('my_commissions.tier_type') }}</th>
                                <th>{{ __('my_commissions.product_name') }}</th>
                                <th>{{ __('my_commissions.product_price') }}</th>
                                {{-- <th>Product Mark Up</th> --}}
                                <th>{{ __('my_commissions.product_tier_comm') }}</th>
                                <th>{{ __('my_commissions.tier_commission') }}</th>
                                <th>{{ __('my_commissions.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($commissions as $commission)
                                <tr>
                                    <td>{{ ucfirst($commission->tier_type) }}</td>
                                    <td>{{ $commission->product->name }}</td>
                                    <td>USD {{ number_format($commission->product_price, 2) }}</td>
                                    {{-- @if ($commission->product->markup_type == 'flat')
                                        <td>USD {{ number_format($commission->product_mark_up, 2) }}</td>
                                    @else
                                        <td>{{ $commission->product_mark_up }} %</td>
                                    @endif --}}
                                    <td>{{ $commission->tier_commission_percentage }} %</td>
                                    <td>USD {{ number_format($commission->tier_commission, 2) }} </td>
                                    <td> {{ $commission->created_at }} </td>
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
