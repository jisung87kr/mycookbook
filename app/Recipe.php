<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['step', 'content'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
