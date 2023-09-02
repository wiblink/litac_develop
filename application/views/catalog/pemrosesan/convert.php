<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Lamp
                </div>
                <h2 class="page-title">
                  Convert Data
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
               
				<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
            
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>File .docx</b></label>
					<div class="col-lg-12">
					<input type="hidden" name="iduser" id="iduser" class="form-control" value="<?php echo $id_user; ?>">
								  <input type="file" class="form-control" name='files' required />
								  <i style="color:red">*Required</i>
					</div>
			</div>
                          
                      </div>
                    </div>
                  </div>                 
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                 
                  <button type="submit" name="btnconvert" id="submit-all" class="btn btn-primary ms-auto" style="float:left;">Add</button>
                </div>
              </div>
			  
                </form>
               
              </div>
            </div>
          </div>
        </div>
</div>
<script>
	$(document).ready(function() {
		jQuery("#tgl_no_asal").val('<?php echo date("d-m-Y"); ?>');
		
			
	});
	
	</script>
	
	<script type="text/javascript">
	
	$('.msg').html('');


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
<script>
    // @formatter:off
	
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('tgl_no_asal'),
    		buttonText: {
    			previousMonth: '<svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
    			nextMonth: '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
    		},
    	}));
    });
    // @formatter:on
  </script>
