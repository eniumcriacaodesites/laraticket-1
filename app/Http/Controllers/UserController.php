<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        $users = \App\User::all();
        return view('user.index',['users'=>$users]);
    }
    public function getCreate(){
        return view('user.create');
    }
    public function putCreate(UserFormRequest $request){
        $user = new \App\User;
        $user->put($request->all());
        \Flash::success('User saved.');
        return redirect('users');
    }
    public function getUpdate($userId){
        $user = \App\User::find($userId);
        return view('user.edit',['user'=>$user]);
    }
    public function patchUpdate(UserFormRequest $request, $userId){
        $user = \App\User::find($userId);
        if(!$user){
            \Flash::danger('User not found');
            return redirect('users');
        }
        $user->patch($request->all());
        \Flash::success('User saved.');
        return redirect('users');
    }
    public function deleteDelete($userId)
    {
        $user = \App\User::find($userId);
        if(!$user){
            \Flash::danger('User not found');
            return redirect('users');
        }
        $user->delete();
        \Flash::success('User Deleted');
        return redirect('users');
    }
}