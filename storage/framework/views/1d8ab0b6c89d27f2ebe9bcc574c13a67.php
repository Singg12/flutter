<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Show'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/nouislider/nouislider.min.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Ecommerce
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Show
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg">
            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="mt-2">
                        <h5>Bikes</h5>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <form class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                        <div class="search-box me-2">
                            <div class="position-relative">
                                <input type="text" class="form-control border-0" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                        <ul class="nav nav-pills product-view-nav justify-content-end mt-3 mt-sm-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><i class="bx bx-grid-alt"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="bx bx-list-ul"></i></a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="row" id="app">
                <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(product, index) in products" :key="product.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ product.name }}</td>
                                        <td>${{ product.price }}</td>
                                        <td>{{product.image}}</td>
                                        <td>{{ product.description}} </td>

                                    </tr>
                                    <tr v-if="products.length === 0">
                                        <td colspan="4" class="text-center">No products found.</td>
                                    </tr>
                                </tbody>
                            </table>
                     </div>
                 </div>
                </div>
            </div>
            <!-- End Products Table -->
        </div>
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/nouislider/nouislider.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/wnumb/wnumb.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/product-filter-range.init.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                products: []
            },
            mounted() {
                this.fetchProducts();
            },
            methods: {
                fetchProducts() {
                    axios.get('/api/products')
                        .then(response => {
                            if (response.data.status) {
                                this.products = response.data.data.map(product => ({
                                    id: product.id,
                                    name: product.name,
                                    price: product.price,
                                    description: product.description
                                }));
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching products:', error);
                        });
                }
            }
        });
    </script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/promvuthy/Desktop/Movies/Admin/resources/views/ecommerce-show-pro.blade.php ENDPATH**/ ?>