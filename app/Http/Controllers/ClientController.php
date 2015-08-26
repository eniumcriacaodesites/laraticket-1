<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientFormRequest;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $clients = \App\Client::orderBy('name','ASC')->get();
        return view('client.index',['clients'=>$clients]);
    }
    public function getCreate(){
        return view('client.create');
    }
    public function putCreate(ClientFormRequest $request){
        $client = new \App\Client;
        $client->put($request->all());
        \Flash::success('Client saved.');
        return redirect('clients');
    }
    public function getUpdate($clientId){
        $client = \App\Client::find($clientId);
        return view('client.edit',['client'=>$client]);
    }
    public function patchUpdate(ClientFormRequest $request, $clientId){
        $client = \App\Client::find($clientId);
        if(!$client){
            \Flash::error('Client not found');
            return redirect('clients');
        }
        $client->patch($request->all());
        \Flash::success('Client saved.');
        return redirect('clients');
    }
    public function deleteDelete($clientId)
    {
        $client = \App\Client::find($clientId);
        if(!$client){
            \Flash::error('Client not found');
            return redirect('clients');
        }
        $client->delete();
        \Flash::success('Client Deleted');
        return redirect('clients');
    }
}