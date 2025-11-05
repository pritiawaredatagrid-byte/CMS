@extends('layouts.app')

@section('title', '- Dashboard')

@section('content')
<div class="max-w-5xl">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard</h1>
    <p class="text-gray-600 mb-6">Welcome back!</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

   
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition cursor-pointer"
            onclick="window.location.href='{{ route('forms') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Forms</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $formsCount }}</h2>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full text-xl">
                    📄
                </div>
            </div>
        </div>


        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition cursor-pointer"
            onclick="window.location.href='{{ route('pages') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Pages</p>
                    <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $pagesCount }}</h2>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-full text-xl">
                    🧾
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
