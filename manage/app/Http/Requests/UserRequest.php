<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users,email,'.($this->user ? $this->user->id : ''),
            'password' => ($this->user && $this->request->all()['password'] ? 'required|min:6|confirmed' : '').($this->user ? '' : 'required|min:6|confirmed'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
