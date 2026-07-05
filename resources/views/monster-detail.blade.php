<x-layout>
    <x-slot:title>{{ $monster->name }} - Details - MonsDB</x-slot:title>

    @php
        $seriesGamer = $monster->series->map(function ($s) {
            return [
                'id' => $s->id,
                'name' => $s->name,
                'acronym' => $s->acronym,
                'image' => asset('/img/icons/' . ($s->pivot->image ?? 'default.png')),
                'info' => $s->pivot->info ?? 'No ecology information available for this game yet.',
                'danger' => $s->pivot->danger ?? 'N/A',
            ];
        });

        $initialActive = $seriesGamer->firstWhere('id', $activeSeries?->id) ?? $seriesGamer->first();

        $elementImages = [
            'fire' => 'element_fire.png',
            'water' => 'element_water.png',
            'thunder' => 'element_thunder.png',
            'ice' => 'element_ice.png',
            'dragon' => 'element_dragon.png',
        ];
    @endphp

    <div x-data="{
        seriesList: {{ json_encode($seriesGamer) }},
        active: {{ json_encode($initialActive) }}
    }" class="max-w-6xl mx-auto px-4 py-8 text-white">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('database.show', ['series' => request('series') ?? $monster->series->first()?->slug]) }}"
                class="inline-flex items-center gap-2 text-gray-400 hover:text-blue-500 transition font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Database
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Dynamic Monster Image Display --}}
            <div
                class="md:col-span-1 bg-gray-800 border border-gray-700 rounded-2xl p-6 flex flex-col items-center shadow-xl h-fit">

                <div
                    class="w-full aspect-square bg-slate-900 rounded-xl overflow-hidden p-6 mb-4 border border-gray-700 flex items-center justify-center">
                    <img :src="active.image" :alt="'{{ $monster->name }} ' + active.name"
                        class="h-2/3 object-contain transition-all duration-300 transform scale-100 hover:scale-105">
                </div>

                <h1 class="text-3xl font-bold text-center mb-1">{{ $monster->name }}</h1>
                <span
                    class="px-3 py-1 bg-gray-700 text-gray-300 text-xs rounded-full font-semibold mb-6 uppercase tracking-wider">
                    {{ $monster->isLarge ? 'Large Monster' : 'Small Monster' }}
                </span>

                <div class="w-full space-y-3">
                    <div class="flex justify-between border-b border-gray-700/50 pb-2 text-sm">
                        <span class="text-gray-400">Class / Type</span>
                        <span class="font-semibold text-blue-400">{{ $monster->type->name ?? 'Unclassified' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-700/50 pb-2 text-sm">
                        <span class="text-gray-400">Threat Level</span>
                        <span class="font-semibold text-red-400" x-text="active.danger"></span>
                    </div>

                    {{-- Subspecies Section --}}
                    <div class="flex flex-col gap-1.5 pt-1 text-sm">
                        <span class="text-gray-400">Subspecies / Relations:</span>
                        <div class="flex flex-wrap gap-1.5 mt-0.5">
                            @if (!empty($monster->subSpecies))
                                @foreach ($monster->subSpecies as $sub)
                                    <span
                                        class="px-2.5 py-0.5 bg-slate-900 border border-gray-700 text-gray-300 text-xs rounded-md font-medium">
                                        {{ $sub }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500 italic text-xs">None</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Game Navigation, Description, Elements, Ailments & Weaknesses --}}
            <div class="md:col-span-2 space-y-6">

                {{-- Game Selection --}}
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
                    <h2 class="text-sm font-bold uppercase text-blue-500 tracking-wider mb-3">Appears In (Click to
                        change Image & Info version):</h2>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="item in seriesList" :key="item.id">
                            <button @click="active = item"
                                :class="active.id === item.id ? 'bg-blue-600 border-blue-500 text-white font-bold' :
                                    'bg-slate-900 border-gray-700 text-gray-400 hover:border-blue-500 hover:text-white'"
                                class="px-4 py-2 text-xs sm:text-sm border rounded-xl transition cursor-pointer">
                                <span x-text="item.name"></span> (<span x-text="item.acronym"></span>)
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Ecology Info --}}
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
                    <div class="flex items-center justify-between mb-3 border-b border-gray-700 pb-2">
                        <h2 class="text-xl font-bold text-blue-500">Ecology & Behavior</h2>
                        <span class="text-xs text-gray-400 bg-slate-900 px-2 py-1 rounded border border-gray-700"
                            x-text="'Version: ' + active.name"></span>
                    </div>
                    <p class="text-gray-300 leading-relaxed text-sm sm:text-base whitespace-pre-line"
                        x-text="active.info"></p>
                </div>

                {{-- ELEMENTS & AILMENTS PANEL --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Monster Elements --}}
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
                        <h3
                            class="text-md font-bold uppercase text-blue-500 tracking-wider mb-3.5 border-b border-gray-700 pb-1.5">
                            Elemental Attacks</h3>
                        <div class="flex flex-wrap gap-2">
                            @if (!empty($monster->elements))
                                @foreach ($monster->elements as $element)
                                    @php
                                        $iconName =
                                            $elementImages[strtolower($element)] ?? strtolower($element) . '.png';
                                    @endphp
                                    <span
                                        class="px-3 py-1.5 bg-slate-900 rounded-xl border border-gray-700 text-sm font-semibold text-gray-200 inline-flex items-center gap-2">
                                        <x-elemental-icon :image="$iconName" />
                                        {{ $element }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500 italic text-sm">None (Pure Physical)</span>
                            @endif
                        </div>
                    </div>

                    {{-- Status Effects / Ailments --}}
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
                        <h3
                            class="text-md font-bold uppercase text-blue-500 tracking-wider mb-3.5 border-b border-gray-700 pb-1.5">
                            Status Effects (Ailments)</h3>
                        <div class="flex flex-wrap gap-2">
                            @if (!empty($monster->ailments))
                                @foreach ($monster->ailments as $ailment)
                                    <span
                                        class="px-3 py-1.5 bg-slate-900 rounded-xl border border-gray-700 text-sm font-semibold text-amber-400 inline-flex items-center gap-1.5">
                                        ⚠️ {{ $ailment }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500 italic text-sm">None</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- MONSTER WEAKNESS PANEL --}}
                @if (!empty($monster->weakness))
                    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
                        <h2 class="text-xl font-bold mb-4 border-b border-gray-700 pb-2 text-blue-500">Elemental
                            Weaknesses</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-sm">
                            @foreach ($monster->weakness as $element)
                                @php
                                    $iconName = $elementImages[strtolower($element)] ?? strtolower($element) . '.png';
                                @endphp
                                <div
                                    class="bg-slate-900 p-3 rounded-xl border border-gray-700 flex justify-between items-center">
                                    <span class="capitalize font-medium text-gray-300 inline-flex items-center gap-2">
                                        <x-elemental-icon :image="$iconName" />
                                        {{ $element }}
                                    </span>
                                    <span
                                        class="text-emerald-400 font-bold text-xs bg-emerald-500/10 px-2.5 py-1 rounded-md border border-emerald-500/20">Weak</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layout>
