<?php

namespace App\Http\Controllers;

use App\Helpers\FormHelper;
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
        $formOptions = [];
        $roles = \App\Role::all();
        $roleCheckboxes = [];
        foreach($roles as $role){
            $roleCheckboxes[$role->name] = [
                'name'=>'roles[]',
                'value' => $role->id,
            ];
        }
        return view('user.create',['roleCheckboxes'=>$roleCheckboxes]);
    }
    public function putCreate(UserFormRequest $request){
        $user = new \App\User;
        $user->put($request->all());
        \Flash::success('User saved.');
        return redirect('users');
    }
    public function getUpdate($userId){
        $user = \App\User::find($userId);
        $roles = \App\Role::all();
        $roleCheckboxes = [];
        foreach($roles as $role){
            $roleCheckboxes[$role->name] = [
                'name'=>'roles[]',
                'value' => $role->id,
                'checked' => $user->hasRole($role->name),
            ];
        }
        return view('user.edit',['user'=>$user,'roleCheckboxes'=>$roleCheckboxes]);
    }
    public function patchUpdate(UserFormRequest $request, $userId){
        $user = \App\User::find($userId);
        if(!$user){
            \Flash::error('User not found');
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
            \Flash::error('User not found');
            return redirect('users');
        }
        $user->delete();
        \Flash::success('User Deleted');
        return redirect('users');
    }
}