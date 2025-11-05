@extends('layouts.app')

@section('title', '- Forms')

@section('content')
<div class="max-w-6xl mx-auto">
   
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">All Forms</h1>
        
        <a href="{{ route('forms.create') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Form
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @forelse($forms as $form)
            <div class="p-5 border-b border-gray-100 hover:bg-gray-50 transition">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            <a href="" class="hover:text-indigo-600 transition">
                                {{ $form->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Created {{ $form->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('forms.edit', $form->id) }}" 
                         class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                               Edit
                          </a>

                        <form action="" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Delete this page?')"
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
                <p class="text-gray-500 text-lg">No forms yet.</p>
               
            </div>
        @endforelse
    </div>

    @if($forms->hasPages())
        <div class="mt-6">
            {{ $forms->links() }}
        </div>
    @endif

</div>
@endsection