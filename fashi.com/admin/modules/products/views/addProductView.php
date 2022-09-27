<?php get_header(); ?>

<?php get_sidebar(); ?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title-custom">
                            <h4>Add Product</h4>
                            <p>Add a new product into your store!</p>
                        </div>
                        <div class="form-validation">
                            <form class="form-valide" id="register-form" action="?mod=products&action=addProduct" method="post" enctype="multipart/form-data">
                                <div class="form-group row ">
                                    <label class="col-lg-2 col-form-label" for="product_name">Product Name :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="product_name" rules="required|min:6|max:120" class="form-control input-custom" value="">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="product_code">Product Code :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="product_code" rules="required|min:6|max:120" class="form-control input-custom" value="">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">Price :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" name="price" rules="required|number" class="form-control input-custom" value="">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">Catgory :
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control select-custom" rules="required" name="category">
                                            <option value="">Please select category...</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?php echo $category['category_id']; ?>">
                                                    <?php echo $category['category_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">
                                        Status :
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control select-custom" rules="required" name="status">
                                            <option value="">Please select status of product</option>
                                            <option value="1">In Stock</option>
                                            <option value="0">Out of Stock</option>
                                        </select>
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="avatar">
                                        Avatar :
                                    </label>
                                    <input type="file" name="product-img" id="product-thumb" class="form-control-file" accept="image/png, image/jpg, image/jpeg" hidden>
                                    <div class="col-lg-6">
                                        <div class="form-group border product-thumb-container">
                                            <ul id="preview">
                                                <li>
                                                    <div class="add-file-btn">
                                                        <i class="fa-solid fa-plus d-block"></i>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <span class="error"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Store</button>
                                    </div>
                                </div>
                            </form>
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

<script src="public/js/previewImg.js"></script>

<script>
    Validator("#register-form", {
        // onSubmit: function(data) {
        //     console.log(data);
        // }
    });
</script>