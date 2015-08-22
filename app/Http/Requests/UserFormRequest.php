<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;
use Route;

class UserFormRequest extends Request {

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
        $user = false;
        if($this->method() == 'PATCH') {
            $routeAction = $this->route()->getAction();
            $routeParameters = $this->route()->parameters();
            if (strstr($routeAction['uses'], 'patchIndex')) {
                $user = Auth::user();
            } else {
                $user = User::find($routeParameters['one']);
            }
        }
        switch($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'PUT': {
                return [
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                ];
            }
            case 'PATCH': {
                return [
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'password'   => 'min:8',
                ];
            }
            default:
                break;
        }
    }

}
