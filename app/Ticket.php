<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['client_id','status_id','priority','title','description'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

}
