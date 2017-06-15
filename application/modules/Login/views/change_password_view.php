<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?php echo $page_title; ?>
                </h2>         
            </div>
            <?php if (isset($_SESSION['failed'])) {?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> <?php  echo $_SESSION['failed'];?>
                </div>
                <?php } ?>

                <?php if (isset($_SESSION['success'])) {?>
                <div class="alert alert-success">
                     <?php  echo $_SESSION['success'];?>
                </div>
                <?php } ?>

                <?php if (validation_errors() !="") {?>
                <div class="alert alert-danger">
                    <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
            <div class="body">
                <form method="POST" class="form_vertical" action = "<?php echo base_url(); ?>Login/change_password">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="old_pass" placeholder="Old Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="new_pass" placeholder="New Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="con_pass" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
