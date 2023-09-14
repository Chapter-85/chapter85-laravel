<div class="card card-default ">
    <div class="card-header">
        {{ __('individual.SECTION 1') }} <span>{{ __('individual.APPLICANT INFORMATION (INDIVIDUAL)') }}
        </span>
    </div>
    <div class="card-body">
        <form class="row  needs-validation" action="{{ route('customer-profile-data.update', $customer->id) }}"
            method="POST" novalidate>
            @csrf
            @method('PUT')
            {{-- <input type="text" name="user_id" value="{{ $customer->id }}" hidden> --}}
            <input type="text" name="form_info" value="individual" hidden>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.FULL NAME OF INDIVIDUAL') }} *</label>
                {{-- <div class="form-group"> --}}
                <input type="text" class="form-control @if ($errors->has('full_name')) is-invalid @endif"
                    id="full_name" name="full_name" placeholder="{{ __('individual.FULL NAME OF INDIVIDUAL') }}"
                    value="@if ($customer->full_name) {{ $customer->full_name }}
                        @else
                        {{ old('full_name') }} @endif"
                    required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('full_name') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.gender') }}
                    *</label>
                <div class="form-group ht-70">
                    <label class="radio-inline mr-3 me-3 @if ($errors->has('gender')) is-invalid @endif">
                        <input type="radio" name="gender" value="male"
                        @if ($customer->gender) @if ($customer->gender == 'male') checked @endif @else
                            @if (old('gender') == 'male') checked @endif @endif>
                        <span></span>{{ __('individual.MALE') }}
                    </label>
                    <label class="radio-inline mr-3 me-3 ">
                        <input type="radio" name="gender" value="female"
                        @if ($customer->gender) @if ($customer->gender == 'female') checked @endif @else
                            @if (old('gender') == 'female') checked @endif @endif>
                        <span></span>{{ __('individual.FEMALE') }}
                    </label>
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.Email') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="email @if ($errors->has('email')) is-invalid @endif" id="email"
                    value="{{ \Auth::user()->email }}" name="email" class="form-control"
                    placeholder="{{ __('individual.Email') }}" disabled>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('full_name') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.Occupation & Business Background') }} *</label>
                {{-- <div class="form-group"> --}}
                <input type="text" class="form-control @if ($errors->has('occupation')) is-invalid @endif"
                    name="occupation" id="occupation"
                    value="@if ($customer->occupation) {{ $customer->occupation }}@else{{ old('occupation') }} @endif"
                    placeholder="{{ __('individual.Occupation & Business Background') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('occupation') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.HKID No. / Passport No.') }} *</label>
                {{-- <div class="form-group"> --}}
                <input type="text" class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                    id="passport_no" name="passport_no"
                    value="@if ($customer->passport_no) {{ $customer->passport_no }}@else{{ old('passport_no') }} @endif"
                    placeholder="{{ __('individual.HKID No. / Passport No.') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('passport_no') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-2 col-md-2 mb-3">
                <label class="form-label">Country Code *</label>
                {{-- <div class="form-group"> --}}
                <input type="text" id="country_code" name="country_code"
                    value="@if ($customer->country_code) {{ $customer->country_code }}@else{{ old('country_code') }} @endif"
                    class="form-control @if ($errors->has('country_code')) is-invalid @endif" placeholder="+86"
                    required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('country_code') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-10 col-md-4 mb-3">
                <label class="form-label">{{ __('individual.PHONE NUMBER') }} *</label>
                {{-- <div class="form-group"> --}}
                <input type="text" id="phone_number" name="phone_number"
                    value="@if ($customer->phone_number) {{ $customer->phone_number }}@else{{ old('phone_number') }} @endif"
                    class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                    placeholder="{{ __('individual.PHONE NUMBER') }}" required>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.Nationality') }} *</label>
                {{-- <div class="form-group"> --}}
                <select class="form-select form-control @if ($errors->has('nationality')) is-invalid @endif"
                    name="nationality" required>
                    <option value="" @if ($customer->nationality == '') {{ 'selected' }} @endif disabled>
                        {{ __('individual.Nationality') }}
                    </option>

                    @foreach ($nationalities as $nationality)
                        <option value="{{ $nationality->name }}"
                            @if ($customer->nationality) @if ($customer->nationality == $nationality->name) {{ 'selected' }} @endif
                        @else @if (old('nationality') == $nationality->name) {{ 'selected' }} @endif @endif>
                            @if (Config::get('app.locale') == 'en')
                                {{ $nationality->name }}
                            @elseif (Config::get('app.locale') == 'ch')
                                {{ $nationality->name_ch }}
                            @else
                                {{ $nationality->name_s_ch }}
                            @endif
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('nationality') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-12 mb-3">
                <label class="form-label">{{ __('individual.ADDRESS') }} *</label>
                {{-- <div class="form-group"> --}}
                <textarea id="address" name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif"
                    placeholder="{{ __('individual.ADDRESS') }}">{{ $customer->address ? $customer->address : old('address') }}</textarea>
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('address') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('individual.status') }}</label>
                <input type="text" id="is_verified" class="form-control"
                    placeholder=@if (Auth::user()->is_verified == 0) {{ __('individual.unverified') }} @else {{ __('individual.verified') }} @endif
                    disabled>
            </div>
            {{-- <div class="col-12 col-md-4 mb-3">
                <label class="form-label">{{ __('individual.referred_by') }}</label>
                <input type="text" id="is_verified" class="form-control"
                    placeholder='{{ Auth::user()->referred_by }}' disabled>
            </div> --}}
            @if (\Auth::user()->show_referral_code == 1)
                <div class="col-12 col-md-6 mb-3">
                    <label class="form-label">{{ __('individual.referral_code') }}</label>
                    <input type="text" id="is_verified" class="form-control"
                        placeholder='{{ Auth::user()->referral_code }}' disabled>
                </div>
            @endif
            @if (\Auth::user()->customer_type == 'corporate')
                <div class="footer mt-20  d-flex">
                    <button class="btn btn-custom" disabled="true">{{ __('home_page.previous') }}</button>
                    <div class="ml-auto">
                        <button class="btn btn-default" type="reset">{{ __('home_page.cancel') }}</button>
                        <button class="btn btn-custom" type="submit"
                            id="next">{{ __('home_page.next') }}</button>
                    </div>
                </div>
            @else
                {{-- <button class="btn btn-default" type="reset"></button> --}}
                <div class="footer mt-20 text-end" style="display: block;">
                    <button class="btn btn-default" type="reset">{{ __('home_page.cancel') }}</button>
                    <button class="btn btn-custom ml-3 ms-3" type="submit"
                        id="next">{{ __('home_page.save') }}</button>
                </div>
            @endif
        </form>
    </div>
</div>
