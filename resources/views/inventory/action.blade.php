{{-- @permission('edit-course') --}}
<a class="btn btn-sm btn-primary" href="{{ route('load-single-product-logs', $row['id']) }}">Details</button>

    {{-- <a href="{{ route('inventories.edit', $row['id']) }}" class="btn btn-sm btn-success btn-icon waves-effect waves-light">
    <i class="mdi mdi-lead-pencil"></i>
</a> --}}
    {{-- @endpermission --}}

    {{-- @permission('delete-course') --}}
    {{-- <a href="{{ route('inventories.destroy', $row->id) }}" data-rowid="{{ $row->id }}"
    data-table="inventories-data-table" class="btn btn-sm btn-danger btn-icon waves-effect waves-light delete-record">
    <i class="ri-delete-bin-5-line"></i>
</a> --}}
    {{-- @endpermission --}}

    {{-- @if (!auth()->user()->hasPermission('edit-course') &&
    !auth()->user()->hasPermission('delete-course'))
    <span>N/A</span>
@endif --}}
