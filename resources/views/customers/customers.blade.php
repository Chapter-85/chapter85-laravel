@extends('layouts.master')

@section('content')
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Customers/顧客</h4>
                {{-- @permission('add-course') --}}
                <div class="flex-shrink-0">
                    <a href="{{ route('customers.create') }}" class="btn btn-success btn-label btn-sm">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New
                    </a>
                </div>
                {{-- @endpermission --}}
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="customers-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>Full name</th>
                                {{-- <th>Email</th> --}}
                                <th>Phone Number</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Email Verified</th>
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
    <input id="ajaxRoute" value="{{ route('customers.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/customers.js') }}"></script>
@endpush
