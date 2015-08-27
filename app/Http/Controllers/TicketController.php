<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketFormRequest;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $tickets = \App\Ticket::all();
        return view('ticket.index',['tickets'=>$tickets]);
    }
    public function getCreate(){
        $formOptions = [];

        $clients = \App\Client::orderBy('name','ASC')->get();
        $formOptions['client'] = \App\Helpers\FormHelper::objectsToKeyValueArray($clients,'id','name');
        $formOptions['client'] = [''=>'--Not Assigned To Client--']+$formOptions['client'];
        $statuses = \App\Status::orderBy('weight','ASC')->get();
        $formOptions['statuses'] = \App\Helpers\FormHelper::objectsToKeyValueArray($statuses,'id','name');
        $formOptions['priorities'] = array_combine(range(1,10),range(1,10));

        return view('ticket.create',['formOptions'=>$formOptions]);
    }
    public function putCreate(TicketFormRequest $request){
        $ticket = new \App\Ticket;
        $ticket->put($request->all());
        \Flash::success('Ticket saved.');
        return redirect('tickets');
    }
    public function getUpdate($ticketId){
        $ticket = \App\Ticket::find($ticketId);

        $formOptions = [];

        $clients = \App\Client::orderBy('name','ASC')->get();
        $formOptions['client'] = \App\Helpers\FormHelper::objectsToKeyValueArray($clients,'id','name');
        $formOptions['client'] = [''=>'--Not Assigned To Client--']+$formOptions['client'];
        $statuses = \App\Status::orderBy('weight','ASC')->get();
        $formOptions['statuses'] = \App\Helpers\FormHelper::objectsToKeyValueArray($statuses,'id','name');

        $formOptions['priorities'] = array_combine(range(1,10),range(1,10));

        return view('ticket.edit',['ticket'=>$ticket,'formOptions'=>$formOptions]);
    }
    public function patchUpdate(TicketFormRequest $request, $ticketId){
        $ticket = \App\Ticket::find($ticketId);
        if(!$ticket){
            \Flash::error('Ticket not found');
            return redirect('tickets');
        }
        $ticket->patch($request->all());
        \Flash::success('Ticket saved.');
        return redirect('tickets');
    }
    public function deleteDelete($ticketId)
    {
        $ticket = \App\Ticket::find($ticketId);
        if(!$ticket){
            \Flash::error('Ticket not found');
            return redirect('tickets');
        }
        $ticket->delete();
        \Flash::success('Ticket Deleted');
        return redirect('tickets');
    }
}