@extends('templates.dashboard')

@section('title', 'Password Reset')

@section('content')

    <h1>Password Reset</h1>

    {!! Former::open_vertical('password/email') !!}
    {!! Former::email('email','Email Address')->required() !!}
    {!! Former::actions( Former::submit('Submit')->class('btn btn-primary') ) !!}
    {!! Former::close() !!}

@endsection
