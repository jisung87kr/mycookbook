<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialUnit extends Model
{
    public $timestamps = false;

    public function materialClasses(){
        return $this->belongsToMany(MaterialClass::class, 'material_relationships');
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
