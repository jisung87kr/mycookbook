<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'parent', 'user_id', 'commentable_type', 'commentable_id'];
    protected $with =['post', 'user'];
    public function commentable(){
        return $this->morphTo();
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'parent')->latest();
    }

    public function parent(){
        return $this->belongsTo(Comment::class, 'parent', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
