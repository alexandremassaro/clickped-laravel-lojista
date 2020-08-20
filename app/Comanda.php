<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $guarded = [];

    public function pedidos() {
        return $this->hasMany(Pedido::class);
    }

    public function mesa() {
        return $this->belongsTo(Mesa::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
