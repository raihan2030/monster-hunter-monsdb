@props([
    'item' => '#',
    'isActive' => false,
])

<a href="{{ route('database.show', ['series' => $item->slug]) }}" 
    aria-current="{{ $isActive ? 'page' : 'false' }}"
    class="relative flex items-center h-10 pl-6 rounded-full after:block after:w-2 after:h-2 after:rounded-sm after:absolute after:-left-2 
    {{ $isActive
        ? 'underline font-semibold text-white after:bg-blue-500'
        : 'hover:font-semibold font-light text-zinc-200 after:bg-zinc-600' }}">
    <span class="text-sm">{{ $item->acronym }}</span>
</a>
