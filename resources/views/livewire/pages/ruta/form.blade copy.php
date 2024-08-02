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
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_a" >
              @foreach ($this->departamentos as $data)
              <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
              @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_a">
                @foreach ($this->municipios_a as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_b" >
              @foreach ($this->departamentos as $data)
              <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
              @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_b">
                @foreach ($this->municipios_b as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
    </div>



    <div class="flex w-full">
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_c" >
                @foreach ($this->departamentos as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_c">
                @foreach ($this->municipios_c as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>

        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_d" >
            @foreach ($this->departamentos as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_d">
                @foreach ($this->municipios_d as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
    </div>

    <div class="flex w-full">
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_e" >
            @foreach ($this->departamentos as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_e">
            @foreach ($this->municipios_e as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>

        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_f" >
            @foreach ($this->departamentos as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_f">
                @foreach ($this->municipios_f as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
    </div>



    <div class="flex w-full">
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_g" >
                @foreach ($this->departamentos as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_g">
                @foreach ($this->municipios_g as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>

        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_h" >
            @foreach ($this->departamentos as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_h">
                @foreach ($this->municipios_h as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
    </div>

    <div class="flex w-full">
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_i" >
            @foreach ($this->departamentos as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>

            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_i">
                @foreach ($this->municipios_i as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>


    <div class="flex w-full md:w-1/2">
        <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_j" >
          @foreach ($this->departamentos as $data)
          <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
          @endforeach
        </x-frk.components.select>

        <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_j">
            @foreach ($this->municipios_j as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
        </x-frk.components.select>
    </div>
</div>








</div>
