<?php

namespace App\Http\Requests\API;

use App\Models\Role_user;
use InfyOm\Generator\Request\APIRequest;

class CreateRole_userAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Role_user::$rules;
    }
}
