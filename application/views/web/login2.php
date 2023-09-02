<?php
$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>
<style>
.login-container .page-container .login-form {
	width:400px !important
}
.login-header-title {
	
}
.login-header-title .first-title{
	font-weight:bold;
	font-size:200%;
	color:#42a5f5 !important;
	font-family: Helvetica, Arial, sans-serif;
	line-height:34px;
}
.login-header-title .second-title {
	font-weight:bold;
	font-family: Helvetica, Arial, sans-serif;
	text-transform:uppercase;
}
.login-header-title .third-title {
	font-family: Helvetica, Arial, sans-serif;
	text-transform:uppercase;
	
}
</style>
<form action="" method="post">
	<div class="panel panel-body login-form">
		<div class="text-left row">
			
			<div class="col-md-2 text-center">
				<div class="">
				
				<img src="<?php echo base_url('assets/images/logo/'.$bgx[2]);?>" alt="<?php echo $configx[0];?>" width="80px">
				
				</div>
			</div>
			<div class="col-md-10">
				<div class="login-header-title">
					<div class="first-title"><?php echo $configx[0];?></div>
					<div class="second-title">Sistem Informasi Administrasi Ketatausahaan</div>
					<div class="third-title">Badan Pendidikan dan Pelatihan Kejaksaan RI</div>
				</div>
			</div>
			
			<?php
			echo $this->session->flashdata('msg');
			?>
		</div>

		<div class="form-group has-feedback has-feedback-left">
			<input type="text" class="form-control" name="nip" placeholder="nip" required>
			<div class="form-control-feedback">
				<i class="icon-user text-muted"></i>
			</div>
		</div>

		<div class="form-group has-feedback has-feedback-left">
			<input type="password" class="form-control" name="password" placeholder="Password" required>
			<div class="form-control-feedback">
				<i class="icon-lock2 text-muted"></i>
			</div>
		</div>

		<div class="col-md-12">
			

			<div class="col-md-12">
				<div class="form-group">
					<button type="submit" name="btnlogin" class="btn btn-primary btn-block btnlogin">Login <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>

		<div class="text-center">
			
		</div>
	</div>
</form>
					
				
