<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Profile
                </h2>
              </div>
            </div>
          </div>
          <div class="row row-cards">
		  <div class="col-lg-4">
              <div class="card">
                <div class="card card-sm">
                <img src="<?php echo base_url();?>foto/default.png" alt="<?php echo $profile->nama_lengkap; ?>" class="img-circle" width="176">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    
                    <div>
                      <div><?php echo $profile->nama_lengkap; ?></div>
                      <div class="text-muted">1 week and 3 days ago</div>
                    </div>                    
                  </div>
                </div>
              </div>
                <div class="card-footer">
                  
                </div>
				
				
			<div class="col-md-12">
				<div class="card-body">
                <?php
              echo $this->session->flashdata('msg2');
              ?>
              <form class="form-horizontal" action="" method="post">
                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Katasandi</label>
                    <div class="col">
                      <input type="password" name="password" class="form-control" value="" placeholder="Katasandi" required>
                    </div>
                  </div>
                  <div class="form-group mb-3 row">
                    <label class="form-label col-3 col-form-label">Ulangi Katasandi</label>
                    <div class="col">
                      <input type="password" name="password2" class="form-control" value="" placeholder="Ulangi Katasandi" required>
                    </div>
                  </div>                
                  <div class="form-footer">
                    <button type="submit" name="btnupdate2" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
			</div>
			<div class="card-footer">
                  
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card card-lg">
			  <div class="card-header">
                  <h3 class="card-title">Ubah Profil</h3>
                </div>
                <div class="card-body">
                  
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post">
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">NIP</label>
                  <div class="col">
                    <input type="text" name="nip" class="form-control" value="<?php echo $profile->nip; ?>" placeholder="" readonly>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Nama Lengkap</label>
                  <div class="col">
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $profile->nama_lengkap; ?>" placeholder="" maxlength="100" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Email</label>
                  <div class="col">
                    <input type="email" name="email" class="form-control" value="<?php echo $profile->email; ?>" placeholder="" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Jenis Kelamin</label>
                  <div class="col">
                    <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo $profile->jenis_kelamin; ?>" placeholder="" readonly>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Agama</label>
                  <div class="col">
                    <input type="text" name="agama" class="form-control" value="<?php echo $profile->agama; ?>" placeholder="" readonly>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Tempat Lahir</label>
                  <div class="col">
                    <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $profile->tempat_lahir; ?>" placeholder="" readonly>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Tanggal Lahir</label>
                  <div class="col">
                    <input type="text" name="tanggal_lahir" class="form-control" value="<?php echo $profile->tanggal_lahir; ?>" placeholder="" readonly>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Pendidikan Terakhir</label>
                  <div class="col">
                    <input type="text" name="pendidikan_terakhir" class="form-control" value="<?php echo $profile->pendidikan_terakhir; ?>" placeholder="" readonly>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Alumni Universitas</label>
                  <div class="col">
                    <input type="text" name="alumni_universitas" class="form-control" value="<?php echo $profile->alumni_universitas; ?>" placeholder="" readonly>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Nomor Handphone</label>
                  <div class="col">
                    <input type="text" name="hp" class="form-control" value="<?php echo $profile->no_handphone; ?>" placeholder="" required>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Hobi</label>
                  <div class="col">
                    <input type="text" name="hobi" class="form-control" value="<?php echo $profile->hobby; ?>" placeholder="" required>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Riwayat Penyakit</label>
                  <div class="col">
                    <input type="text" name="riwayat_penyakit" class="form-control" value="<?php echo $profile->riwayat_penyakit; ?>" placeholder="" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Alamat Kantor</label>
                  <div class="col">
                    <textarea name="alamat_kantor" rows="3" cols="80" class="form-control" placeholder="" required><?php echo $profile->kantor_alamat; ?></textarea>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">No. Telp. Kantor</label>
                  <div class="col">
                    <input type="text" name="telp_kantor" class="form-control" value="<?php echo $profile->kantor_no_telepon; ?>" placeholder="" required>
                  </div>
                </div>
                <div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">Alamat Rumah</label>
                  <div class="col">
                    <textarea name="alamat_rumah" rows="3" cols="80" class="form-control" placeholder="" required><?php echo $profile->rumah_alamat; ?></textarea>
                  </div>
                </div>
				<div class="form-group mb-3 row">
                  <label class="form-label col-3 col-form-label">No. Telp. Kantor</label>
                  <div class="col">
                    <input type="text" name="telp_rumah" class="form-control" value="<?php echo $profile->rumah_no_telepon; ?>" placeholder="">
                  </div>
                </div>
				<div class="form-footer">
                    <button type="submit" name="btnupdate2" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
      
</div>