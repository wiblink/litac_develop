<!--<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>-->
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
                $(".find_pb").select2({
                    placeholder: "Product Brand",
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
                        $(".find_refl").select2({
                            placeholder: "Reflector Finish",
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
                  Lamp List Data
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    
                  </span>
				  <?php
                 if ($userData['kewenangan'] == 'admin') { ?>
                    <br>
                    <a href="lamp/t" class="btn btn-primary d-none d-sm-inline-block">
                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Add New
                  </a>
                <?php
                } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row row-deck row-cards">

           <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
              <div class="card-body border-bottom py-3">				
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-xl-12">
            <div class="form-group mb-4 row" >
					
					
					<div class="col">
						<label class="radio-inline"><input type="radio" class="radioBtnClass" name="adv_lamp_side" value='I' id="indoor">&nbsp;Indoor</label>
						<label class="radio-inline"><input type="radio" class="radioBtnClass" name="adv_lamp_side" value='O' id="outdoor">&nbsp;Outdoor</label>		
					</div>
									<div class="col" id="show-indoor" style="display:none;">
										<select class="form-control find_indoor" name="adv_cat_indoor" id="adv_cat_indoor" style="width: 100%">
											  <option value=""></option>
											  <?php
													if(!empty($indoor)) {
													foreach ($indoor as $baris) { ?>
														<option value="<?php echo $baris->id_product_type; ?>"><?php echo $baris->name_product_type; ?></option>
													<?php } }?>
										</select>
									</div>									
									<div class="col" id="show-outdoor" style="display:none;">
										<select class="form-control find_outdoor" name="adv_cat_outdoor" id="adv_cat_outdoor" style="width: 100%">
											  <option value=""></option>
											  <?php
													if(!empty($outdoor)) {
													foreach ($outdoor as $baris) { ?>
													<option value="<?php echo $baris->id_product_type; ?>"><?php echo $baris->name_product_type; ?></option>
													<?php } }?>
										</select>
									</div>
					
					<div class="col">
						<input type="text" name="lamp" id="lamp" class="form-control" value="" placeholder="Lamp">
					</div>
					
					<div class="col">
						<select class="form-control find_pb" name="id_product_brand" id="id_product_brand" style="width: 50%">
							<option value="">No Selected</option>
								<?php foreach($branddt as $row):?>
									<option value="<?php echo $row->id_brand;?>"><?php echo $row->name_product_brand;?></option>
								<?php endforeach;?>
						</select>
					</div>
					
					
					
            </div>

			<div class="form-group mb-3 row">
                
					<div class="col">
					  <input type="text" name="power" id="power" class="form-control numberdot" value="" placeholder="Power" maxlength=6>
					</div>
					<div class="col">
					  <input type="text" name="lumen" id="lumen" class="form-control numberdot" value="" placeholder="Lumen" maxlength=6>
					</div>
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
					<div class="col">
					  <input type="text" name="accesories" id="accesories" class="form-control" value="" placeholder="Accesories">
					</div>
            </div>			
            <!--<div class="form-group mb-3 row">				
					<div class="col">
						<select class="form-control cari_penerima" name="penerima" id="penerima" required>
                              <option value=""></option>
                              <?php
									if(!empty($penerima)) {
                                    foreach ($penerima as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>">NIP: <?php echo $baris->nip; ?> - <?php echo $baris->nama_lengkap; ?> <?php if($baris->jabatan_organisasi != NULL){echo '('.$baris->jabatan_organisasi.')';}?></option>
									<?php endforeach; }?>
                            </select>
					</div>
					
					<div class="col">
								<div class="input-icon">
									<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
									</span>
									<input type="text" name="tgl_start" class="form-control" id="tgl_start" value="" maxlength="10" placeholder="Tanggal Dari">
									</div>					 
							</div>
							
					<div class="col">
								<div class="input-icon">
									<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
									</span>
									<input type="text" name="tgl_end" class="form-control" id="tgl_end" value="" maxlength="10" placeholder="Tanggal Sampai">
									</div>					 
							</div>
            </div>-->
							 
                          
                      </div>
                    </div>
                  </div>                 
                </div>
				
				<div class="card-footer text-end">
                <div class="d-flex">                 
                 			  
				  <a href="../catalog/lamp" class="btn btn-primary d-none d-sm-inline-block" title="Refresh"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>Refresh</a>
				  
				  
				  <button type="submit" name="searchlamp" id="searchlamp" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg> Cari</button>
                </div>
              </div>
              </div>
			  
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $userData['id_user']; ?>">
				<input type="hidden" name="jabatan_organisasi_parent_id" id="jabatan_organisasi_parent_id" value="<?php echo $userData['jabatan_organisasi_parent_id']; ?>">
                <div class="table-responsive">				
                    <!--<table id="mytable" class="table card-table dataTable">
				<table id="example" class="display" style="width:100%">
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
                  </table>-->
				  
				  <!--<table id="mytable" class="table card-table table-vcenter wrap datatable">-->
				<table id="mytable" class="display wrap" cellspacing="0" width="100%">
					<thead>
						<tr>
						  <th width="20px;">No.</th>
						  <th>Type</th>
						  <th>Lamp</th>
						  <th>Product</th>
						  <th>Power</th>
						  <th>Lumen</th>
						  <th>Colour</th>
						  <th>Reflector Finish</th>
						  <th>Accesories</th>
						  <th>Thumbnail</th>
						  <th>Action</th>
						</tr>
					</thead>
				</table>
		
                </div>
               
              </div>
            </div>
          </div>
        </div>
</div>
    
<!-- Memanggil jQuery data tables -->			  
		<script type="text/javascript">
		
		jQuery(document).ready(function() {
			
		var search = jQuery("#search").val();
		var searchtext = jQuery("#searchtext").val();
  
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
								} , orderable: false
							},							
							{ data: function(row, type, set) {	
							
								var adv_lamp_side = row.adv_lamp_side;
								if(adv_lamp_side == 'I'){ var sisi = 'Indoor'; } else {var sisi = 'Outdoor';}
								var htmltype = '<li>'+ sisi +'</li><li>'+ row.name_product_type +'</li>';	
								return htmltype;
								
								}, orderable: false
							},							
							{ data: "lamp", orderable: false },
							{ data: "name_product_brand", orderable: false },
							{ data: "power", orderable: false },
							{ data: "lumen", orderable: false },
							{ data: "name_product_colour", orderable: false },
							{ data: "name_ref_finish", orderable: false },
							{ data: "accesories", orderable: false },
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
					targets     : 10,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='lamp/e/"+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
			
				});
		 }
  
  
		function fill_search_datatable(adv_lamp_side = '', adv_cat_indoor = '', adv_cat_outdoor = '', lamp = '', power = '', lumen = '', id_product_brand = '', product_colour = '', reflector_finish = '', accesories = '')
		  {
			  //alert(id_product_brand);
		   var dataTable = $('#mytable').DataTable({
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('catalog/lamp_search_json') ?>",
			 type:"POST",
			 data:{
			  adv_lamp_side:adv_lamp_side, adv_cat_indoor:adv_cat_indoor, adv_cat_outdoor:adv_cat_outdoor, lamp:lamp, power:power, lumen:lumen, id_product_brand:id_product_brand, product_colour:product_colour, reflector_finish:reflector_finish, accesories:accesories
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
								} , orderable: false
							},							
							{ data: function(row, type, set) {	
							
								var adv_lamp_side = row.adv_lamp_side;
								if(adv_lamp_side == 'I'){ var sisi = 'Indoor'; } else {var sisi = 'Outdoor';}
								var htmltype = '<li>'+ sisi +'</li><li>'+ row.name_product_type +'</li>';	
								return htmltype;
								
								}, orderable: false
							},							
							{ data: "lamp", orderable: false },
							{ data: "name_product_brand", orderable: false },
							{ data: "power", orderable: false },
							{ data: "lumen", orderable: false },
							{ data: "name_product_colour", orderable: false },
							{ data: "name_ref_finish", orderable: false },
							{ data: "accesories", orderable: false },
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
					targets     : 10,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='lamp/e/"+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
		   });
		  }
		 
  
		$('#searchlamp').click(function(e){
		 
		  var adv_lamp_side = $("input[type='radio'].radioBtnClass:checked").val();
		  var adv_cat_indoor = jQuery("#adv_cat_indoor").val();
		  var adv_cat_outdoor = jQuery("#adv_cat_outdoor").val();
		  var lamp = jQuery("#lamp").val();
		  var power = jQuery("#power").val();
		  var lumen = jQuery("#lumen").val();
		  var id_product_brand = jQuery("#id_product_brand").val();
		  var product_colour = jQuery("#product_colour").val();
		  var reflector_finish = jQuery("#reflector_finish").val();
		  var accesories = jQuery("#accesories").val();
		  
		  e.preventDefault();
		 
		   if(adv_lamp_side != '' || adv_cat_indoor != '' || adv_cat_outdoor != '' || lamp != '' || power != '' || lumen != '' || id_product_brand != '' || product_colour != '' || reflector_finish != '' || accesories != '')
		   {
			$('#mytable').DataTable().destroy();
			fill_search_datatable(adv_lamp_side, adv_cat_indoor, adv_cat_outdoor, lamp, power, lumen, id_product_brand, product_colour, reflector_finish, accesories);
		   }
		   else
		   {
			//alert('Select Both filter option');
			$('#mytable').DataTable().destroy();
			fill_datatable();
		   }
			});			
		});
		
		
	function eAlert(x){
		swal({
			title: "Hapus Lampu?",
			icon: "warning",
			dangerMode: true,
			buttons: ["Batal", "Hapus"]
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Sukses! Lampu berhasil dihapus.", {
					icon: "success"
				});
				window.location.href = '../catalog/lamp/h/'+ x +'';
			} else {
				swal("lampu batal dihapus");
			}
		});
	}
	
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
		 
		</script>