<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Delivery Charge</h4>
            </div>

            <div class="card-body">
                <form class="row  needs-validation" action="{{ route('delivery-charges.update', $deliveryCharges->id) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <label for="delivery_method" class="form-label">Delivery Method </label>
                            <select class="form-select form-control @if ($errors->has('delivery_method')) is-invalid @endif"
                                name="delivery_method" required>
                                <option value="" selected disabled
                                    @if ($deliveryCharges->delivery_method == '') {{ 'selected' }} @endif>
                                    Select One
                                </option>
                                <option value="Pick up" @if ($deliveryCharges->delivery_method == 'Pick up') {{ 'selected' }} @endif>
                                    Self Pick
                                </option>
                                <option value="Home Delivery"
                                    @if ($deliveryCharges->delivery_method == 'Home Delivery') {{ 'selected' }} @endif>
                                    Home Delivery
                                </option>
                            </select>
                            <div class="invalid-tooltip">
                                {{ $errors->first('delivery_method') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <label for="user_id" class="form-label">Categories </label>
                            <select class="form-select form-control mb-3" name="category_id">
                                <option value='' @if ($deliveryCharges->category_id == '') {{ 'selected' }} @endif
                                    selected>
                                    Select One
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($deliveryCharges->category_id == $category->id) {{ 'selected' }} @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">Select the Category!</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 mb-3">
                        <div class="form-label-group in-border">
                            <label for="amount" class="form-label">Amount </label>
                            <input type="number"
                                class="form-control @if ($errors->has('amount')) is-invalid @endif" id="amount"
                                name="amount" placeholder="amount" value="{{ $deliveryCharges->amount }}">
                            <div class="invalid-tooltip">
                                {{ $errors->first('amount') }}
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
</div>
