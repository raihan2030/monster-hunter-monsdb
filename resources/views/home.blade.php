<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Navigation --}}
    <x-navbar />

    {{-- Home Image --}}
    <div class="relative w-full h-64 md:h-96 lg:h-125 overflow-hidden rounded-xl shadow-lg">

        <img src="/img/749574.jpg" alt="Home BG" class="w-full h-full object-cover object-center brightness-50">

        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
            <h2 class="flex flex-col gap-1 text-white tracking-tight drop-shadow-lg">
                <span class="text-4xl sm:text-6xl font-bold">MonsDB</span>
                <span class="text-base sm:text-xl font-normal">Monster Database for Monster Hunter Games</span>
            </h2>

            @php
                $firstSeries = $mainSeriesGrid[0];
            @endphp
            <a href="{{ route('database.show', ['series' => $firstSeries]) }}"
                class="mt-6 px-6 py-3 bg-blue-700 hover:bg-blue-900 text-white font-bold text-base sm:text-lg rounded-xl shadow-xl transition-all duration-300 transform hover:scale-105 inline-flex items-center gap-2.5 border border-blue-500 hover:shadow-blue-500/20">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                Open Monster Database
            </a>
        </div>

    </div>

    {{-- Dashboard --}}
    <div class="m-5">
        <div class="flex justify-center">
            <p class="text-2xl text-white font-bold">
                Database Stats
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-4.5 sm:gap-7 p-4">
            <x-stats-card>
                <x-slot:header>Total Monsters</x-slot:header>
                {{ $totalMonsters }}
            </x-stats-card>
            <x-stats-card>
                <x-slot:header>Main Series</x-slot:header>
                {{ $totalMainSeries }}
            </x-stats-card>
            <x-stats-card>
                <x-slot:header>Spin-offs</x-slot:header>
                {{ $totalSpinOffs }}
            </x-stats-card>
        </div>
    </div>

    {{-- Main Series --}}
    <div class="m-5">
        <div class="flex justify-center">
            <p class="text-2xl text-white font-bold">
                Main Series
            </p>
        </div>

        {{-- List Card Main Series --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
            @foreach ($mainSeriesGrid as $item)
                <x-series-card 
                    :item="$item"
                />
            @endforeach
        </div>
    </div>

    {{-- Spin-offs --}}
    <div class="m-5">
        <div class="flex justify-center">
            <p class="text-2xl text-white font-bold">
                Spin-offs
            </p>
        </div>

        {{-- List Card Main Series --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4">
            @foreach ($spinOffGrid as $item)
                <x-series-card 
                    :item="$item"
                />
            @endforeach
        </div>
    </div>
</x-layout>
