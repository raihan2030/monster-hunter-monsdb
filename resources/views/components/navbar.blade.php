<nav
    class="relative bg-gray-800/50 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 right-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" command="--toggle" commandfor="mobile-menu"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon"
                        aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex shrink-0 items-center">
                {{-- <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company" class="h-8 w-auto" /> --}}
            </div>
            <div class="hidden sm:ml-6 sm:block">
                <div class="flex space-x-4">
                    <x-nav-link href="{{ route('home') }}" :active="request()->is('home')">Home</x-nav-link>
                    <x-nav-link href="{{ route('about-site') }}" :active="request()->is('about-site')">About Site</x-nav-link>
                    <x-nav-link href="{{ route('about-me') }}" :active="request()->is('about-me')">About Me</x-nav-link>
                </div>
            </div>
        </div>
    </div>

    <el-disclosure id="mobile-menu" hidden class="block sm:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <x-nav-link href="{{ route('home') }}" :active="request()->is('home')" :is-mobile="true">Home</x-nav-link>
            <x-nav-link href="{{ route('about-site') }}" :active="request()->is('about-site')" :is-mobile="true">About Site</x-nav-link>
            <x-nav-link href="{{ route('about-me') }}" :active="request()->is('about-me')" :is-mobile="true">About Me</x-nav-link>
        </div>
    </el-disclosure>
</nav>
