@props(['label'=>'','color'=>'blue'])

@php
if ($label=='cancelar') {
    $color='gray';
}elseif ($label=='borrar') {
    $color='red';
}
@endphp

<div class="flex w-full justify-center">
    <x-frk.buttons.button label="{{$label}}" class="bg-{{$color}}-500 hover:bg-{{$color}}-800 lg:px-10 md:px-5 sm:px-1" {{$attributes}}/>
</div>


