<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['client_id','status_id','priority','title','description'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function client(){
        return $this->belongsTo('App\Client');
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
