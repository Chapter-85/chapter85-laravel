<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
        <meta charset="utf-8" />
        <title>Lock | CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('theme/dist/default/assets/images/favicon.ico') }}">
        <script src="{{ asset('theme/dist/default/assets/js/layout.js') }}"></script>
        <link href="{{ asset('theme/dist/default/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('theme/dist/default/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('theme/dist/default/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('theme/dist/default/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

        <style>
            .invalid-feedback{
                display: block;
            }
        </style>
    </head>

    <body>
        <div class="auth-page-wrapper pt-5">
            <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
                <div class="bg-overlay"></div>
                
                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 text-white-50">
                                <div>
                                    <h4 href="{{route('index')}}" class="d-inline-block auth-logo text-white">
                                        <img src="{{ asset('bic-logo.png') }}" alt="" height="60">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">
                                <div class="card-body p-4"> 
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Lock Screen</h5>
                                        <h5 class="text-primary">Hi,</h5>
                                        <h5 class="font-size-15 mt-3">{{auth()->user()->name}}</h5>
                                    </div>
                                    <div class="user-thumb text-center">
                                        <p class="text-muted">Enter your password to unlock the screen!</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('lock.screen.update') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="userpassword">Password</label>
                                                <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" id="password-input" placeholder="Enter password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @if(session()->has('error'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ session()->get('error') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-2 mt-4">
                                                <button class="btn btn-success w-100" type="submit">Unlock</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Design & Develop by Beaconhouse Technology</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="{{ asset('theme/dist/default/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/libs/particles.js/particles.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/js/pages/particles.app.js') }}"></script>
        <script src="{{ asset('theme/dist/default/assets/js/pages/password-addon.init.js') }}"></script>
    </body>
</html>