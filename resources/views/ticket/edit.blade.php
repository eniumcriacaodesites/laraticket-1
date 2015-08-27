@extends('templates.dashboard')

@section('title', 'Edit Ticket')

@section('content')
    <h1>Edit Ticket</h1>
    {!! Former::vertical_open()->method('PATCH') !!}
    {!! Former::populate($ticket) !!}
    @include('ticket.partials.fields',['update'=>true])
    {!! Former::actions()->large_primary_submit('Save') !!}
    {!! Former::close() !!}
@endsection


