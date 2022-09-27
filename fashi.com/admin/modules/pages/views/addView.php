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
                            <form class="form-valide" id="add-pages-form" action="?mod=pages&action=add" method="post" enctype="multipart/form-data">
                                <div class="form-group row ">
                                    <label class="col-lg-2 col-form-label" for="page_title">
                                        Page Title :
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="page_title" rules="required|min:5|max:120" class="form-control input-custom" value="">
                                        <span class='error'></span>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="page_content">
                                        Page Content :
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea name="page_content" id="summernote" rules="required">
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
    Validator("#add-pages-form");
</script>