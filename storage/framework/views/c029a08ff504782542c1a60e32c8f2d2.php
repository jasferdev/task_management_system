<?php $__env->startSection('title', 'View Department - Task Management System'); ?>
<?php $__env->startSection('page-title', 'Department Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-3xl font-bold text-gray-800"><?php echo e($department->DepartmentName); ?></h3>
                <p class="text-gray-600 mt-1">Department ID: <?php echo e($department->DepartmentID); ?></p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('departments.edit', $department)); ?>" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                    Edit
                </a>
                <form action="<?php echo e(route('departments.destroy', $department)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Delete
                    </button>
                </form>
                <a href="<?php echo e(route('departments.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Total Users</p>
                <p class="text-3xl font-bold text-blue-600"><?php echo e($department->users->count()); ?></p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Total Tasks</p>
                <p class="text-3xl font-bold text-green-600"><?php echo e($department->tasks->count()); ?></p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-600 text-sm">Created</p>
                <p class="text-lg font-semibold text-gray-800"><?php echo e($department->created_at->format('M d, Y')); ?></p>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Users in this Department</h4>
        <?php if($department->users->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">User ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Role</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $department->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm"><?php echo e($user->UserID); ?></td>
                                <td class="px-4 py-3 text-sm font-semibold"><?php echo e($user->Name); ?></td>
                                <td class="px-4 py-3 text-sm"><?php echo e($user->Email); ?></td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge badge-info"><?php echo e($user->Role); ?></span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="badge <?php echo e($user->Status == 'active' ? 'badge-success' : 'badge-danger'); ?>"><?php echo e($user->Status); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No users assigned to this department yet.</p>
        <?php endif; ?>
    </div>

    <!-- Tasks Section -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Tasks in this Department</h4>
        <?php if($department->tasks->count() > 0): ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $department->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800"><?php echo e($task->Title); ?></h5>
                                <p class="text-sm text-gray-600"><?php echo e(Str::limit($task->Description, 100)); ?></p>
                                <div class="flex space-x-2 mt-2">
                                    <span class="badge badge-info"><?php echo e($task->Priority); ?></span>
                                    <span class="badge <?php echo e($task->Status == 'completed' ? 'badge-success' : 'badge-warning'); ?>"><?php echo e($task->Status); ?></span>
                                </div>
                            </div>
                            <a href="<?php echo e(route('tasks.show', $task)); ?>" class="text-blue-500 hover:text-blue-700">
                                View →
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No tasks in this department yet.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management_system\resources\views/departments/show.blade.php ENDPATH**/ ?>