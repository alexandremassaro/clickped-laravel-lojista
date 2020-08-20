<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $guarded = [];
    
    public function estabelecimento() {
        return $this->belongsTo(Estabelecimento::class);
    }

    public function comandas() {
        return $this->hasMany(Comanda::class);
    }
}
