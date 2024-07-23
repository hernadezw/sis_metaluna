<?php

namespace App\Livewire;

use App\Constantes\UnidadMedida;
use App\Models\Disenio;
use App\Models\Marca;
use App\Models\Material;
use App\Models\Producto;
use App\Models\Tipo;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductoController extends Component
{
    use LivewireAlert;
    //
    public $codigo='', $precio_venta_mayorista=0,$precio_venta_minorista=0,$precio_venta_base=0, $nombre='', $descripcion='', $disabled=false,$disabledButton=false,$calibre=null,   $divisible=false, $marca_id, $tipo_id, $material_id, $disenio_id,  $estado=true,$created_at,$updated_at;
    public $disabledCodigo=false, $disabledNombre=false,$disabledTipo=false, $disabledGenerar=false;
    public $disabledDisenio=false,$disabledMarca=false, $disabledMaterial=false, $disabledLongitud=false, $disabledPeso=false, $disabledDiametro=false;

    public $longitudes=null;
    public $pesos=null;
    public $diametros=null;

    public $longitud=null;
    public $tipo_longitud=null;
    public $peso=null;
    public $tipo_peso=null;
    public $diametro=null;
    public $tipo_diametro=null;

    public $marcas, $tipos, $materials, $disenios;
    //
    public $title='Producto';
    public $data=null, $id_data=null, $id_last=null;
    public $isCreate = false;
    public $isEdit = false;
    public $isShow = false;
    public $isDelete = false;

    protected $rules = [
        'codigo'=>'required',
        'precio_venta_base'=>'required',
        'precio_venta_mayorista'=>'required',
        'precio_venta_minorista'=>'required',
        'nombre'=>'required',
        'tipo_id'=>'required'
    ];

    protected $listeners=['edit', 'delete','show'];

    public function render()
    {
        $this->longitudes=UnidadMedida::$longitud;
        $this->pesos=UnidadMedida::$peso;
        $this->diametros=UnidadMedida::$diametro;
        return view('livewire.pages.producto.index');
    }

    public function create(){
        $this->marcas=Marca::where('estado',1)->get();
        $this->tipos=Tipo::where('estado',1)->get();
        $this->materials=Material::where('estado',1)->get();
        $this->disenios=Disenio::where('estado',1)->get();

        $this->isCreate=true;
    }

    public function store(){
        $this->validate();
        Producto::create(
            [
            'codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'calibre'=>$this->calibre,
            'longitud'=>$this->longitud,
            'tipo_longitud'=>$this->tipo_longitud,
            'diametro'=>$this->diametro,
            'tipo_diametro'=>$this->tipo_diametro,
            'peso'=>$this->peso,
            'tipo_peso'=>$this->tipo_peso,
            'divisible'=>$this->divisible,
            'estado'=>$this->estado,
            'marca_id'=>$this->marca_id,
            'tipo_id'=>$this->tipo_id,
            'material_id'=>$this->material_id,
            'disenio_id'=>$this->disenio_id,
            'precio_venta_base'=>$this->precio_venta_base,
            'precio_venta_mayorista'=>$this->precio_venta_mayorista,
            'precio_venta_minorista'=>$this->precio_venta_minorista,
            'estado'=>$this->estado
            ]
        );
        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();

    }

    public function edit($rowId){
        $this->marcas=Marca::all();
        $this->tipos=Tipo::where('estado',1)->get();
        $this->materials=Material::where('estado',1)->get();
        $this->disenios=Disenio::where('estado',1)->get();

        $data = Producto::find($rowId);
        $this->disabled=true;
        $this->disabledButton=true;
        $this->disabledCodigo=true;
        $this->disabledNombre=true;
        $this->disabledTipo=true;
        $this->disabledDisenio=false;
        $this->disabledMarca=false;
        $this->disabledMaterial=false;
        $this->disabledLongitud=false;
        $this->disabledPeso=false;
        $this->disabledDiametro=false;

        $this->id_data=$data->id;
        $this->codigo=$data->codigo;
        $this->nombre=$data->nombre;
        $this->descripcion=$data->descripcion;
        $this->calibre=$data->calibre;

        $this->longitud=$data->longitud;
        $this->tipo_longitud=$data->tipo_longitud;

        $this->diametro=$data->diametro;
        $this->tipo_diametro=$data->tipo_diametro;

        $this->peso=$data->peso;
        $this->tipo_peso=$data->tipo_peso;
        $this->peso=$data->peso;
        $this->longitud=$data->longitud;
        $this->divisible=$data->divisible;
        $this->estado=$data->estado;
        $this->marca_id=$data->marca_id;
        $this->tipo_id=$data->tipo_id;
        $this->material_id=$data->material_id;
        $this->disenio_id=$data->disenio_id;
        $this->precio_venta_base=$data->precio_venta_base;
        $this->precio_venta_mayorista=$data->precio_venta_mayorista;
        $this->precio_venta_minorista=$data->precio_venta_minorista;
        $this->estado=$data->estado;

        $this->isEdit=true;
    }

    public function show($rowId){
        $this->marcas=Marca::where('estado',1)->get();
        $this->tipos=Tipo::where('estado',1)->get();
        $this->materials=Material::where('estado',1)->get();
        $this->disenios=Disenio::where('estado',1)->get();
        $data = Producto::find($rowId);

        $this->id_data=$data->id;
        $this->codigo = $data->codigo;
        $this->nombre = $data->nombre;
        $this->estado = $data->estado;
        $this->descripcion=$data->descripcion;
        $this->calibre=$data->calibre;

        $this->longitud=$data->longitud;
        $this->tipo_longitud=$data->tipo_longitud;

        $this->diametro=$data->diametro;
        $this->tipo_diametro=$data->tipo_diametro;

        $this->peso=$data->peso;
        $this->tipo_peso=$data->tipo_peso;

        $this->precio_venta_base=$data->precio_venta_base;
        $this->precio_venta_mayorista=$data->precio_venta_mayorista;
        $this->precio_venta_minorista=$data->precio_venta_minorista;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->disabled=true;
        $this->isShow=true;
    }

    public function update($rowId){

        $data = Producto::find($rowId);
        $data->update([
            'codigo'=>$this->codigo,
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'calibre'=>$this->calibre,
            'longitud'=>$this->longitud,
            'tipo_longitud'=>$this->tipo_longitud,
            'diametro'=>$this->diametro,
            'tipo_diametro'=>$this->tipo_diametro,
            'peso'=>$this->peso,
            'tipo_peso'=>$this->tipo_peso,
            'divisible'=>$this->divisible,
            'estado'=>$this->estado,
            'marca_id'=>$this->marca_id,
            'tipo_id'=>$this->tipo_id,
            'material_id'=>$this->material_id,
            'disenio_id'=>$this->disenio_id,
            'precio_venta_base'=>$this->precio_venta_base,
            'precio_venta_mayorista'=>$this->precio_venta_mayorista,
            'precio_venta_minorista'=>$this->precio_venta_minorista,
            'estado'=>$this->estado
        ]);



        $this->dispatch('pg:eventRefresh-default');
        $this->cancel();

    }

    public function delete($rowId){
        $data = Producto::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->isDelete = true;
    }

    public function destroy($rowId){
        $data=Producto::find($rowId);
        $mensaje='Registro borrado exitosamente';

        try {
            $data->delete();

            $this->alert('success', 'Borrado correctamente', [
                'position' => 'center',
                'timer' => '3000',
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'timerProgressBar' => true,
                'text' => $mensaje,
            ]);
        } catch (Exception $e) {


            if($e->getCode()=="23000"){
                $mensaje="El registro esta asociado a otro registro";
            }

            $this->alert('error', 'No es posible borrar', [
                'position' => 'center',
                'timer' => '3000',
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'timerProgressBar' => true,
                'text' => $mensaje,
            ]);
        }





        $this->dispatch('pg:eventRefresh-default');
        $this->isDelete = false;
        $this->cancel();






    }

    public function generar(){
        $marcas='';
        $tipos='';
        $materials='';
        $disenios='';
        $temp_calibre='';
        $temp_diametro='';
        $temp_peso='';
        $temp_longitud='';

        $this->validate([
            'tipo_id' => 'required'
        ]);

        if ($this->tipo_id!=null) {
            $tempA=Tipo::find($this->tipo_id);
            $tipos=$tempA->nombre.' ';
        }
        if ($this->marca_id!=null) {
            $marcas=Marca::find($this->marca_id);
            $marcas=$marcas->nombre.' ';
        }
        if ($this->material_id!=null) {
            $materials=Material::find($this->material_id);
            $materials=$materials->nombre.' ';
        }
        if ($this->disenio_id!=null) {
            $disenios=Disenio::find($this->disenio_id);
            $disenios=$disenios->nombre.' ';
        }
        if ($this->calibre!=null) {
            $temp_calibre='Calibre:'.$this->calibre.' ';
        }

        if ($this->longitud!=null) {
            $this->validate([
                'longitud' => 'required',
                'tipo_longitud' => 'required',
            ]);
            $temp_longitud.='Longitud:'.$this->longitud.' '.$this->longitudes[$this->tipo_longitud];
        }

        if ($this->peso!=null) {
            $this->validate([
                'peso' => 'required',
                'tipo_peso' => 'required',
            ]);
            $temp_peso.='Peso: '.$this->peso.' '.$this->pesos[$this->tipo_peso];
        }

        if ($this->diametro!=null) {



            $this->validate([
                'diametro' => 'required',
                'tipo_diametro' => 'required',
            ]);
            $temp_diametro.='Diametro: '.$this->diametro.' '.$this->diametros[$this->tipo_diametro];
        }







        $this->id_last=Producto::latest('id')->first();
        if ( $this->id_last===null) {
            $this->id_last=0;
        }else{
            $datas=Producto::latest('id')->first();
            $this->id_last=$datas->id;
        }
        $this->nombre=$tempA->nombre;
        $tempB=$this->id_last;
        $this->codigo=substr($tempA->nombre,0,3).$tempB;

       $this->nombre=$tipos.''.$materials.''.$marcas.''.$disenios.''.$temp_calibre.''. $temp_longitud.''. $temp_peso.''. $temp_diametro;

    }

    public function cancel(){
        $this->reset();
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function resetInput(){
        $this->reset(['codigo','id_last','nombre','marca_id','tipo_id','material_id','disenio_id','calibre','peso','longitud','precio_venta_minorista','precio_venta_mayorista']);

        $this->reset([



            'longitud',
            'tipo_longitud',
            'diametro',
            'tipo_diametro',
            'peso',
            'tipo_peso',

        ]);

    }

    private function resetInputFields(){

        $this->reset();
        //$this->reset(['isCreate','isEdit','isDelete','isShow','codigo','id_last','nombre', 'descripcion','estado','calibre','peso','longitud','divisible','marca_id','tipo_id','material_id','disenio_id','estado','created_at','updated_at']);
    }


    public function divisibleToggle(){
        if($this->divisible==1)
        {
            $this->divisible=0;
        }else{
            $this->divisible=1;
        }
    }
}
