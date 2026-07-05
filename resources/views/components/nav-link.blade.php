@props([
    'active'   => false,
    'isMobile' => false
])

<a {{ $attributes }} aria-current="{{ $active ? 'page' : false }}"
    class="rounded-md px-3 py-2 font-medium text-gray-300
    {{ $active ? 'bg-gray-950/50 text-white' : 'hover:bg-white/5 hover:text-white' }}
    {{ $isMobile ? 'block text-base' : 'text-sm'}}
    ">
    {{ $slot }}
</a>