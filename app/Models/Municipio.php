<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','codigo'];

    public function Calaboradors(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Colaborador::class);
     }

     public function Clientes(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Cliente::class);
     }

     public function Proveedores(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Proveedores::class);
     }

     public function Ruta(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Ruta::class);
     }

}
