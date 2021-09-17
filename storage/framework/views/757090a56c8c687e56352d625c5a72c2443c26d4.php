
<?php $__env->startSection('title'); ?> <?php echo e('Edit Order'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css')); ?>"/> -->
     <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> <?php echo e('Edit Order'); ?> </h1>
        </div>
    </div>

    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <form action="<?php echo e(route('admin.orders.update')); ?>" method="POST" role="form">
                        <?php echo csrf_field(); ?>
                        <h3 class="tile-title">Order Information</h3>
                        <hr>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="status">	Status</label>
                                    <input
                                            class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            type="text"
                                            placeholder="Enter order Status"
                                            id="status"
                                            name="status"
                                            value="<?php echo e(old('status', $order->status)); ?>"
                                    />
                                    <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="payment_status">	PaymentStatus</label>
                                    <input
                                            class="form-control <?php $__errorArgs = ['payment_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            type="text"
                                            placeholder="Enter order PaymentStatus"
                                            id="payment_status"
                                            name="payment_status"
                                            value="<?php echo e(old('payment_status', $order->payment_status)); ?>"
                                    />
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> <?php $__errorArgs = ['payment_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>



                        <div class="tile-footer">
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Order</button>
                                    <a class="btn btn-danger" href="<?php echo e(route('orders.index')); ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\New folder\resources\views/admin/orders/edit.blade.php ENDPATH**/ ?>