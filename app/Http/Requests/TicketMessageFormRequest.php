<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Route;

class TicketMessageFormRequest extends Request {

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
        switch($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'PUT': {
                return [
                    'message' => 'required',
                ];
            }
            case 'PATCH': {
                return [
                    'message' => 'required',
                ];
            }
            default:
                return [];
                break;
        }
    }

}
