<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFornecedorFomRequest extends FormRequest
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
        $id = $this->segment(3);
        return [
            'nome_fantasia' => "required|min:5|unique:fornecedors,nome_fantasia,{$id},id",
            'servico_id'    => 'required|exists:servicos,id',
            'description'   => 'max:1000',
        ];
    }
}
