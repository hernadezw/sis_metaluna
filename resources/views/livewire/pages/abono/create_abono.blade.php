<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>
        <div class=" w-full md:w-2/4">
            <x-frk.components.title label="Nuevo {{$title}}" />
        </div>
        <div class=" w-full md:w-1/4">
            <x-frk.components.label-input label="No abono"   wire:model.live="no_abono" />
        </div>

        <div class="flex w-full md:w-1/4">
            <x-frk.components.date-picker wire:model="fecha_abono" label="Fecha abono"/>
        </div>
    </x-slot>
    <x-slot:body>
    <div class="flex w-full flex-wrap m-4">
        <x-frk.components.button label="Buscar" wire:click="buscarVenta()" />


            <div class="flex w-full ">
                <div class=" w-full md:w-2/8">
                    <x-frk.components.label-input label="No Venta:" :disabled="$disabled" wire:model.live="no_venta" />
                </div>

                <div class=" w-full md:w-2/8">
                    <x-frk.components.input-money  label="Saldo credito venta:" :disabled="$disabled" wire:model.live="saldo_credito" />
                </div>
                <div class=" w-full md:w-2/8">
                    <x-frk.components.input-money  label="Cantidad Abono:" error="cantidad_abono" :disabled="$disabled" wire:model.live="cantidad_abono" />
                </div>
                <div class=" w-full md:w-2/8">
                    <x-frk.components.input-money label="Nuevo saldo:" error="nuevo_saldo" :disabled="$disabled" wire:model="nuevo_saldo" />
                </div>
            </div>

            <div class="flex w-full ">
                <x-frk.components.label-input label="Observaciones:"   wire:model="observaciones" />
            </div>


        <div class="flex w-full ">
            <div class=" w-full md:w-1/2">
                <x-frk.components.select label="Tipo Pago" :disabled="$disabled" wire:model.live="tipo_pago_id">
                    @foreach ($this->tipo_pago as $data)
                    <option value="{{ $data['valor'] }}" >{{ $data['nombre']}} </option>
                    @endforeach
                </x-forms.select>

            </div>




        </div>
        <div class="flex w-full ">
            <x-frk.components.label-input label="Detalle Pago"   wire:model="detalle_pago" />
        </div>

    </div>



    </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="guardar" wire:click.prevent="store()" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>

