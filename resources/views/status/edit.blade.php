@extends('templates.dashboard')

@section('title', 'Edit Status')

@section('content')
    <h1>Edit Status</h1>
    {!! Former::vertical_open()->method('PATCH') !!}
    {!! Former::populate($status) !!}
    @include('status.partials.fields',['update'=>true])
    {!! Former::actions()->large_primary_submit('Save') !!}
    {!! Former::close() !!}
@endsection


