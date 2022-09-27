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
                            <p>Change your password here !</p>
                        </div>
                        <div class="form-validation">
                            <form class="form-valide" action="?mod=users&action=changePassword" method="post" novalidate="novalidate" >
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="old_password">Old Password :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control input-custom" id="val-username" name="old_password" value="<?php echo set_value("old_password") ?>" placeholder="Enter your old password...">
                                        <?php echo form_error('old_password'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="new_password">New Password :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control input-custom" id="val-username" name="new_password" value="<?php echo set_value("new_password") ?>" placeholder="Enter new password...">
                                        <?php echo form_error('new_password'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="confirm_password">Confirm Password :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control input-custom" id="val-email"  name="confirm_password" value="<?php echo set_value("confirm_password") ?>"placeholder="Confirm new password...">
                                        <?php echo form_error('confirm_password'); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="update" name="update" class="btn btn-primary">Change</button>

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
