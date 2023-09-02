<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script>
$( function() {
  $( "#tgl_ns" ).datepicker();
} );
$( function() {
  $( "#tgl_no_asal" ).datepicker();
} );
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/upload/dropzone.min.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/upload/dropzone.min.js"></script>


<div class="content-wrapper">
  <div class="content">

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="fa fa-envelope" aria-hidden="true"></i> Edit Surat Masuk</legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal sm-form" action="" method="post">
				
                    <div class="form-group">
                      <label class="control-label col-lg-3">Nomor Surat</label>
                      <div class="col-lg-5">
    						<input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->nomor_surat; ?>" placeholder="" required>
							<input type="hidden" name="id" id="id" class="form-control" value="<?php echo $query->id; ?>" required>
    				  </div>
                      <div class="col-lg-4">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_no_asal" class="form-control daterange-single" id="tgl_no_asal" value="<?php echo date("d-m-Y",strtotime($query->tgl_surat)); ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                        </div>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Nomor Agenda</label>
						<div class="col-lg-9">
                            <input type="text" name="agenda" id="agenda" class="form-control" value="<?php echo $query->id_nomor_agenda; ?>" placeholder="Nomor Agenda" required>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Kode Surat</label>
						<div class="col-lg-9">
                            <select class="form-control cari_kode" name="kode" id="kode" required>
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
                            <select class="form-control cari_tipe" name="tipe" id="tipe" required>
                              <option value=""></option>
                              <?php
									if(!empty($tipesurat)) {
                                    foreach ($tipesurat as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>" <?php if($baris->id == $query->id_tipe_surat){echo "selected";} ?>><?php echo $baris->tipe_surat; ?></option>
									<?php endforeach; }?>
                            </select>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Jenis Surat</label>
						<div class="col-lg-9">
                            <select class="form-control cari_jenis" name="jenis" id="jenis" required>
                              <option value=""></option>
                              <?php
									if(!empty($jenissurat)) {
                                    foreach ($jenissurat as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>" <?php if($baris->id == $query->id_jenis_surat){echo "selected";} ?>><?php echo $baris->jenis_surat; ?></option>
									<?php endforeach; } ?>
                            </select>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Pengirim</label>
                      <div class="col-lg-9">
					  <?php 
						$pengirim = json_decode(ecurl('GET','pengguna/'.$query->pengirim))->data;
					  ?>
    					<input type="text" name="pengirim" id="pengirim" class="form-control" value="NIP: <?php echo $pengirim->nip; ?> - <?php echo $pengirim->nama_lengkap; ?>" placeholder="" readonly>
    					</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Penerima</label>
							<div class="col-lg-9">
								<?php 
									$penerima = json_decode(ecurl('GET','pengguna/'.$query->penerima))->data;
								?>
								<input type="hidden" name="hidden_penerima" id="hidden_penerima" class="form-control" value="<?php echo $query->penerima; ?>" required>
    					<input type="text" name="penerima" id="penerima" class="form-control" value="NIP: <?php echo $penerima->nip; ?> - <?php echo $penerima->nama_lengkap; ?>" placeholder="" readonly>

    						</div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
    								<input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="" required>
    									</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Ringkasan</label>
						<div class="col-lg-9">
							<textarea class="form-control" id="ringkasan" name="ringkasan" rows="4" cols="50" placeholder="Isi ringkasan..." required><?php echo $query->isi_ringkas; ?></textarea>
						</div>
                    </div>

					
                    <script>
                        $(document).ready(function () {
							$(".cari_ns").select2({
                            placeholder: "Pilih nomor"
							});
							
                            $(".cari_penerima").select2({
                                placeholder: "Pilih Nama Cabang"
                            });
							$(".cari_kode").select2({
                                placeholder: "Pilih Kode Surat"
                            });
							
							$(".cari_penerima").select2({
                            placeholder: "Pilih Penerima"
							});
							
							$(".cari_tipe").select2({
								placeholder: "Pilih Tipe Surat"
							});
							
							$(".cari_jenis").select2({
								placeholder: "Pilih Jenis Surat"
							});
                        });
                    </script>
                    <hr>
                    <a href="ketatausahaan/suratmasuk" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
                    <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Update Surat</button>
                </form>

              </fieldset>


            </div>
			
			
		</div>
		
		<div class="panel panel-flat">
			<div class="panel-body">
				<fieldset class="content-group">
					<legend class="text-bold"><i class="fa fa-envelope" aria-hidden="true"></i> LAMPIRAN</legend>
					<div class="msg"></div>
                <form class="form-horizontal" action="" method="post">
				
					<div class="form-group">
                      
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
					
					<div class="form-group">
                      <label class="control-label col-lg-3"><b>Ganti Lampiran</b></label>
                      <div class="col-lg-12">
                          <div class="dropzone" id="myDropzone">
                            <div class="dz-message">
                             <h3> Klik atau Drop untuk ganti Lampiran</h3>
                            </div>
                          </div>
                          <i style="color:red">*Lampiran wajib diisi</i>
    									</div>
                    </div>
					
					<button type="submit" id="submit-all" class="btn btn-primary" style="float:right;">Update Lampiran</button>
				</form>
			</div>
		</div>
	  </div>
    </div>
<script type="text/javascript">

$('.msg').html('');

Dropzone.options.myDropzone = {
  url: "<?php echo base_url('ketatausahaan/suratmasuk') ?>",
  paramName:"userfile",
  // acceptedFiles:"'file/doc','file/xls','file/xlsx','file/docx','file/pdf','file/txt',image/jpg,image/jpeg,image/png,image/bmp",
  autoProcessQueue: false,
  maxFilesize: 10, //MB
  parallelUploads: 10,
  maxFiles: 1,
  addRemoveLinks:true,
  dictCancelUploadConfirmation: "Yakin ingin membatalkan upload ini?",
  dictInvalidFileType: "Type file ini tidak dizinkan",
  dictFileTooBig: "File yang Anda Upload terlalu besar {{filesize}} MB. Maksimal Upload {{maxFilesize}} MB",
  dictRemoveFile: "Hapus",

  init: function() {
    var submitButton = document.querySelector("#submit-all")
        myDropzone = this; // closure

    submitButton.addEventListener("click", function(e) {
      e.preventDefault();
      e.stopPropagation();
      myDropzone.processQueue();
    });


    this.on("error", function(file, message) {
                alert(message);
                this.removeFile(file);
                errors = true;
    });

    this.on("sending", function(data, xhr, formData) {
			formData.append("editsuratmasuk", jQuery("#editsuratmasuk").val());
			formData.append("agenda", jQuery("#agenda").val());
            formData.append("no_surat", jQuery("#no_surat").val());
            formData.append("tgl_no_asal", jQuery("#tgl_no_asal").val());
            formData.append("pengirim", jQuery("#pengirim").val());
            formData.append("penerima", jQuery("#penerima").val());
            formData.append("perihal", jQuery("#perihal").val());
			formData.append("ringkasan", jQuery("#ringkasan").val());
			formData.append("kode", jQuery("#kode").val());
			formData.append("tipe", jQuery("#tipe").val());
			formData.append("jenis", jQuery("#jenis").val());
			formData.append("agenda", jQuery("#agenda").val());
			formData.append("id", jQuery("#id").val());
    });

    this.on("complete", function(file) {
      myDropzone.removeFile(file);
    });

    this.on("success", function (file, response) {
      $(".cari_ns").select2({
        placeholder: "Pilih nomor",
        allowClear: true
      });
      $(".cari_ns").val('').trigger('change');
		$('.form-horizontal')[0].reset();
		eAlertLampiran();
		myDropzone.removeFile(file);
    });

  }
};

function eAlertLampiran(){
	swal({
		icon: "success",
		text: "Sukses! Lampiran berhasil diUpdate"
	}).then(function() {
		location.reload(); 
	});
}
$("form.sm-form").submit(function(){
	swal({
		icon: "success",
		text: "Sukses! Surat Keluar berhasil diUpdate."
	}).then(function() {
		location.reload(); 
	});
});

</script>

