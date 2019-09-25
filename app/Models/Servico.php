<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function getResults($name = null)
    {
        if(!$name)
            return $this->get();

        return $this->where('name','LIKE', "%{$name}%")
                    ->get();
    }

    public function fornecedors()
    {
        return $this->hasMany(Fornecedor::class);
    }
}
