<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = ['comment', 'parent', 'user_id', 'commentable_type', 'commentable_id'];
    protected $with =['post', 'user'];
    public function commentable(){
        return $this->morphTo();
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'parent')->withTrashed()->latest();
    }

    public function parent(){
        // return $this->belongsTo(Comment::class, 'parent', 'id');
        return $this->belongsTo(Comment::class, 'parent');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
