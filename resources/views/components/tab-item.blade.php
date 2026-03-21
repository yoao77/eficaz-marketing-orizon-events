@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => 'pb-4 px-1 border-b-2 font-medium text-sm transition-all ' . 
       ($active 
           ? 'border-indigo-500 text-indigo-600' 
           : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300')
   ]) }}>
    {{ $slot }}
</a>
