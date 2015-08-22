<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Auth;
use Redirect;
use Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        return view('account.index');
    }

    public function patchIndex(UserFormRequest $request){
        $user = Auth::user();
        $user->patch($request->all());
        \Flash::success('Account saved.');
        return redirect('account');
    }

}