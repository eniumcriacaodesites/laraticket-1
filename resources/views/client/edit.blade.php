@extends('templates.dashboard')

@section('title', 'Edit Client')

@section('content')
    <h1>Edit Client</h1>
    {!! Former::vertical_open()->method('PATCH') !!}
    {!! Former::populate($client) !!}
    @include('client.partials.fields',['update'=>true])
    {!! Former::actions()->large_primary_submit('Save') !!}
    {!! Former::close() !!}
@endsection


