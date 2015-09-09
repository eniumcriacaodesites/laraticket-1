@extends('templates.dashboard')

@section('scripts')
<script>
$(document).ready(function(){
    $('.ticket-message-form').on('submit', function(e) {
        e.preventDefault();  //prevent form from submitting
        var actionURL = $(this).attr('action');
        var message = $('[name="message"]',this).val();
        var token = $('[name="_token"]',this).val();
        var ticketId = $(this).data('ticket-id');
        var response = ajaxCreateTicketMessage(actionURL, ticketId, message, token);
    });
    function ajaxCreateTicketMessage(actionURL, ticketId, message, token){
        $.ajax({
            url: actionURL,
            type: 'PUT',
            data: {'_token': token, 'message': message},
            dataType: 'JSON',
            success: function (data) {
                //console.log(data);
                //console.log(ticketId);
                ajaxRefreshTicket(ticketId);
            }
        });
    }
    function ajaxRefreshTicket(ticketId){
        $.ajax({
            url: 'tickets/show/'+ticketId+'',
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                refreshTicket(data.ticket);
            }
        });
    }
    function refreshTicket(ticket){
        //messages
        console.log(ticket.ticketLogs);
    }
});
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
