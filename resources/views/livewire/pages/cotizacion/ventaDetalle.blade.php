<x-frk.components.template-crud>
    <x-slot:title>
        <div class="flex md:w-1/2">
            <img class="h-11 text-white " src="{!! asset('assets/imagenes/sistema_logo.png') !!}">

        </div>
        <div class="flex md:w-1/2">

            <x-frk.components.title label="VENTA" />
        </div>

        <div class="flex w-full">
            <div class="flex md:w-1/6">
                <x-frk.components.label-input label="nit" :disabled="$disabledInput" wire:model="nit" />
            </div>
            <div class="flex md:w-1/6">
                <x-frk.components.label-input label="codigo" :disabled="$disabledInput" wire:model="codigo" />
            </div>
            <div class="flex md:w-1/6">
                <x-frk.components.label-input label="tipo_cliente" :disabled="$disabledInput"  wire:model="tipo_cliente" />
            </div>
            <div class="flex md:w-1/6">
                <x-frk.components.label-input label="no_venta" :disabled="$disabledInput" wire:model="no_venta" />
            </div>
            <div class="flex w-full md:w-1/6">
                <x-frk.components.date-picker :disabled="$disabledInput" erase="false" wire:model="fecha_venta" label="Fecha Venta"/>
            </div>

            <div class="flex md:w-1/6 ">
                <x-frk.components.select label="Envio" :disabled="$disabled" wire:model="envio_id" id="envio_id">
                    @foreach ($this->envios as $data)
                    <option value="{{ $data['valor'] }}" wire:key="tipo-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                    @endforeach
                </x-forms.select>
            </div>
        </div>


    </x-slot:title>
    <x-slot:body>
        <div class="flex flex-wrap w-full">
            <!-- /--------------- lado izquierdo----------- -->




                <!-- /--------------- lado derecho-----------
                <div class="flex-wrap md:w-3/5 border-double border-4 border-sky-500 p-3 ">-->

                <div class="flex flex-wrap ">
                    <div class="flex w-full">

                        <x-frk.components.label class="text-2xl font-semibold uppercase" label="DETALLE VENTA:" />

                    </div>




                    <div class="flex w-full ">


                        <div class="flex md:w-1/3">
                            <x-frk.components.label-input label="nombres_cliente" :disabled="$disabled" wire:model="nombres_cliente" />
                        </div>
                        <div class="flex md:w-1/3">
                            <x-frk.components.label-input label="nombre_empresa" :disabled="$disabled" wire:model="nombre_empresa" />
                        </div>
                        <div class="flex md:w-1/3">
                            <x-frk.components.label-input label="direccion_fisica" :disabled="$disabled" wire:model="direccion_fisica" />
                        </div>
                    </div>





                    <div class="flex w-full ">
                        <div class="flex flex-wrap md:w-1/3">
                            <div class="flex flex-wrap w-full">
                                <x-frk.components.label label="Total:  Q. {{$total}}" />
                            </div>

                            <div class="flex flex-wrap  w-full">
                                <x-frk.components.label label="Descuento:  {{$descuento}} %" />
                            </div>
                        </div>
                        <div class="flex flex-wrap md:w-1/3">

                            <div class="flex flex-wrap  w-full">
                                <x-frk.components.label label="Ahorro:  Q. {{$ahorro}}" />
                            </div>

                            <div class="flex flex-wrap  w-full">
                                <x-frk.components.label label="Total con Descuento:  Q. {{$total_descuento}}" />
                            </div>
                        </div>
                        <div class="flex flex-wrap md:w-1/3">
                            <div class="flex flex-wrap w-full">
                                <x-frk.components.label-input-h label="Efectivo:" wire:model="cantidad_efectivo"/>
                            </div>

                            <div class="flex flex-wrap  w-full">
                                <x-frk.components.label-input-h label="Credito:" :disabled="$disabledCredito" wire:model="cantidad_credito"/>
                            </div>

                            <div class="flex flex-wrap  w-full">
                                <x-frk.components.error error="limite_credito" />
                            </div>
                        </div>
                    </div>


                    <div class=" flex w-full">
                        <div class="flex flex-wrap md:w-1/2">
                            <x-frk.components.label class="text-2xl font-semibold uppercase"  label="DETALLE VENTA:" />
                        </div>


                    </div>
                    <div class="w-full relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-2 py-1">
                                        Codigo
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Producto
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Precio Venta
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Subtotal
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($productosDetalle as $key => $value)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-prewrap dark:text-white">
                                        {{$value['codigo']}}

                                    </th>
                                    <th scope="col" class="px-2 py-1">

                                        {{$value['nombre']}}
                                    </th>

                                    <th scope="col" class="px-2 py-1">
                                        Q. {{$value['precio_venta_producto']}}
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        {{$value['cantidad_producto']}}
                                    </th>
                                    <th scope="col" class="px-2 py-1">
                                        Q. {{$value['subtotal_producto']}}
                                    </th>


                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="flex w-full">



                        <x-frk.components.button label="imprimir" wire:click="cancel()" />
                        <x-frk.components.button label="cancelar"  wire:click="cancel()" />
                    </div>


                </div>
            </div>
    </x-slot:body>
    <x-slot:footer>


    </x-slot:footer>
</x-frk.components.template-crud>

