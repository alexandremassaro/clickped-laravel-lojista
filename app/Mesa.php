<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $guarded = [];
    
    public function estabelecimento() {
        $this->belongsTo(Estabelecimento::class);
    }
}
