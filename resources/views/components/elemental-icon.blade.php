@props([
    'image'
])

<img src="{{ asset('/img/elemental-icons/' . $image) }}" alt="{{ $image }}" 
class="h-5 w-5 object-contain" />
