<script src="<?php echo base_url();?>assets/libs/litepicker/dist/litepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/upload/dropzone.min.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/upload/dropzone.min.js"></script>
<style>
.dropzone {
  margin-top: 10px;
  border: 2px dashed #0087F7;
}
</style>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Tipe Surat
                </div>
                <h2 class="page-title">
                  Tambah Tipe Surat
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
                    <label class="form-label col-3 col-form-label">Tipe Surat</label>
                    <div class="col">
                      <input type="text" name="tipe_surat" class="form-control" value="" placeholder="Tipe Surat" required>
                    </div>
                  </div>
				  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Deskripsi</label>
                    <div class="col">
					  <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Deskripsi"></textarea>
                    </div>
                  </div>                          
                      </div>
                    </div>
                  </div>                 
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                  <a href="<?php echo base_url();?>ketatausahaan/tipesurat" class="btn btn-link">Cancel</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary ms-auto" style="float:right;"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Simpan</button>
                </div>
              </div>
			  
                </form>
               
              </div>
            </div>
          </div>
        </div>
</div>