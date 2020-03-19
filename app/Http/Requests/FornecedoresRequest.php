<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedoresRequest extends FormRequest
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
            'nome_fantasia' => "required|string|unique:fornecedors",
            'razao_social'  => "required|string",
            'cnpj'          => "required|string|unique:fornecedors",
            'servico_id'    => "required",
            'tags'          => "required|string",
            'contato'       => "required|string",
            'cargo'         => "required|string",
            'telefone1'     => "required|string",
            'email'         => "required|string",
            'rua'           => "required|string",
            'bairro'        => "required|string",
            'estado_id'     => "required",
        ];
    }
}
