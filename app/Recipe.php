<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = false;
    protected $fillable = ['step', 'content'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
