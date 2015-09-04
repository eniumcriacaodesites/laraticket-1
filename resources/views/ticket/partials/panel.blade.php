<div class="panel panel-default panel-ticket ticket-priority-{{ $ticket->priority }}">
    <div class="panel-heading" data-toggle="collapse" data-target="#collapse-ticket-panel-{{ $ticket->id }}">
        <h3 class="panel-title">
            @if($ticket->client)
                <span class="label label-info">{{ $ticket->client->name }}</span>
            @endif
            {{ $ticket->title }}
        </h3>
    </div>
    <div id="collapse-ticket-panel-{{ $ticket->id }}" class="panel-collapse collapse out">
        <div class="panel-body">
            <div class="description">{{ $ticket->description }}</div>
        </div>
    </div>
</div>