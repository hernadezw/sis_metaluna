<?php

namespace App\Livewire;


use App\Models\Envio;
use Constantes\DataSistema;
use Livewire\Component;

class EstadoEnvioController extends Component
{
    public $title='Estado_envio';
    public $data, $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    public $envios,$estados;

    public $envio_id=null,$estado_id=null;

    public function render()
    {
        return view('livewire.pages.estado_envio.index');
    }

    public function create(){

        $this->estados=DataSistema::$estados;

        $this->envios=Envio::all();

        $this->isCreate=true;



    }
}
