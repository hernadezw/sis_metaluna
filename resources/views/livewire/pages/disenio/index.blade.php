<x-frk.components.template-index>
    <x-slot:head>
        <x-frk.components.title label="{{$title}}" />
        <x-frk.components.button label="agregar {{$title}}" wire:click="create()" />
    </x-slot:head>
    <x-slot:body>
        <livewire:powergrid.disenio-table/>
    </x-slot:body>
    <x-slot:footer>
        @if($isCreate)
            @include('livewire.pages.disenio.create')
        @endif
        @if($isEdit)
            @include('livewire.pages.disenio.edit')
        @endif
        @if($isShow)
            @include('livewire.pages.disenio.show')
        @endif
        @if($isDelete)
            @include('livewire.pages.disenio.delete')
        @endif
    </x-slot:footer>
</x-frk.components.template-index>
