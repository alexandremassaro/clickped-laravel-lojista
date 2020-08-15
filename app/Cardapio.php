<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    protected $guarded = [];

    public function estabelecimento() {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function selecaos() {
        return $this->hasMany(Selecao::class);
    }
    
}
