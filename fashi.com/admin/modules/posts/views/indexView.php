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
                            <h4>List Post</h4>
                            <p>Show and Update post info at here!</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Post Cover</th>
                                        <th>Post Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($posts as $post) : ?>
                                        <tr class="post-<?php echo $post['post_id']; ?>">
                                            <td><?php echo $post['post_id']; ?></td>
                                            <td><img class="product-image" src="public/uploads/images/post/<?php echo $post['post_img_cover']; ?>" alt=""></td>
                                            <td><?php echo $post['post_title']; ?></td>
                                            <td>
                                                 <?php if ($post['post_status'] == 1) : ?>
                                                    <span class="label label-success">Public</span>
                                                <?php else : ?>
                                                    <span class="label label-danger">Private</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo $post['created_at']; ?></td>
                                            <td>
                                                <span>
                                                    <a href="?mod=posts&action=editPost&id=<?php echo $post['post_id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil fs color-muted m-r-5 "></i>
                                                    </a>

                                                    <a href="?mod=posts&action=deletePost&id=<?php echo $post['post_id']; ?>" 
                                                    data-toggle="tooltip" class="delete" data-placement="top" data-id="<?php echo $post['post_id']; ?>" >
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
    // $(document).ready(function() {
    //     $(".delete").click(function(){
    //         var id = $(this).data("id");
            
    //         $.ajax({
    //             url : "?mod=products&action=deleteProduct",
    //             method: 'post',
    //             data : {
    //                 product_id : id
    //             },
    //             success : function(data){
    //                 $(".product-"+id).remove();
    //             }
    //         });
    //     })
    // })
</script>