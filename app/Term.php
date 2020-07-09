<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;
    
    public function taxonomy(){
        return $this->hasOne(Taxonomy::class);
    }
}
