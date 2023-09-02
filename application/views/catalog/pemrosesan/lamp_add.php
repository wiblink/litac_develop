<link href="<?php echo base_url();?>assetsprimary/modules/jquery-ui/jquery-ui.css" rel="stylesheet"/>
<style>

.ui-autocomplete {
    width:80px;
    padding:0;
    margin:0;
    z-index:1000;
}
.ui-autocomplete li {
    background: #eee;
    text-align:left;
    cursor: pointer;
	padding-left: 6px;
}
.ui-autocomplete li:hover {
    background: #ccc;
}
.ui-autocomplete li a {
    cursor: pointer;
    padding: 6px 10px;
    display: block;
}
.ui-autocomplete li a.ui-state-focus {
    background: #DE9C9C;
}

.ui-autocomplete {
  max-height: 100px;
  overflow-y: auto;
  overflow-x: hidden;
  padding-right: 0px;
}

</style>
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
                        $(".find_optic").select2({
                            placeholder: "Optic",
							allowClear: true
                        });
                    });
					
					$(document).ready(function () {
                        $(".find_prshape").select2({
                            placeholder: "Product Shape",
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
					
					$(document).ready(function () {
                        $(".find_cd").select2({
                            placeholder: "Product Code",
							allowClear: true
                        });
                    });
					
    // @formatter:on
	
	$( function() {
		
	var brandTags = [
		<?php
			if(!empty($brandinp)) {
			foreach ($brandinp as $baris) { ?>
			"<?php echo $baris->name_product_brand; ?>",
		<?php } }?>		
		];
		$( "#id_product_brand" ).autocomplete({
		  source: brandTags
		});
		
	var namebrandTags = [
		<?php
			if(!empty($namebrandinp)) {
			foreach ($namebrandinp as $baris) { ?>
			"<?php echo $baris->product_brand_name; ?>",
		<?php } }?>		
		];
		$( "#id_brand_name" ).autocomplete({
		  source: namebrandTags
		});
		
    var availableTags = [
		<?php
			if(!empty($ipdt)) {
			foreach ($ipdt as $baris) { ?>
			"<?php echo $baris->tecspec_ip; ?>",
		<?php } }?>		
		];
		$( "#tecspec_ip" ).autocomplete({
		  source: availableTags
		});
		
	var ugrTags = [
		<?php
			if(!empty($ugrdt)) {
			foreach ($ugrdt as $baris) { ?>
			"<?php echo $baris->ugr_rating; ?>",
		<?php } }?>		
		];
		$( "#ugr_rating" ).autocomplete({
		  source: ugrTags
		});
		
	var tiltTags = [
		<?php
			if(!empty($tiltdt)) {
			foreach ($tiltdt as $baris) { ?>
			"<?php echo $baris->tilt; ?>",
		<?php } }?>		
		];
		$( "#tilt" ).autocomplete({
		  source: tiltTags
		});
	
	var rotationTags = [
		<?php
			if(!empty($rotationdt)) {
			foreach ($rotationdt as $baris) { ?>
			"<?php echo $baris->rotation; ?>",
		<?php } }?>		
		];
		$( "#rotation" ).autocomplete({
		  source: rotationTags
		});
		
	var powerTags = [
		<?php
			if(!empty($powerdt)) {
			foreach ($powerdt as $baris) { ?>
			"<?php echo $baris->power; ?>",
		<?php } }?>		
		];
		$( "#power" ).autocomplete({
		  source: powerTags
		});
		
	var voltTags = [
		<?php
			if(!empty($voltagedt)) {
			foreach ($voltagedt as $baris) { ?>
			"<?php echo $baris->voltage; ?>",
		<?php } }?>		
		];
		$( "#voltage" ).autocomplete({
		  source: voltTags
		});
		
	var lumenTags = [
		<?php
			if(!empty($lumendt)) {
			foreach ($lumendt as $baris) { ?>
			"<?php echo $baris->lumen; ?>",
		<?php } }?>		
		];
		$( "#lumen" ).autocomplete({
		  source: lumenTags
		});
	
	var swTags = [
		<?php
			if(!empty($swdt)) {
			foreach ($swdt as $baris) { ?>
			"<?php echo $baris->sw; ?>",
		<?php } }?>		
		];
		$( "#sw" ).autocomplete({
		  source: swTags
		});
		
	var criTags = [
		<?php
			if(!empty($cridt)) {
			foreach ($cridt as $baris) { ?>
			"<?php echo $baris->cri; ?>",
		<?php } }?>		
		];
		$( "#cri" ).autocomplete({
		  source: criTags
		});
	
	var beamTags = [
		<?php
			if(!empty($bmdt)) {
			foreach ($bmdt as $baris) { ?>
			"<?php echo $baris->beam_angle; ?>",
		<?php } }?>
		];
		$( "#beam_angle" ).autocomplete({
		  source: beamTags
		});
		
	var beam2Tags = [
		<?php
			if(!empty($bm2dt)) {
			foreach ($bm2dt as $baris) { ?>
			"<?php echo $baris->beam_angleot; ?>",
		<?php } }?>
		];
		$( "#beam_angleot" ).autocomplete({
		  source: beam2Tags
		});
		
	var dim_diameterTags = [
		<?php
			if(!empty($dim_diameterdt)) {
			foreach ($dim_diameterdt as $baris) { ?>
			"<?php echo $baris->dim_diameter; ?>",
		<?php } }?>
		];
		$( "#dim_diameter" ).autocomplete({
		  source: dim_diameterTags
		});
			
	var dim_lengthTags = [
		<?php
			if(!empty($dim_lengthdt)) {
			foreach ($dim_lengthdt as $baris) { ?>
			"<?php echo $baris->dim_length; ?>",
		<?php } }?>
		];
		$( "#dim_length" ).autocomplete({
		  source: dim_lengthTags
		});
	
	var dim_weightTags = [
		<?php
			if(!empty($dim_weightdt)) {
			foreach ($dim_weightdt as $baris) { ?>
			"<?php echo $baris->dim_weight; ?>",
		<?php } }?>
		];
		$( "#dim_weight" ).autocomplete({
		  source: dim_weightTags
		});
	
	var dim_recc_depthTags = [
		<?php
			if(!empty($dim_recc_depthdt)) {
			foreach ($dim_recc_depthdt as $baris) { ?>
			"<?php echo $baris->dim_recc_depth; ?>",
		<?php } }?>
		];
		$( "#dim_recc_depth" ).autocomplete({
		  source: dim_recc_depthTags
		});
		
	var dimcuto_diameterTags = [
		<?php
			if(!empty($dim_cut_o_diameterdt)) {
			foreach ($dim_cut_o_diameterdt as $baris) { ?>
			"<?php echo $baris->dim_cut_o_diameter; ?>",
		<?php } }?>
		];
		$( "#dim_cut_o_diameter" ).autocomplete({
		  source: dimcuto_diameterTags
		});
	
	var cut_o_sq_lbrTags = [
		<?php
			if(!empty($cut_o_sq_lbrdt)) {
			foreach ($cut_o_sq_lbrdt as $baris) { ?>
			"<?php echo $baris->cut_o_sq_lbr; ?>",
		<?php } }?>
		];
		$( "#cut_o_sq_lbr" ).autocomplete({
		  source: cut_o_sq_lbrTags
		});

	var cut_o_sq_pjgTags = [
		<?php
			if(!empty($cut_o_sq_pjgdt)) {
			foreach ($cut_o_sq_pjgdt as $baris) { ?>
			"<?php echo $baris->cut_o_sq_pjg; ?>",
		<?php } }?>
		];
		$( "#cut_o_sq_pjg" ).autocomplete({
		  source: cut_o_sq_pjgTags
		});
	
	var dim_heightTags = [
		<?php
			if(!empty($dim_heightdt)) {
			foreach ($dim_heightdt as $baris) { ?>
			"<?php echo $baris->dim_height; ?>",
		<?php } }?>
		];
		$( "#dim_height" ).autocomplete({
		  source: dim_heightTags
		});
	
	var dim_depth_housingTags = [
		<?php
			if(!empty($dim_depth_housingdt)) {
			foreach ($dim_depth_housingdt as $baris) { ?>
			"<?php echo $baris->dim_depth_housing; ?>",
		<?php } }?>
		];
		$( "#dim_depth_housing" ).autocomplete({
		  source: dim_depth_housingTags
		});
	
	
	var dim_widthTags = [
		<?php
			if(!empty($dim_widthdt)) {
			foreach ($dim_widthdt as $baris) { ?>
			"<?php echo $baris->dim_width; ?>",
		<?php } }?>
		];
		$( "#dim_width" ).autocomplete({
		  source: dim_widthTags
		});
	
		
	});
  
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
				<input type="hidden" name="session" id="session" class="form-control" value="<?php echo $session; ?>">
				<input type="hidden" name="project_parameter_id" id="project_parameter_id" class="form-control" value="<?php echo $project_parameter_id; ?>">				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			
			<!--<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Luminaire Type</label>
					<div class="col">
						<input type="text" name="luminaire_type" id="luminaire_type" class="form-control" value="" placeholder="Luminaire Type" required>
					</div>
			</div>-->
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Type</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='I' id="indoor" required>&nbsp;Indoor</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='O' id="outdoor">&nbsp;Outdoor</label>					
					</div>				
			</div>			
			<div class="form-group mb-3 row" id="show-indoor" style="display:none;">
				<label class="form-label col-3 col-form-label"> </label>
					<div class="col">
						<select class="form-control find_indoor" name="adv_cat_indoor" id="adv_cat_indoor" style="width: 70%">
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
						<select class="form-control find_outdoor" name="adv_cat_outdoor" id="adv_cat_outdoor" style="width: 70%">
                              <option value=""></option>
                              <?php
									if(!empty($outdoor)) {
                                    foreach ($outdoor as $baris) { ?>
									<option value="<?php echo $baris->id_product_type; ?>"><?php echo $baris->name_product_type; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			
			<!--<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Luminaire Reference</label>
					<div class="col">
						<input type="text" name="luminaire_ref" id="luminaire_ref" class="form-control" value="" placeholder="Luminaire Reference" required>
					</div>
			</div>-->
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Brand</label>
					<div class="col">
						<input type="text" name="id_product_brand" id="id_product_brand" class="form-control" value="" placeholder="Product Brand">
						<!--<select class="form-control find_pb" name="id_product_brand" id="id_product_brand">
				    	<option value="">No Selected</option>
				    	<?php foreach($branddt as $row):?>
				    	<option value="<?php echo $row->id_brand;?>"><?php echo $row->name_product_brand;?></option>
				    	<?php endforeach;?>
						</select>-->
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Product Name</label>
					<div class="col">
						<input type="text" name="id_brand_name" id="id_brand_name" class="form-control" value="" placeholder="Product Name">
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Code</label>
					<div class="col">
						<input type="text" name="product_code" id="product_code" class="form-control" value="" placeholder="Product Code" required>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Accesories</label>
					<div class="col">
					  <input type="text" name="accesories" id="accesories" class="form-control" value="" placeholder="Accesories">
					</div>
            </div>			
			<!--<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Adjustable Optic</label>
					<div class="col">
					&nbsp;
						<div class="form-check form-check-inline">
						  <input id='adjHidden' type='hidden' value='1' name='adj_optic'>
						  <input class="form-check-input" name="adj_optic" type="checkbox" value="adj" id="adj">
						  <label class="form-check-label" for="adj">
							Adjustable
						  </label>
						</div>
						<div class="form-check form-check-inline">
						  <input id='nadjHidden' type='hidden' value='0' name='nadj_optic'>
						  <input class="form-check-input" name="nadj_optic" type="checkbox" value="nadj" id="nadj">
						  <label class="form-check-label" for="nadj">
							Fix
						  </label>
						</div>
					</div>
			</div>-->
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Adjustable Optic</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adjustable" value='A' id="adjustable">&nbsp;Adjustable</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adjustable" value='F' id="fix">&nbsp;Fixed</label>					
					</div>				
			</div>	
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Tilt / Rotation (Deg)</label>
					<div class="col-sm-2">
					  <input type="text" name="tilt" id="tilt" class="form-control numberdot" value="" placeholder="Tilt" size=4 maxlength=6>
					</div>
					<div class="col-sm-2">
					  <input type="text" name="rotation" id="rotation" class="form-control numberdot" value="" placeholder="Rotation" size=4 maxlength=6>
					</div>
            </div>
			<hr><ul><label class="form-label col-3 col-form-label"><b>Lamp Properties</b></label></ul>
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Product Code</label>
					<div class="col">
					  <select class="form-control find_cd" id="product_code" name="product_code">
				    	<option value="">No Selected</option>
				    </select>
					</div>
            </div>-->
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lamp</label>
					<div class="col">
						<input type="text" name="lamp" id="lamp" class="form-control" value="" placeholder="Lamp">
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Power (W)</label>
					<div class="col">
					  <input type="text" name="power" id="power" class="form-control numberdot" value="" placeholder="Power" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Voltage (V)</label>
					<div class="col">
					  <input type="text" name="voltage" id="voltage" class="form-control numberdot" value="" placeholder="Voltage" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lumen (Lm)</label>
					<div class="col">
					  <input type="text" name="lumen" id="lumen" class="form-control numberdot" value="" placeholder="Lumen" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">CCT (Kelvin)</label>
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
						<input type="text" name="sw" id="sw" class="form-control numberdot" value="" size=4 maxlength=6>
					</div>
			</div>
			<div class="form-group mb-3 row" id="show-tunablewhite" style="display:none;">
				<label class="form-label col-3 col-form-label">Tunable White</label>
					<div class="col-sm-2">
						<input type="text" name="tunable_white" id="tunable_white" class="form-control numberdot" value="" placeholder="Min" size=4 maxlength=6>
					 </div>
					 <div class="col-sm-2">
						<input type="text" name="tunable_white2" id="tunable_white2" class="form-control numberdot" value="" placeholder="Max" size=4 maxlength=6>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">CRI ></label>
					<div class="col">
					  <input type="text" name="cri" id="cri" class="form-control numberdot" value="" placeholder="CRI" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Optic</label>
					<div class="col">
						<select class="form-control find_optic" name="optic" id="optic">
                              <?php
									if(!empty($optical)) {
                                    foreach ($optical as $opticrw) { ?>
									<option value="<?php echo $opticrw->id_optic; ?>"><?php echo $opticrw->name_optic; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Beam Angle</label>
					<div class="col-sm-2">
						<input type="text" name="beam_angle" id="beam_angle" class="form-control numberdot" value="" placeholder="Beam" size=4 maxlength=6>
					 </div>
					 <div class="col-sm-2">
						<input type="text" name="beam_angleot" id="beam_angleot" class="form-control numberdot" value="" placeholder="Beam" size=4 maxlength=6>
					</div>
			</div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">SDCM / MacAdam</label>
					<div class="col">
					  <input type="text" name="sdcm" id="sdcm" class="form-control" value="" placeholder="SDCM">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lamp Lifetime</label>
					<div class="col">
					  <input type="text" name="lamp_lifetime" id="lamp_lifetime" class="form-control numberdot" value="" placeholder="Lamp Lifetime">
					</div>
            </div>
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kelvin</label>
					<div class="col">
					  <input type="text" name="kelvin" id="kelvin" class="form-control" value="" placeholder="Kelvin" size=4 maxlength=6>
					</div>
            </div>-->
			<hr><ul><label class="form-label col-3 col-form-label"><b>Lamp Dimension</b></label></ul>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Shape</label>
					<div class="col">
						<select class="form-control find_prshape" name="product_shape" id="product_shape">
						<option value="">No Selected</option>
								<?php foreach($shape as $row):?>
								<option value="<?php echo $row->idshape;?>"><?php echo $row->shape;?></option>
								<?php endforeach;?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Diameter</label>
					<div class="col">
					  <input type="text" name="dim_diameter" id="dim_diameter" class="form-control numberdot" value="" placeholder="Diameter" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Diameter</label>
					<div class="col">
					  <input type="text" name="dim_cut_o_diameter" id="dim_cut_o_diameter" class="form-control numberdot" value="" placeholder="Cut Out Diameter" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Square</label>
					<div class="col-sm-2">
					  <input type="text" name="cut_o_sq_lbr" id="cut_o_sq_lbr" class="form-control numberdot" value="" placeholder="Width" size=4 maxlength=6>					  
					</div>
					<div class="col-sm-2">					 
					  <input type="text" name="cut_o_sq_pjg" id="cut_o_sq_pjg" class="form-control numberdot" value="" placeholder="Length" size=4 maxlength=6>
					</div>
            </div>
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Opening</label>
					<div class="col">
					  <input type="text" name="dim_opening" id="dim_opening" class="form-control" value="" placeholder="Opening" size=4 maxlength=6>
					</div>
            </div>-->
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Height</label>
					<div class="col">
					  <input type="text" name="dim_height" id="dim_height" class="form-control numberdot" value="" placeholder="Height" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Width</label>
					<div class="col">
					  <input type="text" name="dim_width" id="dim_width" class="form-control numberdot" value="" placeholder="Width" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Length</label>
					<div class="col">
					  <input type="text" name="dim_length" id="dim_length" class="form-control numberdot" value="" placeholder="Length" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Weight</label>
					<div class="col">
					  <input type="text" name="dim_weight" id="dim_weight" class="form-control numberdot" value="" placeholder="Weight" size=4 maxlength=6>
					</div>
            </div>
					
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Recessed Depth</label>
					<div class="col">
					  <input type="text" name="dim_recc_depth" id="dim_recc_depth" class="form-control numberdot" value="" placeholder="Recessed Depth" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Housing Depth</label>
					<div class="col">
					  <input type="text" name="dim_depth_housing" id="dim_depth_housing" class="form-control numberdot" value="" placeholder="Depth + Housing" size=4 maxlength=6>
					</div>
            </div>
			<hr><ul><label class="form-label col-3 col-form-label"><b>Physical Properties</b></label></ul>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Reflector Material</label>
					<div class="col">
					  <input type="text" name="tecspec_reflector" id="tecspec_reflector" class="form-control" value="" placeholder="Reflector Material">
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
                <label class="form-label col-3 col-form-label">Body Material</label>
					<div class="col">
					  <input type="text" name="body_material" id="body_material" class="form-control" value="" placeholder="Body Material">
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
                <label class="form-label col-3 col-form-label">Trim</label>
					<div class="col">
					  <input type="text" name="tecspec_cover_trim" id="tecspec_cover_trim" class="form-control" value="" placeholder="Trim">
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Light Distribution</label>
					<div class="col">
					  <input type="text" name="tecspec_light_distr" id="tecspec_light_distr" class="form-control" value="" placeholder="Light Distribution">
					</div>
            </div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">IP</label>
					<div class="col">
					  <input type="text" name="tecspec_ip" id="tecspec_ip" class="form-control numberdot" value="" placeholder="IP" size=4 maxlength=6>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">UGR</label>
					<div class="col">
					  <input type="text" name="ugr_rating" id="ugr_rating" class="form-control numberdot" value="" placeholder="UGR RATTING" size=4 maxlength=6 >
					</div>
            </div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Instalation manual</label>
					<div class="col">
					  <input type="text" name="instalation_manual" id="instalation_manual" class="form-control" value="" placeholder="Instalation manual">
					</div>
            </div>
			
			<hr><ul><label class="form-label col-3 col-form-label"><b>Electrical Properties</b></label></ul>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Control</label>
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
                <label class="form-label col-3 col-form-label">Driver</label>
					<div class="col">
					  <input type="text" name="gears" id="gears" class="form-control" value="" placeholder="Driver">
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Brand Ref</label>
					<div class="col">
						<input type="text" name="brand_ref" id="brand_ref" class="form-control" value="" placeholder="Brand Ref">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Power Factor</label>
					<div class="col">
						<input type="text" name="power_fractor" id="power_fractor" class="form-control" value="" placeholder="Power Fractor">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">THD</label>
					<div class="col">
						<input type="text" name="thd" id="thd" class="form-control" value="" placeholder="THD">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lifetime</label>
					<div class="col">
						<input type="text" name="lifetime" id="lifetime" class="form-control" value="" placeholder="Lifetime">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Flicker Rate</label>
					<div class="col">
						<input type="text" name="flicker_rate" id="flicker_rate" class="form-control" value="" placeholder="Flicker Rate">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Driver IP</label>
					<div class="col">
						<input type="text" name="driver_ip" id="driver_ip" class="form-control" value="" placeholder="Driver IP">
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Additional Notes</label>
					<div class="col">
					  <input type="text" name="add_note" id="add_note" class="form-control" value="" placeholder="Additional Notes">
					</div>
            </div>
			<hr>			
		
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>Image(s) File</b></label>
					<div class="col-lg-12">
						<input type="file" class="form-control" name='files[]' multiple required />
						<i style="color:red">*Lampiran wajib diisi</i>
					</div>
			</div>
			
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>Dimension(s) File</b></label>
					<div class="col-lg-12">
						<input type="file" class="form-control" name='files_dimension[]' multiple />
					</div>
			</div>
			
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>Accesories File</b></label>
					<div class="col-lg-12">
						<input type="file" class="form-control" name='file_accesories[]' multiple />
					</div>
			</div>
			
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>Photometry File</b></label>
					<div class="col-lg-12">
						<input type="file" class="form-control" name='file_potometry[]' multiple />
					</div>
			</div>
			
			<div class="form-group mb-3 row">
				<label class="control-label col-lg-3"><b>Others File</b></label>
					<div class="col-lg-12">
						<input type="file" class="form-control" name='file_other[]' multiple />
					</div>
			</div>
                          
                      </div>
                    </div>
                  </div>
<!--
				 <div class="col-xl-6">
				 
				 <table id="mytable" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="20px;">No.</th>
						  <th>Luminaire Type</th>
						  <th>Luminaire Reference</th>
						  <th>Gears</th>
						  <th>Accesories</th>
						  <th>Height</th>
						  <th>Width</th>
						  <th>Length</th>
						  <th>Height</th>
						  <th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
		 
					<tfoot>
						<tr>
							<th width="20px;">No.</th>
						  <th>Luminaire Type</th>
						  <th>Luminaire Reference</th>
						  <th>Gears</th>
						  <th>Accesories</th>
						  <th>Height</th>
						  <th>Width</th>
						  <th>Length</th>
						  <th>Height</th>
						  <th>Action</th>
						</tr>
					</tfoot>
				</table>
				 
				 </div>	
				 -->			  
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

	<script type="text/javascript">
	
	$(document).ready(function() {				
		changeFunc();
		
		$('#id_product_brand').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('catalog/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].id_brand_type+'>'+data[i].name_type_brand+'</option>';
                        }
                        $('#product_code').html(html);

                    }
                });
                return false;
            });
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
		//alert(selectedValue);
			if (selectedValue=="1"){
			$('#show-staticwhite').show();
			}
			else {
			$('#show-staticwhite').hide();
			}
			
			if (selectedValue=="4"){
			$('#show-tunablewhite').show();
			}
			else {
			$('#show-tunablewhite').hide();
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


$('.numberdot').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"ddx");
    }
    $(this).val(val); 
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
