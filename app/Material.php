<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'link'];

    // public function materialUnit(){
    //     return $this->hasOne(MaterialUnit::class);
    // }

    public function materialUnits(){
        return $this->hasMany(MaterialUnit::class);
    }

    // public function material_class(){
    //     return $this->belongsTo(MaterialClass::class);
    // }
}
