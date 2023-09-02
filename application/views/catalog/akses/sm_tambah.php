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

<link rel="stylesheet" type="text/css" href="assets/upload/dropzone.min.css">
<script type="text/javascript" src="assets/upload/dropzone.min.js"></script>

<style>
.dropzone {
  margin-top: 10px;
  border: 2px dashed #0087F7;
}
</style>


<div class="content-wrapper">
  
  <div class="content">

    
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="fa fa-envelope" aria-hidden="true"></i> Tambah Surat Masuk Baru</legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				
				

					<div class="form-group">
                      <label class="control-label col-lg-3"></label>
						<div class="col-lg-9">
						   <label class="radio-inline"><input type="radio" name="sumber-surat" checked>Surat Internal</label>
							<label class="radio-inline"><input type="radio" name="sumber-surat" id="surat-eksternal">Surat Eksternal</label>
						</div>
                    </div>
                   
					<div class="form-group" id="show-me">
                      <label class="control-label col-lg-3">Surat dari (Eksternal)</label>
						<div class="col-lg-9">
                            <input type="text" name="surat_eksternal" id="surat_eksternal" class="form-control" value="" placeholder="Pengirim/Instansi" readonly>
						</div>
                    </div>
				
                    <div class="form-group">
                      <label class="control-label col-lg-3">Nomor Surat</label>
                      <div class="col-lg-5">
    						<input type="text" name="no_surat" id="no_surat" class="form-control" value="" placeholder="Nomor Surat" required>
    				  </div>
                      <div class="col-lg-4">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_no_asal" class="form-control daterange-single" id="tgl_no_asal" value="<?php echo date('Y-m-d'); ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                        </div>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Nomor Agenda</label>
						<div class="col-lg-9">
                            <input type="text" name="agenda" id="agenda" class="form-control" value="" placeholder="Nomor Agenda" required>
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Kode Surat</label>
						<div class="col-lg-9">
                            <select class="form-control cari_kode" name="kode" id="kode" required>
                              <option value=""></option>
                              <?php
									if(!empty($kodesurat)) {
                                    foreach ($kodesurat as $baris) { ?>
                                        <option value="<?php echo $baris->id; ?>"><?php echo $baris->no_kode; ?> - <?php echo $baris->kode_surat; ?></option>
									<?php } }?>
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
                                        <option value="<?php echo $baris->id; ?>"><?php echo $baris->tipe_surat; ?></option>
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
                                        <option value="<?php echo $baris->id; ?>"><?php echo $baris->jenis_surat; ?></option>
									<?php endforeach; } ?>
                            </select>
						</div>
                    </div>
					

                    <div class="form-group">
                      <label class="control-label col-lg-3">Penerima</label>
						<div class="col-lg-9">
                            <select class="form-control cari_penerima" name="penerima" id="penerima" required>
                              <option value=""></option>
                              <?php
									if(!empty($penerima)) {
                                    foreach ($penerima as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>">NIP: <?php echo $baris->nip; ?> - <?php echo $baris->nama_lengkap; ?> <?php if($baris->jabatan_organisasi != NULL){echo '('.$baris->jabatan_organisasi.')';}?></option>
									<?php endforeach; }?>
                            </select>
						</div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
						<div class="col-lg-9">
							<input type="text" name="perihal" id="perihal" class="form-control" placeholder="Perihal">
						</div>
                    </div>
					
					<div class="form-group">
                      <label class="control-label col-lg-3">Ringkasan</label>
						<div class="col-lg-9">
							<textarea class="form-control" id="ringkasan" name="ringkasan" rows="4" cols="50" placeholder="Isi ringkasan..."></textarea>
						</div>
                    </div>
					
					

                    <div class="form-group">
                      <label class="control-label col-lg-3"><b>Lampiran</b></label>
                      <div class="col-lg-12">
                          <div class="dropzone" id="myDropzone">
                            <div class="dz-message">
                             <h3> Klik atau Drop Lampiran disini</h3>
                            </div>
                          </div>
                          <i style="color:red">*Lampiran wajib diisi</i>
    									</div>
                    </div>

                    <hr>
                    <a href="ketatausahaan/suratmasuk" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
					<button type="submit" name="btnsimpan" id="submit-all" class="btn btn-primary" style="float:right;">Kirim</button>
                </form>

                <script>
                    $(document).ready(function () {
                        $(".cari_ns").select2({
                            placeholder: "Pilih nomor"
                        });

                        $(".cari_penerima").select2({
                            placeholder: "Pilih Penerima"
                        });
						
						$(".cari_kode").select2({
                            placeholder: "Pilih Kode Surat"
                        });
						
						$(".cari_tipe").select2({
                            placeholder: "Pilih Tipe Surat"
                        });
						
						$(".cari_jenis").select2({
                            placeholder: "Pilih Jenis Surat"
                        });
                    });
                </script>
              </fieldset>


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
        myDropzone = this; 

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
			formData.append("addsuratmasuk", jQuery("#addsuratmasuk").val());
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
			formData.append("surat_eksternal", jQuery("#surat_eksternal").val());
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
      eAlert();
      myDropzone.removeFile(file);
    });

  }
};

function eAlert(){
	swal({
		icon: "success",
		text: "Sukses! Surat Masuk berhasil dikirim"
	}).then(function() {
		window.location = "<?php echo base_url(); ?>ketatausahaan/suratmasuk";
	});
}

$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'surat-eksternal') {
            //$('#show-me').show();           
			$('#show-me input').prop('readonly', false).val("");
			$('#show-me input').prop('required', true);   
       }
       else {
            //$('#show-me').hide();   
			$('#show-me input').prop('readonly', true).val("");
			$('#show-me input').prop('required', false); 
       }
   });
});
</script>
