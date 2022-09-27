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
                        <div class="form-validation">
                            <form class="form-valide" action="?mod=users&action=add" method="post" novalidate="novalidate">
                                <div class="form-group row ">
                                    <label class="col-lg-3 col-form-label" for="username">Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" id="val-username" value="<?php echo set_value("username"); ?>" name="username" placeholder="Enter a username..">
                                    </div>
                                    <?php echo form_error('username'); ?>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control input-custom" id="val-email" value="<?php echo set_value("email"); ?>" name="email" placeholder="Your valid email..">
                                    </div>
                                    <?php echo form_error('email'); ?>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="password">Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control input-custom" id="val-password" value="<?php echo set_value("password"); ?>" name="password" placeholder="Choose a safe one..">
                                    </div>
                                    <?php echo form_error('password'); ?>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control input-custom" id="val-confirm-password" name="confirm_password" placeholder="..and confirm it!">
                                    </div>
                                    <?php echo form_error('confirm_password'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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