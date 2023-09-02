<?php
$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
      <div class="container-tight py-6">
		<div class="text-center">
			<div class="text-slate-300 logo-login"><img src="<?php echo base_url('assets/images/logo/'.$bgx[2]);?>" alt="<?php echo $configx[0];?>" width="170"></div>
			<h5 class="content-group"><!--<?php echo $configx[0];?>--></h5>
			<?php
			echo $this->session->flashdata('msg');
			?>
		</div>
		<form class="card card-md" action="" method="post">
          <div class="card-body">
            <!--<h2 class="card-title text-center mb-4">Login to your account</h2>-->
            <div class="mb-3">
              <label class="form-label">NIP</label>
              <input type="text" class="form-control" name="nip" placeholder="nip" required>
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
              </label>
              <div class="input-group input-group-flat">
				<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
              </div>
            </div>
            <div class="form-footer">
			  <button type="submit" name="btnlogin" class="btn btn-primary w-100">Sign in <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
   
