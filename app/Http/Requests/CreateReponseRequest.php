<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Reponse;

class CreateReponseRequest extends FormRequest
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
        return Reponse::$rules;
    }

    public function messages(){
        'message.required' => trans("back/request.responseCreate.message"),
        'sujet_id.required' => trans("back/request.responseCreate.sujet_id")
    }
}
