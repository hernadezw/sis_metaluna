@props(['label'=>'','icon'=>''])

@php
if ($icon=='') {
    $sec_icon=false;
}else{
    $sec_icon=true;
}
@endphp



<div class="flex w-full justify-center">
<button {{  $attributes->merge(['type' => 'submit', 'class' => "text-white text-base capitalize py-1 mx-4 my-1 px-3 rounded "]) }}>
    {{ $label }}
    @if ($sec_icon)
    <i class="{{$icon}}"></i>


    @endif
</button>
</div>



