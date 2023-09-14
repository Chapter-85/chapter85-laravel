{{-- <div class="row"> --}}
<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Add Delivery Charge / 加入送達費用</h4>
        </div>

        <div class="card-body">
            <form class="row  needs-validation" action="{{ route('delivery-charges.store') }}" method="POST" novalidate>
                @csrf
                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <label for="delivery_method" class="form-label">Delivery Method (送達方式)</label>
                        <select class="form-select form-control @if ($errors->has('delivery_method')) is-invalid @endif"
                            name="delivery_method" required>
                            <option value="" selected disabled
                                @if (old('delivery_method') == '') {{ 'selected' }} @endif>
                                Select One
                            </option>
                            <option value="Pick up" @if (old('delivery_method') == 'Pick up') {{ 'selected' }} @endif>
                                Self Pick
                            </option>
                            <option value="Home Delivery" @if (old('delivery_method') == 'Home Delivery') {{ 'selected' }} @endif>
                                Home Delivery
                            </option>
                            <option value="Keep with MG" @if (old('delivery_method') == 'Keep with MG') {{ 'selected' }} @endif>
                                Keep with MG
                            </option>
                        </select>
                        <div class="invalid-tooltip">
                            {{ $errors->first('delivery_method') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-label-group in-border">
                        <label for="user_id" class="form-label">Categories (類別)</label>
                        <select class="form-select form-control mb-3" name="category_id">
                            <option value='' @if (old('category_id') == '') {{ 'selected' }} @endif
                                selected>
                                Select One
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if (old('category_id') == $category->id) {{ 'selected' }} @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-tooltip">Select the Category!</div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <label for="amount" class="form-label">Amount (金額)</label>
                        <input type="number" class="form-control @if ($errors->has('amount')) is-invalid @endif"
                            id="amount" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                        <div class="invalid-tooltip">
                            {{ $errors->first('amount') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-label-group in-border">
                        <label for="time_duration" class="form-label">Time Duration (時長)</label>
                        <select class="form-select form-control mb-3" name="time_duration" required>
                            <option value="" @if (old('time_duration') == '') {{ 'selected' }} @endif
                                selected disabled>
                                Select One
                            </option>
                            <option value="daily" @if (old('time_duration') == 'daily') {{ 'selected' }} @endif>
                                Daily
                            </option>
                            <option value="monthly" @if (old('time_duration') == 'monthly') {{ 'selected' }} @endif>
                                Monthly
                            </option>
                            <option value="annual" @if (old('time_duration') == 'annual') {{ 'selected' }} @endif>
                                Annual
                            </option>

                        </select>
                        <div class="invalid-tooltip">
                            {{ $errors->first('time_duration') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <label for="grace_period" class="form-label">Grace Period (寬限期)</label>
                        <input type="text" class="form-control @if ($errors->has('grace_period')) is-invalid @endif"
                            id="grace_period" name="grace_period" placeholder="Grace Period"
                            value="{{ old('grace_period') }}">
                        <div class="invalid-tooltip">
                            {{ $errors->first('grace_period') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <label for="charge_at_beginning" class="form-label">Charge At Beginning (在最初付費)</label>
                        <input type="number" class="form-control @if ($errors->has('charge_at_beginning')) is-invalid @endif"
                            id="charge_at_beginning" name="charge_at_beginning" placeholder="Charge At Beginning"
                            value="{{ old('charge_at_beginning') }}">
                        <div class="invalid-tooltip">
                            {{ $errors->first('charge_at_beginning') }}
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
{{-- </div> --}}
