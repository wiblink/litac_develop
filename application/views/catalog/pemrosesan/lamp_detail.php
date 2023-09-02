<script>
$(document).ready(function () {
                        $(".find_pro").select2({
                            placeholder: "Project Name",
							allowClear: true
                        });
                    });
					
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
                  Detail Lamp
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
				<input type="hidden" name="idcart_group" tabindex="1" id="idcart_group" value=""/>
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			
<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Type</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='I' id="indoor" disabled>&nbsp;Indoor</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adv_lamp_side" value='O' id="outdoor" disabled>&nbsp;Outdoor</label>					
					</div>				
			</div>			
			<div class="form-group mb-3 row" id="show-indoor" style="display:none;">
				<label class="form-label col-3 col-form-label"> </label>
					<div class="col">
						<select class="form-control find_indoor" name="adv_cat_indoor" id="adv_cat_indoor" disabled style="width: 70%">
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
						<select class="form-control find_outdoor" name="adv_cat_outdoor" id="adv_cat_outdoor" disabled style="width: 70%">
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
						<select class="form-control find_pb id_product_brand" name="id_product_brand" id="id_product_brand" disabled>
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
						<select class="form-control find_bn id_brand_name" name="id_brand_name" id="id_brand_name" disabled>
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
						<input type="text" name="product_code" id="product_code" class="form-control" value="<?php echo $query->product_code; ?>" placeholder="Product Code" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Accesories</label>
					<div class="col">
					  <input type="text" name="accesories" id="accesories" class="form-control" value="<?php echo $query->accesories; ?>" placeholder="Accesories" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Adjustable Optic</label>
					<div class="col">
						<label class="radio-inline"><input type="radio" name="adjustable" value='A' id="adjustable" disabled>&nbsp;Adjustable</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="adjustable" value='F' id="fix" disabled>&nbsp;Fixed</label>					
					</div>				
			</div>	
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Tilt / Rotation (Deg)</label>
					<div class="col">
					  <input type="text" name="tilt" id="tilt" class="form-control numberdot" value="<?php echo $query->tilt; ?>" placeholder="Tilt" size=4 maxlength=5 disabled>
					</div>
					<div class="col">
					  <input type="text" name="rotation" id="rotation" class="form-control numberdot" value="<?php echo $query->rotation; ?>" placeholder="Rotation" size=4 maxlength=5 disabled>
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
						<input type="text" name="lamp" id="lamp" class="form-control" value="<?php echo $query->lamp; ?>" placeholder="Lamp" disabled>
					</div>
			</div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Power (W)</label>
					<div class="col">
					  <input type="text" name="power" id="power" class="form-control numberdot" value="<?php echo $query->power; ?>" placeholder="Power" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Voltage (V)</label>
					<div class="col">
					  <input type="text" name="voltage" id="voltage" class="form-control numberdot" value="<?php echo $query->voltage; ?>" placeholder="Voltage" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lumen (Lm)</label>
					<div class="col">
					  <input type="text" name="lumen" id="lumen" class="form-control numberdot" value="<?php echo $query->lumen; ?>" placeholder="Lumen" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">CCT (Kelvin)</label>
					<div class="col">
						<select class="form-control find_cct" name="cct" id="cct" onchange="changeFunc();" disabled>
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
						<input type="text" name="sw" id="sw" class="form-control numberdot" value="<?php echo $query->sw; ?>" size=4 maxlength=5 disabled>
					</div>
			</div>
			<div class="form-group mb-3 row" id="show-tunablewhite" style="display:none;">
				<label class="form-label col-3 col-form-label">Tunable White</label>
					<div class="col-sm-2">
						<input type="text" name="tunable_white" id="tunable_white" class="form-control numberdot" value="<?php echo $query->tunable_white; ?>" placeholder="Min" size=4 maxlength=6>
					 </div>
					 <div class="col-sm-2">
						<input type="text" name="tunable_white2" id="tunable_white2" class="form-control numberdot" value="<?php echo $query->tunable_white2; ?>" placeholder="Max" size=4 maxlength=6>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">CRI ></label>
					<div class="col">
					  <input type="text" name="cri" id="cri" class="form-control numberdot" value="<?php echo $query->cri; ?>" placeholder="CRI" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Optic</label>
					<div class="col">
						<select class="form-control find_optic" name="optic" id="optic" disabled>
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
						<input type="text" name="beam_angle" id="beam_angle" class="form-control numberdot" value="<?php echo $query->beam_angle; ?>" placeholder="Beam" size=4 maxlength=6 disabled>
					 </div>
					 <div class="col-sm-2">
						<input type="text" name="beam_angleot" id="beam_angleot" class="form-control numberdot" value="<?php echo $query->beam_angleot; ?>" placeholder="Beam" size=4 maxlength=6 disabled>
					</div>
			</div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">SDCM / MacAdam</label>
					<div class="col">
					  <input type="text" name="sdcm" id="sdcm" class="form-control" value="<?php echo $query->sdcm; ?>" placeholder="SDCM" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Lamp Lifetime</label>
					<div class="col">
					  <input type="text" name="lamp_lifetime" id="lamp_lifetime" class="form-control numberdot" value="<?php echo $query->lamp_lifetime; ?>" placeholder="Lamp Lifetime" disabled>
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
						<select class="form-control find_prshape" name="product_shape" id="product_shape" disabled>
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
					  <input type="text" name="dim_diameter" id="dim_diameter" class="form-control numberdot" value="<?php echo $query->dim_diameter; ?>" placeholder="Diameter" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Diameter</label>
					<div class="col">
					  <input type="text" name="dim_cut_o_diameter" id="dim_cut_o_diameter" class="form-control numberdot" value="<?php echo $query->dim_cut_o_diameter; ?>" placeholder="Cut Out Diameter" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Square</label>
					<div class="col-sm-2">
					  <input type="text" name="cut_o_sq_lbr" id="cut_o_sq_lbr" class="form-control numberdot" value="<?php echo $query->cut_o_sq_lbr; ?>" placeholder="Width" size=4 maxlength=6 disabled>					  
					</div>
					<div class="col-sm-2">					 
					  <input type="text" name="cut_o_sq_pjg" id="cut_o_sq_pjg" class="form-control numberdot" value="<?php echo $query->cut_o_sq_pjg; ?>" placeholder="Length" size=4 maxlength=6 disabled>
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
					  <input type="text" name="dim_height" id="dim_height" class="form-control numberdot" value="<?php echo $query->dim_height; ?>" placeholder="Height" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Width</label>
					<div class="col">
					  <input type="text" name="dim_width" id="dim_width" class="form-control numberdot" value="<?php echo $query->dim_width; ?>" placeholder="Width" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Length</label>
					<div class="col">
					  <input type="text" name="dim_length" id="dim_length" class="form-control numberdot" value="<?php echo $query->dim_length; ?>" placeholder="Length" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Weight</label>
					<div class="col">
					  <input type="text" name="dim_weight" id="dim_weight" class="form-control numberdot" value="<?php echo $query->dim_weight; ?>" placeholder="Weight" size=4 maxlength=5 disabled>
					</div>
            </div>
					
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Recessed Depth</label>
					<div class="col">
					  <input type="text" name="dim_recc_depth" id="dim_recc_depth" class="form-control numberdot" value="<?php echo $query->dim_recc_depth; ?>" placeholder="Recessed Depth" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Housing Depth</label>
					<div class="col">
					  <input type="text" name="dim_depth_housing" id="dim_depth_housing" class="form-control numberdot" value="<?php echo $query->dim_depth_housing; ?>" placeholder="Depth + Housing" size=4 maxlength=5 disabled >
					</div>
            </div>
			<hr><ul><label class="form-label col-3 col-form-label"><b>Physical Properties</b></label></ul>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Reflector Material</label>
					<div class="col">
					  <input type="text" name="tecspec_reflector" id="tecspec_reflector" class="form-control" value="<?php echo $query->tecspec_reflector; ?>" placeholder="Reflector Material" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Reflector Finish</label>
					<div class="col">
						<select class="form-control find_refl" name="reflector_finish" id="reflector_finish" disabled>
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
					  <input type="text" name="body_material" id="body_material" class="form-control" value="<?php echo $query->body_material; ?>" placeholder="Body Material" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Product Colour</label>
					<div class="col">
						<select class="form-control find_procol" name="product_colour" id="product_colour" disabled>
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
					  <input type="text" name="tecspec_cover_trim" id="tecspec_cover_trim" class="form-control" value="<?php echo $query->tecspec_cover_trim; ?>" placeholder="Trim" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Light Distribution</label>
					<div class="col">
					  <input type="text" name="tecspec_light_distr" id="tecspec_light_distr" class="form-control" value="<?php echo $query->tecspec_light_distr; ?>" placeholder="Light Distribution" disabled>
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
					  <input type="text" name="tecspec_ip" id="tecspec_ip" class="form-control numberdot" value="<?php echo $query->tecspec_ip; ?>" placeholder="IP" size=4 maxlength=5 disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">UGR</label>
					<div class="col">
					  <input type="text" name="ugr_rating" id="ugr_rating" class="form-control numberdot" value="<?php echo $query->ugr_rating; ?>" placeholder="UGR RATTING" size=4 maxlength=5 disabled>
					</div>
            </div>			
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Instalation manual</label>
					<div class="col">
					  <input type="text" name="instalation_manual" id="instalation_manual" class="form-control" value="<?php echo $query->instalation_manual; ?>" placeholder="Instalation manual" disabled>
					</div>
            </div>
			<hr><ul><label class="form-label col-3 col-form-label"><b>Electrical Properties</b></label></ul>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Control</label>
					<div class="col">
						<select class="form-control find_control" name="control" id="control" disabled>
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
					  <input type="text" name="gears" id="gears" class="form-control" value="<?php echo $query->gears; ?>" placeholder="Driver" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Brand Ref</label>
					<div class="col">
						<input type="text" name="brand_ref" id="brand_ref" class="form-control" value="<?php echo $query->brand_ref; ?>" placeholder="Brand Ref" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Power Factor</label>
					<div class="col">
						<input type="text" name="power_fractor" id="power_fractor" class="form-control" value="<?php echo $query->power_fractor; ?>" placeholder="Power Fractor" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">THD</label>
					<div class="col">
						<input type="text" name="thd" id="thd" class="form-control" value="<?php echo $query->thd; ?>" placeholder="THD" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lifetime</label>
					<div class="col">
						<input type="text" name="lifetime" id="lifetime" class="form-control" value="<?php echo $query->lifetime; ?>" placeholder="Lifetime" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Flicker Rate</label>
					<div class="col">
						<input type="text" name="flicker_rate" id="flicker_rate" class="form-control" value="<?php echo $query->flicker_rate; ?>" placeholder="Flicker Rate" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Driver IP</label>
					<div class="col">
						<input type="text" name="driver_ip" id="driver_ip" class="form-control" value="<?php echo $query->driver_ip; ?>" placeholder="Driver IP" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Additional Notes</label>
					<div class="col">
					  <input type="text" name="add_note" id="add_note" class="form-control" value="<?php echo $query->add_note; ?>" placeholder="Additional Notes" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Harga</label>
					<div class="col">
					  <input type="text" name="harga" id="harga" class="form-control" value="" placeholder="">
					</div>
            </div>
			<?php 
			$segmentcartid = $this->uri->segment(5);			
			$last = $this->uri->total_segments();
			$idcart = $this->uri->segment($last);
			//echo $segmentcartid;
			
			/* if(!empty($idcart))
							{
								$readonly = '';
							} else {
								$readonly = 'disabled';
							} */
			?>
			<div class="form-group mb-3 row" id="PnlProject">
				<label class="form-label col-3 col-form-label"><b>Project</b></label>
					<div class="col">
						<select class="form-control find_pro" name="project" id="project" <?php echo $readonly; ?>>
						<option value=""></option>
                            <?php
							
								if(!empty($project)) {
                                foreach ($project as $projectrw) { ?>
								<option value="<?php echo $projectrw->code; ?>" <?php if($projectrw->code == $idcart){echo "selected";} ?> ><?php echo $projectrw->project; ?></option>
							<?php } }?>
                        </select>
					</div>
			</div>
			
			
			<input type="hidden" name="idcart" id="idcart" value="<?php echo $idcart; ?>">
			<input type="hidden" name="segmentcartid" id="segmentcartid" value="<?php echo $segmentcartid; ?>">
			
			<div class="form-group mb-3 row">                
					<div class="col">
						<a href="../../advanced_search" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>&nbsp;&nbsp;
						<label><input type="checkbox" class="agree"> Edit</label>&nbsp;&nbsp;
						<button type="submit" name="btnupdatesave" id="btnupdatesave" class="btn btn-primary" >Save</button>&nbsp;&nbsp;
						<button type="submit" name="btnsaveas" id="btnsaveas" class="btn btn-primary" >Save As</button>&nbsp;&nbsp;
						<button type="submit" name="addcart" id="addcart" class="btn btn-outline-info"><svg class="icon" width="24" height="24" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg> Add To Cart</button>
					</div>
            </div>
                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
			  </form>
			 </div>
			</div>
		  </div>	
        </div>
				
		<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				<input type="hidden" name="tokenlampiran" id="tokenlampiran" value="<?php echo $query->lampiran; ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $query->id_lamp; ?>">
		
		
		
				<label class="control-label col-lg-3"><b>Image(s) File</b></label>
						<div class="col">
							 <input type="file" class="form-control" name='files[]' multiple />
						</div>
					<br>  
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
						
		
		<!------------------------------------------------dimension------------------------------------------------->
		
		<label class="control-label col-lg-3"><b>Dimension(s) File</b></label>
						<div class="col">
							 <input type="file" class="form-control" name='files_dimension[]' multiple />
						</div>
					<br>  
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
						
		<!----------------------------------------------------Accesories------------------------------------------------->
		
		<label class="control-label col-lg-3"><b>Accesories File</b></label>
						<div class="col">
							 <input type="file" class="form-control" name='file_accesories[]' multiple />
						</div>
					<br>  
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
						
		<!----------------------------------------------------Photometry------------------------------------------------->
		
		<label class="control-label col-lg-3"><b>Photometry File</b></label>
						<div class="col">
							 <input type="file" class="form-control" name='file_potometry[]' multiple />
						</div>
					<br>  
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
						
		<!----------------------------------------------------Others------------------------------------------------->
		
		<label class="control-label col-lg-3"><b>Others File</b></label>
						<div class="col">
							 <input type="file" class="form-control" name='file_other[]' multiple />
						</div>
					<br>  
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
						
		<button type="submit" name="btnupdatelampiran" class="btn btn-primary" style="float:right;">Update Lampiran</button>
        </form>
		
