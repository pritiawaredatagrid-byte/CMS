@extends('layouts.app')

@section('title', '- Pages')

@section('content')
<div class="max-w-6xl mx-auto">
   
    <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">All Pages</h1>
    
    <a href="{{ route('pages.create') }}" 
       class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Create Page
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    @forelse($pages as $page)
        <div class="p-5 border-b border-gray-100 hover:bg-gray-50 transition">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{-- We can make the title itself a link to the live page for easy access --}}
                        <a href="{{ url('/' . $page->slug) }}" target="_blank" class="hover:text-indigo-600 transition">
                            {{ $page->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Created {{ $page->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="flex gap-4">
     @if ($page->slug)
    <a href="{{ route('pages.show', ['slug' => $page->slug]) }}"
       target="_blank" {{-- Opens the link in a new tab --}}
       class="text-green-600 hover:text-green-800 text-sm font-medium">
        View Live
    </a>
@else
    <span class="text-red-500">Missing Slug</span>
@endif

                    {{-- Existing Link: EDIT PAGE --}}
                    <a href="{{ route('pages.edit', $page->id) }}" 
                       class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                       Edit
                    </a>
                    
                    {{-- Existing Link: DELETE PAGE --}}
                    <form action="" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete the page: {{ $page->title }}?')"
                                class="text-red-600 hover:text-red-800 text-sm font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-gray-500 text-lg">No pages yet.</p>
           
        </div>
    @endforelse
</div>

@if($pages->hasPages())
    <div class="mt-6">
        {{ $pages->links() }}
    </div>
@endif

</div>
@endsection