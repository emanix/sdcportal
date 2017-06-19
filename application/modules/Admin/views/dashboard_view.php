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
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="matric" name="matric" placeholder="Enter Matric No">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect" onclick="show_table()">Search</button>
                        </div>
                    </div>
            </div>
            <div id="student">

            </div>
            <div id="student_case">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function show_table(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "<?php echo base_url(); ?>Admin/create_student_table?matricno="+document.getElementById("matric").value, false);
        xmlhttp.send(null);
        document.getElementById("student").innerHTML=xmlhttp.responseText;
        document.getElementById("student_case").innerHTML= "";
    }

    function show_case(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "<?php echo base_url(); ?>Admin/create_student_case_table?stud_id="+document.getElementById("std").value, false);
        xmlhttp.send(null);
        document.getElementById("student_case").innerHTML=xmlhttp.responseText;
    }
</script>
