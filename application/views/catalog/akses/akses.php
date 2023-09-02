<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<div class="content-wrapper">
 
  <div class="content">
    <?php
    echo $this->session->flashdata('msg');
    ?>
   
    <div class="row">
      
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="fa fa-file-code-o" aria-hidden="true"></i> Akses</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
			<br>
			<a href="ketatausahaan/akses/t" class="btn btn-primary">+ <i class="fa fa-file-code-o" aria-hidden="true"></i> Tambah Menu</a>
        </div>
		
		<div class="panel panel-flat">
            <div class="panel-body">
              <fieldset class="content-group">
                <form class="form-horizontal" action=""  id="frm-example" method="post">				   
				
                      <label class="control-label col-lg-1">Cari</label>
						<div class="col-lg-4">
                            <select class="form-control cari_pengguna" name="pengguna" id="pengguna" required>
                              <option value=""></option>
                              <?php
									if(!empty($pengguna)) {
                                    foreach ($pengguna as $baris): ?>
                                        <option value="<?php echo $baris->id; ?>">NIP : <?php echo $baris->nip; ?> - <?php echo $baris->nama_lengkap; ?> <?php if($baris->jabatan_organisasi != NULL){echo '('.$baris->jabatan_organisasi.')';}?></option>
									<?php endforeach; }?>
                            </select>
						</div>
						<div class="col-lg-1">
                            <button type="submit" name="btncari" id="btncari" class="btn btn-primary" style="float:right;">Simpan</button>
						</div>						
                                     
               
              </fieldset>
            </div>
        </div>
		
			<table id="accestable" class="table table-hover table-bordered dataTable no-footer" width="100%">
			  <thead>
				<tr>
				  <th width="30px;">No.</th>
				  <th class="text-center">Menu</th>
				  <th class="text-center">URL</th>
				  <th class="text-center">Grup</th>
				  <th class="text-center">Icon</th>
				  <th class="text-center"><label for="select_all">
										<input type="checkbox" id="select_all" onclick="selectAll()" name="select_all" value="1" > Select All
									</label></th>			  
				</tr>
			  </thead>
			  <!--<tbody>
			  </tbody>-->
			</table>
		</form>
      </div>
     
    </div>
    
<!-- Memanggil jQuery data tables -->			  
		<script type="text/javascript">	
			
		jQuery(document).ready(function() {
		
		//var rows_selected = [];
		var pengguna = jQuery("#pengguna").val();
		  
		fill_datatable();
			
		function fill_datatable()
		{
			var table = jQuery("#accestable").DataTable({
			serverSide : true,
			processing : true,
			ajax       : {
				method : "GET",
				url  : "<?php echo base_url('ketatausahaan/akses_json') ?>",
				data : data => {
					// Read values
					console.log('data', data)
				   
				}
			},
			
			orderCellsTop : false,
			fixedHeader   : false,
			searching	  : false,
			lengthChange  : false,
			pageLength	  : 20,	
			columns       : [
								 { "data": null,"sortable": false, 
									render: function (data, type, row, meta) {
									return meta.row + meta.settings._iDisplayStart + 1
								}  
							},
							{ data: "menu", orderable: true },
							{ data: "url", orderable: true },
							{ data: "grup", orderable: true },
							{ data: function(row, type, set) {								
								var ico = row.icon;								
								var htmlicon = ico +'&nbsp;<br>Icon : <i class="fa '+row.icon+'" aria-hidden="true"></i>';	
								return htmlicon;								
								}
							},
							{ data: "id", orderable: false },
			],
			columnDefs: [
				{
					targets     : 5,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<input type='checkbox' id='check_"+ cellData +"' name='check_"+ cellData +"' class='editor-active'>")
					}
				}
			]
				});
		}

		 
		function fill_search_dataacces(pengguna = '')
		{
		   //var dataTable = $('#accestable').DataTable({		
			
		   //});
		}
		 
  
		$('#btncari').click(function(e){
		  var pengguna = jQuery("#pengguna").val();
		 
		  e.preventDefault();
		 
		   if(pengguna != '')
		   {
			$('#accestable').DataTable().destroy();
			fill_search_dataacces(pengguna);
		   }
		   else
		   {
			//alert('Select Both filter option');
			$('#accestable').DataTable().destroy();
			fill_datatable();
		   }
		});
  
		$(".cari_pengguna").select2({
            placeholder: "Pilih Pengguna"
         });	
			
			
			
		});
		
		
  
   
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form).serialize());
      console.log("Form submission", $(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });
   
		function selectAll() {
                var is_checked = document.getElementById('select_all').checked;

                if (is_checked) {
                    $('.editor-active').prop('checked', true);
                } else {
                    $('.editor-active').prop('checked', false);
                }

                console.log(is_checked);
            }
		 
		</script>