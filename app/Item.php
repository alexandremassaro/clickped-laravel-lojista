<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function selecaos() {
        return $this->hasMany(Selecao::class);
    }

    public function estabelecimento() {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function complementos() {
        return $this->hasMany(Complemento::class);
    }
}
