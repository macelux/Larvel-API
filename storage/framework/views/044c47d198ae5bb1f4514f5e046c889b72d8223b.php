



<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Users</h1>
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
 		<td> S/N </td>
 		<td> Name</td>

 		<td> Email  </td>

 		<td> Address </td>
 		<td> City </td>
 		<td> Country</td>

 		

 		<!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admins')): ?> -->
 		<?php if(auth()->guard('admin')->check()): ?>
 			<td>Actions</td>
 		<!-- <?php endif; ?>	 -->
 		<?php endif; ?>
 		  			


 	</tr>

 	<?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	 	<tr>


			<td><?php echo e($user->count); ?></td>
	 		<td><?php echo e($user->full_name); ?></td>

	 		<td><?php echo e($user->email); ?></td>

	 		<td><?php echo e($user->address); ?></td>
	 		<td><?php echo e($user->city); ?></td>
	 		<td><?php echo e($user->country); ?></td>





	 		<?php if(auth()->guard('admin')->check()): ?>
	 				<td class="ml-4">
			 			<div class="d-flex">
			 			<a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "<?php echo e(route('admin.users.edit', $user->id )); ?>">
				                <i class="fa fa-lg fa-fw fa-pen"></i>
				        </a>

				        <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "<?php echo e(route('admin.users.delete', $user->id )); ?>">
				                  <i class="fa fa-lg fa-fw fa-trash"></i>
				        </a>

			            </div>
	        		</td>
	 		<?php endif; ?>



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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Larvel-API\resources\views/pages/users.blade.php ENDPATH**/ ?>