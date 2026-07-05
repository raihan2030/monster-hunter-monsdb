<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div x-data="{ sidebarOpen: window.innerWidth >= 1024 }" 
        @resize.window="sidebarOpen = window.innerWidth >= 1024"
        class="flex min-h-screen overflow-hidden relative">
        
        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen" 
            x-transition.opacity 
            @click="sidebarOpen = false" 
            class="fixed inset-0 bg-black/50 z-20 lg:hidden" 
            style="display: none;"></div>

        {{-- Sidebar Wrapper --}}
        <div :class="sidebarOpen ? 'w-72 translate-x-0' : 'w-0 -translate-x-full'" 
            class="fixed inset-y-0 left-0 z-30 lg:relative transition-all duration-300 ease-in-out shrink-0 overflow-hidden h-screen">
            
            <x-database-sidebar>
                <x-slot:sidebarTitle>{{ $title }}</x-slot:sidebarTitle>

                <x-slot:mainSeriesList>
                    @foreach ($mainSeriesNav as $item)
                        @php
                            $isActive = request()->is('database/' . $item->slug);
                        @endphp

                        <x-sidebar-item 
                            :item="$item"
                            :is-active="$isActive"
                        />
                    @endforeach
                </x-slot:mainSeriesList>
                
                <x-slot:spinOffsList>
                    @foreach ($spinOffNav as $item)
                        @php
                            $isActive = request()->is('database/' . $item->slug);
                        @endphp

                        <x-sidebar-item 
                            :item="$item"
                            :is-active="$isActive"
                        />
                    @endforeach
                </x-slot:spinOffsList>
            </x-database-sidebar>
        </div>

        <main class="flex-1 py-4 px-4 sm:px-7 h-screen overflow-y-auto w-full">
            
            {{-- Header --}}
            <div class="flex items-center mb-2">
                {{-- Hamburger Button --}}
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="p-2 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white hover:border-blue-500 focus:outline-none transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
                
                {{-- Title --}}
                <div class="flex-1 flex justify-center my-2 sm:my-0">
                    <p class="text-2xl sm:text-3xl lg:text-4xl w-3xs sm:w-auto text-white font-bold text-center">
                        @if (isset($series->name))
                            {{ $series->name }}
                        @else
                            Monsters Database
                        @endif
                    </p>
                </div>
                
                {{-- Spacer --}}
                <div class="w-11"></div>
            </div>

            <div class="flex flex-col md:justify-between gap-2.5 md:gap-0 md:flex-row pt-2 md:pt-5">
                <x-search-bar />

                <div class="flex md:items-center md:w-fit w-full gap-2.5">
                    {{-- Size Filter --}}
                    @php
                        $isSmallActive = request('size') === 'small';
                        $isLargeActive = request('size') === 'large';
                        $isActive = $isSmallActive || $isLargeActive;

                        $currentLabel = $isSmallActive
                            ? 'Small Monsters'
                            : ($isLargeActive
                                ? 'Large Monsters'
                                : 'All Sizes');
                    @endphp

                    <x-monster-size-filter 
                        :is-small-active="$isSmallActive" 
                        :is-large-active="$isLargeActive" 
                        :is-active="$isActive" 
                        :current-label="$currentLabel" 
                    />

                    {{-- Monster Type Filter --}}
                    @php
                        $isTypeActive = request('type') !== null && request('type') !== '';

                        $currentTypeLabel = 'All Types';
                        if ($isTypeActive) {
                            $selectedType = $types->firstWhere('slug', request('type'));
                            $currentTypeLabel = $selectedType ? $selectedType->name : 'All Types';
                        }
                    @endphp

                    <x-monster-type-filter
                        :is-type-active="$isTypeActive"
                        :types="$types"
                        :current-type-label="$currentTypeLabel"
                    />
                </div>
            </div>

            {{-- Monster Grid --}}
            @if ($monsters->isEmpty())
                <div class="flex justify-center mt-7">
                    <h1 class="text-xl text-white italic">No data</h1>
                </div>
            @else
                <div class="grid grid-cols-3 lg:grid-cols-5 gap-2 sm:gap-4 pt-5">
                    @foreach ($monsters as $monster)
                        <x-monster-card 
                            :image="$monster->pivot->image" 
                            :name="$monster->name"
                            :link="route('monster.show', ['monster' => $monster->slug, 'series' => isset($series) ? $series->slug : null])"
                        />
                    @endforeach
                </div>

                <div class="mt-4 sm:mt-8">
                    {{ $monsters->links() }}
                </div>
            @endif
        </main>
    </div>
</x-layout>