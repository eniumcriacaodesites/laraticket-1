<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name','weight','billable','archivable'];

    public function put($data){
        $this->fill($data);
        $this->save();
        return $this;
    }

    public function patch($data){
        $this->fill($data);
        if(isset($data['updateBillable']) && $data['updateBillable']){
            if(empty($data['billable'])){
                $this->billable = false;
            }
        }
        if(isset($data['updateArchivable']) && $data['updateArchivable']){
            if(empty($data['archivable'])){
                $this->archivable = false;
            }
        }
        $this->save();
        return $this;
    }

}
