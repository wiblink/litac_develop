<?php 
$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta
* @link https://tabler.io
* Copyright 2018-2021 The Tabler Authors
* Copyright 2018-2021 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <!-- CSS files -->
    <link href="<?php echo base_url();?>assets/css/tabler.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url();?>assets//css/demo.min.css" rel="stylesheet"/>
	<link rel="icon" href="<?php echo base_url('assets/images/favicon/'.$bgx[1]);?>" sizes="16x16" type="image/png">
	<base href="<?php echo base_url();?>"/>
	<title>Login<?php if($configx[1] !=''){echo ' | '.$configx[1];} ?></title>
	<style type="text/css">
		body{
			background-color:#f5f5f5;
		<?php if($bgx[0] != '') {?>
			background-image: url("<?php echo base_url();?>assets/images/backgrounds/<?php echo $bgx[0];?>");
			background-repeat: no-repeat;
			background-size:cover;
		<?php }?>
		}
				.login-container .page-container .content .login-form {
			max-width:500px;
			width:unset;
			margin-top:80px;
			border-radius:unset;
			border:1px solid #a0c9ea;
			padding: 4px;
			background: transparent;
		}
		.logo-login img {
			border: 6px solid #42a5f5;
			border-radius: 100px;
			left: 50%;
			transform: translate(-50%, 55%);
			position:absolute;
			top:0px;
		}
		.login-form .input-login {
			border:1px solid #bbddf8;
			padding: 22px 0px;
		}
		.login-form .input-login:focus {
			border:1px solid #1e88e5;
		}
		.panel-body.login-form .panel-border{
			padding:40px 80px 40px 80px;
		}
		.panel-body.login-form .btnlogin {
			background-color:#1e88e5  !important;
		}
		.form-control-feedback {
			height: 45px !important;
			line-height: 45px !important;
		}
		@media only screen and (max-width: 600px) {
		  .panel-body.login-form .panel-border{
				padding-left:40px;
				padding-right:40px;
			}
		}
		h5.content-group {
			margin-top:60px;
			font-weight:bold;
			font-size: 35px;
		}
		#effect7{
			position:relative;
			/*-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
			-moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
			box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;*/
			-webkit-box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 1px 5px 0px rgba(0,0,0,0.75);
			background-image: url("<?php echo base_url();?>assets/images/bg-login-panel.png");
			background-repeat: repeat;
			border-radius: 4px;
			-moz-border-radius:4px;
			-webkit-border-radius:4px;
		}
	</style>
  </head>