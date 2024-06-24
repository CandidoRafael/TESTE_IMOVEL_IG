<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CorretorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $corretorId = $this->route('id') ?? null;

        return [
            'name' => 'required|string|max:20|min:2',
            'cpf' => [
                'required',
                'string',
                'size:14',
                'unique:corretor,cpf,' . $corretorId, // ignorar o CPF do próprio corretor no update
            ],
            'creci' => [
                'required',
                'string',
                'size:8',
                'unique:corretor,creci,' . $corretorId, // ignorar o CRECI do próprio corretor no update
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 20 caracteres.',
            'name.min' => 'O campo nome deve ter no mínimo 2 caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.size' => 'O campo CPF deve ter exatamente 14 dígitos.',
            'cpf.unique' => 'CPF já registrado, tente novamente.',
            'creci.required' => 'O campo CRECI é obrigatório.',
            'creci.size' => 'O campo CRECI deve ter exatamente 8 dígitos.',
            'creci.unique' => 'CRECI já registrado, tente novamente.',
        ];
    }
}
