<script src="<?php echo base_url();?>assets/libs/litepicker/dist/litepicker.js"></script>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Surat Disposisi
                </div>
                <h2 class="page-title">
                  Detail Surat Disposisi
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
                <div class="card-header">
                  <h3 class="card-title">Status Disposisi</h3>
                </div>
                <fieldset class="content-group">
					<ul class="progress-tracker progress-tracker--text progress-tracker--left">
						  <li class="progress-step is-complete">
						  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" /><path d="M3 6l9 6l9 -6" /><path d="M15 18h6" /><path d="M18 15l3 3l-3 3" /></svg>
							<div class="progress-marker"></div>							
							<div class="progress-text">
							  <h6 class="progress-title">Surat Dikirim</h6>
							  <?php 
							  echo '<small class="surat-date"><em>'.date_indo_bk($query->tgl_dikirim).'</em></small>'; 
							  echo '<br /><small class="surat-date"><em><strong>'.$query->jabatan_organisasi_pengirim.'</strong><br />'.$query->nama_pengirim.'<br />NIP: '.$query->nip_pengirim.'</em></small>';
							  ?>
							</div>
						  </li>

						  <li class="progress-step<?php if($query->tgl_diterima !== NULL){echo ' is-complete';} ?>">
						  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /><path d="M12 11v-8h4l2 2l-2 2h-4" /><path d="M6 15h1" /></svg>
							<div class="progress-marker"></div>
							<div class="progress-text">
							  <h6 class="progress-title">Surat Diterima</h6>
							  <?php if($query->tgl_diterima != NULL){
								  echo '<small class="surat-date"><em>'.date_indo_bk($query->tgl_diterima).'</em></small>';
								  echo '<br /><small class="surat-date"><em><strong>'.$query->jabatan_organisasi_penerima.'</strong><br />'.$query->nama_penerima.'<br />NIP: '.$query->nip_penerima.'</em></small>';
								  } 
								  else {
									echo '<small>Surat belum diterima</small>';
									
								  }?>
							</div>
						  </li>
						  
						  <?php if($query->disposisi_pelaksana != NULL) {?>
						  
						  <li class="progress-step<?php if($query->disposisi_pelaksana !== NULL){echo ' is-complete';} ?>">
						  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg>
							<div class="progress-marker"></div>
							<div class="progress-text">
							  <h6 class="progress-title">Disposisi Dikirim</h6>
							  <?php 
							  echo '<small class="surat-date"><em>'.date_indo_bk($query->disposisi_dikirim).'</em></small>'; 
							  echo '<br /><small class="surat-date"><em><strong>'.$query->jabatan_organisasi_penerima.'</strong><br />'.$query->nama_penerima.'<br />NIP: '.$query->nip_penerima.'</em></small>';
							  if($query->disposisi_perintah != NULL) {
										echo '<br /><small><em>"'.$query->disposisi_perintah.'"</em></small>';
								}
							  ?>
							</div>
						  </li>
						  
						  <li class="progress-step<?php if($query->disposisi_diterima !== NULL){echo ' is-complete';} ?>">
						  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 4 4 8 12 12 20 8 12 4" /><polyline points="4 12 12 16 20 12" /><polyline points="4 16 12 20 20 16" /></svg>
							<div class="progress-marker"></div>
							<div class="progress-text">
							  <h6 class="progress-title">Disposisi Diterima</h6>
							  <?php if($query->disposisi_diterima !== NULL){
								  echo '<small class="surat-date"><em>'.date_indo_bk($query->disposisi_diterima).'</em></small>';
								  echo '<br /><small class="surat-date"><em><strong>'.$query->jabatan_organisasi_pelaksana.'</strong><br />'.$query->nama_pelaksana.'<br />NIP: '.$query->nip_pelaksana.'</em></small><br />';
									if($query->disposisi_diterima_status == 1) {
										echo '<br /><small><b>DILAKSANAKAN</b></small>';
										echo '<br /><small><em>"'.$query->disposisi_diterima_tanggapan.'"</em></small>';
									}
									else {
										echo '<br /><small><b>DITOLAK</b></small>';
										echo '<br /><small><em>"'.$query->disposisi_diterima_tanggapan.'"</em></small>';
									}
							  }
								  ?>
							</div>
						  </li>
						  
						  <li class="progress-step<?php if($query->disposisi_proses !== NULL){echo ' is-complete';} ?>">
						  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><line x1="3" y1="6" x2="3" y2="19" /><line x1="12" y1="6" x2="12" y2="19" /><line x1="21" y1="6" x2="21" y2="19" /></svg>
							<div class="progress-marker"></div>
							<div class="progress-text">
							  <h6 class="progress-title">Disposisi Diproses</h6>
							  <?php if($query->disposisi_proses !== NULL){
								  echo '<small class="surat-date"><em>'.date_indo_bk($query->disposisi_proses).'</em></small>';
								  echo '<br /><small><em>"'.$query->disposisi_proses_tanggapan.'"</em></small>';
							  }
								  ?>
							</div>
						  </li>
						
						 <?php } 
						 if ($query->disposisi_pelaksana != NULL) {
						 ?>
						

						  <li class="progress-step<?php if($query->surat_selesai !== NULL){echo ' is-complete';} ?>">
						  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 9 12 15 21 9 12 3 3 9" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><line x1="3" y1="19" x2="9" y2="13" /><line x1="15" y1="13" x2="21" y2="19" /></svg>
							<div class="progress-marker"></div>
							<div class="progress-text">
							  <h6 class="progress-title">Surat Selesai</h6>
							   <?php if($query->surat_selesai !== NULL){
								   echo '<small class="surat-date"><em>'.date_indo_dp($query->surat_selesai).'</em></small>';
								   echo '<br /><small><em>"'.$query->surat_selesai_tanggapan.'"</em></small>';
								   } ?>
							</div>
						  </li>
						 <?php } ?>
					</ul>				
				</fieldset>
				
				
				
              </div>
            </div>
          </div>
		  
		  <?php if($userData['id_user'] == $query->disposisi_pelaksana) { ?>
		  <div class="row row-deck row-cards">
           <div class="col-12">
              <div class="card">
                			
				<?php if($query->disposisi_diterima == NULL OR $query->disposisi_proses == NULL OR $query->surat_selesai == NULL) {?>
				<legend class="text-bold"></legend>
				<?php } ?>
				
				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">					
				
				 <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				 <?php if($query->disposisi_diterima == NULL AND $query->disposisi_proses == NULL AND $query->surat_selesai == NULL) {?>
					<h4>Penerimaan Disposisi</h4>
					<div class="form-group mb-3 row">
						<div class="col">
							<label class="radio-inline"><input type="radio" name="respon_disposisi" value="terima" checked>&nbsp;Terima Disposisi</label>
							<label class="radio-inline"><input type="radio" name="respon_disposisi" value="tolak">&nbsp;Tolak Disposisi</label>
						</div>
                    </div>
					<div class="form-group mb-3 row">
						<div class="col">
							<textarea class="form-control" id="tanggapan_disposisi" name="tanggapan_disposisi" rows="4" cols="50" placeholder="Isi tanggapan penerimaan disposisi..." required></textarea>
						</div>
                    </div>
					 <button type="submit" name="terimadisp" class="btn btn-primary" style="float:right;">Kirim Tanggapan</button>
				 <?php } elseif($query->disposisi_diterima != NULL AND $query->disposisi_proses == NULL AND $query->surat_selesai == NULL) {?>
					<h4>Proses Disposisi</h4>
					<div class="form-group mb-3 row">
						<div class="col">
							<textarea class="form-control" id="proses_disposisi" name="proses_disposisi" rows="4" cols="50" placeholder="Isi tanggapan proses disposisi..." required></textarea>
						</div>
                    </div>
					 <button type="submit" name="prosesdisp" class="btn btn-primary" style="float:right;">Proses Disposisi</button>
				  <?php } elseif($query->disposisi_diterima != NULL AND $query->disposisi_proses != NULL AND $query->surat_selesai == NULL) {?>
					<h4>Disposisi Selesai</h4>
					<div class="form-group mb-3 row">
						<div class="col">
							<textarea class="form-control" id="selesai_disposisi" name="selesai_disposisi" rows="4" cols="50" placeholder="Isi keterangan..." required></textarea>
						</div>
                    </div>
					 <button type="submit" name="selesaidisp" class="btn btn-primary" style="float:right;">Disposisi Selesai</button>
				 <?php } ?>
				 </form>
				
				
						</div>
					  </div>
					</div>
				  </div>
				</div>
				
              </div>
            </div>
          </div>
		  <?php } ?>
		  <br>
		  <div class="row row-deck row-cards">
           <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detail Surat Disposisi</h3>
                </div>
                
				<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
                          <div class="form-group mb-3 row">
							<label class="form-label col-3 col-form-label">No. Surat</label>
							<div class="col">
							  <input type="text" name="no_asal" id="no_asal" class="form-control" value="<?php echo $query->nomor_surat; ?>" placeholder="" required readonly>
							</div>
							<div class="col">
								<div class="input-icon">
									<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
									</span>
									<input type="text" name="tgl_no_asald" class="form-control" id="tgl_no_asald" value="<?php echo $query->tgl_surat; ?>" maxlength="10" required placeholder="Masukkan Tanggal" readonly>
									</div>					 
							</div>
						  </div>
                          <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nomor Agenda</label>
							<div class="col">
							  <input type="text" name="agenda" id="agenda" class="form-control" value="<?php echo $query->id_nomor_agenda; ?>" placeholder="Nomor Agenda" readonly>
							</div>
                          </div>
						  <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Kode Surat</label>
							<div class="col">
							  <select class="form-control cari_kode" name="kode" id="kode" required disabled>
                              <option value=""></option>
                              <?php
                              if(!empty($kodesurat)) {
                                    foreach ($kodesurat as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>" <?php if($baris->id == $query->id_kode_surat){echo "selected";} ?>><?php echo $baris->no_kode; ?> - <?php echo $baris->kode_surat; ?></option>
                              <?php endforeach; }?>
                            </select>
							</div>
                          </div>
                          <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Tipe Surat</label>
							<div class="col">
							  <input type="text" name="tipe" id="tipe" class="form-control" value="<?php echo $query->tipe_surat; ?>" placeholder="Tipe Surat" readonly>
							</div>
                          </div>
						  <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Jenis Surat</label>
							<div class="col">
							  <input type="text" name="jenis" id="jenis" class="form-control" value="<?php echo $query->jenis_surat; ?>" placeholder="Jenis Surat" readonly>
							</div>
                          </div>
						  <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Pengirim</label>
							<div class="col">
							  <input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo $query->nama_pengirim; ?>" placeholder="Nama Pengirim" readonly>
							</div>
                          </div>
						  <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Penerima</label>
							<div class="col">
							  <input type="text" name="penerima" id="penerima" class="form-control" value="<?php echo $query->nama_penerima; ?>" placeholder="Nama Penerima" readonly>
							</div>
                          </div>
						  <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Perihal</label>
							<div class="col">
							  <input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="perihal" readonly>
							</div>
                          </div>
						  <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Ringkasan</label>
							<div class="col">
							  <textarea class="form-control" id="ringkasan" name="ringkasan" rows="4" cols="50" placeholder="Isi ringkasan..." readonly><?php echo $query->isi_ringkas; ?></textarea>
							</div>
                          </div>
                          
                      </div>
                    </div>
                  </div>                 
                </div>
              </div>  

			  <div class="card-body">
				  <div class="mb-3">
					<div class="col">                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Berkas</b></th>
                            <th width='10%'><b>Aksi</b></th>
                          </tr>
                          <?php
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$query->lampiran))->data;
                         if(!empty($lampiran)) {
                          $no = 1;
                          foreach ($lampiran as $baris) {?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td>
							  <div class="col-sm-6 col-lg-4">
							  <div class="card card-sm">
                <a href="#" class="d-block" data-bs-toggle="modal" data-bs-target="#modal-report"><img src="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" class="card-img-top"></a>
                				</div>
					  <div class="card-body">
						  <div class="d-flex align-items-center">						   
							<div>
							  <div><?php echo $baris->nama_berkas; ?></div>                      
							</div>
						  </div>
						</div>
						</div>	  
							  </td>
                              <td><a href="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg></a></td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>
				</div>

                    <hr>
                    <a href="<?php echo base_url();?>ketatausahaan/suratdisposisi" class="btn btn-link"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
                </form>
               
              </div>
            </div>
          </div>
        </div>
</div>
<!--modal for image-->
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Image</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
             
                  <img src="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" class="card-img-top">
               
            </div>
          </div>
          <!--<div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>            
          </div>-->
        </div>
      </div>
    </div>
<!--end modal for image-->
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('tgl_no_asald'),
    		buttonText: {
    			previousMonth: '<svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
    			nextMonth: '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
    		},
    	}));
    });
    // @formatter:on
	
	$( "li.is-complete" ).last().addClass("status-now");
  </script>