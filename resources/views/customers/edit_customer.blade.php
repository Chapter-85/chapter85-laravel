@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Update Customer</h4>
                    <div class="flex-shrink-0">
                        @if ($user->customer_type == 'corporate')
                            <button type="button" class="btn btn-sm btn-success " data-bs-toggle="modal"
                                value="{{ $customer->id }}" id="shareholders" data-url="{{ route('load-shareholders') }}"
                                data-target="#shareholderModel">Shareholders</button>

                            <button type="button" class="btn btn-sm btn-success " data-bs-toggle="modal"
                                value="{{ $customer->id }}" id="trading" data-url="{{ route('load-trading') }}"
                                data-target="#tradingModel">Authorized
                                Trading Representative</button>
                        @endif
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
                        @if ($user->customer_type == 'corporate')
                            <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-primary"
                                id="accordionBordered">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="accordionborderedExample1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#accor_borderedExamplecollapse1" aria-expanded="true"
                                            aria-controls="accor_borderedExamplecollapse1">
                                            Sec#1 Applicant Info
                                        </button>
                                    </h2>
                                    <div id="accor_borderedExamplecollapse1" class="accordion-collapse collapse show"
                                        aria-labelledby="accordionborderedExample1" data-bs-parent="#accordionBordered">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-12">
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

                                                <div class="col-md-4">
                                                    <div class="form-label-group in-border">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <select class="form-select form-control mb-3" name="gender"
                                                            required>
                                                            <option value=""
                                                                @if ($customer->gender == '') {{ 'selected' }} @endif
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

                                                <div class="col-md-3 col-sm-12">
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
                                                                Email is required!
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 mt-4">
                                                    @if ($user->is_email_verified != 1)
                                                        <button id="verify_email" value="{{ $user->id }}"
                                                            data-url="{{ route('verification-email') }}"
                                                            class="btn btn-success">
                                                            Verify Email</button>
                                                    @endif
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-label-group in-border">
                                                        <label for="occupation" class="form-label">Occupation and business
                                                            background</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('occupation')) is-invalid @endif"
                                                            id="occupation" name="occupation"
                                                            placeholder="Occupation and business background"
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
                                                        <label for="passport_no" class="form-label">HKID NO. / Passport
                                                            No.</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                                            id="passport_no" name="passport_no"
                                                            placeholder="HKID NO. / Passport No."
                                                            value="{{ $customer->passport_no }}">
                                                        <div class="invalid-tooltip">
                                                            @if ($errors->has('passport_no'))
                                                                {{ $errors->first('passport_no') }}
                                                            @else
                                                                HKID NO. / Passport No. is required!
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
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

                                                <div class="col-12 col-md-6 mt-3">
                                                    <label for="">Nationality</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="nationality" required>
                                                            <option value=""
                                                                @if ($customer->nationality == '') {{ 'selected' }} @endif
                                                                disabled>
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

                                                <div class="col-md-4 col-sm-12 mt-3">
                                                    <div class="form-label-group in-border">
                                                        <label for="passport_no" class="form-label">Referral Code</label>
                                                        <input type="text" class="form-control" id=""
                                                            name="" placeholder=""
                                                            value="{{ $customer->user->referral_code }}" readonly>
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
                                                </div>
                                                <div class="col-12 col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <textarea id="address" name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif"
                                                            placeholder="ADDRESS">{{ $customer->address }}</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-2">
                                    <h2 class="accordion-header" id="accordionborderedExample2">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse2"
                                            aria-expanded="false" aria-controls="accor_borderedExamplecollapse2">
                                            Sec#2A APPLICANT INFORMATION (CORPORATE)
                                        </button>
                                    </h2>
                                    <div id="accor_borderedExamplecollapse2" class="accordion-collapse collapse"
                                        aria-labelledby="accordionborderedExample2" data-bs-parent="#accordionBordered">
                                        <div class="accordion-body">

                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group ">
                                                        <label
                                                            for="">{{ __('corporate.FULL LEGAL NAME OF BUSINESS') }}</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('business_name')) is-invalid @endif"
                                                            id="business_name" name="business_name"
                                                            placeholder="{{ __('corporate.FULL LEGAL NAME OF BUSINESS') }}"
                                                            value="{{ $customer->business_name }}" required>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12 mt-3">
                                                    <label
                                                        class="form-label ">{{ __('corporate.TYPE OR ORGANIZATION') }}</label>
                                                    <div class="form-group">
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_organization"
                                                                value="Corporation"
                                                                @if ($customer->type_of_organization == 'Corporation') checked @endif>
                                                            <span></span>{{ __('corporate.CORPORATION') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_organization"
                                                                value="Partnership"
                                                                @if ($customer->type_of_organization == 'Partnership') checked @endif>
                                                            <span></span>{{ __('corporate.PARTNERSHIP') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_organization"
                                                                value="Limited Company"
                                                                @if ($customer->type_of_organization == 'Limited Company') checked @endif>
                                                            <span></span> {{ __('corporate.Limited Company') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_organization"
                                                                value="Sole Proprietor"
                                                                @if ($customer->type_of_organization == 'Sole Proprietor') checked @endif>
                                                            <span></span>{{ __('corporate.SOLE PROPRIETOR') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_organization"
                                                                value="other"
                                                                @if ($customer->type_of_organization == 'other') checked @endif>
                                                            <span></span>{{ __('corporate.Other') }}:
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Business Phone
                                                            Number</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('business_phone_num')) is-invalid @endif"
                                                            id="business_phone_num" name="business_phone_num"
                                                            placeholder="{{ __('corporate.BUSINESS PHONE') }}"
                                                            value="{{ $customer->business_phone_num }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Business Fax
                                                            Number</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('business_fax')) is-invalid @endif"
                                                            id="business_fax" name="business_fax"
                                                            value="{{ $customer->business_fax }}"
                                                            placeholder="{{ __('corporate.BUSINESS FAX') }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Business Email</label>
                                                        <input type="email" id="business_email" name="business_email"
                                                            class="form-control @if ($errors->has('business_email')) is-invalid @endif"
                                                            value="{{ $customer->business_email }}"
                                                            placeholder="{{ __('corporate.BUSINESS EMAIL') }}" required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Business
                                                            Address</label>
                                                        <textarea type="text" class="form-control @if ($errors->has('business_address')) is-invalid @endif"
                                                            id="business_address" name="business_address" placeholder="{{ __('corporate.BUSINESS ADDRESS') }}" required>{{ $customer->business_address }}</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">City</label>
                                                        <input type="text" id="city" name="city"
                                                            class="form-control @if ($errors->has('city')) is-invalid @endif"
                                                            value="{{ $customer->city }}"
                                                            placeholder="{{ __('corporate.CITY') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Country</label>
                                                        <input type="text" id="country" name="country"
                                                            value="{{ $customer->country }}"
                                                            class="form-control orm-control @if ($errors->has('country')) is-invalid @endif"
                                                            placeholder="{{ __('corporate.COUNTRY') }}">

                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Zip
                                                            Code</label>
                                                        <input id="zip_code" name="zip_code" type="text"
                                                            value="{{ $customer->zip_code }}"
                                                            class="form-control @if ($errors->has('zip_code')) is-invalid @endif"
                                                            placeholder="{{ __('corporate.ZIP CODE') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <label
                                                        class="form-label">{{ __('corporate.TYPE OF BUSINESS') }}</label>
                                                    <div class="form-group">
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_business"
                                                                value="Coin Dealer"
                                                                @if ($customer->type_of_business == 'Coin Dealer') checked @endif>
                                                            <span></span> {{ __('corporate.COIN DEALER') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_business"
                                                                value="Jewellery Repair"
                                                                @if ($customer->type_of_business == 'Jewellery Repair') checked @endif>
                                                            <span></span>{{ __('corporateJEWELLERY REPAIR') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="type_of_business"
                                                                value="Jewellery Manufacturer"
                                                                @if ($customer->type_of_business == 'Jewellery Manufacturer') checked @endif>
                                                            <span></span>{{ __('corporate.JEWELLERY MANUFACTURER') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <label
                                                        class="form-label">{{ __('corporate.JEWELLERY RETAIL') }}</label>
                                                    <div class="form-group ">
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="retails"
                                                                value="Goldy/Precious Metal Trading"
                                                                @if ($customer->retails == 'Goldy/Precious Metal Trading') checked @endif>
                                                            <span></span>{{ __('corporate.GOLD/PRECIOUS METAL TRADING') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="retails" value="Others"
                                                                @if ($customer->retails == 'Others') checked @endif>
                                                            <span></span>{{ __('corporate.OTHER') }} :
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Business
                                                            Registration
                                                            Number</label>
                                                        <input type="text" id="business_reg_num"
                                                            name="business_reg_num"
                                                            value="{{ $customer->business_reg_num }}"
                                                            class="form-control @if ($errors->has('business_reg_num')) is-invalid @endif"
                                                            placeholder="{{ __('corporate.COMPANY INCORPORATION NUMBER / BUSINESS REGISTRATION CERTIFICATE NUMBER') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Country of
                                                            Incorporation</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('country_of_incorporation')) is-invalid @endif"
                                                            id="country_of_incorporation" name="country_of_incorporation"
                                                            value="{{ $customer->country_of_incorporation }}"
                                                            placeholder="{{ __('corporate.COUNTRY OF INCORPORATION') }}">

                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Years In
                                                            Business</label>
                                                        <input type="text" value="{{ $customer->years_in_business }}"
                                                            class="form-control @if ($errors->has('years_in_business')) is-invalid @endif"
                                                            name="years_in_business" id="years_in_business"
                                                            placeholder="{{ __('corporate.YEARS IN BUSINESS') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-12 col-md-4">
                                                    <label
                                                        class="form-label">{{ __('corporate.DO YOU IMPORT / EXPORT PRECIOUS METAL?') }}
                                                    </label>
                                                    <div class="form-group ">
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="import" value="Yes"
                                                                @if ($customer->import == 'Yes') checked @endif>
                                                            <span></span>{{ __('corporate.YES') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="import" value="No"
                                                                @if ($customer->import == 'No') checked @endif>
                                                            <span></span> {{ __('corporate.NO') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="passport_no"
                                                            class="form-label">{{ __('corporate.IF YES, WHAT ARE THE COUNTRIES YOU ARE TRADING WITH?') }}</label>
                                                        <input type="text"
                                                            class="form-control @if ($errors->has('countries_of_import')) is-invalid @endif"
                                                            id="countries_of_import" name="countries_of_import"
                                                            value="{{ $customer->countries_of_import }}"
                                                            placeholder="{{ __('corporate.IF YES, WHAT ARE THE COUNTRIES YOU ARE TRADING WITH?') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="accordion-item mt-2">
                                    <h2 class="accordion-header" id="accordionborderedExample3">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse3"
                                            aria-expanded="false" aria-controls="accor_borderedExamplecollapse3">
                                            Sec#2B Shareholders/Directors Info
                                        </button>
                                    </h2>
                                    <div id="accor_borderedExamplecollapse3" class="accordion-collapse collapse"
                                        aria-labelledby="accordionborderedExample3" data-bs-parent="#accordionBordered">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Full
                                                            Name</label>
                                                        <input type="text" name="name" value="{{ old('name') }}"
                                                            class="form-control  @if ($errors->has('name')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.full_name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Title</label>
                                                        <input type="text" name="title"
                                                            value="{{ old('title') }}"
                                                            class="form-control @if ($errors->has('title')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.title') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Email</label>
                                                        <input type="text" value="{{ old('email') }}"
                                                            name="email"
                                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.email') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text" name="phone_number"
                                                            value="{{ old('phone_number') }}"
                                                            class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.phone_number') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">HKID
                                                            NO. /
                                                            PASSPORT
                                                            NUMBER</label>
                                                        <input type="text" name="passport_no"
                                                            value="{{ old('passort_no') }}"
                                                            class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.passport_no') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Nationality</label>
                                                        <input type="text" name="nationality"
                                                            value="{{ old('nationality') }}"
                                                            class="form-control @if ($errors->has('nationality')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.nationality') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="passport_no" class="form-label">Address</label>
                                                        <input type="text" name="address"
                                                            value="{{ old('address') }}"
                                                            class="form-control @if ($errors->has('address')) is-invalid @endif"
                                                            placeholder="{{ __('shareholder.address') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="accordion-item mt-2">
                                    <h2 class="accordion-header" id="accordionborderedExample4">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse4"
                                            aria-expanded="false" aria-controls="accor_borderedExamplecollapse4">
                                            Sec#2C AUTHORIZED TRADING REPRESENTATIVE
                                        </button>
                                    </h2>
                                    <div id="accor_borderedExamplecollapse4" class="accordion-collapse collapse"
                                        aria-labelledby="accordionborderedExample4" data-bs-parent="#accordionBordered">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Full
                                                            Name</label>
                                                        <input type="text" name="name" value="{{ old('name') }}"
                                                            class="form-control  @if ($errors->has('name')) is-invalid @endif"
                                                            placeholder="{{ __('trading.full_name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Title</label>
                                                        <input type="text" name="title"
                                                            value="{{ old('title') }}"
                                                            class="form-control @if ($errors->has('title')) is-invalid @endif"
                                                            placeholder="{{ __('trading.title') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Email</label>
                                                        <input type="text" value="{{ old('email') }}"
                                                            name="email"
                                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                            placeholder="{{ __('trading.email') }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text" name="phone_number"
                                                            value="{{ old('phone_number') }}"
                                                            class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                                            placeholder="{{ __('trading.phone_number') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Signature</label>
                                                        <input type="text" name="signature"
                                                            value="{{ old('signature') }}"
                                                            class="form-control @if ($errors->has('signature')) is-invalid @endif"
                                                            placeholder="{{ __('trading.signature') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="accordion-item mt-2">
                                    <h2 class="accordion-header" id="accordionborderedExample5">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse5"
                                            aria-expanded="false" aria-controls="accor_borderedExamplecollapse5">
                                            Sec#3 OTHER INFORMATION
                                        </button>
                                    </h2>
                                    <div id="accor_borderedExamplecollapse5" class="accordion-collapse collapse"
                                        aria-labelledby="accordionborderedExample5" data-bs-parent="#accordionBordered">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-12">
                                                    <label class="form-label">{{ __('other_info.hear_about_mg') }}
                                                    </label>
                                                    <div class="form-group ">
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="hear_about_mg" value="REFERRAL"
                                                                @if ($customer->hear_about_mg == 'REFERRAL') checked @endif>
                                                            <span></span> {{ __('other_info.referral') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="hear_about_mg"
                                                                value="SALES REPRESENTATIVE"
                                                                @if ($customer->hear_about_mg == 'SALES REPRESENTATIVE') checked @endif>
                                                            <span></span>{{ __('other_info.sale_rep') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="hear_about_mg" value="INTERNET"
                                                                @if ($customer->hear_about_mg == 'INTERNET') checked @endif>
                                                            <span></span> {{ __('other_info.internet') }}
                                                        </label>
                                                        <label class="radio-inline ">
                                                            <input type="radio" name="hear_about_mg"
                                                                value="ADVERTISEMENT"
                                                                @if ($customer->hear_about_mg == 'ADVERTISEMENT') checked @endif>
                                                            <span></span>{{ __('other_info.add') }}
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Sales
                                                            Representative
                                                            Name</label>
                                                        <input type="text" name="sales_rep_name"
                                                            value="{{ $customer->sales_rep_name }}"
                                                            class="form-control @if ($errors->has('sales_rep_name')) is-invalid @endif"
                                                            placeholder="{{ __('other_info.name_of_sale_rep') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Sales
                                                            Representative
                                                            Number</label>
                                                        <input type="text" name="sales_rep_number"
                                                            value="{{ $customer->sales_rep_number }}"
                                                            class="form-control @if ($errors->has('sales_rep_number')) is-invalid @endif"
                                                            placeholder="{{ __('other_info.code') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-2">
                                    <h2 class="accordion-header" id="accordionborderedExample6">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse6"
                                            aria-expanded="false" aria-controls="accor_borderedExamplecollapse6">
                                            Sec#4 BANK ACCOUNT FOR RECEIVING PAYMENTS
                                        </button>
                                    </h2>
                                    <div id="accor_borderedExamplecollapse6" class="accordion-collapse collapse"
                                        aria-labelledby="accordionborderedExample6" data-bs-parent="#accordionBordered">
                                        <div class="accordion-body">
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Bank
                                                            Name</label>
                                                        <input type="text" name="bank_name"
                                                            value="{{ $customer->bank_name }}"
                                                            class="form-control @if ($errors->has('bank_name')) is-invalid @endif"
                                                            placeholder="{{ __('bank_info.bank_name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Bank
                                                            Country
                                                            Name</label>
                                                        <input type="text" name="bank_country_name"
                                                            value="{{ $customer->bank_country_name }}"
                                                            class="form-control @if ($errors->has('bank_country_name')) is-invalid @endif"
                                                            placeholder="{{ __('bank_info.country') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Bank
                                                            Account
                                                            Name</label>
                                                        <input type="text" name="bank_account_name"
                                                            value="{{ $customer->bank_account_name }}"
                                                            class="form-control @if ($errors->has('bank_account_name')) is-invalid @endif"
                                                            placeholder="{{ __('bank_info.account_num') }}">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Bank
                                                            Branch
                                                            Number</label>
                                                        <input type="text" name="bank_branch_number"
                                                            value="{{ $customer->bank_branch_number }}"
                                                            class="form-control @if ($errors->has('bank_branch_number')) is-invalid @endif"
                                                            placeholder="{{ __('bank_info.branch_num') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Bank
                                                            Account
                                                            Number</label>
                                                        <input type="text" name="bank_account_number"
                                                            value="{{ $customer->bank_account_number }}"
                                                            class="form-control @if ($errors->has('bank_account_number')) is-invalid @endif"
                                                            placeholder="{{ __('bank_info.account_num') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="full_name" class="form-label">Bank
                                                            Swift
                                                            Code</label>
                                                        <input type="text" name="bank_swift_code"
                                                            value="{{ $customer->bank_swift_code }}"
                                                            class="form-control @if ($errors->has('bank_swift_code')) is-invalid @endif"
                                                            placeholder="{{ __('bank_info.swift_code') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
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

                                <div class="col-md-4">
                                    <div class="form-label-group in-border">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select form-control mb-3" name="gender" required>
                                            <option value=""
                                                @if ($customer->gender == '') {{ 'selected' }} @endif selected
                                                disabled>
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

                                <div class="col-md-3 col-sm-12">
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

                                <div class="col-md-1 mt-4">
                                    @if ($user->is_email_verified != 1)
                                        <button id="verify_email" value="{{ $user->id }}"
                                            data-url="{{ route('verification-email') }}" class="btn btn-success">
                                            Verify Email</button>
                                    @endif
                                </div>

                                <div class="col-md-4 col-sm-12">
                                    <div class="form-label-group in-border">
                                        <label for="occupation" class="form-label">Occupation and business
                                            background</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('occupation')) is-invalid @endif"
                                            id="occupation" name="occupation"
                                            placeholder="Occupation and business background"
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
                                        <label for="passport_no" class="form-label">HKID NO. / Passport
                                            No.</label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                            id="passport_no" name="passport_no" placeholder="HKID NO. / Passport No."
                                            value="{{ $customer->passport_no }}">
                                        <div class="invalid-tooltip">
                                            @if ($errors->has('passport_no'))
                                                {{ $errors->first('passport_no') }}
                                            @else
                                                HKID NO. / Passport No. is required!
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12">
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

                                <div class="col-12 col-md-6 mt-3">
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

                                <div class="col-md-4 col-sm-12 mt-3">
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
                                </div>

                                <div class="col-12 col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea id="address" name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif"
                                            placeholder="ADDRESS">{{ $customer->address }}</textarea>

                                    </div>
                                </div>
                            </div>
                        @endif
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
