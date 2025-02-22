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

    protected function prepareForValidation()
    {
        $this->merge([
            'guard_name' => strtolower($this->guard_name),
        ]);
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
            'guard_name.required' => 'Necessário selecionar o tipo de controle',
            'order_roles.required' => 'Necessário selecionar a ordem',
            'order_roles.not_in' => 'Valor não elegível para campo ordem',
        ];
    }
}
