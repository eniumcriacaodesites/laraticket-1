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
        refreshTicketMessages(ticket, ticket.ticketLogs);
    }
    function refreshTicketMessages(ticket, messages){
        $('.panel-ticket-'+ticket.id+' .logs .log').remove();
        $('.panel-ticket-'+ticket.id+' .log-form [name="message"]').val('');
        for(var i=0;i<messages.length;i++){
            var logHTML = '<div class="log list-group-item">';
            logHTML += '<p><small class="label label-default"><strong>'+messages[i].created_at+'</strong> - '+messages[i].user.email+'</small></p>';
            logHTML += messages[i].message;
            logHTML += '</div>';
            $('.panel-ticket-'+ticket.id+' .logs').append(logHTML);
        }
    }
});