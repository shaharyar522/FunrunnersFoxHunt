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
                    <td class="px-8 py-5 text-sm text-gray-600">{{ $contestant->region->name ?? 'N/A' }}</td>
                    <td class="px-8 py-5">
                        @if($contestant->payment_status == 1)
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Paid ($5)</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">Unpaid</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        <button 
                            onclick="toggleStatus({{ $contestant->id }}, {{ $contestant->status }}, this)"
                            class="px-3 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 hover:scale-105 cursor-pointer status-btn-{{ $contestant->id }} 
                            @if($contestant->status == 1) bg-blue-100 text-blue-700 hover:bg-blue-200 @else bg-gray-100 text-gray-700 hover:bg-gray-200 @endif">
                            <span class="status-text-{{ $contestant->id }}">
                                @if($contestant->status == 1) Approved @else Pending @endif
                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleStatus(contestantId, currentStatus, button) {
    // Calculate new status (toggle between 0 and 1)
    const newStatus = currentStatus === 1 ? 0 : 1;
    
    // Disable button during request
    button.disabled = true;
    button.style.opacity = '0.6';
    
    // Send AJAX request
    fetch(`/admin/contestants/${contestantId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button appearance
            const statusText = button.querySelector(`.status-text-${contestantId}`);
            
            if (newStatus === 1) {
                button.className = `px-3 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 hover:scale-105 cursor-pointer status-btn-${contestantId} bg-blue-100 text-blue-700 hover:bg-blue-200`;
                statusText.textContent = 'Approved';
            } else {
                button.className = `px-3 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 hover:scale-105 cursor-pointer status-btn-${contestantId} bg-gray-100 text-gray-700 hover:bg-gray-200`;
                statusText.textContent = 'Pending';
            }
            
            // Update onclick to use new status
            button.setAttribute('onclick', `toggleStatus(${contestantId}, ${newStatus}, this)`);
            
            // Show success feedback
            button.style.transform = 'scale(1.1)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 200);

            // Show success message
            showSuccessMessage('Contestant status is updated');
        } else {
            alert('Failed to update status. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    })
    .finally(() => {
        button.disabled = false;
        button.style.opacity = '1';
    });
}

function showSuccessMessage(message) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50 animate-slide-in';
    toast.innerHTML = `
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="font-medium">${message}</span>
    `;
    
    document.body.appendChild(toast);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
    transition: all 0.3s ease-out;
}
</style>
@endsection
