<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketFormRequest;
use App\Http\Requests\TicketMessageFormRequest;

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
        $users = \App\User::all();
        $formOptions['users'] = \App\Helpers\FormHelper::objectsToKeyValueArray($users,'id','email');
        return view('ticket.create',['formOptions'=>$formOptions]);
    }
    public function putCreate(TicketFormRequest $request){
        $ticket = new \App\Ticket();
        $ticket->put($request->all());
        $newClient = trim($request->client_new);
        if(!empty($newClient)){
            $client = new \App\Client();
            $client->put(['name'=>$newClient]);
            $ticket->patch(['client_id'=>$client->id]);
        }
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
        $users = \App\User::all();
        $formOptions['users'] = \App\Helpers\FormHelper::objectsToKeyValueArray($users,'id','email');
        return view('ticket.edit',['ticket'=>$ticket,'formOptions'=>$formOptions]);
    }
    public function patchUpdate(TicketFormRequest $request, $ticketId){
        $ticket = \App\Ticket::find($ticketId);
        $ticket->patch($request->all());
        if(!$ticket){
            \Flash::error('Ticket not found');
            return redirect('tickets');
        }
        $newClient = trim($request->client_new);
        if(!empty($newClient)){
            $client = new \App\Client();
            $client->put(['name'=>$newClient]);
            $ticket->patch(['client_id'=>$client->id]);
        }
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

    public function getShow(\Illuminate\Http\Request $request, $ticketId){
        $ticket = \App\Ticket::find($ticketId);


        //Need to re-set magic methods
        $ticket->ticketLogs = $ticket->ticketLogs;
        foreach($ticket->ticketLogs as $ticketLogKey => $ticketLog){
            $ticket->ticketLogs[$ticketLogKey]->user = $ticketLog->user;
        }

        if($request->wantsJson()) {

            return response()->json(['ticket' => $ticket]);
        }else{
            return '';
        }
    }

    public function putMessageCreate($ticketId, TicketMessageFormRequest $request){
        $ticketLog = new \App\TicketLog();
        $ticketLog->put($request->all());
        $ticketLog->ticket_id = $ticketId;
        $ticketLog->save();
        if($request->wantsJson()) {
            return response()->json(['ticketLogId' => $ticketLog->id]);
        }else{
            \Flash::success('Message Created');
            return redirect('tickets/edit/'.$ticketId);
        }
    }
}