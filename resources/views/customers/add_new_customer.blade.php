@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Customers</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('customers.index') }}" class="btn btn-success btn-label btn-sm">
                            <i class="bx bx-arrow-back label-icon align-middle fs-16 me-2"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form class="row  needs-validation" id="myForm" action="{{ route('customers.store') }}"
                        method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Complete Name</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus
                                        placeholder="Complete Name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input id="email" type="email" placeholder="EMAIL"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-label-group in-border">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select form-control mb-3" name="gender" required>
                                        <option value="" @if (old('gender') == '') {{ 'selected' }} @endif
                                            selected disabled>
                                            Select One
                                        </option>
                                        <option value="male" @if (old('gender') == 'male') {{ 'selected' }} @endif>
                                            Male
                                        </option>
                                        <option value="female" @if (old('gender') == 'female') {{ 'selected' }} @endif>
                                            Female
                                        </option>
                                        <option value="other" @if (old('gender') == 'other') {{ 'selected' }} @endif>
                                            Other
                                        </option>
                                    </select>
                                    <div class="invalid-tooltip">Select the gender!</div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <label for="occupation" class="form-label">Occupation and business
                                        background</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('occupation')) is-invalid @endif"
                                        id="occupation" name="occupation" placeholder="Occupation and business background"
                                        value="{{ old('occupation') }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('occupation'))
                                            {{ $errors->first('occupation') }}
                                        @else
                                            Occupation and business background is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <label for="passport_no" class="form-label">HKID NO. / Passport
                                        No.</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                        id="passport_no" name="passport_no" placeholder="HKID NO. / Passport No."
                                        value="{{ old('passport_no') }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('passport_no'))
                                            {{ $errors->first('passport_no') }}
                                        @else
                                            HKID NO. / Passport No. is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mt-3">
                                <div class="form-label-group in-border">
                                    <label for="phone_number" class="form-label">Phone No.</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                        id="phone_number" name="phone_number" placeholder="Phone No."
                                        value="{{ old('phone_number') }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('phone_number'))
                                            {{ $errors->first('phone_number') }}
                                        @else
                                            Phone No. is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mt-3">
                                <label for="">Nationality</label>
                                <div class="form-group">
                                    <select class="form-select form-control " name="nationality" required>
                                        <option value=""
                                            @if (old('nationality') == '') {{ 'selected' }} @endif disabled>
                                            NATIONALITY
                                        </option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->name }}"
                                                @if (old('nationality') == $nationality->name) {{ 'selected' }} @endif>
                                                {{ $nationality->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group mt-2">
                                    <label for="">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group mt-2">
                                    <label for="">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        placeholder="Confirm Password" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-12 col-md-12 mt-3 mb-3">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea id="address" name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif"
                                        placeholder="ADDRESS">{{ old('address') }}</textarea>

                                </div>
                            </div>

                            <div class="col-12 col-md-12 mt-3 mb-3" style="display: none">
                                <label for="">Customer Type/顧客類型</label>
                                <div class="form-group">
                                    <label class="radio-inline mr-3">
                                        <input type="radio" name="customer_type" value="individual" checked>
                                        <span></span>Individual
                                    </label>

                                </div>
                            </div>
                        </div>


                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <a href="{{ route('customers.index') }}" type="button"
                                class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
