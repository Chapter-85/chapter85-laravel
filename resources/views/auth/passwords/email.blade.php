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
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">

                    <div class="col-md-12">

                        <ul class="nav nav-tabs tpl-tabs animate login-tabs mb-0 " role="tablist">

                            <li class="nav-item">
                                <a href="#item-1" aria-controls="item-1" class="nav-link active" data-bs-toggle="tab"
                                    role="tab" aria-selected="true">Reset Password
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content tpl-tabs-cont section-text login-tab-content pt-0">
                            <div class="tab-pane fade active show" role="tabpanel" id="item-1" role="tabpanel">
                                <div class="card card-default form-card">
                                    <div class="card-body">
                                        <h3 class="dark playfare mb-20">Reset Your Password</h3>
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf

                                            <div class="form-group row">

                                                <div class="col-md-12">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" placeholder="{{ __('E-Mail Address') }}"
                                                        autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn w-100 btn-custom">
                                                        {{ __('Send Password Reset Link') }}
                                                    </button>
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
