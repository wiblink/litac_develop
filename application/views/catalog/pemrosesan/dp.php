<script>
                    $(document).ready(function () {
                        $(".cari_ns").select2({
                            placeholder: "Pilih nomor"
                        });

                        $(".cari_penerima").select2({
                            placeholder: "Pilih Penerima"
                        });
						
						$(".cari_kode").select2({
                            placeholder: "Pilih Kode Surat"
                        });
						
						$(".cari_tipe").select2({
                            placeholder: "Pilih Tipe Surat"
                        });
						
						$(".cari_jenis").select2({
                            placeholder: "Pilih Jenis Surat"
                        });
                    });
					
					
					// @formatter:off
	
	
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
	
                </script>
<script src="<?php echo base_url();?>assets/libs/litepicker/dist/litepicker.js"></script>
<div class="content">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Surat Disposisi
                </div>
                <h2 class="page-title">
                  Data Disposisi
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                
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
             <div class="form-group mb-3 row">
					
					<div class="col-lg-12">
						<label class="radio-inline"><input type="radio" name="sumber-surat" id="surat-internal" checked>Surat Internal</label>&nbsp;&nbsp;
						<label class="radio-inline"><input type="radio" name="sumber-surat" id="surat-eksternal">Surat Eksternal</label>
					</div>
            </div>
			
			<div class="form-group mb-3 row" >
					
					<div class="col" id="show-me">
                            <input type="text" name="surat_eksternal" id="surat_eksternal" class="form-control" value="" placeholder="Pengirim/Instansi" readonly>
					</div>
					<div class="col">
							  <input type="text" name="no_surat" id="no_surat" class="form-control" value="" placeholder="Nomor Surat">
					</div>
					<div class="col">
					  <input type="text" name="agenda" id="agenda" class="form-control" value="" placeholder="Nomor Agenda">
					</div>
					
            </div>

			<div class="form-group mb-3 row">
                
					<div class="col">
					    <select class="form-control cari_kode" name="kode" id="kode" required>
                              <option value=""></option>
                              <?php
									if(!empty($kodesurat)) {
                                    foreach ($kodesurat as $baris) { ?>
                                        <option value="<?php echo $baris->id; ?>"><?php echo $baris->no_kode; ?> - <?php echo $baris->kode_surat; ?></option>
									<?php } }?>
                            </select>
					</div>
					<div class="col">
					    <select class="form-control cari_tipe" name="tipe" id="tipe" required>
                           <option value=""></option>
                             <?php
								if(!empty($tipesurat)) {
                                   foreach ($tipesurat as $baris): ?>
                                       <option value="<?php echo $baris->id; ?>"><?php echo $baris->tipe_surat; ?></option>
								<?php endforeach; }?>
                        </select>
					</div>
					<div class="col">
						<select class="form-control cari_jenis" name="jenis" id="jenis" required>
                              <option value=""></option>
                              <?php
									if(!empty($jenissurat)) {
                                    foreach ($jenissurat as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>"><?php echo $baris->jenis_surat; ?></option>
									<?php endforeach; } ?>
                            </select>
					</div>
            </div>			
            <div class="form-group mb-3 row">
                
					
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
            </div>		 
                          
                      </div>
                    </div>
                  </div>                 
                </div>
				
				<div class="card-footer text-end">
                <div class="d-flex">                 
                 			  
				  <a href="../ketatausahaan/suratdisposisi" class="btn btn-primary d-none d-sm-inline-block" title="Refresh"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" /><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" /></svg>Refresh</a>
				  				  
				  <button type="submit" name="caridispo" id="caridispo" class="btn btn-primary ms-auto" style="float:right;"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg> Cari</button>
                </div>
              </div>
              </div>
			  		  
				<input type="hidden" name="id_user" id="id_user" value="<?php echo $userData['id_user']; ?>">
				<input type="hidden" name="jabatan_organisasi_parent_id" id="jabatan_organisasi_parent_id" value="<?php echo $userData['jabatan_organisasi_parent_id']; ?>">
                <div class="table-responsive">				
                  <table id="dptable" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
						<th width="20px;">No.</th>
						<th>Pengirim Disposisi</th>
						<th>Perihal</th>
						<th>Status</th>
						<th></th>
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

		fill_datatable();		
		$('.table tbody tr td:not(:last-child)').click(function () {
			var href = $(this).parent().find('a.sm_detail').attr("href");
			window.location = href;
		});			
	});
	
	
	function fill_datatable()
		{
			var id_userx = jQuery("#id_user").val();
			var jabatan_organisasi_parent_idx = jQuery("#jabatan_organisasi_parent_id").val();
			
			var table = jQuery("#dptable").DataTable({
			
			serverSide : true,
			processing : true,       
			ajax       : {
				method : "GET",
				url  : "<?php echo base_url('ketatausahaan/disposisi_json') ?>",
				data : data => {
					// Read values
					console.log('data', data)
				   
				}
			},
			orderCellsTop : false,
			fixedHeader   : false,
			searching	  : false,
			lengthChange  : false,
			scrollX       : false,			
			columns       : [
								 { "data": null,"sortable": false, 
									render: function (data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1
								}  
							},
							{ data: function(row, type, set) {	
							
								var jabatan_organisasi_penerima = row.jabatan_organisasi_penerima;
								if(jabatan_organisasi_penerima != null){ var jabatan_penerima = row.jabatan_organisasi_penerima; } else {var jabatan_penerima = '';}
								var htmlpengirim = jabatan_penerima +'<br>'+ row.nama_penerima + '<br>NIP: <strong>'+ row.nip_penerima +'</strong>';	
								return htmlpengirim;
								
								}
							},
							{ data: function(row, type, set) {
								
								var surat_eksternal = row.surat_eksternal;
								if(surat_eksternal != null){ var s_eksternal = '<span class="label label-warning" data-toggle="tooltip" data-placement="left" title="Surat dari Eksternal">'+row.surat_eksternal+'</span><br />'; } else {var s_eksternal = '';}								
								
								var surat_perihal = '<strong><a href="suratdisposisi/d/'+ row.id +'" class="sm_detail">'+ s_eksternal +' '+ row.perihal +'</a></strong>';
								
								var htmlCon = surat_perihal + '<br>Perintah Disposisi: <br><small><em>' + row.disposisi_perintah + '</em></small><br><br>No. Surat: <strong>' + row.nomor_surat + '</strong><br> No. Agenda: <strong>'+ row.id_nomor_agenda +'</strong><br> Kode Surat: <strong>'+ row.kode_surat +'</strong><br> Jenis Surat: <strong>'+ row.jenis_surat +'</strong><br>Tipe Surat: <strong>'+ row.tipe_surat +'</strong>';	
								return htmlCon;
								}
							},
							{ data: function(row, type, set) {	
							var first = '<div class="surat-list-status">';
								var st = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" /><path d="M3 6l9 6l9 -6" /><path d="M15 18h6" /><path d="M18 15l3 3l-3 3" /></svg> Surat Dikirim</span>';
								var st2 = '<div class="status-detail"><small class="text-muted"><em>('+ row.tgl_dikirim +')</em></small></div>';
								
							if (row.tgl_diterima == null) {
								var st3 = '<span class="text-muted"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /><path d="M12 11v-8h4l2 2l-2 2h-4" /><path d="M6 15h1" /></svg> Surat Diterima</span>';
								var st4 = '<br /><div class="status-detail">&nbsp;</div>';
							} else {
								var st3 = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /><path d="M12 11v-8h4l2 2l-2 2h-4" /><path d="M6 15h1" /></svg> Surat Diterima</span>';
								var st4 = '<div class="status-detail"><small class="text-muted"><em>('+ row.tgl_diterima +')</em></small></div>';
							}
							
							var jabatan_organisasi_pelaksana = row.jabatan_organisasi_pelaksana;
							var nama_pelaksana = row.nama_pelaksana;
						if (row.disposisi_pelaksana != null) {
								var st5 = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg> Disposisi</span>';
								var st6 = '<div class="status-detail">Pelaksana: <small class="text-muted"><em>'+ row.jabatan_organisasi_pelaksana +' / '+ row.nama_pelaksana +' / NIP:'+row.nip_pelaksana+'</em></small>';
								
								var disposisi_dikirim = row.disposisi_dikirim;
								console.log(disposisi_dikirim)
								var disposisi_diterima = row.disposisi_diterima;
								console.log(disposisi_diterima)
								var disposisi_proses = row.disposisi_proses;
								console.log(disposisi_proses)
								if (disposisi_dikirim != null && disposisi_diterima != null && disposisi_proses != null) {
									var std = '<br />Dikirim: <small class="text-muted"><em>'+disposisi_dikirim+'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_perintah +'">&nbsp;note</span></small>';
									var strima = '<br />Diterima: <small class="text-muted"><em>'+ disposisi_diterima +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_diterima_tanggapan +'">&nbsp;note</span></small>';
									var stpro = '<br />Diproses: <small class="text-muted"><em>'+ disposisi_proses +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_proses_tanggapan +'">&nbsp;note</span></small></div>';
								}
								else if (disposisi_dikirim != null && disposisi_diterima != null) {
									var std = '<br />Dikirim: <small class="text-muted"><em>'+ disposisi_dikirim +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_perintah +'">&nbsp;note</span></small>';
									var strima = '<br />Diterima: <small class="text-muted"><em>'+ disposisi_diterima +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_diterima_tanggapan +'">&nbsp;note</span></small></div>';
									var stpro = '';
								}
								else if (disposisi_dikirim != null) {
									var std = '<br />Dikirim: <small class="text-muted"><em>'+ disposisi_dikirim +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_perintah +'">&nbsp;note</span></small></div>';
									var strima = '';
									var stpro = '';
								}							
								
							if (row.surat_selesai != null) {
								var st7 = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 9 12 15 21 9 12 3 3 9" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><line x1="3" y1="19" x2="9" y2="13" /><line x1="15" y1="13" x2="21" y2="19" /></svg> Surat Selesai</span>';
								var st8 = '<div class="status-detail"><small class="text-muted"><em>' +row.surat_selesai+ '</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.surat_selesai_tanggapan +'">&nbsp;note</span></small></div>';
							}
							else {
								var st7 = '<span class="text-muted"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 9 12 15 21 9 12 3 3 9" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><line x1="3" y1="19" x2="9" y2="13" /><line x1="15" y1="13" x2="21" y2="19" /></svg> Surat Selesai</span>';
								var st8 = '<div class="status-detail"></div><br />';
							}							
							
								} else {
										var st5 = '';
										var st6 = '';
										var std = '';
										var strima = '';
										var stpro = '';
										var jabatan_organisasi_pelaksana = '';
										var nama_pelaksana = '';
										var st7 = '';
										var st8 = '';
								}
								
								var last = '<div>';
										return first+''+st+''+st2+''+st3+''+st4+''+st5+''+st6+''+std+''+strima+''+stpro+''+st7+''+st8+''+last;
										
										}
							},
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 4,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						var td1 = '<a href="../ketatausahaan/suratdisposisi/d/'+cellData+'" data-toggle="tooltip" data-placement="top" title="Detail Surat"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="3" width="14" height="18" rx="2" /><line x1="9" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="15" y2="11" /><line x1="9" y1="15" x2="13" y2="15" /></svg>';
						
						//alert(id_userx+'<>'+rowData.penerima);
						//alert(rowData.pengirim);
						//alert(jabatan_organisasi_parent_idx);
						if (id_userx == rowData.pengirim) {
							//var td2 = '<a data-toggle="tooltip" data-placement="top" title="Hapus Surat" onclick="return eAlert('+cellData+')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;';
							
							var td2 = '<a data-toggle="tooltip" data-placement="top" title="Hapus Surat" onclick="return eAlert('+cellData+')"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>&nbsp;';
							
						} else {
							var td2 = '';
						}
						
						if (id_userx == rowData.penerima) {
							
							
							if(rowData.disposisi_pelaksana != null)
							{
								var tddispo = '<span class="label label-default">Sudah diDisposisi</span>';
							} else {
								var tddispo = '<a href="ketatausahaan/suratdisposisi/disposisi/'+cellData+'"><span class="label label-primary">Disposisi <i class="fa fa-share" aria-hidden="true"></i></span></a>';
							}
							
							
						} else {
							var tddispo = '';
						}
						
						var allin = td1+''+td2+''+tddispo;
						jQuery(td).html(allin)
						
					}
				},
				
			]
				});
		}
		
		
		function fill_search_datatable(id_user = '', tgl_start = '', tgl_end = '', no_surat = '', agenda = '', kode = '', tipe = '', jenis = '', penerima = '', surat_eksternal = '',jabatan_organisasi_parent_idx = '')
		{
			
		   var dataTable = $('#dptable').DataTable({			   
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('ketatausahaan/search_disposisi_json') ?>",
			 type:"POST",
			 data:{
				//id_user:id_user, tgl_start:tgl_start, tgl_end:tgl_end, no_surat:no_surat, agenda:agenda, kode:kode, tipe:tipe, jenis:jenis
				id_user:id_user, tgl_start:tgl_start, tgl_end:tgl_end, no_surat:no_surat, agenda:agenda, kode:kode, tipe:tipe, jenis:jenis, penerima:penerima, surat_eksternal:surat_eksternal, jabatan_organisasi_parent_idx:jabatan_organisasi_parent_idx
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
							
								var jabatan_organisasi_penerima = row.jabatan_organisasi_penerima;
								if(jabatan_organisasi_penerima != null){ var jabatan_penerima = row.jabatan_organisasi_penerima; } else {var jabatan_penerima = '';}
								var htmlpengirim = jabatan_penerima +'<br>'+ row.nama_penerima + '<br>NIP: <strong>'+ row.nip_penerima +'</strong>';	
								return htmlpengirim;
								
								}
							},
							{ data: function(row, type, set) {
								
								var surat_eksternal = row.surat_eksternal;
								if(surat_eksternal != null){ var s_eksternal = '<span class="label label-warning" data-toggle="tooltip" data-placement="left" title="Surat dari Eksternal">'+row.surat_eksternal+'</span><br />'; } else {var s_eksternal = '';}								
								
								var surat_perihal = '<strong><a href="suratdisposisi/d/'+ row.id +'" class="sm_detail">'+ s_eksternal +' '+ row.perihal +'</a></strong>';
								
								var htmlCon = surat_perihal + '<br>Perintah Disposisi: <br><small><em>' + row.disposisi_perintah + '</em></small><br><br>No. Surat: <strong>' + row.nomor_surat + '</strong><br> No. Agenda: <strong>'+ row.id_nomor_agenda +'</strong><br> Kode Surat: <strong>'+ row.kode_surat +'</strong><br> Jenis Surat: <strong>'+ row.jenis_surat +'</strong><br>Tipe Surat: <strong>'+ row.tipe_surat +'</strong>';	
								return htmlCon;
								}
							},
							{ data: function(row, type, set) {	
							var first = '<div class="surat-list-status">';
								var st = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" /><path d="M3 6l9 6l9 -6" /><path d="M15 18h6" /><path d="M18 15l3 3l-3 3" /></svg> Surat Dikirim</span>';
								var st2 = '<div class="status-detail"><small class="text-muted"><em>('+ row.tgl_dikirim +')</em></small></div>';
								
							if (row.tgl_diterima == null) {
								var st3 = '<span class="text-muted"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /><path d="M12 11v-8h4l2 2l-2 2h-4" /><path d="M6 15h1" /></svg> Surat Diterima</span>';
								var st4 = '<br /><div class="status-detail">&nbsp;</div>';
							} else {
								var st3 = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" /><path d="M12 11v-8h4l2 2l-2 2h-4" /><path d="M6 15h1" /></svg> Surat Diterima</span>';
								var st4 = '<div class="status-detail"><small class="text-muted"><em>('+ row.tgl_diterima +')</em></small></div>';
							}
							
							var jabatan_organisasi_pelaksana = row.jabatan_organisasi_pelaksana;
							var nama_pelaksana = row.nama_pelaksana;
						if (row.disposisi_pelaksana != null) {
								var st5 = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg> Disposisi</span>';
								var st6 = '<div class="status-detail">Pelaksana: <small class="text-muted"><em>'+ row.jabatan_organisasi_pelaksana +' / '+ row.nama_pelaksana +' / NIP:'+row.nip_pelaksana+'</em></small>';
								
								var disposisi_dikirim = row.disposisi_dikirim;
								console.log(disposisi_dikirim)
								var disposisi_diterima = row.disposisi_diterima;
								console.log(disposisi_diterima)
								var disposisi_proses = row.disposisi_proses;
								console.log(disposisi_proses)
								if (disposisi_dikirim != null && disposisi_diterima != null && disposisi_proses != null) {
									var std = '<br />Dikirim: <small class="text-muted"><em>'+disposisi_dikirim+'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_perintah +'">&nbsp;note</span></small>';
									var strima = '<br />Diterima: <small class="text-muted"><em>'+ disposisi_diterima +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_diterima_tanggapan +'">&nbsp;note</span></small>';
									var stpro = '<br />Diproses: <small class="text-muted"><em>'+ disposisi_proses +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_proses_tanggapan +'">&nbsp;note</span></small></div>';
								}
								else if (disposisi_dikirim != null && disposisi_diterima != null) {
									var std = '<br />Dikirim: <small class="text-muted"><em>'+ disposisi_dikirim +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_perintah +'">&nbsp;note</span></small>';
									var strima = '<br />Diterima: <small class="text-muted"><em>'+ disposisi_diterima +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_diterima_tanggapan +'">&nbsp;note</span></small></div>';
									var stpro = '';
								}
								else if (disposisi_dikirim != null) {
									var std = '<br />Dikirim: <small class="text-muted"><em>'+ disposisi_dikirim +'</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.disposisi_perintah +'">&nbsp;note</span></small></div>';
									var strima = '';
									var stpro = '';
								}							
								
							if (row.surat_selesai != null) {
								var st7 = '<span class="text-primary"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 9 12 15 21 9 12 3 3 9" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><line x1="3" y1="19" x2="9" y2="13" /><line x1="15" y1="13" x2="21" y2="19" /></svg> Surat Selesai</span>';
								var st8 = '<div class="status-detail"><small class="text-muted"><em>' +row.surat_selesai+ '</em><span class="text-warning" data-toggle="tooltip" data-placement="right" title="'+ row.surat_selesai_tanggapan +'">&nbsp;note</span></small></div>';
							}
							else {
								var st7 = '<span class="text-muted"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="3 9 12 15 21 9 12 3 3 9" /><path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10" /><line x1="3" y1="19" x2="9" y2="13" /><line x1="15" y1="13" x2="21" y2="19" /></svg> Surat Selesai</span>';
								var st8 = '<div class="status-detail"></div><br />';
							}							
							
								} else {
										var st5 = '';
										var st6 = '';
										var std = '';
										var strima = '';
										var stpro = '';
										var jabatan_organisasi_pelaksana = '';
										var nama_pelaksana = '';
										var st7 = '';
										var st8 = '';
								}
								
								var last = '<div>';
										return first+''+st+''+st2+''+st3+''+st4+''+st5+''+st6+''+std+''+strima+''+stpro+''+st7+''+st8+''+last;
										
										}
							},
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 4,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						var td1 = '<a href="../ketatausahaan/suratdisposisi/d/'+cellData+'" data-toggle="tooltip" data-placement="top" title="Detail Surat"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="3" width="14" height="18" rx="2" /><line x1="9" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="15" y2="11" /><line x1="9" y1="15" x2="13" y2="15" /></svg>';
						
						//alert(id_userx+'<>'+rowData.penerima);
						//alert(rowData.pengirim);
						//alert(jabatan_organisasi_parent_idx);
						if (id_user == rowData.pengirim) {
							//var td2 = '<a data-toggle="tooltip" data-placement="top" title="Hapus Surat" onclick="return eAlert('+cellData+')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;';
							
							var td2 = '<a data-toggle="tooltip" data-placement="top" title="Hapus Surat" onclick="return eAlert('+cellData+')"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>&nbsp;';
							
						} else {
							var td2 = '';
						}
						
						if (id_user == rowData.penerima) {
							
							
							if(rowData.disposisi_pelaksana != null)
							{
								var tddispo = '<span class="label label-default">Sudah diDisposisi</span>';
							} else {
								var tddispo = '<a href="ketatausahaan/suratdisposisi/disposisi/'+cellData+'"><span class="label label-primary">Disposisi <i class="fa fa-share" aria-hidden="true"></i></span></a>';
							}
							
							
						} else {
							var tddispo = '';
						}
						
						var allin = td1+''+td2+''+tddispo;
						jQuery(td).html(allin)
						
					}
				},
				
			]
				});
		}
		
		$('#caridispo').click(function(e){
			
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
		 	$('#dptable').DataTable().destroy();
			fill_search_datatable(id_user,tgl_start,tgl_end,no_surat,agenda,kode,tipe,jenis,penerima,surat_eksternal,jabatan_organisasi_parent_idx);
		   } 
		   else if(no_surat == '' && agenda == '' && kode == '' && tipe == '' && jenis == '' && penerima == '' && surat_eksternal == '')
		   {
		 	$('#dptable').DataTable().destroy();
			fill_datatable();
		   }
		});
		 
	function eAlert(x){
		swal({
			title: "Hapus Disposisi Surat?",
			icon: "warning",
			dangerMode: true,
			buttons: ["Batal", "Hapus"]
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Sukses! Disposisi berhasil dihapus.", {
					icon: "success"
				});
				window.location.href = 'ketatausahaan/suratmasuk/h/'+ x +'';
			} else {
				swal("Disposisi batal dihapus");
			}
		});
	}
	
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
	
	</script>