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
                        <div class="accordion custom-accordionwithicon accordion-border-box accordion-primary"
                            id="accordionBordered">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="accordionborderedExample">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accor_borderedExamplecollapse1" aria-expanded="true"
                                        aria-controls="accor_borderedExamplecollapse1">
                                        Sec#1 APPLICANT INFORMATION (INDIVIDUAL)/ 第 1 項申請人信息（個人）
                                    </button>
                                </h2>
                                <div id="accor_borderedExamplecollapse1" class="accordion-collapse collapse show"
                                    aria-labelledby="accordionborderedExample1" data-bs-parent="#accordionBordered">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="">Complete Name/全名</label>
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" autocomplete="name"
                                                        autofocus placeholder="Complete Name" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email/郵箱</label>
                                                    <input id="email" type="email" placeholder="EMAIL"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email">

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
                                                        <option value=""
                                                            @if (old('gender') == '') {{ 'selected' }} @endif
                                                            selected disabled>
                                                            Select One
                                                        </option>
                                                        <option value="male"
                                                            @if (old('gender') == 'male') {{ 'selected' }} @endif>
                                                            Male
                                                        </option>
                                                        <option value="female"
                                                            @if (old('gender') == 'female') {{ 'selected' }} @endif>
                                                            Female
                                                        </option>
                                                        <option value="other"
                                                            @if (old('gender') == 'other') {{ 'selected' }} @endif>
                                                            Other
                                                        </option>
                                                    </select>
                                                    <div class="invalid-tooltip">Select the gender!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-label-group in-border">
                                                    <label for="occupation" class="form-label">Occupation and business
                                                        background/職業背景</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('occupation')) is-invalid @endif"
                                                        id="occupation" name="occupation"
                                                        placeholder="Occupation and business background"
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
                                                        No./香港身份證號/護照號</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('passport_no')) is-invalid @endif"
                                                        id="passport_no" name="passport_no"
                                                        placeholder="HKID NO. / Passport No."
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
                                                    <label for="phone_number" class="form-label">Phone No./電話號碼</label>
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
                                                <label for="">Nationality/國籍</label>
                                                <div class="form-group">
                                                    <select class="form-select form-control " name="nationality" required>
                                                        <option value=""
                                                            @if (old('nationality') == '') {{ 'selected' }} @endif
                                                            disabled>
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
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="new-password"
                                                        placeholder="Password">

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
                                                        placeholder="Confirm Password" name="password_confirmation"
                                                        required autocomplete="new-password">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12 mt-3">
                                                <div class="form-group">
                                                    <label for="">Address/地址</label>
                                                    <textarea id="address" name="address" class="form-control  @if ($errors->has('address')) is-invalid @endif"
                                                        placeholder="ADDRESS">{{ old('address') }}</textarea>

                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12 mt-3">
                                                <label for="">Customer Type/顧客類型</label>
                                                <div class="form-group">
                                                    <label class="radio-inline mr-3">
                                                        <input type="radio" name="customer_type" value="individual"
                                                            @if (old('customer_type') == 'individual') checked @endif>
                                                        <span></span>Individual
                                                    </label>
                                                    <label class="radio-inline mr-3">
                                                        <input type="radio" name="customer_type" value="corporate"
                                                            @if (old('customer_type') == 'corporate') checked @endif>
                                                        <span></span>Corporate
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-12">
                                                <label class="form-label">HOW DID YOU HEAR ABOUT MG?/您從何處得悉MG?
                                                </label>
                                                <div class="form-group">
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="hear_about_mg" value="REFERRAL"
                                                            @if (old('hear_about_mg') == 'REFERRAL') checked @endif>
                                                        <span></span> REFERRAL / 轉介
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="hear_about_mg"
                                                            value="SALES REPRESENTATIVE"
                                                            @if (old('hear_about_mg') == 'SALES REPRESENTATIVE') checked @endif>
                                                        <span></span>SALES REPRESENTATIVE / 營業代表
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="hear_about_mg" value="INTERNET"
                                                            @if (old('hear_about_mg') == 'INTERNET') checked @endif>
                                                        <span></span> INTERNET / 互聯網
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="hear_about_mg" value="ADVERTISEMENT"
                                                            @if (old('hear_about_mg') == 'ADVERTISEMENT') checked @endif>
                                                        <span></span>ADVERTISEMENT / 廣告
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Sales Representative
                                                        Name / 營業代表名稱</label>
                                                    <input type="text" name="sales_rep_name"
                                                        value="{{ old('sales_rep_name') }}"
                                                        class="form-control @if ($errors->has('sales_rep_name')) is-invalid @endif"
                                                        placeholder="NAME OF SALES REPRESENTATIVE">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Sales Representative
                                                        Number / 營業代表編號</label>
                                                    <input type="text" name="sales_rep_number"
                                                        value="{{ old('sales_rep_number') }}"
                                                        class="form-control @if ($errors->has('sales_rep_number')) is-invalid @endif"
                                                        placeholder="SALES REPRESENTATIVE CODE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-2">
                                <h2 class="accordion-header" id="accordionborderedExample2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accor_borderedExamplecollapse2" aria-expanded="false"
                                        aria-controls="accor_borderedExamplecollapse2">
                                        Sec#2A APPLICANT INFORMATION (CORPORATE) /第2A項申請人資料 (公司客戶)
                                    </button>
                                </h2>
                                <div id="accor_borderedExamplecollapse2" class="accordion-collapse collapse"
                                    aria-labelledby="accordionborderedExample2" data-bs-parent="#accordionBordered">
                                    <div class="accordion-body">

                                        <div class="row mt-3">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="">FULL LEGAL NAME OF BUSINESS / 企業法定名稱</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('business_name')) is-invalid @endif"
                                                        id="business_name" name="business_name"
                                                        placeholder="FULL LEGAL NAME OF BUSINESS"
                                                        value="{{ old('business_name') }}">

                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 mt-3">
                                                <label class="form-label">TYPE OR ORGANIZATION / 組織類型</label>
                                                <div class="form-group ">
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_organization"
                                                            value="Corporation"
                                                            @if (old('type_of_organization') == 'Corporation') checked @endif>
                                                        <span></span>CORPORATION / 企業
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_organization"
                                                            value="Partnership"
                                                            @if (old('type_of_organization') == 'Partnership') checked @endif>
                                                        <span></span>PARTNERSHIP / 合夥
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_organization"
                                                            value="Limited Company"
                                                            @if (old('type_of_organization') == 'Limited Company') checked @endif>
                                                        <span></span> Limited Company / 有限公司
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_organization"
                                                            value="Sole Proprietor"
                                                            @if (old('type_of_organization') == 'Sole Proprietor') checked @endif>
                                                        <span></span>SOLE PROPRIETOR / 獨資經營
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_organization" value="other"
                                                            @if (old('type_of_organization') == 'other') checked @endif>
                                                        <span></span>Other / 其他:
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Business Phone
                                                        Number / 業務電話</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('business_phone_num')) is-invalid @endif"
                                                        id="business_phone_num" name="business_phone_num"
                                                        placeholder="BUSINESS PHONE"
                                                        value="{{ old('business_phone_num') }}">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Business Fax
                                                        Number / 業務傳真</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('business_fax')) is-invalid @endif"
                                                        id="business_fax" name="business_fax"
                                                        value="{{ old('business_fax') }}" placeholder="BUSINESS FAX">

                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Business Email /
                                                        業務電郵</label>
                                                    <input type="email" id="business_email" name="business_email"
                                                        class="form-control @if ($errors->has('business_email')) is-invalid @endif"
                                                        value="{{ old('business_email') }}" placeholder="BUSINESS EMAIL">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Business
                                                        Address / 營業地址</label>
                                                    <textarea type="text" class="form-control @if ($errors->has('business_address')) is-invalid @endif"
                                                        id="business_address" name="business_address" placeholder="BUSINESS ADDRESS">{{ old('business_address') }}</textarea>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">City / 城市</label>
                                                    <input type="text" id="city" name="city"
                                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                                        value="{{ old('city') }}" placeholder="CITY">

                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Country / 所在國家</label>
                                                    <input type="text" id="country" name="country"
                                                        value="{{ old('country') }}"
                                                        class="form-control orm-control @if ($errors->has('country')) is-invalid @endif"
                                                        placeholder="COUNTRY">

                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Zip Code / 郵政編碼</label>
                                                    <input id="zip_code" name="zip_code" type="text"
                                                        value="{{ old('zip_code') }}"
                                                        class="form-control @if ($errors->has('zip_code')) is-invalid @endif"
                                                        placeholder="ZIP CODE">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-12">
                                                <label class="form-label">TYPE OF BUSINESS / 業務類別</label>
                                                <div class="form-group">
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_business" value="Coin Dealer"
                                                            @if (old('type_of_business') == 'Coin Dealer') checked @endif>
                                                        <span></span> COIN DEALER / 錢幣商
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_business"
                                                            value="Jewellery Repair"
                                                            @if (old('type_of_business') == 'Jewellery Repair') checked @endif>
                                                        <span></span>JEWELLERY REPAIR / 珠寶修理
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="type_of_business"
                                                            value="Jewellery Manufacturer"
                                                            @if (old('type_of_business') == 'Jewellery Manufacturer') checked @endif>
                                                        <span></span>JEWELLERY MANUFACTURER / 珠寶製造商
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-12">
                                                <label class="form-label">JEWELLERY RETAIL / 珠寶零售</label>
                                                <div class="form-group ">
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="retails"
                                                            value="Goldy/Precious Metal Trading"
                                                            @if (old('retails') == 'Goldy/Precious Metal Trading') checked @endif>
                                                        <span></span>GOLD/PRECIOUS METAL TRADING / 黃金/貴金屬貿易
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="retails" value="Others"
                                                            @if (old('retails') == 'Others') checked @endif>
                                                        <span></span>OTHER / 其他
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Business Registration
                                                        Number / 商業登記證書號碼
                                                    </label>
                                                    <input type="text" id="business_reg_num" name="business_reg_num"
                                                        value="{{ old('business_reg_num') }}"
                                                        class="form-control @if ($errors->has('business_reg_num')) is-invalid @endif"
                                                        placeholder="COMPANY INCORPORATION NUMBER / BUSINESS REGISTRATION CERTIFICATE NUMBER">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Country of
                                                        Incorporation / 註冊國家</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('country_of_incorporation')) is-invalid @endif"
                                                        id="country_of_incorporation" name="country_of_incorporation"
                                                        value="{{ old('country_of_incorporation') }}"
                                                        placeholder="COUNTRY OF INCORPORATION">

                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">Years In
                                                        Business / 經營年期</label>
                                                    <input type="text" value="{{ old('years_in_business') }}"
                                                        class="form-control @if ($errors->has('years_in_business')) is-invalid @endif"
                                                        name="years_in_business" id="years_in_business"
                                                        placeholder="YEARS IN BUSINESS">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-12 col-md-4">
                                                <label class="form-label">DO YOU IMPORT / EXPORT PRECIOUS METAL? /
                                                    貴公司有否進口或出口貴重金屬
                                                </label>
                                                <div class="form-group ">
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="import" value="Yes"
                                                            @if (old('import') == 'Yes') checked @endif>
                                                        <span></span>YES
                                                    </label>
                                                    <label class="radio-inline ">
                                                        <input type="radio" name="import" value="No"
                                                            @if (old('import') == 'No') checked @endif>
                                                        <span></span> NO
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="passport_no" class="form-label">IF YES, WHAT ARE THE
                                                        COUNTRIES YOU ARE TRADING WITH? / 倘若有，是哪些地方?</label>
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('countries_of_import')) is-invalid @endif"
                                                        id="countries_of_import" name="countries_of_import"
                                                        value="{{ old('countries_of_import') }}"
                                                        placeholder="IF YES, WHAT ARE THE COUNTRIES YOU ARE TRADING WITH?">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mt-2">
                                <h2 class="accordion-header" id="accordionborderedExample6">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accor_borderedExamplecollapse6" aria-expanded="false"
                                        aria-controls="accor_borderedExamplecollapse6">
                                        Sec#4 BANK ACCOUNT FOR RECEIVING PAYMENTS
                                    </button>
                                </h2>
                                <div id="accor_borderedExamplecollapse6" class="accordion-collapse collapse"
                                    aria-labelledby="accordionborderedExample6" data-bs-parent="#accordionBordered">
                                    <div class="accordion-body">
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Bank Name / 銀行名稱</label>
                                                    <input type="text" name="bank_name"
                                                        value="{{ old('bank_name') }}"
                                                        class="form-control @if ($errors->has('bank_name')) is-invalid @endif"
                                                        placeholder="BANK NAME">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Bank Country
                                                        Name / 銀行所在國家</label>
                                                    <input type="text" name="bank_country_name"
                                                        value="{{ old('bank_country_name') }}"
                                                        class="form-control @if ($errors->has('bank_country_name')) is-invalid @endif"
                                                        placeholder="COUNTRY IN WHICH BANK IS LOCATED">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Bank Account
                                                        Name / 戶口名稱</label>
                                                    <input type="text" name="bank_account_name"
                                                        value="{{ old('bank_account_name') }}"
                                                        class="form-control @if ($errors->has('bank_account_name')) is-invalid @endif"
                                                        placeholder="ACCOUNT NAME">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Bank Branch
                                                        Number / 分行號碼</label>
                                                    <input type="text" name="bank_branch_number"
                                                        value="{{ old('bank_branch_number') }}"
                                                        class="form-control @if ($errors->has('bank_branch_number')) is-invalid @endif"
                                                        placeholder="BRANCH NUMBER">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Bank Account
                                                        Number / 戶口號碼</label>
                                                    <input type="text" name="bank_account_number"
                                                        value="{{ old('bank_account_number') }}"
                                                        class="form-control @if ($errors->has('bank_account_number')) is-invalid @endif"
                                                        placeholder="ACCOUNT NUMBER">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="full_name" class="form-label">Bank Swift Code /
                                                        跨國匯款國際銀行代碼</label>
                                                    <input type="text" name="bank_swift_code"
                                                        value="{{ old('bank_swift_code') }}"
                                                        class="form-control @if ($errors->has('bank_swift_code')) is-invalid @endif"
                                                        placeholder="SWIFT CODE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
