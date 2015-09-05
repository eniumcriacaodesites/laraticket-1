<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketLog extends Model
{
    protected $fillable = ['user_id','ticket_id','message'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function ticket(){
        return $this->belongsTo('App\Ticket');
    }

    public function put($data){
        $this->fill($data);
        $this->user_id = \Auth::user()->id;
        $this->save();
    }

    public function patch($data){
        $this->fill($data);
        $this->save();
        return $this;
    }

}
