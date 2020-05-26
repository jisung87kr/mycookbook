<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    public $timestamps = false;
    // public function termRelationships(){
    //     return $this->hasMany(TermRelationship::class);
    // }
    public function posts(){
        return $this->belongsToMany(Post::class, 'term_relationships');
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }
}
