<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.envio-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.envio.create')
        @endif
        @if($isFinalizar)
            @include('livewire.pages.envio.finalizar')
        @endif
        @if($isEdit)
            @include('livewire.pages.envio.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.envio.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.envio.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
