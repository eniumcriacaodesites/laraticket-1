<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name','weight'];

    public function put($data){
        $this->fill($data);
        $this->save();
        return $this;
    }

    public function patch($data){
        $this->fill($data);
        $this->save();
        return $this;
    }

}
