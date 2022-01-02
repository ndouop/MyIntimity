<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CreateUserRequest extends FormRequest
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
        return User::$rules;
    }

    public function messages()
    {
        return [
            'login.required'=>trans("back/request.user.login",['attr'=>'login']),
            //'tell.required'=>'Vous devez spécifier au moins un numero de téléphone',
            'tell.numeric'=>trans("back/request.user.tell"),
            'password.required'=>trans("back/request.user.password"),
            'email.required'=>trans("back/request.user.email"),
            'email.unique'=>trans("back/request.user.email_unique"),
            'login.unique'=>trans("back/request.user.login_unique"),
            'email.email'=>trans("back/request.user.email_email"),
        ];
    }
}
