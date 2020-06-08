<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $fillable = ['key', 'value'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
