 <div class="card card-default ">
     <div class="card-header">
         {{ __('bank_info.SECTION 4') }}<span>{{ __('bank_info.BANK ACCOUNT FOR RECEIVING PAYMENTS') }}</span>
     </div>
     <div class="card-body">
         <form class="row  needs-validation" action="{{ route('customer-profile-data.update', $customer->id) }}"
             method="POST" novalidate>
             @csrf
             @method('PUT')
             <input type="text" name="form_info" value="bank_info" hidden>
             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('bank_info.bank_name') }}</label>
                 {{-- <div class="form-group"> --}}
                 <input type="text" name="bank_name" value="{{ $customer->bank_name }}"
                     class="form-control @if ($errors->has('bank_name')) is-invalid @endif"
                     placeholder="{{ __('bank_info.bank_name') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('bank_name') }}</strong>
                 </div>
                 {{-- </div> --}}
             </div>
             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('bank_info.country') }}</label>
                 {{-- <div class="form-group"> --}}
                 <input type="text" name="bank_country_name" value="{{ $customer->bank_country_name }}"
                     class="form-control @if ($errors->has('bank_country_name')) is-invalid @endif"
                     placeholder="{{ __('bank_info.country') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('bank_country_name') }}</strong>
                 </div>
                 {{-- </div> --}}
             </div>

             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('bank_info.account_name') }}</label>
                 {{-- <div class="form-group"> --}}
                 <input type="text" name="bank_account_name" value="{{ $customer->bank_account_name }}"
                     class="form-control @if ($errors->has('bank_account_name')) is-invalid @endif"
                     placeholder="{{ __('bank_info.account_name') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('bank_account_name') }}</strong>
                 </div>
                 {{-- </div> --}}
             </div>

             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('bank_info.branch_num') }}</label>
                 {{-- <div class="form-group"> --}}
                 <input type="text" name="bank_branch_number" value="{{ $customer->bank_branch_number }}"
                     class="form-control @if ($errors->has('bank_branch_number')) is-invalid @endif"
                     placeholder="{{ __('bank_info.branch_num') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('bank_branch_number') }}</strong>
                 </div>
                 {{-- </div> --}}
             </div>
             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('bank_info.account_num') }}</label>
                 {{-- <div class="form-group"> --}}
                 <input type="text" name="bank_account_number" value="{{ $customer->bank_account_number }}"
                     class="form-control @if ($errors->has('bank_account_number')) is-invalid @endif"
                     placeholder="{{ __('bank_info.account_num') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('bank_account_number') }}</strong>
                 </div>
                 {{-- </div> --}}
             </div>
             <div class="col-12 col-md-6 mb-3">
                 <label class="form-label">{{ __('bank_info.swift_code') }}</label>
                 {{-- <div class="form-group"> --}}
                 <input type="text" name="bank_swift_code" value="{{ $customer->bank_swift_code }}"
                     class="form-control @if ($errors->has('bank_swift_code')) is-invalid @endif"
                     placeholder="{{ __('bank_info.swift_code') }}">
                 <div class="invalid-feedback">
                     <strong>{{ $errors->first('bank_swift_code') }}</strong>
                 </div>
                 {{-- </div> --}}
             </div>

             <div class="footer mt-20 d-flex">
                 <a href="{{ route('customer-profile-data.edit', $customer->id) . '?tab=other_info' }}"
                     class="btn btn-custom">{{ __('home_page.previous') }}</a>
                 <div class="ml-auto">
                     <button class="btn btn-default" type="reset">{{ __('home_page.cancel') }}</button>
                     <button class="btn btn-custom" type="submit">{{ __('home_page.next') }}</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
