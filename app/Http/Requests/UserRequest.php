<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'roles' => 'required',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            // No update, o campo 'password' não é obrigatório e o email deve ser único, excluindo o atual
            $rules['password'] = 'nullable|string|min:6';
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->route('user')->id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'email.required' => 'Campo e-mail é obrigatório!',
            'email.email' => 'Necessário enviar e-mail válido!',
            'email.unique' => 'O e-mail já está cadastrado!',
            'password.required_if' => 'Campo senha é obrigatório!',
            'password.min' => 'Senha com no mínimo :min caracteres!',
            'roles.required' => 'Necessário escolher um nível e acesso.'
        ];
    }
}
