@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Inventory</h4>
                </div>

                <div class="card-body">
                    <form class="row  needs-validation" action="{{ route('inventories.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="col-md-6">
                            <div class="form-label-group in-border">
                                <label for="user_id" class="form-label">Products</label>
                                <select id="myselect"
                                    class="form-select form-control mb-3 @if ($errors->has('product_id')) is-invalid @endif"
                                    name="product_id" required>
                                    <option value="" @if (old('product_id') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            @if (old('product_id') == $product->id) {{ 'selected' }} @endif>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">{{ $errors->first('product_id') }}</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group in-border">
                                <label for="user_id" class="form-label">Units</label>
                                <input type="number"
                                    class="form-control @if ($errors->has('units')) is-invalid @endif" id="units"
                                    name="units" placeholder="Units" value="{{ old('units') }}">
                                <div class="invalid-tooltip">
                                    {{ $errors->first('units') }}
                                </div>
                            </div>
                        </div>


                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <a href="{{ route('inventories.index') }}" type="button"
                                class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
