<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
        <x-frk.components.button label="Abono anticipado" wire:click="abonoAnticipado()" />
        <x-frk.components.button label="Asignar Abono anticipado" wire:click="abonoAnticipadoAsignar()" />
    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.abono-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.abono.create')
        @endif
        @if($isCreateAnticipado)
            @include('livewire.pages.abono.create_anticipado')
        @endif
        @if($isCreateAnticipadoAsignar)
            @include('livewire.pages.abono.create_anticipado_asignar')
        @endif
        @if($isEdit)
            @include('livewire.pages.abono.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.abono.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.abono.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
