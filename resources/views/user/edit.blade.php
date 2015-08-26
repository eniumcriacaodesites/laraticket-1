@extends('templates.dashboard')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User</h1>
    {!! Former::vertical_open()->method('PATCH') !!}
    {!! Former::populate($user) !!}
    @include('user.partials.fields',['update'=>true])
    {!! Former::actions()->large_primary_submit('Save') !!}
    {!! Former::close() !!}
@endsection


