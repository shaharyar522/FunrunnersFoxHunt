<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Funrunners</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    
    <!-- Sidebar -->
    <div class="w-64 bg-slate-900 text-white flex flex-col">
        <div class="p-6">
            <h2 class="text-xl font-bold tracking-tight">Funrunners</h2>
        </div>
        
        <nav class="flex-1 px-4 py-2 space-y-2">
            <a href="#" class="block px-4 py-2.5 rounded-lg bg-blue-600 font-medium transition-all">
                Dashboard
            </a>
            <a href="#" class="block px-4 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                Voting
            </a>
            <a href="#" class="block px-4 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                Member
            </a>
            <a href="#" class="block px-4 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                Contestants
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-400 hover:text-white transition-all">
                    logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
            <h1 class="text-xl font-semibold text-gray-800">Wellcome admin dasbhoad</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                    AD
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-8">
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
        </main>
    </div>

</body>
</html>
