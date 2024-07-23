<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;



    protected $fillable = [
        'no_servicio',
        'fecha_servicio',
        'total_servicio',
        'vehiculo_id',
        'descripcion',
        'observaciones',
        'estado',
    ];


    public function Vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }





}



