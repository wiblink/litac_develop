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
                    });
</script>

<div class="content">
      
          <div class="row row-deck row-cards">

           <div class="col-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">PRODUCT SEARCH</h3>
                </div>
              
			  <div class="card-body">
                  <div class="row">
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-12 col-xl-12">
            
				<?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-md-12 col-xl-12">
			
			<div class="form-group mb-12 row">				
					<div class="col">
					  <div class="form-check-inline">
                        <input type="radio" name="adv_lamp_side" value='I' id="indoor">
                        <label class="col-form-label" for="indoor">Indoor</label>
                      </div>
                      <div class="form-check-inline">
                        <input type="radio" name="adv_lamp_side" value='O' id="outdoor">
                        <label class="col-check-label" for="outdoor">Outdoor</label>
                      </div>
					  <div class="form-check-inline">
                        <input type="radio" name="adv_lamp_side" value='O' id="all">
                        <label class="col-check-label" for="all">All</label>
                      </div>					  
					</div>				
			</div>
			
			<div class="form-group mb-2 row">
				<label class="col-12 col-form-label">Indoor Product Types</label>
					<?php
						if(!empty($indoor)) {
                            foreach ($indoor as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" name="adv_cat_indoor" value="<?php echo $baris->id_product_type; ?>" id="<?php echo $baris->id_product_type; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_product_type; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-2 row">
				<label class="col-12 col-form-label">Outdoor Product Types</label>
					<?php
						if(!empty($outdoor)) {
                            foreach ($outdoor as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" name="adv_cat_outdoor" value="<?php echo $baris->id_product_type; ?>" id="<?php echo $baris->id_product_type; ?>" />
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
					  <input class="form-check-input" type="checkbox" name="optic" value="<?php echo $rowtical->id_optic; ?>" id="<?php echo $rowtical->id_optic; ?>" />
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
              </form>
               
              </div>
            </div>
          </div>
        </div>
</div>
               
              </div>
            </div>
          </div>
		  &nbsp;
		  
		  <div class="row row-deck row-cards">

           <div class="col-3">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">ADVANCED SEARCH</h3>
                </div>
              
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
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			
			<div class="form-group mb-12 row">
				<label class="form-label col-12 col-form-label">Product Shape</label>                            
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="1" id="pr_shape1" />
					  <label class="form-check-label">Circular</label>
					</div>
					
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="2" id="pr_shape2" />
					  <label class="form-check-label">Other</label>
					</div>
					
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="3" id="pr_shape3" />
					  <label class="form-check-label">Rectangular</label>
					</div>
					
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="4" id="pr_shape4" />
					  <label class="form-check-label">Square</label>
					</div>
			</div>
			
			<div class="form-group mb-12 row">
			<label class="col-12 col-form-label">Adjustable Optic</label>   			
					<div class="form-check">
					  <div class="form-check-inline">
                        <input type="radio" name="adj_optic" value='a' id="indoor">
                        <label class="col-form-label" for="a">All</label>
                      </div>
                      <div class="form-check-inline">
                        <input type="radio" name="adj_optic" value='adj' id="adj">
                        <label class="col-check-label" for="outdoor">Adjustable</label>
                      </div>
					  <div class="form-check-inline">
                        <input type="radio" name="adj_optic" value='nadj' id="nadj">
                        <label class="col-check-label" for="all">Not Adjustable</label>
                      </div>					  
					</div>				
			</div>
			
			<div class="form-group mb-3 row">
				<label class="form-label col-12 col-form-label">Reflector Finish</label>
					<?php
						if(!empty($refl_finish)) {
                            foreach ($refl_finish as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" name="reflector_finish" value="<?php echo $baris->id_ref_finish; ?>" id="<?php echo $baris->id_ref_finish; ?>" />
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
					  <input class="form-check-input" type="checkbox" name="product_colour" value="<?php echo $baris->id_product_colour; ?>" id="<?php echo $baris->id_product_colour; ?>" />
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
					  <input class="form-check-input" type="checkbox" name="control" value="<?php echo $baris->id_control; ?>" id="<?php echo $baris->id_control; ?>" />
					  <label class="form-check-label"><?php echo $baris->name_control; ?></label>
					</div>
					
					<?php } }?>
			</div>
			
			<div class="form-group mb-12 row">
				<label class="form-label col-12 col-form-label">IP Rating</label>
					<?php
						if(!empty($ipdt)) {
                            foreach ($ipdt as $baris) { ?>
                            
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" name="control" value="<?php echo $baris->tecspec_ip; ?>" id="<?php echo $baris->tecspec_ip; ?>" />
					  <label class="form-check-label"><?php echo $baris->tecspec_ip; ?></label>
					</div>
					
					<?php } }?>
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
                <label class="col-form-label">Product Brand</label>
					<div class="input-group">
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
			
			<div class="form-group mb-3">
                <label class="col-form-label">Product Code</label>
					<div class="input-group mb-2">
					  <select class="form-control find_cd" name="product_code" id="product_code">
                              <option value=""></option>
                              <?php
									if(!empty($branddt)) {
                                    foreach ($branddt as $baris) { ?>
									<option value="<?php echo $baris->id_brand; ?>"><?php echo $baris->code_product_brand; ?></option>
									<?php } }?>
                        </select>
					</div>
            </div>
			
			
						</div>
                    </div>
					
					<button type="submit" name="searchlamp" id="searchlamp" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg> Cari</button>
					
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
          </div>
		  
		  
		  
		  <div class="col-deck col-cards">
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
		  </div>
				 	
				 
				 
		  
</div>
    <script>
	$(document).ready(function() {
		
		fill_datatable();
			
		function fill_datatable()
		{
			var table = jQuery("#mytable").DataTable({
			
			serverSide : true,
			processing : true,
			order      : [],			
			ajax       : {
				type : "GET",
				url  : "<?php echo base_url('catalog/lamp_json') ?>",
				data : data => {
					// Read values
					console.log('data', data)
				   
				}
			},
			orderCellsTop : true,
			fixedHeader   : false,
			searching	  : false,
			lengthChange  : false,		
			columns       : [
								 { "data": null,"sortable": true, 
									render: function (data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1
								}  
							},							
							{ data: "luminaire_type", orderable: true },
							{ data: "luminaire_ref", orderable: true },
							{ data: "gears", orderable: true },
							{ data: "accesories", orderable: true },
							{ data: "dim_height", orderable: true },
							{ data: "dim_width", orderable: true },
							{ data: "dim_length", orderable: true },
							{ data: "dim_weight", orderable: true },
							{ data: "id_lamp", orderable: false }
			],
			columnDefs: [
				{
					targets     : 9,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='lamp/e/"+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
				});
		 }
  
  
	
		function fill_search_datatable(search = '', searchtext = '')
		  {
		   var dataTable = $('#mytable').DataTable({
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('ketatausahaan/search_kodesurat_json') ?>",
			 type:"POST",
			 data:{
			  search:search, searchtext:searchtext
			 }
			},
			orderCellsTop : false,
			fixedHeader   : false,
			searching	  : false,
			lengthChange  : false,		
			columns       : [
								 { "data": null,"sortable": false, 
									render: function (data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1
								}  
							},
							{ data: "no_kode", orderable: true },
							{ data: "kode_surat", orderable: true },
							{ data: "deskripsi", orderable: true },
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 4,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='kodesurat/e/"+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Surat' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
		   });
		  }
		
			
	});
	
	
			$('#searchlamp').click(function(e){
			alert('sdds');
		  var tgl_start = jQuery("#tgl_start").val();
		  var tgl_end = jQuery("#tgl_end").val();
		  var no_surat = jQuery("#no_surat").val();
		  var agenda = jQuery("#agenda").val();
		  var kode = jQuery("#kode").val();
		  var tipe = jQuery("#tipe").val();
		  var jenis = jQuery("#jenis").val();
		  var penerima = jQuery("#penerima").val();
		  var surat_eksternal = jQuery("#surat_eksternal").val();
		 
		  var id_user = jQuery("#id_user").val();
		  var jabatan_organisasi_parent_idx = jQuery("#jabatan_organisasi_parent_id").val();
		  
		  e.preventDefault();
		 
		   if(id_user != '' || tgl_start != '' || tgl_end != '' || no_surat != '' || agenda != '' || kode != '' || tipe != '' || jenis != '' || penerima != '' || surat_eksternal != '' || jabatan_organisasi_parent_idx != '')
		   {
		 	$('#smtable').DataTable().destroy();
			fill_search_datatable(id_user,tgl_start,tgl_end,no_surat,agenda,kode,tipe,jenis,penerima,surat_eksternal,jabatan_organisasi_parent_idx);
		   } 
		   else if(no_surat == '' && agenda == '' && kode == '' && tipe == '' && jenis == '' && penerima == '' && surat_eksternal == '')
		   {
		 	$('#smtable').DataTable().destroy();
			fill_datatable();
		   }
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