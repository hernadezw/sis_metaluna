<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'cui',
        'telefono_principal',
        'telefono_secundario',
        'tipo_sangre',
        'no_licencia',
        'inicio_laborres',
        'fin_labores',
        'usuario',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'estado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
/*
    public function Notificacions(){
        // $this->belongsTo('App\Models\Rol');
         return $this->hasMany(Notificacion::class);
     }

     public function Unidad(){
        // $this->belongsTo('App\Models\Rol');
         return $this->belongsTo(Unidad::class);
     }
     */

     ///////////noooooooooooooooooooooooooooo


}
