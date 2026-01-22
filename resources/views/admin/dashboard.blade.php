@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Admin Dashboard')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 text-blue-600 rounded-full mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Login Successful!</h2>
        <p class="text-gray-500 max-w-sm mx-auto">
            Welcome back to the Funrunners admin panel. You can now manage voting, members, and contestants from the side menu.
        </p>
    </div>
@endsection
