@props(['label'=>'','color'=>'blue','icon'=>'fa-solid fa-question'])

@php
if ($label=='cancelar') {
    $color='gray';
}elseif ($label=='borrar') {
    $color='red';
}
@endphp



<div class="flex w-full justify-center">
    <button  {{ $attributes->merge(['type' => 'submit', 'class' => "text-white bg-$color-500 text-base capitalize py-1 mx-4 my-1 px-3 rounded lg:px-10 md:px-5 sm:px-1"]) }}  >
        {{ $label }} <i class="{{$icon}}"></i>
    </button>

</div>


