





<?php $__env->startSection('title', 'Admins'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Admins</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>




    <a href = "<?php echo e(route('admin.admin.create')); ?>" class="btn btn-primary pull-right float-right mb-3">Add Admin</a>




    <table class="table table-bordered ">
        <tr>
            <td> S/N  </td>
            <td> Name</td>
            <td> Email </td>

            <td> 	is_super</td>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('is_super_admin')): ?>
                <td> Actions</td>
            <?php endif; ?>







        </tr>
        <?php $__currentLoopData = $Admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($admin->count); ?></td>
                <td><?php echo e($admin->name); ?></td>
                <td><?php echo e($admin->email); ?></td>

                <td><?php echo e($admin->is_super==1?"True":"False"); ?></td>


                <?php if(Auth::guard('admin')->user()->is_super == 1): ?>
                    <td class="ml-4">
                        <div class="d-flex">
                            <a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "<?php echo e(route('admin.admin.edit', $admin->id )); ?>">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>

                            <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "<?php echo e(route('admin.admin.delete', $admin->id )); ?>">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>

                        </div>
                    </td>
                <?php endif; ?>











            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Larvel-API\resources\views/pages/admin.blade.php ENDPATH**/ ?>