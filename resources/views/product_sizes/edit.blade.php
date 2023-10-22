<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Update Product Sizes</h4>
        </div>

        <div class="card-body">
            <form class="row  needs-validation" action="{{ route('product-sizes.update', $product_sizes->id) }}"
                method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="col-md-6 col-sm-12">
                    <div class="form-label-group in-border">
                        <label for="product_id" class="form-label">Products</label>
                        <select class="form-select form-control mb-3" name="product_id" required>
                            <option value="" @if ($product_sizes->product_id == '') {{ 'selected' }} @endif selected
                                disabled>
                                Select One
                            </option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    @if ($product_sizes->product_id == $product->id) {{ 'selected' }} @endif>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">
                            @if ($errors->has('product_id'))
                                {{ $errors->first('product_id') }}
                            @else
                                Select the Category!
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="form-label-group in-border">
                        <label for="size" class="form-label">Size</label>
                        <input type="number" class="form-control @if ($errors->has('size')) is-invalid @endif"
                            id="size" name="size" placeholder="Please enter" value="{{ $product_sizes->size }}">

                        <div class="invalid-tooltip">
                            @if ($errors->has('size'))
                                {{ $errors->first('size') }}
                            @else
                                Size is required!
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                    <a href="{{ route('agents.index') }}" type="button"
                        class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
