<section class="content">
      <div class="row">
      	 <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $add_session; ?></h3>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Admin/add_session">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Session Name</label>

                  <div class="col-sm-9">
                    <input  type="text" class="form-control" name="session" placeholder="Add Session" style="width: 100%;">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $add_session; ?></button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      <!-- /.row -->
</section> 
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $view_session; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Serial No</th>
                  <th>Session Name</th>
                  <th>Edit</th>
                </tr>
                </thead>
                
                <tfoot>
                <tr>
                  <th>Serial No</th>
                  <th>Session Name</th>
                  <th>Edit</th>
                </tr>
                </tfoot>
                <tbody>
                 <?php
                 if ($session_table !== "" )
                 {
                      echo $session_table;
                 }
                 else{
                 	 ?>
                     <tr>
                          <td colspan="3"><center><h4>No Session to display</h4></center></td>
                     </tr>
               	 <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
         </div>
      <!-- /.row -->
  </section> 
