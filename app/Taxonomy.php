<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $fillable = ['term_id', 'taxonomy', 'description', 'parent', 'count'];
    public $timestamps = false;
    // public function termRelationships(){
    //     return $this->hasMany(TermRelationship::class);
    // }
    public function posts(){
        return $this->belongsToMany(Post::class, 'term_relationships');
    }

    public function taxonomies(){
        return $this->hasMany(Taxonomy::class, 'parent');
    }

    public function parent(){
        return $this->belongsTo(Taxonomy::class, 'parent', 'id');
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }
}
