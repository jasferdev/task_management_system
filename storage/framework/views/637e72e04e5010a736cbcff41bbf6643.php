<?php $__env->startSection('title', 'Departments - Task Management System'); ?>
<?php $__env->startSection('page-title', 'Departments'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-800">📁 All Departments</h3>
    <a href="<?php echo e(route('departments.create')); ?>" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition">
        ➕ Add New Department
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white border-b">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold">Department</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">👥 Users</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">✓ Tasks</th>
                <th class="px-6 py-4 text-left text-sm font-semibold">📅 Created</th>
                <th class="px-6 py-4 text-center text-sm font-semibold">⚙️ Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b hover:bg-blue-50 transition duration-200">
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 font-bold">
                                <?php echo e(substr($department->DepartmentName, 0, 1)); ?>

                            </span>
                            <div>
                                <p class="font-semibold text-gray-800"><?php echo e($department->DepartmentName); ?></p>
                                <p class="text-xs text-gray-500">ID: <?php echo e($department->DepartmentID); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            👥 <?php echo e($department->users->count()); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-800">
                            ✓ <?php echo e($department->tasks->count()); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($department->created_at->format('M d, Y')); ?></td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="<?php echo e(route('departments.show', $department)); ?>" class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition font-semibold text-xs">
                                👁️ View
                            </a>
                            <a href="<?php echo e(route('departments.edit', $department)); ?>" class="inline-flex items-center px-3 py-1 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 transition font-semibold text-xs">
                                ✏️ Edit
                            </a>
                            <form action="<?php echo e(route('departments.destroy', $department)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="inline-flex items-center px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition font-semibold text-xs">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        📭 No departments found. <a href="<?php echo e(route('departments.create')); ?>" class="text-blue-500 hover:underline font-semibold">Create one</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    <?php echo e($departments->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management_system\resources\views/departments/index.blade.php ENDPATH**/ ?>