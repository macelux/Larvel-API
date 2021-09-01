
<?php $__env->startSection('title'); ?> <?php echo e('Edit Admin'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css')); ?>"/> -->
     <link rel="stylesheet" href="/css/admin_custom.css">
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
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> <?php echo e('Edit Admin'); ?> </h1>
        </div>
    </div>
   
    
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="<?php echo e(route('admin.admin.update')); ?>" method="POST" role="form">
                            <?php echo csrf_field(); ?>
                            <h3 class="tile-title">Admin Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text"
                                        placeholder="Enter attribute name"
                                        id="name"
                                        name="name"
                                        value="<?php echo e(old('name', $Admin->name)); ?>"
                                    />
                                    <input type="hidden" name="admin_id" value="<?php echo e($Admin->id); ?>">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="tile-body">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Email</label>
                                        <input
                                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text"
                                                placeholder="Enter attribute email"
                                                id="email"
                                                name="email"
                                                value="<?php echo e(old('email', $Admin->email)); ?>"
                                        />
                                        <div class="invalid-feedback active">
                                            <i class="fa fa-exclamation-circle fa-fw"></i> <?php $__errorArgs = ['email'];
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

                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Admin</button>
                                        <a class="btn btn-danger" href="<?php echo e(route('admins.index')); ?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Larvel-API\resources\views/admin/admin/edit.blade.php ENDPATH**/ ?>