<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Route;

class ClientFormRequest extends Request {

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
            $cid = false;
            if(isset($routeParameters['clientId'])){
                $cid = $routeParameters['clientId'];
            }else if(isset($routeParameters['one'])){
                $cid = $routeParameters['one'];
            }
            $client = \App\Client::find($cid);
            if(!$client){
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
                    'name' => 'required|unique:clients,name',
                ];
            }
            case 'PATCH': {
                return [
                    'name' => 'required|unique:clients,name,' . $client->id,
                ];
            }
            default:
                return [];
                break;
        }
    }

}
