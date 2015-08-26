@extends('templates.dashboard')

@section('title', 'New User')

@section('content')
    <h1>New User</h1>
    {!! Former::vertical_open()->method('PUT') !!}
    @include('user.partials.fields',['update'=>false])
    {!! Former::actions()->large_primary_submit('Create') !!}
    {!! Former::close() !!}
@endsection

