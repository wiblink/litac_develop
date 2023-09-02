<?php
$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>
  <body>

<?php //die(print_r(base_url())); ?>

  <div id="app">
    <section class="section">
      <div class="container mt-3">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <div class="icon-object border-slate-300 text-slate-300"><!--<img src="<?php echo base_url('assetsprimary/images/logo/'.$bgx[2]);?>" alt="<?php echo $configx[0];?>" width="150">--></div>
              <h5 class="content-group" style="color:white"><?php // echo $configx[0];?></h5>
            </div>

            <div class="card card-success">

              <div class="card-body">
			  <h4 class="text-center">Login</h4>
				<?php echo $this->session->flashdata('msg');?>
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="nip" placeholder="nip" tabindex="1" required>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>


                  <div class="form-group">
                    <button type="submit" name="btnlogin" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>

                  <div class="mt-5 text-muted text-center">
                    
                  </div>
                </form>
                
                

              </div>
            </div>
 
            <div class="simple-footer">
              <class="content-group" style="color:white">  Copyright &copy; <?php echo date('Y');?> Litac Light Consulting,<br>All Rights Reserved.
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="<?php echo base_url();?>assetsprimary/modules/jquery-3.4.1.min.js"></script>
  <script src="<?php echo base_url();?>assetsprimary/modules/popper.js"></script>
  <script src="<?php echo base_url();?>assetsprimary/modules/tooltip.js"></script>
  <script src="<?php echo base_url();?>assetsprimary/modules/bootstrap/js/bootstrap.min.js"></script>
</body>