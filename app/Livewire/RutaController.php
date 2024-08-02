<?php

namespace App\Livewire;

use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Ruta;


use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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
    public $codigo;
    public $nombre,$descripcion;
    public $estado=true;

    public $departamento_id=null;
    public $municipio_id=null;
    public $observaciones=null;



    public $inputs = [];
    public $nombresDetalle= [],$municipioDetalle= [], $observacionDetalle= [];

    public $nombreDepartamento= [], $idDepartamento= [];
    public $nombreMunicipio= [], $idMunicipio= [];

    public $disabled_departamento=false;
    public $disabled_municipio=false;
    public $i=0;

    protected $listeners=['edit', 'delete','show','pdfExportar'];

    public function render()
    {

        return view('livewire.pages.ruta.index');
    }

    public function create(){

        $this->departamentos=Departamento::all();
        $this->isCreate=true;
    }
    public function updatedDepartamentoId($value){
        $this->reset('municipio_id');
            $this->municipios = Municipio::where('departamento_id',$value)->get();
    }



    public function addDetalle(){
        $this->disabled_departamento=true;
        $this->disabled_municipio=true;


        foreach ($this->departamentos as $key => $value) {
            if($value['id']===intval($this->departamento_id)){
                array_push($this->inputs,$this->i);
                array_push($this->idDepartamento ,$value['id']);
                array_push($this->nombreDepartamento ,$value['nombre']);
                array_push($this->observacionDetalle ,$this->observaciones);

            }
        }

        foreach ($this->municipios as $key => $value) {
            if($value['id']===intval($this->municipio_id)){
                array_push($this->idMunicipio ,$value['id']);
                array_push($this->nombreMunicipio ,$value['nombre']);
            }
        }
        $this->i+=1;
        $this->reset(['observaciones','departamento_id','municipio_id']);
    }


    public function removeDetalle($i)
    {

        //dd($this->idMunicipio[$i]);


        unset($this->inputs[$i]);
        unset($this->idDepartamento[$i]);
        unset($this->nombreDepartamento[$i]);
        unset($this->observacionDetalle[$i]);
        unset($this->idMunicipio[$i]);
        unset($this->nombreMunicipio[$i]);
    }



    public function store(){


        $this->validate(['codigo'=>'required','nombre'=>'required','inputs'=>'required']);

        $data=Ruta::create(
            [
            'codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,

            'estado'=>$this->estado
        ]
        );
        foreach ($this->inputs as $key => $value) {
            $data->departamentos()->attach($value,['departamento_id' => $this->idDepartamento[$key],'municipio_id' => $this->idMunicipio[$key],'nombre_departamento' => $this->nombreDepartamento[$key],'nombre_municipio' => $this->nombreMunicipio[$key],'observaciones' => 'obbbbbbbbbb']);
        }

        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();


    }

    public function edit($rowId){

        $this->departamentos=Departamento::all();
        $this->municipios=Municipio::all();

        $data = Ruta::find($rowId);
        $this->id_data=$data->id;
        $this->codigo=$data->codigo;
        $this->nombre=$data->nombre;
        $this->descripcion=$data->descripcion;
        $datos=$data->productos()->get();

        foreach ($datos as $key => $value) {
            array_push($this->inputs ,$key);
            array_push($this->nombresDetalle ,$value->nombre);
            array_push($this->productosDetalle ,$value->id);
            array_push($this->cantidadesDetalle ,$value->pivot->cantidad);
        }
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->isEdit=true;
    }


    public function pdfExportar($id){
        return redirect()->route('pdfExportarRuta',$id);
    }

    public function pdfExportarRuta($id)
    {
        $ruta=Ruta::with('departamentos')->find($id)->toArray();


        $pdf = FacadePdf::loadView('/livewire/pdf/pdfRuta ',['ruta'=>$ruta]);
        return $pdf->stream();

    }



    public function cancel(){
        $this->reset();
        $this->resetValidation();
    }



}
