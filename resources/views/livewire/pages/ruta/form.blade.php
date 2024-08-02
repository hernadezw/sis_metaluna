<div class="flex flex-wrap">
    <div class="w-full md:w-1/2">
        <x-frk.components.label-input label="codigo" :disabled="$disabled" wire:model="codigo" />
    </div>

    <div class="w-full md:w-1/2">
        <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
    </div>
        <div class="w-full">
        <x-frk.components.text-area label="descripcion" row=¨2¨ :disabled="$disabled" wire:model="descripcion" />

    </div>


    <div class="flex w-full">
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_id" >
              @foreach ($this->departamentos as $data)
              <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
              @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_id">
                @foreach ($this->municipios as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>

            <div class="flex w-full md:w-1/6">
                <x-frk.components.label-input label="Observaciones" :disabled="$disabled" wire:model="observaciones" />
            </div>


            <div class="flex flex-wrap md:w-1/6">
                <x-frk.components.label label="Agregar" class="font-semibold capitalize"/>
                <x-frk.components.button label="+" wire:click.prevent="addDetalle()" />
            </div>
        </div>



        <div class="flex w-full ">
                <x-frk.components.subtitle label="Detalle Ruta" />
{{$i}}
        </div>

        <div class="flex w-full">
            <div class="flex w-full ">
                <div class="flex w-full flex-col">

                    <div class="flex w-full w-grap">
                        <div class="flex w-full md:w-4/6">
                            <x-frk.components.label label="Departamento"  />
                        </div>
                        <div class="flex w-full md:w-4/6">
                            <x-frk.components.label label="Municipio"  />
                        </div>

                        <div class="flex w-full md:w-1/6">
                            <x-frk.components.label label="Observacion" />
                        </div>

                        <div class="flex w-full  md:w-1/6">
                            <x-frk.components.label label="Quitar" />
                        </div>
                    </div>

                    @if ($inputs!=null)
                        @foreach($inputs as $key => $value)
                        <div class="flex w-full w-grap ">
                            <div class="flex w-full md:w-3/9">
                                <x-frk.components.list-input :disabled="$disabled_departamento" wire:model="nombreDepartamento.{{$value}}" />
                            </div>
                            <div class="flex w-full md:w-3/9">
                                <x-frk.components.list-input :disabled="$disabled_departamento" wire:model="nombreMunicipio.{{$value}}" />
                            </div>
                            <div class="flex w-full md:w-2/9">
                                <x-frk.components.list-input :disabled="$disabled_departamento" wire:model="observacionDetalle.{{$value}}" />
                            </div>
                            @if (!$isShow)
                                <div class="w-full md:w-1/9">
                                    <x-frk.components.button label="-" color="red" wire:click.prevent="removeDetalle({{$value}})" />
                                </div>
                            @endif
                        </div>
                        @endforeach

                    @else

                        <div class="flex w-full ">
                            <x-frk.components.label-error label="Sin productos" error="inputs"/>


                        </div>
                    @endif
                </div>
            </div>
        </div>



    </div>









</div>
