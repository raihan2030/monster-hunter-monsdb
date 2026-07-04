@props([
    'isTypeActive' => false,
    'types',
    'currentTypeLabel',
])

<div x-data="{ open: false }" class="relative flex-1 md:flex-none sm:w-auto shrink-0 text-sm sm:text-base" @click.outside="open = false">
    <div @click="open = !open"
        class="flex items-center justify-between gap-3 h-10 py-2 px-3.5 sm:px-7 border rounded-2xl hover:border-blue-500 transition cursor-pointer md:w-45 flex-1 whitespace-nowrap
                            {{ $isTypeActive ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-300 border-gray-500' }}">
        <span class="font-semibold whitespace-nowrap">{{ $currentTypeLabel }}</span>

        <svg :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 transition-transform shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </div>

    {{-- Dropdown list --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="absolute z-10 mt-2 w-full bg-slate-900 border border-gray-500 rounded-2xl overflow-hidden" x-cloak>

        <a href="{{ request()->fullUrlWithQuery(['type' => null, 'page' => null]) }}"
            class="block px-5 py-2 hover:bg-gray-700 {{ !$isTypeActive ? 'font-semibold text-white' : 'text-gray-300' }}">
            All Types
        </a>

        @foreach ($types as $type)
            <a href="{{ request()->fullUrlWithQuery(['type' => request('type') === $type->slug ? null : $type->slug, 'page' => null]) }}"
                class="block px-5 py-2 hover:bg-gray-700 {{ request('type') === $type->slug ? 'font-semibold text-white' : 'text-gray-300' }}">
                {{ $type->name }}
            </a>
        @endforeach
    </div>
</div>
