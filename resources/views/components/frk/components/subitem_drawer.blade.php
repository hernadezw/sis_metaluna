@props(['label'=>'item','route'=>'inicio','icon'=>'fa-solid fa-angles-right'])

<a  href="{{route($route)}}" aria-label="dashboard"
    class="block px-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700
    {!! request()->routeIs($route)? 'text-black bg-orange-100' : 'text-white' !!}" >
    <i class="{{$icon}}"></i>
    <span>{{ __($label) }}</span>
</a>

