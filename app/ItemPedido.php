<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $guarded = [];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }
}
