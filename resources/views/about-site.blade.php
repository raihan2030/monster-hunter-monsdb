<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-navbar />

    <div class="max-w-4xl mx-auto px-4 py-12 text-white">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-blue-500 tracking-tight mb-4">About MonsDB</h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
                MonsDB is a monster database platform dedicated to <span class="text-amber-400 font-semibold">Monster Hunter</span> game enthusiasts. We provide comprehensive information regarding the ecology, types, sizes, and elemental weaknesses of monsters across various game series.
            </p>
        </div>

        <!-- Key Features -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold border-b border-gray-700 pb-2 mb-6 text-blue-400">Key Site Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <x-key-site-feature-card>
                    <x-slot:featureIcon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.637 10.637z" />
                        </svg>
                    </x-slot:featureIcon>
                    <x-slot:featureTitle>Real-Time Search</x-slot:featureTitle>
                    <x-slot:featureDescription>Find your favorite monsters instantly as you type in the search bar without manual submission.</x-slot:featureDescription>
                </x-key-site-feature-card>

                <!-- Card 2 -->
                <x-key-site-feature-card>
                    <x-slot:featureIcon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </x-slot:featureIcon>
                    <x-slot:featureTitle>Size & Type Filters</x-slot:featureTitle>
                    <x-slot:featureDescription>Easily filter down monsters based on their size class (Small/Large) or ecological category types.</x-slot:featureDescription>
                </x-key-site-feature-card>

                <!-- Card 3 -->
                <x-key-site-feature-card>
                    <x-slot:featureIcon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </x-slot:featureIcon>
                    <x-slot:featureTitle>Accurate Data</x-slot:featureTitle>
                    <x-slot:featureDescription>View elemental vulnerabilities, weaknesses, and status ailments specific to each game version.</x-slot:featureDescription>
                </x-key-site-feature-card>
            </div>
        </div>

        <!-- Tech Stack & Credits -->
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-xl">
            <h2 class="text-xl font-bold mb-4 text-blue-500">Technologies & Data Credits</h2>
            <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                This platform is built utilizing a modern backend and frontend stack, including <span class="text-white font-semibold">Laravel 13</span>, <span class="text-white font-semibold">Tailwind CSS v4</span>, and <span class="text-white font-semibold">Alpine.js</span>.
            </p>
            <p class="text-gray-300 text-sm mb-4 leading-relaxed">
                The core monster dataset and structural database references utilized in this project are graciously sourced from the <a href="https://github.com/CrimsonNynja/monster-hunter-DB" target="_blank" class="text-blue-400 hover:text-blue-300 font-semibold underline underline-offset-4">CrimsonNynja/monster-hunter-DB</a> repository on GitHub.
            </p>
            <p class="text-gray-400 text-xs italic leading-relaxed pt-2 border-t border-gray-700/50">
                Disclaimer: All image assets, monster names, and ecological descriptions are trademarks and copyrights of Capcom Co., Ltd. This website is purely fan-made and non-commercial.
            </p>
        </div>
    </div>
</x-layout>