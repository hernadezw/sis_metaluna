<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];


    public function Rol(){
       // $this->belongsTo('App\Models\Rol');
        return $this->belongsTo(Rol::class);
    }


    public function Departamento(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Departamento::class);
     }

     public function Municipio(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Municipio::class);
     }


}
