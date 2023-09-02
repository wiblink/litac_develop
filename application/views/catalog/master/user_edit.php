<script>
                    $(document).ready(function () {
                        $(".cari_gol").select2({
                            placeholder: "Pilih Golongan"
                        });
                    });
					
					$(document).ready(function () {
                        $(".cari_jabatan").select2({
                            placeholder: "Pilih Jabatan"
                        });
                    });
					
					$(document).ready(function () {
                        $(".cari_kewenangan").select2({
                            placeholder: "Pilih Kewenangan"
                        });
                    });
</script>
				<script src="<?php echo base_url();?>assets/libs/litepicker/dist/litepicker.js"></script>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
<div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  User
                </div>
                <h2 class="page-title">
                  Edit User
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
          <div class="row row-cards">
            <div class="col-lg-8">
              <div class="card card-lg">
			  
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
                  <label class="form-label col-3 col-form-label">NIP</label>
                  <div class="col">
                    <input type="text" name="nip" class="form-control" placeholder="" value="<?php echo $query->nip; ?>">
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Username</label>
                  <div class="col">
                    <input type="text" name="username" class="form-control" placeholder="" maxlength="100" value="<?php echo $query->username; ?>" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Nama Lengkap</label>
                  <div class="col">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="" maxlength="100" value="<?php echo $query->nama_lengkap; ?>" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Email</label>
                  <div class="col">
                    <input type="email" name="email" class="form-control" placeholder="" value="<?php echo $query->email; ?>" required>
                  </div>
                </div>               	
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Jenis Kelamin</label>
                  <div class="col">
						<select type="text" class="form-select" id="jenis_kelamin" name="jenis_kelamin">
						    <option value="">Pilih Jenis Kelamin</option>
							<option value="L" <?php if("L" == $query->jenis_kelamin){echo "selected";} ?>>Laki laki</option>
							<option value="P" <?php if("P" == $query->jenis_kelamin){echo "selected";} ?>>Perempuan</option>
						</select>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Agama</label>
                  <div class="col">
						<select type="text" class="form-select" id="agama" name="agama">
						    <option value="">Pilih Agama</option>
							<option value="Islam" <?php if("Islam" == $query->agama){echo "selected";} ?>>Islam</option>
							<option value="Katolik" <?php if("Katolik" == $query->agama){echo "selected";} ?>>Katolik</option>
							<option value="Protestan" <?php if("Protestan" == $query->agama){echo "selected";} ?>>Protestan</option>
							<option value="Budha" <?php if("Budha" == $query->agama){echo "selected";} ?>>Budha</option>
							<option value="Hindu" <?php if("Hindu" == $query->agama){echo "selected";} ?>>Hindu</option>
						</select>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Tempat Lahir</label>
                  <div class="col">
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="" value="<?php echo $query->tempat_lahir; ?>">
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Tanggal Lahir</label>
                  <div class="col">
							<div class="input-icon">
									<?php $tanggal_lahir = date("d-m-Y",strtotime($query->tanggal_lahir)); ?>
									<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
									</span>
									<input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
							</div>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Golongan</label>
                  <div class="col">
                    <select class="form-control cari_gol" name="golongan_id" id="golongan_id" required>
                              <option value=""></option>
                              <?php
									if(!empty($golongan)) {
                                    foreach ($golongan as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>" <?php if($baris->id == $query->golongan_id){echo "selected";} ?>><?php echo $baris->golongan; ?></option>
									<?php endforeach; } ?>
                    </select>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Jabatan</label>
                  <div class="col">
                   	<select class="form-control cari_jabatan" name="id_jabatan_organisasi" id="id_jabatan_organisasi" required>
                              <option value=""></option>
                              <?php
									if(!empty($jabatan_organisasi)) {
                                    foreach ($jabatan_organisasi as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>" <?php if($baris->id == $query->id_jabatan_organisasi){echo "selected";} ?>><?php echo $baris->jabatan; ?></option>
									<?php endforeach; } ?>
                    </select>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Kewenangan</label>
                  <div class="col">
					<select class="form-control cari_kewenangan" name="kewenangan_id" id="kewenangan_id" required>
                              <option value=""></option>
                              <?php
									if(!empty($ref_kewenangan)) {
                                    foreach ($ref_kewenangan as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>" <?php if($baris->id == $query->kewenangan_id){echo "selected";} ?>><?php echo $baris->kewenangan; ?></option>
									<?php endforeach; } ?>
                    </select>
					
                  </div>
                </div>
						</div>
					  </div>
				    </div>
			     </div>
		       </div>
				<div class="card-footer text-end">
					<div class="d-flex">
					  <a href="<?php echo base_url();?>ketatausahaan/user" class="btn btn-link">Cancel</a>
					  <button type="submit" name="btnupdate" id="submit-all" class="btn btn-primary ms-auto" style="float:right;"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Kirim</button>
					</div>
                </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </form>
</div>
<script>
    // @formatter:off
	
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('tanggal_lahir'),
    		buttonText: {
    			previousMonth: '<svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
    			nextMonth: '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
    		},
    	}));
    });
    // @formatter:on
  </script>