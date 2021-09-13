<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean']
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        if ($this->has('email') && $this->filled('email')) {
            $request['user'] = User::getByEmail($this->email);
            $request['credentials'] = ['email' => $this->email, 'password' => $this->password];
        }

        return $request;
    }
}
