<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusFormRequest;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $statuses = \App\Status::orderBy('weight','ASC')->get();
        return view('status.index',['statuses'=>$statuses]);
    }
    public function getCreate(){
        return view('status.create');
    }
    public function putCreate(StatusFormRequest $request){
        $status = new \App\Status;
        $status->put($request->all());
        \Flash::success('Status saved.');
        return redirect('statuses');
    }
    public function getUpdate($statusId){
        $status = \App\Status::find($statusId);
        return view('status.edit',['status'=>$status]);
    }
    public function patchUpdate(StatusFormRequest $request, $statusId){
        $status = \App\Status::find($statusId);
        if(!$status){
            \Flash::error('Status not found');
            return redirect('statuses');
        }
        $status->patch($request->all());
        \Flash::success('Status saved.');
        return redirect('statuses');
    }
    public function deleteDelete($statusId)
    {
        $status = \App\Status::find($statusId);
        if(!$status){
            \Flash::error('Status not found');
            return redirect('statuses');
        }
        $status->delete();
        \Flash::success('Status Deleted');
        return redirect('statuses');
    }
}