
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
                  <h3 class="card-title">Add Parameter</h3>
                </div>
                <div class="card-body">
                  
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post">
                <div class="form-group mb-3 row">
                  <div class="col">
                    
						<select class="form-control cari_parameter" name="field_parameter" id="field_parameter" required>
                            <option value=""></option>
                            <option value="aplikasi">Aplikasi</option>
							<option value="power_lm">Power Lumen</option>
							<option value="power_watt">Power Watt</option>
							<option value="beam">Beam</option>
							<option value="brand">Brand</option>
							<option value="tipe">Type</option>
							<option value="power">Power</option>
							<option value="watt_light_distr">Watt Light Distribution</option> 
							<option value="colour_temp">Colour Temp</option>
							<option value="ip">IP</option>
							<option value="trim">Trim</option>
							<option value="driver_location">Driver Location</option> 
							<option value="driver">Driver</option>
							<option value="driver_brand">Driver Brand</option>
							<option value="accesories">Accesories</option>
							<option value="finish">Finish</option>
							<option value="housing_material">Housing Material</option>
							<option value="reflector_material">Reflector Material</option>
							<option value="reflector_finish">Reflector Finish</option>
							<option value="optic">Optic</option>
							<option value="diameter">Diameter</option>
							<option value="cut_out_diameter">Cut Out Diameter</option>
							<option value="height">Height</option>
							<option value="width">Width</option>
							<option value="length">Length</option>
                        </select>
							
                  </div>
                  <div class="col">
                    <input type="text" name="parameter" class="form-control" required>
                  </div>
                </div>
				  <div class="form-footer">
                    <button type="submit" name="btninparam" id="btninparam" class="btn btn-primary">Save</button>
                  </div>
			  
				  <div>				
                  <table id="partable" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
						  <th width="20px;">No.</th>
						  <th>Parameter</th>
						  
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
	$(function(){
    // turn the element to select2 select style
    $('.cari_parameter').select2({
      placeholder: "Select Parameter"
    });

    $('.cari_parameter').on('change', function() {
      var datapar = $(".cari_parameter option:selected").text();
      
	  $('#partable').DataTable().destroy();
	  fill_search_parameter(datapar);
    })
  });
  
  function fill_search_parameter(datapar = '')
  {
	  //alert(datapar);
	  
	  var dataTable = $('#partable').DataTable({			   
			processing : true,
			serverSide : true,
			//"order" : [],
			ajax : {
			 url  : "<?php echo base_url('catalog/search_param_json') ?>",
			 type:"POST",
			 data:{
				datapar:datapar
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
							{ data: "parameter_alias", orderable: true }
			]
				});
				
  }
  
</script>