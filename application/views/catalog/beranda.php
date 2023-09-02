<?php
  $cek    = $user->row();
  $id_user = $cek->id_user;
  $nama    = $cek->nama_lengkap;
  $level   = $cek->level;

  $tgl = date('m-Y');
?>

<div class="content-wrapper">
  <div class="content">

    <div class="row">
        <div class="col-lg-12">

         
          <div class="row">
            <div class="col-lg-4">
         
              <div class="panel">
                <div class="panel-body">
                  <h3 class="no-margin"><strong><i class="pull-right fa fa-file-text fa-5x" aria-hidden="true"></i>
                  <?php
                  if ($level == 'user') {
                    echo number_format($this->db->query("SELECT * FROM tbl_sm WHERE id_user='$id_user'")->num_rows(), 0,",",".");
                  }else{
                    echo number_format($this->db->query("SELECT * FROM tbl_sm")->num_rows(), 0,",",".");
                  }?>
                  </strong></h3>
                  Total Semua Surat Masuk
                </div>

               
              </div>
 
            </div>

            <div class="col-lg-4">
             
              <div class="panel">
                <div class="panel-body">
                  <h3 class="no-margin"><strong><i class="pull-right fa fa-file-text-o fa-5x" aria-hidden="true"></i>
                  <?php
                  if ($level == 'user') {
                    echo number_format($this->db->query("SELECT * FROM tbl_sk WHERE id_user='$id_user'")->num_rows(), 0,",","."); 
                  }else{
                    echo number_format($this->db->query("SELECT * FROM tbl_sk")->num_rows(), 0,",",".");
                  }?></strong></h3>
                  Total Semua Surat Keluar
                </div>

             
              </div>
              
            </div>
			
			 <div class="col-lg-4">
             
              <div class="panel">
                <div class="panel-body">
                  <div class="heading-elements">
                    <span class="heading-text"><i class="fa fa-cog fa-4x" aria-hidden="true"></i></span>
                  </div>
                  <h3 class="no-margin"><strong>Master Data</strong></h3>
                 <ul>
					<li>Bagian: <span class="label label-success">&nbsp;&nbsp;3&nbsp;&nbsp;</span></li>
					<li>Kode Surat: <span class="label label-primary">&nbsp;&nbsp;2&nbsp;&nbsp;</span></li>
					<li>Tipe Surat: <span class="label label-warning">&nbsp;&nbsp;4&nbsp;&nbsp;</span></li>
				 </ul>
                </div>

             
              </div>
              
            </div>
			
			
          </div>
         

            <br>
          </div>

        </div>
	
	<div class="row">

		 <div class="col-lg-4">

		  <div class="panel">
		  <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Data User<span class="label label-success pull-right">Total: <?php echo $cusers;?> User</span></h5></div>
		  <hr style="margin:0px;">
                <div class="panel-body">
					<ul class="list-inline list-user-imgul">
					<?php 
					 foreach ($users->result() as $u) {
						 if ($u->login == 1) {
							 $log = '<i class="fa fa-circle" aria-hidden="true" style="color:#4caf50 !important;"></i> '.$u->username.'';
							 $status = $u->nama_lengkap.' Online';
						 }
						 else {
							 $log = '<i class="fa fa-circle" aria-hidden="true"></i> '.$u->username.'';
							 $status = $u->nama_lengkap.' Offline';
						 }
						 echo '<li class="text-center"  data-toggle="tooltip" title="'.$status.'"><img src="'.base_url().'foto/default.png" class="img-circle list-user-img img-thumbnail" alt=""><p>'.$log .'</p></li>';
					 }
					?>
			
		 </ul>
		 <hr style="margin:0px;">
		 <div class="text-center">
		 <br />
			<a href="<?php echo base_url();?>users/pengguna">Lihat Semua User</a>
		 </div>
				</div>
		  </div>
		 
		</div>
		
		<div class="col-lg-4">

		  <div class="panel">
		  <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-firefox" aria-hidden="true"></i> Browser Usage</h5></div>
		  <hr style="margin:0px;">
                <div class="panel-body">
					<script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
					<script src="<?php echo base_url();?>assets/highcharts/modules/exporting.js"></script>
