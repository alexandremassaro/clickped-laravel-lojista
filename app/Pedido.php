<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

    public function itemPedidos() {
        return $this->hasMany(ItemPedido::class);
    }

    public function opcaoItemPedidos() {
        return $this->hasMany(OpcaoItemPedido::class);
    }

    public function comanda() {
        return $this->belongsTo(Comanda::class);
    }
}
