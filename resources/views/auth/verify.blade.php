@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @lang('auth.verify_your_email_address')
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang('auth.fresh_verification_link_sent')
                        </div>
                    @endif

                    @lang('auth.check_email_for_verification_link')
                    @lang('auth.if_did_not_receive_email'),
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            @lang('auth.click_request_another')
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
