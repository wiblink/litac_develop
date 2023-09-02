<?php
$bgx = explode("#", bgx());
?>

<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Pengaturan
                </div>
                <h2 class="page-title">
                  Background & Icons
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
              <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
				
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Background</label>
                  <div class="col">
					<img class="img-thumbnail" src="<?php echo base_url('assets/images/backgrounds/'.$bgx[0]);?>">
                  </div>
				  <div class="col">
					 (Tipe File: .jpg, .jpeg, .png, .gif)
					<input type="file" name="bgd">
					<input type="hidden" name="bgd_now" value="<?php echo $bgx[0];?>">
				  </div>
                </div>
				
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Favicon</label>
                  <div class="col">
					<img class="img-thumbnail" src="<?php echo base_url('assets/images/favicon/'.$bgx[1]);?>" style="height:50px !important;">
                  </div>
				  <div class="col">
					 (Tipe File: .png)<br />
					 (max: 200x200 pixel)
					<input type="file" name="fav">
					<input type="hidden" name="fav_now" value="<?php echo $bgx[1];?>">
				  </div>
                </div>
				
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Logo</label>
                  <div class="col">
					<img class="img-thumbnail" src="<?php echo base_url('assets/images/logo/'.$bgx[2]);?>">
                  </div>
				  <div class="col">
					 (Tipe File: .jpg, .jpeg, .png, .gif)<br />
					 (max: 600x600 pixel)
					<input type="file" name="logo">
					<input type="hidden" name="logo_now" value="<?php echo $bgx[2];?>">
				  </div>
                </div>
						</div>
                    </div>
                  </div>                 
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                  
                  <button type="submit" name="btnupdate" id="btnupdate" class="btn btn-primary ms-auto" style="float:right;">Simpan</button>
                </div>
              </div>
          </form>
          </div>
            </div>
          </div>
        </div>
</div>