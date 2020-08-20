<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcaoItemPedido extends Model
{
    protected $guarded = [];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }
}
