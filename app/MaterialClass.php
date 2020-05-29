<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialClass extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function materialUnits(){
        return $this->belongsToMany(MaterialUnit::class, 'material_relationships');
    }
}
