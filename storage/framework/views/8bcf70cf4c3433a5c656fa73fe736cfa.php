<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Task Management System'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            color: #2c3e50;
            line-height: 1.6;
        }

        /* Enhanced Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.2) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
        }

        .sidebar h1 {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.8px;
            text-transform: uppercase;
            background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            position: relative;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left-color: #3498db;
            padding-left: 1.5rem;
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(52, 152, 219, 0.2) 0%, transparent 100%);
            color: #fff;
            border-left-color: #3498db;
            box-shadow: inset 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .nav-icon {
            margin-right: 0.875rem;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .nav-link:hover .nav-icon {
            transform: translateX(4px);
        }

        /* Main Content */
        .main-content {
            margin-left: 16rem;
            background: #f8f9fa;
            min-height: 100vh;
        }

        /* Top Bar Enhancement */
        .top-bar {
            background: #fff;
            border-bottom: 2px solid #ecf0f1;
            padding: 1.5rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 0.95rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: #7f8c8d;
            text-transform: capitalize;
        }

        .user-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db 0%, #2ecc71 100%);
            color: white;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        /* Page Content */
        .page-content {
            padding: 2.5rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Enhanced Alerts */
        .alert {
            padding: 1.25rem 1.5rem;
            border-radius: 0.625rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            animation: slideIn 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-left: 4px solid;
            background: #fafafa;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #f0fdf4;
            border-left-color: #10b981;
            color: #065f46;
        }

        .alert-error {
            background-color: #fef2f2;
            border-left-color: #ef4444;
            color: #7f1d1d;
        }

        .alert-icon {
            flex-shrink: 0;
            font-size: 1.25rem;
            margin-top: 2px;
        }

        .alert-success .alert-icon {
            color: #10b981;
        }

        .alert-error .alert-icon {
            color: #ef4444;
        }

        .alert-content h4 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .alert-content ul {
            margin: 0.5rem 0 0 1.5rem;
            list-style: disc;
        }

        .alert-content li {
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        /* Premium Buttons */
        .btn {
            padding: 0.75rem 1.375rem;
            border-radius: 0.625rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            text-decoration: none;
            text-transform: capitalize;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #ecf0f1;
            color: #2c3e50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-secondary:hover {
            background: #d5dbdb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        /* Form Elements */
        .form-input {
            border: 2px solid #ecf0f1;
            border-radius: 0.625rem;
            padding: 0.75rem 1rem;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.25s ease;
            font-family: inherit;
            background: #fff;
        }

        .form-input:hover {
            border-color: #d5dbdb;
        }

        .form-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1), inset 0 0 0 1px #3498db;
        }

        /* Premium Badges */
        .badge {
            display: inline-block;
            padding: 0.5rem 0.875rem;
            border-radius: 0.4rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        /* Enhanced Cards */
        .card {
            background: white;
            border-radius: 0.875rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            border-color: #e0e0e0;
            transform: translateY(-4px);
        }

        .card-header {
            padding: 1.75rem;
            border-bottom: 2px solid #f8f9fa;
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.1rem;
            letter-spacing: -0.3px;
        }

        .card-body {
            padding: 1.75rem;
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: linear-gradient(90deg, #f8f9fa 0%, #ecf0f1 100%);
            padding: 1.125rem;
            text-align: left;
            font-weight: 700;
            font-size: 0.85rem;
            color: #2c3e50;
            border-bottom: 2px solid #e0e0e0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 1.125rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
            transition: background 0.2s ease;
        }

        /* Stat Card */
        .stat-card {
            display: flex;
            align-items: flex-end;
            gap: 1.5rem;
            padding: 1.75rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #2c3e50;
            line-height: 1;
        }

        .stat-label {
            font-weight: 600;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-left: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .page-content {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }
    </style>
    <?php echo $__env->yieldContent('extra-css'); ?>
</head>
<body>
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="sidebar w-64 text-white p-6">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center text-xl">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <h1>TaskFlow</h1>
                        <p class="text-xs text-purple-200">Management</p>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav space-y-1">
                <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(Route::is('dashboard') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-chart-line"></i>
                    Dashboard
                </a>
                <a href="<?php echo e(route('departments.index')); ?>" class="nav-link <?php echo e(Route::is('departments.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-building"></i>
                    Departments
                </a>
                <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(Route::is('users.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-users"></i>
                    Users
                </a>
                <a href="<?php echo e(route('tasks.index')); ?>" class="nav-link <?php echo e(Route::is('tasks.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-tasks"></i>
                    Tasks
                </a>
                <a href="<?php echo e(route('comments.index')); ?>" class="nav-link <?php echo e(Route::is('comments.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-comments"></i>
                    Comments
                </a>
                <a href="<?php echo e(route('reports.index')); ?>" class="nav-link <?php echo e(Route::is('reports.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-chart-bar"></i>
                    Reports
                </a>
                <a href="<?php echo e(route('system-parameters.index')); ?>" class="nav-link <?php echo e(Route::is('system-parameters.*') ? 'active' : ''); ?>">
                    <i class="nav-icon fas fa-cog"></i>
                    Settings
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <!-- Top Bar -->
            <div class="top-bar">
                <h2 class="page-title"><?php echo $__env->yieldContent('page-title', 'Welcome'); ?></h2>
                <div class="user-menu">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="user-info">
                            <p class="user-name"><?php echo e(Auth::user()?->Name ?? 'User'); ?></p>
                            <p style="font-size: 0.75rem; color: #718096;"><?php echo e(Auth::user()->Role); ?></p>
                        </div>
                        <div class="user-badge"><?php echo e(substr(Auth::user()->Name, 0, 1)); ?></div>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Page Content -->
            <div class="page-content">
                <?php if(isset($errors) && $errors->any()): ?>
                    <div class="alert alert-error">
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="alert-content">
                            <h4>Validation Errors</h4>
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <div class="alert-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="alert-content">
                            <?php echo e(session('success')); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldContent('extra-js'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\task_management_system\resources\views/layouts/app.blade.php ENDPATH**/ ?>