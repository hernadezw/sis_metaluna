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
                    <x-frk.components.select label="ruta_id" error="ruta_id" :disabled="$disabled" wire:model="ruta_id" >
                        @foreach ($this->rutas as $data)
                            <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                        @endforeach
                    </x-frk.components.select>
                </div>

            </div>

        <!-- //////////Ventas/////////////-->
            <div class="flex w-full ">
                <div class="flex w-full flex-col">
                    <div class="flex w-full w-grap">
                        <div class="flex w-full ">
                            <x-frk.components.subtitle label="Ventas Asignadas"  />
                        </div>
                    </div>

                    <div class="w-full bg-white rounded-lg p-4 shadow-md m-2">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="border-b w-full">
                                    <th class="">
                                        <h2 class="text-ml font-bold text-gray-600">No Venta</h2>
                                    </th>
                                    <th class="">
                                        <h2 class="text-ml font-bold text-gray-600">Fecha Venta</h2>
                                    </th>
                                    <th class="">
                                        <h2 class="text-ml font-bold text-gray-600">Nit</h2>
                                    </th>
                                    <th class="">
                                        <h2 class="text-ml font-bold text-gray-600">Nombres cliente</h2>
                                    </th>
                                    <th class="">
                                        <h2 class="text-ml font-bold text-gray-600">Apellidos cliente</h2>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($this->envio->ventas as $key => $value)
                                    <tr class="border-b w-full">
                                        <td class="px-4 py-2 text-left align-top ">
                                            <div>
                                                <h2>{{$value->no_venta}}</h2>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-left align-top ">
                                            <div>
                                                <h2>{{$value->fecha_venta}}</h2>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-right ">
                                            <p><span>{{$value->cliente->nit}}</span></p>
                                        </td>
                                        <td class="px-4 py-2 text-right ">
                                            <p><span>{{$value->cliente->nombres_cliente}}</span></p>
                                        </td>
                                        <td class="px-4 py-2 text-right ">
                                            <p><span>{{$value->cliente->apellidos_cliente}}</span></p>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>




        <!-- //////////Ventas/////////////-->






        <!-- //////////Usuarios/////////////-->
        <div class="flex w-full ">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full ">
                        <x-frk.components.subtitle label="Usuarios Asignados"  />
                    </div>
                </div>

                <div class="w-full bg-white rounded-lg p-4 shadow-md m-2">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="border-b w-full">
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">codigo</h2>
                                </th>
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">nombres</h2>
                                </th>
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">apellidos</h2>
                                </th>
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">telefono principal</h2>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->envio->users as $key => $value)
                                <tr class="border-b w-full">
                                    <td class="px-4 py-2 text-left align-top ">
                                        <div>
                                            <h2>{{$value->codigo}}</h2>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-left align-top ">
                                        <div>
                                            <h2>{{$value->nombres}}</h2>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-right ">
                                        <p><span>{{$value->apellidos}}</span></p>
                                    </td>
                                    <td class="px-4 py-2 text-right ">
                                        <p><span>{{$value->telefono_principal}}</span></p>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- //////////Usuarios/////////////-->


        <!-- //////////vehiculos/////////////-->
        <div class="flex w-full ">
            <div class="flex w-full flex-col">
                <div class="flex w-full w-grap">
                    <div class="flex w-full ">
                        <x-frk.components.subtitle label="Vehiculos Asignados"  />
                    </div>
                </div>


                <div class="w-full bg-white rounded-lg p-4 shadow-md m-2">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="border-b w-full">
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">codigo</h2>
                                </th>
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">alias</h2>
                                </th>
                                <th class="">
                                    <h2 class="text-ml font-bold text-gray-600">Placa</h2>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($this->envio->vehiculos as $key => $value)
                                <tr class="border-b w-full">
                                    <td class="px-4 py-2 text-left align-top ">
                                        <div>
                                            <h2>{{$value->codigo}}</h2>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-left align-top ">
                                        <div>
                                            <h2>{{$value->alias}}</h2>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 text-right ">
                                        <p><span>{{$value->numero_placa}}</span></p>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


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

