<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/extensionicon.css">
<script>
                
			$(document).ready(function () {
                        $(".find_prjtype").select2({
                            placeholder: "Type of Project",
							allowClear: true
                });
			  
			});

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
                  Cart
                </div>
                <h2 class="page-title">
                 <svg class="icon" width="24" height="24" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM272 180H316V224C316 235 324.1 244 336 244C347 244 356 235 356 224V180H400C411 180 420 171 420 160C420 148.1 411 140 400 140H356V96C356 84.95 347 76 336 76C324.1 76 316 84.95 316 96V140H272C260.1 140 252 148.1 252 160C252 171 260.1 180 272 180zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg> <?php echo $judul_web; ?>
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">                    
                  </span>               
                </div>
              </div>
            </div>
          </div>
          <div class="row row-deck row-cards">

           <div class="col-12">
              <div class="card">
                                
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
              	<input type="hidden" name="idlamp" id="idlamp" class="form-control" value="">
				<input type="hidden" name="idcart_group" tabindex="1" id="idcart_group" value=""/>
				<input type="hidden" name="data_session" id="data_session" value="<?php echo $data_session; ?>"/>
				<input type="hidden" name="code" id="code" value="<?php echo $code; ?>"/>
				
				<div class="card-body">
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-md-12 col-xl-12">
			<div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Project Name</label>
					<div class="col">
						<input type="text" name="project" id="project" class="form-control" value="<?php echo $project; ?>" placeholder="Project">
					</div>
					
				<label class="form-label col-2 col-form-label">Litac PIC</label>
					<div class="col">
						<input type="text" name="litac_pic" id="litac_pic" class="form-control" value="<?php echo $litac_pic; ?>" placeholder="Litac PIC" required>
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Proj.NR</label>
					<div class="col">
						<input type="text" name="projnr" id="projnr" class="form-control" value="<?php echo $projnr; ?>" placeholder="projnr">
					</div>
				<label class="form-label col-2 col-form-label">Architect</label>
					<div class="col">
						<input type="text" name="architech" id="architech" class="form-control" value="<?php echo $architech; ?>" placeholder="Architech">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Type of Project</label>
					<div class="col">
						<select class="form-control find_prjtype" name="idproject_type" id="idproject_type">
                              <option value=""></option>
                              <?php
									if(!empty($prjtypedt)) {
                                    foreach ($prjtypedt as $row) { ?>
									<option value="<?php echo $row->idproject_type; ?>" <?php if($row->idproject_type == $idproject_type){echo "selected";} ?>><?php echo $row->project_type_name; ?></option>
									<?php } }?>
                        </select>
					</div>
				<label class="form-label col-2 col-form-label">Interior design</label>
					<div class="col">
						<input type="text" name="interiordesign" id="interiordesign" class="form-control" value="<?php echo $interiordesign; ?>" placeholder="Interior design">
					</div>				
			</div>				
            <div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Area</label>
					<div class="col">
						<input type="text" name="location" id="location" class="form-control" value="<?php echo $location; ?>" placeholder="Location">
					</div>
				<label class="form-label col-2 col-form-label">Landscape</label>
					<div class="col">
						<input type="text" name="landscape" id="landscape" class="form-control" value="<?php echo $landscape; ?>" placeholder="Landscape">
					</div>
				
			</div>	
			<div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Status</label>
					<div class="col">
						<input type="text" name="status_project" id="status_project" class="form-control" value="<?php echo $status_project; ?>" placeholder="Status">
					</div>
				<label class="form-label col-2 col-form-label">M&E Consultant</label>
					<div class="col">
						<input type="text" name="meconsult" id="meconsult" class="form-control" value="<?php echo $meconsult; ?>" placeholder="M&E Consultant">
					</div>				
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Date</label>
					<div class="col">
									<div class="input-icon">
										<span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
										</span>
										<input type="text" name="tanggal_project" id="tanggal_project" class="form-control" value="<?php echo $tanggal_project; ?>" required placeholder="Tanggal">
									</div>					 
					</div>
				<label class="form-label col-2 col-form-label">Other</label>
					<div class="col">
						<input type="text" name="prother" id="prother" class="form-control" value="<?php echo $prother; ?>" placeholder="Other">
					</div>
			</div>				
			<div class="form-group mb-3 row">
				<label class="form-label col-2 col-form-label">Note</label>
					<div class="col">
						<input type="text" name="note" id="note" class="form-control" value="<?php echo $note; ?>" placeholder="Note">
					</div>				
			</div>			
			<div class="form-group mb-3 row">                
					<div class="col">
						
						<!--<button type="submit" name="cancel" id="cancel" class="btn btn-primary" >Cancel</button>&nbsp;&nbsp;
						<button type="submit" name="btnsaveas" id="btnsaveas" class="btn btn-primary" >Save</button>&nbsp;&nbsp;
						<button type="submit" name="btnconfirm" id="btnconfirm" class="btn btn-primary" >Confirm</button>&nbsp;&nbsp;-->
						
						<?php //echo $data_session; ?>
						
						<?php 
						
						if(isset($iddata)){
							$idcart = isset($iddata) ? $iddata : '';
							?>
							<button type="submit" name="excelexport" id="excelexport" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#303c42" d="M23.5,3H14V.5A.5.5,0,0,0,13.41,0l-13,2.5A.5.5,0,0,0,0,3V21a.5.5,0,0,0,.41.49l13,2.5h.09a.5.5,0,0,0,.5-.5V21h9.5a.5.5,0,0,0,.5-.5V3.5A.5.5,0,0,0,23.5,3ZM8.95,16.28a.5.5,0,0,1-.89.45L6.5,13.62,4.95,16.72a.5.5,0,0,1-.89-.45L5.94,12.5,4.05,8.72a.5.5,0,0,1,.89-.45L6.5,11.38,8.05,8.28a.5.5,0,0,1,.89.45L7.06,12.5ZM23,20H14V19h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V16h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V13h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V10h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V7h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V4h9Z"/><rect width="4" height="2" x="18" y="5" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="8" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="11" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="14" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="17" fill="#303c42" rx=".5" ry=".5"/></svg> Export to Excel</button>&nbsp;&nbsp;
							

							<a href="<?php echo base_url();?>catalog/advanced_search?idcart=<?php echo $kodedata; ?>" data-toggle="tooltip" data-placement="top" title="Print Item" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lamp" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M5.04.303A.5.5 0 0 1 5.5 0h5c.2 0 .38.12.46.303l3 7a.5.5 0 0 1-.363.687h-.002c-.15.03-.3.056-.45.081a32.731 32.731 0 0 1-4.645.425V13.5a.5.5 0 1 1-1 0V8.495a32.753 32.753 0 0 1-4.645-.425c-.15-.025-.3-.05-.45-.08h-.003a.5.5 0 0 1-.362-.688l3-7ZM3.21 7.116A31.27 31.27 0 0 0 8 7.5a31.27 31.27 0 0 0 4.791-.384L10.171 1H5.83L3.209 7.116Z"/>
						  <path d="M6.493 12.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.052.075l-.001.004-.004.01V14l.002.008a.147.147 0 0 0 .016.033.62.62 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.62.62 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411Z"/></svg> &nbsp;Search From Database</a>
						  
						  
						  <a href="<?php echo base_url();?>catalog/lamp/t?idcart=<?php echo $kodedata; ?>" data-toggle="tooltip" data-placement="top" title="Print Item" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lamp" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M5.04.303A.5.5 0 0 1 5.5 0h5c.2 0 .38.12.46.303l3 7a.5.5 0 0 1-.363.687h-.002c-.15.03-.3.056-.45.081a32.731 32.731 0 0 1-4.645.425V13.5a.5.5 0 1 1-1 0V8.495a32.753 32.753 0 0 1-4.645-.425c-.15-.025-.3-.05-.45-.08h-.003a.5.5 0 0 1-.362-.688l3-7ZM3.21 7.116A31.27 31.27 0 0 0 8 7.5a31.27 31.27 0 0 0 4.791-.384L10.171 1H5.83L3.209 7.116Z"/>
						  <path d="M6.493 12.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.052.075l-.001.004-.004.01V14l.002.008a.147.147 0 0 0 .016.033.62.62 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.62.62 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411Z"/></svg> &nbsp;Create New</a>
						  
						  
							<?php
						} else {
							
						} ?>
						
						
						
					</div>
            </div>
                          
                      </div>
                    </div>
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
		  <?php
                echo '<br>'.$this->session->flashdata('msgcode');
                ?>
		<form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
		<input type="hidden" name="iddata" id="iddata" value="<?php echo $iddata; ?>"/>
		<div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                      <div class="row">
                        <div class="col-md-9 col-xl-6">
							<div class="form-group row">
								<label class="form-label col-3 col-form-label">Code</label>
									<div class="col-sm">
										<!--<input type="text" name="codelamp" id="codelamp" class="form-control" value="<?php echo $codelamp; ?>" placeholder="Code">-->
										<input type="text" name="codes" id="codes" class="form-control" value="" placeholder="Code" maxlength=5 oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
									</div>-
									<!--<div class="col-sm">
										<label class="form-label col-form-label">-</label>
									</div>-->
									<div class="col-sm">
										<input type="text" name="codes2" id="codes2" class="form-control" value="" placeholder="Code" maxlength=5 oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
									</div>/
									<!--<div class="col-sm">
										<label class="form-label col-form-label">/</label>
									</div>-->
									<div class="col-sm">
										<input type="text" name="codes3" id="codes3" class="form-control" value="" placeholder="Code" maxlength=5 oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
									</div>
									<div class="col-sm">
										<button type="submit" name="btnsavecode" id="btnsavecode" class="btn btn-primary" >Save</button>									
									</div>
									<div class="col-sm">
										<a href="../catalog/cart?idcart=<?php echo $code; ?>" class="btn btn-primary d-none d-sm-inline-block" title="Back"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg>Back</a>
									</div>
							</div>
						</div>
					  </div>
					</div>
				</div>
				<br>
				<div class="row" id='pnlSeldata'>
                    <div class="col-xl-12">
                      <div class="row">
						<div class="table-responsive">
                        <table class="table card-table table-vcenter datatable" width="100%">
                          <tr style="background:#222;color:#f1f1f1;">
							<th><b>Code</b></th>
							 <th><b>Type</b></th>
							 <th><b>Brand</b></th>
							 <th><b>Name</b></th>
							 <th><b>Adj</b></th>
							 <th><b>Power</b></th>
							 <th><b>lumen</b></th>
							 <th><b>CCT</b></th>
							 <th><b>Optic</b></th>
							 <th><b>Shape</b></th>
							 <th><b>Diameter</b></th>
							 <th><b>IP</b></th>
                          </tr>
						  <tr>
							  <td><?php echo $cekcode; ?></td>
                              <td><?php echo $lamp_catside.' - '.$lamp_cat; ?></td>
							  <td><?php echo $name_product_brand; ?></td>
							  <td><?php echo $product_brand_name; ?></td>							  
							  <td><?php echo $ajust; ?></td>							  
							  <td><?php echo $power; ?></td>
							  <td><?php echo $lumen; ?></td>							  
							  <td><?php echo $color_temperature; ?></td>
							  <td><?php echo $name_optic; ?></td>
							  <td><?php echo $shape; ?></td>
							  <td><?php echo $dim_diameter; ?></td>
							  <td><?php echo $tecspec_ip; ?></td>
						  </tr>
						</table>
					  </div>
					</div>
					</div>
				</div>
				<?php echo $panel; ?>
		</form>
		  <div class="row row-deck row-cards">
           <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Project Cart</h3>
                </div>
                				
				<div class="card-body">
					<div class="mb-3">
					<div class="col">
                      <?php
					  
						$idpar = '_'.$code;						
								
                echo $this->session->flashdata('msgdel');
                ?>
						<div class="table-responsive">
                        <table class="table card-table table-vcenter datatable" width="100%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th><b>NO.</b></th>
							<th><b>CODE</b></th>
                            <th><b>Type</b></th>
							<th><b>Brand</b></th>
							<th><b>Name</b></th>
							<th><b>Adj</b></th>
							<th><b>Power</b></th>
							<th><b>lumen</b></th>
							<th><b>CCT</b></th>
							<th><b>Optic</b></th>
							<th><b>Shape</b></th>
							<th><b>Diameter</b></th>
							<th><b>IP</b></th>
							<th><b>Action</b></th>
                          </tr>
                          <?php	
						 # echo $code;
						if($code != null)
						{							
							$cartlist = json_decode(ecurl('GET','cartlist/'.$code))->data;
						} else {							
							$cartlist = json_decode(ecurl('GET','cartlistsession/'.$data_session))->data;
						}
						 if(!empty($cartlist)) {
                          $no = 1;
                          foreach ($cartlist as $baris) {
						  
						  $side = $baris->adv_lamp_side;
							if($side == 'I')
								{
									$lamp_catside =  'Indoor';
									$cat = $baris->adv_cat_indoor;
									if($cat!=null)
									{
										$category = json_decode(ecurl('GET','viewcatlamp/'.$cat))->data;
									$lamp_cat =  $category->name_product_type;
									} else {
										$lamp_cat = '';
									}
									
								} else {
									$lamp_catside =  'Outdoor';
									$cat = $baris->adv_cat_indoor;
									if($cat!=null)
									{
									$category = json_decode(ecurl('GET','viewcatlamp/'.$cat))->data;
									$lamp_cat =  $category->name_product_type;
									} else {
										$lamp_cat = '';
									}
								}
			?>
                            <tr>
                              <td><?php echo $no; ?></td>
							  <td><?php echo $baris->codelamp; ?></td>
							  <td><?php echo '<li>'.$lamp_catside.'</li><br><li>'.$lamp_cat.'</li>'; ?></td>                             
							  <td><?php echo $baris->name_product_brand; ?></td>
							  <td><?php echo $baris->product_brand_name; ?></td>
							  <td><?php echo $baris->ajust; ?></td>
							  <td><?php echo $baris->power; ?></td>
							  <td><?php echo $baris->lumen; ?></td>
							  <td><?php echo $baris->color_temperature; ?></td>
							  <td><?php echo $baris->name_optic; ?></td>
							  <td><?php echo $baris->shape; ?></td>
							  <td><?php echo $baris->dim_diameter; ?></td>
							  <td><?php echo $baris->tecspec_ip; ?></td>							
							  <td>
							  
							 <div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href="<?php echo base_url();?>catalog/inputcartcode?id=<?php echo $baris->idcart; ?><?php echo $idpar; ?>" data-toggle="tooltip" data-placement="top" title="Print Item" class="btn btn-primary w-100">Code</a></div>
							 
							  <div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href="<?php echo base_url();?>catalog/lamp/mod?id=<?php echo $baris->idcart; ?><?php echo $idpar; ?>" data-toggle="tooltip" data-placement="top" title="Print Item" class="btn btn-primary w-100">Modify</a></div>
							  
							 <div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href="<?php echo base_url();?>catalog/print_spec?id=<?php echo $baris->idcart; ?><?php echo $idpar; ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Item" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 224H88c30.9 0 56 25.1 56 56s-25.1 56-56 56H80v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V320 240c0-8.8 7.2-16 16-16zm24 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H80v48h8zm72-64c0-8.8 7.2-16 16-16h24c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H176c-8.8 0-16-7.2-16-16V240zm32 112h8c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16h-8v96zm96-128h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H304v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H304v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V304 240c0-8.8 7.2-16 16-16z"/></svg></a></div>
							
							  <div class='col-6 col-sm-4 col-md-2 col-xl-auto mb-3'><a href="<?php echo base_url();?>catalog/cart/del?idct=<?php echo $baris->idcart; ?><?php echo $idpar; ?>" data-toggle="tooltip" data-placement="top" title="Delete Item" class="btn btn-primary w-100"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a></div></td>							  
                            </tr>
                          <?php
                            $no++;
						  } }?>
                        </table>
    					</div>
						</div>
                    </div>			
				</div>  
              </div>
            </div>
          </div>
</div>

<script type="text/javascript">

jQuery(document).ready(function() {

				$('#project').prop('disabled', true);
				$('#idproject_type').prop('disabled', true);
				$('#projnr').prop('disabled', true);
				$('#location').prop('disabled', true);
				$('#status_project').prop('disabled', true);
				$('#tanggal_project').prop('disabled', true);
				$('#note').prop('disabled', true);				
				$('#litac_pic').prop('disabled', true);
				$('#architech').prop('disabled', true);
				$('#interiordesign').prop('disabled', true);
				$('#landscape').prop('disabled', true);
				$('#meconsult').prop('disabled', true);
				$('#prother').prop('disabled', true);
				$('#btnsaveas').toggle(false);
			
				});
			
				
 	document.addEventListener("DOMContentLoaded", function () {
    	window.Litepicker && (new Litepicker({
    		element: document.getElementById('tanggal_project'),
    		buttonText: {
    			previousMonth: '<svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>',
    			nextMonth: '<svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>',
    		},
    	}));
    });
	
</script>