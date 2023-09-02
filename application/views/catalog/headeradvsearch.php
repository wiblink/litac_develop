<?php
$nama   = $userData['nama'];
$kewenangan = $userData['kewenangan'];
$kewenangan_id = $userData['kewenangan_id'];
$menu 	= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
$impl=$sub_menu.'/'.$sub_menu3;
#print_r ($impl);

#$menu = getMenu($this->router->fetch_class(),(strtolower($this->uri->segment(2)) == '' ? $this->router->fetch_class() : strtolower($this->uri->segment(2))) );

$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo $judul_web; ?><?php if($configx[1] !=''){echo ' | '.$configx[1];} ?></title>
    <!-- CSS files -->

	<link href="<?php echo base_url();?>assets/css/progress-tracker.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/css/dropzone.css" rel="stylesheet" type="text/css">
	
	<!--<link href="<?php echo base_url();?>assets/css/tabler.sidebar-dark.css" rel="stylesheet"/>-->
	
	
	<!--<link href="assets/css/themes/<?php echo $configx[5];?>.css" rel="stylesheet" type="text/css">
	<link href="assets/css/sidebar/<?php echo $configx[6];?>.css" rel="stylesheet" type="text/css">-->
	
	<link href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css" rel="stylesheet"/>
	
	<link href="<?php echo base_url();?>assets/css/tabler.sidebar-<?php echo $configx[6];?>.css" rel="stylesheet"/>
	<link href="<?php echo base_url();?>assets/css/tabler.header-<?php echo $configx[5];?>.css" rel="stylesheet"/>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/libraries/jquery-3.5.1.js"></script>	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/loaders/pace.min.js"></script>	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>	
	
	<?php
	if ($sub_menu == "pengguna" or $sub_menu == "bagian" or $sub_menu == "kodesurat" or $sub_menu == "tipesurat" or $sub_menu == "lamp" or $sub_menu == "suratdisposisi" or $sub_menu == "log" or $sub_menu == "jenissurat" or $sub_menu == "suratkeluar" or $sub_menu == "data_sm" or $sub_menu == "data_sk" or $sub_menu == "peserta" or $sub_menu == "regmodul" or $sub_menu == "penyelenggara" or $sub_menu == "widyaiswara" or $sub_menu == "tahun" or $sub_menu == "angkatan" or $sub_menu == "diklat" or $sub_menu == "kelompok" or $sub_menu == "moduldiklat" or $sub_menu == "evaluasi" or $sub_menu == "masterdiklat" or $sub_menu3 == "t" or $sub_menu == "akses" or $sub_menu == "arsip" or $sub_menu == "search_item" or $sub_menu == "user" or $sub_menu == "cart_history" or $sub_menu == "advanced_search") {?>

	<!-- Memanggil Bootstrap & datatable untuk data tables -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap4.min.js"></script>-->	
	
	<link href="<?php echo base_url();?>assets/css/select2.min.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.min.js"></script>
	

	<?php } ?>
	<style type="text/css">

  
	.surat-terkirim .progress-marker::before {
		font-family: FontAwesome;
		content: "\f1d8";
	}
	.surat-dibaca .progress-marker::before {
		font-family: FontAwesome;
		content: "\f2b6";
	}
	.disposisi-dikirim .progress-marker::before {
		font-family: FontAwesome;
		content: "\f024";
	}
	.disposisi-diterima .progress-marker::before {
		font-family: FontAwesome;
		content: "\f11d";
	}
	.disposisi-proses .progress-marker::before {
		font-family: FontAwesome;
		content: "\f11e";
	}
	.surat-selesai .progress-marker::before {
		font-family: FontAwesome;
		content: "\f00c";
	}
	.surat-list-status {
		border-left:3px solid #2196f3 !important;
		padding: 10px 0px 0px 0px;
	}
	.surat-list-status i {
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		background-color: #2196f3 !important;
		color: #fff;
		padding: 4px;
		margin-left: -12px;
	}
	.surat-list-status span.text-muted i{
		background-color: #999 !important;
	}
@keyframes animate {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 0, 64, 0.7), 0 0 0 0 rgba(255, 0, 64, 0.7);
    }
    40% {
        box-shadow: 0 0 0 50px rgba(255, 0, 64, 0), 0 0 0 0 rgba(255, 0, 64, 0.7);
    }
    80% {
        box-shadow: 0 0 0 50px rgba(255, 0, 64, 0), 0 0 0 30px rgba(255, 0, 64, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 0, 64, 0), 0 0 0 30px rgba(255, 0, 64, 0);
    }
}

.panel-body .progress-tracker {
	 margin:10px auto;
 }
 

	
	.progress-step.is-complete .progress-marker::after, .progress-step.is-progress .progress-marker::after{
		background-color: #868686;
		z-index:1;
	}
	.progress-tracker--right .progress-marker::before {
		width:30px !important;
		height:30px !important;
	}
	.status-now .progress-marker::before {
		animation: animate 2s linear infinite;
	}
	.progress-tracker--right .progress-marker::after {
		top:12px !important
	}
	

form.form-horizontal .radio-inline {
	padding-left:20px;
}
small.surat-date {
	font-size: 80%;
}
.status-detail {
	margin-left:10px;
}

.navbar-right li .tooltip-inner {
    max-width: 100% !important;
}
body .navbar-default .navbar-nav > li > a {
	color:#ffffff;
}
.navbar-brand {
	padding: 0px 0px 0px 3px !important;
}
.sidebar-xs .navbar-app {
	display:none;
}
.navbar-app {
	float:left;
	margin-left:10px;
}
.navbar-app .navbar-app-title {
	font-size: 310%;
	font-weight: bold;
	line-height: normal;
}

  </style>
  
  </head>
  <body class="antialiased">
    <div class="page">

      <header class="navbar navbar-expand-md navbar-header d-none d-lg-flex d-print-none">
        <div class="container-xl">
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown d-none d-md-flex me-3">
              <a href="<?php echo base_url();?>catalog/">
			  
			 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
               
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div><?php echo ucwords($nama); ?></div>
                  <div class="mt-1 small text-muted"><?php 
										if($userData['jabatan_organisasi'] != NULL) {
											echo $userData['jabatan_organisasi'];
										}
										else {
											echo ucwords($kewenangan);
										}
										?></div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?php echo base_url();?>catalog/profile" class="dropdown-item">Profile & account</a>
                <div class="dropdown-divider"></div>                
                <a href="<?php echo base_url();?>web/logout" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>