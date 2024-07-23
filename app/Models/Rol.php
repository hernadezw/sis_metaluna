<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];


    public function Calaboradors(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Colaborador::class);
     }
}
