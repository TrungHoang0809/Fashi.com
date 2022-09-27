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
                            <h4>List Pages</h4>
                            <p>Show list pages!</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Page Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pages as $page) : ?>
                                        <tr class="page-<?php echo $page['id']; ?>">
                                            <td><?php echo $page['id']; ?></td>
                                            <td><?php echo $page['page_title']; ?></td>
                                            
                                            <?php if ($page['page_status'] == 0) : ?>
                                                <td>
                                                    <span class="label label-danger">Private</span>
                                                </td>
                                            <?php else : ?>
                                                <td>
                                                    <span class="label label-success">Public</span>
                                                </td>
                                            <?php endif; ?>
                                            <td><?php echo $page['created_at']; ?></td>
                                            <td>
                                                <span>
                                                    <a href="?mod=pages&action=edit&id=<?php echo $page['id']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil fs color-muted m-r-5 "></i>
                                                    </a>

                                                    <a href="#" data-toggle="tooltip" class="delete" data-placement="top" data-id="<?php echo $page['id']; ?>">
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
        $(".delete").click(function() {
            var id = $(this).data("id");

            $.ajax({
                url: "?mod=pages&action=delete",
                method: 'post',
                data: {
                    page_id: id,
                    btn_submit : "submit",
                },
                success: function(data) {
                    $(".page-" + id).remove();
                }
            });
        })
    })
</script>