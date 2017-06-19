<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?php echo $page_title; ?>
                </h2>         
            </div>
            <div class="body">
              <form method="POST" class="form_vertical" action = "<?php echo base_url(); ?>Admin/upload_passport" enctype="multipart/form-data">
                <div class="row clearfix">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label class="header">Select a passport to upload</label>
                    <div class="form-group">
                      <div class="form-line">
                        <div class="image">
                          <img src="<?php echo $passport; ?>" width="58" height="58"/>
                        </div>
                        <input type="file" name="passport" value="">
                        <input type="hidden" name="studid" value="<?php echo $studid; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Upload</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>