<script src="<?php echo base_url();?>assets/highcharts/modules/export-data.js"></script>
<script src="<?php echo base_url();?>assets/highcharts/modules/accessibility.js"></script>
<figure class="highcharts-figure">
    <div id="list-browser"></div>
</figure>
<script type="text/javascript">
Highcharts.chart('list-browser', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'User Browser <?php echo date("F Y");?>'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  exporting: { 
						enabled: false 
					},
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: false
      },
      showInLegend: true
    }
  },
  credits: {
				        enabled: false
				    },
  series: [{
    name: 'Browser',
    colorByPoint: true,
    data: [<?php $rowt = array();
			foreach ($getbrow as $row) {
			  $rowt[]="{name:'$row->browser', y:$row->tbrowser/$getbrowt * 100}";
			}
			echo implode(",",$rowt);?>]
  }]
});
</script>


				</div>
		  </div>
		 
		</div>
		
				 <div class="col-lg-4">
			<div class="panel">
				<div class="panel-heading"><h5 class="panel-title"><i class="fa fa-windows" aria-hidden="true"></i> Operating System Usage</h5></div>
                <div class="panel-body">
				<figure class="highcharts-figure">
					<div id="list-os"></div>
				</figure>
				<style>
				div#list-os .highcharts-legend-item rect {
				  visibility: hidden;
				}

				div#list-os .xLegendSymbol {
				  font-size: 0px;
				  border: 5px solid;
				  border-radius: 10px;
				  height: 10px;
				  width: 10px;
				   margin-bottom: -5px;
				    margin-right: 5px;
				  /*display: inline-flex;
				  align-items: center;
				  justify-content: center;
				  border: 3px solid;
				  border-radius: 50px;
				  height: 40px;
				  width: 40px;
				  margin-right: 5px;
				  margin-bottom: 5px;*/
				  
				}
				</style>
		<script type="text/javascript">
					Highcharts.chart('list-os', {
					tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
					pie: {
					  allowPointSelect: true,
					  cursor: 'pointer',
					  dataLabels: {
						enabled: false
					  },
					  showInLegend: true
					}
					},
					legend: {
						useHTML: true,
					labelFormatter: function() {
						var legendItem = document.createElement('div'),
						  symbol = document.createElement('span'),
						  label = document.createElement('span');
					  
					  symbol.innerText = this.y.toFixed(2);
					  symbol.style.borderColor = this.color;
					  symbol.classList.add('xLegendSymbol');
					  label.innerText = this.name;
					  
					  legendItem.appendChild(symbol);
					  legendItem.appendChild(label);

						return legendItem.outerHTML;
					}
					},
					 title: {
						text: 'Operating System <?php echo date("F Y");?>'
					},
					exporting: { 
						enabled: false 
					},
					credits: {
				        enabled: false
				    },
					series: [{
					type: 'pie',
					name: 'Operating System',
					innerSize: '50%',
					data: [
					  <?php $rowo = array();
						foreach ($getos as $row) {
						  $rowo[]="['$row->os', $row->tos/$getost * 100]";
						}
						echo implode(",",$rowo);?>
					]
					}]
					});

				</script>
				</div>
			</div>
		 </div>
		
		
		
	</div>

	<div class="row">
	
		<div class="col-lg-8">

		  <div class="panel">
		  <div class="panel-heading"><h5 class="panel-title"><i class="fa fa-user-secret" aria-hidden="true"></i> Recent Activities/Action Logs</h5></div>
		  <hr style="margin:0px;">
                <div class="panel-body">
					 <ul class="list-group">
					 <?php 
					 foreach ($logs->result() as $log) {
						 echo '<li class="list-group-item"><span class="label label-info">'.$log->logtime.'</span> '.$log->nama_lengkap.' ('.$log->username.') - '.$log->logdetail.'</li>';
					 }
					 ?>
</ul> 
		 <hr style="margin:0px;">
		 <div class="text-center">
		 <br />
			<a href="<?php echo base_url();?>users/log">Lihat Semua Log</a>
		 </div>
				</div>
		  </div>
		 
		</div>

	</div>
	
   </div>

</div>
 



