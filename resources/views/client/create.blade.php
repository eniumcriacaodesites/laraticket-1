@extends('templates.dashboard')

@section('title', 'New Client')

@section('content')
    <h1>New Client</h1>
    {!! Former::vertical_open()->method('PUT') !!}
    @include('client.partials.fields',['update'=>false])
    {!! Former::actions()->large_primary_submit('Create') !!}
    {!! Former::close() !!}
@endsection

