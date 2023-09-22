@extends('frontend.layouts.master')


@section('content')
    @include('frontend.profile.header')
    @include('layouts.flash_message')

    <div class="main-content">
        <div class="page-content">
            <div class="container center-aligned mt-5">
                <div class="row">
                    <div class="col">
                        <div class="tab-content tpl-tabs-cont section-text">

                                @include('frontend.profile.applicant_info_individual')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
