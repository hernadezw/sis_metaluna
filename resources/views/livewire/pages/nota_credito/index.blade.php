<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
    </x-slot:head>
    <x-slot:body>
        <livewire:power-grid.nota-credito-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.nota_credito.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.nota_credito.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.nota_credito.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.nota_credito.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
