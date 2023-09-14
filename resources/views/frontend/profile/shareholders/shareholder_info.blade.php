<div class="card card-default">
    <div class="card-header">
        {{ __('shareholder.SECTION 2B') }} <span>{{ __('shareholder.SHAREHOLDER/DIRECTOR INFORMATION') }}</span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-12">
                <label class="form-label">{{ __('shareholder.SHAREHOLDER/DIRECTOR') }}</label>
            </div>
        </div>
        <form class="row  needs-validation" action="{{ route('customer-shareholders.store', $customer->id) }}"
            method="POST" novalidate>
            @csrf
            <input type="text" name="form_info" value="shareholder" hidden>
            <input type="text" id="customer_id" name="customer_id" value="{{ $customer->id }}" hidden>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('shareholder.full_name') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control  @if ($errors->has('name')) is-invalid @endif"
                    placeholder="{{ __('shareholder.full_name') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('shareholder.title') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="title" value="{{ old('title') }}"
                    class="form-control @if ($errors->has('title')) is-invalid @endif"
                    placeholder="{{ __('shareholder.title') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('shareholder.email') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" value="{{ old('email') }}" name="email"
                    class="form-control @if ($errors->has('email')) is-invalid @endif"
                    placeholder="{{ __('shareholder.email') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
                {{-- </div> --}}
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('shareholder.phone_number') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                    class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                    placeholder="{{ __('shareholder.phone_number') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('shareholder.passport_no') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="passport_no" value="{{ old('passort_no') }}"
                    class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                    placeholder="{{ __('shareholder.passport_no') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('passport_no') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('shareholder.nationality') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="nationality" value="{{ old('nationality') }}"
                    class="form-control @if ($errors->has('nationality')) is-invalid @endif"
                    placeholder="{{ __('shareholder.nationality') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nationality') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-12 mb-3">
                <label class="form-label">{{ __('shareholder.address') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="address" value="{{ old('address') }}"
                    class="form-control @if ($errors->has('address')) is-invalid @endif"
                    placeholder="{{ __('shareholder.address') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('address') }}</strong>
                </div>
                {{-- </div> --}}
            </div>

            <div class="footer d-flex mt-20">
                <a href="{{ route('customer-profile-data.edit', $customer->id) . '?tab=corporate' }}"
                    class="btn btn-custom">{{ __('home_page.previous') }}</a>
                <div class="ml-auto">
                    <button class="btn btn-default" type="reset">{{ __('home_page.cancel') }}</button>
                    <button class="btn btn-custom" type="submit">{{ __('home_page.save') }}</button>
                    <a href="{{ route('customer-profile-data.edit', $customer->id) . '?tab=trading' }}"
                        class="btn btn-custom">{{ __('home_page.next') }} </a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card card-default mt-20">
    <div class="card-body">
        <table class="table table-striped align-middle table-nowrap mb-0 mb-4">
            <thead>
                <tr>
                    <th>{{ __('shareholder.full_name') }}</th>
                    <th>{{ __('shareholder.title') }}</th>
                    <th style="width:12%">{{ __('shareholder.email') }}</th>
                    <th style="width:12%">{{ __('shareholder.phone_number') }}</th>
                    <th style="width:20%">{{ __('shareholder.passport_no') }}</th>
                    <th style="width:12%">{{ __('shareholder.nationality') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($shareholders as $shareholder)
                    <tr>
                        <td>{{ $shareholder->name }}</td>
                        <td>{{ $shareholder->title }}</td>
                        <td>{{ $shareholder->email }}</td>
                        <td>{{ $shareholder->phone_number }}</td>
                        <td>{{ $shareholder->passport_no }}</td>
                        <td>{{ $shareholder->nationality }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">{{ __('home_page.no_record_found') }}</td>
                    </tr>
                @endforelse
            </tbody>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
