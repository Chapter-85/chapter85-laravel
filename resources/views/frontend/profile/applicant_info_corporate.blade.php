 <div class="card card-default ">
     <div class="card-header">
         {{ __('corporate.SECTION 2A') }} <span>{{ __('corporate.APPLICANT INFORMATION (CORPORATE)') }}
         </span>
     </div>
     <div class="card-body">
         <form class="row  needs-validation" action="{{ route('customer-profile-data.update', $customer->id) }}"
             method="POST" novalidate>
             @csrf
             @method('PUT')
             <input type="text" name="form_info" value="corporate" hidden>
             <div class="col-12 col-md-12 mb-3">
                 <label class="form-label">{{ __('corporate.FULL LEGAL NAME OF BUSINESS') }}</label>
                 <input type="text" class="form-control @if ($errors->has('business_name')) is-invalid @endif"
                     id="business_name" name="business_name"
                     placeholder="{{ __('corporate.FULL LEGAL NAME OF BUSINESS') }}"
                     value="{{ $customer->business_name }}" required>
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('business_name') }}</strong>
                 </div>
             </div>

             <div class="col-12 col-md-12 mb-3">
                 <label class="form-label w-100">{{ __('corporate.TYPE OR ORGANIZATION') }}</label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_organization" value="Corporation"
                         @if ($customer->type_of_organization == 'Corporation') checked @endif>
                     <span></span>{{ __('corporate.CORPORATION') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_organization" value="Partnership"
                         @if ($customer->type_of_organization == 'Partnership') checked @endif>
                     <span></span>{{ __('corporate.PARTNERSHIP') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_organization" value="Limited Company"
                         @if ($customer->type_of_organization == 'Limited Company') checked @endif>
                     <span></span> {{ __('corporate.Limited Company') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_organization" value="Sole Proprietor"
                         @if ($customer->type_of_organization == 'Sole Proprietor') checked @endif>
                     <span></span>{{ __('corporate.SOLE PROPRIETOR') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_organization" value="other"
                         @if ($customer->type_of_organization == 'other') checked @endif>
                     <span></span>{{ __('corporate.Other') }}:
                 </label>
             </div>
             <div class="col-12 col-md-4 mb-3">
                 <label class="form-label">{{ __('corporate.BUSINESS PHONE') }}</label>
                 <input type="text" class="form-control @if ($errors->has('business_phone_num')) is-invalid @endif"
                     id="business_phone_num" name="business_phone_num"
                     placeholder="{{ __('corporate.BUSINESS PHONE') }}" value="{{ $customer->business_phone_num }}"
                     required>
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('business_phone_num') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-4 mb-3">
                 <label class="form-label">{{ __('corporate.BUSINESS FAX') }}</label>
                 <input type="text" class="form-control @if ($errors->has('business_fax')) is-invalid @endif"
                     id="business_fax" name="business_fax" value="{{ $customer->business_fax }}"
                     placeholder="{{ __('corporate.BUSINESS FAX') }}" required>
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('business_fax') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-4 mb-3">
                 <label class="form-label">{{ __('corporate.BUSINESS EMAIL') }}</label>
                 <input type="email" id="business_email" name="business_email"
                     class="form-control @if ($errors->has('business_email')) is-invalid @endif"
                     value="{{ $customer->business_email }}" placeholder="{{ __('corporate.BUSINESS EMAIL') }}"
                     required>
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('business_email') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-12 mb-3">
                 <label class="form-label">{{ __('corporate.BUSINESS ADDRESS') }}</label>
                 <textarea type="text" class="form-control @if ($errors->has('business_address')) is-invalid @endif" id="business_address"
                     name="business_address" placeholder="{{ __('corporate.BUSINESS ADDRESS') }}" required>{{ $customer->business_address }}</textarea>
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('business_address') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-4 mb-3">
                 <label class="form-label">{{ __('corporate.CITY') }}</label>
                 <input type="text" id="city" name="city"
                     class="form-control @if ($errors->has('city')) is-invalid @endif"
                     value="{{ $customer->city }}" placeholder="{{ __('corporate.CITY') }}" required>
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('city') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-4 mb-3">
                 <label class="form-label">{{ __('corporate.COUNTRY') }}</label>
                 <input type="text" id="country" name="country" value="{{ $customer->country }}"
                     class="form-control orm-control @if ($errors->has('country')) is-invalid @endif"
                     placeholder="{{ __('corporate.COUNTRY') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('country') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-4  mb-3">
                 <label class="form-label">{{ __('corporate.ZIP CODE') }}</label>
                 <input id="zip_code" name="zip_code" type="text" value="{{ $customer->zip_code }}"
                     class="form-control @if ($errors->has('zip_code')) is-invalid @endif"
                     placeholder="{{ __('corporate.ZIP CODE') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('zip_code') }}</strong>
                 </div>
             </div>

             <div class="col-12 col-md-12 mb-3">
                 <label class="form-label w-100">{{ __('corporate.TYPE OF BUSINESS') }}</label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_business" value="Coin Dealer"
                         @if ($customer->type_of_business == 'Coin Dealer') checked @endif>
                     <span></span> {{ __('corporate.COIN DEALER') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_business" value="Jewellery Repair"
                         @if ($customer->type_of_business == 'Jewellery Repair') checked @endif>
                     <span></span>{{ __('corporate.JEWELLERY REPAIR') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="type_of_business" value="Jewellery Manufacturer"
                         @if ($customer->type_of_business == 'Jewellery Manufacturer') checked @endif>
                     <span></span>{{ __('corporate.JEWELLERY MANUFACTURER') }}
                 </label>
             </div>
             <div class="col-12 col-md-12 mb-3">
                 <label class="form-label w-100">{{ __('corporate.JEWELLERY RETAIL') }}</label>
                 <label class="radio-inline ">
                     <input type="radio" name="retails" value="Goldy/Precious Metal Trading"
                         @if ($customer->retails == 'Goldy/Precious Metal Trading') checked @endif>
                     <span></span>{{ __('corporate.GOLD/PRECIOUS METAL TRADING') }}
                 </label>
                 <label class="radio-inline ">
                     <input type="radio" name="retails" value="Others"
                         @if ($customer->retails == 'Others') checked @endif>
                     <span></span>{{ __('corporate.OTHER') }} :
                 </label>
             </div>
             <div class="col-12 col-md-12 mb-3">
                 <label
                     class="form-label">{{ __('corporate.COMPANY INCORPORATION NUMBER / BUSINESS REGISTRATION CERTIFICATE NUMBER') }}</label>
                 <input type="text" id="business_reg_num" name="business_reg_num"
                     value="{{ $customer->business_reg_num }}"
                     class="form-control @if ($errors->has('business_reg_num')) is-invalid @endif"
                     placeholder="{{ __('corporate.COMPANY INCORPORATION NUMBER / BUSINESS REGISTRATION CERTIFICATE NUMBER') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('business_reg_num') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('corporate.COUNTRY OF INCORPORATION') }}</label>
                 <input type="text" class="form-control @if ($errors->has('country_of_incorporation')) is-invalid @endif"
                     id="country_of_incorporation" name="country_of_incorporation"
                     value="{{ $customer->country_of_incorporation }}"
                     placeholder="{{ __('corporate.COUNTRY OF INCORPORATION') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('country_of_incorporation') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('corporate.YEARS IN BUSINESS') }}</label>
                 <input type="text" value="{{ $customer->years_in_business }}"
                     class="form-control @if ($errors->has('years_in_business')) is-invalid @endif"
                     name="years_in_business" id="years_in_business"
                     placeholder="{{ __('corporate.YEARS IN BUSINESS') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('years_in_business') }}</strong>
                 </div>
             </div>
             <div class="col-12 col-md-12 mb-3">
                 <label class="form-label">{{ __('corporate.DO YOU IMPORT / EXPORT PRECIOUS METAL?') }}
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
             <div class="col-12 col-md-12 mb-3">
                 <label
                     class="form-label">{{ __('corporate.IF YES, WHAT ARE THE COUNTRIES YOU ARE TRADING WITH?') }}</label>
                 <input type="text" class="form-control @if ($errors->has('countries_of_import')) is-invalid @endif"
                     id="countries_of_import" name="countries_of_import"
                     value="{{ $customer->countries_of_import }}"
                     placeholder="{{ __('corporate.IF YES, WHAT ARE THE COUNTRIES YOU ARE TRADING WITH?') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('countries_of_import') }}</strong>
                 </div>
             </div>
             <div class="footer mt-20 d-flex">
                 <a href="{{ route('customer-profile-data.edit', $customer->id) . '?tab=individual' }}"
                     class="btn btn-custom">{{ __('home_page.previous') }}</a>
                 <div class="ml-auto">
                     <button class="btn btn-default" type="reset">{{ __('home_page.cancel') }}</button>
                     <button class="btn btn-custom ml-3 ms-3" type="submit">{{ __('home_page.next') }}</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
