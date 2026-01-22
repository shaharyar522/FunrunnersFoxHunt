<div class="flex justify-between items-center mb-6">
    <button onclick="goBackToList()" class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Back to List
    </button>
    <div class="flex items-center space-x-4">
        <h2 class="text-2xl font-bold text-gray-900">{{ $voting->title }}</h2>
        @if($voting->status == 0)
            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">Pending</span>
        @elseif($voting->status == 1)
            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">Open</span>
        @else
            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">Closed</span>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 text-sm text-gray-600">
    
    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 italic">
        <strong>Voting Date:</strong> {{ \Carbon\Carbon::parse($voting->votingdate)->format('M d, Y') }}
    </div>
    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
        <strong>Total Contestants:</strong> {{ $voting->votingContestants->count() }}
    </div>

</div>

<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
            <tr>
                <th class="px-6 py-4 font-medium border-b border-gray-100">S.No</th>
                <th class="px-6 py-4 font-medium border-b border-gray-100">Name</th>
                <th class="px-6 py-4 font-medium border-b border-gray-100">Payment</th>
                <th class="px-6 py-4 font-medium border-b border-gray-100">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($voting->votingContestants as $index => $vc)
            <tr class="hover:bg-gray-50 transition-all">
                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $vc->contestant->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">${{ number_format($vc->payments, 2) }}</td>
                <td class="px-6 py-4">
                    <button onclick="toggleContestantStatus({{ $vc->id }}, this)" 
                            class="status-badge cursor-pointer transition-all active:scale-90 focus:outline-none">
                        @if($vc->status == 1)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">Active</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">Inactive</span>
                        @endif
                    </button>
                    <div class="status-loader hidden h-4 w-4 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

