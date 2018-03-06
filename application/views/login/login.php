<?php 
if(!isset($_SESSION)){
session_start();
}?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><?php echo $title?></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/metro.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style_responsive.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/uniform/css/uniform.default.css" />
<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo" style="color:#FFF; font-weight:bold; "><h3>Login</h3> <!--<img src="<?php //echo base_url();?>assets/img/logo-big.png" alt="" />--> </div>
<!-- END LOGO --> 
<!-- BEGIN LOGIN -->
<div class="content"> 
  <!-- BEGIN LOGIN FORM --> 
  <?php echo form_open('login', array('id'=>'form_login', 'autocomplete'=>'off', 'class' => 'form-vertical login-form')); ?>
  <h3 class="form-title">Login to your account</h3>
  <div class="alert alert-error hide">
    <button class="close" data-dismiss="alert"></button>
    <span>Enter any username and password.</span> </div>
  <?php if(validation_errors()){
?>
  <div class="alert alert-error">
    <button class="close" data-dismiss="alert"></button>
    <span><?php echo validation_errors();?></span> </div>
  <?php }?>
  <div class="control-group"> 
  
  <div class="control-group"> 
  <?php if($this->input->cookie('EMS_Username')){ $username = $this->input->cookie('EMS_Username');} else { $username= ''; } ?>
  <?php if($this->input->cookie('EMS_pass')){ $pass = $this->input->cookie('EMS_pass');} else { $pass= ''; } ?>
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">Username</label>
    <div class="controls">
      <div class="input-icon left"> <i class="icon-user"></i> <?php echo form_input(array(
		'name'=>'username', 
		'value'=>$username,
		'class'=>'m-wrap placeholder-no-fix',
		'placeholder' => 'Username'
		)); ?> </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label visible-ie8 visible-ie9">Password</label>
    <div class="controls">
      <div class="input-icon left"> <i class="icon-lock"></i> <?php echo form_password(array(
		'name'=>'password', 
		'value'=>$pass,
		'class'=>'m-wrap placeholder-no-fix',
		'placeholder' => 'Password'
		)); ?> </div>
    </div>
  </div>
  <div class="form-actions">
    <label class="checkbox">
      <input type="checkbox" name="remember" />
      Remember me </label>
    <button type="submit" class="btn green pull-right"> Login <i class="m-icon-swapright m-icon-white"></i> </button>
  </div>
 
  <?php echo form_close(); ?> 
  <!-- END LOGIN FORM --> 
  <!-- BEGIN FORGOT PASSWORD FORM -->
  
  <!-- END REGISTRATION FORM --> 
</div>
<!-- END LOGIN --> 
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> 2018 &copy; Infoseek Software System. Admin Dashboard. </div>
<!-- END COPYRIGHT --> 
<!-- BEGIN JAVASCRIPTS --> 
<script src="<?php echo base_url();?>assets/js/jquery-1.8.3.min.js"></script> 
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/uniform/jquery.uniform.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.blockui.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/app.js"></script> 
<script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script> 
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
