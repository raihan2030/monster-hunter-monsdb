<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Main Series</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-900">
    <div class="flex min-h-screen">
        <aside class="flex flex-col text-zinc-100 w-72 h-screen bg-gray-800 border-r border-gray-600">
            <a href="#" class="flex items-center h-16 gap-3 bg-slate-900 px-7">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>

                <span class="font-bold">Monsters Database</span>
            </a>

            <!-- Home -->
            <nav class="flex flex-col grow gap-2 py-5 px-4">
                <div class="relative flex items-center w-full rounded-full hover:bg-gray-600 duration-300">
                    <a href="/home" class="flex items-center grow h-12 gap-6 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="font-semibold">Home</span>
                    </a>
                </div>

                <!-- Main Series -->
                <div x-data="{ open: true }" class="w-full">
                    <div @click="open = !open"
                        class="flex items-center w-full rounded-full hover:bg-gray-600 duration-300 cursor-pointer"
                        :class="open ? 'bg-gray-600' : ''">
                        <button class="flex items-center grow h-12 gap-6 px-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d=" M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25
                                    12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75
                                    12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0
                                    0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0
                                    0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5
                                    21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0
                                    1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0
                                    0-1.423 1.423Z" />
                            </svg>

                            <span class="font-semibold">Main Series</span>
                        </button>
                        <svg :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 transition-transform mr-3 size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col w-full pl-12 mt-2">
                        @foreach ($mainSeriesNav as $item)
                            @php
                                $isActive = request()->is('database/' . $item->slug);
                            @endphp

                            <a href="/database/{{ $item->slug }}" aria-current="{{ $isActive ? 'page' : 'false' }}"
                                class="relative flex items-center h-10 pl-6 rounded-full after:block after:w-2 after:h-2 after:rounded-sm after:absolute after:-left-2 
                                {{ $isActive
                                    ? 'underline font-semibold text-white after:bg-indigo-500'
                                    : 'hover:font-semibold font-light text-zinc-200 after:bg-zinc-600' }}">
                                <span class="text-sm">{{ $item->acronym }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Spin-offs -->
                <div x-data="{ open: false }" class="w-full">
                    <div @click="open = !open"
                        class="flex items-center w-full rounded-full hover:bg-gray-600 duration-300 cursor-pointer"
                        :class="open ? 'bg-gray-600' : ''">
                        <button class="flex items-center grow h-12 gap-6 px-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d=" M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="font-semibold">Spin-offs</span>
                        </button>
                        <svg :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 transition-transform mr-3 size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0" class="flex flex-col w-full pl-12 mt-2">
                        @foreach ($spinOffNav as $item)
                            @php
                                $isActive = request()->is('database/' . $item->slug);
                            @endphp

                            <a href="/database/{{ $item->slug }}" aria-current="{{ $isActive ? 'page' : 'false' }}"
                                class="relative flex items-center h-10 pl-6 rounded-full after:block after:w-2 after:h-2 after:rounded-sm after:absolute after:-left-2 
                                {{ $isActive
                                    ? 'underline font-semibold text-white after:bg-indigo-500'
                                    : 'hover:font-semibold font-light text-zinc-200 after:bg-zinc-600' }}">
                                <span class="text-sm">{{ $item->acronym }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>
        </aside>

        <main class="flex-1 py-4 px-7">
            <div class="flex justify-center my-2">
                <p class="text-4xl text-white font-bold">
                    @if (isset($series->name))
                        {{ $series->name }}
                    @else
                        Monsters Database
                    @endif
                </p>
            </div>

            <!-- Search & Filter -->
            <div class="flex justify-between pt-5">
                <!-- Search -->
                <form action="{{ url()->current() }}" method="GET">
                    @foreach (request()->except('search', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">
                        Search
                    </label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="search" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Search monsters..."
                            class="h-12 block p-4 pl-10 w-3xl text-md text-gray-300 bg-gray-700 rounded-lg border border-gray-300 hover:border-blue-500 focus:outline-1 focus:outline-blue-500 max-w-xs"
                            v-model.trim="inputSearch" />
                    </div>
                </form>

                <!-- Filter -->
                <div class="flex items-center">
                    @php
                        $isSmallActive = request('size') === 'small';
                        $isLargeActive = request('size') === 'large';
                    @endphp

                    <a href="{{ request()->fullUrlWithQuery(['size' => $isSmallActive ? null : 'small', 'page' => null]) }}"
                        class="{{ $isSmallActive ? 'bg-blue-400 text-white border-blue-400' : 'text-gray-300 border-gray-500' }} flex items-center justify-center h-10 me-3 py-2 px-6 border rounded-2xl hover:border-blue-500 transition">
                        <span class="font-semibold">Small Monsters</span>
                    </a>

                    <a href="{{ request()->fullUrlWithQuery(['size' => $isLargeActive ? null : 'large', 'page' => null]) }}"
                        class="{{ $isLargeActive ? 'bg-blue-400 text-white border-blue-400' : 'text-gray-300 border-gray-500' }} flex items-center justify-center h-10 py-2 px-6 border rounded-2xl hover:border-blue-500 transition">
                        <span class="font-semibold">Large Monsters</span>
                    </a>
                </div>
            </div>

            @if (isset($series))
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 pt-5">
                    @foreach ($monsters as $monster)
                        <a href="#"
                            class="bg-gray-800 border border-gray-800 hover:border-blue-500 text-white h-48 rounded-2xl flex flex-col items-center justify-center font-bold p-2 cursor-pointer transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-2xl hover:z-10 relative">
                            <img src="{{ asset('/img/icons/' . $monster->pivot->image) }}" alt=""
                                class="h-2/3 object-cover object-center rounded-xl" />
                            <p class="text-xl font-bold py-2">{{ Str::limit($monster->name, 10, '...') }}</p>
                        </a>
                    @endforeach

                </div>
                <div class="mt-8">
                    {{ $monsters->links() }}
                </div>
            @else
                <div class="flex justify-center mt-7">
                    <h1 class="text-xl text-white italic">Please select game series in sidebar</h1>
                </div>
            @endif
        </main>
    </div>
</body>

</html>
