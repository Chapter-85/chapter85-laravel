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
            <div class="container center-aligned vert-center">

                <div class="row">

                    <div class="col-md-12">

                        <ul class="nav nav-tabs tpl-tabs animate login-tabs mb-0 " role="tablist">

                            <li class="nav-item">
                                <a href="#item-1" aria-controls="item-1" class="nav-link active" data-bs-toggle="tab"
                                    role="tab" aria-selected="true">{{ __('Confirm Password') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content tpl-tabs-cont section-text login-tab-content pt-0">

                            <div class="tab-pane fade active show" role="tabpanel" id="item-1" role="tabpanel">
                                <div class="card card-default form-card">



                                    <div class="card-body">
                                        <h3 class="dark playfare mb-20">Reset Your Password</h3>
                                        <p>Please confirm your password.</p>

                                        <form method="POST" action="{{ route('password.confirm') }}">
                                            @csrf

                                            <div class="form-group row">

                                                <div class="col-md-12">
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="current-password"
                                                        placeholder="{{ __('Password') }}">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-custom w-100">
                                                        {{ __('Confirm Password') }}
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </main>
    </div>
    @include('frontend.layouts.footer_scripts')
</body>

</html>
