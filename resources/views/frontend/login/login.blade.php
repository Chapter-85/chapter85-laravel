<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.header_scripts')
</head>

<body class="appear-animate">

    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>

    <a href="#main" class="btn skip-to-content">Skip to Content</a>

    <div class="page" id="top">
        <main id="main">
            @include('layouts.flash_message')

            <div class="container center-aligned vert-center">

                <div class="">

                    <div class="">

                        <ul class="nav nav-tabs tpl-tabs animate login-tabs mb-0 w-450" role="tablist">

                            <li class="nav-item">
                                <a href="#item-1" aria-controls="item-1" class="nav-link active" data-bs-toggle="tab"
                                    role="tab" aria-selected="true">{{ __('login.login') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#item-2" aria-controls="item-2" class="nav-link" data-bs-toggle="tab"
                                    role="tab" aria-selected="false">{{ __('login.register') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content tpl-tabs-cont section-text login-tab-content pt-0 w-450">

                            <div class="tab-pane fade active show" role="tabpanel" id="item-1" role="tabpanel">
                                <div class="card card-default form-card">



                                    <div class="card-body">
                                        <h3 class="dark playfare mb-20">{{ __('login.welcome_back') }}</h3>
                                        <form method="POST" action="{{ route('login-customer') }}"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    @if (url()->current() != url()->previous())
                                                        <input type="hidden" value="{{ url()->previous() }}"
                                                            name="url">
                                                    @endif
                                                    <input type="text"
                                                        class="form-control @if ($errors->has('login_email')) is-invalid @endif"
                                                        id="login_email" name="login_email"
                                                        placeholder="{{ __('login.Email') }}"
                                                        value="{{ old('login_email') }}" required autofocus>
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('login_email') }}</strong>
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div
                                                        class="input-group position-relative auth-pass-inputgroup w-100">
                                                        <input type="password"
                                                            class="form-control @if ($errors->has('login_password')) is-invalid @endif"
                                                            placeholder="{{ __('login.Password') }}" id="password-input"
                                                            value="{{ old('login_password') }}" name="login_password"
                                                            required>
                                                        <button class="btn btn-icon btn-mod show_paswd"
                                                            type="button">
                                                            Show</button>
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('login_password') }}</strong>
                                                        </div>

                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    {{-- <div class="form-group mb-2">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" value=""
                                                                id="auth-remember-check" name="remember"
                                                                {{ old('remember') ? 'checked' : '' }}>
                                                            <span></span> Remember me</label>
                                                    </div> --}}
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-2 justify-content-end">
                                                        <a href="{{ route('password.request') }}"
                                                            class="ml-auto">{{ __('login.forgot_password') }}?</a>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="footer mt-3">
                                                <button class="= btn btn-custom w-100"
                                                    type="submit">{{ __('login.signin') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="item-2" role="tabpanel">
                                <div class="card card-default form-card">

                                    <div class="card-body">
                                        <h3 class="dark playfare mb-20">{{ __('login.create_your_account') }}</h3>
                                        <form method="POST" action="{{ route('customer-register-account') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <input id="name" type="text"
                                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                        name="name" value="{{ old('name') }}" autocomplete="name"
                                                        autofocus placeholder="{{ __('login.Complete Name') }}">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <input id="email" type="email"
                                                        placeholder="{{ __('login.Email') }}"
                                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <input id="country_code" type="text" placeholder="+86"
                                                        maxlength="3"
                                                        class="form-control @if ($errors->has('country_code')) is-invalid @endif"
                                                        name="country_code" value="{{ old('country_code') }}"
                                                        autocomplete="country_code">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('country_code') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-9 mb-3">
                                                    <input id="phone_number" type="text"
                                                        placeholder="{{ __('login.PHONE NUMBER') }}" maxlength="10"
                                                        class="form-control @if ($errors->has('phone_number')) is-invalid @endif"
                                                        name="phone_number" value="{{ old('phone_number') }}"
                                                        autocomplete="phone_number">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <input id="address" type="text"
                                                        placeholder="{{ __('login.ADDRESS') }}"
                                                        class="form-control @if ($errors->has('address')) is-invalid @endif"
                                                        name="address" value="{{ old('address') }}"
                                                        autocomplete="address">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <input id="password" type="password"
                                                        class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                        name="password" required autocomplete="new-password"
                                                        placeholder="{{ __('login.Password') }}">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <input id="password-confirm" type="password"
                                                        class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                                        placeholder="{{ __('login.Confirm Password') }}"
                                                        name="password_confirmation" required
                                                        autocomplete="new-password">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <input id="referred_by" type="text"
                                                        placeholder="{{ __('login.referred_by') }}"
                                                        class="form-control @if ($errors->has('referred_by')) is-invalid @endif"
                                                        name="referred_by" value="{{ old('referred_by') }}"
                                                        autocomplete="referred_by">
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('referred_by') }}</strong>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-12 mb-3">
                                                    <label class="radio-inline mr-3">
                                                        <input type="radio" name="customer_type" value="individual"
                                                            @if (old('customer_type') == 'individual') checked @endif checked>
                                                        <span></span>{{ __('login.individual') }}
                                                    </label>
                                                    <label class="radio-inline mr-3">
                                                        <input type="radio" name="customer_type" value="corporate"
                                                            @if (old('customer_type') == 'corporate') checked @endif>
                                                        <span></span>{{ __('login.corporate') }}
                                                    </label>
                                                </div> --}}
                                            </div>
                                            <div class="footer">
                                                <button class="btn btn-custom w-100"
                                                    type="submit">{{ __('login.register') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <a href="{{ route('shop') }}"
                        class="btn btn-mod btn-large btn-round w-100">{{ __('login.got_to_shop') }}</a>
                </div>



            </div>
        </main>
    </div>

    @include('frontend.layouts.footer_scripts')
</body>

</html>
