<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'estabelecimento_id', 'created_at', 'updated_at'
    ];

    public function estabelecimento() {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function selecaos() {
        return $this->hasMany(Selecao::class);
    }
    
}
