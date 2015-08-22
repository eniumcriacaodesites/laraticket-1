@extends('templates.dashboard')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>

    {!! Former::open_vertical('auth/login') !!}
    {!! Former::email('email','Email Address')->required() !!}
    {!! Former::password('password','Password')->required() !!}
    {!! Former::actions( Former::submit('Submit')->class('btn btn-primary') ) !!}
    {!! Former::close() !!}

    <hr/>
    <p><strong>Trouble Logging In?</strong> <a href="{{ url('password/email') }}">Click Here To Reset Your Password</a></p>
@endsection
