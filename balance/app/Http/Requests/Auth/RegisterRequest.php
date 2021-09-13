<?php

namespace App\Http\Requests\Auth;

use App\Traits\JWT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    use JWT;

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
            'username'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password'  => ['required', 'string', 'min:6']
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        if ($this->has('password') && $this->filled('password')) {
            $request['password'] = Hash::make($this->password);
        }

        return $request;
    }
}
