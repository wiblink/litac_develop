<?php 
$configx = explode("#", configx()->config);
$bgx = explode("#", bgx()->config);
?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo base_url('assets/images/favicon/'.$bgx[1]);?>" sizes="16x16" type="image/png">
	<base href="<?php echo base_url();?>"/>
	<title>Kuesioner</title>
	<style type="text/css">
		body{
			background-color:#f5f5f5;
		<?php if($bgx[0] != '') {?>
			background-image: url("<?php echo base_url();?>assets/images/backgrounds/<?php echo $bgx[0];?>");
			background-repeat: no-repeat;
		<?php }?>
		}
	</style>
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="assets/css/themes/<?php echo $configx[5];?>.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>


</head>

<body class="login-container">


		
		<div class="page-container">

			
			<div class="page-content">

				
				<div class="content-wrapper">

					
					<div class="content">

<div class="container">
<div class="panel panel-body col-lg-8">

<div id="data">
    <form action="" method="post" id="form-que">
		<div class="page-header">
              <h1 id="forms"><center><strong>KUESIONER DIKLAT</strong></center></h1>
            </div>
		<?php
			echo $this->session->flashdata('msg');
		?>
        <input type="hidden" class="form-control" placeholder="peserta" name="peserta" value="8" required>
		<input type="hidden" class="form-control" placeholder="diklat" name="diklat" value="3" required>
		<?php 
		foreach ($arr as $q) { ?>

		<div class="form-group has-feedback has-feedback-left">
			<label for="q<?php echo $q;?>"><h5><?php echo judulq($q)->judul_q;?></h5></label>
			 <?php 
			 $pilih = array (1=>'Sangat Buruk', 'Buruk', 'Biasa', 'Baik', 'Sangat Baik');
			 $pilihr = array_reverse($pilih,true);

				$opsi_pilih = '';
				$x = 1;
				$length = count($pilihr);
					foreach ($pilihr as $key => $value) {
						
						$opsi_pilih .= '
						<div class="radio">
							<label><input type="radio" name="q'.$q.'" id="q'.$q.'" value="'.$key.'" required>'.$value.'</label>
						</div>';
						
					}
				$opsi_pilih .= '';

				echo $opsi_pilih;
			 ?>
		</div>

		<?php } ?>
        <div class="col-md-12">
          <div class="col-md-3">
            <div class="form-group">
              <a id="btnbatal" class="btn btn-warning btn-block btn-lg"><i class="icon-spinner11 position-left"></i> Batal</a>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-block btn-lg" name="kirim_k" id="kirim_k">Submit <i class="icon-envelop3 position-right"></i></button>
            </div>
          </div>
        </div>

    </form>
</div>

</div>

</div>

<?php
function judulq($id) {
	$ci =& get_instance();
	$ci->load->database();	
	$ci->db->from('diklat_evaluasi_q');
	$ci->db->where('id_q',$id);
	$query = $ci->db->get()->row();
	return $query;
}
?>

					
					<div class="footer text-muted text-center">
						 <?php $configx = explode("#", configx()->config); if($configx[3] !=''){echo $configx[3].' | ';}?>Copyright &copy; <?php echo date('Y');?> <strong><?php echo $configx[0];?></strong>, All Rights Reserved.
					</div>
					

				</div>
				

			</div>
			

		</div>
		

	</div>
	

</body>
</html>

 