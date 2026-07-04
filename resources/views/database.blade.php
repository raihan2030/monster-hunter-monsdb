<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
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
                <x-search-bar />

                <!-- Filter -->
                <div class="flex items-center gap-2.5">
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
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 pt-5">
                    @foreach ($monsters as $monster)

                        <x-monster-card 
                            :image="$monster->pivot->image" 
                            :name="$monster->name"
                        />

                    @endforeach

                </div>
                
                <div class="mt-8">
                    {{ $monsters->links() }}
                </div>
            @endif
        </main>
    </div>
</x-layout>
