<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userUpdate extends FormRequest
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
            "name"=>"required|max:20",
            "email"=>"required|email|unique:users,email,".$this->id,
            "phone"=>"required|numeric",
            "address"=>"required",
            "gender"=>"required"
        ];
    }

    public function messages(){
        return [
            "required"=>":attribute must required",
            "max"=>"You can enter the limited character",
            "numeric"=>"Invalid form!!",
            "unique"=>"email has exited!"
        ];
    }
}
