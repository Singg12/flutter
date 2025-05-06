<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Add_Product'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/select2/select2.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/libs/dropzone/dropzone.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Ecommerce <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Add Product <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Basic Information</h4>
                <p class="card-title-desc">Fill all information below</p>
            </div>
            <div class="card-body">
                <div id="message" class="mb-3"></div>

                <form id="productForm">
                    <?php echo csrf_field(); ?> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="productname">Product Name</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input id="price" name="price" type="text" class="form-control" placeholder="Price">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="productdesc">Product Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Product Description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>

                        <button type="reset" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Product Images</h4>
            </div>
            <div class="card-body">
                <form action="/api/products/upload" method="post" class="dropzone" id="productImageDropzone">
                    <?php echo csrf_field(); ?>
                    <div class="fallback">
                     <input type="hidden" name="image_path" id="image_path">
                        <input name="file" type="file" multiple />
                    </div>
                    <div class="dz-message needsclick">
                        <div class="mb-3">
                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                        </div>
                        <h4>Drop files here or click to upload.</h4>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/libs/dropzone/dropzone.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/pages/ecommerce-select2.init.js')); ?>"></script>

<script>
    // Handle form submission
    document.getElementById('productForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = {
            name: formData.get('name'),
            description: formData.get('description'),
            price: formData.get('price'),
            image_path: formData.get('image_path'), // Include image path
            _token: formData.get('_token')
        };

        fetch('/api/products', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': data._token
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            const messageDiv = document.getElementById('message');
            if (result.message === 'Product added successfully') {
                messageDiv.innerHTML = '<div class="alert alert-success">' + result.message + '</div>';
                document.getElementById('productForm').reset();
                document.getElementById('image_path').value = ''; // Reset image path
            } else {
                messageDiv.innerHTML = '<div class="alert alert-danger">' + (result.message || 'An error occurred') + '</div>';
            }
        })
        .catch(error => {
            document.getElementById('message').innerHTML = '<div class="alert alert-danger">Error: ' + error.message + '</div>';
        });
    });

    // Configure Dropzone
    Dropzone.options.productImageDropzone = {
        url: '/api/products/upload',
        paramName: 'file',
        maxFilesize: 5, // MB
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        success: function(file, response) {
            if (response.message === 'Image uploaded successfully') {
                document.getElementById('image_path').value = response.file_name; // Store image path
                document.getElementById('message').innerHTML = '<div class="alert alert-success">' + response.message + '</div>';
            }
        },
        error: function(file, response) {
            document.getElementById('message').innerHTML = '<div class="alert alert-danger">' + (response.message || 'Image upload failed') + '</div>';
        }
    };
</script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/promvuthy/Desktop/Movies/Admin/resources/views/ecommerce-add-product.blade.php ENDPATH**/ ?>