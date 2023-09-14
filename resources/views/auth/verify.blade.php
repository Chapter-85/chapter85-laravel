@extends('layouts.app')

@section('content')

<div class="container center-aligned vert-center">
@if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
@endif
<div class="row">

    <div class="col-md-12">

        <ul class="nav nav-tabs tpl-tabs animate login-tabs mb-0 " role="tablist">

            <li class="nav-item">
                <a href="#item-1" aria-controls="item-1" class="nav-link active" data-bs-toggle="tab"
                    role="tab" aria-selected="true">{{ __('Verify Your Email Address') }}
                </a>
            </li>
        </ul>
        <div class="tab-content tpl-tabs-cont section-text login-tab-content pt-0">

            <div class="tab-pane fade active show" role="tabpanel" id="item-1" role="tabpanel">
                <div class="card card-default form-card">



                    <div class="card-body">
                        <h3 class="dark playfare mb-20">{{ __('Verify Your Email Address') }}</h3>

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</div>
@endsection
