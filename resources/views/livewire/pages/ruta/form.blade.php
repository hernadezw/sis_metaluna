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

    <div class="w-full md:w-1/2">
        <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="direccion_departamento" >
          @foreach ($this->departamentos as $data)
          <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
          @endforeach
        </x-frk.components.select>
    </div>
    <div class="w-full md:w-1/2">
        <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="direccion_municipio">
            @foreach ($this->municipios as $data)
            <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
        </x-frk.components.select>
    </div>








</div>
