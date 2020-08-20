<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'status' => 0,
    ];

    public function getStatusAttribute($attribute) {
        return $this->statusOptions()[$attribute];
    }

    public function itemPedidos() {
        return $this->hasMany(ItemPedido::class);
    }

    public function opcaoItemPedidos() {
        return $this->hasMany(OpcaoItemPedido::class);
    }

    public function comanda() {
        return $this->belongsTo(Comanda::class);
    }

    public function statusOptions(){
        return [
            0 => 'Pendente',
            1 => 'Preparando',
            2 => 'Entregando',
            3 => 'Finalizado',
            4 => 'Cancelado'
        ];
    }
}
