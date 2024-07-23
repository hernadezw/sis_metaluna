<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Editar {{$title}}" />
        </x-slot>


        <x-slot:body>

            <x-frk.components.label-input label="nombre" wire:model="nombre" />
            <x-frk.components.label label="Permisos seleccionados"/>
            <div class="mx-4 my-4">

              @foreach ($this->role_selec as $selec)
              -{{ $selec->name}}
              @endforeach
            </div>
            <x-frk.components.label label="Permisos:"/>
            @foreach ($permisson as $item)
              <x-frk.components.checkbox wire:model="role_selected" value="{{$item->id}}" label="{{$item->name}}"   >
              </x-frk.components.checkbox>
            @endforeach


        </x-slot>

            <x-slot:footer>
                <x-frk.components.button label="editar" wire:click.prevent="update({{$id_data}})" />
                <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
            </x-slot>
    </div>





</x-frk.modal>
</div>



<!--

<form>
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
