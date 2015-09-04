<div class="panel panel-default panel-ticket">
    <div class="panel-heading">
        <h3 class="panel-title">
                @if($ticket->client)
                    <span class="label label-info">{{ $ticket->client->name }}</span>
                @endif
                    {{ $ticket->title }}
        </h3>
    </div>
    <div class="panel-body">
        <div class="description">{{ $ticket->description }}</div>
    </div>
</div>