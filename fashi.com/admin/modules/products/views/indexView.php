<?php get_header(); ?>

<?php get_sidebar(); ?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title-custom">
                            <h4>List Product</h4>
                            <p>Show and Update info your product here!</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) : ?>
                                        <tr class="product-<?php echo $product['product_id']; ?>">
                                            <td><?php echo $product['product_id']; ?></td>
                                            <td><?php echo $product['category_name']; ?></td>
                                            <td><?php echo $product['product_name']; ?></td>
                                            <td><?php echo $product['product_code']; ?></td>
                                            <td><?php echo $product['price']; ?></td>
                                            <td><img class="product-image" src="public/uploads/images/product/<?php echo $product['image']; ?>" alt=""></td>
                                            <td>
                                                <?php if ($product['status'] == 1) : ?>
                                                    <span class="label label-success">In Stock</span>
                                                <?php else : ?>
                                                    <span class="label label-danger">Out of Stock</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $product['created_at']; ?></td>
                                            <td>
                                                <span>
                                                    <a href="?mod=products&action=editProduct&id=<?php echo $product['product_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil fs color-muted m-r-5 "></i>
                                                    </a>

                                                    <a href="#" 
                                                    data-toggle="tooltip" class="delete" data-placement="top" data-id="<?php echo $product['product_id']; ?>" >
                                                        <i class="fa fa-close fs color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<!--**********************************
    Content body end
***********************************-->

<?php get_footer(); ?>

<script>
    $(document).ready(function() {
        $(".delete").click(function(){
            var id = $(this).data("id");
            
            $.ajax({
                url : "?mod=products&action=deleteProduct",
                method: 'post',
                data : {
                    product_id : id
                },
                success : function(data){
                    $(".product-"+id).remove();
                }
            });
        })
    })
</script>