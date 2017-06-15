<div class="adjustbread">
<section class="content-header">
   <ol class="breadcrumb">
     <li><a href="<?php echo base_url(); ?>Admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
     <li class="active">Add Students</li>
   </ol>
</section>
</div>
<section class="content">
      <div class="row">
      	 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $add_students; ?></h3>
            </div>
            <!-- /.box-header -->
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
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Students/add_student_record">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Matric No.</label>

                  <div class="col-sm-9">
                    <input  type="text" class="form-control" id="inputEmail3" name="matric" placeholder="Enter Matric No">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Students Name</label>

                  <div class="col-sm-9">
                    <input  type="text" class="form-control" id="inputEmail3" name="stdname" placeholder="Enter students name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Session:</label>
                  <div class="col-sm-9">
                  <select class="form-control" name="sid" style="width: 80%;">
                    <option>Select Session</option>
                    <?php echo $sessions; ?>
                  </select>
                  </div>
                </div>                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Program: </label>
                  <div class="col-sm-9">
                  <select class="form-control" name="pid" style="width: 80%;">
                    <option>Select Program</option>
                    <?php echo $programs; ?>
                  </select>
                  </div>
                </div>                
              
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </div>
            </form>   
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
          <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Batch Upload.</h3>
                <span> Upload students details from excel file</span>
              </div>
              <?php if (isset($_SESSION['failed'])) {?>
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> <?php  echo $_SESSION['failed'];?>
                    </div>
                <?php } ?>

                <?php if (isset($_SESSION['message'])) {?>
                    <div class="alert alert-success">
                        <?php  echo $_SESSION['message'];?>
                    </div>
                <?php } ?>

                <?php if (validation_errors() !="") {?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Students/batch_upload" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Add file</label>

                    <div class="col-sm-9">
                      <input  type="file" name="stdfile">
                      <label>File format: excel file (.csv)</label>
                    </div>
                  </div>
                  <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right" name="upload">Upload</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
</section>

  
