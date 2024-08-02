<div class="flex flex-wrap w-full">

    <div class="flex w-full">
        <div class="flex w-full md:w-1/3">
            <x-frk.components.label-input label="no envio" :disabled="$disabled_envio_no" wire:model="envio_no" />
        </div>
        <div class="flex w-full md:w-1/3">
            <x-frk.components.date-picker wire:model="envio_fecha" label="envio_fecha"/>
        </div>
        <div class="flex w-full md:w-1/3">
            <x-frk.components.select label="ruta_id" error="ruta_id" :disabled="$disabled" wire:model="ruta_id" >
                @foreach ($this->rutas as $data)
                    <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
    </div>

<!-- //////////Ventas/////////////-->
    <div class="flex w-full     ">
        <div class="flex w-full flex-wrap md:w-1/2">
            <div class="flex w-full flex-wrap md:w-3/4">
                <x-frk.components.select label="venta_id" error="venta_id" :disabled="$disabled" wire:model="venta_id" >
                    @foreach ($this->ventas as $data)
                        <option value="{{ $data->id }}" wire:key="data-{{ $data->no_venta }}">{{ $data->no_venta }} - {{ $data->cliente->nombres_cliente }}- {{ $data->total_venta }}</option>
                    @endforeach
                </x-frk.components.select>
            </div>
            <div class="flex w-full flex-wrap md:w-1/4">
                <x-frk.components.button label="agregar {{$title}}" wire:click.prevent="addDetalleRuta()" />
            </div>
        </div>

        <div class="flex w-full md:w-1/2">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full ">
                        <x-frk.components.label label="Ventas Asignada"  />
                    </div>
                </div>

                @foreach($inputs as $key => $value)
                <div class="flex w-full w-grap">
                    <div class="flex w-full md:w-4/5">
                        <x-frk.components.list-input :disabled="$disabled_venta" wire:model="ventaDetalle.{{$value}}" />
                    </div>

                    @if (!$isShow)
                        <div class="flex w-full md:w-1/5">
                            <x-frk.components.button label="-" color="red" wire:click.prevent="removeDetalle({{$key}})" />
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
<!-- //////////Ventas/////////////-->






<!-- //////////Usuarios/////////////-->
    <div class="flex w-full">

        <div class="flex w-full flex-wrap md:w-1/2">
            <div class="flex w-full flex-wrap md:w-3/4">
                <x-frk.components.select label="usuario" error="ruta" :disabled="$disabled" wire:model="user_id" >
                    @foreach ($this->usuarios as $data)
                        <option value="{{ $data->id }}" wire:key="data-{{ $data->no_venta }}">{{ $data->nombres }}</option>
                    @endforeach
                </x-frk.components.select>

            </div>
            <div class="flex w-full flex-wrap md:w-1/4">
                <x-frk.components.button label="agregar {{$title}}" wire:click.prevent="addDetalleUsuario()" />
            </div>

        </div>

        <div class="flex w-full md:w-1/2">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full">
                        <x-frk.components.label label="Usuario Asignado"  />
                    </div>

                </div>

                @foreach($inputsUsuario as $key => $value)
                <div class="flex w-full w-grap">
                    <div class="flex w-full md:w-4/5">
                        <x-frk.components.list-input :disabled="$disabled_user" wire:model="usuarioDetalle.{{$value}}" />
                    </div>
                    @if (!$isShow)
                    <div class="flex w-full md:w-1/5">
                        <x-frk.components.button label="-" color="red" wire:click.prevent="removeDetalle({{$key}})" />
                        </div>
                    @endif
                </div>
                @endforeach









            </div>

        </div>

    </div>
<!-- //////////Usuarios/////////////-->


<!-- //////////vehiculos/////////////-->
    <div class="flex w-full">
        <div class="flex w-full flex-wrap md:w-1/2">
            <div class="flex w-full flex-wrap md:w-3/4">
                <x-frk.components.select label="vehiculos" error="ruta" :disabled="$disabled" wire:model="vehiculo_id" >
                    @foreach ($this->vehiculos as $data)
                        <option value="{{ $data->id }}" wire:key="data-{{ $data->no_venta }}">{{ $data->alias}}</option>
                    @endforeach
                </x-frk.components.select>

            </div>
            <div class="flex w-full flex-wrap md:w-1/4">
                <x-frk.components.button label="agregar {{$title}}" wire:click.prevent="addDetalleVehiculo()" />
            </div>
        </div>
        <div class="flex w-full md:w-1/2">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full">
                        <x-frk.components.label label="Vehiculos Asignados"  />
                    </div>
                </div>

                @foreach($inputsVehiculo as $key => $value)
                <div class="flex w-full w-grap ">
                    <div class="flex w-full md:w-4/5">
                        <x-frk.components.list-input :disabled="$disabled_vehiculo" wire:model="vehiculoDetalle.{{$value}}" wire:click.prevent="removeDetalle({{$key}})"/>
                    </div>
                    @if (!$isShow)
                        <div class="flex w-full md:w-1/5">
                            <x-frk.components.button label="-" color="red" wire:click.prevent="removeDetalle({{$key}})" />
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
<!-- //////////vehiculos/////////////-->




    <div class="flex flex-wrap w-full">


        <div class="flex w-full ">
            <x-frk.components.text-area label="observacion" :disabled="$disabled_observaciones_inicio_envio" wire:model="observaciones_inicio_envio" />
        </div>


    </div>




















</div>
