<?php 
$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>
  <link rel="stylesheet" href="<?php echo base_url();?>assetsprimary/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assetsprimary/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assetsprimary/css/components.css">
  <link rel="icon" href="<?php // echo base_url('assetsprimary/images/favicon/'.$bgx[1]);?>" sizes="16x16" type="image/png">
  <style>
	  body
      {
          <?php if($bgx[0] != '') {?>
			background-image: url("<?php echo base_url();?>assetsprimary/images/backgrounds/<?php echo $bgx[0];?>");
			background-repeat: no-repeat;
			background-size:cover;
		<?php }?>
      }
  </style>
</head>