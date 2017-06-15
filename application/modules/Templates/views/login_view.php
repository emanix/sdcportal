<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>BU SDC Portal | Login</title>

  <!-- BUicon-->
  <link rel="icon" href="<?php echo base_url(); ?>assets/bu logo.ico" type="image/x-icon">

  <!-- Bootstrap Core Css -->
  <link href="<?php echo base_url(); ?>asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Animation Css -->
  <link href="<?php echo base_url(); ?>asset/plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  
  <!-- Custom Js -->
  <script src="<?php echo base_url(); ?>assets/js/prefixfree.min.js"></script>


</head>

<body>
	<div id="header-wrapper">
		<div id="logo">
			<img src="<?php echo base_url(); ?>assets/Babcock_logo.jpg" alt="Babcock Logo">
			<span><h3>STUDENTS DISCIPLINARY CASE PORTAL</h3></span>
		</div>
	</div>
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div class="headers">Users Login</div>
		</div>
    <div class="error-messages">
    <?php if (validation_errors() !="") {?>
    <div>
      <?php echo validation_errors('<p style="color: red" />'); ?>
    </div>
    <?php } ?>
    </div>
    <div class="error-message">
    <?php if (isset($_SESSION['message'])) {?>
    <div style="color: red; font-size: 17.5px; font-weight: 500;">
      <?php echo $_SESSION['message']; ?>
    </div>
    <?php } ?>
    </div>
		<br>
		<div class="login">
			<form id="sign_in" method="POST" action="<?php echo base_url(); ?>Login/sign_in" >  
        <input type="text" name="user" placeholder="Username"><br>
				<input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit">SIGN IN</button>
      </form>      
		</div>
</body>
</html>