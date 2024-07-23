<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />

    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.venta-table/>
    </x-slot:body>
    <x-slot:footer>

        @if($isShow)
            @include('livewire.pages.venta.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.venta.delete')
        @endif

    </x-slot:footer>
</x-frk.components.template-index>
