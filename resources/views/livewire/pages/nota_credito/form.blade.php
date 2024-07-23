<div class="flex w-full flex-wrap m-4">

        <div class="flex w-full ">
            <x-frk.components.select label="Venta Numero" :disabled="$disabled" error="venta_id" wire:model.live="venta_id" id="venta_id">
                @foreach ($this->ventas as $data)
                <option value="{{ $data->id }}" wire:key="tipo-{{ $data->id }}">No. Venta: {{ $data->no_venta }} Total Venta:{{ $data->total_venta }} || Nota Credit Actual:{{ $data->total_nota_credito }}|| Saldo:{{ $data->saldo_venta }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class=" fleX w-full">
            <x-frk.components.subtitle  label="VENTA" />
        </div>


        <div class="flex w-full ">

            <div class="flex w-full md:w-1/3">
                <x-frk.components.label-input  label="codigo" error="codigo" :disabled="$disabled" wire:model.live="codigo" />
            </div>
            <div class="flex w-full md:w-1/3">
                <x-frk.components.label-input  label="nombre_empresa" error="codigo" :disabled="$disabled" wire:model.live="nombre_empresa" />
            </div>
            <div class="flex w-full md:w-1/3">
                <x-frk.components.label-input  label="nombre_cliente" error="codigo" :disabled="$disabled" wire:model.live="nombre_cliente" />
            </div>

        </div>


        <div class="flex w-full ">
            <div class=" flex w-full md:w-1/2">
                <x-frk.components.date-picker label="Fecha venta" :disabled="$disabled" wire:model.live="fecha_venta" />

            </div>
            <div class="flex w-full md:w-1/2">
                <x-frk.components.input-money  label="total venta" error="codigo" :disabled="$disabled" wire:model.live="total_venta" />
            </div>
        </div>

        <div class=" fleX w-full">
            <x-frk.components.subtitle  label="Nota credito" />
        </div>
        <div class="flex w-full ">
            <div class="flex w-full md:w-1/5">
                <x-frk.components.input-money  label="no nota credito" error="codigo" :disabled="$disabled" wire:model.live="no_nota_credito" />
            </div>
            <div class="flex w-full md:w-1/5">
                <x-frk.components.date-picker wire:model="fecha_nota_credito" error="fecha_nota_credito" label="Fecha nota credito"/>
            </div>
            <div class="flex w-full md:w-1/5">
                <x-frk.components.input-money  label="Total nota credito" error="total_nota_credito" :disabled="$disabled" wire:model.live="total_nota_credito" />
            </div>
            <div class="flex w-full md:w-1/5">
                <x-frk.components.input-money label="Nuevo saldo" error="nuevo_saldo" :disabled="$disabled" wire:model="nuevo_saldo" />
            </div>

            <div class="flex w-full md:w-1/5"  x-data="{open: @entangle('anulado')}"  >
                <x-frk.components.toggle :disabled="$disabled" wire:click="anulacionVenta()" label="Anulacion Venta" left="No" right="Si"   />
            </div>

        </div>

        <div class="flex w-full ">
            <x-frk.components.label-input label="Observaciones"   wire:model="observaciones" />
        </div>

    @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="created_at" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="updated_at" :disabled="$disabled" wire:model="updated_at" />
        </div>
    @endif
</div>
