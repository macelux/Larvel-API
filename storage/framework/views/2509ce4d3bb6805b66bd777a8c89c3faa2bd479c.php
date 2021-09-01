

<?php $__env->startSection('title'); ?> <?php echo e('Order Details'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bar-chart"></i>  Order Details </h1>
            <p></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <section class="invoice">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h2 class="page-header"><i class="fa fa-globe"></i> <?php echo e($order->order_number); ?></h2>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">Date: <?php echo e($order->created_at->toFormattedDateString()); ?></h5>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-4">Placed By
                            <address><strong><?php echo e($order->user->fullName); ?></strong><br>Email: <?php echo e($order->user->email); ?></address>
                        </div>

                        <div class="col-4">
                            <b>Order ID:</b> <?php echo e($order->id); ?><br>
                            <b>Amount:</b> <?php echo e(config('settings.currency_symbol')); ?><?php echo e(round($order->grand_total, 2)); ?><br>
                            <b>Payment Method:</b> <?php echo e($order->payment_method); ?><br>
                            <b>Payment Status:</b> <?php echo e($order->payment_status == 1 ? 'Completed' : 'Not Completed'); ?><br>
                            <b>Order Status:</b> <?php echo e($order->status); ?><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product</th>
                                    <th>SKU #</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php for($i = 0 ; $i < count($order->items);$i++): ?>
                                        <tr>
                                            <td><?php echo e($i + 1); ?></td>
                                            <td><?php echo e($order->items[$i]->product->name); ?></td>
                                            <td><?php echo e($order->items[$i]->product->sku); ?></td>
                                            <td><?php echo e($order->items[$i]->quantity); ?></td>
                                            <td><?php echo e(config('settings.currency_symbol')); ?><?php echo e(round($order->items[$i]->price, 2)); ?></td>
                                        </tr>
                                    <?php endfor; ?>

                                    <tr>
                                        <td class="font-weight-bold"> Grand Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td class=""><?php echo e($order->grand_total); ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Larvel-API\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>