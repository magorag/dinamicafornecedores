<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $timestamps = false;

    protected $fillable = ['nome'];

    public function getResults($name = null)
    {
        if(!$name)
            return $this->get();

        return $this->where('nome','LIKE', "%{$name}%")
            ->get();
    }

    public function fornecedor() {
        return $this->hasMany(Fornecedor::class);
    }
}
