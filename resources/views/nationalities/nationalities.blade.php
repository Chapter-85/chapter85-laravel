@extends('layouts.master')

@section('content')
    <div class="row">
        @if (isset($nationality))
            @include('nationalities.edit')
        @else
            {{-- @permission('add-country') --}}
            @include('nationalities.add_new')
            {{-- @endpermission --}}
        @endif
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Nationalities / 國籍</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="nationalities-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('nationalities.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/nationalities.js') }}"></script>
@endpush
