@extends('frontend.layouts.master')

@section('content')
    @include('frontend.my_referrals.header')

    <section class="page-section pt-5" id="about">
        <div class="container relative">
            <div class="card mt-30 mb-30">
                <div class="card-header">
                    <h5 class="card-title flex-grow-1 mb-0">{{ __('my_referrals.my_referrals') }}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped align-middle table-nowrap mb-0 mb-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ __('my_referrals.customer_id') }}</th>
                                <th>{{ __('my_referrals.customer_name') }}</th>
                                <th>{{ __('my_referrals.customer_email') }}</th>
                                <th>{{ __('my_referrals.customer_gender') }}</th>
                                <th>{{ __('my_referrals.customer_occupation') }}</th>
                                {{-- <th>Agent Code</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($referrals as $referral)
                                <tr>
                                    <td>{{ $referral->id }}</td>
                                    <td>{{ $referral->name }}</td>
                                    <td>{{ $referral->email }}</td>
                                    <td>{{ $referral->customer->gender }}</td>
                                    <td>{{ $referral->customer->occupation }}</td>
                                    {{-- <td>{{ $referral->referral_code }}</td> --}}
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
