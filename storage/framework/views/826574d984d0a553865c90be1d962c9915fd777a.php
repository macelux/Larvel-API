



<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Orders</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session()->has('message')): ?>


        <div class="alert alert-success bg-green">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?>

    <div class="classes_content">




        <table class="table table-bordered ">
            <tr>
                <td> S/N  </td>
                <td> Customer</td>
                <td> 	Status </td>
                <td> 	Grand Total  </td>

                <td> Item Count</td>
                <td> Payment Status </td>

                <td> Payment Method</td>
                <td> Actions</td>






            </tr>
            <?php $__currentLoopData = $Orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($order->count); ?></td>

                    <td><?php echo e($order->user->fullname); ?> </td>
                    <td><?php echo e($order->status); ?></td>
                    <td><?php echo e($order->grand_total); ?></td>

                    <td><?php echo e($order->item_count); ?></td>
                    <td><?php echo e($order->payment_status); ?></td>
                    <td><?php echo e($order->payment_method); ?></td>
                    <td>
                        <a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "<?php echo e(route('admin.orders.edit', $order->id )); ?>">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>

                        <a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "<?php echo e(route('admin.orders.show', $order->id )); ?>">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "<?php echo e(route('admin.orders.delete', $order->id )); ?>">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </a>
                    </td>









                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Larvel-API\resources\views/pages/orders.blade.php ENDPATH**/ ?>