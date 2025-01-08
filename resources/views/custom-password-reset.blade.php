@extends('layouts.custom-login-layout')

@section('content')

<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Reset</h3></div>
    <div class="card-body">
        <form method="POST" action="{{route('custom.update')}}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-floating mb-3">
                <input value="{{ $email ?? old('email') }}" aria-describedby="inputEmailFeedback" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" placeholder="name@example.com" />
                <label for="inputEmail">Email address</label>
                @error('email')
                <div id="inputEmailFeedback" class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input aria-describedby="inputPasswordFeedback" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" placeholder="Password" />
                <label for="inputPassword">Password</label>
                @error('password')
                <div id="inputPasswordFeedback" class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input aria-describedby="inputPasswordConfirmationFeedback" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPassword" type="password" placeholder="Confirm Password" />
                <label for="inputPassword">Confirm Password</label>
                @error('password_confirmation')
                <div id="inputPasswordConfirmationFeedback" class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
</div>

@endsection