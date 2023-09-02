<script>
	
    document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('tgl_start'),
    		buttonText: {
    			previousMonth: '<svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
    			nextMonth: '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
    		},
    	}));
    });
	
	document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('tgl_end'),
    		buttonText: {
    			previousMonth: '<svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
    			nextMonth: '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
    		},
    	}));
    });
    // @formatter:on
	
	$(document).ready(function () {
                        $(".find_user").select2({
                            placeholder: "User",
							allowClear: true
                        });
						
						$(".find_type").select2({
                            placeholder: "Type Project",
							allowClear: true
                        });
						
						
					});
					
                </script>
<script src="<?php echo base_url();?>assets/libs/litepicker/dist/litepicker.js"></script>

<style>

.select2-choices {
  min-height: 150px;
  max-height: 150px;
  overflow-y: auto;
}

</style>

<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Cart
                </div>
                <h2 class="page-title">
                  Cart Project
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    
                  </span>
				
                    <br>
                    <a href="<?php echo base_url();?>catalog/cart" class="btn btn-primary d-none d-sm-inline-block">
                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    New Project
                  </a>
               
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
				
				  <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-xl-4">
			
			<div class="form-group mb-2 row">
			
					<div class="col">
								<div class="input-icon">
									<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
									</span>
									<input type="text" name="tgl_start" class="form-control" id="tgl_start" value="" maxlength="10" placeholder="From">
									</div>					 
							</div>
							
					<div class="col">
								<div class="input-icon">
									<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
									</span>
									<input type="text" name="tgl_end" class="form-control" id="tgl_end" value="" maxlength="10" placeholder="Until">
									</div>					 
							</div>
            </div>
						</div>
			<div class="col-xl-12">
			<div class="form-group mb-5 row" >
					
					<div class="col">
							  <input type="text" name="project" id="project" class="form-control" value="" placeholder="Project">
					</div>
					<div class="col">
							  <input type="text" name="projnr" id="projnr" class="form-control" value="" placeholder="Project NR">
					</div>
					<div class="col">
						<select class="form-control find_type select2-choices" name="idproject_type" id="idproject_type">
                              <option value=""></option>
                              <?php
									if(!empty($prjtypedt)) {
                                    foreach ($prjtypedt as $row) { ?>
									<option value="<?php echo $row->idproject_type; ?>"><?php echo $row->project_type_name; ?></option>
									<?php } }?>
                        </select>
					</div>
					<div class="col">
							  <input type="text" name="location" id="location" class="form-control" value="" placeholder="Location">
					</div>
					<div class="col">
							  <input type="text" name="status_project" id="status_project" class="form-control" value="" placeholder="Status">
					</div>
					<div class="col">
							  <input type="text" name="note" id="note" class="form-control" value="" placeholder="Note">
					</div>
					<div class="col">
							  <select class="form-control find_user" name="user" id="user">
                              <option value=""></option>
                              <?php
									if(!empty($user)) {
                                    foreach ($user as $baris) { ?>
									<option value="<?php echo $baris->nip; ?>"><?php echo $baris->nama_lengkap; ?></option>
									<?php } }?>
                        </select>
					</div>
            </div>      
                      </div>
                    </div>
                  </div>                 
                </div>
				
				<div class="card-footer text-end">
                <div class="d-flex">                 
                 			  
				  <a href="../catalog/cart_project" class="btn btn-primary d-none d-sm-inline-block" title="Refresh"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>Refresh</a>
				  
				  
				  <button type="submit" name="btncari" id="btncari" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg> Cari</button>
                </div>
              </div>
				
				
             	<input type="hidden" name="id_user" id="id_user" value="<?php echo $userData['id_user']; ?>">
				<div class="table-responsive">
                  <table id="mytable" class="table card-table table-vcenter wrap datatable">
                    <thead>
                      <tr>
						  <th width="20px;">No.</th>
						  <th>Project</th>
						  <th>Project NR</th>
						  <th>Type Project</th>
						  <th>Location</th>
						  <th>Status</th>
						  <th>Date</th>
						  <th>Note</th>
						  <th>Created By</th>
						  <th>Action</th>
					  </tr>
                    </thead>
					<tbody>
					</tbody>
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
			
	
  
		fill_datatable();
			
		function fill_datatable()
		{
			var table = jQuery("#mytable").DataTable({
			
			serverSide : true,
			processing : true,       
			ajax       : {
				method : "GET",
				url  : "<?php echo base_url('catalog/carthistory_json') ?>",
				data : data => {
					// Read values
					console.log('data', data)
				   
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
							{ data: "project", orderable: true },
							{ data: "projnr", orderable: true },
							{ data: "project_type_name", orderable: true },
							{ data: "location", orderable: true },
							{ data: "status_project", orderable: true },
							{ data: "tanggal_project", orderable: true },
							{ data: "note", orderable: true },
							{ data: "nama_lengkap", orderable: false },
							{ data: "code", orderable: false }
							
			],
			columnDefs: [
				{
					targets     : 9,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='cart?idcart="+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div></div>")
						
						//jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='cart?idcart="+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
				});
		 }
  
  
	
		function fill_search_datatable(tgl_start = '', tgl_end = '', project = '', projnr = '', idproject_type = '', location = '', status_project = '', note = '', user = '')
		  {
		   var dataTable = $('#mytable').DataTable({
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('catalog/carthistorysearch_json') ?>",
			 type:"POST",
			 data:{
			   tgl_start:tgl_start, tgl_end:tgl_end, project:project, projnr:projnr, idproject_type:idproject_type, location:location, status_project:status_project, note:note, user:user
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
							{ data: "project", orderable: true },
							{ data: "projnr", orderable: true },
							{ data: "project_type_name", orderable: true },
							{ data: "location", orderable: true },
							{ data: "status_project", orderable: true },
							{ data: "tanggal_project", orderable: true },
							{ data: "note", orderable: true },
							{ data: "nama_lengkap", orderable: false },
							{ data: "code", orderable: false }
							
			],
			columnDefs: [
				{
					targets     : 9,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='cart?idcart="+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div></div>")
						
						//jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='cart?idcart="+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
		   });
		  }
		 
  
		$('#btncari').click(function(e){
		  	  
		  var tgl_start = jQuery("#tgl_start").val();
		  var tgl_end = jQuery("#tgl_end").val();
		  var project = jQuery("#project").val();
		  var projnr = jQuery("#projnr").val();
		  var idproject_type = jQuery("#idproject_type").val();
		  var location = jQuery("#location").val();
		  var status_project = jQuery("#status_project").val();
		  var note = jQuery("#note").val();
		  var user = jQuery("#user").val();
		//alert (idproject_type);
		  e.preventDefault();
		 
		   if(tgl_start != '' || tgl_end != '' || project != '' || projnr != '' || idproject_type != '' || location != '' || status_project != '' || note != '' || user != '')
		   {
			$('#mytable').DataTable().destroy();
			fill_search_datatable(tgl_start, tgl_end, project, projnr, idproject_type, location, status_project, note, user);
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
		 
		</script>