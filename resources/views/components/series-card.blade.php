@props(['item' => []])

<a href="{{ route('database.show', ['series' => $item->slug]) }}"
    class="bg-gray-800 border border-gray-700 hover:border-blue-500 text-white h-48 rounded-2xl flex flex-col items-center justify-center font-bold p-2 cursor-pointer transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:z-10 relative">
    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}"
        class="w-full h-full object-cover object-center rounded-xl">
</a>