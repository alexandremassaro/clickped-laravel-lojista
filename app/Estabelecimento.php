<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    protected $guarded = [];
    
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function mesas() {
        return $this->hasMany(Mesa::class);
    }

    public function cardapios() {
        return $this->hasMany(Cardapio::class);
    }

    public function categorias() {
        return $this->hasMany(Categoria::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function attachUser($user) {
        $this->users()->syncWithoutDetaching([$user]);
    }

}