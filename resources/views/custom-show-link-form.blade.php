@extends('layouts.custom-login-layout')

@section('content')

<div class="card shadow-lg border-0 rounded-lg mt-5">
    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
    <div class="card-body">
        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
        
        @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif

        <form method="POST" action="{{route('custom.reset')}}">
            @csrf
            <div class="form-floating mb-3">
                <input aria-describedby="inputEmailFeedback" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" placeholder="name@example.com" />
                <label for="inputEmail">Email address</label>
                
                @error('email')
                <div id="inputEmailFeedback" class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
                
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <a class="small" href="{{route('custom.login.post')}}">Return to login</a>
                <button type="submit" class="btn btn-primary">Send Reset Password Link</button>
            </div>
        </form>
    </div>
    <div class="card-footer text-center py-3">
        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
    </div>
</div>

@endsection