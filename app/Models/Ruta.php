<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
    'nombre',
    'descripcion',
    'primero_direccion_departamento',
    'primero_direccion_municipio',
    'segundo_direccion_departamento',
    'segundo_direccion_municipio',
    'tercero_direccion_departamento',
    'tercero_direccion_municipio',
    'cuarto_direccion_departamento',
    'cuarto_direccion_municipio',
    'quinto_direccion_departamento',
    'quinto_direccion_municipio',
'estado'];

public function Asignaciones(){
    return $this->hasMany(Asignacion::class);
}

public function Envio(){
    return $this->hasMany(Envio::class);
}


protected function estado(): Attribute {
    return new Attribute(
        get: fn (string $value) => $value==='1' ? true:false,
        //  set: fn (string $value) => $value==='Activo'? true:false,

    );
}





}
