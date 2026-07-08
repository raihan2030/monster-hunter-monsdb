<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-navbar />

    <div class="max-w-4xl mx-auto px-4 py-12 text-white">
        <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 sm:p-10 shadow-xl flex flex-col md:flex-row gap-8 items-center md:items-start">
            
            <!-- Profile Picture Placeholder -->
            <div class="w-36 h-36 bg-slate-900 rounded-full flex items-center justify-center shrink-0 border-4 border-blue-500 overflow-hidden shadow-lg">
                <img src="/img/profile/my_photo.jpeg" alt="Developer Profile" class="w-full h-full object-cover">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>

            <!-- Profile Details -->
            <div class="flex-1 text-center md:text-left space-y-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-500 bg-blue-500/10 px-3 py-1 rounded-md border border-blue-500/20">Lead Developer / Hunter</span>
                    <h1 class="text-3xl font-bold mt-2">Muhammad Raihan</h1>
                    <p class="text-gray-400 text-sm mt-1">Full-stack Web Developer & Gamer</p>
                </div>

                <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                    Hello! I'm the developer behind MonsDB. This project initially started out of my deep love for playing the Monster Hunter franchise and my desire to build a clean, fast, and lightweight archive page accessible right from any web browser.
                </p>

                <!-- Gamer Stats Panel -->
                <div class="grid grid-cols-2 gap-4 pt-2 text-sm max-w-md mx-auto md:mx-0">
                    <div class="bg-slate-900/60 p-3 rounded-xl border border-gray-700/50">
                        <span class="text-gray-400 block text-xs">Favorite Weapons</span>
                        <span class="font-semibold text-amber-400">Long Sword / Switch Axe</span>
                    </div>
                    <div class="bg-slate-900/60 p-3 rounded-xl border border-gray-700/50">
                        <span class="text-gray-400 block text-xs">First MH Title</span>
                        <span class="font-semibold text-blue-400">Monster Hunter Freedom Unite</span>
                    </div>
                </div>

                <!-- External Links / Contact -->
                <div class="pt-4 border-t border-gray-700/50 flex flex-wrap justify-center md:justify-start gap-3">
                    <a href="https://github.com/raihan2030" target="_blank" class="px-4 py-2 bg-slate-900 border border-gray-600 hover:border-blue-500 text-xs font-semibold rounded-xl transition inline-flex items-center gap-2">
                        GitHub
                    </a>
                    <a href="https://www.linkedin.com/in/muhammad-raihan-8699342a1/" target="_blank" class="px-4 py-2 bg-slate-900 border border-gray-600 hover:border-blue-500 text-xs font-semibold rounded-xl transition inline-flex items-center gap-2">
                        LinkedIn
                    </a>
                    <a href="mailto:raihan.muhammad.bjm@gmail.com" class="px-4 py-2 bg-slate-900 border border-gray-600 hover:border-blue-500 text-xs font-semibold rounded-xl transition inline-flex items-center gap-2">
                        Contact Email
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout>