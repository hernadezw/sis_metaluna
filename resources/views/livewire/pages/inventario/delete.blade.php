<div>
  <x-modal name="texto" show="true" >
    <div class="flex w-full flex-wrap m-4">

      <x-forms.label-title label="Borrar {{$title}}" />

            <x-forms.label label="Desea borrar el siguiente registro?" />

              <x-forms.label-input   wire:model="nombre" disabled  />



            <div class="flex w-full md:w-1/2">

              <x-buttons.delete-button wire:click="destroy({{$id_data}})">
                Borrar
              </x-buttons.delete-button>
              <x-buttons.cancel-button wire:click="cancel()">
                Cancelar
              </x-buttons.cancel-button>

            </div>
        </div>



      </x-modal>





  </div>














  <!--<form>
    <div class="form-group">
        <input type="hidden" wire:model="post_id">
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" class="form-control" wire:model="title" id="exampleFormControlInput1" placeholder="Enter Title">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Description</label>
        <input type="text" class="form-control" wire:model="description" id="exampleFormControlInput2" placeholder="Enter Description">
        @error('description') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>

->
