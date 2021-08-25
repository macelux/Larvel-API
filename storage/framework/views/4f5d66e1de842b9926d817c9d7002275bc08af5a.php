



<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Users</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="classes_content">





        <table class="table table-bordered ">
            <tr>
                <td> S/N  </td>
                <td> Customer </td>
                <td> 	Product </td>
                <td> 	Content  </td>




            </tr>
            <?php $__currentLoopData = $Reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($review->count); ?></td>

                    <td><?php echo e($review->user->fullname); ?></td>

                    <?php $__currentLoopData = $review->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                        <td><?php echo e($product->name); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <td><?php echo e($review->	body); ?></td>








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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Larvel-API\resources\views/pages/reviews.blade.php ENDPATH**/ ?>