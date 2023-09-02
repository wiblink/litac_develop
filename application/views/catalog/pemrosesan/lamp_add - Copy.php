<script>
                    $(document).ready(function () {
                        $(".find_indoor").select2({
                            placeholder: "Indoor",
							allowClear: true
                        });	
					});

					$(document).ready(function () {
                        $(".find_outdoor").select2({
                            placeholder: "Outdoor",
							allowClear: true
                        });
                    });
					
					$(document).ready(function () {
                        $(".find_cct").select2({
                            placeholder: "CCT",
							allowClear: true
                        });
                    });
					
					$(document).ready(function () {
                        $(".find_refl").select2({
                            placeholder: "Reflector Finish",
							allowClear: true
                        });
                    });
					
					$(document).ready(function () {
                        $(".find_procol").select2({
                            placeholder: "Product Colour",
							allowClear: true
                        });
                    });
					
					$(document).ready(function () {
                        $(".find_control").select2({
                            placeholder: "Control",
							allowClear: true
                        });
                    });
					
					$(document).ready(function () {
                        $(".find_pb").select2({
                            placeholder: "Product Brand",
							allowClear: true
                        });
                    });
					
					
    // @formatter:on	
                </script>
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
                  Add Lamp
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
                                
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
            
				<?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-6">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Luminaire Type</label>
					<div class="col">
						<input type="text" name="luminaire_type" id="luminaire_type" class="form-control" value="" placeholder="Luminaire Type" required>
					</div>
			</div>			
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Type</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='I' id="indoor">&nbsp;Indoor</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='O' id="outdoor">&nbsp;Outdoor</label>					
					</div>				
			</div>			
			<div class="form-group mb-3 row" id="show-indoor" style="display:none;">
				<label class="form-label col-3 col-form-label"> </label>
					<div class="col">
						<select class="form-control find_indoor" name="adv_cat_indoor" id="adv_cat_indoor">
                              <option value=""></option>
                              <?php
									if(!empty($indoor)) {
                                    foreach ($indoor as $baris) { ?>
                                        <option value="<?php echo $baris->id_product_type; ?>"><?php echo $baris->name_product_type; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row" id="show-outdoor" style="display:none;">
				<label class="form-label col-3 col-form-label"> </label>
					<div class="col">
						<select class="form-control find_outdoor" name="adv_cat_outdoor" id="adv_cat_outdoor">
                              <option value=""></option>
                              <?php
									if(!empty($outdoor)) {
                                    foreach ($outdoor as $baris) { ?>
									<option value="<?php echo $baris->id_product_type; ?>"><?php echo $baris->name_product_type; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Luminaire Reference</label>
					<div class="col">
						<input type="text" name="luminaire_ref" id="luminaire_ref" class="form-control" value="" placeholder="Luminaire Reference" required>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lamp</label>
					<div class="col">
						<input type="text" name="lamp" id="lamp" class="form-control" value="" placeholder="Lamp" required>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lamp Reference</label>
					<div class="col">
						<input type="text" name="lamp_ref" id="lamp_ref" class="form-control" value="" placeholder="Lamp Reference" required>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Gears</label>
					<div class="col">
					  <input type="text" name="gears" id="gears" class="form-control" value="" placeholder="Gears" required>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Accesories</label>
					<div class="col">
					  <input type="text" name="accesories" id="accesories" class="form-control" value="" placeholder="Accesories" required>
					</div>
            </div>
			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Product Brand</label>
					<div class="col">
					  <select class="form-control find_pb" name="id_product_brand" id="id_product_brand">
                              <option value=""></option>
                              <?php
									if(!empty($branddt)) {
                                    foreach ($branddt as $baris) { ?>
									<option value="<?php echo $baris->id_brand; ?>"><?php echo $baris->name_product_brand; ?></option>
									<?php } }?>
                        </select>
					</div>
            </div>
			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Product Code</label>
					<div class="col">
					  <input type="text" name="product_code" id="product_code" class="form-control" value="" placeholder="Product Code" required>
					</div>
            </div>
			
			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Power</label>
					<div class="col">
					  <input type="text" name="power" id="power" class="form-control" value="" placeholder="Power" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lumen</label>
					<div class="col">
					  <input type="text" name="lumen" id="lumen" class="form-control" value="" placeholder="Lumen" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">CCT / Colour Temperature</label>
					<div class="col">
						<select class="form-control find_cct" name="cct" id="cct" onchange="changeFunc();">
                              <?php
									if(!empty($cct)) {
                                    foreach ($cct as $ctrow) { ?>
									<option value="<?php echo $ctrow->id_cct; ?>"><?php echo $ctrow->color_temperature; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>			
			<div class="form-group mb-3 row" id="show-staticwhite" style="display:none;">
				<label class="form-label col-3 col-form-label"> </label>
					<div class="col">
						<input type="text" name="sw" id="sw" class="form-control" value="" size=4 maxlength=5>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">CRI / Colour rendering Index</label>
					<div class="col">
					  <input type="text" name="cri" id="cri" class="form-control" value="" placeholder="CRI" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Optic</label>
					<div class="col">
						<select class="form-control find_cct" name="optic" id="optic">
                              <?php
									if(!empty($optical)) {
                                    foreach ($optical as $opticrw) { ?>
									<option value="<?php echo $opticrw->id_optic; ?>"><?php echo $opticrw->name_optic; ?></option>
									<?php } }?>optic
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Beam Angle</label>
					<div class="col">
						<input type="text" name="beam_angle" id="beam_angle" class="form-control" value="" placeholder="Beam" size=4 maxlength=5>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Optic</label>
					<div class="col">
						<select class="form-control" name="product_shape" id="product_shape">
								<option value="1">Circular</option>
								<option value="2">Other</option>
								<option value="3">Rectangular</option>
								<option value="4">Square</option>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Adjustable Optic</label>
					<div class="col">
					&nbsp;
						<div class="form-check form-check-inline">
						  <input id='adjHidden' type='hidden' value='0' name='adj_optic'>
						  <input class="form-check-input" name="adj_optic" type="checkbox" value="1" id="adj">
						  <label class="form-check-label" for="adj">
							Adjustable
						  </label>
						</div>
						<div class="form-check form-check-inline">
						  <input id='nadjHidden' type='hidden' value='0' name='nadj_optic'>
						  <input class="form-check-input" name="nadj_optic" type="checkbox" value="1" id="nadj">
						  <label class="form-check-label" for="nadj">
							Not Adjustable
						  </label>
						</div>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Reflector Finish</label>
					<div class="col">
						<select class="form-control find_refl" name="reflector_finish" id="reflector_finish">
                              <option value=""></option>
                              <?php
									if(!empty($refl_finish)) {
                                    foreach ($refl_finish as $baris) { ?>
									<option value="<?php echo $baris->id_ref_finish; ?>"><?php echo $baris->name_ref_finish; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Colour</label>
					<div class="col">
						<select class="form-control find_procol" name="product_colour" id="product_colour">
                              <option value=""></option>
                              <?php
									if(!empty($procol)) {
                                    foreach ($procol as $row) { ?>
									<option value="<?php echo $row->id_product_colour; ?>"><?php echo $row->name_product_colour; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Colour</label>
					<div class="col">
						<select class="form-control find_control" name="control" id="control">
                              <option value=""></option>
                              <?php
									if(!empty($controldt)) {
                                    foreach ($controldt as $row) { ?>
									<option value="<?php echo $row->id_control; ?>"><?php echo $row->name_control; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kelvin</label>
					<div class="col">
					  <input type="text" name="kelvin" id="kelvin" class="form-control" value="" placeholder="Kelvin" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Diameter</label>
					<div class="col">
					  <input type="text" name="dim_diameter" id="dim_diameter" class="form-control" value="" placeholder="Diameter" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Opening</label>
					<div class="col">
					  <input type="text" name="dim_opening" id="dim_opening" class="form-control" value="" placeholder="Opening" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Height</label>
					<div class="col">
					  <input type="text" name="dim_height" id="dim_height" class="form-control" value="" placeholder="Height" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Width</label>
					<div class="col">
					  <input type="text" name="dim_width" id="dim_width" class="form-control" value="" placeholder="Width" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Length</label>
					<div class="col">
					  <input type="text" name="dim_length" id="dim_length" class="form-control" value="" placeholder="Length" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Weight</label>
					<div class="col">
					  <input type="text" name="dim_weight" id="dim_weight" class="form-control" value="" placeholder="Weight" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Diameter</label>
					<div class="col">
					  <input type="text" name="dim_cut_o_diameter" id="dim_cut_o_diameter" class="form-control" value="" placeholder="Cut Out Diameter" size=4 maxlength=5>
					</div>
            </div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Recessed Depth</label>
					<div class="col">
					  <input type="text" name="dim_recc_depth" id="dim_recc_depth" class="form-control" value="" placeholder="Recessed Depth" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Depth + Housing</label>
					<div class="col">
					  <input type="text" name="dim_depth_housing" id="dim_depth_housing" class="form-control" value="" placeholder="Depth + Housing" size=4 maxlength=5>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cover height</label>
					<div class="col">
					  <input type="text" name="dim_cover_height" id="dim_cover_height" class="form-control" value="" placeholder="Cover height" size=4 maxlength=5>
					</div>
            </div>		
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Housing</label>
					<div class="col">
					  <input type="text" name="tecspec_housing" id="tecspec_housing" class="form-control" value="" placeholder="Housing">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Reflector</label>
					<div class="col">
					  <input type="text" name="tecspec_reflector" id="tecspec_reflector" class="form-control" value="" placeholder="Reflector">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lamp Holder</label>
					<div class="col">
					  <input type="text" name="tecspec_lamp_holder" id="tecspec_lamp_holder" class="form-control" value="" placeholder="Lamp Holder">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cover Trim</label>
					<div class="col">
					  <input type="text" name="tecspec_cover_trim" id="tecspec_cover_trim" class="form-control" value="" placeholder="Cover Trim">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Light Distribution</label>
					<div class="col">
					  <input type="text" name="tecspec_light_distr" id="tecspec_light_distr" class="form-control" value="" placeholder="Light Distribution">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Adjustment</label>
					<div class="col">
					  <input type="text" name="tecspec_adjustment" id="tecspec_adjustment" class="form-control" value="" placeholder="Adjustment">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Approval</label>
					<div class="col">
					  <input type="text" name="tecspec_approval" id="tecspec_approval" class="form-control" value="" placeholder="Approval">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Transformer</label>
					<div class="col">
					  <input type="text" name="tecspec_transformer" id="tecspec_transformer" class="form-control" value="" placeholder="Transformer">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">IP</label>
					<div class="col">
					  <input type="text" name="tecspec_ip" id="tecspec_ip" class="form-control" value="" placeholder="IP">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">UGR</label>
					<div class="col">
					  <input type="text" name="ugr_rating" id="ugr_rating" class="form-control" value="" placeholder="UGR RATTING">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Instalation manual</label>
					<div class="col">
					  <input type="text" name="instalation_manual" id="instalation_manual" class="form-control" value="" placeholder="Instalation manual">
					</div>
            </div>
			
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Harga</label>
					<div class="col">
					  <input type="number" name="price" id="price" class="form-control" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
					</div>
            </div>-->								
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>Gambar</b></label>
					<div class="col-lg-12">
								  <input type="file" class="form-control" name='files[]' multiple required />
								  <i style="color:red">*Lampiran wajib diisi</i>
					</div>
			</div>
                          
                      </div>
                    </div>
                  </div>

				 <div class="col-xl-6">
				 table
				 </div>				  
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                  <a href="<?php echo base_url();?>catalog/lamp" class="btn btn-link">Cancel</a>
                  <button type="submit" name="btnsimpan" id="submit-all" class="btn btn-primary ms-auto" style="float:right;"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Add</button>
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
	
	$(document).ready(function() {				
		changeFunc();
	});
	
	
$('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'indoor') {
            $('#show-indoor').show();
			$('#show-outdoor').hide();			
       }
       else if ($(this).attr('id') == 'outdoor') {
		    $('#show-outdoor').show();
            $('#show-indoor').hide();   
       }
   });
   
	function changeFunc() {
		var selectBox = document.getElementById("cct");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
			if (selectedValue=="1"){
			$('#show-staticwhite').show();
			}
			else {
			$('#show-staticwhite').hide();
			}
	}
	
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
