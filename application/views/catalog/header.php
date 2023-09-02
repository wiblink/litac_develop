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
	if ($sub_menu == "pengguna" or $sub_menu == "bagian" or $sub_menu == "kodesurat" or $sub_menu == "tipesurat" or $sub_menu == "lamp" or $sub_menu == "suratdisposisi" or $sub_menu == "log" or $sub_menu == "jenissurat" or $sub_menu == "suratkeluar" or $sub_menu == "data_sm" or $sub_menu == "data_sk" or $sub_menu == "peserta" or $sub_menu == "regmodul" or $sub_menu == "penyelenggara" or $sub_menu == "widyaiswara" or $sub_menu == "tahun" or $sub_menu == "angkatan" or $sub_menu == "diklat" or $sub_menu == "kelompok" or $sub_menu == "moduldiklat" or $sub_menu == "evaluasi" or $sub_menu == "masterdiklat" or $sub_menu3 == "t" or $sub_menu == "akses" or $sub_menu == "arsip" or $sub_menu == "search_item" or $sub_menu == "user" or $sub_menu == "cart_project" or $sub_menu == "type_lamp" or $sub_menu == "advanced_search" or $sub_menu == "cart") {?>

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
      <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
              <!--<img src="./static/logo-white.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">-->
			  <?php echo $configx[0];?>
            </a>
          </h1>
          <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
              <li class="nav-item <?php if ($sub_menu == "") { echo 'active';}?>">
                <a class="nav-link" href="<?php echo base_url();?>catalog" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Dashboard
                  </span>
                </a>
              </li>
              <li class="nav-item <?php echo ($sub_menu == "lamp" ? 'active' : '') ?> dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-lamp" data-bs-toggle="dropdown" role="button" aria-expanded="<?php if ($sub_menu == "lamp") { echo 'true';} else {echo 'false';} ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16">
  <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z"/>
</svg>
                  </span>
                  <span class="nav-link-title">
                    Lamp 
                  </span>
                </a>
                <div class="dropdown-menu <?php echo (($sub_menu == "lamp" || $sub_menu == "convert" || $impl == "lamp/t" )? 'show' : ' ') ?>">
                  
                      <a class="dropdown-item <?php echo ($sub_menu == "lamp" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/lamp" >
                        Lamp List data 
                      </a>
                      <a class="dropdown-item <?php echo ($impl == "lamp/t" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/lamp/t" >
                        Add Lamp
                      </a>                     
					  <a class="dropdown-item <?php echo ($sub_menu == "convert" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/convert" >
                        Convert Data
                      </a>
                </div>
              </li>
			  
			 
			  
			<li class="nav-item <?php if ($sub_menu == "cart_project") { echo 'active';}?>">
                <a class="nav-link" href="<?php echo base_url();?>catalog/cart_project" >				
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg class="icon" width="24" height="24" viewBox="0 0 576 512" fill="currentColor"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"/></svg>
                  </span>
                  <span class="nav-link-title">
                    Cart Project
                  </span>
                </a>
              </li>
			  
			  <li class="nav-item <?php echo ($sub_menu == "suratkeluar" ? 'active' : '') ?> dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-suratkeluar" data-bs-toggle="dropdown" role="button" aria-expanded="<?php if ($sub_menu == "suratkeluar") { echo 'true';} else {echo 'false';} ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="6" rx="2" /><rect x="4" y="14" width="16" height="6" rx="2" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Pengaturan
                  </span>
                </a>
                <div class="dropdown-menu show">

					  <a class="dropdown-item <?php echo ($sub_menu == "search_item" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/search_item" >
                        Search Item
                      </a>
					  
					  <a class="dropdown-item <?php echo ($sub_menu == "type_lamp" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/type_lamp" >
                        Type lamp
                      </a>
                      <a class="dropdown-item <?php echo ($sub_menu == "profile" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/profile" >
                        Profile
                      </a>
                      <a class="dropdown-item <?php echo ($sub_menu3 == "themes" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/pengaturan/themes" >
                        Web
                      </a>                     
					  <!--<a class="dropdown-item <?php echo ($sub_menu3 == "bg" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/pengaturan/bg" >
                        Background & Icons
                      </a>-->
					  <a class="dropdown-item <?php echo ($sub_menu == "user" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/user" >
                        User
                      </a>
                </div>
              </li>
			  
			  <li class="nav-item <?php echo ($sub_menu == "log" ? 'active' : '') ?> dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-registrasi" data-bs-toggle="dropdown" role="button" aria-expanded="<?php if ($sub_menu == "log") { echo 'true';} else {echo 'false';} ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Logs
                  </span>
                </a>
                <div class="dropdown-menu <?php  echo (($sub_menu == "log")  ? 'show' : ' ') ?>">
                      <a class="dropdown-item <?php echo ($sub_menu == "log" ? 'active' : ' ') ?>" href="<?php echo base_url();?>catalog/log" >
                        Action Logs
                      </a>
					 
                </div>
              </li>
			  <li class="nav-item <?php if ($sub_menu == "advanced_search") { echo 'active';}?>">
                <a class="nav-link" href="<?php echo base_url();?>catalog/advanced_search" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="15" cy="15" r="4" /><path d="M18.5 18.5l2.5 2.5" /><path d="M4 6h16" /><path d="M4 12h4" /><path d="M4 18h4" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Advanced Search
                  </span>
                </a>
              </li>  
			  
            </ul>
          </div>
        </div>
      </aside>
      <header class="navbar navbar-expand-md navbar-header d-none d-lg-flex d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown d-none d-md-flex me-3">
              <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                <span class="badge bg-red"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                <div class="card">
                  <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet debitis et magni maxime necessitatibus ullam.
                  </div>
                </div>
              </div>
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
          <div class="collapse navbar-collapse" id="navbar-menu">
            <!--<div>
              <form action="." method="get">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                  </span>
                  <input type="text" class="form-control" placeholder="Search…" aria-label="Search in website">
                </div>
              </form>
            </div>-->
          </div>
        </div>
      </header>