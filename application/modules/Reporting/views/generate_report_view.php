<section class="content">
	<div class="row">
		<div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Select Subject and semester to be generated.</h3>
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
            <form target="_blank" [....] class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Reporting/subjects_report">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Semester: </label>
                  <div class="col-sm-9">
                  <select class="form-control" name="semid" style="width: 100%;">
                    <option value="">Select Semester</option>
                    <?php echo $semesters; ?>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Subject: </label>
                  <div class="col-sm-9">
                  <select class="form-control" name="subid" style="width: 100%;">
                    <option value="">Select Subject</option>
                    <?php echo $subjects; ?>
                  </select>
                  </div>
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Generate Report</button>
                </div>
              </div>
            </form>
          </div>
        </div>
   <div class="col-md-6"> 
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Select Program and semester to be generated.</h3>
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
            <form target="_blank" [....] class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Reporting/programs_report">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Semester: </label>
                  <div class="col-sm-9">
                  <select class="form-control" name="semid" style="width: 100%;">
                    <option value="">Select Semester</option>
                    <?php echo $semesters; ?>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Program: </label>
                  <div class="col-sm-9">
                  <select class="form-control" name="progid" style="width: 100%;">
                    <option value="">Select Program</option>
                    <?php echo $programs; ?>
                  </select>
                  </div>
                </div>
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Generate Report</button>
                </div>
              </div>
            </form>
          </div>
        </div> 
  </div>
</section>