<script>
$(document).ready(function () {
                        $(".cari_tipe").select2({
                            placeholder: "Type",
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
                <h2 class="page-title">
                  Search Item
                </h2>
              </div>
            </div>
          </div>
          <div class="row row-cards">

            <div class="col-lg-8">
              <div class="card card-lg">
			  <div class="card-header">
                  <h3 class="card-title">Add Type Lamp</h3>
                </div>
                <div class="card-body">
                  
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post">
                <div class="form-group mb-3 row">
				<input type="hidden" name="id" id="id" value="<?php echo $query->id_product_type; ?>">
				<label class="form-label col-3 col-form-label">Category</label>
                  <div class="col">
                    
						<select class="form-control cari_tipe" name="side" id="side" required>
                            <option value=""></option>
                            <option value="I" <?php if("I" == $query->side){echo "selected";} ?> >Indoor</option>
							<option value="O" <?php if("O" == $query->side){echo "selected";} ?>>Outdoor</option>
                        </select>
							
                  </div>
                </div>
				
				<div class="form-group mb-3 row">
                <label class="form-label col-3 col-form-label">Type</label>
					<div class="col">
					   <input type="text" name="name_product_type" id="name_product_type" value="<?php echo $query->name_product_type; ?>" class="form-control" required>
					</div>
				</div>			
				<div class="form-footer">
                    <button type="submit" name="btnupdate" id="btnupdate" class="btn btn-primary">Update</button>				
                </div>
			  
				  <div>				
                 <table id="partable" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
						  <th width="20px;">No.</th>
						  <th>Type</th>
						  <th>side</th>
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
      
</div>
<script>
	$(document).ready(function() {
	
   
	$(".cari_tipe").change(function () {
      var dtype = this.value;
	  //alert(dtype);
	  $('#name_product_type').val("");
	   
	   $('#partable').DataTable().destroy();
	   var dataTable = $('#partable').DataTable({
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('catalog/search_type_json') ?>",
			 type:"POST",
			 data:{
				dtype:dtype
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
							{ data: "name_product_type", orderable: true },
							{ data: "side", orderable: false },
							{ data: "id_product_type", orderable: false },
			],
			columnDefs: [
				{
					targets     : 3,
					createdCell : (td, cellData, rowData, row, col) => {
						//console.log('OK', cellData)
						jQuery(td).html("<div class='row g-2 align-items-center mb-n3'><div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href='type_lamp/e/"+ cellData +"' class='btn btn-twitter w-100 btn-icon'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3' /><path d='M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3' /><line x1='16' y1='5' x2='19' y2='8' /></svg></a></div>&nbsp;&nbsp;&nbsp;<div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a data-toggle='tooltip' data-placement='top' class='btn btn-google w-100 btn-icon' title='Hapus Lampu' onclick='return eAlert("+ cellData +")'><svg class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><line x1='4' y1='7' x2='20' y2='7' /><line x1='10' y1='11' x2='10' y2='17' /><line x1='14' y1='11' x2='14' y2='17' /><path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' /><path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' /></svg></a></div></div>")
					}
				}
			]
			
				});			
	  
    });
	
  });  
</script>