<div class="panel panel-default panel-ticket ticket-priority-{{ $ticket->priority }}">
    <div class="panel-heading" data-toggle="collapse" data-target="#collapse-ticket-panel-{{ $ticket->id }}">
        <h3 class="panel-title clearfix">
            <div class="pull-right">
                <a href="{{ url('tickets/edit/'.$ticket->id.'')  }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
            <div class="title-row clearfix">
                @if($ticket->status)<span class="label label-info">{{ $ticket->status->name }}</span>@endif
            @if($ticket->client)
                <strong>{{ $ticket->client->name }}</strong> -
            @endif
            {{ $ticket->title }}
                </div>

            @if($ticket->assignedUsers)
            <div class="assigned-users">
                @foreach($ticket->assignedUsers as $assignedUser)
                    <span class="label label-default">{{ $assignedUser->email }}</span>
                @endforeach
            </div>
            @endif
        </h3>
    </div>
    <div id="collapse-ticket-panel-{{ $ticket->id }}" class="panel-collapse collapse out">
        <div class="panel-body">
            <div class="description">{{ $ticket->description }}</div>
        </div>
    </div>
</div>