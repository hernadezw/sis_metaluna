<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.compra-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.compra.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.compra.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.compra.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.compra.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
