@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Update Customer</h4>
                    <div class="flex-shrink-0">
                        @if ($user->is_verified == 1)
                            <button id="verified" value="{{ $user->id }}" data-url="{{ route('verify-user') }}"
                                class="btn btn-sm btn-success btn-label waves-effect waves-light"><i
                                    class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Active</button>
                        @else
                            <button id="unverified" value="{{ $user->id }}" data-url="{{ route('verify-user') }}"
                                class="btn btn-sm btn-warning btn-label waves-effect waves-light"><i
                                    class="ri-error-warning-line label-icon align-middle fs-16 me-2"></i> In-Active</button>
                        @endif
                        <a href="{{ route('customers.index') }}" class="btn btn-success btn-label btn-sm">
                            <i class="bx bx-arrow-back label-icon align-middle fs-16 me-2"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form class="row  needs-validation" action="{{ route('customers.update', $customer->id) }}"
                        method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="customer_type" value="{{ $user->customer_type }}">

                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-label-group in-border">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('full_name')) is-invalid @endif"
                                        id="full_name" name="full_name" placeholder="Full name"
                                        value="{{ $customer->full_name }}" required>
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('full_name'))
                                            {{ $errors->first('full_name') }}
                                        @else
                                            Full Name is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-label-group in-border">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        id="email" name="email" placeholder="Email Address"
                                        value="{{ $customer->user->email }}" disabled>
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('email'))
                                            {{ $errors->first('email') }}
                                        @else
                                            Full Name is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-label-group in-border">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select form-control mb-3" name="gender" required>
                                        <option value="" @if ($customer->gender == '') {{ 'selected' }} @endif
                                            selected disabled>
                                            Select One
                                        </option>
                                        <option value="male"
                                            @if ($customer->gender == 'male') {{ 'selected' }} @endif>
                                            Male
                                        </option>
                                        <option value="female"
                                            @if ($customer->gender == 'female') {{ 'selected' }} @endif>
                                            Female
                                        </option>
                                        <option value="other"
                                            @if ($customer->gender == 'other') {{ 'selected' }} @endif>
                                            Other
                                        </option>
                                    </select>
                                    <div class="invalid-tooltip">Select the gender!</div>
                                </div>
                            </div>



                            {{-- <div class="col-md-1 mt-4">
                                @if ($user->is_email_verified != 1)
                                    <button id="verify_email" value="{{ $user->id }}"
                                        data-url="{{ route('verification-email') }}" class="btn btn-success">
                                        Verify Email</button>
                                @endif
                            </div> --}}

                            <div class="col-md-4 col-sm-12">
                                <div class="form-label-group in-border">
                                    <label for="occupation" class="form-label">Occupation and business
                                        background</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('occupation')) is-invalid @endif"
                                        id="occupation" name="occupation" placeholder="Occupation and business background"
                                        value="{{ $customer->occupation }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('occupation'))
                                            {{ $errors->first('occupation') }}
                                        @else
                                            Occupation and business background is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <div class="form-label-group in-border">
                                    <label for="passport_no" class="form-label">ID / Passport
                                        No.</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                        id="passport_no" name="passport_no" placeholder="ID / Passport No."
                                        value="{{ $customer->passport_no }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('passport_no'))
                                            {{ $errors->first('passport_no') }}
                                        @else
                                            ID / Passport No. is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <label for="phone_number" class="form-label">Phone No.</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                        id="phone_number" name="phone_number" placeholder="Phone No."
                                        value="{{ $customer->phone_number }}">
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('phone_number'))
                                            {{ $errors->first('phone_number') }}
                                        @else
                                            Phone No. is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="">Nationality</label>
                                <div class="form-group">
                                    <select class="form-select" name="nationality" required>
                                        <option value=""
                                            @if ($customer->nationality == '') {{ 'selected' }} @endif disabled>
                                            Nationality
                                        </option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->name }}"
                                                @if ($customer->nationality == $nationality->name) {{ 'selected' }} @endif>
                                                {{ $nationality->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            {{-- <div class="col-md-4 col-sm-12 mt-3">
                                <div class="form-label-group in-border">
                                    <label for="passport_no" class="form-label">Referral Code</label>
                                    <input type="text" class="form-control" id="" name=""
                                        placeholder="" value="{{ $customer->user->referral_code }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 mt-5">
                                @if ($user->show_referral_code == 1)
                                    <button id="hide" value="{{ $user->id }}"
                                        data-url="{{ route('show-referral-code') }}"
                                        class="btn btn-sm btn-success btn-label waves-effect waves-light"><i
                                            class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>
                                        Hide Referral
                                        Code</button>
                                @else
                                    <button id="show" value="{{ $user->id }}"
                                        data-url="{{ route('show-referral-code') }}"
                                        class="btn btn-sm btn-warning btn-label waves-effect waves-light"><i
                                            class="ri-error-warning-line label-icon align-middle fs-16 me-2"></i>
                                        Show Referral
                                        Code</button>
                                @endif
                            </div> --}}

                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea id="address" name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif"
                                        placeholder="ADDRESS">{{ $customer->address }}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mt-3 text-end">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                <a href="{{ route('customers.index') }}" type="button"
                                    class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer_scripts')
    <script type="text/javascript" src="{{ asset('modules/customers.js') }}"></script>
@endpush
