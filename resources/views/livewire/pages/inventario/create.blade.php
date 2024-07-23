<div>
  <x-modal name="texto" show="true" >

          <div class="flex w-full flex-wrap m-4">

            <x-forms.label-title label="Nuevo {{$title}}" />




                <x-forms.label-input label="existencia" wire:model="existencia" />

                <x-forms.select label="Producto" wire:model="producto_id" id="producto_id">
                  @foreach ($this->products as $data)
                    <option value="{{ $data->id }}" wire:key="marca-{{ $data->id }}">{{ $data->nombre  }}</option>
                  @endforeach
                </x-forms.select>


              <div class="flex w-full md:w-1/2 justify-center content-center" x-data="{value: @entangle('estado')}">
                  <div class="flex items-center m-2 cursor-pointer cm-toggle-wrapper"   wire:click="estadoToggle()">
                      <span class="font-semibold text-xs mr-1">
                        Inactivo
                      </span>

                      <div class="rounded-full w-8 h-4 p-0.5" :class="{'bg-red-500': value == 0,'bg-green-500': value == 1}">
                          <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out" :class="{'-translate-x-2': value == 0,'translate-x-2': value == 1}"></div>
                      </div>
                      <span class="font-semibold text-xs ml-1">
                          Activo
                      </span>
                </div>
              </div>

              <div class="flex w-full md:w-1/2">

                <x-buttons.save-button wire:click.prevent="store()">
                  Guardar
                </x-buttons.save-button>

                <x-buttons.cancel-button wire:click.prevent="cancel()">

                  Cancelar
                </x-buttons.save-button>


          </div>

  </x-modal>
</div>




{{--

                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    nombre empresa
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="nombre_empresa" placeholder="Ingrese aqui">
                  @error('nombre') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>

                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    representante
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="representante" placeholder="Ingrese aqui">
                  @error('apellido') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>

                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    nit
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="nit" placeholder="Ingrese aqui">
                  @error('nit') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    telefono principal
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="telefono_principal" placeholder="Ingrese aqui">
                  @error('telefono_principal') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>
                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    telefono secundario
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="telefono_secundario" placeholder="Ingrese aqui">
                  @error('telefono_secundario') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>

                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    direccion
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="direccion" placeholder="Ingrese aqui">
                  @error('direccion') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>


                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    correo electronico
                  </label>
                  <input class="appearance-none block w-full  text-black border border-gray-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" wire:model="correo_electronico" placeholder="Ingrese aqui">
                  @error('correo_electronico') <span class="text-red-500">{{ $message }}</span>@enderror
                </div>







                {{$estado}}
            <div class="flex items-center m-2 cursor-pointer cm-toggle-wrapper"  x-on:click="value =  (value == onValue ? offValue : onValue);">
                <span class="font-semibold text-xs mr-1">
                    Off
                </span>
                <div class="rounded-full w-8 h-4 p-0.5 bg-gray-300" :class="{'bg-red-500': value == offValue,'bg-green-500': value == onValue}">
                    <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out" :class="{'-translate-x-2': value == offValue,'translate-x-2': value == onValue}"></div>
                </div>
                <span class="font-semibold text-xs ml-1">
                    On
                </span>
            </div>
        </div>
--}}
