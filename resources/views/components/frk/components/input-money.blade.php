@props(['label'=>'','error'=>'','placeholder'=>'Q.  0.00'])
@php
if ($error==='') {
    $error=$label;
}
@endphp



<div class="w-full flex-wrap items-center my-1 px-1 ">
    <x-frk.components.label label="{{$label}}"  />
    <x-frk.components.input {{$attributes}}  placeholder="{{$placeholder}}" />
    @include('components.frk.components.error')
</div>


