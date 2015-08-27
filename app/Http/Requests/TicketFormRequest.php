<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Route;

class TicketFormRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
        //return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $client = false;
        if($this->method() == 'PATCH') {
            $routeAction = $this->route()->getAction();
            $routeParameters = $this->route()->parameters();
            $tid = false;
            if(isset($routeParameters['ticketId'])){
                $tid = $routeParameters['ticketId'];
            }else if(isset($routeParameters['one'])){
                $tid = $routeParameters['one'];
            }
            $ticket = \App\Ticket::find($tid);
            if(!$ticket){
                dd('error');
            }
        }
        switch($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'PUT': {
                return [
                    'title' => 'required',
                    'status_id' => 'required',
                    'priority' => 'required',
                ];
            }
            case 'PATCH': {
                return [
                    'title' => 'required',
                    'status_id' => 'required',
                    'priority' => 'required',
                ];
            }
            default:
                return [];
                break;
        }
    }

}
