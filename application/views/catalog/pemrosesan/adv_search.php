<script>
$(document).ready(function () {
                        $(".find_pb").select2({
                            placeholder: "Product Brand",
							allowClear: true
                        });
						
						 $(".find_cd").select2({
                            placeholder: "Product Code",
							allowClear: true
                        });						
						
						$(".find_pro").select2({
                            placeholder: "Project Name",
							allowClear: true
                        });       
						
						
                    });
</script>
<div class="content">
        <div class="row row-deck row-cards">
          <!-- Page title -->
         <div class="row row-cards">
		  <div class="col-lg-2">
              <div class="card">
                <div class="card card-sm">
                
				<div class="card-header">
                  <h3 class="card-title">Product Search</h3>
                </div>
				<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
                <div class="card-body">
                  <div class="form-group mb-12 row">				
					<div class="col">
					  <div class="form-check-inline">
                        <input type="radio" name="adv_lamp_side" class="radioBtnClass" value='I' id="indoor">
                        <label class="col-form-label" for="indoor">Indoor</label>
                      </div>
                      <div class="form-check-inline">
                        <input type="radio" name="adv_lamp_side" class="radioBtnClass" value='O' id="outdoor">
                        <label class="col-check-label" for="outdoor">Outdoor</label>
                      </div>
					  <div class="form-check-inline">
                        <input type="radio" name="adv_lamp_side" class="radioBtnClass" value='IO' id="allpr">
                        <label class="col-check-label" for="allpr">All</label>
                      </div>					  
					</div>				
			</div>
			
			<div class="form-group mb-2 row" id="show-indoor" style="display:none;">
				<label class="col-12 col-form-label">Indoor Product Types</label>
					<?php
						if(!empty($indoor)) {
                            foreach ($indoor as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input adv_cat_indoor_class" type="checkbox" name="adv_cat_indoor" value="<?php echo $baris->id_product_type; ?>" id="<?php echo $baris->id_product_type; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_product_type; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-2 row" id="show-outdoor" style="display:none;">
				<label class="col-12 col-form-label">Outdoor Product Types</label>
					<?php
						if(!empty($outdoor)) {
                            foreach ($outdoor as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input adv_cat_outdoor_class" type="checkbox" name="adv_cat_outdoor" value="<?php echo $baris->id_product_type; ?>" id="<?php echo $baris->id_product_type; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_product_type; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-2">
				<label class="col-8 col-form-label">Power (system values)</label>
					<div class="row">
						 <div class="input-group w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control" id="min_power" placeholder="10"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control" id="max_power" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
			
			<div class="form-group mb-2">
				<label class="col-10 col-form-label">Lumen (system values)</label>
					<div class="row">
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control" id="min_lumen" placeholder="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control" id="max_lumen" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
			
			<div class="form-group mb-2">
				<label class="col-12 col-form-label">Colour temperature/CCT (K)</label>
					<div class="row">
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control w-25" id="min_colt" placeholder="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control w-25" id="max_colt" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
			
			<div class="form-group mb-3">
				<label class="col-12 col-form-label">Colour rendering Index</label>
					<div class="row">
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control" id="min_colr" placeholder="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control" id="max_colr" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
			
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Optic</label>
					<?php
						if(!empty($optical)) {
                            foreach ($optical as $rowtical) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input optic_class" type="checkbox" name="optic[]" value="<?php echo $rowtical->id_optic; ?>" id="<?php echo $rowtical->id_optic; ?>" />
					  <label class="form-check-label"><?php echo $rowtical->name_optic; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-2">
				<label class="col-6 col-form-label">Beam Angle</label>
					<div class="row">
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control" id="min_ba" placeholder="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control" id="max_ba" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
                </div>
              </div>
                <div class="card-footer">
                  
                </div>
				
				
			<div class="col-md-12">
			<div class="card-header">
                  <h3 class="card-title">Advance Search</h3>
                </div>
				<div class="card-body">
               
              
			<div class="form-group mb-12 row">
				<label class="form-label col-12 col-form-label">Product Shape</label>                            
					<?php
						if(!empty($shape)) {
                            foreach ($shape as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input prodshape_class" type="checkbox" name="pr_shape" value="<?php echo $baris->idshape; ?>" id="<?php echo $baris->idshape; ?>" />
					  <label class="form-check-label"><?php echo $baris->shape; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-12 row">
			<label class="col-12 col-form-label">Adjustable Optic</label>   			
					<div class="form-check">
					  <div class="form-check-inline">
                        <input type="radio" name="adjustable" value='a' id="adj" class="AdjoClass">
                        <label class="col-check-label" for="adj">Adjustable</label>
                      </div>
					  <div class="form-check-inline">
                        <input type="radio" name="adjustable" value='f' id="nadj" class="AdjoClass">
                        <label class="col-check-label" for="nadj">Fixed</label>
                      </div>					  
					</div>				
			</div>
			
			<div class="form-group mb-3 row">
				<label class="form-label col-12 col-form-label">Reflector Finish</label>
					<?php
						if(!empty($refl_finish)) {
                            foreach ($refl_finish as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input refin_class" type="checkbox" name="reflector_finish" value="<?php echo $baris->id_ref_finish; ?>" id="<?php echo $baris->id_ref_finish; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_ref_finish; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-12 row">
				<label class="form-label col-12 col-form-label">Product Colour</label>
					<?php
						if(!empty($procol)) {
                            foreach ($procol as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input prodcol_class" type="checkbox" name="product_colour" value="<?php echo $baris->id_product_colour; ?>" id="<?php echo $baris->id_product_colour; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_product_colour; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-12 row">
				<label class="form-label col-12 col-form-label">Product Control</label>
					<?php
						if(!empty($controldt)) {
                            foreach ($controldt as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input prodcon_class" type="checkbox" name="product_control" value="<?php echo $baris->id_control; ?>" id="<?php echo $baris->id_control; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_control; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<!--<div class="form-group mb-12 row">
				<label class="form-label col-12 col-form-label">IP Rating</label>
					<?php
						if(!empty($ipdt)) {
                            foreach ($ipdt as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input ipr_class" type="checkbox" name="tecspec_ip" value="<?php echo $baris->tecspec_ip; ?>" id="<?php echo $baris->tecspec_ip; ?>" />
					  <label class="form-check-label"><?php echo $baris->tecspec_ip; ?></label>
					</div>
					
					<?php } }?>
			</div>-->
			<div class="form-group mb-3">
				<label class="form-label col-12 col-form-label">IP Rating</label>
					<div class="row">
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control" id="min_ip" placeholder="10"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control" id="max_ip" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
			<div class="form-group mb-3">
				<label class="form-label col-12 col-form-label">UGR Rating</label>
					<div class="row">
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">min</div>
							</div>
							<input type="text" class="form-control" id="min_ugr" placeholder="10"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					 
						 <div class="input-group mb-2 w-50">
							<div class="input-group-prepend">
							  <div class="input-group-text">max</div>
							</div>
							<input type="text" class="form-control" id="max_ugr" placeholder="90" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength=5>
						  </div>
					</div>
			</div>
			
			<div class="form-group mb-3">
				    <label class="form-label col-12 col-form-label">Product Brand</label>
				    <select class="form-control find_pb" name="id_product_brand" id="id_product_brand" required>
				    	<option value="">No Selected</option>
				    	<?php foreach($category as $row):?>
				    	<option value="<?php echo $row->id_brand;?>"><?php echo $row->name_product_brand;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>
				
				<div class="form-group mb-3">
				    <label class="form-label col-12 col-form-label">Product Type / Code</label>
				    <input type="text" class="form-control" name="product_code" id="product_code" maxlength=20>
				</div>
				
				<!--<div class="form-group mb-3">
				    <label class="form-label col-12 col-form-label">Product Type / Code</label>
				    <select class="form-control find_cd" id="product_code" name="product_code" required>
				    	<option value="">No Selected</option>
				    </select>
				</div>-->
			
                </form>
              </div>
			</div>
					<div class="card-footer">
						<button type="submit" name="searchlamp" id="searchlamp" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg> Cari</button>  
					</div>
              </div>
            </div>
			
		
			
            <div class="col-md-10 table-responsive">
              		
				 <table class="display" cellspacing="0" width="100%">
					<tr>
						
						<td align='right'>
					<table>
						<tr>
							<td>
							
				
						<?php
                echo $this->session->flashdata('msg');
                ?>
				
					<div class="form-group mb-2 row">
               		<div class="col-sm-2">
					 <button type="submit" name="inputmultiple" id="inputmultiple" class="btn btn-primary ms-auto" style="float:right;">Send To</button> 
					</div>
					<div class="col-sm-10">
					    <select class="form-control find_pro" name="project" id="project" style="width: 80%">
							<option value=""></option>
                              <?php
									if(!empty($project)) {
                                    foreach ($project as $projectrw) { ?>
									<option value="<?php echo $projectrw->code; ?>"><?php echo $projectrw->project; ?></option>
									<?php } }?>
                        </select>
					</div>
					</div>
						
							</td>
						</tr>
					</table>
                  

						
                 <table id="mytable" class="display nowrap" cellspacing="0" width="100%">
					
					<thead>
						<tr>
						  <th width="20px;">No.</th>
						  <th>Type</th>
						  <th>Power</th>
						  <th>Lumen</th>
						  <th>CCT</th>
						  <th>CRI</th>
						  <th>Optic</th>
						  <th>Angle</th>
						  <th>Shape</th>
						  <th>Adjustability</th>
						  <th>Reflector</th>
						  <th>Color</th>
						  <th>Control</th>
						  <th>IP</th>
						  <th>UGR</th>
						  <th>Brand</th>
						  <th>Code</th>
						  <th>Thumbnail</th>
						  <th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
		 
					<!--<tfoot>
						<tr>
							<th width="20px;">No.</th>
						  <th>Luminaire Type</th>
						  <th>Luminaire Reference</th>
						  <th>Gears</th>
						  <th>Accesories</th>
						  <th>Height</th>
						  <th>Width</th>
						  <th>Length</th>
						  <th>Weight</th>
						  <th>Action</th>
						</tr>
					</tfoot>-->
				</table>				 
</td>
					</tr>
				 </table>
		
               
             
            </div>            
          </div>
        </div>      
</div>

  	<div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Success</h5>                   
                </div>
                <div class="modal-body">
                    <p>Data Telah diinput.</p>
                </div>
                <div class="modal-footer">
                     <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                   <button type="button" class="btn btn-primary move">OK</button>-->
                </div>
            </div>
        </div>
    </div>
	
<script>
	$(document).ready(function() {
		
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
			
		//fill_datatable();
			});
		
	$('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'indoor') {
            $('#show-indoor').show();
			$('#show-outdoor').hide();	
			$('#adv_cat_indoor').attr('checked', false);			
       }
       else if ($(this).attr('id') == 'outdoor') {
		    $('#show-outdoor').show();
            $('#show-indoor').hide();   
       } 
	   else if ($(this).attr('id') == 'allpr') {
		    $('#show-outdoor').show();
            $('#show-indoor').show();   
       }
   });
	
		function fill_search_datatable(adv_lamp_side = '', adv_cat_indoor = '', adv_cat_outdoor = '', min_power = '', max_power = '', min_lumen = '', max_lumen = '', min_colt = '', max_colt = '', min_colr = '', max_colr = '', optic = '', min_ba = '', max_ba = '', pr_shape = '', adjustable = '', reflector_finish = '', product_colour = '', product_control = '', min_ip = '', max_ip = '', min_ugr = '', max_ugr = '', id_product_brand = '', product_code = '')
		  {
		// alert(pr_shape);
		   var dataTable = $('#mytable').DataTable({
			processing : true,
			serverSide : true,
			 
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('catalog/search_lamp_json') ?>",
			 type:"POST",
			 data:{
			  adv_lamp_side:adv_lamp_side, adv_cat_indoor:adv_cat_indoor, adv_cat_outdoor:adv_cat_outdoor, min_power:min_power, max_power:max_power, min_lumen:min_lumen, max_lumen:max_lumen, min_colt:min_colt, max_colt:max_colt, min_colr:min_colr, max_colr:max_colr, optic:optic, min_ba:min_ba, max_ba:max_ba, pr_shape:pr_shape, adjustable:adjustable, reflector_finish:reflector_finish, product_colour:product_colour, product_control:product_control, min_ip:min_ip, max_ip:max_ip, min_ugr:min_ugr, max_ugr:max_ugr, id_product_brand:id_product_brand, product_code:product_code
			  
			 }
			},
			orderCellsTop : false,
			fixedHeader   : false,
			searching	  : false,
			lengthChange  : false,		
			columns       : [
								 { "data": null,"sortable": true, 
									render: function (data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1
								}  
							},							
							
							
							{ data: function(row, type, set) {	
							
								var adv_lamp_side = row.adv_lamp_side;
								if(adv_lamp_side == 'I'){ var sisi = 'Indoor'; } else {var sisi = 'Outdoor';}
								var htmltype = '<li>'+ sisi +'</li><li>'+ row.name_product_type +'</li>';	
								return htmltype;
								
								}
							},
							
							{ data: "power", orderable: false },
							{ data: "lumen", orderable: false },
							{ data: "color_temperature", orderable: false },
							{ data: "cri", orderable: false },
							{ data: "name_optic", orderable: false },
							{ data: "beam_angle", orderable: false },
							{ data: "shape", orderable: false },
							{ data: "ajust", orderable: false },
							{ data: "name_ref_finish", orderable: false },
							{ data: "name_product_colour", orderable: false },
							{ data: "name_control", orderable: false },
							{ data: "tecspec_ip", orderable: false },
							{ data: "ugr_rating", orderable: false },
							{ data: "name_product_brand", orderable: false },
							{ data: "product_code", orderable: false },
							{ data: function(row, type, set) {
								
								var htmlimg = '<img src="<?php echo base_url();?>lampiran/'+ row.thumbnail +'" class="card-img-top">';
								var nohtmlimg = '<img src="<?php echo base_url();?>assets/img/noimage.jpg" class="card-img-top">';
								
								if(row.thumbnail != null){ var thumb = htmlimg; } else {var thumb = nohtmlimg;}
								return thumb;
								
								}, orderable: false
							},
							{ data: "id_lamp", orderable: false }
			],
			columnDefs: [
				{
					targets     : 18,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><input type='checkbox' class='form-check-input selCheck' name='selector' id='"+ cellData +"' value='"+ cellData +"'></div><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='lamp/d/"+ cellData +"<?php echo $idcart; ?>' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
		   });
		  }

			$('#searchlamp').click(function(e){
				
		  var adv_lamp_side = $("input[type='radio'].radioBtnClass:checked").val();
		  var adv_cat_indoor = $('input:checkbox:checked.adv_cat_indoor_class').map(function(){return this.value; }).get().join(",");
		  var adv_cat_outdoor = $('input:checkbox:checked.adv_cat_outdoor_class').map(function(){return this.value; }).get().join(",");
		  var min_power = jQuery("#min_power").val();
		  var max_power = jQuery("#max_power").val();
		  var min_lumen = jQuery("#min_lumen").val();
		  var max_lumen = jQuery("#max_lumen").val();
		  var min_colt = jQuery("#min_colt").val();
		  var max_colt = jQuery("#max_colt").val();
		  var min_colr = jQuery("#min_colr").val();
		  var max_colr = jQuery("#max_colr").val();		  
		  var optic = $('input:checkbox:checked.optic_class').map(function(){return this.value; }).get().join(",");		  
		  var min_ba = jQuery("#min_ba").val();
		  var max_ba = jQuery("#max_ba").val();
		  var pr_shape = $('input:checkbox:checked.prodshape_class').map(function(){return this.value; }).get().join(",");
		  var adjustable = $("input[type='radio'].AdjoClass:checked").val();
		  var reflector_finish = $('input:checkbox:checked.refin_class').map(function(){return this.value; }).get().join(",");
		  var product_colour = $('input:checkbox:checked.prodcol_class').map(function(){return this.value; }).get().join(",");
		  var product_control = $('input:checkbox:checked.prodcon_class').map(function(){return this.value; }).get().join(",");
		  //var tecspec_ip = $('input:checkbox:checked.ipr_class').map(function(){return this.value; }).get().join(",");
		  
		  var min_ip = jQuery("#min_ip").val();
		  var max_ip = jQuery("#max_ip").val();		  
		  var min_ugr = jQuery("#min_ugr").val();
		  var max_ugr = jQuery("#max_ugr").val();		  
		  var id_product_brand = jQuery("#id_product_brand").val();
		  var product_code = jQuery("#product_code").val();
		  //alert(adv_cat_indoor);
		  //var id_user = jQuery("#id_user").val();		  
		  
		  e.preventDefault();
		 
		   if(adv_lamp_side != '' || adv_cat_indoor != '' || adv_cat_outdoor != '' || min_power != '' || max_power != '' || min_lumen != '' || max_lumen != '' || min_colt != '' || max_colt != '' || min_colr != '' || max_colr != '' || optic != '' || min_ba != '' || max_ba != '' || pr_shape != '' || adjustable != '' || reflector_finish != '' || product_colour != '' || product_control != '' || min_ip != '' || max_ip != '' ||min_ugr != '' || max_ugr != '' || id_product_brand != '' || product_code != '')
		   {
		 	$('#mytable').DataTable().destroy();
			fill_search_datatable(adv_lamp_side,adv_cat_indoor,adv_cat_outdoor,min_power,max_power,min_lumen,max_lumen,min_colt,max_colt,min_colr,max_colr,optic,min_ba,max_ba,pr_shape,adjustable,reflector_finish,product_colour,product_control,min_ip,max_ip,min_ugr,max_ugr,id_product_brand,product_code);
		   } 
		   else if(adv_lamp_side == '' && adv_cat_indoor == '' && adv_cat_outdoor == '' && min_power == '' && max_power == '' && min_lumen == '' && max_lumen == '' && min_colt == '' && max_colt == '' && min_colr == '' && max_colr == '' && optic == '' && min_ba == '' && max_ba == '' && pr_shape == '' && adjustable == '' && reflector_finish == '' && product_colour == '' && product_control == '' && min_ip == '' && max_ip == '' && min_ugr == '' && max_ugr == '' && id_product_brand == '' && product_code == '')
		   {
		 	$('#mytable').DataTable().destroy();
			fill_datatable();
		   }
		});
		

    $('#inputmultiple').click(function(e){
        
		var selCheck = $('input:checkbox:checked.selCheck').map(function(){return this.value; }).get().join(",");
		var project = jQuery("#project").val();
		
		
		 $("#myModal").modal('show');
		 
		 
		$.ajax({
			 url  : "<?php echo base_url('catalog/advanced_search/inputSelected') ?>",
			 type : "POST",
			 dataType : 'json',
			 data : {
				
			  selCheck:selCheck, project:project
			  
			 },
			 
			 success : function(data){
				 
				 
				
                        //window.location = '/catalog/cart?idcart='+ project +'';
						//window.location.replace("/catalog/cart?idcart="+ project +"");
                      // top.location.href = '/catalog/cart?idcart='+ project +'';

                    }
			});
    });
   
	$(document).ready(function(){
        $(".inputmultiple").click(function(){
            $("#myModal").modal('show');
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