<?php

namespace App\Livewire;

use App\Models\Disenio;
use App\Models\Material;
use Livewire\Component;

class DisenioController extends Component
{

    public $title='Diseño';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    ////////////////////
    public $nombre, $descripcion, $estado=true;
    ////////////////////

    ////////////////////
    protected $rules = [
        'nombre' => 'required',
    ];
    ////////////////////

    protected $listeners=['edit', 'delete','show'];

    public function render()
    {
    ////////////////////
        return view('livewire.pages.disenio.index');
    ////////////////////
    }

    public function create(){
        $this->isCreate=true;
    }

    public function store(){
        $this->validate();
    ////////////////////
        Disenio::create(
            [
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
            ]
        );
    ////////////////////
        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();
    }

    public function edit($rowId){
    ////////////////////
        $data = Disenio::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->isEdit=true;
    ////////////////////
    }

    public function show($rowId){
    ////////////////////
        $data = Disenio::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->disabled=true;
        $this->isShow=true;
    ////////////////////
    }


    public function update($rowId){
        $this->validate();
    ////////////////////
        $data = Disenio::find($rowId);
        $data->update([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
        ]);
    ////////////////////
        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();
    }

    public function delete($rowId){
    ////////////////////
        $data = Disenio::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->isDelete = true;
    ////////////////////
    }

    public function destroy($rowId)
    {
    ////////////////////
       Disenio::find($rowId)->delete();
    ////////////////////
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

        ////////////////////
    }

}
