<!--<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>-->

<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Tipe Surat
                </div>
                <h2 class="page-title">
                  Data Tipe Surat
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
                    <a href="tipesurat/t" class="btn btn-primary d-none d-sm-inline-block">
                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tipe Surat Baru
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
                <!--<div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="text-muted">
                      Show
                      <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                      </div>
                      entries
                    </div>
                    <div class="ms-auto text-muted">
                      Search:
                      <div class="ms-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                      </div>
                    </div>
                  </div>
                </div>-->
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $userData['id_user']; ?>">
				<input type="hidden" name="jabatan_organisasi_parent_id" id="jabatan_organisasi_parent_id" value="<?php echo $userData['jabatan_organisasi_parent_id']; ?>">
                <div class="table-responsive">				
                  <table id="tipetable" class="table card-table">
                    <thead>
                      <tr>
						  <th width="20px;">No.</th>
						  <th>Tipe Surat</th>
						  <th>Deskripsi</th>
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
			
		var search = jQuery("#search").val();
		var searchtext = jQuery("#searchtext").val();
  
		fill_datatable();
			
		function fill_datatable()
		{
			var table = jQuery("#tipetable").DataTable({
			ScrollX  :  "100%",
			serverSide : true,
			processing : true,       
			ajax       : {
				method : "GET",
				url  : "<?php echo base_url('ketatausahaan/tipesurat_json') ?>",
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
							{ data: "tipe_surat", orderable: true },
							{ data: "deskripsi", orderable: true },
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 3,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='tipesurat/e/"+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Surat' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
				});
		 }
  
  
	
		function fill_search_datatable(search = '', searchtext = '')
		  {
		   var dataTable = $('#tipetable').DataTable({
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
		 
  
		$('#btncari').click(function(e){
		  var search = jQuery("#search").val();
		  var searchtext = jQuery("#searchtext").val();
		  e.preventDefault();
		 
		   if(search != '' || searchtext != '')
		   {
			$('#tipetable').DataTable().destroy();
			fill_search_datatable(search, searchtext);
		   }
		   else
		   {
			//alert('Select Both filter option');
			$('#tipetable').DataTable().destroy();
			fill_datatable();
		   }
			});			
		});
		
		
	function eAlert(x){
		swal({
			title: "Hapus Tipe Surat?",
			icon: "warning",
			dangerMode: true,
			buttons: ["Batal", "Hapus"]
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Sukses! Tipe Surat berhasil dihapus.", {
					icon: "success"
				});
				window.location.href = '../ketatausahaan/tipesurat/h/'+ x +'';
			} else {
				swal("Tipe Surat batal dihapus");
			}
		});
	}
		 
		</script>