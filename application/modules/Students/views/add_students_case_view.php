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
                    <?php  echo $_SESSION['failed'];?>
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
                  <form method="POST" class="form_vertical" action = "<?php echo base_url(); ?>Admin/add_case_todb" enctype="multipart/form-data">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <div class="form-group">
                            <div class="form-line">
                              <input type="hidden" name="studid" value="<?php echo $studid; ?>">
                              <input type="text" class="form-control" name="sdc_no" placeholder="Enter SDC No">
                              <input type="hidden" name="sem_id" value="<?php echo $semid; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" name="infraction" placeholder="Enter Students Infraction">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <b>Student Passport</b>
                          <div class="image">
                            <img src="<?php echo $passport; ?>" width="58" height="58"/>
                          </div>
                          <!--<input type="file" name="passport">-->
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header">
                                <h2>
                                    Infraction Details
                                </h2>
                            </div>
                            <div class="body">
                              <div class="row clearfix">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <div class="form-line">
                                      <textarea rows="8" class="form-control no-resize" name="infra_detail" placeholder="Enter Infraction details here..."></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" name="panel_rec" placeholder="Panel Recommendation">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                          <div class="body">
                            <div class="row clearfix">
                              <div class="col-sm-8">
                                <div class="form-group">
                                  <div class="form-line">
                                    <textarea rows="4" class="form-control no-resize" name="panel_rec_det" placeholder="Enter panel recommendation details..."></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <b>Date</b>
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="material-icons">date_range</i>
                            </span>
                            <div class="form-line">
                              <input type="text" class="form-control date" name="date" placeholder="Example: 2016-07-30">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                          <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>