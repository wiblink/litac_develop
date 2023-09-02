<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/extensionicon.css">
<script src="<?php echo base_url();?>assets/libs/litepicker/dist/litepicker.js"></script>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Logs
                </div>
                <h2 class="page-title">
                  Data Action Logs
                </h2>
              </div>
              <!-- Page title actions -->
              
            </div>
          </div>		  
		  <div class="row row-deck row-cards">
            <div class="col-12">
              <div class="card">
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-10">					
						<div class="form-group mb-3 row">
							<label class="form-label col-3 col-form-label">Tanggal</label>
								<div class="col">
									<div class="input-icon">
										<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
										</span>
										<input type="text" name="tgl_start" id="tgl_start" class="form-control" value="" required placeholder="Tanggal Awal" readonly>
									</div>					 
								</div> 								
								<div class="col">
									<div class="input-icon">
										<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
										</span>
										<input type="text" name="tgl_end" id="tgl_end" class="form-control" value="" required placeholder="Tanggal Akhir" readonly>
									</div>					 
								</div>
								<div class="col">
									<button type="submit" name="btncari" id="btncari" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>Cari</button>
								</div>
						</div>					
					</div>
				  </div>
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
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $userData['id_user']; ?>">
				<input type="hidden" name="jabatan_organisasi_parent_id" id="jabatan_organisasi_parent_id" value="<?php echo $userData['jabatan_organisasi_parent_id']; ?>">
                <div class="table-responsive">				
                  <table id="logtbl" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
						  <th width="30px;">No.</th>
						  <th>Log Time</th>
						  <th>User ID</th>
						  <th>NIP</th>
						  <th>Nama Lengkap</th>
						  <th>IP Address</th>
						  <th>Browser</th>
						  <th>OS</th>
						  <th>Action</th>
					  </tr>
                    </thead>
					<tbody>
					
					<script type="text/javascript">
		
		function convertDateTimeDBtoIndo(string) {
				bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];

				date = string.split(" ")[0];
				time = string.split(" ")[1];

				tanggal = date.split("-")[2];
				bulan = date.split("-")[1];
				tahun = date.split("-")[0];

				return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun + " " + time;
			}

		jQuery(document).ready(function() {
			
		var search = jQuery("#search").val();
		var searchtext = jQuery("#searchtext").val();
  
		fill_datatable();  
	});	
 
 		function fill_datatable()
		{
			var table = jQuery("#logtbl").DataTable({
			ScrollX   : false ,
			serverSide : true,
			processing : true,
			paging	:   false,
			ordering : false,
			info   :  false	,
			ajax       : {
				method : "GET",
				url  : "<?php echo base_url('ketatausahaan/log_json') ?>",
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
							  
							{ data: function(row, type, set) {	
							
							var htmllogs = convertDateTimeDBtoIndo(row.logtime);								
								return htmllogs;								
								}
							},
							{ data: "user_id", orderable: true },
							{ data: "nip", orderable: false },
							{ data: "nama_lengkap", orderable: true },
							{ data: "ipadd", orderable: true },
							{ data: function(row, type, set) {	
								var htmlbrowser = row.browser +' '+ row.browser_version;
								return htmlbrowser;								
								}
							},
							{ data: "os", orderable: false },
							{ data: "logdetail", orderable: false },
			]
				});
		}
	
	
	function fill_search_datatable(tgl_start = '', tgl_end = '')
		  {
			 //alert(tgl_start);
		   var dataTable = $('#logtbl').DataTable({
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('ketatausahaan/search_log_json') ?>",
			 type:"POST",
			 data:{
			  tgl_start:tgl_start, tgl_end:tgl_end
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
							  
							{ data: function(row, type, set) {	
							
							var htmllogs = convertDateTimeDBtoIndo(row.logtime);								
								return htmllogs;								
								}
							},
							{ data: "user_id", orderable: true },
							{ data: "nip", orderable: false },
							{ data: "nama_lengkap", orderable: true },
							{ data: "ipadd", orderable: true },
							{ data: function(row, type, set) {	
								var htmlbrowser = row.browser +' '+ row.browser_version;
								return htmlbrowser;								
								}
							},
							{ data: "os", orderable: false },
							{ data: "logdetail", orderable: false },
			]
		   });
		  }
		  
		  
		  $('#btncari').click(function(e){
		  var tgl_start = jQuery("#tgl_start").val();
		  var tgl_end = jQuery("#tgl_end").val();
		  
		  e.preventDefault();
		 
		   if(tgl_start != '' || tgl_end != '')
		   {
		  
			$('#logtbl').DataTable().destroy();
			fill_search_datatable(tgl_start, tgl_end);
		   }
		   else
		   {
			//alert('Select All filter option');
			$('#logtbl').DataTable().destroy();
			fill_datatable();
		   }
		});
		
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
	
		</script>
		
					</tbody>
                  </table>
                </div>
               
              </div>
            </div>
          </div>
        </div>
</div>