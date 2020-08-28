<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selecao extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function cardapio() {
        return $this->belongsTo(Cardapio::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
