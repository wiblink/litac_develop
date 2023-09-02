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
                        $(".find_bn").select2({
                            placeholder: "Product Brand Name",
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
                  Update Lamp
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
				<input type="hidden" name="idlamp" id="idlamp" class="form-control" value="<?php echo $query->id_lamp; ?>">
				<input type="hidden" name="getproduct_code" id="getproduct_code" value="<?php echo $query->product_code; ?>">
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Type</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='I' id="indoor" >&nbsp;Indoor</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='O' id="outdoor" >&nbsp;Outdoor</label>					
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
                                        <option value="<?php echo $baris->id_product_type; ?>" <?php if($baris->id_product_type == $query->adv_cat_indoor){echo "selected";} ?>><?php echo $baris->name_product_type; ?></option>
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
									<option value="<?php echo $baris->id_product_type; ?>" <?php if($baris->id_product_type == $query->adv_cat_indoor){echo "selected";} ?>><?php echo $baris->name_product_type; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Brand</label>
					<div class="col">
						<select class="form-control find_pb id_product_brand" name="id_product_brand" id="id_product_brand" >
							<option value="">No Selected</option>
							<?php foreach($branddt as $row):?>
							<option value="<?php echo $row->id_brand;?>" <?php if($row->id_brand == $query->id_product_brand){echo "selected";} ?>><?php echo $row->name_product_brand;?></option>
							<?php endforeach;?>
						</select>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Product Name</label>
					<div class="col">
						<select class="form-control find_bn id_brand_name" name="id_brand_name" id="id_brand_name" >
							<option value="">No Selected</option>
							<?php foreach($brandnamedt as $row):?>
							<option value="<?php echo $row->id_brand_name;?>" <?php if($row->id_brand_name == $query->id_brand_name){echo "selected";} ?>><?php echo $row->product_brand_name;?></option>
							<?php endforeach;?>
						</select>
						
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Code</label>
					<div class="col">
						<input type="text" name="product_code" id="product_code" class="form-control" value="<?php echo $query->product_code; ?>" placeholder="Product Code" >
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Accesories</label>
					<div class="col">
					  <input type="text" name="accesories" id="accesories" class="form-control" value="<?php echo $query->accesories; ?>" placeholder="Accesories" >
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Adjustable Optic</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adjustable" value='A' id="adjustable" >&nbsp;Adjustable</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adjustable" value='F' id="fix" >&nbsp;Fixed</label>					
					</div>				
			</div>	
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Tilt / Rotation (Deg)</label>
					<div class="col">
					  <input type="text" name="tilt" id="tilt" class="form-control" value="<?php echo $query->tilt; ?>" placeholder="Tilt" size=4 maxlength=5 >
					</div>
					<div class="col">
					  <input type="text" name="rotation" id="rotation" class="form-control" value="<?php echo $query->rotation; ?>" placeholder="Rotation" size=4 maxlength=5 >
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
			<hr><ul><label class="form-label col-3 col-form-label"><b>Lamp Properties</b></label></ul>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lamp</label>
					<div class="col">
						<input type="text" name="lamp" id="lamp" class="form-control" value="<?php echo $query->lamp; ?>" placeholder="Lamp" >
					</div>
			</div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Power (W)</label>
					<div class="col">
					  <input type="text" name="power" id="power" class="form-control" value="<?php echo $query->power; ?>" placeholder="Power" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Voltage (V)</label>
					<div class="col">
					  <input type="text" name="voltage" id="voltage" class="form-control" value="<?php echo $query->voltage; ?>" placeholder="Voltage" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lumen (Lm)</label>
					<div class="col">
					  <input type="text" name="lumen" id="lumen" class="form-control" value="<?php echo $query->lumen; ?>" placeholder="Lumen" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">CCT (Kelvin)</label>
					<div class="col">
						<select class="form-control find_cct" name="cct" id="cct" onchange="changeFunc();" >
                              <?php
									if(!empty($cct)) {
                                    foreach ($cct as $ctrow) { ?>
									<option value="<?php echo $ctrow->id_cct; ?>" <?php if($ctrow->id_cct == $query->cct){echo "selected";} ?>><?php echo $ctrow->color_temperature; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>			
			<div class="form-group mb-3 row" id="show-staticwhite" style="display:none;">
				<label class="form-label col-3 col-form-label"> </label>
					<div class="col">
						<input type="text" name="sw" id="sw" class="form-control" value="<?php echo $query->sw; ?>" size=4 maxlength=5 >
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">CRI ></label>
					<div class="col">
					  <input type="text" name="cri" id="cri" class="form-control" value="<?php echo $query->cri; ?>" placeholder="CRI" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Optic</label>
					<div class="col">
						<select class="form-control find_optic" name="optic" id="optic" >
                              <?php
									if(!empty($optical)) {
                                    foreach ($optical as $opticrw) { ?>
									<option value="<?php echo $opticrw->id_optic; ?>" <?php if($opticrw->id_optic == $query->optic){echo "selected";} ?>><?php echo $opticrw->name_optic; ?></option>
									<?php } }?>optic
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Beam Angle</label>
					<div class="col-sm-2">
						<input type="text" name="beam_angle" id="beam_angle" class="form-control numberdot" value="<?php echo $query->beam_angle; ?>" placeholder="Beam" size=4 maxlength=6 >
					 </div>
					 <div class="col-sm-2">
						<input type="text" name="beam_angleot" id="beam_angleot" class="form-control numberdot" value="<?php echo $query->beam_angleot; ?>" placeholder="Beam" size=4 maxlength=6 >
					</div>
			</div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">SDCM / MacAdam</label>
					<div class="col">
					  <input type="text" name="sdcm" id="sdcm" class="form-control" value="<?php echo $query->sdcm; ?>" placeholder="SDCM" >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lamp Lifetime</label>
					<div class="col">
					  <input type="text" name="lamp_lifetime" id="lamp_lifetime" class="form-control numberdot" value="<?php echo $query->lamp_lifetime; ?>" placeholder="Lamp Lifetime" >
					</div>
            </div>
			
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Kelvin</label>
					<div class="col">
					  <input type="text" name="kelvin" id="kelvin" class="form-control" value="" placeholder="Kelvin" size=4 maxlength=5>
					</div>
            </div>-->
			<hr><ul><label class="form-label col-3 col-form-label"><b>Lamp Dimension</b></label></ul>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Shape</label>
					<div class="col">
						<select class="form-control find_prshape" name="product_shape" id="product_shape" >
							<option value="">No Selected</option>
							<?php foreach($shape as $row):?>
							<option value="<?php echo $row->idshape;?>" <?php if($row->idshape == $query->product_shape){echo "selected";} ?>><?php echo $row->shape;?></option>
							<?php endforeach;?>
						</select>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Diameter</label>
					<div class="col">
					  <input type="text" name="dim_diameter" id="dim_diameter" class="form-control" value="<?php echo $query->dim_diameter; ?>" placeholder="Diameter" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Diameter</label>
					<div class="col">
					  <input type="text" name="dim_cut_o_diameter" id="dim_cut_o_diameter" class="form-control" value="<?php echo $query->dim_cut_o_diameter; ?>" placeholder="Cut Out Diameter" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Square</label>
					<div class="col-sm-2">
					  <input type="text" name="cut_o_sq_lbr" id="cut_o_sq_lbr" class="form-control numberdot" value="<?php echo $query->cut_o_sq_lbr; ?>" placeholder="Width" size=4 maxlength=6 >					  
					</div>
					<div class="col-sm-2">					 
					  <input type="text" name="cut_o_sq_pjg" id="cut_o_sq_pjg" class="form-control numberdot" value="<?php echo $query->cut_o_sq_pjg; ?>" placeholder="Length" size=4 maxlength=6 >
					</div>
            </div>
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Opening</label>
					<div class="col">
					  <input type="text" name="dim_opening" id="dim_opening" class="form-control" value="" placeholder="Opening" size=4 maxlength=5>
					</div>
            </div>-->
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Height</label>
					<div class="col">
					  <input type="text" name="dim_height" id="dim_height" class="form-control" value="<?php echo $query->dim_height; ?>" placeholder="Height" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Width</label>
					<div class="col">
					  <input type="text" name="dim_width" id="dim_width" class="form-control" value="<?php echo $query->dim_width; ?>" placeholder="Width" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Length</label>
					<div class="col">
					  <input type="text" name="dim_length" id="dim_length" class="form-control" value="<?php echo $query->dim_length; ?>" placeholder="Length" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Weight</label>
					<div class="col">
					  <input type="text" name="dim_weight" id="dim_weight" class="form-control" value="<?php echo $query->dim_weight; ?>" placeholder="Weight" size=4 maxlength=5 >
					</div>
            </div>
					
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Recessed Depth</label>
					<div class="col">
					  <input type="text" name="dim_recc_depth" id="dim_recc_depth" class="form-control" value="<?php echo $query->dim_recc_depth; ?>" placeholder="Recessed Depth" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Housing Depth</label>
					<div class="col">
					  <input type="text" name="dim_depth_housing" id="dim_depth_housing" class="form-control" value="<?php echo $query->dim_depth_housing; ?>" placeholder="Depth + Housing" size=4 maxlength=5  >
					</div>
            </div>
			<hr><ul><label class="form-label col-3 col-form-label"><b>Physical Properties</b></label></ul>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Reflector Material</label>
					<div class="col">
					  <input type="text" name="tecspec_reflector" id="tecspec_reflector" class="form-control" value="<?php echo $query->tecspec_reflector; ?>" placeholder="Reflector Material" >
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Reflector Finish</label>
					<div class="col">
						<select class="form-control find_refl" name="reflector_finish" id="reflector_finish" >
                              <option value=""></option>
                              <?php
									if(!empty($refl_finish)) {
                                    foreach ($refl_finish as $baris) { ?>
									<option value="<?php echo $baris->id_ref_finish; ?>" <?php if($baris->id_ref_finish == $query->reflector_finish){echo "selected";} ?>><?php echo $baris->name_ref_finish; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Body Material</label>
					<div class="col">
					  <input type="text" name="body_material" id="body_material" class="form-control" value="<?php echo $query->body_material; ?>" placeholder="Body Material" >
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Colour</label>
					<div class="col">
						<select class="form-control find_procol" name="product_colour" id="product_colour" >
                              <option value=""></option>
                              <?php
									if(!empty($procol)) {
                                    foreach ($procol as $row) { ?>
									<option value="<?php echo $row->id_product_colour; ?>" <?php if($row->id_product_colour == $query->product_colour){echo "selected";} ?>><?php echo $row->name_product_colour; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>			
			
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lamp Holder</label>
					<div class="col">
					  <input type="text" name="tecspec_lamp_holder" id="tecspec_lamp_holder" class="form-control" value="" placeholder="Lamp Holder">
					</div>
            </div>-->
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Trim</label>
					<div class="col">
					  <input type="text" name="tecspec_cover_trim" id="tecspec_cover_trim" class="form-control" value="<?php echo $query->tecspec_cover_trim; ?>" placeholder="Trim" >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Light Distribution</label>
					<div class="col">
					  <input type="text" name="tecspec_light_distr" id="tecspec_light_distr" class="form-control" value="<?php echo $query->tecspec_light_distr; ?>" placeholder="Light Distribution" >
					</div>
            </div>
			
			
			<!--<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Transformer</label>
					<div class="col">
					  <input type="text" name="tecspec_transformer" id="tecspec_transformer" class="form-control" value="" placeholder="Transformer">
					</div>
            </div>-->
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">IP</label>
					<div class="col">
					  <input type="text" name="tecspec_ip" id="tecspec_ip" class="form-control" value="<?php echo $query->tecspec_ip; ?>" placeholder="IP" size=4 maxlength=5 >
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">UGR</label>
					<div class="col">
					  <input type="text" name="ugr_rating" id="ugr_rating" class="form-control" value="<?php echo $query->ugr_rating; ?>" placeholder="UGR RATTING" size=4 maxlength=5 >
					</div>
            </div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Instalation manual</label>
					<div class="col">
					  <input type="text" name="instalation_manual" id="instalation_manual" class="form-control" value="<?php echo $query->instalation_manual; ?>" placeholder="Instalation manual" >
					</div>
            </div>
			<hr><ul><label class="form-label col-3 col-form-label"><b>Electrical Properties</b></label></ul>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Control</label>
					<div class="col">
						<select class="form-control find_control" name="control" id="control" >
                              <option value=""></option>
                              <?php
									if(!empty($controldt)) {
                                    foreach ($controldt as $row) { ?>
									<option value="<?php echo $row->id_control; ?>" <?php if($row->id_control == $query->id_control){echo "selected";} ?>><?php echo $row->name_control; ?></option>
									<?php } }?>
                        </select>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Driver</label>
					<div class="col">
					  <input type="text" name="gears" id="gears" class="form-control" value="<?php echo $query->gears; ?>" placeholder="Driver" >
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Brand Ref</label>
					<div class="col">
						<input type="text" name="brand_ref" id="brand_ref" class="form-control" value="<?php echo $query->brand_ref; ?>" placeholder="Brand Ref" >
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Power Factor</label>
					<div class="col">
						<input type="text" name="power_fractor" id="power_fractor" class="form-control" value="<?php echo $query->power_fractor; ?>" placeholder="Power Fractor" >
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">THD</label>
					<div class="col">
						<input type="text" name="thd" id="thd" class="form-control" value="<?php echo $query->thd; ?>" placeholder="THD" >
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lifetime</label>
					<div class="col">
						<input type="text" name="lifetime" id="lifetime" class="form-control" value="<?php echo $query->lifetime; ?>" placeholder="Lifetime" >
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Flicker Rate</label>
					<div class="col">
						<input type="text" name="flicker_rate" id="flicker_rate" class="form-control" value="<?php echo $query->flicker_rate; ?>" placeholder="Flicker Rate" >
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Driver IP</label>
					<div class="col">
						<input type="text" name="driver_ip" id="driver_ip" class="form-control" value="<?php echo $query->driver_ip; ?>" placeholder="Driver IP" >
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Additional Notes</label>
					<div class="col">
					  <input type="text" name="add_note" id="add_note" class="form-control" value="<?php echo $query->add_note; ?>" placeholder="Additional Notes" >
					</div>
            </div>
				</div>
                    </div>
                  </div>
			  
                </div>
              </div>  
              <div class="card-footer text-end">
                <div class="d-flex">
                  <a href="<?php echo base_url();?>catalog/lamp" class="btn btn-link">Cancel</a>
                  <button type="submit" name="btnupdate" id="submit-all" class="btn btn-primary ms-auto" style="float:right;"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Update</button>
                </div>
              </div>
			  
                </form>
               
              </div>
            </div>
          </div>
        </div>
</div>
</div>
</div>
<br>

		  <div class="row row-deck row-cards">
           <div class="col-11">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All File</h3>
                </div>
                
				<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				<input type="hidden" name="tokenlampiran" id="tokenlampiran" value="<?php echo $query->lampiran; ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $query->id_lamp; ?>">
				
				<div class="card-body">
				<div class="card-header">
                  <h3 class="card-title">Image(s) File</h3>
                </div>
					<div class="form-group mb-3 row">               
						<div class="col">
							 <input type="file" class="form-control" name='files[]' multiple />
						</div>
					</div>
					
					<div class="mb-3">
					<div class="col">
                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Image(s)</b></th>
                            <th width='10%'><b>Action</b></th>
                          </tr>
                          <?php
						  $idlampiran = $query->lampiran.'_imgmenu';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
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
							  <div>
							  <?php echo $baris->nama_berkas; ?>
							  
							  </div>                      
							</div>
						  </div>
						</div>
						</div>	  
							  </td>
                              <td>
							  <a href="<?php echo base_url();?>catalog/lamp/thumb/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
								  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
								  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
								</svg> Thumbnail</a><br>
							  <br>
							  <a href="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg></a> <br>
							  <br>
							  <a href="<?php echo base_url();?>catalog/lamp/del/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
							  </td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>		
				</div>

				<div class="card-body">
				<div class="card-header">
                  <h3 class="card-title">Dimension(s) File</h3>
                </div>
					<div class="form-group mb-3 row">               
						<div class="col">
							 <input type="file" class="form-control" name='files_dimension[]' multiple />
						</div>
					</div>
					
					<div class="mb-3">
					<div class="col">
                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Image(s)</b></th>
                            <th width='10%'><b>Action</b></th>
                          </tr>
                          <?php
						   $idlampiran = $query->lampiran.'_dimensi';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
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
							  <div>
							  <?php echo $baris->nama_berkas; ?>
							  
							  </div>                      
							</div>
						  </div>
						</div>
						</div>	  
							  </td>
                              <td>
							  <a href="<?php echo base_url();?>catalog/lamp/thumb/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
								  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
								  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
								</svg> Thumbnail</a><br>
							  <br>
							  <a href="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg></a> <br>
							  <br>
							  <a href="<?php echo base_url();?>catalog/lamp/del/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
							  </td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>		
				</div>
				
				<div class="card-body">
				<div class="card-header">
                  <h3 class="card-title">Accesories File</h3>
                </div>
					<div class="form-group mb-3 row">
						<div class="col">
							 <input type="file" class="form-control" name='file_accesories[]' multiple />
						</div>
					</div>
					
					<div class="mb-3">
					<div class="col">
                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Image(s)</b></th>
                            <th width='10%'><b>Action</b></th>
                          </tr>
                          <?php
						  $idlampiran = $query->lampiran.'_aksesori';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
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
							  <div>
							  <?php echo $baris->nama_berkas; ?>
							  
							  </div>                      
							</div>
						  </div>
						</div>
						</div>	  
							  </td>
                              <td>
							  <a href="<?php echo base_url();?>catalog/lamp/thumb/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
								  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
								  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
								</svg> Thumbnail</a><br>
							  <br>
							  <a href="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg></a> <br>
							  <br>
							  <a href="<?php echo base_url();?>catalog/lamp/del/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
							  </td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>		
				</div>
				
				<div class="card-body">
				<div class="card-header">
                  <h3 class="card-title">Photometry File</h3>
                </div>
					<div class="form-group mb-3 row">               
						<div class="col">
							 <input type="file" class="form-control" name='file_potometry[]' multiple />
						</div>
					</div>
					
					<div class="mb-3">
					<div class="col">
                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Image(s)</b></th>
                            <th width='10%'><b>Action</b></th>
                          </tr>
                          <?php
						  $idlampiran = $query->lampiran.'_potometri';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
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
							  <div>
							  <?php echo $baris->nama_berkas; ?>
							  
							  </div>                      
							</div>
						  </div>
						</div>
						</div>	  
							  </td>
                              <td>
							  <a href="<?php echo base_url();?>catalog/lamp/thumb/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
								  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
								  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
								</svg> Thumbnail</a><br>
							  <br>
							  <a href="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg></a> <br>
							  <br>
							  <a href="<?php echo base_url();?>catalog/lamp/del/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
							  </td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>		
				</div>
                    
				<div class="card-body">
				<div class="card-header">
                  <h3 class="card-title">Others File</h3>
                </div>
					<div class="form-group mb-3 row">               
						<div class="col">
							 <input type="file" class="form-control" name='file_other[]' multiple />
						</div>
					</div>
					
					<div class="mb-3">
					<div class="col">
                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Image(s)</b></th>
                            <th width='10%'><b>Action</b></th>
                          </tr>
                          <?php
						  $idlampiran = $query->lampiran.'_other';
						  $lampiran = json_decode(ecurl('GET','lampiran/'.$idlampiran))->data;
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
							  <div>
							  <?php echo $baris->nama_berkas; ?>
							  
							  </div>                      
							</div>
						  </div>
						</div>
						</div>	  
							  </td>
                              <td>
							  <a href="<?php echo base_url();?>catalog/lamp/thumb/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
								  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
								  <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
								</svg> Thumbnail</a><br>
							  <br>
							  <a href="<?php echo base_url();?>lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg></a> <br>
							  <br>
							  <a href="<?php echo base_url();?>catalog/lamp/del/<?php echo $baris->id.'_'.$query->id_lamp; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
							  </td>
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>		
				</div>
				
                    <button type="submit" name="btnupdatelampiran" class="btn btn-primary" style="float:right;">Update Lampiran</button>
                </form>
               
              </div>
            </div>
          </div>
		  
</div>
<script type="text/javascript">

	$(document).ready(function() {
		
//var getproduct_code = "<?php echo $query->product_code; ?>";
			
			get_nested_data_edit();
//alert (getproduct_code);
				//alert (getproduct_code);
			$('.id_product_brand').change(function(){ 
		
                var id=$(this).val();
               var getproduct_code = "<?php echo $query->product_code; ?>";
				//alert (getproduct_code);
                $.ajax({
                    url : "<?php echo site_url('catalog/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){

                        $('select[name="product_code"]').empty();

                        $.each(data, function(key, value) {
                            if(getproduct_code==value.id_brand_type){
                                $('select[name="product_code"]').append('<option value="'+ value.id_brand_type +'" selected>'+ value.name_type_brand +'</option>').trigger('change');
                            }else{
                                $('select[name="product_code"]').append('<option value="'+ value.id_brand_type +'">'+ value.name_type_brand +'</option>');
                            }
                        });

                    }
                });
                return false;
            });
			
		function get_nested_data_edit(){
            	var id = $('[name="idlamp"]').val();
            	$.ajax({
            		url : "<?php echo site_url('catalog/get_nested_data_edit');?>",
                    method : "POST",
                    data :{id: id},
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
						    //$('[name="product_name"]').val(data[i].xxx);
                            $('[name="id_product_brand"]').val(data[i].id_product_brand).trigger('change');
                            $('[name="product_code"]').val(data[i].product_code).trigger('change');
                            //$('[name="product_price"]').val(data[i].xx);
                        });
                    }

            	});
            }
			
				
		var $radios = $('input:radio[name=adv_lamp_side]');
        if($radios.is(':checked') === false) {
        $radios.filter('[value=<?php echo $query->adv_lamp_side; ?>]').prop('checked', true);
        }
		
		<?php
		if($query->adv_lamp_side == 'O')
		{
		echo "
			$('#show-outdoor').show();
            $('#show-indoor').hide(); 
		";
		} 
		
		if($query->adv_lamp_side == 'I')
		{
		echo "
			$('#show-indoor').show();
			$('#show-outdoor').hide();	
		";
		}
		?>
		
		changeFunc();
				
		var $radioadj = $('input:radio[name=adjustable]');
        if($radioadj.is(':checked') === false) {
        $radioadj.filter('[value=<?php echo $query->adjustable; ?>]').prop('checked', true);
        }
			
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

$('.numberdot').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
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