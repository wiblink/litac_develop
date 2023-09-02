<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Jenis Surat
                </div>
                <h2 class="page-title">
                  Edit Jenis Surat
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
                <div class="msg"></div>
				<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">            
			      <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Jenis Surat</label>
                    <div class="col">
                      <input type="text" name="jenis_surat" class="form-control" value="<?php echo $query->jenis_surat; ?>" placeholder="Jenis Surat" required>
                    </div>
                  </div>
				  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Deskripsi</label>
                    <div class="col">
					  <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Deskripsi"><?php echo $query->deskripsi; ?></textarea>
                    </div>
                  </div>                          
                      </div>
                    </div>
                  </div>                 
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                  <a href="<?php echo base_url();?>ketatausahaan/jenissurat" class="btn btn-link">Cancel</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Simpan</button>
                </div>
              </div>
			  
                </form>
               
              </div>
            </div>
          </div>
        </div>
</div>