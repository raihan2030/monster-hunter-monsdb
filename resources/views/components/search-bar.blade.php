@props([
    'placeholder' => 'Search monsters...'
])

<form action="{{ url()->current() }}" method="GET" id="search-form">
    @foreach (request()->except('search', 'page') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">
        Search
    </label>
    
    <div class="relative" 
        x-data="{
            searchQuery: '{{ request('search') }}',
            submitSearch() {
                let form = document.getElementById('search-form');
                let formData = new FormData(form);
                formData.set('search', this.searchQuery);
                
                let params = new URLSearchParams(formData);
                if (!this.searchQuery) {
                    params.delete('search');
                }
                
                window.location.search = params.toString();
            }
        }">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <input type="search" 
            id="search" 
            name="search" 
            x-model="searchQuery"
            x-on:input.debounce.500ms="submitSearch()"
            placeholder="{{ $placeholder }}"
            class="h-12 block p-4 pl-10 w-full md:w-70 xl:w-90 text-md text-gray-300 bg-gray-700 rounded-lg border border-gray-300 hover:border-blue-600 focus:outline-1 focus:outline-blue-600" />
    </div>
</form>