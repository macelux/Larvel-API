<!-- 
<?php use Illuminate\Support\Facades\DB; ?> -->



<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>products</h1>
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
		
  <a href = "<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary pull-right float-right mb-3">Add Product</a>





	<table class="table table-bordered "> 
 	<tr> 
 		<td> S/N  </td>
 		<td> Sku</td>
 		<td> Name </td>
 		<td> Slug  </td>
 		<td> Description</td>
 		<td> Quantity </td>
 		<td> Weight </td>
 		<td> Price</td>
 		<td> Saleprice </td>
 		<td> Status  </td>

 		<!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admins')): ?> -->
 		<?php if(auth()->guard('admin')->check()): ?>
 			<td>Actions</td>
 		<!-- <?php endif; ?>	 -->
 		<?php endif; ?>
 		  			


 	</tr>

 	<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	 	<tr>
	 		<td><?php echo e($product->count); ?></td>

	 		<td><?php echo e($product->sku); ?></td>
	 		<td><?php echo e($product->name); ?></td>
	 		<td><?php echo e($product->slug); ?></td>
	 		<td><?php echo e($product->description); ?></td>
	 		<td><?php echo e($product->quantity); ?></td>
	 		<td><?php echo e($product->weight); ?></td>
	 		<td><?php echo e($product->price); ?></td>
	 		<td><?php echo e($product->sale_price); ?></td>
	 		<td><?php echo e($product->status); ?></td>

	 	
	 		
	 		<?php if(auth()->guard('admin')->check()): ?>
	 				<td class="ml-4">
			 			<div class="d-flex">
			 			<a class="btn btn-xs btn-default text-primary mx-1 shadow btn-inline" title="Edit " href = "<?php echo e(route('admin.products.edit', $product->id )); ?>">
				                <i class="fa fa-lg fa-fw fa-pen"></i>
				        </a>        

				        <a class="btn btn-xs btn-default text-danger mx-1 shadow btn-inline" title="Delete" href = "<?php echo e(route('admin.products.delete', $product->id )); ?>">
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
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\New folder\resources\views/pages/products.blade.php ENDPATH**/ ?>