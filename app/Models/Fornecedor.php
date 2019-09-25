<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'razao_social', 'nome_fantasia', 'cnpj', 'inscricao_estadual', 'inscricao_municipal', 'servico_id', 'tags',
        'contato', 'cargo', 'telefone1', 'telefone2', 'telefone3', 'email', 'redes_sociais', 'rua', 'bairro', 'cidade', 'estado', 'cep',
        'description', 'avalicao_preco', 'avalicao_servico'
    ];

    public function getResults($data, $total)
    {
        if(!isset($data['filter']) && !isset($data['tags']) && !isset($data['description']))
            return $this->paginate($total);

        return $this->where(function($query) use ($data){

            if(isset($data['filter'])){
                $filter = $data['filter'];
                $query->where('tags', $filter);
                $query->orWhere('description', 'LIKE', "%{$filter}%");
            }

            if(isset($data['tags'])){
                $tags = $data['tags'];
//                $query->where('tags', $data['tags']);
                $query->where('tags', 'LIKE', "%{$tags}%");
            }

            if(isset($data['description'])){
                $description = $data['description'];
                $query->where('description', 'LIKE', "%{$description}%");
            }
        })//->toSql();dd($results);
        ->paginate($total);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
