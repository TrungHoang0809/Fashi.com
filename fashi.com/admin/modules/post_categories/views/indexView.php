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
                            <h4>Add New Post Category</h4>
                            <p>Add a new post category and its slug</p>
                        </div>
                        <div class="basic-form">
                            <form action="#" method="POST" class="insert_post_category_form">
                                <div class="form-group row colunm-direction">
                                    <label class="col-lg-8 col-form-label bold-label" for="price">
                                        Post Category Name :
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="text" name="post_category_name" rules="required|min:3|max:20" class="form-control input-custom" placeholder="Enter Post Category Name">
                                        <span class='error'></span>
                                    </div>
                                </div>
                                <div class="form-group row colunm-direction">
                                    <label class="col-lg-8 col-form-label bold-label" for="price">
                                        Slug :
                                    </label>
                                    <div class="col-lg-12">
                                        <input type="text" name="post_category_slug" rules="required|min:3|max:20" class="form-control input-custom" placeholder="Enter Slug">
                                        <span class='error'></span>
                                    </div>
                                </div>
                                <input type="hidden" name="btn-submit" value="submit">
                                <div class="form-group row mb-0">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">
                                            Add
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
                            <h4>List Post Categories</h4>
                            <p>Show up list post categories</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered list-post-categories">
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
                                        <tr class="post-category-<?php echo $category['post_category_id']; ?>">
                                            <th><?php echo $category['post_category_id']; ?></th>
                                            <td>
                                                <?php echo $category['post_category_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $category["post_category_slug"]; ?>
                                            </td>
                                            <td>
                                                <span>
                                                    <a href="?mod=post_categories&action=editPostCategory&id=<?php echo $category['post_category_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil fs color-muted m-r-5 ">

                                                        </i>
                                                    </a>

                                                    <a href="#" data-toggle="tooltip" class="delete" data-placement="top" data-id="<?php echo $category['post_category_id']; ?>">
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
    Validator(".insert_post_category_form", {
        onSubmit: function(data) {
            const formData = new FormData();
            formData.append("post_category_name", data['post_category_name']);
            formData.append("post_category_slug", data['post_category_slug']);
            formData.append("btn-submit", "submit");

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                var response = JSON.parse(this.responseText);

                var tbodyElement = document.querySelector(".list-post-categories tbody");
                var trElement = document.createElement("tr");
                trElement.classList.add(`post-category-${response['post_category_id']}`)
                trElement.innerHTML = `
                                        <th>${response['post_category_id']}</th>
                                        <td>
                                            ${response['post_category_name']}
                                        </td>
                                        <td>
                                            ${response['post_category_slug']}
                                        </td>
                                        <td>
                                            <span>
                                                <a href="?mod=post_categories&action=editPostCategory&id=${response['post_category_id']}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="fa fa-pencil fs color-muted m-r-5 "></i>
                                                </a>

                                                <a href="#" data-toggle="tooltip" class="delete" data-placement="top" data-id="${response['post_category_id']}">
                                                    <i class="fa fa-close fs color-danger"></i>
                                                </a>
                                            </span>
                                        </td>`;
                tbodyElement.appendChild(trElement);

                //clear text after insert to database:
                var inputs = document.querySelectorAll(".insert_post_category_form input");
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].value = "";
                }
            }

            xmlhttp.open("POST", "?mod=post_categories&action=addPostCategory");
            xmlhttp.send(formData);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on("click", "a.delete", function() {
            var check = confirm("Do you want to delete this category!");
            if (check) {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "?mod=post_categories&action=deletePostCategory",
                    method: "post",
                    data: {
                        post_category_id: id,
                        btn_submit: "submit",
                    },
                    success: function(data) {
                        if (JSON.parse(data) === "success") {
                            var tr = $(".post-category-" + id);
                            tr.remove();
                        }
                    }
                });
            }
        })
    });
</script>