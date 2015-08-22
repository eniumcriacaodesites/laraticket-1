@extends('templates.dashboard')

@section('title', 'Password Reset')

@section('content')
    <h1>Password Reset</h1>

    {!! Former::open_vertical('password/reset') !!}
    {!! Former::hidden('token',$token) !!}
    {!! Former::email('email','Email Address')->required()->value(old('email')) !!}
    {!! Former::password('password','New Password')->required() !!}
    {!! Former::password('password_confirmation','Confirm New Password')->required() !!}
    {!! Former::actions( Former::submit('Reset Password')->class('btn btn-primary') ) !!}
    {!! Former::close() !!}
@endsection
