<?php $__env->startSection('title', 'Create System Parameter - Task Management System'); ?>
<?php $__env->startSection('page-title', 'Create System Parameter'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Create New System Parameter</h3>

        <form action="<?php echo e(route('system-parameters.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-6">
                <label for="ParameterType" class="block text-sm font-semibold text-gray-800 mb-2">
                    Parameter Type <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="ParameterType" 
                    name="ParameterType" 
                    class="form-input <?php $__errorArgs = ['ParameterType'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="e.g., max_task_deadline, default_priority"
                    value="<?php echo e(old('ParameterType')); ?>"
                    required
                >
                <?php $__errorArgs = ['ParameterType'];
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
                <label for="ParameterValue" class="block text-sm font-semibold text-gray-800 mb-2">
                    Parameter Value <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="ParameterValue" 
                    name="ParameterValue" 
                    rows="6"
                    class="form-input <?php $__errorArgs = ['ParameterValue'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Enter parameter value"
                    required
                ><?php echo e(old('ParameterValue')); ?></textarea>
                <?php $__errorArgs = ['ParameterValue'];
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
                    Create Parameter
                </button>
                <a href="<?php echo e(route('system-parameters.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold flex-1 text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management_system\resources\views/system-parameters/create.blade.php ENDPATH**/ ?>