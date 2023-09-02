<?php
$configx = explode("#", configx());
?>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Pengaturan Web
                </div>
                <h2 class="page-title">
                  <!--Pengaturan Themes & Title-->
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    
                  </span>
                  
                
                </div>
              </div>
            </div>
          </div>
		  <div class="row row-deck row-cards">
           <div class="col-12">
              <div class="card">
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post">
			  
			  <div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			  
			  	<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Nama Aplikasi</label>
                  <div class="col">
					<textarea name="app_name" rows="3" cols="80" class="form-control" placeholder="Nama Aplikasi" required><?php echo $configx[0]; ?></textarea>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Title</label>
                  <div class="col">
					<textarea name="title_text" rows="3" cols="80" class="form-control" placeholder="Title Aplikasi" required><?php echo $configx[1]; ?></textarea>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Header Text</label>
                  <div class="col">
                    <input type="text" name="header_text" class="form-control" value="<?php echo $configx[2] ?>" placeholder="Header Text" maxlength="100" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Footer Text</label>
                  <div class="col">
                    <input type="text" name="footer_text" class="form-control" value="<?php echo $configx[3]; ?>" placeholder="Footer Text" maxlength="100" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Email</label>
                  <div class="col">
                    <input type="email" name="email" class="form-control" value="<?php echo $configx[4]; ?>" placeholder="Email" required>
                  </div>
                </div>		
			</div>
                    </div>
                  </div>                 
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                  
                  <button type="submit" name="btnupdate" id="btnupdate" class="btn btn-primary ms-auto" style="float:right;">Kirim</button>
                </div>
              </div>
			  
          </form>
          </div>
            </div>
          </div>
        </div>
</div>