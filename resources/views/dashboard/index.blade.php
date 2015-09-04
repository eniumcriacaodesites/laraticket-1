@extends('templates.dashboard')

@section('title', 'Dashboard')

@section('content')

    <h1>Dashboard</h1>

    <p><a href="{{ url('tickets/create') }}" class="btn btn-primary">Add New Ticket</a></p>

    @foreach($tickets as $ticket)
        @include('ticket.partials.panel',['ticket'=>$ticket])
    @endforeach


    <table class="table table-striped table-bordered datatable">
        <thead>
        <tr>
            <th>Client</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Title</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Assigned To</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>
                    @if($ticket->client)
                        {{ $ticket->client->name }}
                    @endif
                </td>
                <td>
                    @if($ticket->status)
                        {{ $ticket->status->name }}
                    @endif
                </td>
                <td>{{ $ticket->priority }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ date('F d, Y', strtotime($ticket->created_at)) }}</td>
                <td>
                    @if($ticket->user)
                        {{ $ticket->user->email }}
                    @endif
                </td>
                <td>
                    @if($ticket->assignedUsers)
                        <ul>
                            @foreach($ticket->assignedUsers as $assignedUser)
                                <li>{{ $assignedUser->email }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    <!-- Split button -->
                    <div class="btn-group">
                        <a href="{{ url('tickets/edit/'.$ticket->id.'')  }}" class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('tickets/edit/'.$ticket->id.'') }}">Edit</a></li>
                            <li class="divider"></li>
                            <li>
                                {!! Former::vertical_open('tickets/delete/'.$ticket->id)->method('DELETE')->class('form_delete form-confirm-delete') !!}
                                <input type="hidden" class="delete-name" name="delete-name" value="{{ $ticket->name }}" />
                                <button id="button-delete-{{$ticket->id}}" type="submit" class="btn btn-danger btn-block btn-xs">Delete</button>
                                {!! Former::close() !!}
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
