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
                  User
                </div>
                <h2 class="page-title">
                  Data User
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    
                  </span>
                  <a href="brand/t" class="btn btn-primary d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                    ADD BRAND
                  </a>
                 
                </div>
              </div>
            </div>
          </div>
		  <!--
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
									<select type="text" class="form-select" placeholder="Plih surat" id="jenis" name="jenis" value="">
										  <option value="">Pilih Surat</option>
										  <option value="suratmasuk">Surat Masuk</option>
										  <option value="suratkeluar">Surat Keluar</option>
									</select>
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
		  </div>-->
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
				<?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $userData['id_user']; ?>">
				<input type="hidden" name="jabatan_organisasi_parent_id" id="jabatan_organisasi_parent_id" value="<?php echo $userData['jabatan_organisasi_parent_id']; ?>">
                <div class="table-responsive">				
                  <table id="usertable" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
						  <th width="20px;">No.</th>
						  <th>NIP</th>
						  <th>Nama Lengkap</th>
						  <th>Jabatan</th>
						  <th>Aksi</th>
					  </tr>
                    </thead>
                  </table>
                </div>
               
              </div>
            </div>
          </div>
        </div>
</div>
	
	<script>
	$(document).ready(function() {
		//jQuery("#tgl_start").val('Tanggal Awal');
		fill_datatable();
		$('.table tbody tr td:not(:last-child)').click(function () {
			var href = $(this).parent().find('a.sm_detail').attr("href");
			window.location = href;
		});
		
			
	});
	
	function fill_datatable()
		{
			var table = jQuery("#usertable").DataTable({			
			serverSide : true,
			processing : true,       
			ajax       : {
				method : "GET",
				url  : "<?php echo base_url('ketatausahaan/user_json') ?>",
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
							{ data: "nip", orderable: false },
							{ data: "nama_lengkap", orderable: false },
							{ data: "jabatan", orderable: false },
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 4,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						var td1 = '<a href="../ketatausahaan/user/reset/'+cellData+'" data-toggle="tooltip" data-placement="top" title="Reset Password"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /><line x1="12" y1="9" x2="12" y2="12" /><line x1="12" y1="15" x2="12.01" y2="15" /></svg>';
						
						var td2 = '<a href="../ketatausahaan/user/e/'+cellData+'" data-toggle="tooltip" data-placement="top" title="Edit User"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Hapus User" onclick="return eAlert('+cellData+')"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>';
						
						var allin = td1+''+td2;
						//var allin = td2;
						jQuery(td).html(allin)
						
					}
				},
				
			]
				});
		}
		
		
		
		function fill_search_datatable(tgl_start = '', tgl_end = '', jenis = '')
		  {
			 //alert(tgl_start);
		   var dataTable = $('#usertable').DataTable({
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('ketatausahaan/search_imagearchives_json') ?>",
			 type:"POST",
			 data:{
			  tgl_start:tgl_start, tgl_end:tgl_end, jenis:jenis
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
								var htmlberkas = '<span class="file"><a href="<?php echo base_url();?>lampiran/'+ row.nama_berkas +'" class="">'+ row.nama_berkas +'</a></span>';
								return htmlberkas;								
								}
							},
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 2,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						var td1 = '<a href="../ketatausahaan/arsip/d/'+cellData+'" data-toggle="tooltip" data-placement="top" title="Detail Arsip"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="3" width="14" height="18" rx="2" /><line x1="9" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="15" y2="11" /><line x1="9" y1="15" x2="13" y2="15" /></svg>';
						//alert(id_userx+'<>'+rowData.penerima);
						var allin = td1;
						jQuery(td).html(allin)
						
					}
				},
				
			]
		   });
		  }
		
		
		$('#btncari').click(function(e){
		  var tgl_start = jQuery("#tgl_start").val();
		  var tgl_end = jQuery("#tgl_end").val();
		  var jenis = jQuery("#jenis").val();
		  e.preventDefault();
		 
		   if(tgl_start != '' || tgl_end != '' || jenis != '')
		   {
		  
			$('#usertable').DataTable().destroy();
			fill_search_datatable(tgl_start, tgl_end, jenis);
		   }
		   else
		   {
			//alert('Select All filter option');
			$('#usertable').DataTable().destroy();
			fill_datatable();
		   }
		});
	</script>
	
	<script type="text/javascript">
	
	
$('.msg').html('');

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

	function eAlert(x){
		swal({
			title: "Hapus User?",
			icon: "warning",
			dangerMode: true,
			buttons: ["Batal", "Hapus"]
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Sukses! User berhasil dihapus.", {
					icon: "success"
				});
				window.location.href = '../ketatausahaan/user/h/'+ x +'';
			} else {
				swal("User batal dihapus");
			}
		});
	}
	
	/* $(".cari_surat").select2({
                            placeholder: "Pilih Surat"
                        }); */
						
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
	
	document.addEventListener("DOMContentLoaded", function () {
    	var el;
    	window.Choices && (new Choices(el = document.getElementById('jenis'), {
    		classNames: {
    			containerInner: el.className,
    			input: 'form-control',
    			inputCloned: 'form-control-sm',
    			listDropdown: 'dropdown-menu',
    			itemChoice: 'dropdown-item',
    			activeState: 'show',
    			selectedState: 'active',
    		},
    		shouldSort: false,
    		searchEnabled: false,
    	}));
    });
</script>