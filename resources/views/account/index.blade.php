@extends('templates.dashboard')

@section('title', 'My Account')

@section('content')

    <h1>My Account</h1>

    {!! Former::open_vertical()->method('PATCH') !!}
    {!! Former::populate(Auth::user()) !!}
    {!! Former::email('email','Email Address')->required() !!}
    {!! Former::password('password','Password')->help('Leave blank to keep current password') !!}
    {!! Former::actions( Former::submit('Save')->class('btn btn-primary') ) !!}
    {!! Former::close() !!}

@endsection
