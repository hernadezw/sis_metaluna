<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}} - {{ Auth::user()->sucursal->nombre  }}" />
    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.inventario-table/>
    </x-slot:body>
    <x-slot:footer>

    </x-slot:footer>
</x-frk.components.template-index>
