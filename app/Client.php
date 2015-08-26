<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function put($data){
        $this->fill($data);
        $this->user_id = \Auth::user()->id;
        $this->save();
        return $this;
    }

    public function patch($data){
        $this->fill($data);
        $this->save();
        return $this;
    }
}
