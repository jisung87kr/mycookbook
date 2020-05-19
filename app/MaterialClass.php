<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialClass extends Model
{
    protected $fillable = ['title'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
