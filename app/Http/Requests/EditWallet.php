<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditWallet extends FormRequest
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
        return [
            "name"=>"required|max:20|unique:wallets,name,".$this->id,
        ];
    }

    public function messages(){
        return [
            "required"=>"Name must required!",
            "max"=>"You can enter the limited character",
            "unique"=>"Name has exited"
        ];
    }
}
