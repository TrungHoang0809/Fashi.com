<?php get_header(); ?>

<?php get_sidebar(); ?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title-custom mb-20">
                            <h4>Add New Category</h4>
                            <p>Add a new category and its slug</p>
                        </div>
                        <div class="basic-form">
                            <form action="#" method="POST" class="insert_form">
                                <div class="form-group row colunm-direction">
                                    <label class="col-lg-8 col-form-label bold-label" for="price">
                                        Category Name :
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="text" name="post_category_name" rules="required|min:3|max:20" class="form-control input-custom" placeholder="Enter Category Name" value="<?php echo $current_category['post_category_name'] ?>">
                                        <span class='error'></span>
                                    </div>
                                </div>
                                <div class="form-group row colunm-direction">
                                    <label class="col-lg-8 col-form-label bold-label" for="price">
                                        Slug :
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="text" name="post_category_slug" rules="required|min:3|max:20" class="form-control input-custom" placeholder="Enter Slug" value="<?php echo $current_category['post_category_slug'] ?>">
                                        <span class='error'></span>
                                    </div>
                                </div>
                                <input type="hidden" name="post_category_id" value="<?php echo $current_category['post_category_id'] ?>">

                                <div class="form-group row mb-0">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title-custom">
                            <h4>List Categories</h4>
                            <p>Display list categories</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered list-categories">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($post_categories as $category) : ?>
                                        <tr id="<?php echo $category['post_category_id']; ?>">
                                            <th><?php echo $category['post_category_id']; ?></th>
                                            <td>
                                                <?php echo $category['post_category_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $category["post_category_slug"]; ?>
                                            </td>
                                            <td>
                                                <span>
                                                    <a href="?mod=categories&action=edit&id=<?php echo $category['post_category_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil fs color-muted m-r-5 ">

                                                        </i>
                                                    </a>

                                                    <?php if ($current_category['post_category_id'] == $category["post_category_id"]) : ?>
                                                        <!-- <a href=""></a> -->
                                                    <?php else : ?>
                                                        <a href="#" data-toggle="tooltip" class="delete" data-placement="top" data-id="<?php echo $category['post_category_id']; ?>">
                                                            <i class="fa fa-close fs color-danger"></i>
                                                        </a>
                                                    <?php endif; ?>
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
    Validator(".insert_form", {
        onSubmit: function(data) {
            const formData = new FormData();
            formData.append("post_category_name", data['post_category_name']);
            formData.append("post_category_slug", data['post_category_slug']);
            formData.append("post_category_id", data['post_category_id']);
            formData.append("btn-submit", "btn-submit");

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                var response = JSON.parse(this.responseText);
                if (typeof response === "object") {
                    var trElement = document.getElementById(data['post_category_id']);
                    trElement.innerHTML = "";

                    trElement.innerHTML = `<th>${response['post_category_id']}</th>
                                            <td>
                                                ${response['post_category_name']}
                                            </td>
                                            <td>
                                                ${response['post_category_slug']}
                                            </td>
                                            <td>
                                                <span>
                                                    <a href="?mod=categories&action=edit&id=${response['category_id']}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil fs color-muted m-r-5 "></i>
                                                    </a>
                                                </span>
                                            </td>`;
                }
            }
            xmlhttp.open("POST", "?mod=post_categories&action=updatePostCategory");
            xmlhttp.send(formData);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $("a.delete").click(function() {
            var check = confirm("Do you want to delete this category!");
            if (check) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "?mod=categories&action=delete",
                    method: "post",
                    data: {
                        category_id: id,
                        btn_submit: "submit",
                    },
                    success: function(data) {
                        if (data == "success") {
                            var tr = $("#" + id);
                            tr.remove();
                        }
                    }
                });
            }
        });
    });
</script>