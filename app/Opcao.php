<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    protected $guarded = [];

    public function complemento() {
        return $this->belongsTo(Complemento::class);
    }
}
