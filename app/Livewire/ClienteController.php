<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Municipio;
use Livewire\Component;

class ClienteController extends Component
{
    public $title='Cliente';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    public $last_dep=false;
    public $codigotemp_dep,$codigotemp_mun,$codigotemp;
    public $tipo_clientes=[];

    public $isDisabledMinorista=true;

    public $disabledCodigo=true,
    $codigo_interno=null,
    $codigo_mayorista=null,
    $nombre_empresa='',
    $nombres_cliente='',
    $tipo_cliente_id=null,
    $apellidos_cliente='',
    $cui='',
    $numero_patente='',
    $nit='',
    $telefono_principal='',
    $telefono_secundario='',
    $direccion_fisica='',
    $direccion_departamento=null,
    $direccion_municipio=null,
    $ubicacion_latitud=0,
    $ubicacion_longitud=0,
    $correo_electronico,
    $limite_credito=0,
    $dias_limite_credito=30,
    $estado=true,
    $id=0;

    ////disabled////////
    public $disabled_codigo_interno=false;

    public $departamentos=[], $municipios=[];
    public $departamento_id, $municipio_id;
    public $departamento,$municipio;

    protected $rules = [
        'nit' => 'required',
        'tipo_cliente_id' => 'required',
        'nombres_cliente' => 'required',
        'apellidos_cliente' => 'required',
        'telefono_principal' => 'required',
        'direccion_fisica' => 'required',
        'direccion_departamento' => 'required',
        'direccion_municipio' => 'required',
    ];

    protected $listeners=['edit', 'delete','show'];

    public function render()
    {
        return view('livewire.pages.cliente.index');
    }

    public function create(){

        $data=Cliente::latest()->first();
        if ( $data) {
            $this->id=$data->id+1;
            $this->codigo_interno=$this->id;

        }else{
            $this->id=1;
            $this->codigo_interno=$this->id;
        }

        $this->isCreate=true;
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->departamentos=Departamento::all();
        $this->disabled_codigo_interno=true;
    }


    public function updatedTipoClienteId ($value){
        if($value!='MAYO')
        {
            $this->isDisabledMinorista=true;
            $this->reset(['numero_patente','cui','ubicacion_latitud' ,'ubicacion_longitud','limite_credito','dias_limite_credito']);
        }else{
            $this->isDisabledMinorista=false;
            $data=Cliente::where('tipo_cliente','MAYO')->latest()->first();
            $this->codigo_mayorista=$data->codigo_mayorista+1;
        }
    }



    public function store(){
        $this->validate([
            'tipo_cliente_id' => 'required',
            'nombres_cliente' => 'required',
            'telefono_principal' => 'required',
            'direccion_fisica' => 'required',
            'direccion_departamento' => 'required',
            'direccion_municipio' => 'required',]);


            if($this->tipo_cliente_id!='MAYO')
            {
                $this->isDisabledMinorista=true;
                $this->limite_credito=0;
            }else{
                $this->isDisabledMinorista=false;

            }


        Cliente::create(
            [
            'codigo_interno'=> $this->codigo_interno,
            'codigo_mayorista'=> $this->codigo_mayorista,
            'nombre_empresa'=> $this->nombre_empresa,
            'nombres_cliente'=>$this->nombres_cliente,
            'apellidos_cliente'=>$this->apellidos_cliente,
            'cui'=>$this->cui,
            'numero_patente'=>$this->numero_patente,
            'nit'=>$this->nit,
            'telefono_principal'=>$this->telefono_principal,
            'telefono_secundario'=>$this->telefono_secundario,
            'direccion_fisica'=>$this->direccion_fisica,
            'direccion_departamento'=>$this->direccion_departamento,
            'direccion_municipio'=>$this->direccion_municipio,
            'ubicacion_latitud'=>$this->ubicacion_latitud,
            'ubicacion_longitud'=>$this->ubicacion_longitud,
            'correo_electronico'=>$this->correo_electronico,
            'limite_credito'=>$this->limite_credito,
            'dias_limite_credito'=>$this->dias_limite_credito,
            'tipo_cliente'=>$this->tipo_cliente_id,
            'estado'=>$this->estado
            ]
        );
        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();
    }


    public function delete($rowId){
        $data = Cliente::find($rowId);
        $this->id_data=$data->id;
        $this->codigo_interno = $data->codigo_interno;
        $this->nombre_empresa = $data->nombre_empresa;
        $this->isDelete = true;
    }

    public function edit($rowId){
        $data = Cliente::find($rowId);
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->departamentos=Departamento::all();
        $this->municipios = Municipio::where('departamento_id',$data->direccion_departamento)->get();

        $this->id_data=$data->id;
        $this->codigo_interno = $data->codigo_interno;
        $this->nombre_empresa = $data->nombre_empresa;
        $this->nombres_cliente = $data->nombres_cliente;
        $this->apellidos_cliente = $data->apellidos_cliente;
        $this->cui = $data->cui;
        $this->numero_patente = $data->numero_patente;
        $this->nit = $data->nit;
        $this->telefono_principal = $data->telefono_principal;
        $this->telefono_secundario = $data->telefono_secundario;
        $this->direccion_fisica = $data->direccion_fisica;
        $this->direccion_departamento = $data->direccion_departamento;
        $this->direccion_municipio = $data->direccion_municipio;
        $this->ubicacion_latitud = $data->ubicacion_latitud;
        $this->ubicacion_longitud = $data->ubicacion_longitud;
        $this->correo_electronico = $data->correo_electronico;
        $this->estado = $data->estado;
        $this->limite_credito=$data->limite_credito;
        $this->dias_limite_credito=$data->dias_limite_credito;

        $this->tipo_cliente_id=$data->tipo_cliente;


        if($data->tipo_cliente!='MAYO')
        {
            $this->isDisabledMinorista=true;
        }else{
            $this->isDisabledMinorista=false;

        }


        $this->isEdit = true;
    }