</div>
</div>
</div>

<script>
	$(document).ready(function() {
		//$('#btnupdatesave').prop('disabled', true);
		//$('#btnsaveas').prop('disabled', true);
		$('#indoor').prop('disabled', true);
				$('#outdoor').prop('disabled', true);
				$('#adv_lamp_side').prop('disabled', true);				
				$('#adv_cat_indoor').prop('disabled', true);
                $('#adv_cat_outdoor').prop('disabled', true);
				$('#luminaire_type').prop('disabled', true);
				$('#luminaire_ref').prop('disabled', true);
				$('#lamp').prop('disabled', true);
				$('#lamp_ref').prop('disabled', true);
				$('#gears').prop('disabled', true);
				$('#accesories').prop('disabled', true);
				$('#dim_height').prop('disabled', true);
				$('#dim_width').prop('disabled', true);
				$('#dim_length').prop('disabled', true);
				$('#dim_cut_o_diameter').prop('disabled', true);
				$('#cut_o_sq_lbr').prop('disabled', true);
				$('#cut_o_sq_pjg').prop('disabled', true);
				$('#dim_diameter').prop('disabled', true);
				$('#tecspec_housing').prop('disabled', true);
				$('#tecspec_light_distr').prop('disabled', true);
				$('#tecspec_adjustment').prop('disabled', true);
				$('#tecspec_approval').prop('disabled', true);
				$('#tecspec_transformer').prop('disabled', true);
				$('#instalation_manual').prop('disabled', true);
				$('#id_product_brand').prop('disabled', true);
				$('#product_code').prop('disabled', true);
				$('#id_brand_name').prop('disabled', true);				
				$('#control').prop('disabled', true);
				$('#product_shape').prop('disabled', true);
				$('#adjustable').prop('disabled', true);
				$('#fix').prop('disabled', true);
				$('#tilt').prop('disabled', true);
				$('#rotation').prop('disabled', true);
				$('#voltage').prop('disabled', true);
				$('#beam_angle').prop('disabled', true);
				$('#beam_angleot').prop('disabled', true);
				$('#dim_weight').prop('disabled', true);
				$('#dim_recc_depth').prop('disabled', true);
				$('#dim_depth_housing').prop('disabled', true);
				$('#tecspec_reflector').prop('disabled', true);
				$('#reflector_finish').prop('disabled', true);
				$('#body_material').prop('disabled', true);
				$('#product_colour').prop('disabled', true);
				$('#tecspec_cover_trim').prop('disabled', true);
				$('#sdcm').prop('disabled', true);
				$('#lamp_lifetime').prop('disabled', true);
				$('#tecspec_ip').prop('disabled', true);
				$('#ugr_rating').prop('disabled', true);
				
				$('#power').prop('disabled', true);
				$('#lumen').prop('disabled', true);
				$('#cct').prop('disabled', true);
				$('#sw').prop('disabled', true);
				$('#cri').prop('disabled', true);
				$('#optic').prop('disabled', true);
				
				$('#brand_ref').prop('disabled', true);
				$('#power_fractor').prop('disabled', true);
				$('#thd').prop('disabled', true);
				$('#lifetime').prop('disabled', true);
				$('#flicker_rate').prop('disabled', true);
				$('#driver_ip').prop('disabled', true);
				$('#add_note').prop('disabled', true);
				
		$('#btnupdatesave').toggle(false);
		$('#addcart').toggle(true);
		$('#PnlProject').toggle(true);
		$('#btnsaveas').toggle(false);
		 $(".agree").click(function(){
            if($(this).prop("checked") == true){
				$('#indoor').prop('disabled', false);
				$('#outdoor').prop('disabled', false);
				$('#adv_cat_indoor').prop('disabled', false);
                $('#adv_cat_outdoor').prop('disabled', false);
				$('#luminaire_type').prop('disabled', false);
				$('#luminaire_ref').prop('disabled', false);
				$('#lamp').prop('disabled', false);
				$('#lamp_ref').prop('disabled', false);
				$('#gears').prop('disabled', false);
				$('#accesories').prop('disabled', false);
				$('#dim_height').prop('disabled', false);
				$('#dim_width').prop('disabled', false);
				$('#dim_length').prop('disabled', false);
				$('#dim_cut_o_diameter').prop('disabled', false);
				$('#cut_o_sq_lbr').prop('disabled', false);
				$('#cut_o_sq_pjg').prop('disabled', false);
				$('#dim_diameter').prop('disabled', false);
				$('#tecspec_housing').prop('disabled', false);
				$('#tecspec_light_distr').prop('disabled', false);
				$('#tecspec_adjustment').prop('disabled', false);
				$('#tecspec_approval').prop('disabled', false);
				$('#tecspec_transformer').prop('disabled', false);
				$('#instalation_manual').prop('disabled', false);
				$('#id_product_brand').prop('disabled', false);
				$('#product_code').prop('disabled', false);
				$('#id_brand_name').prop('disabled', false);
				$('#control').prop('disabled', false);
				$('#product_shape').prop('disabled', false);
				$('#adjustable').prop('disabled', false);
				$('#fix').prop('disabled', false);
				$('#tilt').prop('disabled', false);
				$('#rotation').prop('disabled', false);
				$('#voltage').prop('disabled', false);
				$('#beam_angle').prop('disabled', false);
				$('#beam_angleot').prop('disabled', false);
				$('#dim_weight').prop('disabled', false);
				$('#dim_recc_depth').prop('disabled', false);
				$('#dim_depth_housing').prop('disabled', false);
				$('#tecspec_reflector').prop('disabled', false);
				$('#reflector_finish').prop('disabled', false);
				$('#body_material').prop('disabled', false);
				$('#product_colour').prop('disabled', false);
				$('#tecspec_cover_trim').prop('disabled', false);
				$('#sdcm').prop('disabled', false);
				$('#lamp_lifetime').prop('disabled', false);
				$('#tecspec_ip').prop('disabled', false);
				$('#ugr_rating').prop('disabled', false);
				
				$('#power').prop('disabled', false);
				$('#lumen').prop('disabled', false);
				$('#cct').prop('disabled', false);
				$('#sw').prop('disabled', false);
				$('#cri').prop('disabled', false);
				$('#optic').prop('disabled', false);
				
				$('#brand_ref').prop('disabled', false);
				$('#power_fractor').prop('disabled', false);
				$('#thd').prop('disabled', false);
				$('#lifetime').prop('disabled', false);
				$('#flicker_rate').prop('disabled', false);
				$('#driver_ip').prop('disabled', false);
				$('#add_note').prop('disabled', false);
				
				$('#addcart').toggle(false);
				$('#PnlProject').toggle(false);
				$('#btnupdatesave').toggle(true);
				$('#btnsaveas').toggle(true);
				
            }
            else if($(this).prop("checked") == false){
				$('#indoor').prop('disabled', true);
				$('#outdoor').prop('disabled', true);
				$('#adv_lamp_side').prop('disabled', true);				
				$('#adv_cat_indoor').prop('disabled', true);
                $('#adv_cat_outdoor').prop('disabled', true);
				$('#luminaire_type').prop('disabled', true);
				$('#luminaire_ref').prop('disabled', true);
				$('#lamp').prop('disabled', true);
				$('#lamp_ref').prop('disabled', true);
				$('#gears').prop('disabled', true);
				$('#accesories').prop('disabled', true);
				$('#dim_height').prop('disabled', true);
				$('#dim_width').prop('disabled', true);
				$('#dim_length').prop('disabled', true);
				$('#dim_cut_o_diameter').prop('disabled', true);
				$('#cut_o_sq_lbr').prop('disabled', true);
				$('#cut_o_sq_pjg').prop('disabled', true);
				$('#dim_diameter').prop('disabled', true);
				$('#tecspec_housing').prop('disabled', true);
				$('#tecspec_light_distr').prop('disabled', true);
				$('#tecspec_adjustment').prop('disabled', true);
				$('#tecspec_approval').prop('disabled', true);
				$('#tecspec_transformer').prop('disabled', true);
				$('#instalation_manual').prop('disabled', true);
				$('#id_product_brand').prop('disabled', true);
				$('#product_code').prop('disabled', true);
				$('#id_brand_name').prop('disabled', true);
				$('#control').prop('disabled', true);
				$('#product_shape').prop('disabled', true);
				$('#adjustable').prop('disabled', true);
				$('#fix').prop('disabled', true);
				$('#tilt').prop('disabled', true);
				$('#rotation').prop('disabled', true);
				$('#voltage').prop('disabled', true);
				$('#beam_angle').prop('disabled', true);
				$('#beam_angleot').prop('disabled', true);
				$('#dim_weight').prop('disabled', true);
				$('#dim_recc_depth').prop('disabled', true);
				$('#dim_depth_housing').prop('disabled', true);
				$('#tecspec_reflector').prop('disabled', true);
				$('#reflector_finish').prop('disabled', true);
				$('#body_material').prop('disabled', true);
				$('#product_colour').prop('disabled', true);
				$('#tecspec_cover_trim').prop('disabled', true);
				$('#sdcm').prop('disabled', true);
				$('#lamp_lifetime').prop('disabled', true);
				$('#tecspec_ip').prop('disabled', true);
				$('#ugr_rating').prop('disabled', true);
				
				$('#power').prop('disabled', true);
				$('#lumen').prop('disabled', true);
				$('#cct').prop('disabled', true);
				$('#sw').prop('disabled', true);
				$('#cri').prop('disabled', true);
				$('#optic').prop('disabled', true);
				
				$('#brand_ref').prop('disabled', true);
				$('#power_fractor').prop('disabled', true);
				$('#thd').prop('disabled', true);
				$('#lifetime').prop('disabled', true);
				$('#flicker_rate').prop('disabled', true);
				$('#driver_ip').prop('disabled', true);
				$('#add_note').prop('disabled', true);
				
				$('#addcart').toggle(true);
				$('#PnlProject').toggle(true);
				$('#btnupdatesave').toggle(false);
				$('#btnsaveas').toggle(false);
				
            }
        });
		
		
	});
	
	</script>
	
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
			
			if (selectedValue=="4"){
			$('#show-tunablewhite').show();
			}
			else {
			$('#show-tunablewhite').hide();
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
	
		var harga = document.getElementById('harga');
		harga.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatharga() untuk mengubah angka yang di ketik menjadi format angka
			harga.value = formatharga(this.value, 'Rp. ');
		});
 
		/* Fungsi formatharga */
		function formatharga(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			harga     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				harga += separator + ribuan.join('.');
			}
 
			harga = split[1] != undefined ? harga + ',' + split[1] : harga;
			return prefix == undefined ? harga : (harga ? 'Rp. ' + harga : '');
		}
		
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