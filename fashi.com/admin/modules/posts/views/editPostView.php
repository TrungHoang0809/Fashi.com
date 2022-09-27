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
                            <h4>Add Post</h4>
                            <p>Post infomation</p>
                        </div>
                        <div class="form-validation">
                            <form class="form-valide" id="add-post-form" action="?mod=posts&action=addPost" method="post" enctype="multipart/form-data">
                                <div class="form-group row ">
                                    <label class="col-lg-2 col-form-label" for="product_name">
                                        Post title :
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="post_title" rules="required|min:6|max:120" class="form-control input-custom" value="<?php echo $post['post_title']; ?>">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">
                                        Post image cover:
                                    </label>
                                    <input type="file" name="post-img-cover" id="post-thumb" class="form-control-file" accept="image/png, image/jpg, image/jpeg" hidden>
                                    <div class="col-lg-8">
                                        <div class="preview">
                                            <div class="post-thumb-container">
                                                <div class="black-bg">
                                                    <div class="change-img-btn">
                                                        <span><i class="fa-solid fa-pen"></i></span>
                                                    </div>
                                                </div>
                                                <img src="./public/uploads/images/post/<?php echo $post['post_img_cover']; ?>" alt="">
                                            </div>
                                        </div>
                                        <span class='error'></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">
                                        Post Category :
                                    </label>
                                    <div class="col-lg-8">
                                        <?php $current_post_category_ids = explode("|", $post['post_category_id']); ?>
                                        <select data-placeholder="Select Post Category..." class="form-control select-custom chosen-select" rules="required" name="post_category[]" multiple>
                                            <?php foreach ($current_post_category_ids as $post_category_id) : ?>
                                                <option value="<?php echo $post_category_id['post_category_id']; ?>">
                                                    <?php echo $post_category_id['post_category_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class='error'></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="price">
                                        Post content :
                                    </label>
                                    <div class="col-lg-8">
                                        <textarea name="product_desc" id="summernote">
                                            test
                                        </textarea>
                                        <script>
                                            $('#summernote').summernote({
                                                placeholder: 'Hello stand alone ui',
                                                tabsize: 2,
                                                height: 240,
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

                                <div class="row">
                                    <label class="col-form-label col-sm-2 pt-0">Status</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1" checked="checked">
                                            <label class="form-check-label">Public</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0">
                                            <label class="form-check-label">Private</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="btn-submit" value="btn-submit">

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
    Validator("#add-post-form", {
        // onSubmit: function(data) {
        //     console.log(data);
        // }
    });

    $(".chosen-select").chosen();
</script>