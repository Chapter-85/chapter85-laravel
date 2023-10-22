<a href="{{ route('product-sizes.edit', $row->id) }}" class="btn btn-sm btn-success btn-icon waves-effect waves-light">
    <i class="mdi mdi-lead-pencil"></i>
</a>

<a href="{{ route('product-sizes.destroy', $row->id) }}" data-rowid="{{ $row->id }}"
    data-table="product-sizes-data-table" class="btn btn-sm btn-danger btn-icon waves-effect waves-light delete-record">
    <i class="ri-delete-bin-5-line"></i>
</a>
