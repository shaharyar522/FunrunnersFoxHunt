@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Member Dashboard</h1>
        
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Welcome, {{ $member->name ?? 'Member' }}!</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Dummy text as requested for member view.</p>
            </div>
            <div class="border-t border-gray-200 p-8 space-y-4">
                <p class="text-gray-600 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
                <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 mt-6">
                    <p class="text-sm text-indigo-700 font-medium">
                        Feature coming soon: You will be able to vote for your favorite contestants once the regional rounds are open!
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <div class="border rounded-lg p-4 hover:border-indigo-500 transition-colors cursor-pointer">
                        <h4 class="font-bold text-gray-800">Your Subscription</h4>
                        <p class="text-sm text-gray-500 mt-1">Monthly membership status: 
                            <span class="font-semibold {{ ($member && $member->payment_status == 1) ? 'text-green-600' : 'text-red-600' }}">
                                {{ ($member && $member->payment_status == 1) ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                    <div class="border rounded-lg p-4 hover:border-indigo-500 transition-colors cursor-pointer">
                        <h4 class="font-bold text-gray-800">Voting Power</h4>
                        <p class="text-sm text-gray-500 mt-1">Next round starts in: <span class="font-semibold text-gray-700">5 days</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
