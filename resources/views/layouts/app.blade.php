<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Task Management System')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .btn-primary {
            background-color: #667eea;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #5568d3;
        }
        .form-input {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
        }
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .badge-info {
            background-color: #dbeafe;
            color: #0c2d6b;
        }
    </style>
    @yield('extra-css')
</head>
<body class="bg-gray-50">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 min-h-screen text-white p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">Task Management</h1>
                <p class="text-sm text-purple-200">System</p>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    📊 Dashboard
                </a>
                <a href="{{ route('departments.index') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    🏢 Departments
                </a>
                <a href="{{ route('users.index') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    👥 Users
                </a>
                <a href="{{ route('tasks.index') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    ✓ Tasks
                </a>
                <a href="{{ route('comments.index') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    💬 Comments
                </a>
                <a href="{{ route('reports.index') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    📋 Reports
                </a>
                <a href="{{ route('system-parameters.index') }}" class="block px-4 py-3 rounded-lg hover:bg-opacity-75 transition">
                    ⚙️ System Parameters
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">@yield('page-title', 'Welcome')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::check() ? Auth::user()->Name : 'Guest' }}</span>
                    @auth
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-8">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <h4 class="font-bold mb-2">Validation Errors:</h4>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    @yield('extra-js')
</body>
</html>
