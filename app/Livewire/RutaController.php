<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Constantes\DepartamentoMunicipio as ConstantesDepartamentoMunicipio;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Ruta;
use Constantes\DepartamentoMunicipio;
use Livewire\Component;

class RutaController extends Component
{
    public $title='Ruta';
    public $data, $id_data,$id_last;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    //
    public $departamentos=[],$municipiosprimero=[],$municipiossegundo=[],$municipiostercero=[],$municipioscuarto=[],$municipiosquinto=[],$municipios=[];
    public $codigotemp_dep,$codigotemp_mun,$codigotemp,$last_dep;
    public $direccion_departamento,$direccion_municipio;
    public $codigo,$municipio_id,$departamento_id;
    public $nombre,$descripcion;
    public $estado=true;
    public $primero_direccion_departamento;
    public $primero_direccion_municipio;
    public $segundo_direccion_departamento;
    public $segundo_direccion_municipio;
    public $tercero_direccion_departamento;
    public $tercero_direccion_municipio;
    public $cuarto_direccion_departamento;
    public $cuarto_direccion_municipio;
    public $quinto_direccion_departamento;
    public $quinto_direccion_municipio;

    public function render()
    {

        return view('livewire.pages.ruta.index');
    }

    public function create(){

        $this->departamentos=ConstantesDepartamentoMunicipio::$departamentos;
        $this->isCreate=true;
    }
    public function updatedDireccionDepartamento($value){
            $this->reset(['municipiosprimero']);
            $this->municipios=ConstantesDepartamentoMunicipio::$municipios;
    }


    public function store(){
        $this->validate(['codigo'=>'required','nombre'=>'required']);

        Ruta::create(
            ['codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,

            'primero_direccion_departamento'=>$this->primero_direccion_departamento,
            'primero_direccion_municipio'=>$this->primero_direccion_municipio,
            'segundo_direccion_departamento'=>$this->segundo_direccion_departamento,
            'segundo_direccion_municipio'=>$this->segundo_direccion_municipio,
            'tercero_direccion_departamento'=>$this->tercero_direccion_departamento,
            'tercero_direccion_municipio'=>$this->tercero_direccion_municipio,
            'cuarto_direccion_departamento'=>$this->cuarto_direccion_departamento,
            'cuarto_direccion_municipio'=>$this->cuarto_direccion_municipio,
            'quinto_direccion_departamento'=>$this->quinto_direccion_departamento,
            'quinto_direccion_municipio'=>$this->quinto_direccion_municipio,
            'estado'=>$this->estado
        ]
        );

        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();

    }

    public function cancel(){
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////
        $this->reset(['codigo','nombre',
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
    'estado']);
        ////////////////////
    }

}
