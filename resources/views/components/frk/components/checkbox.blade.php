
@props(['textLabel'=>''])
<div class="flex flex-wrap mx-1">
    <input type="checkbox"  {!! $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-400 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    <x-frk.components.label textLabel="{{$textLabel}}" />
</div>
