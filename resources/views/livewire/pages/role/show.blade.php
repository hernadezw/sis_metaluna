<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Detalle {{$title}}" />
        </x-slot>
        <x-slot:body>
            <x-frk.components.label-input disabled label="nombre"  wire:model="nombre" />

            <x-frk.components.label-input disabled label="created_at" wire:model="created_at" />

            <x-frk.components.label-input disabled label="updated_at" wire:model="updated_at" />


            <x-frk.components.label label="Permisos seleccionados"/>
            <div class="mx-4 my-4">

              @foreach ($this->role_selec as $selec)
              -{{ $selec->name}}
              @endforeach
            </div>




        </x-slot>
        <x-slot:footer>
            <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
        </x-slot>
   </x-frk.components.template-crud>
</div>
