<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Finalizar {{$title}}" />
    </x-slot>
    <x-slot:body>
        <div class="flex flex-wrap w-full">

            <div class="flex w-full">
                <div class="flex w-full md:w-1/3">
                    <x-frk.components.label-input label="no envio" :disabled="$disabled_envio_no" wire:model="no_envio" />
                </div>
                <div class="flex w-full md:w-1/3">
                    <x-frk.components.date-picker wire:model="envio_fecha" :disabled="$disabled" label="envio_fecha"/>
                </div>
                <div class="flex w-full md:w-1/3">
                    <x-frk.components.label-input label="ruta" :disabled="$disabled_envio_no" wire:model="ruta" />
                </div>

            </div>

        <!-- //////////Ventas/////////////-->
            <div class="flex w-full ">
                <div class="flex w-full flex-col">
                    <div class="flex w-full w-grap">
                        <div class="flex w-full ">
                            <x-frk.components.label label="Ventas Asignada"  />
                        </div>
                    </div>

                    @foreach($this->envio->ventas as $key => $value)
                    <div class="flex w-full w-grap">


                        <div class="flex w-full md:w-4/5">
                            No: {{$value->no_venta}}
                            Fecha: {{$value->fecha_venta}}
                            Cliente: {{$value->cliente->nit}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            ventas {{var_export($ventass)}}


        <!-- //////////Ventas/////////////-->






        <!-- //////////Usuarios/////////////-->
        <div class="flex w-full ">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full ">
                        <x-frk.components.label label="Usuario Asignado"  />
                    </div>
                </div>

                @foreach($this->envio->users as $key => $value)
                <div class="flex w-full w-grap">
                    <div class="flex w-full md:w-4/5">
                        No: {{$value->id}}

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- //////////Usuarios/////////////-->


        <!-- //////////vehiculos/////////////-->
        <div class="flex w-full ">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full ">
                        <x-frk.components.label label="Vehiculo Asignado"  />
                    </div>
                </div>

                @foreach($this->envio->vehiculos as $key => $value)
                <div class="flex w-full w-grap">
                    <div class="flex w-full md:w-4/5">
                        No: {{$value->id}}

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- //////////vehiculos/////////////-->




            <div class="flex flex-wrap w-full">


                <div class="flex w-full ">
                    <x-frk.components.text-area label="observacion al inicio" :disabled="$disabled_observaciones_inicio_envio" wire:model="observaciones_inicio_envio" />
                </div>

                <div class="flex w-full ">
                    <x-frk.components.text-area label="observacion al finalizar" :disabled="$disabled_observaciones_final_envio" wire:model="observaciones_final_envio" />
                </div>


            </div>




















        </div>




    </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="finalizar" wire:click.prevent="store_finish()" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.components.template-create>

