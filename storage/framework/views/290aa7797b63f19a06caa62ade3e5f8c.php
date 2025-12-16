<?php $__env->startSection('title', 'Tasks - Task Management System'); ?>
<?php $__env->startSection('page-title', 'Tasks Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content">
    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
        <div>
            <h2 style="color: #2c3e50; font-size: 2.25rem; font-weight: 800; margin: 0 0 0.5rem 0;">All Tasks</h2>
            <p style="color: #7f8c8d; margin: 0; font-size: 0.95rem;">Manage and track your tasks efficiently</p>
        </div>
        <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-primary" style="gap: 0.75rem;">
            <i class="fas fa-plus"></i> Create New Task
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header" style="display: flex; align-items: center; gap: 0.75rem;">
            <i class="fas fa-filter" style="color: #667eea;"></i> Filter Tasks
        </div>
        <div class="card-body">
            <form method="GET" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; align-items: flex-end;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Status</label>
                    <select name="status" class="form-input">
                        <option value="">All Status</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>⏳ Pending</option>
                        <option value="in_progress" <?php echo e(request('status') == 'in_progress' ? 'selected' : ''); ?>>⚡ In Progress</option>
                        <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>✅ Completed</option>
                        <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>❌ Cancelled</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50; font-size: 0.9rem;">Priority</label>
                    <select name="priority" class="form-input">
                        <option value="">All Priority</option>
                        <option value="low" <?php echo e(request('priority') == 'low' ? 'selected' : ''); ?>>🔵 Low</option>
                        <option value="medium" <?php echo e(request('priority') == 'medium' ? 'selected' : ''); ?>>🟡 Medium</option>
                        <option value="high" <?php echo e(request('priority') == 'high' ? 'selected' : ''); ?>>🟠 High</option>
                        <option value="critical" <?php echo e(request('priority') == 'critical' ? 'selected' : ''); ?>>🔴 Critical</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Tasks Table -->
    <div class="card">
        <div class="card-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas fa-list-check" style="color: #667eea;"></i> Tasks List
            </div>
            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 700; font-size: 0.8rem;">
                <?php echo e($tasks->total()); ?> Total
            </span>
        </div>
        <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; border-bottom: 1px solid #f0f0f0; transition: background 0.2s ease; border-radius: 0.5rem; margin-bottom: 0.75rem;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                    <div style="display: flex; align-items: center; gap: 1.5rem; flex: 1;">
                        <!-- Task Icon -->
                        <div style="width: 50px; height: 50px; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 700; flex-shrink: 0;">
                            <?php echo e(substr($task->Title, 0, 1)); ?>

                        </div>

                        <!-- Task Info -->
                        <div style="flex: 1;">
                            <h4 style="margin: 0 0 0.5rem 0; color: #2c3e50; font-weight: 700;"><?php echo e($task->Title); ?></h4>
                            <div style="display: flex; align-items: center; gap: 1.5rem; font-size: 0.85rem;">
                                <span style="color: #7f8c8d;"><i class="fas fa-tag" style="margin-right: 0.5rem;"></i><?php echo e($task->department->DepartmentName ?? 'No Department'); ?></span>
                                <span style="color: #7f8c8d;"><i class="fas fa-id-card" style="margin-right: 0.5rem;"></i><?php echo e($task->TaskID); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Priority Badge -->
                    <div style="margin-right: 1.5rem;">
                        <span class="badge badge-<?php echo e($task->Priority === 'critical' ? 'danger' : ($task->Priority === 'high' ? 'warning' : 'info')); ?>">
                            <i class="fas fa-<?php echo e($task->Priority === 'critical' ? 'fire' : 'flag'); ?>" style="margin-right: 0.25rem;"></i>
                            <?php echo e(ucfirst($task->Priority)); ?>

                        </span>
                    </div>

                    <!-- Status Badge -->
                    <div style="margin-right: 1.5rem;">
                        <span class="badge badge-<?php echo e($task->Status === 'completed' ? 'success' : ($task->Status === 'in_progress' ? 'warning' : ($task->Status === 'pending' ? 'info' : 'danger'))); ?>">
                            <i class="fas fa-<?php echo e($task->Status === 'completed' ? 'check-circle' : ($task->Status === 'in_progress' ? 'spinner' : ($task->Status === 'pending' ? 'hourglass' : 'ban'))); ?>" style="margin-right: 0.25rem;"></i>
                            <?php echo e(ucfirst(str_replace('_', ' ', $task->Status))); ?>

                        </span>
                    </div>

                    <!-- Assigned User -->
                    <div style="margin-right: 1.5rem; text-align: center;">
                        <?php if($task->assignee && $task->assignee->Name): ?>
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;" title="<?php echo e($task->assignee->Name); ?>">
                                <?php echo e(substr($task->assignee->Name, 0, 2)); ?>

                            </div>
                        <?php else: ?>
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #ecf0f1; color: #7f8c8d; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem;">
                                <i class="fas fa-user-slash"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Deadline -->
                    <div style="margin-right: 1.5rem; text-align: right; font-size: 0.9rem; color: #7f8c8d; min-width: 100px;">
                        <?php if($task->DueDate): ?>
                            <i class="fas fa-calendar-alt" style="margin-right: 0.5rem;"></i><?php echo e($task->DueDate->format('M d')); ?>

                        <?php else: ?>
                            <span style="color: #bdc3c7;">No deadline</span>
                        <?php endif; ?>
                    </div>

                    <!-- Actions -->
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="<?php echo e(route('tasks.show', $task)); ?>" class="btn" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; padding: 0.625rem 0.875rem; font-size: 0.8rem; border: none;" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('tasks.edit', $task)); ?>" class="btn" style="background: #ecf0f1; color: #2c3e50; padding: 0.625rem 0.875rem; font-size: 0.8rem; border: none;" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('tasks.destroy', $task)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white; padding: 0.625rem 0.875rem; font-size: 0.8rem; border: none; cursor: pointer;" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="text-align: center; padding: 3rem 1rem;">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: #ecf0f1; margin-bottom: 1rem; display: block;"></i>
                    <h3 style="color: #7f8c8d; margin-bottom: 0.5rem;">No tasks found</h3>
                    <p style="color: #bdc3c7; margin-bottom: 1.5rem;">Create your first task or adjust your filters</p>
                    <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Task
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pagination -->
    <div style="margin-top: 2rem;">
        <?php echo e($tasks->links()); ?>

    </div>
</div>

<style>
    .page-content a[rel*='prev'],
    .page-content a[rel*='next'],
    .page-content .pagination span {
        padding: 0.625rem 1rem;
        border-radius: 0.5rem;
        border: 2px solid #e0e0e0;
        background: white;
        color: #667eea;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        margin: 0 0.25rem;
    }

    .page-content .pagination span.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .page-content a[rel*='prev']:hover,
    .page-content a[rel*='next']:hover {
        background: #ecf0f1;
        border-color: #667eea;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management_system\resources\views/tasks/index.blade.php ENDPATH**/ ?>