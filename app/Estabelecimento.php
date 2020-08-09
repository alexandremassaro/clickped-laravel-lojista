<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    protected $guarded = [];
    
    public function users() {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function attachUser($user) {
        $this->users()->syncWithoutDetaching([$user]);
    }
}