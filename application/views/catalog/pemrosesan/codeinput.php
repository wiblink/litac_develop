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
                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-md-6 col-xl-12">
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Project</label>
					<div class="col">
						<input type="text" name="project" id="project" class="form-control" value="<?php echo $project; ?>" placeholder="Project">
					</div>
			</div>			
            <div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Area</label>
					<div class="col">
						<input type="text" name="location" id="location" class="form-control" value="<?php echo $location; ?>" placeholder="Location">
					</div>
			</div>	
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Status</label>
					<div class="col">
						<input type="text" name="status_project" id="status_project" class="form-control" value="<?php echo $status_project; ?>" placeholder="Status">
					</div>
			</div>
			<div class="form-group mb-3 row">
				<label class="form-label col-3 col-form-label">Note</label>
					<div class="col">
						<input type="text" name="note" id="note" class="form-control" value="<?php echo $note; ?>" placeholder="Note">
					</div>
			</div>			
			<div class="form-group mb-3 row">                
					<div class="col">
						
						<button type="submit" name="cancel" id="cancel" class="btn btn-primary" >Cancel</button>&nbsp;&nbsp;
						<button type="submit" name="btnsaveas" id="btnsaveas" class="btn btn-primary" >Save</button>&nbsp;&nbsp;
						<!--<button type="submit" name="btnconfirm" id="btnconfirm" class="btn btn-primary" >Confirm</button>&nbsp;&nbsp;-->
						
						<?php //echo $data_session; ?>
						
						<?php 
						
						if(isset($_GET['idcart'])){
							$idcart = isset($_GET['idcart']) ? $_GET['idcart'] : '';
							?>
							<button type="submit" name="excelexport" id="excelexport" class="btn btn-outline-info"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#303c42" d="M23.5,3H14V.5A.5.5,0,0,0,13.41,0l-13,2.5A.5.5,0,0,0,0,3V21a.5.5,0,0,0,.41.49l13,2.5h.09a.5.5,0,0,0,.5-.5V21h9.5a.5.5,0,0,0,.5-.5V3.5A.5.5,0,0,0,23.5,3ZM8.95,16.28a.5.5,0,0,1-.89.45L6.5,13.62,4.95,16.72a.5.5,0,0,1-.89-.45L5.94,12.5,4.05,8.72a.5.5,0,0,1,.89-.45L6.5,11.38,8.05,8.28a.5.5,0,0,1,.89.45L7.06,12.5ZM23,20H14V19h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V16h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V13h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V10h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V7h2.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5H14V4h9Z"/><rect width="4" height="2" x="18" y="5" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="8" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="11" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="14" fill="#303c42" rx=".5" ry=".5"/><rect width="4" height="2" x="18" y="17" fill="#303c42" rx=".5" ry=".5"/></svg> Export to Excel</button>&nbsp;&nbsp;
							
							<a href="<?php echo base_url();?>catalog/advanced_search?idcart=<?php echo $idcart; ?>" data-toggle="tooltip" data-placement="top" title="Print Item" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lamp" viewBox="0 0 16 16">
						  <path fill-rule="evenodd" d="M5.04.303A.5.5 0 0 1 5.5 0h5c.2 0 .38.12.46.303l3 7a.5.5 0 0 1-.363.687h-.002c-.15.03-.3.056-.45.081a32.731 32.731 0 0 1-4.645.425V13.5a.5.5 0 1 1-1 0V8.495a32.753 32.753 0 0 1-4.645-.425c-.15-.025-.3-.05-.45-.08h-.003a.5.5 0 0 1-.362-.688l3-7ZM3.21 7.116A31.27 31.27 0 0 0 8 7.5a31.27 31.27 0 0 0 4.791-.384L10.171 1H5.83L3.209 7.116Z"/>
						  <path d="M6.493 12.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.052.075l-.001.004-.004.01V14l.002.008a.147.147 0 0 0 .016.033.62.62 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.62.62 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411Z"/></svg> &nbsp;Add Lamp</a>
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
		  <br>
</div>

<script type="text/javascript">

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