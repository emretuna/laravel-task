@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 text-center">
                    @guest
                        <p>
                            Please sign up or login to use the app.
                        </p>
                       <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endguest

                    @auth
                     <p>
                            Click to view your dashboard.
                        </p>
                        <a class="btn btn-primary" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                    @endauth
        </div>
    </div>
</div>
@endsection