    public function show($rowId){
        $data = Cliente::find($rowId);
        $this->tipo_clientes=DataSistema::$tipo_cliente;
        $this->departamentos=Departamento::all();
        $this->municipios = Municipio::where('departamento_id',$data->direccion_departamento)->get();

        $this->id_data=$data->id;
        $this->codigo_interno = $data->codigo_interno;
        $this->nombre_empresa = $data->nombre_empresa;
        $this->nombres_cliente = $data->nombres_cliente;
        $this->apellidos_cliente = $data->apellidos_cliente;
        $this->cui = $data->cui;
        $this->numero_patente = $data->numero_patente;
        $this->nit = $data->nit;
        $this->telefono_principal = $data->telefono_principal;
        $this->telefono_secundario = $data->telefono_secundario;
        $this->direccion_fisica = $data->direccion_fisica;
        $this->direccion_departamento = $data->direccion_departamento;
        $this->direccion_municipio = $data->direccion_municipio;
        $this->ubicacion_latitud = $data->ubicacion_latitud;
        $this->ubicacion_longitud = $data->ubicacion_longitud;
        $this->correo_electronico = $data->correo_electronico;
        $this->estado = $data->estado;
        $this->limite_credito=$data->limite_credito;
        $this->dias_limite_credito=$data->dias_limite_credito;

        $this->tipo_cliente_id=$data->tipo_cliente;


        if($data->tipo_cliente!='MAYO')
        {
            $this->isDisabledMinorista=true;
        }else{
            $this->isDisabledMinorista=false;

        }


        $this->disabled = true;
        $this->isShow=true;

    }

    public function update(){
        $this->validate([
            'tipo_cliente_id' => 'required',
            'nombres_cliente' => 'required',
            'telefono_principal' => 'required',
            'direccion_fisica' => 'required',
            'direccion_departamento' => 'required',
            'direccion_municipio' => 'required',]);

        $data = Cliente::find($this->id_data);
        $data->update([
            'codigo_interno'=> $this->codigo_interno,
            'codigo_mayorista'=> $this->codigo_mayorista,
            'nombre_empresa'=> $this->nombre_empresa,
            'nombres_cliente'=>$this->nombres_cliente,
            'apellidos_cliente'=>$this->apellidos_cliente,
            'cui'=>$this->cui,
            'numero_patente'=>$this->numero_patente,
            'nit'=>$this->nit,
            'telefono_principal'=>$this->telefono_principal,
            'telefono_secundario'=>$this->telefono_secundario,
            'direccion_fisica'=>$this->direccion_fisica,
            'direccion_departamento'=>$this->direccion_departamento,
            'direccion_municipio'=>$this->direccion_municipio,
            'ubicacion_latitud'=>$this->ubicacion_latitud,
            'ubicacion_longitud'=>$this->ubicacion_longitud,
            'correo_electronico'=>$this->correo_electronico,
            'limite_credito'=>$this->limite_credito,
            'dias_limite_credito'=>$this->dias_limite_credito,
            'tipo_cliente'=>$this->tipo_cliente_id,
            'estado'=>$this->estado
        ]);


        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();

    }
    public function destroy($rowId)
    {
        Cliente::find($rowId)->delete();
        $this->dispatch('pg:eventRefresh-default');
        $this->isDelete = false;
        $this->cancel();
    }

    public function cancel(){
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        $this->reset(['codigo_interno','nombre_empresa','isDisabledMinorista' ,'tipo_cliente_id','nombres_cliente', 'apellidos_cliente','cui', 'numero_patente','nit','telefono_principal' ,'telefono_secundario', 'direccion_fisica','direccion_departamento','direccion_municipio','ubicacion_latitud' ,'ubicacion_longitud', 'correo_electronico','departamento_id','municipio_id','departamentos','municipios','limite_credito','dias_limite_credito']);

    }



    public function updatedDireccionDepartamento($value){
        $codigo=Departamento::find($value);
        //$this->codigo_temp_dep=$codigo->codigo;
        //$this->codigo_internotemp=$this->codigo_internotemp_dep;
        $this->municipios = Municipio::where('departamento_id',$value)->get();
        $this->last_dep=true;
        $this->reset('municipio_id');
    }

    /*
    public function updatedDireccionMunicipio($value){
        //$codigotemp=$this->codigo_interno_temp_dep;
        $codigotemp_mun=Municipio::find($value);
        $ultimo=Cliente::latest('id')->first();

        if($ultimo===null){
            $this->codigo_interno=$codigotemp.$codigotemp_mun->codigo.'1';
        }else{
            $this->codigo_interno=$this->codigo_internotemp.$codigotemp_mun->codigo.$ultimo->id;
        }


    }
    */
}
