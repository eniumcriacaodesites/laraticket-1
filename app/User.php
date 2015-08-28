<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function put($data){
        $data['password'] = \Hash::make($data['password']);
        $this->fill($data);
        $this->save();
        if(isset($data['updateRoles']) && $data['updateRoles']){
            $this->clearAndUpdateRoles($data);
        }
        return $this;
    }

    public function patch($data){
        if(!empty($data['password'])){
            $data['password'] = \Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        $this->fill($data);
        $this->save();
        if(isset($data['updateRoles']) && $data['updateRoles']){
            $this->clearAndUpdateRoles($data);
        }
        return $this;
    }

    private function clearAndUpdateRoles($data=[]){
        $this->detachRoles($this->roles);
        if(!empty($data['roles'])) {
            $this->attachRoleIds($data['roles']);
        }
    }

    public function attachRoleIds($roleIds){
        foreach ($roleIds as $rid) {
            $this->attachRole($rid);
        }
        return $this;
    }

}
