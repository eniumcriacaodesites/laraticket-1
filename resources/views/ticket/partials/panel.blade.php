<div class="panel panel-default panel-ticket">
    <div class="panel-heading" data-toggle="collapse" data-target="#collapse-ticket-panel-{{ $ticket->id }}">
        <h3 class="panel-title clearfix">
            <div class="col-priority">
                <span class="icon-priority icon-priority-{{ $ticket->priority }}"></span>
            </div>
            <div class="title-row clearfix">
                @if($ticket->client)
                    <strong>{{ $ticket->client->name }}</strong> -
                @endif
                {{ $ticket->title }}
            </div>
        </h3>
    </div>
    <div id="collapse-ticket-panel-{{ $ticket->id }}" class="panel-collapse collapse out">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="description">{{ $ticket->description }}</div>
                    @if($ticket->ticketLogs)
                        <div class="logs list-group">
                            @foreach($ticket->ticketLogs as $log)
                                <div class="list-group-item">
                                    @if($log->user)
                                        <p>
                                            <small class="label label-default">{{ $log->user->email }}</small>
                                        </p>
                                    @endif
                                    {{ $log->message }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="log-form">
                        {!! Former::vertical_open('tickets/edit/'.$ticket->id.'/message/create')->method('PUT')->class('ticket-message-form')->setAttribute('data-ticket-id',$ticket->id) !!}
                        {!! Former::textarea('message','Note') !!}
                        {!! Former::actions()->large_primary_submit('Add Note') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
                <div class="col-sm-2">
                    <a href="{{ url('tickets/edit/'.$ticket->id.'')  }}" class="btn btn-primary btn-sm btn-block"><span
                                class="glyphicon glyphicon-pencil"></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="clearfix">
            <div class="col-assigned-users">
                @if($ticket->assignedUsers && count($ticket->assignedUsers) > 0)
                    <div class="assigned-users">
                        @foreach($ticket->assignedUsers as $assignedUser)
                            <span class="label label-info">{{ $assignedUser->email }}</span>
                        @endforeach
                    </div>
                @else
                    <span class="label label-danger label-assigned-users-none">No Users Assigned</span>
                @endif
            </div>
            <div class="col-status">
                @if($ticket->status)<span class="label label-primary">{{ $ticket->status->name }}</span>@endif
            </div>
        </div>
    </div>
</div>