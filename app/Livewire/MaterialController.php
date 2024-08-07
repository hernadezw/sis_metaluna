<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Component;

class MaterialController extends Component
{
    //




    public $title='Material';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;


    public $nombre, $descripcion, $estado=true;

    protected $rules = [
        'nombre' => 'required',
    ];

    protected $listeners=['edit', 'delete','show'];

    public function render()
    {
        return view('livewire.pages.material.index');
    }

    public function create(){
        $this->isCreate=true;
    }


    public function store(){

        $this->validate();

        Material::create(
            [
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
            ]
        );


        $this->cancel();

    }

    public function edit($rowId){

        $data = Material::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->isEdit=true;
    }

    public function show($rowId){

        $data = Material::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->estado = $data->estado;

        $this->disabled=true;
        $this->isShow=true;
    }


    public function update($rowId){
        $this->validate();

        $data = Material::find($rowId);
        $data->update([

            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
        ]);



        $this->cancel();
    }

    public function delete($rowId){
        $data = Material::find($rowId);

        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->isDelete = true;
    }

    public function destroy($rowId)
    {

        Material::find($rowId)->delete();

        $this->isDelete = false;
        //session()->flash('message', 'Post Deleted Successfully.');
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
