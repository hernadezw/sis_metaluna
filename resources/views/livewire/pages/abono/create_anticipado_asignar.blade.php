<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>
        <div class="flex w-full md:w-2/4">
            <x-frk.components.title label="Nuevo Abono Anticiado" />
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
        <div class="flex w-full">
            <div class="flex w-full md:w-1/2">
                <x-frk.components.select label="Venta Numero" :disabled="$disabled" error="asignar_venta_id" wire:model.live="asignar_venta_id">
                    @foreach ($this->ventas as $data)
                    <option value="{{ $data->id }}" wire:key="tipo-{{ $data->id }}">No. Venta: {{ $data->no_venta }} Saldo Credito:{{ $data->saldo_venta }}</option>
                    @endforeach
                </x-forms.select>
            </div>

            <div class="flex w-full md:w-1/2">
                <x-frk.components.select label="No. Abono Anticipado" :disabled="$disabled" error="asignar_abono_anticipado_id" wire:model.live="asignar_abono_anticipado_id" >
                    @foreach ($this->abono_anticipados as $data)
                    <option value="{{ $data->id }}" wire:key="tipo-{{ $data->id }}"> {{ $data->no_abono }} </option>
                    @endforeach
                </x-forms.select>
            </div>
        </div>

        <div class="flex w-full ">

            <div class=" w-full md:w-1/3">
                <x-frk.components.input-money  label="Saldo credito venta:" :disabled="$disabled" wire:model.live="saldo_credito_asignar" />
            </div>
            <div class=" w-full md:w-1/3">
                <x-frk.components.input-money  label="Cantidad Abono:" error="cantidad_abono" :disabled="$disabled" wire:model.live="cantidad_abono_asignar" />
            </div>
            <div class=" w-full md:w-1/3">
                <x-frk.components.input-money label="Nuevo saldo:" error="nuevo_saldo" :disabled="$disabled" wire:model.live="nuevo_saldo_asignar" />
            </div>
        </div>



        <div class="flex w-full ">
            <x-frk.components.label-input label="Observaciones"   wire:model="observaciones" />
        </div>


        <div class="flex w-full flex-wrap m-4">


                <div class=" w-full md:w-1/2">
                    <x-frk.components.select label="Tipo Pago" :disabled="$disabled" wire:model.live="tipo_pago_id">
                        @foreach ($this->tipo_pago as $data)
                        <option value="{{ $data['valor'] }}" >{{ $data['nombre']}} </option>
                        @endforeach
                    </x-forms.select>
                </div>




            <div class="flex w-full ">
                <x-frk.components.label-input label="Detalle Pago"   wire:model="detalle_pago" />
            </div>

        </div>
    </div>




    </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="guardar" wire:click.prevent="storeAsignarAbonoAnticipado({{$asignar_abono_anticipado_id}})" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>

