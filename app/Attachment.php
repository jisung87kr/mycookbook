<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['attachmentable_id', 'attachmentable_type', 'user_id', 'fname', 'path', 'mime', 'byte'];

    public function attachmentable(){
        return $this->morphTo(Attachment::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
