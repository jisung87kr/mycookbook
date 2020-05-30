<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'parent', 'user_id', 'commentable_type', 'commentable_id'];

    public function commentable(){
        return $this->morphTo();
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function parent(){
        return $this->belongsTo(Comment::class, 'parent', 'id');
    }
}
