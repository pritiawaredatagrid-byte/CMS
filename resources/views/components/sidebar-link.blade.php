@props(['href', 'icon', 'active' => false])

<a href="{{ $href }}"
   class="flex items-center p-3 rounded-lg transition {{ $active ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    {{ $slot }}
</a>