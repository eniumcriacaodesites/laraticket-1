<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getIndex(){
        $filters = [
            'assignedUsers' => [\Auth::user()->id],
        ];
        $tickets = \App\Ticket::filter($filters);
        return view('dashboard.index',['tickets'=>$tickets]);
    }
}
