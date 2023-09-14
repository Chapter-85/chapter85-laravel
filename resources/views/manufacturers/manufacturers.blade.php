@extends('layouts.master')

@section('content')
    @include('layouts.flash_message')
    <div class="row">
        @if (isset($manufacturer))
            @include('manufacturers.edit_manufacturer')
        @else
            {{-- @permission('add-country') --}}
            @include('manufacturers.add_new_manufacturer')
            {{-- @endpermission --}}
        @endif
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Manufacturers / 製造商 </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="manufacturers-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Abbreviation</th>
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
    <input id="ajaxRoute" value="{{ route('manufacturers.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/manufacturers.js') }}"></script>
@endpush
