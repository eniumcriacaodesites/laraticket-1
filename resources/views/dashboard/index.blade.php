@extends('templates.dashboard')

@section('scripts')
<script>

</script>
@endsection

@section('title', 'Dashboard')

@section('content')

    <h1>Dashboard</h1>

    <p><a href="{{ url('tickets/create') }}" class="btn btn-primary">Add New Ticket</a></p>

    @foreach($tickets as $ticket)
        @include('ticket.partials.panel',['ticket'=>$ticket])
    @endforeach

@endsection
