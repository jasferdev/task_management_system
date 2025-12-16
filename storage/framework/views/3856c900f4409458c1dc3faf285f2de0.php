<?php $__env->startSection('title', 'Edit Report - Task Management System'); ?>
<?php $__env->startSection('page-title', 'Edit Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Edit Report</h3>

        <form action="<?php echo e(route('reports.update', $report)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-6">
                <label for="Title" class="block text-sm font-semibold text-gray-800 mb-2">
                    Report Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="Title" 
                    name="Title" 
                    class="form-input <?php $__errorArgs = ['Title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Enter report title"
                    value="<?php echo e(old('Title', $report->Title)); ?>"
                    required
                >
                <?php $__errorArgs = ['Title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-800 mb-3">
                    Select Tasks to Include
                </label>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-80 overflow-y-auto">
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-3 flex items-start">
                            <input 
                                type="checkbox" 
                                id="task_<?php echo e($task->TaskID); ?>" 
                                name="task_ids[]" 
                                value="<?php echo e($task->TaskID); ?>"
                                class="mt-1 rounded"
                                <?php echo e($report->tasks->pluck('TaskID')->contains($task->TaskID) || (is_array(old('task_ids')) && in_array($task->TaskID, old('task_ids'))) ? 'checked' : ''); ?>

                            >
                            <label for="task_<?php echo e($task->TaskID); ?>" class="ml-3 flex-1 cursor-pointer">
                                <p class="font-semibold text-gray-800"><?php echo e($task->Title); ?></p>
                                <p class="text-sm text-gray-600"><?php echo e(Str::limit($task->Description, 60)); ?></p>
                                <div class="flex space-x-2 mt-1">
                                    <span class="badge badge-info text-xs"><?php echo e(ucfirst($task->Priority)); ?></span>
                                    <span class="badge <?php echo e($task->Status == 'completed' ? 'badge-success' : 'badge-warning'); ?> text-xs">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $task->Status))); ?>

                                    </span>
                                </div>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['task_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg flex-1">
                    Update Report
                </button>
                <a href="<?php echo e(route('reports.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management_system\resources\views/reports/edit.blade.php ENDPATH**/ ?>