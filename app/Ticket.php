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

    public function assignedUsers(){
        return $this->belongsToMany('App\User', 'ticket_users','user_id','ticket_id');
    }

    public function put($data){
        $this->fill($data);
        $this->user_id = \Auth::user()->id;
        $this->save();
        if(isset($data['updateAssignedUsers']) && $data['updateAssignedUsers']){
            $assignedUsers = [];
            if(isset($data['assignedUsers'])){
                $assignedUsers = $data['assignedUsers'];
            }
            $this->clearAndUpdateAssignedUsers($assignedUsers);
        }
        return $this;
    }

    public function patch($data){
        $this->fill($data);
        $this->save();
        if(isset($data['updateAssignedUsers']) && $data['updateAssignedUsers']){
            $assignedUsers = [];
            if(isset($data['assignedUsers'])){
                $assignedUsers = $data['assignedUsers'];
            }
            $this->clearAndUpdateAssignedUsers($assignedUsers);
        }
        return $this;
    }

    private function clearAndUpdateAssignedUsers($assignedUsers){
        $this->assignedUsers()->sync($assignedUsers);
        return $this;
    }

    public static function filter($filters=[]){
        if(!empty($filters)){
            $ticketQuery = self::select('tickets.*');
            if(!empty($filters['assignedUsers'])){
                $ticketQuery->join('ticket_users', 'tickets.id', '=', 'ticket_users.ticket_id');
                $ticketQuery->whereIn('ticket_users.user_id',$filters['assignedUsers']);
            }
            $tickets = $ticketQuery->get();
        }else{
            $tickets = self::all();
        }
        return $tickets;
    }

}
