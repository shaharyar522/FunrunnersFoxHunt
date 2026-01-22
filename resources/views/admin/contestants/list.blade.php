@extends('layouts.admin')

@section('title', 'Contestants List')
@section('page_title', 'Contestant Management')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">All Contestants (Women)</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-8 py-4 font-medium">Image</th>
                    <th class="px-8 py-4 font-medium">Name</th>
                    <th class="px-8 py-4 font-medium">Email</th>
                    <th class="px-8 py-4 font-medium">Region</th>
                    <th class="px-8 py-4 font-medium">Payment Status</th>
                    <th class="px-8 py-4 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($contestants as $contestant)
                <tr class="hover:bg-gray-50 transition-all">
                    <td class="px-8 py-5">
                        <img src="{{ $contestant->image }}" alt="{{ $contestant->name }}" class="w-10 h-10 rounded-full object-cover">
                    </td>
                    <td class="px-8 py-5 text-sm font-medium text-gray-900">{{ $contestant->name }}</td>
                    <td class="px-8 py-5 text-sm text-gray-600">{{ $contestant->email }}</td>
                    <td class="px-8 py-5 text-sm text-gray-600">{{ $contestant->region }}</td>
                    <td class="px-8 py-5">
                        @if($contestant->payment_status == 1)
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Paid ($5)</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">Unpaid</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        @if($contestant->status == 1)
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">Approved</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">Pending</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
