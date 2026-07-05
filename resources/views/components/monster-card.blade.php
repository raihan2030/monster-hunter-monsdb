@props(['image', 'name', 'link' => '#'])

<a href="{{ $link }}"
    {{ $attributes->merge([
        'class' =>
            'bg-gray-800 border border-gray-800 hover:border-blue-500 text-white h-24 sm:h-48 rounded-lg  sm:rounded-2xl flex flex-col items-center justify-center font-bold p-2 cursor-pointer transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:z-10 relative',
    ]) }}>

    <img src="{{ asset('/img/icons/' . $image) }}" alt="{{ $name }}"
        class="h-2/3 lg:h-4/7 object-cover object-center rounded-xl text-xs font-normal text-center" />

    <p class="text-xs text-center font-bold pt-2 sm:hidden">
        {{ Str::limit($name, 8, '...') }}
    </p>

    <p class="hidden sm:block text-xs sm:text-lg text-center font-bold pt-2">
        {{ Str::limit($name, 13, '...') }}
    </p>
</a>
