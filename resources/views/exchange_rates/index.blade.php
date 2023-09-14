@extends('layouts.master')

@section('content')
    @include('layouts.flash_message')
    <div class="row">
        @if (isset($exchangeRate))
            @include('exchange_rates.edit')
        @else
            {{-- @permission('add-country') --}}
            @include('exchange_rates.add_new')
            {{-- @endpermission --}}
        @endif
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Exchange Rate / 匯率</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="exchange-rate-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>From Currency</th>
                                <th>To Currency</th>
                                <th>Effective Date</th>
                                <th>Rate</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Abbreviation</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('exchange-rate.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/exchange_rates.js') }}"></script>
@endpush
