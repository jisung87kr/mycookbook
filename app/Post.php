<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'created_at', 'updated_at'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function materialClasses(){
        return $this->hasMany(MaterialClass::class);
    }

    public function recipes(){
        return $this->hasMany(Recipe::class);
    }

    public function taxonomies(){
        return $this->belongsToMany(Taxonomy::class, 'term_relationships');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function postMetas(){
        return $this->hasMany(PostMeta::class);
    }
}
