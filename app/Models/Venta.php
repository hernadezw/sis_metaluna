<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cliente_id',

        'tipo_documento',
        'no_venta',
        'fecha_venta',
        'hora_venta',
        'total_venta',
        'observaciones_venta',
        'saldo_credito',

        'forma_pago',
        'efectivo',

        'credito',
        'total_credito',
        'no_credito',
        'observaciones_credito',

        'anulado',
        'fecha_anulado',
        'observaciones_anulado',

        'nota_credito',
        'fecha_nota_credito',
        'total_nota_credito',

        'cancelado',
        'fecha_cancelado',

        'saldo_venta',
        'visible',

        'sucursal_id',
        'en_ruta',
        'entregado',

        'correlativo',
    ];

    public function EstadoCuentas(){
        return $this->hasMany(EstadoCuenta::class);
    }

    public function Cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->as('producto_venta')
        ->withTimestamps()
        ->withPivot('cantidad','sub_total','precio_venta');
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
