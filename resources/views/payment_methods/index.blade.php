@extends('layouts.master')

@push('header_scripts')
    <link href="{{ asset('theme/dist/default/assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/dist/default/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row">
        {{-- @if (isset($paymentMethod))
            @include('payment_methods.edit')
        @else --}}
        {{-- @permission('add-country') --}}
        {{-- @include('payment_methods.add_new') --}}
        {{-- @endpermission --}}
        {{-- @endif --}}
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Payment Method Setup</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('payment-methods.create') }}" class="btn btn-success btn-label btn-sm">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="payment-methods-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Payment Method</th>
                                {{-- <th style="width: 5%">Description</th> --}}
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('payment-methods.index') }}" hidden />
@endsection
@push('footer_scripts')
    <script src="{{ asset('theme/dist/default/assets/libs/quill/quill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('modules/payment_methods.js') }}"></script>
@endpush
