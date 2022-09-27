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
                        <div class="cart-title">
                            <h4>Personal Info</h4>
                            <p>Update your photo and personal detail here!</p>
                        </div>
                        <div class="form-validation">
                            <form class="form-valide" action="?mod=users&action=profile" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="username">Username :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" id="val-username" value="<?php echo $user['user_name']; ?>" name="username" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="username">Full Name :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" id="val-username" value="<?php echo $user['full_name']; ?>" name="fullname" placeholder="Enter a full name..">
                                    </div>
                                    <?php echo form_error('fullname'); ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="email">Email :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" id="val-email" value="<?php echo $user['email']; ?>" name="email" readonly>
                                    </div>
                                    <?php echo form_error('email'); ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="phone">Phone :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" value="<?php echo "0" . $user['phone_number']; ?>" name="phone">
                                    </div>
                                    <?php echo form_error('phone'); ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="address">Address :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" value="<?php echo $user['address']; ?>" name="address" placeholder="Your address ..">
                                    </div>
                                    <?php echo form_error('address'); ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="avatar">
                                        Avatar :
                                    </label>
                                    <div class="col-lg-6 flex">
                                        <!-- <img class="avatar img-responsive" src="public/uploads/images/user/<?php echo $user['avatar']; ?>" alt="">
                    
                                            <img class="avatar img-responsive" src="public/uploads/images/user/no_avatar.png" alt="">
                                        -->
                                        <div class="form-group">
                                            <input type="file" name="avatar" id="avatar" class="form-control-file">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="update" name="update" class="btn btn-primary">Update</button>

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