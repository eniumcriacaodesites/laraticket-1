@extends('templates.dashboard')

@section('title', 'New Ticket')

@section('content')
    <h1>New Ticket</h1>
    {!! Former::vertical_open()->method('PUT') !!}
    @include('ticket.partials.fields',['update'=>false])
    {!! Former::actions()->large_primary_submit('Create') !!}
    {!! Former::close() !!}
@endsection

