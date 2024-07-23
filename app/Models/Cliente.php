<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'codigo_interno',
    'codigo_mayorista',
    'nombre_empresa',
    'nombres_cliente',
    'apellidos_cliente',
    'cui',
    'numero_patente',
    'nit',
    'telefono_principal',
    'telefono_secundario',
    'direccion_fisica',
    'direccion_departamento',
    'direccion_municipio',
    'ubicacion_latitud',
    'ubicacion_longitud',
    'correo_electronico',
    'limite_credito',
    'dias_limite_credito',
    'tipo_cliente',
    'estado'];




    public function Departamento(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Departamento::class);
     }

     public function Municipio(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Municipio::class);
     }

     public function Ventas(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Venta::class);
     }

     protected function estado(): Attribute {
        return new Attribute(
            get: fn (string $value) => $value==='1' ? true:false,
            //  set: fn (string $value) => $value==='Activo'? true:false,

        );
    }

    public function EstadoCuenta(){
        return $this->belongsTo(EstadoCuenta::class);
    }

    public function Credito(){
        return $this->belongsTo(Credito::class);
    }

}
