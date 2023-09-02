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
			<!--<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Project</label>
					<div class="col">
						<input type="text" name="project" id="project" class="form-control" value="<?php echo $query->project; ?>" placeholder="Project" disabled>
					</div>
			</div>-->
			
            <div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Luminaire Type</label>
					<div class="col">
						<input type="text" name="luminaire_type" id="luminaire_type" class="form-control" value="<?php echo $query->luminaire_type; ?>" placeholder="Luminaire Type" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Luminaire Reference</label>
					<div class="col">
						<input type="text" name="luminaire_ref" id="luminaire_ref" class="form-control" value="<?php echo $query->luminaire_ref; ?>" placeholder="Luminaire Reference" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lamp</label>
					<div class="col">
						<input type="text" name="lamp" id="lamp" class="form-control" value="<?php echo $query->lamp; ?>" placeholder="Lamp" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Lamp Reference</label>
					<div class="col">
						<input type="text" name="lamp_ref" id="lamp_ref" class="form-control" value="<?php echo $query->lamp_ref; ?>" placeholder="Lamp Reference" disabled>
					</div>
			</div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Gears</label>
					<div class="col">
					  <input type="text" name="gears" id="gears" class="form-control" value="<?php echo $query->gears; ?>" placeholder="Gears" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Accesories</label>
					<div class="col">
					  <input type="text" name="accesories" id="accesories" class="form-control" value="<?php echo $query->accesories; ?>" placeholder="Accesories" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Dimension Height</label>
					<div class="col">
					  <input type="text" name="dim_height" id="dim_height" class="form-control" value="<?php echo $query->dim_height; ?>" placeholder="Dimension Height" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Dimension Width</label>
					<div class="col">
					  <input type="text" name="dim_width" id="dim_width" class="form-control" value="<?php echo $query->dim_width; ?>" placeholder="Dimension Width" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Dimension Length</label>
					<div class="col">
					  <input type="text" name="dim_length" id="dim_length" class="form-control" value="<?php echo $query->dim_length; ?>" placeholder="Dimension Length" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Cut Out Diameter</label>
					<div class="col">
					  <input type="text" name="dim_cut_o_diameter" id="dim_cut_o_diameter" class="form-control" value="<?php echo $query->dim_cut_o_diameter; ?>" placeholder="Cut Out Diameter" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Diameter</label>
					<div class="col">
					  <input type="text" name="dim_diameter" id="dim_diameter" class="form-control" value="<?php echo $query->dim_diameter; ?>" placeholder="Diameter" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Housing</label>
					<div class="col">
					  <input type="text" name="tecspec_housing" id="tecspec_housing" class="form-control" value="<?php echo $query->tecspec_housing; ?>" placeholder="Housing" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Light Distribution</label>
					<div class="col">
					  <input type="text" name="tecspec_light_distr" id="tecspec_light_distr" class="form-control" value="<?php echo $query->tecspec_light_distr; ?>" placeholder="Light Distribution" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Adjustment</label>
					<div class="col">
					  <input type="text" name="tecspec_adjustment" id="tecspec_adjustment" class="form-control" value="<?php echo $query->tecspec_adjustment; ?>" placeholder="Adjustment" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Approval</label>
					<div class="col">
					  <input type="text" name="tecspec_approval" id="tecspec_approval" class="form-control" value="<?php echo $query->tecspec_approval; ?>" placeholder="Approval" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Transformer</label>
					<div class="col">
					  <input type="text" name="tecspec_transformer" id="tecspec_transformer" class="form-control" value="<?php echo $query->tecspec_transformer; ?>" placeholder="Transformer" disabled>
					</div>
            </div>
			<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Instalation manual</label>
					<div class="col">
					  <input type="text" name="instalation_manual" id="instalation_manual" class="form-control" value="<?php echo $query->instalation_manual; ?>" placeholder="Instalation manual" disabled>
					</div>
            </div>								
			<div class="form-group mb-3 row">                
					<div class="col">
						<a href="../../lamp" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>&nbsp;&nbsp;
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
				
              </div>
            </div>
          </div>
		  <br>
		  <div class="row row-deck row-cards">
           <div class="col-11">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Image(s) File</h3>
                </div>
                
				<input type="hidden" name="tokenlampiran" id="tokenlampiran" value="<?php echo $query->lampiran; ?>">
				<input type="hidden" name="id" id="id" value="<?php echo $query->id_lamp; ?>">
				<div class="card-body">
					<div class="mb-3">
					<div class="col">
                      
						<div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable" width="80%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Image(s)</b></th>
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
                            </tr>
                          <?php
                            $no++;
						 } }?>
                        </table>
    					</div>
						</div>
                    </div>
					
					
			
				</div>  
              </div>
            </div>
          </div>
        </div>
</div>

<script>
	$(document).ready(function() {
		$('#btnupdatesave').prop('disabled', true);
		$('#btnsaveas').prop('disabled', true);
		 $(".agree").click(function(){
            if($(this).prop("checked") == true){
                //$('#project').prop('disabled', false);
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
				$('#dim_diameter').prop('disabled', false);
				$('#tecspec_housing').prop('disabled', false);
				$('#tecspec_light_distr').prop('disabled', false);
				$('#tecspec_adjustment').prop('disabled', false);
				$('#tecspec_approval').prop('disabled', false);
				$('#tecspec_transformer').prop('disabled', false);
				$('#instalation_manual').prop('disabled', false);
				
				$('#btnupdatesave').prop('disabled', false);
				$('#btnsaveas').prop('disabled', false);
            }
            else if($(this).prop("checked") == false){
                //$('#project').prop('disabled', true);
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
				$('#dim_diameter').prop('disabled', true);
				$('#tecspec_housing').prop('disabled', true);
				$('#tecspec_light_distr').prop('disabled', true);
				$('#tecspec_adjustment').prop('disabled', true);
				$('#tecspec_approval').prop('disabled', true);
				$('#tecspec_transformer').prop('disabled', true);
				$('#instalation_manual').prop('disabled', true);
				
				$('#btnupdatesave').prop('disabled', true);
				$('#btnsaveas').prop('disabled', true);
            }
        });
		
		
	});
	
	</script>