<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
    </x-slot:head>
    <x-slot:body>

        <livewire:power-grid.ajuste-inventario-tablee/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.ajuste_inventario.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.ajuste_inventario.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.ajuste_inventario.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.ajuste_inventario.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
