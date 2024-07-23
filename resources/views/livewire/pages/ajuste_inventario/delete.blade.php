<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Borrar {{$title}}" />
        </x-slot>
        <x-slot:body>
            <x-frk.components.label label="Desea borrar el siguiente registro?" />
            <x-frk.components.label-input   wire:model="ajuste_inventario_no" disabled  />
        </x-slot>
        <x-slot:footer>
            <x-frk.components.button label="borrar" wire:click="destroy({{$id_data}})"/>
            <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
        </x-slot>
   </x-frk.components.template-crud>
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
