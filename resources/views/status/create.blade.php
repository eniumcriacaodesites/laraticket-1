@extends('templates.dashboard')

@section('title', 'New Status')

@section('content')
    <h1>New Status</h1>
    {!! Former::vertical_open()->method('PUT') !!}
    @include('status.partials.fields',['update'=>false])
    {!! Former::actions()->large_primary_submit('Create') !!}
    {!! Former::close() !!}
@endsection

