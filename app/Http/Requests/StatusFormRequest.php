<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Route;

class StatusFormRequest extends Request {

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
        $status = false;
        if($this->method() == 'PATCH') {
            $routeAction = $this->route()->getAction();
            $routeParameters = $this->route()->parameters();
            $cid = false;
            if(isset($routeParameters['statusId'])){
                $cid = $routeParameters['statusId'];
            }else if(isset($routeParameters['one'])){
                $cid = $routeParameters['one'];
            }
            $status = \App\Status::find($cid);
            if(!$status){
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
                    'name' => 'required|unique:statuses,name',
                ];
            }
            case 'PATCH': {
                return [
                    'name' => 'required|unique:statuses,name,' . $status->id,
                ];
            }
            default:
                return [];
                break;
        }
    }

}
