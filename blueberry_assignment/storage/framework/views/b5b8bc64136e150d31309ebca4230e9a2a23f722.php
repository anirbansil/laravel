

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><?php echo e(__('New Product')); ?></div>
                        <div class="col-md-6" style="text-align: right;">
                            <a href="<?php echo e(route('product')); ?>" class="btn btn-primary">All Product</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <form method="post" id="newproductrecord" enctype="multipart/form-data" onsubmit="saveProduct(event)">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="product_name" id="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Product Price</label>
                            <input type="number" class="form-control" name="product_price" id="product_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="product_image" id="product_image" required>
                        </div>
                        <div class="mb-3">
                            <label for="product_stock" class="form-label">Product Stock</label>
                            <input type="number" class="form-control" name="product_stock" id="product_stock" required>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script>
    function saveProduct(e)
    {
        e.preventDefault();
        // console.log($('#newproductrecord'));
        var formData = new FormData($('#newproductrecord')[0]);

        $.ajax({
            url:"<?php echo e(url('save-product')); ?>",
            method:"POST",
            data:formData,
            contentType:false,
            processData:false,
            success:function(response){
                // console.log(response);
                $('#newproductrecord')[0].reset();
                $('.message').html(response.message);
                $('.message').css({'color': 'green'});
                setTimeout(function() {$('.message').html("");}, 3000);
            },
            error: function(xhr, status, error){
                // console.error(xhr.responseText);
                $('.message').html("Product was not successfully added.");
                $('.message').css({'color': 'red'});
                setTimeout(function() {$('.message').html("");}, 3000);
            }
        });
    }

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\blueberry_assignment\resources\views/new_product.blade.php ENDPATH**/ ?>