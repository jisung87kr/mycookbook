<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'unit'];

    public function material_class(){
        return $this->belongsTo(MaterialClass::class);
    }
}
