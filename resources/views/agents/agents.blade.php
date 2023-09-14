@extends('layouts.master')

@section('content')
    <div class="row">
        @if (isset($agent))
            @include('agents.edit_agent')
        @else
            {{-- @permission('add-country') --}}
            @include('agents.add_new_agent')
            {{-- @endpermission --}}
        @endif
        <div class="col-lg-12">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Agents</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="agents-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Parent ID</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Parent ID</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input id="ajaxRoute" value="{{ route('agents.index') }}" hidden />
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/agents.js') }}"></script>
@endpush
