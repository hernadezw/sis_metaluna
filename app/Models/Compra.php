<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['compra_no','no_recibo_compra','compra_fecha','proveedor_id','estado','sucursal_id'];

    public function Productos(){
        return $this->belongsToMany(Producto::class)
        ->withTimestamps()
        ->withPivot('cantidad','producto_id');
    }
    public function Proveedor(){
        return $this->belongsTo(Proveedor::class);
    }
    public function Sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

}
