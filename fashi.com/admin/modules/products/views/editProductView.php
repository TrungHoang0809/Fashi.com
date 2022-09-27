<?php get_header(); ?>

<?php get_sidebar(); ?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title-custom">
                            <h4>Edit Product</h4>
                            <p>Update infomation of product!</p>
                        </div>
                        <div class="form-validation">
                            <form class="form-valide" id="register-form" action="?mod=products&action=updateProduct" method="post" enctype="multipart/form-data">
                                <div class="form-group row ">
                                    <label class="col-lg-2 col-form-label" for="product_name">Product Name :
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="product_name" rules="required|min:6|max:120" class="form-control input-custom" value="<?php echo $product['product_name']; ?>">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="product_code">Product Code :
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="product_code" rules="required|min:6|max:15" class="form-control input-custom" value="<?php echo $product['product_code']; ?>">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">Price :
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="price" rules="required|number" class="form-control input-custom" value="<?php echo $product['price']; ?>">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">Category :
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control select-custom" rules="required" name="category_id">
                                            <?php foreach ($categories as $category) : ?>
                                                <?php if ($current_category['category_id'] == $category['category_id']) : ?>
                                                    <option value="<?php echo $category['category_id']; ?>" selected>
                                                        <?php echo $category['category_name']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?php echo $category['category_id']; ?>">
                                                        <?php echo $category['category_name']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">
                                        Status :
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control select-custom" rules="required" name="status">
                                            <?php if ($product['status'] == 1) : ?>
                                                <option value="1" selected>In Stock</option>
                                                <option value="0">Out of Stock</option>
                                            <?php else: ?>
                                                <option value="1" >In Stock</option>
                                                <option value="0" selected>Out of Stock</option>
                                            <?php endif; ?>
                                        </select>
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">
                                        Product Images :
                                    </label>
                                    <input type="file" name="product-img" id="product-thumb" class="form-control-file" accept="image/png, image/jpg, image/jpeg" hidden>
                                    <div class="col-lg-9">
                                        <div class="form-group border product-thumb-container">
                                            <ul id="preview">
                                                <li>
                                                    <div class="add-file-btn">
                                                        <i class="fa-solid fa-plus d-block"></i>
                                                    </div>
                                                </li>
                                                <li>

                                                    <div class="img-box">
                                                        <img src="public/uploads/images/product/<?php echo $product['image']; ?>">

                                                        <div class="black-bg">
                                                            <div class="remove-img-btn">
                                                                <span>
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                </li>
                                            </ul>
                                        </div>
                                        <span class='error'></span>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">
                                        Product Description :
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea name="product_desc" id="summernote">
                                            <?php echo $product['product_desc']; ?>
                                        </textarea>
                                        <script>
                                            $('#summernote').summernote({
                                                placeholder: 'Hello stand alone ui',
                                                tabsize: 2,
                                                height: 120,
                                                toolbar: [
                                                    ['style', ['style']],
                                                    ['font', ['bold', 'underline', 'clear']],
                                                    ['color', ['color']],
                                                    ['para', ['ul', 'ol', 'paragraph']],
                                                    ['table', ['table']],
                                                    ['insert', ['link', 'picture', 'video']],
                                                    ['view', ['fullscreen', 'codeview', 'help']]
                                                ]
                                            });
                                        </script>
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-7 ml-auto">
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

