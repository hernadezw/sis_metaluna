<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cliente_id',
        'no_cotizacion',
        'fecha_cotizacion',
        'hora_cotizacion',
        'total_cotizacion',
        'observaciones_cotizacion',

        'forma_pago',


        'cancelado',
        'fecha_cancelado',

        'visible',

        'sucursal_id',

    ];

    public function EstadoCuentas(){
        return $this->hasMany(EstadoCuenta::class);
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }


    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->as('cotizacion_producto')
        ->withTimestamps()
        ->withPivot('cantidad','sub_total','precio_cotizacion');
    }

    public function Asignacion(){
        return $this->belongsToMany(Asignacion::class);
    }

    public function Envios(){
        return $this->belongsToMany(Envio::class)
        ->withTimestamps()
        ->withPivot('entregado','observaciones');
    }

    public function Credito(){
        return $this->belongsTo(Credito::class);
    }

/*
  protected function anulado(): Attribute
  {
      return Attribute::make(

          get: fn (string $value) => $value==false ? $value="no anulado" : $value="anulado"


      );
  }
*/


}
