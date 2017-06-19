<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?php echo $page_title; ?>
                </h2>         
            </div>
            <div class="body">
                  <form method="POST" class="form_vertical" action = "<?php echo base_url(); ?>Login/change_password">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <b>SDC Number</b>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" name="sdc_no" value="<?php echo $sdc_no; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                          <b>Infraction</b>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" name="infraction" value="<?php echo $infraction; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="header">
                                <h2>
                                    Infraction Details
                                </h2>
                            </label>
                            <div class="body">
                              <textarea id="ckeditor" name="infra_detail">
                                <?php echo $infra_detail; ?>    
                              </textarea>
                            </div>
                        </div>
                         <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                          <div class="image">
                            <img src="<?php echo base_url(); ?>assets/dist/images/user.jpg" width="58" height="58" alt="User" />
                          </div>
                          <input type="file" name="passport">
                        </div>-->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <b>Panel Recommendation</b>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" name="panel_rec" value="<?php echo $panel_rec; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                          <div class="body">
                            <div class="row clearfix">
                              <div class="col-sm-8">
                                <b>Panel Recommendation Details</b>
                                <div class="form-group">
                                  <div class="form-line">
                                    <textarea rows="4" class="form-control no-resize" name="panel_rec_det"><?php echo $panel_rec_det; ?></textarea>
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
                              <input type="text" class="form-control date" name="date" value="<?php echo $date; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                          <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>