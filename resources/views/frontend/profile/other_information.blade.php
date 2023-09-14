<div class="card card-default ">
    <div class="card-header">
        {{ __('other_info.SECTION 3') }}<span>{{ __('other_info.OTHER INFORMATION') }} </span>
    </div>
    <div class="card-body">
        <form class="row  needs-validation" action="{{ route('customer-profile-data.update', $customer->id) }}"
            method="POST" novalidate>
            @csrf
            @method('PUT')

            <input type="text" name="form_info" value="other_info" hidden>
            <div class="col-12 col-md-12 mb-3">
                <label class="form-label">{{ __('other_info.hear_about_mg') }} </label>
                <div class="form-group ">
                    <label class="radio-inline ">
                        <input type="radio" name="hear_about_mg" value="REFERRAL"
                            @if ($customer->hear_about_mg == 'REFERRAL') checked @endif>
                        <span></span> {{ __('other_info.referral') }}
                    </label>
                    <label class="radio-inline ">
                        <input type="radio" name="hear_about_mg" value="SALES REPRESENTATIVE"
                            @if ($customer->hear_about_mg == 'SALES REPRESENTATIVE') checked @endif>
                        <span></span>{{ __('other_info.sale_rep') }}
                    </label>
                    <label class="radio-inline ">
                        <input type="radio" name="hear_about_mg" value="INTERNET"
                            @if ($customer->hear_about_mg == 'INTERNET') checked @endif>
                        <span></span> {{ __('other_info.internet') }}
                    </label>
                    <label class="radio-inline ">
                        <input type="radio" name="hear_about_mg" value="ADVERTISEMENT"
                            @if ($customer->hear_about_mg == 'ADVERTISEMENT') checked @endif>
                        <span></span>{{ __('other_info.add') }}
                    </label>

                </div>
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('other_info.name_of_sale_rep') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="sales_rep_name" value="{{ $customer->sales_rep_name }}"
                    class="form-control @if ($errors->has('sales_rep_name')) is-invalid @endif"
                    placeholder="{{ __('other_info.name_of_sale_rep') }}">
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('sales_rep_name') }}</strong>
                </div>
                {{-- </div> --}}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label">{{ __('other_info.code') }}</label>
                {{-- <div class="form-group"> --}}
                <input type="text" name="sales_rep_number" value="{{ $customer->sales_rep_number }}"
                    class="form-control @if ($errors->has('sales_rep_number')) is-invalid @endif"
                    placeholder="{{ __('other_info.code') }}">
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('sales_rep_number') }}</strong>
                </div>
                {{-- </div> --}}
            </div>


            <div class="footer mt-20 d-flex">
                <a href="{{ route('customer-profile-data.edit', $customer->id) . '?tab=trading' }}"
                    class="btn btn-custom">{{ __('home_page.previous') }}</a>
                <div class="ml-auto">
                    <button class="btn btn-default" type="reset">{{ __('home_page.cancel') }}</button>
                    <button class="btn btn-custom" type="submit">{{ __('home_page.next') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
