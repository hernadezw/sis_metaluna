<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.traslado-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.traslado.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.traslado.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.traslado.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.traslado.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
