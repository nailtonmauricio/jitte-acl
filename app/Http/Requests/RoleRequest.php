<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required | max:255',
            'guard_name' => 'required | max:255',
            'order_roles' => 'required|integer|not_in:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome para o nível de acesso não pode estar vazio',
            'guard_name.required' => 'Necessário preencher o guard_name',
            'order_roles.required' => 'Necessário preencher a ordem',
            'order_roles.not_in' => 'Valor não elegível para campo ordem.',
        ];
    }
}
