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
        'saldo_credito_cliente',

        'no_venta',
        'fecha_venta',
        'hora_venta',
        'total_venta',
        'observaciones_venta',
        'forma_pago',

        'efectivo',



        'credito',
        'no_credito',
        'fecha_credito',
        'total_credito',

        'observaciones_credito',

        'anulado',
        'fecha_anulado',
        'observaciones_anulado',

        'nota_credito',
        'fecha_nota_credito',
        'total_nota_credito',
        'observaciones_nota_credito',

        'saldo_cancelado',
        'fecha_saldo_cancelado',

        'saldo_total_venta',
        'visible',


        'envio',
        'estado_envio',

        'correlativo',


        'sucursal_id',





    ];

    public function Abonos(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Abono::class);
     }

     public function NotaCreditos(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(NotaCredito::class);
     }



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

    public function Departamentos(){
        return $this->belongsToMany(Departamento::class)
        ->withPivot('observaciones');
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
