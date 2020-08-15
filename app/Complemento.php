<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
    protected $guarded = [];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function opcaos() {
        return $this->hasMany(Opcao::class);
    }
}
