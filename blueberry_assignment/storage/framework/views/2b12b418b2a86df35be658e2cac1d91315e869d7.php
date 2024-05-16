

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><?php echo e(__('Edit Product')); ?></div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?php echo e(route('product')); ?>" class="btn btn-primary">All Product</a>
                            <a href="<?php echo e(route('new-product')); ?>" class="btn btn-primary">Add New</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form method="post" id="updateproductrecord" enctype="multipart/form-data" onsubmit="updateProduct(event)">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($productData->product_id); ?>">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" value="<?php echo e($productData->product_name); ?>" class="form-control" name="product_name" id="product_name">
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="number" value="<?php echo e($productData->product_price); ?>" class="form-control" name="product_price" id="product_price">
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="product_image" id="product_image">
                            <img src="<?php echo e(url('/'.$productData->product_image)); ?>" width="10%">
                        </div>
                        <div class="mb-3">
                            <label for="product_stock" class="form-label">Product Stock</label>
                            <input type="number" value="<?php echo e($productData->product_stock); ?>" class="form-control" name="product_stock" id="product_stock">
                        </div>
                        <div style="text-align: right;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <span class="message"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateProduct(e)
    {
        e.preventDefault();
        // console.log($('#updateproductrecord'));
        var formData = new FormData($('#updateproductrecord')[0]);

        $.ajax({
            url:"<?php echo e(url('update-product')); ?>",
            method:"POST",
            data:formData,
            contentType:false,
            processData:false,
            success:function(response){
                // console.log(response);
                $('.message').html(response.message);
                $('.message').css({'color': 'green'});
                setTimeout(function() {$('.message').html("");}, 3000);
            },
            error: function(xhr, status, error){
                // console.error(xhr.responseText);
                $('.message').html("Product was not successfully updated.");
                $('.message').css({'color': 'red'});
                setTimeout(function() {$('.message').html("");}, 3000);
            }
        });
    }

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\blueberry_assignment\resources\views/edit_product.blade.php ENDPATH**/ ?>