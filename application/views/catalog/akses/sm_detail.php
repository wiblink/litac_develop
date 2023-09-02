<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
$( function() {
  $( "#tgl_ns" ).datepicker();
} );
$( function() {
  $( "#tgl_no_asal" ).datepicker();
} );
</script>

<div class="content-wrapper">
 
  <div class="content">

    
    <div class="row">
      <div class="col-md-12">
		<div class="panel panel-flat">
			 <div class="panel-body">
			 <fieldset class="content-group">
			 <legend class="text-bold"><i class="fa fa-envelope" aria-hidden="true"></i> Status Surat</legend>
				<ul class="progress-tracker progress-tracker--text progress-tracker--right">
					  <li class="progress-step is-complete surat-terkirim">
						<div class="progress-marker"></div>
						<div class="progress-text progress-text--dotted progress-text--dotted-2">
						  <h6 class="progress-title">Surat Dikirim</h6>
						  <?php 
						  echo '<small class="surat-date"><em>'.date_indo_bk($query->tgl_dikirim).'</em></small>'; 
						  echo '<br /><small class="surat-date"><em><strong>'.$query->jabatan_organisasi_pengirim.'</strong><br />'.$query->nama_pengirim.'<br />NIP: '.$query->nip_pengirim.'</em></small>';
						  ?>
						</div>
					  </li>

					  <li class="progress-step surat-dibaca<?php if($query->tgl_diterima !== NULL){echo ' is-complete';} ?>">
						<div class="progress-marker"></div>
						<div class="progress-text progress-text--dotted progress-text--dotted-2">
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
					  
					  <li class="progress-step disposisi-dikirim<?php if($query->disposisi_pelaksana !== NULL){echo ' is-complete';} ?>">
						<div class="progress-marker"></div>
						<div class="progress-text progress-text--dotted progress-text--dotted-2">
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
					  
					  <li class="progress-step disposisi-diterima<?php if($query->disposisi_diterima !== NULL){echo ' is-complete';} ?>">
						<div class="progress-marker"></div>
						<div class="progress-text progress-text--dotted progress-text--dotted-2">
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
					  
					  <li class="progress-step disposisi-proses<?php if($query->disposisi_proses !== NULL){echo ' is-complete';} ?>">
						<div class="progress-marker"></div>
						<div class="progress-text progress-text--dotted progress-text--dotted-2">
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
					

					  <li class="progress-step surat-selesai<?php if($query->surat_selesai !== NULL){echo ' is-complete';} ?>">
						<div class="progress-marker"></div>
						<div class="progress-text progress-text--dotted progress-text--dotted-2">
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
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="fa fa-envelope" aria-hidden="true"></i> Detail Surat Masuk</legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">

                    <div class="form-group">
                      <label class="control-label col-lg-3">No. Surat</label>
                      <div class="col-lg-5">
    					<input type="text" name="no_asal" id="no_asal" class="form-control" value="<?php echo $query->nomor_surat; ?>" placeholder="" required readonly>
    				 </div>
                      <div class="col-lg-4">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_no_asald" class="form-control" id="tgl_no_asald" value="<?php echo $query->tgl_surat; ?>" maxlength="10" required placeholder="Masukkan Tanggal" readonly>
                        </div>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Nomor Agenda</label>
						<div class="col-lg-9">
                            <input type="text" name="agenda" id="agenda" class="form-control" value="<?php echo $query->id_nomor_agenda; ?>" placeholder="Nomor Agenda" required readonly>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Kode Surat</label>
						<div class="col-lg-9">
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
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Tipe Surat</label>
						<div class="col-lg-9">
                           <input type="text" name="tipe" id="tipe" class="form-control" value="<?php echo $query->tipe_surat; ?>" placeholder="Tipe Surat" required readonly>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Jenis Surat</label>
						<div class="col-lg-9">
                           <input type="text" name="jenis" id="jenis" class="form-control" value="<?php echo $query->jenis_surat; ?>" placeholder="Jenis Surat" required readonly>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Pengirim</label>
                      <div class="col-lg-9">
						<input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo $query->nama_pengirim; ?>" placeholder="Nama Pengirim" required readonly>
    					</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Penerima</label>
                      <div class="col-lg-9">
                            <input type="text" name="penerima" id="penerima" class="form-control" value="<?php echo $query->nama_penerima; ?>" placeholder="Nama Penerima" required readonly>
    					</div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
    								<input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="" required readonly>
    									</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Ringkasan</label>
						<div class="col-lg-9">
							<textarea class="form-control" id="ringkasan" name="ringkasan" rows="4" cols="50" placeholder="Isi ringkasan..." required readonly><?php echo $query->isi_ringkas; ?></textarea>
						</div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-lg-3"><b>Lampiran</b></label>
                      <div class="col-lg-12">
                        <table class="table table-bordered" width="100%">
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
                              <td><a href="lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB"><?php echo $baris->nama_berkas; ?></a></td>
                              <td><a href="lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-default xs"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    									</div>
                    </div>

                    <hr>
                    <a href="ketatausahaan/suratmasuk" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
                </form>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
	<script>
	$( "li.is-complete" ).last().addClass("status-now");
	</script>