<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'classes/doc2txt.class.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Catalog extends CI_Controller {
	
 public function __construct(){
    parent::__construct();
    
	$this->load->helper('tanggal_helper');
	$this->load->helper('config_helper');
	//$this->load->helper('menu_helper');
	//$this->load->library('Pdf');
	$userData = $this->session->userdata();
	
	if(!isset($userData['login_etatausaha'])) {
			$this->session->sess_destroy();
			redirect('web/login');
	}
	if(!isset($userData['nip'])) {
		redirect('web/login');
	}
  }
  
 public function test() {
	 /*$originalDate = "21-09-2020";
	 $newDate = date("Y-m-d", strtotime($originalDate));
	 echo $newDate;*/
	 //echo notifikasi()->surat_masuk;
	 $userData = $this->session->userdata();
	echo 'kewenangan'.$userData['kewenangan'];
	echo '<br />kewenangan id'.$userData['kewenangan_id'];
	//echo $userData['nip'];
	echo $userData['id_user'];
 }
  
  public function index(){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		$data['judul_web'] = "Dashboard";
		$data['logs'] = json_decode(ecurl('GET','logs/limit/10/offset/0'))->data;
		$data['browser'] = json_decode(ecurl('GET','browser/tahun/'.date('Y').'/bulan/'.date('m')))->data;
		$data['os'] = json_decode(ecurl('GET','os/tahun/'.date('Y').'/bulan/'.date('m')))->data;
		$monday = strtotime("last monday");
		$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
		$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
		$this_week_sd = date("Y-m-d",$monday);
		$this_week_ed = date("Y-m-d",$sunday);
		
		$cek    = $this->session->userdata();
		//die(print_r($cek));
		  $id_user = $cek['id_user'];
		  $nama    = $cek['nama'];
		  $level   = $cek['kewenangan'];
  
		if(isset($_GET['tipe'])) {
			if ($_GET['tipe'] == 'bulan') {
				$data['reportsurat'] = json_decode(ecurl('GET','reportsurat/fromDate/2020-10-01/toDate/2020-10-20'))->data;
			}
			else if ($_GET['tipe'] == 'minggu') {
				$data['reportsurat'] = json_decode(ecurl('GET','reportsurat/fromDate/'.$this_week_sd.'/toDate/'.$this_week_ed))->data;
			}
			else if ($_GET['tipe'] == 'tahun') {
				
			}
		}
		else {
			//$data['reportsurat'] = json_decode(ecurl('GET','reportsurat/fromDate/'.$this_week_sd.'/toDate/'.$this_week_ed))->data;
		}
		$this->load->view('catalog/header', $data);
		$this->load->view('catalog/dashboard', $data);
		$this->load->view('catalog/footer');
	}
	
	
	// Profile
	public function profile()
	{
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Profile";
		$data['profile'] = json_decode(ecurl('GET','profile/'.$userData['id_user']))->data;
		$this->load->view('catalog/header', $data);
		$this->load->view('catalog/profile', $data);
		$this->load->view('catalog/footer', $data);		


			if (isset($_POST['btnupdate'])) {


							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Profile berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
							</div>'
							);
							redirect('catalog/profile');
			}


			if (isset($_POST['btnupdate2'])) {
				$password 	= htmlentities(strip_tags($this->input->post('password')));
				$password2 	= htmlentities(strip_tags($this->input->post('password2')));

				if ($password != $password2) {
						$this->session->set_flashdata('msg2',
							'<div class="alert alert-warning alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Gagal!</h4>
											  <div class="text-muted">Password tidak cocok.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
							</div>'
						);
				}else{	
							$id = $userData['id_user'];
							$passdef = htmlentities(strip_tags($this->input->post('password2')));
							$passenc = password_hash($passdef, PASSWORD_DEFAULT);
							$unipass = '{bcrypt}'.$passenc;							
											$data = array(											
												'password'	=> $unipass												
											);										
										ecurl('PUT','user/'.$id,http_build_query($data));
										insert_log('USER: Edit ID: '.$id.'');
										
							$this->session->set_flashdata('msg2',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses Ubah Password!</h4>
											  <div class="text-muted">Password berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
							</div>'
							);
				}
							redirect('catalog/profile');
			}
			
	}
	
	// Pengaturan
	public function pengaturan($pilih)
	{
		$this->load->helper('file');
		$userData = $this->session->userdata();

			if ($pilih == 'themes') {
				$data['userData'] = $userData;
				$data['judul_web'] 		= "Themes";

					$this->load->view('catalog/header', $data);
					$this->load->view('catalog/pengaturan/'.$pilih, $data);
					$this->load->view('catalog/footer');

					if (isset($_POST['btnupdate'])) {
						$nama	 	= htmlentities(strip_tags($this->input->post('app_name')));
						$title	 	= htmlentities(strip_tags($this->input->post('title_text')));
						$header	 	= htmlentities(strip_tags($this->input->post('header_text')));
						$footer	 	= htmlentities(strip_tags($this->input->post('footer_text')));
						$email	 	= htmlentities(strip_tags($this->input->post('email')));
						$theme	 	= htmlentities(strip_tags($this->input->post('theme')));
						$sidebar	= htmlentities(strip_tags($this->input->post('sidebar')));

									
									$cfg = $nama.'#'.$title.'#'.$header.'#'.$footer.'#'.$email.'#'.$theme.'#'.$sidebar;
									ecurl('PUT','pengaturan/1','config='.$cfg.'');
									
									// CI open/write file
									//write_file('./assets/config_theme.txt', $cfg);

									insert_log('Themes & Title Update');

									$this->session->set_flashdata('msg',
										'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Pengaturan Themes & Title berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
									);
									redirect('catalog/pengaturan/'.$pilih.'');
					}
			}
			else if ($pilih == 'bg') {
					$data['userData'] = $userData;
					$data['judul_web'] 		= "Background & Icons";

					$this->load->view('catalog/header', $data);
					$this->load->view('catalog/pengaturan/'.$pilih, $data);
					$this->load->view('catalog/footer');
					
					if (isset($_POST['btnupdate'])) {
						
						// BG
						  if (!empty($_FILES['bgd']['name'])) {
							$config['upload_path'] = './assetsprimary/images/backgrounds/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = 2000;
							$config['file_name'] = 'background_'.date('YmdHis');
							
							$this->upload->initialize($config);
							$this->load->library('upload', $config);
							
							if (!$this->upload->do_upload('bgd')) {
								exit($this->upload->display_errors());
							}
	
							$bgd = $this->upload->data()['file_name'];
							
							insert_log('Background & Icons: Background Image Update');
						  }
						  else {
							  $bgd	 	= htmlentities(strip_tags($this->input->post('bgd_now')));
						  }
						// FAVICON
						  if (!empty($_FILES['fav']['name'])) {
							$config['upload_path'] = FCPATH.'assetsprimary/images/favicon/';
							$config['allowed_types'] = 'png';
							$config['max_size'] = 2000;
							$config['file_name'] = 'favicon_'.date('YmdHis');
							
							$this->upload->initialize($config);
							$this->load->library('upload', $config);
							
							if (!$this->upload->do_upload('fav')) {
								exit($this->upload->display_errors());
							}
	
							$fav = $this->upload->data()['file_name'];
							
							insert_log('Background & Icons: Favicon Update');
						  }
						  else {
							  $fav	 	= htmlentities(strip_tags($this->input->post('fav_now')));
						  }
						// LOGO
						   if (!empty($_FILES['logo']['name'])) {
							$config['upload_path'] = FCPATH.'assetsprimary/images/logo/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = 2000;
							$config['file_name'] = 'logo'.date('YmdHis');
							
							$this->upload->initialize($config);
							$this->load->library('upload', $config);
							
							if (!$this->upload->do_upload('logo')) {
								exit($this->upload->display_errors());
							}
	
							$logo = $this->upload->data()['file_name'];
							
							insert_log('Background & Icons: Logo Update');
						  }
						  else {
							  $logo	 	= htmlentities(strip_tags($this->input->post('logo_now')));
						  }
									$cfg = $bgd.'#'.$fav.'#'.$logo;
									ecurl('PUT','pengaturan/2','config='.$cfg.'');
									
									// CI open/write file
									write_file('./assets/config_bg.txt', $cfg);
									
									$this->session->set_flashdata('msg',
										'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Pengaturan Background berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
									);
									redirect('catalog/pengaturan/'.$pilih.'');
					}
			}
			else {
				redirect('404_content');
			}
	}
	
	
	// Logs
	public function log(){
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Log";
		$data['logs'] = json_decode(ecurl('GET','logs'));
		$this->load->view('catalog/header', $data);
		$this->load->view('catalog/laporan/logs', $data);
		$this->load->view('catalog/footer', $data);	
	}
	
	// Jabatan Organisasi
	public function jabatanorganisasi(){
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Jabatan Organisasi";
		$data['jabatan'] = ecurl('GET','jabatanorganisasi');
		$this->load->view('catalog/header', $data);
		$this->load->view('catalog/laporan/jabatan', $data);
		$this->load->view('catalog/footer', $data);	
	}
	
	// Fungsi JSON
    public function lamp_json() {
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$searchtext = $this->input->get('searchtext');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		// $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		// $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		// $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		);
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','datalampu?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// Lampu
	public function lamp($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		
		$trans_session  = $userData['trans_session'];
						
		$data['indoor'] = json_decode(ecurl('GET','indoor'))->data;
		$data['outdoor'] = json_decode(ecurl('GET','outdoor'))->data;
		$data['cct'] = json_decode(ecurl('GET','colortemp'))->data;
		$data['optical'] = json_decode(ecurl('GET','optic'))->data;
		$data['refl_finish'] = json_decode(ecurl('GET','refl_finish'))->data;
		$data['procol'] = json_decode(ecurl('GET','prod_color'))->data;
		$data['controldt'] = json_decode(ecurl('GET','control'))->data;
		$data['branddt'] = json_decode(ecurl('GET','brand'))->data;					
		$data['shape'] = json_decode(ecurl('GET','shape'))->data;
		$data['ipdt'] = json_decode(ecurl('GET','ipdt'))->data;					
		$data['ugrdt'] = json_decode(ecurl('GET','ugrdt'))->data;
		$data['tiltdt'] = json_decode(ecurl('GET','tiltdt'))->data;
		$data['rotationdt'] = json_decode(ecurl('GET','rotationdt'))->data;
		$data['powerdt'] = json_decode(ecurl('GET','powerdt'))->data;
		$data['voltagedt'] = json_decode(ecurl('GET','voltagedt'))->data;
		$data['lumendt'] = json_decode(ecurl('GET','lumendt'))->data;
		$data['swdt'] = json_decode(ecurl('GET','swdt'))->data;
		$data['cridt'] = json_decode(ecurl('GET','cridt'))->data;
		$data['bmdt'] = json_decode(ecurl('GET','bmdt'))->data;
		$data['bm2dt'] = json_decode(ecurl('GET','bm2dt'))->data;
		$data['dim_diameterdt'] = json_decode(ecurl('GET','dim_diameterdt'))->data;
		$data['dim_cut_o_diameterdt'] = json_decode(ecurl('GET','dim_cut_o_diameterdt'))->data;
		$data['dim_heightdt'] = json_decode(ecurl('GET','dim_heightdt'))->data;
		$data['dim_widthdt'] = json_decode(ecurl('GET','dim_widthdt'))->data;
		$data['brandinp'] = json_decode(ecurl('GET','branddt'))->data;
		$data['namebrandinp'] = json_decode(ecurl('GET','namebrandinp'))->data;
		$data['brandnamedt'] = json_decode(ecurl('GET','brandnamedt'))->data;		
		$data['project'] = json_decode(ecurl('GET','project'))->data;
		
		//echo $userdata['trans_session'];
				if ($aksi == 't') {
					$p = "lamp_add";
					
						if(isset($_GET['idcart'])) {
							//$idcart = '/idcart/'.$_GET['idcart'];
							$idcart = $_GET['idcart'];
						} else {
							$idcart = '';
						}
						
					$trans_session = $userData['trans_session'];
					
					
					$data['session'] = $trans_session;
					$data['project_parameter_id'] = $idcart;
					$data['judul_web'] 	  = "Tambah Data Lampu";
				}
				elseif ($aksi == 'e') {
					$p = "lamp_edit";
					$data['query'] = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['judul_web'] 	  = "Edit Data Lampu";
					
				}elseif ($aksi == 'preview') {
					$p = "lamp_preview";
					
					if(isset($_GET['idcart'])) {
							$idcart = $_GET['idcart'];
						} else {
							$idcart = '';
						}
						
					$id = $userData['trans_session'];
					$data['query'] = json_decode(ecurl('GET','lampdetilpreview/'.$id))->data;
					$data['judul_web'] 	  = "Detail Lamp";
					$data['transesi'] = $id;
					
				
					$data['project_parameter_id'] = $idcart;					
				}
				elseif ($aksi == 'd') {
					$p = "lamp_detail";
					$transesion = $userData['trans_session'];
					$idcart_group = $this->input->post('idcart_group');
					$data['query'] = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					$data['judul_web'] 	  = "Detail Lamp";
					$data['transesi'] = $transesion;
					
				
					/* if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','lamp/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
						redirect('catalog/lamp/d/'.$id);
					} */
				}
				elseif ($aksi == 'h') {
					$lamp = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Lampu";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$lamp->lampiran))->data;
					if(!empty($lampiran)) {
						foreach ($lampiran as $baris) {
							unlink('lampiran/'.$baris->nama_berkas);
						}
					}
					ecurl('DELETE','lampiran/'.$lamp->lampiran);
					insert_log('LAMP: Delete ID: '.$id.'');
					
					
					ecurl('PUT','updatedellamp/'.$id);	
					#ecurl('DELETE','lamp/'.$id);
					
					
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Lampu berhasil dihapus.
						</div>'
							);					

					redirect('catalog/lamp');
				}elseif ($aksi == 'del') {
					//die(print_r($id));
					$_expid = explode("_",$id);
					$id = $_expid['0'];
					$idpage = $_expid['1'];
					$surat = json_decode(ecurl('GET','lampirandetil/'.$id))->data;
					//die(print_r($surat->id));
					$data['judul_web'] 	  = "Hapus Images";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					unlink('lampiran/'.$surat->nama_berkas);
					//die(print_r($surat->id));
					ecurl('DELETE','lampiranfile/'.$surat->id);
					insert_log('LAMPIRAN LAMPU: Delete ID: '.$id.'');
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Succes Delete Image.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
							);

					redirect('catalog/lamp/e/'.$idpage);
				}else{
					$p = "lamp";
					$data['judul_web'] 	  = "Lamp Catalog";
				}

					$this->load->view('catalog/header', $data);
					$this->load->view("catalog/pemrosesan/$p", $data);
					$this->load->view('catalog/footer');
					
					// Tambah Lampu Submit
					if (isset($_POST['btnsimpan'])) {
						$_token= date('Y-m-d H:i');
						$token = md5($_token.''.rand());
						$y= date('Y');
						$m= date('m');
						$d= date('d');
						$data = array();
						$tgl_upload = date('Y-m-d');
						// Count total files
						$countfiles = count($_FILES['files']['name']);
						
						// Looping all files
						for($i=0;$i<$countfiles;$i++){
							
							if(!empty($_FILES['files']['name'][$i])){
								
								// Define new $_FILES array - $_FILES['file']
								$_FILES['file']['name'] = $_FILES['files']['name'][$i];
								$_FILES['file']['type'] = $_FILES['files']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['files']['error'][$i];
								$_FILES['file']['size'] = $_FILES['files']['size'][$i];

								// Set preference
								$config['upload_path'] = './lampiran/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								$config['max_size']    = 50000;	// max_size in kb
								$newname = $y.'_'.$m.'_'.$d.'_'.'lamp_'.$_FILES['files']['name'][$i];
								$config['file_name'] = $newname;
									
								$this->upload->initialize($config);
								$this->load->library('upload', $config);			
								
								// File upload
								if($this->upload->do_upload('file')){
									// Get data about the file
									$uploadData = $this->upload->data();
									$filename = $uploadData['file_name'];
									$ukuran = $uploadData['file_size'];									
									// Initialize array
									//$data['filenames'][] = $filename;
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'imglamp')));
								}
							}
							
						}						
						
						$luminaire_type			= $this->input->post('luminaire_type');
						$luminaire_ref  		= $this->input->post('luminaire_ref');
						$lamp					= $this->input->post('lamp');
						$lamp_ref   			= $this->input->post('lamp_ref');
						$gears					= $this->input->post('gears');
						$accesories   			= $this->input->post('accesories');
						$power   				= $this->input->post('power');
						$lumen   				= $this->input->post('lumen');
						$kelvin   				= $this->input->post('kelvin');
						$dim_height				= $this->input->post('dim_height');
						$dim_width				= $this->input->post('dim_width');
						$dim_length				= $this->input->post('dim_length');
						$dim_weight				= $this->input->post('dim_weight');
						$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
						$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
						$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
						$dim_diameter   		= $this->input->post('dim_diameter');
						$dim_opening   			= $this->input->post('dim_opening');
						$dim_recc_depth   		= $this->input->post('dim_recc_depth');
						$dim_cover_height   	= $this->input->post('dim_cover_height');
						$dim_depth_housing   	= $this->input->post('dim_depth_housing');
						$tecspec_housing		= $this->input->post('tecspec_housing');
						$tecspec_reflector		= $this->input->post('tecspec_reflector');
						$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
						$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
						$tecspec_approval   	= $this->input->post('tecspec_approval');
						$tecspec_transformer	= $this->input->post('tecspec_transformer');
						$tecspec_lamp_holder   	= $this->input->post('tecspec_lamp_holder');
						$tecspec_cover_trim		= $this->input->post('tecspec_cover_trim');
						$tecspec_ip				= $this->input->post('tecspec_ip');
						$ugr_rating				= $this->input->post('ugr_rating');
						$instalation_manual   	= $this->input->post('instalation_manual');
						$beam_angle				= $this->input->post('beam_angle');
						$beam_angleot			= $this->input->post('beam_angleot');
						$product_shape			= $this->input->post('product_shape');
						$cct   					= $this->input->post('cct');
						$sw   					= $this->input->post('sw');
						$cri   					= $this->input->post('cri');
						$optic					= $this->input->post('optic');
						$adj_optic				= $this->input->post('adj_optic');
						$nadj_optic				= $this->input->post('nadj_optic');	
						$reflector_finish		= $this->input->post('reflector_finish');
						$product_colour			= $this->input->post('product_colour');
						
						//cek lampu
						$brandname		= $this->input->post('id_product_brand');
						$cekbrand = json_decode(ecurl('GET','cekbrand/'.$brandname))->data;
						if(!empty($cekbrand->id_brand))
							{
								$idbrand = $cekbrand->id_brand;
								//die(print_r('disini'.$idbrand));
							} else {
								$data = array(
										'name_product_brand' => $brandname,
										'session'  	 	     => $trans_session
									);
								#die(print_r($data));
								ecurl('POST','brand',http_build_query(array('name_product_brand'=>$brandname,'session'=>$trans_session)));
								$getIdLamp = json_decode(ecurl('GET','getbrandlamp/'.$trans_session))->data;
								$idbrand = $getIdLamp->id_brand;
							}
						//---------------------------------------------------
						
						//cek brand name lampu
						$id_brand_name	= $this->input->post('id_brand_name');
						$cekbrandname = json_decode(ecurl('GET','cekbrandname/'.$id_brand_name))->data;
						if(!empty($cekbrandname->id_brand_name))
							{
								$idbrandname = $cekbrandname->id_brand_name;
								die(print_r('disini'.$idbrandname));
							} else {
								
								ecurl('POST','brandname',http_build_query(array('product_brand_name'=>$id_brand_name,'session'=>$trans_session)));
								$getIdLamp = json_decode(ecurl('GET','getbrandnamelamp/'.$trans_session))->data;
								$idbrandname = $getIdLamp->id_brand_name;
							}
							
						$id_product_brand		= $idbrand;
						$id_brand_name			= $idbrandname;
						$product_code			= $this->input->post('product_code');
						$control				= $this->input->post('control');
						$adv_lamp_side			= $this->input->post('adv_lamp_side');
						$adv_cati				= $this->input->post('adv_cat_indoor');
						$adv_cato				= $this->input->post('adv_cat_outdoor');
						$adjustable				= $this->input->post('adjustable');
						$tilt					= $this->input->post('tilt');
						$rotation				= $this->input->post('rotation');
						$voltage				= $this->input->post('voltage');
						$body_material			= $this->input->post('body_material');
						$sdcm					= $this->input->post('sdcm');
						
						$lamp_lifetime			= $this->input->post('lamp_lifetime');
						$brand_ref 				= $this->input->post('brand_ref');
						$power_fractor 			= $this->input->post('power_fractor');
						$thd 					= $this->input->post('thd');
						$lifetime 				= $this->input->post('lifetime');
						$flicker_rate 			= $this->input->post('flicker_rate');
						$driver_ip 				= $this->input->post('driver_ip');
						$add_note 				= $this->input->post('add_note');
						$session	            = $this->input->post('session');
						#die(print_r($brandname));
							$id_user   	= $userData['id_user'];
							#$cat   	$cat');
						if($adv_lamp_side == 'I')
						{
							$typecategory = $adv_cati;
						} else if($adv_lamp_side == 'O')
						{
							$typecategory = $adv_cato;
						}
						
							$waktu = date('Y-m-d H:i:s');
									$data = array(
										'luminaire_type' => $luminaire_type,
										'luminaire_ref' => $luminaire_ref,
										'lamp' => $lamp,
										'lamp_ref' => $lamp_ref,
										'gears' => $gears,
										'accesories' => $accesories,
										'dim_height' => $dim_height,
										'dim_width' => $dim_width,
										'dim_length' => $dim_length,
										'dim_weight' => $dim_weight,
										'dim_cut_o_diameter' => $dim_cut_o_diameter,
										'cut_o_sq_lbr' => $cut_o_sq_lbr,
										'cut_o_sq_pjg' => $cut_o_sq_pjg,
										'dim_diameter' => $dim_diameter,
										'dim_opening' => $dim_opening,
										'dim_recc_depth' => $dim_recc_depth,
										'dim_cover_height'=> $dim_cover_height,
										'dim_depth_housing'=> $dim_depth_housing,
										'tecspec_housing'=> $tecspec_housing,
										'tecspec_reflector'=> $tecspec_reflector,
										'tecspec_light_distr'=> $tecspec_light_distr,
										'tecspec_adjustment'=> $tecspec_adjustment,
										'tecspec_approval'=> $tecspec_approval,
										'tecspec_transformer'=> $tecspec_transformer,
										'tecspec_lamp_holder'=> $tecspec_lamp_holder,
										'tecspec_cover_trim'=> $tecspec_cover_trim,
										'tecspec_ip' => $tecspec_ip,
										'ugr_rating' => $ugr_rating,
										'instalation_manual' => $instalation_manual,
										'cct' => $cct,
										'sw' => $sw,
										'cri' => $cri,
										'optic' => $optic,
										'adj_optic' => $adj_optic,
										'nadj_optic' => $nadj_optic,
										'reflector_finish' => $reflector_finish,
										'product_colour' => $product_colour,
										'id_product_brand' => $id_product_brand,
										'id_brand_name' => $id_brand_name,
										'product_code' => $product_code,
										'id_control' => $control,
										'beam_angle' => $beam_angle,
										'beam_angleot' => $beam_angleot,
										'product_shape' => $product_shape,
										'power' => $power,
										'lumen' => $lumen,
										'kelvin' => $kelvin,
										'adv_lamp_side' => $adv_lamp_side,
										'adjustable' => $adjustable,
										'adv_cat_indoor' => $typecategory,
										//'adv_cat_outdoor' => $adv_cat_outdoor,
										'tilt' => $tilt,
										'rotation' => $rotation,
										'voltage' => $voltage,
										'body_material' => $body_material,
										'sdcm' => $sdcm,
										'lamp_lifetime' => $lamp_lifetime,
										'brand_ref' => $brand_ref,
						 			    'power_fractor' => $power_fractor,
										'thd' => $thd,
										'lifetime' => $lifetime,
										'flicker_rate' => $flicker_rate,
										'driver_ip' => $driver_ip,
										'add_note' => $add_note,					
						
										'session' => $session,
										'id_user' 			 => $id_user,
										'lampiran' 			 => $token,
										'created'	 		 => date('Y-m-d H:m:s'),
										'createdby' 		 => $userData['nip']
									);
							ecurl('POST','inputlamp',http_build_query($data));
							insert_log('DATA LAMPU: Tambah');
							/* $this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								redirect('catalog/lamp/t'); */
								redirect('catalog/lamp/preview?idcart='.$idcart.'');
							
					}
					// Edit Lampiran Submit
					if (isset($_POST['btnupdatelampiran'])) {
						
						$id_surat   	= $this->input->post('id');
						$token = $this->input->post('tokenlampiran');
						$y= date('Y');
						$m= date('m');
						$d= date('d');
						$tgl_upload = date('Y-m-d');
						
						$data = array();

						// Count total files
						$countfiles = count($_FILES['files']['name']);
						
						// Looping all files
						for($i=0;$i<$countfiles;$i++){
							
							if(!empty($_FILES['files']['name'][$i])){
								
								// Define new $_FILES array - $_FILES['file']
								$_FILES['file']['name'] = $_FILES['files']['name'][$i];
								$_FILES['file']['type'] = $_FILES['files']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['files']['error'][$i];
								$_FILES['file']['size'] = $_FILES['files']['size'][$i];

													
								// Set preference
								$config['upload_path'] = './lampiran/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								$config['max_size']    = 50000;	// max_size in kb
								$newname = $y.'_'.$m.'_'.$d.'_'.'lamp_'.$_FILES['files']['name'][$i];
								$config['file_name'] = $newname;
									
								$this->upload->initialize($config);
								$this->load->library('upload', $config);			
								
								
								// File upload
								if($this->upload->do_upload('file')){
									// Get data about the file
									$uploadData = $this->upload->data();
									$filename = $uploadData['file_name'];
									$ukuran = $uploadData['file_size'];
									
									// Initialize array
									//$data['filenames'][] = $filename;
	//ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload)));
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'imgmenu')));
									insert_log('MENU: Edit Lampiran ID '.$id.'');
								}
							}
							
						}
						redirect('catalog/lamp/e/'.$id_surat);
						
					}
					// Edit Lampu Submit
					if (isset($_POST['btnupdate'])) {
						
						$idlamp   				= $this->input->post('idlamp');						
						$luminaire_type			= $this->input->post('luminaire_type');
						$luminaire_ref  		= $this->input->post('luminaire_ref');
						$lamp					= $this->input->post('lamp');
						$lamp_ref   			= $this->input->post('lamp_ref');
						$gears					= $this->input->post('gears');
						$accesories   			= $this->input->post('accesories');
						$power   				= $this->input->post('power');
						$lumen   				= $this->input->post('lumen');
						$kelvin   				= $this->input->post('kelvin');
						$dim_height				= $this->input->post('dim_height');
						$dim_width				= $this->input->post('dim_width');
						$dim_length				= $this->input->post('dim_length');
						$dim_weight				= $this->input->post('dim_weight');
						$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
						$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
						$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
						$dim_diameter   		= $this->input->post('dim_diameter');
						$dim_opening   			= $this->input->post('dim_opening');
						$dim_recc_depth   		= $this->input->post('dim_recc_depth');
						$dim_cover_height   	= $this->input->post('dim_cover_height');
						$dim_depth_housing   	= $this->input->post('dim_depth_housing');
						$tecspec_housing		= $this->input->post('tecspec_housing');
						$tecspec_reflector		= $this->input->post('tecspec_reflector');
						$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
						$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
						$tecspec_approval   	= $this->input->post('tecspec_approval');
						$tecspec_transformer	= $this->input->post('tecspec_transformer');
						$tecspec_lamp_holder   	= $this->input->post('tecspec_lamp_holder');
						$tecspec_cover_trim		= $this->input->post('tecspec_cover_trim');
						$tecspec_ip				= $this->input->post('tecspec_ip');
						$ugr_rating				= $this->input->post('ugr_rating');
						$instalation_manual   	= $this->input->post('instalation_manual');
						$beam_angle				= $this->input->post('beam_angle');
						$beam_angleot			= $this->input->post('beam_angleot');
						$product_shape			= $this->input->post('product_shape');
						$cct   					= $this->input->post('cct');
						$sw   					= $this->input->post('sw');
						$cri   					= $this->input->post('cri');
						$optic					= $this->input->post('optic');
						$adj_optic				= $this->input->post('adj_optic');
						$nadj_optic				= $this->input->post('nadj_optic');	
						$reflector_finish		= $this->input->post('reflector_finish');
						$product_colour			= $this->input->post('product_colour');
						$id_product_brand		= $this->input->post('id_product_brand');
						$id_brand_name			= $this->input->post('id_brand_name');
						$product_code			= $this->input->post('product_code');
						$control				= $this->input->post('control');
						$adv_lamp_side			= $this->input->post('adv_lamp_side');
						$adv_cati				= $this->input->post('adv_cat_indoor');
						$adv_cato				= $this->input->post('adv_cat_outdoor');					
						
						$adjustable				= $this->input->post('adjustable');
						$tilt					= $this->input->post('tilt');
						$rotation				= $this->input->post('rotation');
						$voltage				= $this->input->post('voltage');
						$body_material			= $this->input->post('body_material');
						$sdcm					= $this->input->post('sdcm');
						
						$lamp_lifetime			= $this->input->post('lamp_lifetime');
						$brand_ref 				= $this->input->post('brand_ref');
						$power_fractor 			= $this->input->post('power_fractor');
						$thd 					= $this->input->post('thd');
						$lifetime 				= $this->input->post('lifetime');
						$flicker_rate 			= $this->input->post('flicker_rate');
						$driver_ip 				= $this->input->post('driver_ip');
						$add_note 				= $this->input->post('add_note');
						
						if($adv_lamp_side == 'I')
						{
							$typecategory = $adv_cati;
						} else if($adv_lamp_side == 'O')
						{
							$typecategory = $adv_cato;
						}
						#die(print_r($typecategory));
						$data = array();
						
						$data['luminaire_type'] = $luminaire_type;
						$data['luminaire_ref'] = $luminaire_ref;
						$data['lamp'] = $lamp;
						$data['lamp_ref'] = $lamp_ref;
						$data['gears'] = $gears;
						$data['accesories'] = $accesories;
						$data['dim_height'] = $dim_height;
						$data['dim_width'] = $dim_width;
						$data['dim_length'] = $dim_length;
						$data['dim_weight'] = $dim_weight;
						$data['dim_cut_o_diameter'] = $dim_cut_o_diameter;						
						$data['cut_o_sq_lbr'] = $cut_o_sq_lbr;
						$data['cut_o_sq_pjg	'] = $cut_o_sq_pjg;						
						$data['dim_diameter'] = $dim_diameter;
						$data['dim_opening'] = $dim_opening;
						$data['dim_recc_depth'] = $dim_recc_depth;
						$data['dim_cover_height']= $dim_cover_height;
						$data['dim_depth_housing']= $dim_depth_housing;
						$data['tecspec_housing']= $tecspec_housing;
						$data['tecspec_reflector']= $tecspec_reflector;
						$data['tecspec_light_distr']= $tecspec_light_distr;
						$data['tecspec_adjustment']= $tecspec_adjustment;
						$data['tecspec_approval']= $tecspec_approval;
						$data['tecspec_transformer']= $tecspec_transformer;
						$data['tecspec_lamp_holder']= $tecspec_lamp_holder;
						$data['tecspec_cover_trim']= $tecspec_cover_trim;
						$data['tecspec_ip'] = $tecspec_ip;
						$data['ugr_rating'] = $ugr_rating;
						$data['instalation_manual'] = $instalation_manual;
						$data['cct'] = $cct;
						$data['sw'] = $sw;
						$data['cri'] = $cri;
						$data['optic'] = $optic;
						$data['adj_optic'] = $adj_optic;
						$data['nadj_optic'] = $nadj_optic;
						$data['reflector_finish'] = $reflector_finish;
						$data['product_colour'] = $product_colour;
						$data['id_product_brand'] = $id_product_brand;
						$data['id_brand_name'] = $id_brand_name;
						$data['product_code'] = $product_code;
						$data['id_control'] = $control;
						$data['beam_angle'] = $beam_angle;
						$data['beam_angleot'] = $beam_angleot;
						$data['product_shape'] = $product_shape;
						$data['power'] = $power;
						$data['lumen'] = $lumen;
						$data['kelvin'] = $kelvin;
						$data['adv_lamp_side'] = $adv_lamp_side;
						$data['adv_cat_indoor'] = $typecategory;
						//$data['adv_cat_outdoor'] = $adv_cat_outdoor;
						
						$data['adjustable'] = $adjustable;
						$data['tilt'] = $tilt;
						$data['rotation'] = $rotation;
						$data['voltage'] = $voltage;
						$data['body_material'] = $body_material;
						$data['sdcm'] = $sdcm;
						
						$data['lamp_lifetime'] = $lamp_lifetime;
						$data['brand_ref'] = $brand_ref;
						$data['power_fractor'] = $power_fractor;
						$data['thd'] = $thd;
						$data['lifetime'] = $lifetime;
						$data['flicker_rate'] = $flicker_rate;
						$data['driver_ip'] = $driver_ip;
						$data['add_note'] = $add_note;
						
						#die(print_r($data));
						ecurl('PUT','updatelamp/'.$idlamp,http_build_query($data));
						insert_log('UBAH LAMPU: Edit ID '.$idlamp.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Data Updated.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
						);
						redirect('catalog/lamp/e/'.$idlamp);
					}
					
					if (isset($_POST['btnupdatesave'])) {
						$idlamp   				= $this->input->post('idlamp');
						$project				= $this->input->post('project');
						$luminaire_type			= $this->input->post('luminaire_type');
						$luminaire_ref  		= $this->input->post('luminaire_ref');
						$lamp					= $this->input->post('lamp');
						$lamp_ref   			= $this->input->post('lamp_ref');
						$gears					= $this->input->post('gears');
						$accesories   			= $this->input->post('accesories');
						$dim_height				= $this->input->post('dim_height');
						$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
						$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
						$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
						$dim_diameter   		= $this->input->post('dim_diameter');
						$tecspec_housing		= $this->input->post('tecspec_housing');
						$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
						$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
						$tecspec_approval   	= $this->input->post('tecspec_approval');
						$tecspec_transformer	= $this->input->post('tecspec_transformer');
						$instalation_manual   	= $this->input->post('instalation_manual');
						$beam_angle				= $this->input->post('beam_angle');
						$beam_angleot			= $this->input->post('beam_angleot');
						$product_shape			= $this->input->post('product_shape');
						$cct   					= $this->input->post('cct');
						$sw   					= $this->input->post('sw');
						$cri   					= $this->input->post('cri');
						$optic					= $this->input->post('optic');
						$adj_optic				= $this->input->post('adj_optic');
						$nadj_optic				= $this->input->post('nadj_optic');	
						$reflector_finish		= $this->input->post('reflector_finish');
						$product_colour			= $this->input->post('product_colour');
						$id_product_brand		= $this->input->post('id_product_brand');
						$id_brand_name			= $this->input->post('id_brand_name');
						$product_code			= $this->input->post('product_code');
						$control				= $this->input->post('control');
						$adv_lamp_side			= $this->input->post('adv_lamp_side');
						$adv_cati				= $this->input->post('adv_cat_indoor');
						$adv_cato				= $this->input->post('adv_cat_outdoor');					
						
						$adjustable				= $this->input->post('adjustable');
						$tilt					= $this->input->post('tilt');
						$rotation				= $this->input->post('rotation');
						$voltage				= $this->input->post('voltage');
						$body_material			= $this->input->post('body_material');
						$sdcm					= $this->input->post('sdcm');
						
						$lamp_lifetime			= $this->input->post('lamp_lifetime');
						$brand_ref 				= $this->input->post('brand_ref');
						$power_fractor 			= $this->input->post('power_fractor');
						$thd 					= $this->input->post('thd');
						$lifetime 				= $this->input->post('lifetime');
						$flicker_rate 			= $this->input->post('flicker_rate');
						$driver_ip 				= $this->input->post('driver_ip');
						$add_note 				= $this->input->post('add_note');
						
						$data = array();
						$data['project'] = $project;
						$data['luminaire_type'] = $luminaire_type;
						$data['luminaire_ref'] = $luminaire_ref;
						$data['lamp'] = $lamp;
						$data['lamp_ref'] = $lamp_ref;
						$data['gears'] = $gears;
						$data['accesories'] = $accesories;
						$data['dim_height'] = $dim_height;
						$data['dim_cut_o_diameter'] = $dim_cut_o_diameter;
						$data['cut_o_sq_lbr'] = $cut_o_sq_lbr;
						$data['cut_o_sq_pjg'] = $cut_o_sq_pjg;
						$data['dim_diameter'] = $dim_diameter;
						$data['tecspec_housing'] = $tecspec_housing;
						$data['tecspec_light_distr'] = $tecspec_light_distr;
						$data['tecspec_adjustment'] = $tecspec_adjustment;
						$data['tecspec_approval'] = $tecspec_approval;
						$data['tecspec_transformer'] = $tecspec_transformer;
						$data['instalation_manual'] = $instalation_manual;
						
						$data['cct'] = $cct;
						$data['sw'] = $sw;
						$data['cri'] = $cri;
						$data['optic'] = $optic;
						$data['adj_optic'] = $adj_optic;
						$data['nadj_optic'] = $nadj_optic;
						$data['reflector_finish'] = $reflector_finish;
						$data['product_colour'] = $product_colour;
						$data['id_product_brand'] = $id_product_brand;
						$data['id_brand_name'] = $id_brand_name;
						$data['product_code'] = $product_code;
						$data['id_control'] = $control;
						$data['beam_angle'] = $beam_angle;
						$data['beam_angleot'] = $beam_angleot;
						$data['product_shape'] = $product_shape;
						$data['power'] = $power;
						$data['lumen'] = $lumen;
						$data['kelvin'] = $kelvin;
						$data['adv_lamp_side'] = $adv_lamp_side;
						$data['adv_cat_indoor'] = $typecategory;
						//$data['adv_cat_outdoor'] = $adv_cat_outdoor;
						
						$data['adjustable'] = $adjustable;
						$data['tilt'] = $tilt;
						$data['rotation'] = $rotation;
						$data['voltage'] = $voltage;
						$data['body_material'] = $body_material;
						$data['sdcm'] = $sdcm;
						
						$data['lamp_lifetime'] = $lamp_lifetime;
						$data['brand_ref'] = $brand_ref;
						$data['power_fractor'] = $power_fractor;
						$data['thd'] = $thd;
						$data['lifetime'] = $lifetime;
						$data['flicker_rate'] = $flicker_rate;
						$data['driver_ip'] = $driver_ip;
						$data['add_note'] = $add_note;
						
						ecurl('PUT','updatelamp/'.$idlamp,http_build_query($data));
						insert_log('UBAH LAMPU: Edit ID '.$idlamp.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Data Updated.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
						);
						redirect('catalog/lamp/d/'.$idlamp);
					}
					
					if (isset($_POST['btnsaveas'])) {
						$_token= date('Y-m-d H:i');
						$token = md5($_token.''.rand());
						$y= date('Y');
						$m= date('m');
						$d= date('d');
						$data = array();
						$tgl_upload = date('Y-m-d');
						// Count total files
						$countfiles = count($_FILES['files']['name']);
						
						// Looping all files
						for($i=0;$i<$countfiles;$i++){
							
							if(!empty($_FILES['files']['name'][$i])){
								
								// Define new $_FILES array - $_FILES['file']
								$_FILES['file']['name'] = $_FILES['files']['name'][$i];
								$_FILES['file']['type'] = $_FILES['files']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['files']['error'][$i];
								$_FILES['file']['size'] = $_FILES['files']['size'][$i];

								// Set preference
								$config['upload_path'] = './lampiran/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								$config['max_size']    = 50000;	// max_size in kb
								$newname = $y.'_'.$m.'_'.$d.'_'.'lamp_'.$_FILES['files']['name'][$i];
								$config['file_name'] = $newname;
									
								$this->upload->initialize($config);
								$this->load->library('upload', $config);			
								
								// File upload
								if($this->upload->do_upload('file')){
									// Get data about the file
									$uploadData = $this->upload->data();
									$filename = $uploadData['file_name'];
									$ukuran = $uploadData['file_size'];									
									// Initialize array
									//$data['filenames'][] = $filename;
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'imglamp')));
								}
							}
							
						}	
							$idlamp   				= $this->input->post('idlamp');
							$project				= $this->input->post('project');
							$luminaire_type			= $this->input->post('luminaire_type');
							$luminaire_ref  		= $this->input->post('luminaire_ref');
							$lamp					= $this->input->post('lamp');
							$lamp_ref   			= $this->input->post('lamp_ref');
							$gears					= $this->input->post('gears');
							$accesories   			= $this->input->post('accesories');
							$dim_height				= $this->input->post('dim_height');
							$dim_width				= $this->input->post('dim_width');
							$dim_length				= $this->input->post('dim_length');
							$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
							$dim_diameter   		= $this->input->post('dim_diameter');
							$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
							$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
							$tecspec_housing		= $this->input->post('tecspec_housing');
							$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
							$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
							$tecspec_approval   	= $this->input->post('tecspec_approval');
							$tecspec_transformer	= $this->input->post('tecspec_transformer');
							$instalation_manual   	= $this->input->post('instalation_manual');
							
							$beam_angle				= $this->input->post('beam_angle');
							$beam_angleot			= $this->input->post('beam_angleot');
							$product_shape			= $this->input->post('product_shape');
							$cct   					= $this->input->post('cct');
							$sw   					= $this->input->post('sw');
							$cri   					= $this->input->post('cri');
							$optic					= $this->input->post('optic');
							$adj_optic				= $this->input->post('adj_optic');
							$nadj_optic				= $this->input->post('nadj_optic');	
							$reflector_finish		= $this->input->post('reflector_finish');
							$product_colour			= $this->input->post('product_colour');
							$id_product_brand		= $this->input->post('id_product_brand');
							$id_brand_name			= $this->input->post('id_brand_name');
							$product_code			= $this->input->post('product_code');
							$control				= $this->input->post('control');
							$adv_lamp_side			= $this->input->post('adv_lamp_side');
							$adv_cati				= $this->input->post('adv_cat_indoor');
							$adv_cato				= $this->input->post('adv_cat_outdoor');					
							
							$adjustable				= $this->input->post('adjustable');
							$tilt					= $this->input->post('tilt');
							$rotation				= $this->input->post('rotation');
							$voltage				= $this->input->post('voltage');
							$body_material			= $this->input->post('body_material');
							$sdcm					= $this->input->post('sdcm');
							
							$lamp_lifetime			= $this->input->post('lamp_lifetime');
							$brand_ref 				= $this->input->post('brand_ref');
							$power_fractor 			= $this->input->post('power_fractor');
							$thd 					= $this->input->post('thd');
							$lifetime 				= $this->input->post('lifetime');
							$flicker_rate 			= $this->input->post('flicker_rate');
							$driver_ip 				= $this->input->post('driver_ip');
							$add_note 				= $this->input->post('add_note');
							$id_user   	= $userData['id_user'];
							#$cat   	$cat');
							
							$waktu = date('Y-m-d H:i:s');
									$data = array(
									
										'project' 	 		 => $project,
										'luminaire_type' 	 => $luminaire_type,
										'luminaire_ref'  	 => $luminaire_ref,
										'lamp'			 	 =>	$lamp,
										'lamp_ref'   		 =>	$lamp_ref,
										'gears'				 =>	$gears,
										'accesories'   		 =>	$accesories,
										'dim_height'		 =>	$dim_height,
										'dim_width'		 	 =>	$dim_width,
										'dim_length'		 =>	$dim_length,
										'dim_cut_o_diameter' =>	$dim_cut_o_diameter,
										'cut_o_sq_lbr'       => $cut_o_sq_lbr,
										'cut_o_sq_pjg'		 => $cut_o_sq_pjg,
										'dim_diameter'   	 =>	$dim_diameter,
										'tecspec_housing'	 =>	$tecspec_housing,
										'tecspec_light_distr'=>$tecspec_light_distr,
										'tecspec_adjustment' =>	$tecspec_adjustment,
										'tecspec_approval'   =>	$tecspec_approval,
										'tecspec_transformer'=>	$tecspec_transformer,
										'instalation_manual' => $instalation_manual,
										
										'cct' => $cct,
										'sw' => $sw,
										'cri' => $cri,
										'optic' => $optic,
										'adj_optic' => $adj_optic,
										'nadj_optic' => $nadj_optic,
										'reflector_finish' => $reflector_finish,
										'product_colour' => $product_colour,
										'id_product_brand' => $id_product_brand,
										'id_brand_name' => $id_brand_name,
										'product_code' => $product_code,
										'id_control' => $control,
										'beam_angle' => $beam_angle,
										'beam_angleot' => $beam_angleot,
										'product_shape' => $product_shape,
										'power' => $power,
										'lumen' => $lumen,
										'kelvin' => $kelvin,
										'adv_lamp_side' => $adv_lamp_side,
										'adjustable' => $adjustable,
										'adv_cat_indoor' => $typecategory,
										//'adv_cat_outdoor' => $adv_cat_outdoor,
										'tilt' => $tilt,
										'rotation' => $rotation,
										'voltage' => $voltage,
										'body_material' => $body_material,
										'sdcm' => $sdcm,
										'lamp_lifetime' => $lamp_lifetime,
										'brand_ref' => $brand_ref,
						 			    'power_fractor' => $power_fractor,
										'thd' => $thd,
										'lifetime' => $lifetime,
										'flicker_rate' => $flicker_rate,
										'driver_ip' => $driver_ip,
										'add_note' => $add_note,					
							
										'id_user' 			 => $id_user,
										'lampiran' 			 => $token,
										'ref_id' 			 => $idlamp,
										'created'	 		 => date('Y-m-d H:m:s'),
										'createdby' 		 => $userData['nip']
									);
							ecurl('POST','inputlamp',http_build_query($data));
							insert_log('DATA LAMPU: Tambah save as');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								redirect('catalog/lamp/d/'.$idlamp);
							
					}
					
					
					if (isset($_POST['addcart'])) {						
						$userData = $this->session->userdata();
						$trans_session = $userData['trans_session'];
						$idlamp = $this->input->post('idlamp');
						//same event
						$idcart = $this->input->post('idcart');
						$project = $this->input->post('project');						
						//end same event
						
						
						$segmentcartid = $this->input->post('segmentcartid');
						$hargatxt = $this->input->post('harga');
						
						$rem = array("Rp",".");
						$harga = str_replace($rem,"",$hargatxt);						
						//$harga = preg_replace(" ", "", $rmharga);
						//die(print_r($rmharga));
						$implid = $idcart.'_'.$idlamp;
						$implid2 = $project.'_'.$idlamp;
						#die(print_r(trim($segmentcartid)));
						if(!empty($segmentcartid))
						{							
							$cekidlamp = json_decode(ecurl('GET','cekidlamp/'.$implid))->data;
							#die(print_r($cekidlamp->id_lamp));
							//die(print_r(trim($project)));
							if(!empty($cekidlamp->id_lamp))
							{								
								$this->session->set_flashdata('msg',
								'<div class="alert alert-warning alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Data Exist</h4>
											  <div class="text-muted">Data Lampu ini sudah ada di dalam projectss.</div>
											</div>
										  </div>
										 
										</div>'
								);
								//redirect('catalog/lamp/d/'.$idlamp.'/idcart/'.$idcart.'');
								redirect('catalog/cart?idcart='.$idcart.'');
							} else if(!empty($idcart)){	
//die(print_r('sjhvfsdku'));							
									$data = array(
									'session' 			 => $trans_session,
									'id_user' 			 => $userData['id_user'],
									'id_lamp' 			 => $idlamp,
									'code' 			 	 => $idcart,
									'status' 			 => 'SAVE',
									'harga'				 => $harga,
									'created'	 		 => date('Y-m-d H:m:s'),
									'createdby' 		 => $userData['nip']
									);
									ecurl('POST','inputcart',http_build_query($data));
									redirect('catalog/cart?idcart='.$idcart.'');
							}
						} else {
							
							#die(print_r($implid2));
							#$cekidlampsess = json_decode(ecurl('GET','cekidlampsess/'.$implidses))->data;
							$cekidlamp = json_decode(ecurl('GET','cekidlamp/'.$implid2))->data;
							if(!empty($cekidlamp->id_lamp))
							{
								$this->session->set_flashdata('msg',
								'<div class="alert alert-warning alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Data Exist</h4>
											  <div class="text-muted">Data Lampu sudah ada di dalam project.</div>
											</div>
										  </div>
										 
										</div>'
								);
								redirect('catalog/cart?idcart='.$project.'');
							} else {
								$data = array(
								'session' 			 => $trans_session,
								'id_user' 			 => $userData['id_user'],
								'id_lamp' 			 => $idlamp,
								'code' 			 	 => $project,
								'harga'				 => $harga,
								'status' 			 => 'SAVE',
								'created'	 		 => date('Y-m-d H:m:s'),
								'createdby' 		 => $userData['nip']
								);
								ecurl('POST','inputcart',http_build_query($data));
								//redirect('catalog/cart');
								redirect('catalog/cart?idcart='.$project.'');
							}
							
													
						}
						
						/*
						if (strlen($idcart_group) == 0) 
						{
							$data = array(
								'iduser' 			 => $userData['id_user'],
								'session' 			 => $trans_session,
								'status' 			 => 'PROCESS',
								'created'	 		 => date('Y-m-d H:m:s'),
								'createdby' 		 => $userData['nama']
							);						
							ecurl('POST','inputsesioncart',http_build_query($data));
							
						}
						*/
						
					}
					
					
					// input project from preview
					if (isset($_POST['btnupdatepreview'])) {
						
						$trans_session = $userData['trans_session'];
						$idlamp = $this->input->post('idlamp');
						$project_parameter_id = $this->input->post('project_parameter_id');
						$project = $this->input->post('project');
						$hargatxt = $this->input->post('harga');
						
						$rem = array("Rp",".");
						$harga = str_replace($rem,"",$hargatxt);
						
						if ($project_parameter_id != '' or $project != '') {							
							$codeproject = $project_parameter_id.''.$project;							
						}					
						
						$data = array(
							'code'	    => $codeproject,
							'session'	=> $trans_session,
							'id_user'	=> $userData['id_user'],
							'id_lamp'	=> $idlamp,
							'harga'		=> $harga,
							'status'	=> 'SAVE',
							'created'	=> date('Y-m-d H:m:s'),
							'createdby'	=> $userData['nip']
						);
						#die(print_r($data));						
						ecurl('POST','inputcart',http_build_query($data));
						insert_log('INPUT LAMPU KE PROJECT: ID '.$idlamp.'');						
						redirect('catalog/cart?idcart='.$codeproject);
					}

	}
	
	public function cart($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		
		$transesion = $userData['trans_session'];
		//echo($_GET['idcart']);
		$p = "lamp_cart";
		$project = $this->input->post('project');
		$projnr = $this->input->post('projnr');
		$idproject_type = $this->input->post('idproject_type');
		$location = $this->input->post('location');
		$note = $this->input->post('note');
		$status_project = $this->input->post('status_project');		
		$tanggal_project = $this->input->post('tanggal_project');		
		$litac_pic = $this->input->post('litac_pic');
		$architech = $this->input->post('architech');
		$interiordesign = $this->input->post('interiordesign');
		$landscape = $this->input->post('landscape');
		$meconsult = $this->input->post('meconsult');
		$prother = $this->input->post('prother');
		
		$data['prjtypedt'] = json_decode(ecurl('GET','prjtypedt'))->data;
		$data['indoor'] = json_decode(ecurl('GET','indoor'))->data;
		$data['outdoor'] = json_decode(ecurl('GET','outdoor'))->data;
		$data['branddt'] = json_decode(ecurl('GET','brand'))->data;
		$data['procol'] = json_decode(ecurl('GET','prod_color'))->data;
		$data['refl_finish'] = json_decode(ecurl('GET','refl_finish'))->data;
		$data['projectlist'] = json_decode(ecurl('GET','project'))->data;
		if(!empty($_GET['idcart'])) { 
			$idcart = $_GET['idcart'];
			$datacek = json_decode(ecurl('GET','cekcartsesrow/'.$idcart))->data;					
		} else {			
			$id = $transesion.'_'.$userData['id_user'];
			$datacek = json_decode(ecurl('GET','cekcartses/'.$id))->data;
		}
			//die(print_r($datacek));
			//$data['code'] = $datacek->code;
			if(!empty($datacek->code)){
				$data['code'] = $datacek->code;
			} else {
				$data['code'] = '';
			}
			
			if(!empty($datacek->project)){
				$data['project'] = $datacek->project;
			} else {
				$data['project'] = $project;
			}
			
			if(!empty($datacek->projnr)){
				$data['projnr'] = $datacek->projnr;
			} else {
				$data['projnr'] = $projnr;
			}
			
			if(!empty($datacek->idproject_type)){
				$data['idproject_type'] = $datacek->idproject_type;
			} else {
				$data['idproject_type'] = $idproject_type;
			}
			
			if(!empty($datacek->location)){
				$data['location'] = $datacek->location;
			} else {
				$data['location'] = $location;
			}
			
			if(!empty($datacek->note)){
				$data['note'] = $datacek->note;
			} else {
				$data['note'] = $note;
			}
			
			if(!empty($datacek->status_project)){
				$data['status_project'] = $datacek->status_project;
			} else {
				$data['status_project'] = $status_project;
			}
						
			if(!empty($datacek->tanggal_project)){
				$data['tanggal_project'] = date("d-m-Y",strtotime($datacek->tanggal_project));
			} else {
				$data['tanggal_project'] = $tanggal_project;
			}
			
			if(!empty($datacek->litac_pic)){
				$data['litac_pic'] = $datacek->litac_pic;
			} else {
				$data['litac_pic'] = $litac_pic;
			}
			
			if(!empty($datacek->architech)){
				$data['architech'] = $datacek->architech;
			} else {
				$data['architech'] = $architech;
			}
			
			if(!empty($datacek->interiordesign)){
				$data['interiordesign'] = $datacek->interiordesign;
			} else {
				$data['interiordesign'] = $interiordesign;
			}
			
			if(!empty($datacek->landscape)){
				$data['landscape'] = $datacek->landscape;
			} else {
				$data['landscape'] = $landscape;
			}
			
			if(!empty($datacek->meconsult)){
				$data['meconsult'] = $datacek->meconsult;
			} else {
				$data['meconsult'] = $meconsult;
			}
			
			if(!empty($datacek->prother)){
				$data['prother'] = $datacek->prother;
			} else {
				$data['prother'] = $prother;
			}
			
			if(!empty($datacek->session)){
				$data['data_session'] = $datacek->session;
				$session = $datacek->session;
			} else {
				$data['data_session'] = $userData['trans_session'];
			}
			
			if (isset($_POST['btnsaveas'])) {
				
				$userData = $this->session->userdata();
				$trans_session = $userData['trans_session'];
				$idcart_group = $datacek->idcart_group;
				if (!empty($datacek)) {
						$data = array(
								'id_user' 			 => $userData['id_user'],
								'project' 			 => $project,
								'projnr'			 => $projnr,
								'idproject_type'	 => $idproject_type,								
								'location' 			 => $location,
								'status_project'	 => $status_project,								
								'tanggal_project'	 => date("Y-m-d", strtotime($tanggal_project)),
								'note' 			 	 => $note,
								'session' 			 => $trans_session,
								'status' 			 => 'SAVE',
								'updated'	 		 => date('Y-m-d H:m:s'),
								'updatedby' 		 => $userData['nama']
							);	
						
							ecurl('PUT','updatesesioncart/'.$idcart_group,http_build_query($data));
			
			$datacart = array(
								'idcart_group' 		 => $idcart_group,
								'status' 			 => 'SAVE',
								'confirmed'	 		 => date('Y-m-d H:m:s'),
								'confirmedby' 		 => $userData['nama']
							);
							//echo('>>'.$datacart.'<<');
				ecurl('PUT','updatecart/'.$trans_session,http_build_query($datacart));
				
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Updated.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
				} else {
							$code = $this->generateRandomString();
							
							$data = array(
								'id_user' 			 => $userData['id_user'],
								'project' 			 => $project,
								'projnr' 			 => $projnr,
								'idproject_type'	 => $idproject_type,
								'location' 			 => $location,
								'code' 			 	 => $code,
								'status_project'	 => $status_project,
								'tanggal_project'	 => date("Y-m-d", strtotime($tanggal_project)),
								'litac_pic'	 		 => $litac_pic,
								'architech'	 		 => $architech,
								'interiordesign'	 => $interiordesign,
								'landscape'			 => $landscape,
								'meconsult'			 => $meconsult,
								'prother'			 => $prother,
								'note' 				 => $note,
								'session' 			 => $trans_session,
								'status' 			 => 'SAVE',
								'created'	 		 => date('Y-m-d H:m:s'),
								'createdby' 		 => $userData['nip']
							);	
							//die(print_r($data));
							ecurl('POST','inputsesioncart',http_build_query($data));
							
							$data_session = $userData['trans_session'];
							
							$loopselectcart = json_decode(ecurl('GET','loopselectcart/'.$data_session))->data;
							foreach ($loopselectcart as $val){
								$idcart_group = $datacek->idcart_group;								
								$idcart = $val->idcart;
								
								$data = array();
								$data['idcart_group'] = $idcart_group;
								$data['code'] = $code;
								$data['status'] = 'SAVE';
								$data['confirmed'] = date('Y-m-d H:m:s');
								$data['confirmedby'] = $userData['nama'];
															
								ecurl('PUT','updatecart/'.$idcart,http_build_query($data));							
							}
							redirect('catalog/cart_project');
							/* $this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								); */
				}						
							if(!empty($_GET['idcart']))
								{
									redirect('catalog/cart?idcart='.$_GET['idcart'].'');
								} else {
									redirect('catalog/cart');
								}
								
			} else if(isset($_POST['btnconfirm'])) {
				$userData = $this->session->userdata();
				$trans_session = $userData['trans_session'];
				$idcart_group = $datacek->idcart_group;
				
				$data = array(
								'id_user' 			 => $userData['id_user'],
								'project' 			 => $project,
								'location' 			 => $location,
								'session' 			 => $trans_session,
								'status' 			 => 'OK',
								'confirmed'	 		 => date('Y-m-d H:m:s'),
								'confirmedby' 		 => $userData['nama']
							);	
							//die(print_r('>>'.$idcart_group.'<<'));
				ecurl('PUT','updatesesioncart/'.$idcart_group,http_build_query($data));
				
				$datacart = array(
								'idcart_group' 		 => $idcart_group,
								'status' 			 => 'OK',
								'confirmed'	 		 => date('Y-m-d H:m:s'),
								'confirmedby' 		 => $userData['nama']
							);
							//echo('>>'.$datacart.'<<');
				ecurl('PUT','updatecart/'.$trans_session,http_build_query($datacart));
				
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Confirmed.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								if(!empty($_GET['idcart']))
								{
									redirect('catalog/cart?idcart='.$_GET['idcart'].'');
								} else {
									redirect('catalog/cart');
								}
							#redirect('catalog/cart');
							 
			} else if(isset($_POST['excelexport'])) {
				
				$code = $this->input->post('code');
				$fileName = 'project.xlsx';
				$userData = $this->session->userdata();
				$data['userData'] = $userData;		
				//$employeeData = $this->EmployeeModel->employeeList();
				$transesi = $userData['trans_session'];
				//echo $transesi;
				$cartlist = json_decode(ecurl('GET','cartlist/'.$code))->data;
				
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setCellValue('A1', 'Project');
				$sheet->setCellValue('B1', ''.$datacek->project.'');
				
				$sheet->setCellValue('A2', 'Location');
				$sheet->setCellValue('B2', ''.$datacek->location.'');
				
				$sheet->setCellValue('A3', '');
				$sheet->setCellValue('A4', 'No');
				$sheet->setCellValue('B4', 'Luminaire Type');
				$sheet->setCellValue('C4', 'Luminaire Reference');
				$sheet->setCellValue('D4', 'Lamp');
				$sheet->setCellValue('E4', 'Lamp Reference');
				$sheet->setCellValue('F4', 'Gears');
				$sheet->setCellValue('G4', 'Accesories');
				$sheet->setCellValue('H4', 'Diameter');
				$sheet->setCellValue('I4', 'Opening');
				$sheet->setCellValue('J4', 'Height');
				$sheet->setCellValue('K4', 'Width');
				$sheet->setCellValue('L4', 'Length');
				$sheet->setCellValue('M4', 'Weight');
				$sheet->setCellValue('N4', 'Cut Out Diameter');
				$sheet->setCellValue('O4', 'Recessed Depth');
				$sheet->setCellValue('P4', 'Depth + Housing');
				$sheet->setCellValue('Q4', 'Cover height');
				$sheet->setCellValue('R4', 'Housing');
				$sheet->setCellValue('S4', 'Reflector');
				$sheet->setCellValue('T4', 'Lamp Holder');
				$sheet->setCellValue('U4', 'Cover Trim');
				$sheet->setCellValue('V4', 'Light Distribution');
				$sheet->setCellValue('W4', 'Adjustment');
				$sheet->setCellValue('X4', 'Approval');
				$sheet->setCellValue('Y4', 'Transformer');
				$sheet->setCellValue('Z4', 'IP');
				$sheet->setCellValue('AA4', 'Instalation manual');
				
				$rows = 5;
				$no = 1;
				foreach ($cartlist as $val){
					$sheet->setCellValue('A' . $rows, $no);
					$sheet->setCellValue('B' . $rows, $val->luminaire_type);
					$sheet->setCellValue('C' . $rows, $val->luminaire_ref);
					$sheet->setCellValue('D' . $rows, $val->lamp);
					$sheet->setCellValue('E' . $rows, $val->lamp_ref);
					$sheet->setCellValue('F' . $rows, $val->gears);					
					$sheet->setCellValue('G' . $rows, $val->accesories);
					$sheet->setCellValue('H' . $rows, $val->dim_diameter);
					$sheet->setCellValue('I' . $rows, $val->dim_opening);
					$sheet->setCellValue('J' . $rows, $val->dim_height);
					$sheet->setCellValue('K' . $rows, $val->dim_width);
					$sheet->setCellValue('L' . $rows, $val->dim_length);
					$sheet->setCellValue('M' . $rows, $val->dim_weight);
					$sheet->setCellValue('N' . $rows, $val->dim_cut_o_diameter);
					$sheet->setCellValue('O' . $rows, $val->dim_recc_depth);
					$sheet->setCellValue('P' . $rows, $val->dim_depth_housing);
					$sheet->setCellValue('Q' . $rows, $val->dim_cover_height);
					$sheet->setCellValue('R' . $rows, $val->tecspec_housing);
					$sheet->setCellValue('S' . $rows, $val->tecspec_reflector);
					$sheet->setCellValue('T' . $rows, $val->tecspec_lamp_holder);
					$sheet->setCellValue('U' . $rows, $val->tecspec_cover_trim);
					$sheet->setCellValue('V' . $rows, $val->tecspec_light_distr);
					$sheet->setCellValue('W' . $rows, $val->tecspec_adjustment);
					$sheet->setCellValue('X' . $rows, $val->tecspec_approval);
					$sheet->setCellValue('Y' . $rows, $val->tecspec_transformer);
					$sheet->setCellValue('Z' . $rows, $val->tecspec_ip);
					$sheet->setCellValue('AA' . $rows, $val->instalation_manual);
					$rows++;
					$no++;
				} 
				$writer = new Xlsx($spreadsheet);
				$writer->save("upload/".$fileName);
				header("Content-Type: application/vnd.ms-excel");
				redirect(base_url()."/upload/".$fileName);
		
			}
					
			if ($aksi == 'del') {				
				$exp = explode("_",$_GET['idct']);
				//die(print_r($exp[1]));
					$data['judul_web'] 	  = "Hapus Item";
					ecurl('DELETE','itemcart/'.$exp[0]);
					insert_log('LAMPIRAN LAMPU: Delete ID: '.$exp[0].'');
					$this->session->set_flashdata('msgdel',
						'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Succes Delete Item.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
							);
					$idcart = $datacek->idcart_group;
					redirect('catalog/cart?idcart='.$exp[1].'');
				}
			
			if ($aksi == 'codeinput') {
				$p = "codeinput";
			}
			
			if ($aksi == 'print') {
				$exp = explode("_",$_GET['id']);
				$idcart=$exp[0];
				#die(print_r('>>'.$exp[0]));
				error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
				$pdf = new FPDF();
				header('Content-Type: text/html; charset=utf-8');
				mb_internal_encoding('utf-8');
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',16);
				$peg = json_decode(ecurl('GET','getcartdetilprint/'.$idcart))->data;
				$pdf->Cell(0,7,$peg->luminaire_type,0,1,'C');
				$pdf->Cell(10,7,'',0,1);
				$pdf->SetFont('Arial','B',10);
				//$pdf->Cell(10,6,'No',1,0,'C');
				
				$pdf->SetFont('Arial','',10);
				$txt = "'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'";
				//die(print_r('>>'.$exp[0]));
				
				$pdf->Cell(40,5,'Project',0,0);
				$pdf->Cell(40,5,': '.$peg->project,0,1);
				$pdf->Cell(40,5,'Location',0,0);
				$pdf->Cell(40,5,': '.$peg->location,0,1);
				$pdf->Cell(40,5,'Note',0,0);
				$pdf->Cell(80,5,': '.$peg->note,0,1);
				
				
				$pdf->Cell(190,6,'',0,1);
				
				$adv_lamp_side = $peg->adv_lamp_side;
				if($adv_lamp_side == 'O')
				{
					$lampside = 'Outdoor';
				} else {
					$lampside = 'Indoor';
				}
				$border = '0';
				$width = '30';
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Product Type',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(55,5,': '.$lampside .' '. $peg->adv_cat_outdoor,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Luminaire Reference',$border,0);
				$pdf->SetFont('Arial','',8);
				$tex = $this->em($peg->luminaire_ref);
				$weirdword = urldecode($tex);
				$pdf->Cell(33,5,':'. $weirdword,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Lamp',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(33,5,':'. $peg->lamp,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Lamp Reference',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(33,5,':'. $peg->lamp_ref,$border,1);

				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Gears',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(33,5,':'. $peg->gears,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Accesories',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(33,5,':'. $peg->accesories,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Product Brand',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(33,5,': '. $peg->name_product_brand,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($width,5,'Product Code',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(33,5,': '. $peg->code_product_brand,$border,1);
				$pdf->Cell(33,5,'',$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(10,5,'Power',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->power,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(10,5,'Lumen',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->lumen,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(20,5,'Beam Angle',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->beam_angle,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(10,5,'Kelvin',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->kelvin,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(13,5,'Diameter',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_diameter,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(13,5,'Opening',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_opening,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(8,5,'Height',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_height,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(9,5,'Width',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_width,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(11,5,'Length',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_length,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(11,5,'Weight',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_weight,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(25,5,'Cut Out Diameter',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_cut_o_diameter,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(24,5,'Recessed Depth',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_recc_depth,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(23,5,'Depth + Housing',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_depth_housing,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(19,5,'Cover Height',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->dim_cover_height,$border,1);
				
				$pdf->Cell(10,5,'',$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(36,5,'CCT / Colour Temperature',$border,0);
				$pdf->SetFont('Arial','',8);
				$id_cct = $peg->id_cct;
				if($id_cct == '1')
				{
					$sw = $peg->sw;
				} else {
					$sw = '';
				}
				$pdf->Cell(25,5,': '. $peg->color_temperature.'  '.$sw,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(39,5,'CRI / Colour rendering Index',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '. $peg->cri,$border,0);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(8,5,'Optic',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(30,5,': '. $peg->name_optic,$border,1);
				
				switch ($peg->product_shape) {
					case 1:
						$prshape = "Circular";
						break;
					case 2:
						$prshape = "Other";
						break;
					case 3:
						$prshape = "Rectangular";
						break;
					case 4:
						$prshape = "Square";
						break;
				}

				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(21,5,'Product Shape',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(20,5,': '. $prshape,$border,0);
				//-----------------------------------------------------downside---------------------
				$downside = '25.7';
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Adjustable Optic',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': Yes',$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Reflector Finish',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->name_ref_finish,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Product Colour',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->name_product_colour,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Product Control',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->name_control,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Housing',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_housing,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Reflector',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_reflector,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Lamp Holder',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_lamp_holder,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Cover Trim',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_cover_trim,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Light Distribution',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_light_distr,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Adjustment',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_adjustment,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Approval',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_approval,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Transformer',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_transformer,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'IP',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->tecspec_ip,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'UGR',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->ugr_rating,$border,1);
				
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell($downside,5,'Instalation manual',$border,0);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,5,': '.$peg->instalation_manual,$border,1);
				
				
				$base = base_url();;
				$lampiran = json_decode(ecurl('GET','lampiran/'.$peg->lampiran))->data;
                         if(!empty($lampiran)) {
                          $no = 1;
                          foreach ($lampiran as $baris) {
				
							$image1 = $base.'lampiran/'.$baris->nama_berkas;
							//$pdf->Image($image1, 5, null, 33.78);							
							$pdf->Cell(1, 1, $pdf->Image($image1, 40, null, 90), 0, 0, 'L', false);						
							}
						}						  
				//$pdf->MultiCell(60,5,$txt,0,'J',0,8);				
				$pdf->Output();
				//$pdf->Output('D', "lamp_detil.pdf", true);
			}
				
			$data['judul_web'] = "Your Project Cart";
			$data['transesi'] = $transesion;
		
			$this->load->view('catalog/header', $data);
			$this->load->view("catalog/pemrosesan/$p", $data);
			$this->load->view('catalog/footer');					
	}
	
	public function inputcartcode($aksi='', $id=''){
			$data['panel'] = '';
			$userData = $this->session->userdata();
			$data['userData'] = $userData;
			$transesion = $userData['trans_session'];
			$data['judul_web'] = "Your Project Cart";
			$data['transesi'] = $transesion;
			$p= 'lamp_cartcode';
			
			$idcartcode = $_GET['id'];
			$expl = explode("_",$idcartcode);
			$kodedata = $expl[1];
			$iddata = $expl[0];
			$data['iddata'] = $iddata;
			$data['kodedata'] = $kodedata;
			
			
			//ambil code yg sudah ada
			$datacekcode = json_decode(ecurl('GET','cekcodecart/'.$iddata))->data;
			if(!empty($datacekcode->codelamp)){
				$data['codelamp'] = $datacekcode->codelamp;
			} else {
				$data['codelamp'] = '-';
			}
				
			$datacek = json_decode(ecurl('GET','cekcartsesrow/'.$kodedata))->data;
			$data['code'] = $datacek->code;
			$data['project'] = $datacek->project;
			$data['location'] = $datacek->location;
			$data['note'] = $datacek->note;
			$data['status_project'] = $datacek->status_project;
			$data['projnr'] = $datacek->projnr;
			$data['tanggal_project'] = date("d-m-Y",strtotime($datacek->tanggal_project));
			$data['idproject_type'] = $datacek->idproject_type;
			$data['litac_pic'] = $datacek->litac_pic;
			$data['architech'] = $datacek->architech;
			$data['interiordesign'] = $datacek->interiordesign;
			$data['landscape'] = $datacek->landscape;
			$data['meconsult'] = $datacek->meconsult;
			$data['prother'] = $datacek->prother;
			
			if(!empty($datacek->session)){
				$data['data_session'] = $datacek->session;
				$session = $datacek->session;
			} else {
				$data['data_session'] = $userData['trans_session'];
			}
			
			$idlamp = $datacekcode->id_lamp;
			#die(print_r($idlamp));
			$datalamp = json_decode(ecurl('GET','lampdetil/'.$idlamp))->data;
			
			$data['lamp_side'] = $datalamp->adv_lamp_side;
			
			$side = $datalamp->adv_lamp_side;
			if($side == 'I')
			{
				$data['lamp_catside'] =  'Indoor';
				$cat = $datalamp->adv_cat_indoor;
					if($cat!=null)
					{
				$category = json_decode(ecurl('GET','viewcatlamp/'.$cat))->data;
				$data['lamp_cat'] =  $category->name_product_type;
					} else {
				$data['lamp_cat'] = '';
					}
			} else {
				$data['lamp_catside'] =  'Outdoor';
				$cat = $datalamp->adv_cat_indoor;
					if($cat!=null)
					{
				$category = json_decode(ecurl('GET','viewcatlamp/'.$cat))->data;
				$data['lamp_cat'] =  $category->name_product_type;
					} else {
				$data['lamp_cat'] = '';		
					}
			}
				
			$data['cekcode'] = $datacekcode->codelamp;
			$data['lamp'] = $datalamp->lamp;
			$data['name_product'] = $datalamp->name_product_brand;
			$data['shape'] = $datalamp->shape;
			$data['color'] = $datalamp->name_product_colour;
			$data['reflectorfinish'] = $datalamp->name_ref_finish;
			$data['accesoris'] = $datalamp->accesories;
			
			$data['power'] = $datalamp->power;
			$data['lumen'] = $datalamp->lumen;		
			$data['prjtypedt'] = json_decode(ecurl('GET','prjtypedt'))->data;
			if (isset($_POST['btnsavecode'])) {
			$iddata = $this->input->post('iddata');
			
			$codes = $this->input->post('codes');	
			$codes2 = $this->input->post('codes2');	
			$codes3 = $this->input->post('codes3');	
			
			//$codelamp = $this->input->post('codelamp');
			$codelampok = $codes.'-'.$codes2.'-'.$codes3;			
			$userdata =$userData['nama'];
			
			$getidenproject = $kodedata.'_'.$codelampok;
			//die(print_r($getidenproject));
			$cekexistcode = json_decode(ecurl('GET','cekexistcode/'.$getidenproject))->data;
			
			if(!empty($cekexistcode->codelamp)){
				$this->session->set_flashdata('msgcode',
								'<div class="alert alert-warning alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Code Exist</h4>
											  <div class="text-muted">The data has same code</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
					} else {
						
						$codes = $this->input->post('codes');	
						$codes2 = $this->input->post('codes2');	
						$codes3 = $this->input->post('codes3');	
								
								//$codelamp = $this->input->post('codelamp');
						$codelamp = $codes.'-'.$codes2.'/'.$codes3;		
								
						$datacart = array(			
										'codelamp'		 => $codelamp,
										'codeuserinput'	 => $userdata
									);
									#die(print_r($datacart));
						ecurl('PUT','updatecart/'.$iddata,http_build_query($datacart));
						
									$this->session->set_flashdata('msgcode',
										'<div class="alert alert-success alert-dismissible" role="alert">
												  <div class="d-flex">
													<div>
													  <!-- SVG icon code with class="alert-icon" -->
													</div>
													<div>
													  <h4 class="alert-title">Success</h4>
													  <div class="text-muted">Data Code Updated.</div>
													</div>
												  </div>
												  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
												</div>'
										);
										
						$data['panel'] =  '<script type="text/javascript">
											var div = document.getElementById(\'pnlSeldata\');
											div.style.display = \'none\';
											</script>';
					}			
				} else if(isset($_POST['excelexport'])) {
				
				$code = $this->input->post('code');
				$fileName = 'project.xlsx';
				$userData = $this->session->userdata();
				$data['userData'] = $userData;		
				//$employeeData = $this->EmployeeModel->employeeList();
				$transesi = $userData['trans_session'];
				//echo $transesi;
				$cartlist = json_decode(ecurl('GET','cartlist/'.$code))->data;
				
				$spreadsheet = new Spreadsheet();
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setCellValue('A1', 'Project');
				$sheet->setCellValue('B1', ''.$datacek->project.'');
				
				$sheet->setCellValue('A2', 'Location');
				$sheet->setCellValue('B2', ''.$datacek->location.'');
				
				$sheet->setCellValue('A3', '');
				$sheet->setCellValue('A4', 'No');
				$sheet->setCellValue('B4', 'Luminaire Type');
				$sheet->setCellValue('C4', 'Luminaire Reference');
				$sheet->setCellValue('D4', 'Lamp');
				$sheet->setCellValue('E4', 'Lamp Reference');
				$sheet->setCellValue('F4', 'Gears');
				$sheet->setCellValue('G4', 'Accesories');
				$sheet->setCellValue('H4', 'Diameter');
				$sheet->setCellValue('I4', 'Opening');
				$sheet->setCellValue('J4', 'Height');
				$sheet->setCellValue('K4', 'Width');
				$sheet->setCellValue('L4', 'Length');
				$sheet->setCellValue('M4', 'Weight');
				$sheet->setCellValue('N4', 'Cut Out Diameter');
				$sheet->setCellValue('O4', 'Recessed Depth');
				$sheet->setCellValue('P4', 'Depth + Housing');
				$sheet->setCellValue('Q4', 'Cover height');
				$sheet->setCellValue('R4', 'Housing');
				$sheet->setCellValue('S4', 'Reflector');
				$sheet->setCellValue('T4', 'Lamp Holder');
				$sheet->setCellValue('U4', 'Cover Trim');
				$sheet->setCellValue('V4', 'Light Distribution');
				$sheet->setCellValue('W4', 'Adjustment');
				$sheet->setCellValue('X4', 'Approval');
				$sheet->setCellValue('Y4', 'Transformer');
				$sheet->setCellValue('Z4', 'IP');
				$sheet->setCellValue('AA4', 'Instalation manual');
				
				$rows = 5;
				$no = 1;
				foreach ($cartlist as $val){
					$sheet->setCellValue('A' . $rows, $no);
					$sheet->setCellValue('B' . $rows, $val->luminaire_type);
					$sheet->setCellValue('C' . $rows, $val->luminaire_ref);
					$sheet->setCellValue('D' . $rows, $val->lamp);
					$sheet->setCellValue('E' . $rows, $val->lamp_ref);
					$sheet->setCellValue('F' . $rows, $val->gears);					
					$sheet->setCellValue('G' . $rows, $val->accesories);
					$sheet->setCellValue('H' . $rows, $val->dim_diameter);
					$sheet->setCellValue('I' . $rows, $val->dim_opening);
					$sheet->setCellValue('J' . $rows, $val->dim_height);
					$sheet->setCellValue('K' . $rows, $val->dim_width);
					$sheet->setCellValue('L' . $rows, $val->dim_length);
					$sheet->setCellValue('M' . $rows, $val->dim_weight);
					$sheet->setCellValue('N' . $rows, $val->dim_cut_o_diameter);
					$sheet->setCellValue('O' . $rows, $val->dim_recc_depth);
					$sheet->setCellValue('P' . $rows, $val->dim_depth_housing);
					$sheet->setCellValue('Q' . $rows, $val->dim_cover_height);
					$sheet->setCellValue('R' . $rows, $val->tecspec_housing);
					$sheet->setCellValue('S' . $rows, $val->tecspec_reflector);
					$sheet->setCellValue('T' . $rows, $val->tecspec_lamp_holder);
					$sheet->setCellValue('U' . $rows, $val->tecspec_cover_trim);
					$sheet->setCellValue('V' . $rows, $val->tecspec_light_distr);
					$sheet->setCellValue('W' . $rows, $val->tecspec_adjustment);
					$sheet->setCellValue('X' . $rows, $val->tecspec_approval);
					$sheet->setCellValue('Y' . $rows, $val->tecspec_transformer);
					$sheet->setCellValue('Z' . $rows, $val->tecspec_ip);
					$sheet->setCellValue('AA' . $rows, $val->instalation_manual);
					$rows++;
					$no++;
				} 
				$writer = new Xlsx($spreadsheet);
				$writer->save("upload/".$fileName);
				header("Content-Type: application/vnd.ms-excel");
				redirect(base_url()."/upload/".$fileName);
		
			}
			
			$this->load->view('catalog/header', $data);
			$this->load->view("catalog/pemrosesan/$p", $data);
			$this->load->view('catalog/footer');
		
	}
	
	public function em($word) {

    $word = str_replace("@","%40",$word);
    $word = str_replace("`","%60",$word);
    $word = str_replace("¢","%A2",$word);
    $word = str_replace("£","%A3",$word);
    $word = str_replace("¥","%A5",$word);
    $word = str_replace("|","%A6",$word);
    $word = str_replace("«","%AB",$word);
    $word = str_replace("¬","%AC",$word);
    $word = str_replace("¯","%AD",$word);
    $word = str_replace("º","%B0",$word);
    $word = str_replace("±","%B1",$word);
    $word = str_replace("ª","%B2",$word);
    $word = str_replace("µ","%B5",$word);
    $word = str_replace("»","%BB",$word);
    $word = str_replace("¼","%BC",$word);
    $word = str_replace("½","%BD",$word);
    $word = str_replace("¿","%BF",$word);
    $word = str_replace("À","%C0",$word);
    $word = str_replace("Á","%C1",$word);
    $word = str_replace("Â","%C2",$word);
    $word = str_replace("Ã","%C3",$word);
    $word = str_replace("Ä","%C4",$word);
    $word = str_replace("Å","%C5",$word);
    $word = str_replace("Æ","%C6",$word);
    $word = str_replace("Ç","%C7",$word);
    $word = str_replace("È","%C8",$word);
    $word = str_replace("É","%C9",$word);
    $word = str_replace("Ê","%CA",$word);
    $word = str_replace("Ë","%CB",$word);
    $word = str_replace("Ì","%CC",$word);
    $word = str_replace("Í","%CD",$word);
    $word = str_replace("Î","%CE",$word);
    $word = str_replace("Ï","%CF",$word);
    $word = str_replace("Ð","%D0",$word);
    $word = str_replace("Ñ","%D1",$word);
    $word = str_replace("Ò","%D2",$word);
    $word = str_replace("Ó","%D3",$word);
    $word = str_replace("Ô","%D4",$word);
    $word = str_replace("Õ","%D5",$word);
    $word = str_replace("Ö","%D6",$word);
    $word = str_replace("Ø","%D8",$word);
    $word = str_replace("Ù","%D9",$word);
    $word = str_replace("Ú","%DA",$word);
    $word = str_replace("Û","%DB",$word);
    $word = str_replace("Ü","%DC",$word);
    $word = str_replace("Ý","%DD",$word);
    $word = str_replace("Þ","%DE",$word);
    $word = str_replace("ß","%DF",$word);
    $word = str_replace("à","%E0",$word);
    $word = str_replace("á","%E1",$word);
    $word = str_replace("â","%E2",$word);
    $word = str_replace("ã","%E3",$word);
    $word = str_replace("ä","%E4",$word);
    $word = str_replace("å","%E5",$word);
    $word = str_replace("æ","%E6",$word);
    $word = str_replace("ç","%E7",$word);
    $word = str_replace("è","%E8",$word);
    $word = str_replace("é","%E9",$word);
    $word = str_replace("ê","%EA",$word);
    $word = str_replace("ë","%EB",$word);
    $word = str_replace("ì","%EC",$word);
    $word = str_replace("í","%ED",$word);
    $word = str_replace("î","%EE",$word);
    $word = str_replace("ï","%EF",$word);
    $word = str_replace("ð","%F0",$word);
    $word = str_replace("ñ","%F1",$word);
    $word = str_replace("ò","%F2",$word);
    $word = str_replace("ó","%F3",$word);
    $word = str_replace("ô","%F4",$word);
    $word = str_replace("õ","%F5",$word);
    $word = str_replace("ö","%F6",$word);
    $word = str_replace("÷","%F7",$word);
    $word = str_replace("ø","%F8",$word);
    $word = str_replace("ù","%F9",$word);
    $word = str_replace("ú","%FA",$word);
    $word = str_replace("û","%FB",$word);
    $word = str_replace("ü","%FC",$word);
    $word = str_replace("ý","%FD",$word);
    $word = str_replace("þ","%FE",$word);
    $word = str_replace("ÿ","%FF",$word);
    return $word;
}

	public function createExcel() {
		$fileName = 'employee.xlsx';
		$userData = $this->session->userdata();
		$data['userData'] = $userData;		
		//$employeeData = $this->EmployeeModel->employeeList();
		$transesi = $userData['trans_session'];
		//echo $transesi;
		$cartlist = json_decode(ecurl('GET','cartlist/'.$transesi))->data;
		
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
		$sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Luminaire Type');
        $sheet->setCellValue('C1', 'Luminaire Reference');
        $sheet->setCellValue('D1', 'Gears');
		$sheet->setCellValue('E1', 'Accesories');
        $sheet->setCellValue('F1', 'Dimension');       
        $rows = 2;
		$no = 1;
        foreach ($cartlist as $val){
            $sheet->setCellValue('A' . $rows, $no);
            $sheet->setCellValue('B' . $rows, $val->luminaire_type);
            $sheet->setCellValue('C' . $rows, $val->luminaire_ref);
            $sheet->setCellValue('D' . $rows, $val->gears);
			$sheet->setCellValue('E' . $rows, $val->accesories);
            $sheet->setCellValue('F' . $rows, $val->dim_diameter);
            $rows++;
			$no++;
        } 
        $writer = new Xlsx($spreadsheet);
		$writer->save("upload/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/upload/".$fileName);              
    } 
	
	
	public function convert($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;

				if ($aksi == 't') {
					$p = "convert_add";						
					$data['judul_web'] 	  = "Import Data Lampu";
							
				}
				elseif ($aksi == 'e') {
					$p = "lamp_edit";
					$id_user = $userData['id_user'];
					$data['query'] = json_decode(ecurl('GET','importedlampdetil/'.$id_user))->data;
					$data['indoor'] = json_decode(ecurl('GET','indoor'))->data;
					$data['outdoor'] = json_decode(ecurl('GET','outdoor'))->data;
					$data['cct'] = json_decode(ecurl('GET','colortemp'))->data;
					$data['optical'] = json_decode(ecurl('GET','optic'))->data;
					$data['refl_finish'] = json_decode(ecurl('GET','refl_finish'))->data;
					$data['procol'] = json_decode(ecurl('GET','prod_color'))->data;
					$data['controldt'] = json_decode(ecurl('GET','control'))->data;
					$data['branddt'] = json_decode(ecurl('GET','brand'))->data;					
					$data['shape'] = json_decode(ecurl('GET','shape'))->data;
					$data['ipdt'] = json_decode(ecurl('GET','ipdt'))->data;								
					$data['ugrdt'] = json_decode(ecurl('GET','ugrdt'))->data;
					$data['tiltdt'] = json_decode(ecurl('GET','tiltdt'))->data;
					$data['rotationdt'] = json_decode(ecurl('GET','rotationdt'))->data;
					$data['powerdt'] = json_decode(ecurl('GET','powerdt'))->data;
					$data['voltagedt'] = json_decode(ecurl('GET','voltagedt'))->data;
					$data['lumendt'] = json_decode(ecurl('GET','lumendt'))->data;
					$data['swdt'] = json_decode(ecurl('GET','swdt'))->data;
					$data['cridt'] = json_decode(ecurl('GET','cridt'))->data;
					$data['bmdt'] = json_decode(ecurl('GET','bmdt'))->data;
					$data['bm2dt'] = json_decode(ecurl('GET','bm2dt'))->data;
					$data['dim_diameterdt'] = json_decode(ecurl('GET','dim_diameterdt'))->data;
					$data['dim_cut_o_diameterdt'] = json_decode(ecurl('GET','dim_cut_o_diameterdt'))->data;
					$data['dim_heightdt'] = json_decode(ecurl('GET','dim_heightdt'))->data;
					$data['dim_widthdt'] = json_decode(ecurl('GET','dim_widthdt'))->data;		
												
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['judul_web'] 	  = "Edit Data Lampu";
					
				}
				elseif ($aksi == 'h') {
					$surat = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Lampu";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					if(!empty($lampiran)) {
						foreach ($lampiran as $baris) {
							unlink('lampiran/'.$baris->nama_berkas);
						}
					}
					ecurl('DELETE','lampiran/'.$surat->lampiran);
					insert_log('SURAT MASUK: Delete ID: '.$id.'');
					ecurl('DELETE','lamp/'.$id);
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Lampu berhasil dihapus.
						</div>'
							);					

					redirect('catalog/lamp');
				}else{
					$p = "convert";
					$data['judul_web'] 	  = "Convert File";
					$data['id_user'] 	  = $userData['id_user'];
										
				}

					$this->load->view('catalog/header', $data);
					$this->load->view("catalog/pemrosesan/$p", $data);
					$this->load->view('catalog/footer');
					
					if (isset($_POST['btnconvert'])) {
						$_token= date('Y-m-d H:i');
						$token = md5($_token.''.rand());
						$y= date('Y');
						$m= date('m');
						$d= date('d');
						$data = array();
						$tgl_upload = date('Y-m-d');

						$id_user   	= $this->input->post('iduser');
								
								// Define new $_FILES array - $_FILES['file']
								$_FILES['file']['name'] = $_FILES['files']['name'];
								$_FILES['file']['type'] = $_FILES['files']['type'];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
								$_FILES['file']['error'] = $_FILES['files']['error'];
								$_FILES['file']['size'] = $_FILES['files']['size'];

								// Set preference
								$config['upload_path'] = './imported_file/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								$config['max_size']    = 50000;	// max_size in kb
								$newname = $y.'_'.$m.'_'.$d.'_'.'lamp_'.$_FILES['files']['name'];
								$config['file_name'] = $newname;
									
								$this->upload->initialize($config);
								$this->load->library('upload', $config);
								
								// File upload
								if($this->upload->do_upload('file')){
									// Get data about the file
									$uploadData = $this->upload->data();
									$filename = $uploadData['file_name'];
									$ukuran = $uploadData['file_size'];									
									// Initialize array
									//$data['filenames'][] = $filename;
								ecurl('POST','importfile',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'id_user'=>$id_user,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'fileimport')));
								}
														
							$importfile = json_decode(ecurl('GET','filedetil/'.$id_user))->data;
							$importedfile = $importfile->nama_berkas;
							
							$docObj = new Doc2Txt("./imported_file/".$importedfile."");
							$txt = $docObj->convertToText();
							
							$arr = explode(':',trim($txt));
							#die(print_r($txt));
							
							
							$luminaire_type = str_replace("Luminaire Reference","",$arr[1]);
								
							//luminaire reference
							$str1 = rtrim($arr[1]);
							$lumin_str = substr($str1, strrpos($str1, ' ') + 1);
							if($lumin_str == 'Reference')
							{
								$luminaire_ref = str_replace("Lamp","",$arr[2]);
							}							
							
							//lamp
							$str2 = rtrim($arr[2]);	
							$lamp_str = substr($str2, strrpos($str2, ' ') + 1);
							$text_lamp = rtrim($arr[3]);
							#die(print_r($lamp_str));
							if($lamp_str == $lamp_str)
							{
								$lamp = str_replace("Lamp Reference","",$text_lamp);
							}
							
							//lamp reference
							$str3 = rtrim($arr[3]);	
							$lampref_str = substr($str3, strrpos($str3, ' ') + 1);
							$text_lampref = rtrim($arr[4]);
							if($lampref_str == $lampref_str)
							{
								$lamp_ref = str_replace("Gears","",$text_lampref);
							}								
							
							//Gears
							$str4 = rtrim($arr[4]);	
							$gear_str = substr($str4, strrpos($str4, ' ') + 1);
							$text_gear = rtrim($arr[5]);
							if($gear_str == $gear_str)
							{
								$gears = str_replace("Accessories","",$text_gear);
							}
							
							//Accessories
							$str5 = rtrim($arr[5]);	
							$accesor_str = substr($str5, strrpos($str5, ' ') + 1);
							$text_accesor = rtrim($arr[6]);
							#die(print_r($str5));
							if($accesor_str == $accesor_str)
							{
								$find1 = array("Cut Out Diameter","Width","Diameter","Length","Technical","Specification","Housing","Opening","Dimension","Height","Weight","Recessed Depth");
								$accesories = str_replace($find1,"",$text_accesor);
							}
							
							
							$os = array("Diameter", "Opening", "Cut Out Diameter","Width","Height","Weight","Length","Recessed Depth","Cover height","Depth + Housing");
							
							if (in_array("Diameter", $os)) {
								$diameterstr = "Diameter";
								$pos_diameter = strpos($txt, $diameterstr);
									if ($pos_diameter !== false) {
										$removestr1 = substr($txt, $pos_diameter, 20);
										//$diameter = (int) filter_var($removestr1, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr1, $matches)) {
											$diameter = $matches[1]; 
										} 
									} else {
											$diameter = ''; 
										}
							}
							
							if (in_array("Opening", $os)) {
								$openingstr = "Opening";
								$pos_opening = strpos($txt, $openingstr);
									if ($pos_opening !== false) {
										$removestr2 = substr($txt, $pos_opening, 20);
										//$opening = (int) filter_var($removestr2, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr2, $matches)) {
											$opening = $matches[1]; 
										}
									} else {
										$opening = ''; 
										}
							} 
							
							if (in_array("Cut Out Diameter", $os)) {
								$codstr = "Cut Out Diameter";
								$pos_cod = strpos($txt, $codstr);
									if ($pos_cod !== false) {
										$removestr3 = substr($txt, $pos_cod, 30);
										#die(print_r($removestr3));
										//$cut_o_diameter = (int) filter_var($removestr3, FILTER_SANITIZE_NUMBER_INT); 
										if (preg_match('/(\d+(\.\d+)*)/', $removestr3, $matches)) {
											$cut_o_diameter = $matches[1]; 
										}
									} else {
										$cut_o_diameter = ''; 
										}
							}
														
							if (in_array("Width", $os)) {
								$widthstr = "Width";
								$pos_width = strpos($txt, $widthstr);
									if ($pos_width !== false) {
										$removestr4 = substr($txt, $pos_width, 20);
										//$width = (int) filter_var($removestr4, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr4, $matches)) {
											$width = $matches[1]; 
										}
									} else {
										$width = ''; 
									}
							}

							if (in_array("Height", $os)) {
								$heightstr = "Height";
								$pos_height = strpos($txt, $heightstr);
									if ($pos_height !== false) {
										$removestr5 = substr($txt, $pos_height, 20);
										//$height = (int) filter_var($removestr5, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr5, $matches)) {
											$height = $matches[1]; 
										}
									} else {
										$height = ''; 
									}
							}
							
							if (in_array("Weight", $os)) {
								$weightstr = "Weight";
								$pos_weight = strpos($txt, $weightstr);
									if ($pos_weight !== false) {
										$removestr6 = substr($txt, $pos_weight, 20);
										//$weight = (int) filter_var($removestr6, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr6, $matches)) {
											$weight = $matches[1]; 
										}
									} else {
										$weight = ''; 
									}
							}
							
							if (in_array("Length", $os)) {
								$lengthstr = "Length";
								$pos_length = strpos($txt, $lengthstr);
									if ($pos_length !== false) {
										$removestr7 = substr($txt, $pos_length, 20);
										//$length = (int) filter_var($removestr7, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr7, $matches)) {
											$length = $matches[1]; 
										}
									} else {
										$length = ''; 
									}
							} 
							
							if (in_array("Recessed Depth", $os)) {
								$reccdepthstr = "Recessed Depth";
								$pos_reccdepth = strpos($txt, $reccdepthstr);
									if ($pos_reccdepth !== false) {
										$removestr8 = substr($txt, $pos_reccdepth, 20);
										//$recc_depth = (int) filter_var($removestr8, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr8, $matches)) {
											$recc_depth = $matches[1]; 
										}
									} else {
										$recc_depth = ''; 
									}
							}
							
							if (in_array("Cover height", $os)) {
								$covheightstr = "Cover height";
								$pos_covheight = strpos($txt, $covheightstr);
									if ($pos_covheight !== false) {
										$removestr9 = substr($txt, $pos_covheight, 20);
										//$cover_height = (int) filter_var($removestr9, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr9, $matches)) {
											$cover_height = $matches[1]; 
										}
									} else {
										$cover_height = ''; 
									}
							}
							
							if (in_array("Depth + Housing", $os)) {
								$dhstr = "Depth + Housing";
								$pos_dh = strpos($txt, $dhstr);
									if ($pos_dh !== false) {
										$removestr10 = substr($txt, $pos_dh, 20);
										//$depth_housing = (int) filter_var($removestr10, FILTER_SANITIZE_NUMBER_INT);
										if (preg_match('/(\d+(\.\d+)*)/', $removestr10, $matches)) {
											$depth_housing = $matches[1]; 
										}
									} else {
										$depth_housing = ''; 
									}
							}
							
							
							$techspec = array("Housing", "Reflector", "Light Distribution","Adjustment","Approval","Transformer","Cover trim","Lamp Holder","Light Distribution","Cover trim","IP");
							//Housing
							if (in_array("Housing", $techspec)) {
								$housingstr = "Housing";
								$pos_housing = strpos($txt, $housingstr);
									if ($pos_housing !== false) {
										$removestr11 = substr($txt, $pos_housing, 100);
										$parsed = $this->get_string_between($removestr11, ':', ':');
										$tecspec_housing = str_replace($techspec,"",$parsed);
									} else {
										$tecspec_housing = ''; 
									}
							}
							
							if (in_array("Reflector", $techspec)) {
								$reflectorstr = "Reflector";
								$pos_reflector = strpos($txt, $reflectorstr);
									if ($pos_reflector !== false) {
										$removestr12 = substr($txt, $pos_reflector, 100);
										$parsedref = $this->get_string_between($removestr12, ':', ':');
										$tecspec_reflector = str_replace($techspec,"",$parsedref);
									} else {
										$tecspec_reflector = ''; 
									}
							}
							
							if (in_array("Lamp Holder", $techspec)) {
								$lamphstr = "Lamp Holder";
								$pos_lh = strpos($txt, $lamphstr);
									if ($pos_lh !== false) {
										$removestr13 = substr($txt, $pos_lh, 100);
										$parsedlh = $this->get_string_between($removestr13, ':', ':');
										$tecspec_lh = str_replace($techspec,"",$parsedlh);
									} else {
										$tecspec_lh = ''; 
									}
							}
							
							if (in_array("Cover trim", $techspec)) {
								$covtrimstr = "Cover trim";
								$pos_covtrim = strpos($txt, $covtrimstr);
									if ($pos_covtrim !== false) {
										$removestr14 = substr($txt, $pos_covtrim, 100);
										$parsedct = $this->get_string_between($removestr14, ':', ':');
										$tecspec_cover_trim = str_replace($techspec,"",$parsedct);
									} else {
										$tecspec_cover_trim = ''; 
									}
							}
							
							if (in_array("Light Distribution", $techspec)) {
								$ldstr = "Light Distribution";
								$pos_ld = strpos($txt, $ldstr);
									if ($pos_ld !== false) {
										$removestr15 = substr($txt, $pos_ld, 100);
										$parsedld = $this->get_string_between($removestr15, ':', ':');
										$tecspec_light_distr = str_replace($techspec,"",$parsedld);
									} else {
										$tecspec_light_distr = ''; 
									}
							}
							
							if (in_array("Approval", $techspec)) {
								$apprstr = "Approval";
								$pos_approval = strpos($txt, $apprstr);
									if ($pos_approval !== false) {
										$removestr16 = substr($txt, $pos_approval, 100);
										$parsedapprov = $this->get_string_between($removestr16, ':', ':');
										$tecspec_approval = str_replace($techspec,"",$parsedapprov);
									} else {
										$tecspec_approval = ''; 
									}
							}
							
							if (in_array("Transformer", $techspec)) {
								$transfstr = "Transformer";
								$pos_transf = strpos($txt, $transfstr);
									if ($pos_transf !== false) {
										$removestr17 = substr($txt, $pos_transf, 200);
										$parsedtransf = $this->get_string_between($removestr17, ':', ':');										
										$tecspec_transformer = str_replace($techspec,"",$parsedtransf);
										#die(print_r($tecspec_transformer));
									} else {
										$tecspec_transformer = ''; 
									}
							}
							
							if (in_array("Adjustment", $techspec)) {
								$adjstr = "Adjustment";
								$pos_adjus = strpos($txt, $adjstr);
									if ($pos_adjus !== false) {
										$removestr18 = substr($txt, $pos_adjus, 200);
										$parsedadjust = $this->get_string_between($removestr18, ':', ':');										
										$tecspec_adjustment = str_replace($techspec,"",$parsedadjust);
									} else {
										$tecspec_adjustment = ''; 
									}
							}
							
							if (in_array("IP", $techspec)) {
								$ipstr = "IP";
								$pos_ip = strpos($txt, $ipstr);
									if ($pos_ip !== false) {
										$removestr19 = substr($txt, $pos_ip, 20);
										$parsedip = $this->get_string_between($removestr19, ':', ':');
										$tecspec_ip = str_replace($techspec,"",$parsedip);
									} else {
										$tecspec_ip = ''; 
									}
							}
							
							
							
							$col14 = $arr = explode('Installation Manual',$arr[14]);							
							$instalation_manual = $col14[1];
							
							$_token= date('Y-m-d H:i');
							$token = md5($_token.''.rand());

							$data = array(
									
										'luminaire_type' 	 => $luminaire_type,
										'luminaire_ref'  	 => $luminaire_ref,
										'lamp'			 	 =>	$lamp,
										'lamp_ref'   		 =>	$lamp_ref,
										'gears'				 =>	$gears,
										'accesories'   		 =>	$accesories,
										'dim_height'		 =>	$height,
										'dim_width'		 	 =>	$width,
										'dim_length'		 =>	$length,
										'dim_weight'		 =>	$weight,
										'dim_cut_o_diameter' =>	$cut_o_diameter,
										'cut_o_sq_lbr'		 => $cut_o_sq_lbr,
										'cut_o_sq_pjg' 		 => $cut_o_sq_pjg,
										'dim_diameter'   	 =>	$diameter,
										'dim_opening'   	 =>	$opening,
										'dim_recc_depth'	 => $recc_depth,
										'dim_cover_height'   =>	$cover_height,
										'dim_depth_housing'  =>	$depth_housing,
										'tecspec_housing'	 =>	$tecspec_housing,
										'tecspec_reflector'	 =>	$tecspec_reflector,
										'tecspec_light_distr'=> $tecspec_light_distr,
										'tecspec_adjustment' =>	$tecspec_adjustment,
										'tecspec_approval'   =>	$tecspec_approval,
										'tecspec_transformer'=>	$tecspec_transformer,
										'tecspec_lamp_holder'=>	$tecspec_lh,
										'tecspec_cover_trim' =>	$tecspec_cover_trim,
										'tecspec_ip' 		 =>	$tecspec_ip,
										'instalation_manual' => $instalation_manual,
										'lampiran'			 => $token,
										'id_user'			 => $userData['id_user'],
										'created'	 		 => date('Y-m-d H:m:s'),
										'createdby' 		 => $userData['nip']
									);
									
							ecurl('POST','inputlamp',http_build_query($data));
							
							insert_log('DATA LAMPU: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								redirect('catalog/convert/e/'.$id_user);
							
					} 
					
					// Edit Lampu Submit
					if (isset($_POST['btnupdate'])) {
						$idlamp   				= $this->input->post('idlamp');						
						$luminaire_type			= $this->input->post('luminaire_type');
						$luminaire_ref  		= $this->input->post('luminaire_ref');
						$lamp					= $this->input->post('lamp');
						$lamp_ref   			= $this->input->post('lamp_ref');
						$gears					= $this->input->post('gears');
						$accesories   			= $this->input->post('accesories');
						$power   				= $this->input->post('power');
						$lumen   				= $this->input->post('lumen');
						$kelvin   				= $this->input->post('kelvin');
						$dim_height				= $this->input->post('dim_height');
						$dim_width				= $this->input->post('dim_width');
						$dim_length				= $this->input->post('dim_length');
						$dim_weight				= $this->input->post('dim_weight');
						$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
						$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
						$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
						$dim_diameter   		= $this->input->post('dim_diameter');
						$dim_opening   			= $this->input->post('dim_opening');
						$dim_recc_depth   		= $this->input->post('dim_recc_depth');
						$dim_cover_height   	= $this->input->post('dim_cover_height');
						$dim_depth_housing   	= $this->input->post('dim_depth_housing');
						$tecspec_housing		= $this->input->post('tecspec_housing');
						$tecspec_reflector		= $this->input->post('tecspec_reflector');
						$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
						$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
						$tecspec_approval   	= $this->input->post('tecspec_approval');
						$tecspec_transformer	= $this->input->post('tecspec_transformer');
						$tecspec_lamp_holder   	= $this->input->post('tecspec_lamp_holder');
						$tecspec_cover_trim		= $this->input->post('tecspec_cover_trim');
						$tecspec_ip				= $this->input->post('tecspec_ip');
						$ugr_rating				= $this->input->post('ugr_rating');
						$instalation_manual   	= $this->input->post('instalation_manual');
						
						$beam_angle				= $this->input->post('beam_angle');
						$beam_angleot			= $this->input->post('beam_angleot');
						$product_shape			= $this->input->post('product_shape');
						$cct   					= $this->input->post('cct');
						$sw   					= $this->input->post('sw');
						$cri   					= $this->input->post('cri');
						$optic					= $this->input->post('optic');
						$adj_optic				= $this->input->post('adj_optic');
						$nadj_optic				= $this->input->post('nadj_optic');	
						$reflector_finish		= $this->input->post('reflector_finish');
						$product_colour			= $this->input->post('product_colour');
						$id_product_brand		= $this->input->post('id_product_brand');
						$product_code			= $this->input->post('product_code');
						$control				= $this->input->post('control');
						
						$adv_lamp_side			= $this->input->post('adv_lamp_side');
						$adv_cat_indoor			= $this->input->post('adv_cat_indoor');
						//$adv_cat_outdoor		= $this->input->post('adv_cat_indoor');
						
						$data = array();
						
						$data['luminaire_type'] = $luminaire_type;
						$data['luminaire_ref'] = $luminaire_ref;
						$data['lamp'] = $lamp;
						$data['lamp_ref'] = $lamp_ref;
						$data['gears'] = $gears;
						$data['accesories'] = $accesories;
						$data['dim_height'] = $dim_height;
						$data['dim_width'] = $dim_width;
						$data['dim_length'] = $dim_length;
						$data['dim_weight'] = $dim_weight;
						$data['dim_cut_o_diameter'] = $dim_cut_o_diameter;
						$data['cut_o_sq_lbr'] = $cut_o_sq_lbr;
						$data['cut_o_sq_pjg'] = $cut_o_sq_pjg;
						$data['dim_diameter'] = $dim_diameter;
						$data['dim_opening'] = $dim_opening;
						$data['dim_recc_depth'] = $dim_recc_depth;
						$data['dim_cover_height']= $dim_cover_height;
						$data['dim_depth_housing']= $dim_depth_housing;
						$data['tecspec_housing']= $tecspec_housing;
						$data['tecspec_reflector']= $tecspec_reflector;
						$data['tecspec_light_distr']= $tecspec_light_distr;
						$data['tecspec_adjustment']= $tecspec_adjustment;
						$data['tecspec_approval']= $tecspec_approval;
						$data['tecspec_transformer']= $tecspec_transformer;
						$data['tecspec_lamp_holder']= $tecspec_lamp_holder;
						$data['tecspec_cover_trim']= $tecspec_cover_trim;
						$data['tecspec_ip'] = $tecspec_ip;
						$data['ugr_rating'] = $ugr_rating;
						$data['instalation_manual'] = $instalation_manual;						
						$data['cct'] = $cct;
						$data['sw'] = $sw;
						$data['cri'] = $cri;
						$data['optic'] = $optic;
						$data['adj_optic'] = $adj_optic;
						$data['nadj_optic'] = $nadj_optic;
						$data['reflector_finish'] = $reflector_finish;
						$data['product_colour'] = $product_colour;						
						$data['id_product_brand'] = $id_product_brand;
						$data['product_code'] = $product_code;						
						$data['id_control'] = $control;
						$data['beam_angle'] = $beam_angle;
						$data['beam_angleot'] = $beam_angleot;
						$data['product_shape'] = $product_shape;
						$data['power'] = $power;
						$data['lumen'] = $lumen;
						$data['kelvin'] = $kelvin;
						$data['adv_lamp_side'] = $adv_lamp_side;
						$data['adv_cat_indoor'] = $adv_cat_indoor;
						//$data['adv_cat_outdoor'] = $adv_cat_outdoor;
						
						ecurl('PUT','updatelamp/'.$idlamp,http_build_query($data));
						insert_log('UBAH LAMPU: Edit ID '.$idlamp.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Data Updated.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
						);
						redirect('catalog/convert/e/'.$idlamp);
					}
					
					// Edit Lampiran Submit
					if (isset($_POST['btnupdatelampiran'])) {
						$id_surat   	= $this->input->post('id');
						$token = $this->input->post('tokenlampiran');
						$y= date('Y');
						$m= date('m');
						$d= date('d');
						$tgl_upload = date('Y-m-d');
						
						$data = array();

						// Count total files
						$countfiles = count($_FILES['files']['name']);
						
						// Looping all files
						for($i=0;$i<$countfiles;$i++){
							
							if(!empty($_FILES['files']['name'][$i])){
								
								// Define new $_FILES array - $_FILES['file']
								$_FILES['file']['name'] = $_FILES['files']['name'][$i];
								$_FILES['file']['type'] = $_FILES['files']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['files']['error'][$i];
								$_FILES['file']['size'] = $_FILES['files']['size'][$i];

								// Set preference
								$config['upload_path'] = './lampiran/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								$config['max_size']    = 50000;	// max_size in kb
								$newname = $y.'_'.$m.'_'.$d.'_'.'lamp_'.$_FILES['files']['name'][$i];
								$config['file_name'] = $newname;
									
								$this->upload->initialize($config);
								$this->load->library('upload', $config);			
								
								// File upload
								if($this->upload->do_upload('file')){
									// Get data about the file
									$uploadData = $this->upload->data();
									$filename = $uploadData['file_name'];
									$ukuran = $uploadData['file_size'];
									
									// Initialize array
									//$data['filenames'][] = $filename;
	//ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload)));
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'imgmenu')));
									insert_log('MENU: Edit Lampiran ID '.$id.'');
								}
							}
							
						}
						redirect('catalog/convert/e/'.$id_surat);
						
					}
					

	}
	
    public function akses_json() {
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$searchtext = $this->input->get('searchtext');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		// $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		// $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		// $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		);
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','akses?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	public function search_akses_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$search = $pdata['search'];
		$searchtext = $pdata['searchtext'];		 
		$limit = $pdata['length'];
		$start = $pdata['start'];
		
		#echo ('akses?search='.$search.'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start);
		#echo $search.'<>'.$searchtext;		 
		$result = json_decode(ecurl('GET','akses?search='.$search.'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);	
//var_dump($result);		
		echo json_encode($result);
    }
	
	public function log_json() {
		
		header('Content-Type: application/json');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');	
		$data = array(
			'limit' => $limit,
			'start' => $start
		);
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','logs'),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	public function search_log_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$tgl_start = $pdata['tgl_start'];	
		$tgl_end = $pdata['tgl_end'];		
		
		$limit = $pdata['length'];
		$start = $pdata['start'];
		
		$result = json_decode(ecurl('GET','logs?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&limit='.$limit.'&start='.$start),true);			
		echo json_encode($result);
    }
	
	public function advanced_search($aksi='', $id=''){
		$userData = $this->session->userdata();
				
		if(isset($_GET['idcart'])) {
			$idcart = '/idcart/'.$_GET['idcart'];
		} else {
			$idcart = '';
		}
		
		if ($aksi == 'inputSelected') {
					
		$userData = $this->session->userdata();
		//header('Content-Type: application/json');		
		$pdata = $this->input->post();		
		$selCheck = $pdata['selCheck'];
		$project = $pdata['project'];
		$id_user = $userData['id_user'];
		//die(print_r($selCheck));
		
				$pilih = explode(',',$selCheck);
				//$categories = '';
				foreach($pilih as $sel) {
					$id_lamp = trim($sel);
					//$categories = '';
					//$categories .= "-" . $sel . "ok<br>";
					
				ecurl('POST','inputcart',http_build_query(array('code'=>$project,'id_user'=>$id_user,'id_lamp'=>$id_lamp,'status'=>'SAVE')));
				//die(print_r($project));
				insert_log('TAMBAH PRODUK CART');
				//header('location: '.base_url().'catalog/cart?idcart='.$project.'');	
				
				
				
				}
					
				
				}
				
		$data['userData'] = $userData;
					$p = "adv_search";
										
					$data['indoor'] = json_decode(ecurl('GET','indoor'))->data;
					$data['outdoor'] = json_decode(ecurl('GET','outdoor'))->data;
					$data['cct'] = json_decode(ecurl('GET','colortemp'))->data;
					$data['optical'] = json_decode(ecurl('GET','optic'))->data;
					$data['refl_finish'] = json_decode(ecurl('GET','refl_finish'))->data;
					$data['procol'] = json_decode(ecurl('GET','prod_color'))->data;
					$data['controldt'] = json_decode(ecurl('GET','control'))->data;
					$data['category'] = json_decode(ecurl('GET','brand'))->data;
					$data['ipdt'] = json_decode(ecurl('GET','ipdt'))->data;
					$data['shape'] = json_decode(ecurl('GET','shape'))->data;
					$data['project'] = json_decode(ecurl('GET','project'))->data;
					$data['idcart'] = $idcart;
					
					$data['judul_web'] 	  = "Advanced Search";
				
					//$this->load->view('catalog/header', $data);
					$this->load->view('catalog/headeradvsearch', $data);
					$this->load->view("catalog/pemrosesan/$p", $data);
					$this->load->view('catalog/footer');
					
	}
	
	
	// Fungsi JSON
    public function user_json() {
		
		header('Content-Type: application/json');
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
	
		
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','user?limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// User / Pengguna
	public function user($aksi='', $id=''){
			$userData = $this->session->userdata();
			$data['userData'] = $userData;
					if ($aksi == 't') {
						$p = "user_tambah";
						$data['judul_web'] 	  = "Tambah User";
						$data['golongan'] = json_decode(ecurl('GET','golongan'))->data;
						$data['jabatan_organisasi'] = json_decode(ecurl('GET','jabatan_organisasi'))->data;
						$data['ref_kewenangan'] = json_decode(ecurl('GET','ref_kewenangan'))->data;
					}
					elseif ($aksi == 'e') {
						$p = "user_edit";
						$data['query'] = json_decode(ecurl('GET','userdetil/'.$id))->data;
						$data['golongan'] = json_decode(ecurl('GET','golongan'))->data;
						$data['jabatan_organisasi'] = json_decode(ecurl('GET','jabatan_organisasi'))->data;
						$data['ref_kewenangan'] = json_decode(ecurl('GET','ref_kewenangan'))->data;
						$data['judul_web'] 	  = "Edit User";
					}
					elseif ($aksi == 'h') {
						$data['judul_web'] 	  = "Hapus User";
						// Cek Relasi
						
							insert_log('USER : Delete ID: '.$id.'');
							ecurl('DELETE','pengguna/'.$id);
							$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">User Berhasil dihapus.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
							);
						
						redirect('catalog/user');
					} elseif ($aksi == 'reset') {	
#die(print_r('>>'.$id));					
										ecurl('PUT','usereset/id/'.$id);
										insert_log('RESET PASSWORD USER: User Edit ID: '.$id.'');
										$this->session->set_flashdata('msg',
											'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Password Berhasil di reset.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
										);
										redirect('catalog/user');									
					} else {
						$p = "user";
						$data['judul_web'] 	  = "User";						
					}

						$this->load->view('catalog/header', $data);
						$this->load->view("catalog/master/$p", $data);
						$this->load->view('catalog/footer');

						if (isset($_POST['btnsimpan'])) {
						
							$nip   					= htmlentities(strip_tags($this->input->post('nip')));
							$username				= htmlentities(strip_tags($this->input->post('username')));
							$nama_lengkap   		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
							$email   				= htmlentities(strip_tags($this->input->post('email')));							
							$tempat_lahir			= htmlentities(strip_tags($this->input->post('tempat_lahir')));
							$pangkat   	 			= htmlentities(strip_tags($this->input->post('pangkat')));
							$golongan_id   			= htmlentities(strip_tags($this->input->post('golongan_id')));
							$jabatan   	 			= htmlentities(strip_tags($this->input->post('jabatan')));
							$instansi   			= htmlentities(strip_tags($this->input->post('instansi')));
							$jenis_kelamin  		= $this->input->post('jenis_kelamin');
							$agama					= $this->input->post('agama');
							$id_jabatan_organisasi	= $this->input->post('id_jabatan_organisasi');
							$kewenangan_id			= $this->input->post('kewenangan_id');
							$tanggal_lahir 			= date("Y-m-d", strtotime($this->input->post('tanggal_lahir')));
							$pendidikan_terakhir   	= htmlentities(strip_tags($this->input->post('pendidikan_terakhir')));
							$alumni_universitas   	= htmlentities(strip_tags($this->input->post('alumni_universitas')));
							$no_handphone   		= $this->input->post('no_handphone');
							$alamat_rumah   		= htmlentities(strip_tags($this->input->post('alamat_rumah')));
							
							$passdef = '12345';
							$passenc = password_hash($passdef, PASSWORD_DEFAULT);
							$unipass = '{bcrypt}'.$passenc;
		
											$data = array(
												'nip'	 				=> $nip,
												'username'	 			=> $username,
												'nama_lengkap'	 		=> $nama_lengkap,
												'email'	 				=> $email,
												'tempat_lahir'	 		=> $tempat_lahir,
												'pangkat'	 			=> $pangkat,
												'golongan_id'	 		=> $golongan_id,
												'jabatan'	 			=> $jabatan,
												'kewenangan_id'	 		=> $kewenangan_id,
												'id_jabatan_organisasi'	=> $id_jabatan_organisasi,
												'jenis_kelamin'	 		=> $jenis_kelamin,
												'agama'	 				=> $agama,
												'tanggal_lahir'	 		=> $tanggal_lahir,
												'pendidikan_terakhir'	=> $pendidikan_terakhir,
												'alumni_universitas'	=> $alumni_universitas,
												'no_handphone'	 		=> $no_handphone,
												'alamat_rumah'	 		=> $alamat_rumah,
												'password'	 			=> $unipass,
												'enabled'				=> '1'
											);
											ecurl('POST','user',http_build_query($data));
											insert_log('TAMBAH USER');
											$this->session->set_flashdata('msg',
												'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Data User berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
											);

										redirect('catalog/user/t');
						}

						if (isset($_POST['btnupdate'])) {
							
							$nip   					= htmlentities(strip_tags($this->input->post('nip')));
							$username				= htmlentities(strip_tags($this->input->post('username')));
							$nama_lengkap   		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
							$email   				= htmlentities(strip_tags($this->input->post('email')));
							$tempat_lahir			= htmlentities(strip_tags($this->input->post('tempat_lahir')));
							$pangkat   	 			= htmlentities(strip_tags($this->input->post('pangkat')));
							$golongan_id   			= htmlentities(strip_tags($this->input->post('golongan_id')));
							$jabatan   	 			= htmlentities(strip_tags($this->input->post('jabatan')));
							$instansi   			= htmlentities(strip_tags($this->input->post('instansi')));
							$jenis_kelamin  		= $this->input->post('jenis_kelamin');
							$agama					= $this->input->post('agama');
							$id_jabatan_organisasi	= $this->input->post('id_jabatan_organisasi');
							$kewenangan_id			= $this->input->post('kewenangan_id');
							$tanggal_lahir 			= date("Y-m-d", strtotime($this->input->post('tanggal_lahir')));
							$pendidikan_terakhir   	= htmlentities(strip_tags($this->input->post('pendidikan_terakhir')));
							$alumni_universitas   	= htmlentities(strip_tags($this->input->post('alumni_universitas')));
							$no_handphone   		= $this->input->post('no_handphone');
							$alamat_rumah   		= htmlentities(strip_tags($this->input->post('alamat_rumah')));

										
											$data = array(
												'nip'	 				=> $nip,
												'username'	 			=> $username,
												'nama_lengkap'	 		=> $nama_lengkap,
												'email'	 				=> $email,
												'tempat_lahir'	 		=> $tempat_lahir,
												'pangkat'	 			=> $pangkat,
												'golongan_id'	 		=> $golongan_id,
												'jabatan'	 			=> $jabatan,
												'id_jabatan_organisasi'	=> $id_jabatan_organisasi,
												'kewenangan_id'	 		=> $kewenangan_id,
												'jenis_kelamin'	 		=> $jenis_kelamin,
												'agama'	 				=> $agama,
												'tanggal_lahir'	 		=> $tanggal_lahir,
												'pendidikan_terakhir'	=> $pendidikan_terakhir,
												'alumni_universitas'	=> $alumni_universitas,
												'no_handphone'	 		=> $no_handphone,
												'alamat_rumah'	 		=> $alamat_rumah,
												'enabled'				=> '1'
											);
										
										ecurl('PUT','user/'.$id,http_build_query($data));
										insert_log('USER: Edit ID: '.$id.'');
										$this->session->set_flashdata('msg',
											'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Data User berhasil diUpdate.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
										);
										redirect('catalog/user/e/'.$id);
						}
	}
	
	
	// Search Item
	public function search_item()
	{
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Search Item Parameter";
		//$data['profile'] = json_decode(ecurl('GET','profile/'.$userData['id_user']))->data;
		$this->load->view('catalog/header', $data);
		$this->load->view('catalog/search', $data);
		$this->load->view('catalog/footer', $data);		

		
		if (isset($_POST['btninparam'])) {
												
							$field_parameter = $this->input->post('field_parameter');
							$parameter		 = $this->input->post('parameter');							
							ecurl('POST','inputparam',http_build_query(array($field_parameter=>$parameter)));							
							insert_log('DATA PARAMETER: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								redirect('catalog/search_item');
							
					}
		
		if (isset($_POST['btnsearchpar'])) {
												
							$field_parameter = $this->input->post('field_parameter');
							$parameter		 = $this->input->post('parameter');							
							/* ecurl('POST','inputparam',http_build_query(array($field_parameter=>$parameter)));							
							insert_log('DATA PARAMETER: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								); */
								redirect('catalog/search_item');
							
					}


	}
	
	
	public function search_lamp_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		//$id_user = $pdata['id_user'];
		
		$adv_lamp_side = $pdata['adv_lamp_side'];		 
		$adv_cat_indoor = $pdata['adv_cat_indoor'];		
		$adv_cat_outdoor = $pdata['adv_cat_outdoor'];		
		$min_power = $pdata['min_power'];
		$max_power = $pdata['max_power'];
		$min_lumen = $pdata['min_lumen'];
		$max_lumen = $pdata['max_lumen'];
		$min_colt = $pdata['min_colt'];
		$max_colt = $pdata['max_colt'];
		$min_colr = $pdata['min_colr'];
		$max_colr = $pdata['max_colr'];
		$optic = $pdata['optic'];
		$min_ba = $pdata['min_ba'];
		$max_ba = $pdata['max_ba'];
		$pr_shape = $pdata['pr_shape'];
		$adjustable = $pdata['adjustable'];
		$reflector_finish = $pdata['reflector_finish'];		
		$product_colour = $pdata['product_colour'];
		$product_control = $pdata['product_control'];
		$tecspec_ip = $pdata['tecspec_ip'];
		$min_ugr = $pdata['min_ugr'];
		$max_ugr = $pdata['max_ugr'];		
		$id_product_brand = $pdata['id_product_brand'];
		$product_code = $pdata['product_code'];
		
		//echo $min_ba;
		
		$limit = $pdata['length'];
		$start = $pdata['start'];	
		
		$userData = $this->session->userdata();
		$data['userData'] = $userData;			
					
		$result = json_decode(ecurl('GET','advsearchlamp?adv_lamp_side='.$adv_lamp_side.'&adv_cat_indoor='.$adv_cat_indoor.'&adv_cat_outdoor='.$adv_cat_outdoor.'&min_power='.$min_power.'&max_power='.$max_power.'&min_lumen='.$min_lumen.'&max_lumen='.$max_lumen.'&min_colt='.$min_colt.'&max_colt='.$max_colt.'&min_colr='.$min_colr.'&max_colr='.$max_colr.'&optic='.$optic.'&min_ba='.$min_ba.'&max_ba='.$max_ba.'&pr_shape='.$pr_shape.'&adjustable='.$adjustable.'&reflector_finish='.$reflector_finish.'&product_colour='.$product_colour.'&product_control='.$product_control.'&tecspec_ip='.$tecspec_ip.'&min_ugr='.$min_ugr.'&max_ugr='.$max_ugr.'&id_product_brand='.$id_product_brand.'&product_code='.$product_code.'&limit='.$limit.'&start='.$start),true);
				
		echo json_encode($result);
    }
	
	public function search_param_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$datapar = $pdata['datapar'];
		$limit = $pdata['length'];
		$start = $pdata['start'];	
		
		$userData = $this->session->userdata();
		$data['userData'] = $userData;			
					
		$result = json_decode(ecurl('GET','searchparam?datapar='.$datapar.'&limit='.$limit.'&start='.$start),true);
				
		echo json_encode($result);
    }
	
	
	public function cart_project($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		$data['prjtypedt'] = json_decode(ecurl('GET','prjtypedt'))->data;
		//echo $userdata['trans_session'];
				if ($aksi == 't') {
					$p = "cart_add";
					$data['query'] = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['judul_web'] 	  = "Input Cart";
					
				} elseif ($aksi == 'e') {
					$p = "lamp_edit";
					$data['query'] = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['judul_web'] 	  = "Edit Data Lampu";
					
				}
				elseif ($aksi == 'd') {
					$p = "lamp_detail";
					$transesion = $userData['trans_session'];
					$idcart_group = $this->input->post('idcart_group');
					$data['query'] = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					$data['judul_web'] 	  = "Detail Lamp";
					$data['transesi'] = $transesion;
					/* if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','lamp/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
						redirect('catalog/lamp/d/'.$id);
					} */
				}
				elseif ($aksi == 'h') {
					$surat = json_decode(ecurl('GET','lampdetil/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Lampu";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					if(!empty($lampiran)) {
						foreach ($lampiran as $baris) {
							unlink('lampiran/'.$baris->nama_berkas);
						}
					}
					ecurl('DELETE','lampiran/'.$surat->lampiran);
					insert_log('SURAT MASUK: Delete ID: '.$id.'');
					ecurl('DELETE','lamp/'.$id);
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Lampu berhasil dihapus.
						</div>'
							);					

					redirect('catalog/lamp');
				}else{
					$p = "cart_project";
					$data['user'] = json_decode(ecurl('GET','user'))->data;
					$data['judul_web'] 	  = "Lamp Catalog";
				}

					$this->load->view('catalog/header', $data);
					$this->load->view("catalog/pemrosesan/$p", $data);
					$this->load->view('catalog/footer');
					

	
					if (isset($_POST['btnupdatesave'])) {
						$idlamp   				= $this->input->post('idlamp');
						$project				= $this->input->post('project');
						$luminaire_type			= $this->input->post('luminaire_type');
						$luminaire_ref  		= $this->input->post('luminaire_ref');
						$lamp					= $this->input->post('lamp');
						$lamp_ref   			= $this->input->post('lamp_ref');
						$gears					= $this->input->post('gears');
						$accesories   			= $this->input->post('accesories');
						$dim_height				= $this->input->post('dim_height');
						$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
						$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
						$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
						$dim_diameter   		= $this->input->post('dim_diameter');
						$tecspec_housing		= $this->input->post('tecspec_housing');
						$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
						$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
						$tecspec_approval   	= $this->input->post('tecspec_approval');
						$tecspec_transformer	= $this->input->post('tecspec_transformer');
						$instalation_manual   	= $this->input->post('instalation_manual');
						
						$data = array();
						$data['project'] = $project;
						$data['luminaire_type'] = $luminaire_type;
						$data['luminaire_ref'] = $luminaire_ref;
						$data['lamp'] = $lamp;
						$data['lamp_ref'] = $lamp_ref;
						$data['gears'] = $gears;
						$data['accesories'] = $accesories;
						$data['dim_height'] = $dim_height;
						$data['dim_cut_o_diameter'] = $dim_cut_o_diameter;
						$data['cut_o_sq_lbr'] = $cut_o_sq_lbr;
						$data['cut_o_sq_pjg'] = $cut_o_sq_pjg;
						$data['dim_diameter'] = $dim_diameter;
						$data['tecspec_housing'] = $tecspec_housing;
						$data['tecspec_light_distr'] = $tecspec_light_distr;
						$data['tecspec_adjustment'] = $tecspec_adjustment;
						$data['tecspec_approval'] = $tecspec_approval;
						$data['tecspec_transformer'] = $tecspec_transformer;
						$data['instalation_manual'] = $instalation_manual;
						
						ecurl('PUT','updatelamp/'.$idlamp,http_build_query($data));
						insert_log('UBAH LAMPU: Edit ID '.$idlamp.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Data Updated.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
						);
						redirect('catalog/lamp/e/'.$idlamp);
					}
					
					if (isset($_POST['btnsaveas'])) {
						$_token= date('Y-m-d H:i');
						$token = md5($_token.''.rand());
						$y= date('Y');
						$m= date('m');
						$d= date('d');
						$data = array();
						$tgl_upload = date('Y-m-d');
						// Count total files
						$countfiles = count($_FILES['files']['name']);
						
						// Looping all files
						for($i=0;$i<$countfiles;$i++){
							
							if(!empty($_FILES['files']['name'][$i])){
								
								// Define new $_FILES array - $_FILES['file']
								$_FILES['file']['name'] = $_FILES['files']['name'][$i];
								$_FILES['file']['type'] = $_FILES['files']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['files']['error'][$i];
								$_FILES['file']['size'] = $_FILES['files']['size'][$i];

								// Set preference
								$config['upload_path'] = './lampiran/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								$config['max_size']    = 50000;	// max_size in kb
								$newname = $y.'_'.$m.'_'.$d.'_'.'lamp_'.$_FILES['files']['name'][$i];
								$config['file_name'] = $newname;
									
								$this->upload->initialize($config);
								$this->load->library('upload', $config);			
								
								// File upload
								if($this->upload->do_upload('file')){
									// Get data about the file
									$uploadData = $this->upload->data();
									$filename = $uploadData['file_name'];
									$ukuran = $uploadData['file_size'];									
									// Initialize array
									//$data['filenames'][] = $filename;
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'imglamp')));
								}
							}
							
						}	
							$idlamp   				= $this->input->post('idlamp');
							$project				= $this->input->post('project');
							$luminaire_type			= $this->input->post('luminaire_type');
							$luminaire_ref  		= $this->input->post('luminaire_ref');
							$lamp					= $this->input->post('lamp');
							$lamp_ref   			= $this->input->post('lamp_ref');
							$gears					= $this->input->post('gears');
							$accesories   			= $this->input->post('accesories');
							$dim_height				= $this->input->post('dim_height');
							$dim_width				= $this->input->post('dim_width');
							$dim_length				= $this->input->post('dim_length');
							$dim_cut_o_diameter 	= $this->input->post('dim_cut_o_diameter');
							$cut_o_sq_lbr			= $this->input->post('cut_o_sq_lbr');
							$cut_o_sq_pjg			= $this->input->post('cut_o_sq_pjg');
							$dim_diameter   		= $this->input->post('dim_diameter');
							$tecspec_housing		= $this->input->post('tecspec_housing');
							$tecspec_light_distr	= $this->input->post('tecspec_light_distr');
							$tecspec_adjustment 	= $this->input->post('tecspec_adjustment');
							$tecspec_approval   	= $this->input->post('tecspec_approval');
							$tecspec_transformer	= $this->input->post('tecspec_transformer');
							$instalation_manual   	= $this->input->post('instalation_manual');
														
							$id_user   	= $userData['id_user'];
							#$cat   	$cat');
							
							$waktu = date('Y-m-d H:i:s');
									$data = array(
									
										'project' 	 		 => $project,
										'luminaire_type' 	 => $luminaire_type,
										'luminaire_ref'  	 => $luminaire_ref,
										'lamp'			 	 =>	$lamp,
										'lamp_ref'   		 =>	$lamp_ref,
										'gears'				 =>	$gears,
										'accesories'   		 =>	$accesories,
										'dim_height'		 =>	$dim_height,
										'dim_width'		 	 =>	$dim_width,
										'dim_length'		 =>	$dim_length,
										'dim_cut_o_diameter' =>	$dim_cut_o_diameter,
										'cut_o_sq_lbr'		 => $cut_o_sq_lbr,
										'cut_o_sq_pjg'  	 => $cut_o_sq_pjg,
										'dim_diameter'   	 =>	$dim_diameter,
										'tecspec_housing'	 =>	$tecspec_housing,
										'tecspec_light_distr'=>$tecspec_light_distr,
										'tecspec_adjustment' =>	$tecspec_adjustment,
										'tecspec_approval'   =>	$tecspec_approval,
										'tecspec_transformer'=>	$tecspec_transformer,
										'instalation_manual' => $instalation_manual,
										'id_user' 			 => $id_user,
										'lampiran' 			 => $token,
										'ref_id' 			 => $idlamp,
										'created'	 		 => date('Y-m-d H:m:s'),
										'createdby' 		 => $userData['nip']
									);
							ecurl('POST','inputlamp',http_build_query($data));
							insert_log('DATA LAMPU: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								redirect('catalog/lamp/d/'.$idlamp);
							
					}
					
					
					if (isset($_POST['addcart'])) {
						$userData = $this->session->userdata();
						$trans_session = $userData['trans_session'];
						$idlamp = $this->input->post('idlamp');						
						
						$data = array(
							'session' 			 => $trans_session,
							'id_user' 			 => $userData['id_user'],
							'id_lamp' 			 => $idlamp,
							'status' 			 => 'PROCESS',
							'created'	 		 => date('Y-m-d H:m:s'),
							'createdby' 		 => $userData['nip']
						);						
						ecurl('POST','inputcart',http_build_query($data));
							
						redirect('catalog/cart');
						
						
						/*
						if (strlen($idcart_group) == 0) 
						{
							$data = array(
								'iduser' 			 => $userData['id_user'],
								'session' 			 => $trans_session,
								'status' 			 => 'PROCESS',
								'created'	 		 => date('Y-m-d H:m:s'),
								'createdby' 		 => $userData['nama']
							);						
							ecurl('POST','inputsesioncart',http_build_query($data));
							
						}
						*/
						
					}

	}
	
	public function carthistory_json() {
		
		$userData = $this->session->userdata();
		$iduser = $userData['id_user'];
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$searchtext = $this->input->get('searchtext');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		// $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		// $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		// $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		);
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','carthistorydata?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start.'&iduser='.$iduser),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	public function carthistorysearch_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		
		$tgl_start = $pdata['tgl_start'];
		$tgl_end = $pdata['tgl_end'];
		$project = $pdata['project'];
		$projnr = $pdata['projnr'];
		$idproject_type = $pdata['idproject_type'];
		$location = $pdata['location'];
		$status_project = $pdata['status_project'];
		$note = $pdata['note'];
		$user = $pdata['user'];
		
		$limit = $pdata['length'];
		$start = $pdata['start'];
		
		$result = json_decode(ecurl('GET','carthistorysearch?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&project='.$project.'&projnr='.$projnr.'&idproject_type='.$idproject_type.'&location='.$location.'&status_project='.$status_project.'&note='.$note.'&user='.$user.'&limit='.$limit.'&start='.$start),true);

		echo json_encode($result);
    }
	
	
	function last_string($str)
		{
		   
		return substr($str, strrpos($str, ' ') + 1);
		}
 
	
	function get_string_between($string, $start, $end)
	{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
	}
	
	function get_sub_category(){
		$id = $this->input->post('id',TRUE);
		$data = json_decode(ecurl('GET','brandtype/'.$id),true);
		echo json_encode($data);
	}
	
	function get_nested_data_edit(){
		$idlamp = $this->input->post('id',TRUE);
		//die(print_r($idlamp));
		$nestedata = json_decode(ecurl('GET','lampdetilnested/'.$idlamp));
		
	//	$data = $this->product_model->get_product_by_id($product_id)->result();
		echo json_encode($nestedata);
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function Laporanfpdf()
	{
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'DAFTAR PEGAWAI AYONGODING.COM',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(90,6,'Nama',1,0,'C');
        $pdf->Cell(120,6,'luminair',1,0,'C');
        $pdf->Cell(40,6,'xxxx',1,1,'C');
        $pdf->SetFont('Arial','',10);
		$pegawai = json_decode(ecurl('GET','datalampu'))->data;
        $no=0;
        foreach ($pegawai as $data){
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(90,6,$data->luminaire_type,1,0);
            $pdf->Cell(120,6,$data->luminaire_ref,1,0);
            $pdf->Cell(40,6,$data->lamp,1,1);
        }
        $pdf->Output();
	}
	
	public function type_lamp($aksi='', $id='')
	{
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Type Lamp Reference";
		//$data['profile'] = json_decode(ecurl('GET','profile/'.$userData['id_user']))->data;
		$p = "type_lamp";

		if ($aksi == 'e') {
						$p = "type_lamp_edit";
						$data['query'] = json_decode(ecurl('GET','typedetil/'.$id))->data;						
						$data['judul_web'] 	  = "Edit Type Lamp";
					}
		

						$this->load->view('catalog/header', $data);
						$this->load->view("catalog/reference/$p", $data);
						$this->load->view('catalog/footer', $data);
		
				if (isset($_POST['btninparam'])) {
												
							$side 			   = $this->input->post('side');
							$name_product_type = $this->input->post('name_product_type');							
							
							$data = array(
										'side' => $side,
										'name_product_type' => $name_product_type
										);

							ecurl('POST','inputtype',http_build_query($data));							
							insert_log('DATA PARAMETER: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Success</h4>
											  <div class="text-muted">Data Inserted.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
								);
								redirect('catalog/type_lamp');
							
					}

		
					if (isset($_POST['btnupdate'])) {
						
						$id_product_type	= $this->input->post('id');
						$side				= $this->input->post('side');
						$name_product_type	= $this->input->post('name_product_type');
						
						$data = array();
						
						$data['side'] = $side;
						$data['name_product_type'] = $name_product_type;
						#die(print_r($data));
						ecurl('PUT','updatetypelamp/'.$id_product_type,http_build_query($data));
						insert_log('UBAH TIPE LAMPU: Edit ID '.$id_product_type.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Succes</h4>
											  <div class="text-muted">Data Updated.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
						);
						//redirect('catalog/type_lamp/e/'.$id_product_type);
						redirect('catalog/type_lamp');
					}
	}
	
	public function search_type_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$dtype = $pdata['dtype'];
		$limit = $pdata['length'];
		$start = $pdata['start'];	
		//die(print_r($dtype));
		$userData = $this->session->userdata();
		$data['userData'] = $userData;			
					
		$result = json_decode(ecurl('GET','searchtype?dtype='.$dtype.'&limit='.$limit.'&start='.$start),true);
				
		echo json_encode($result);
    }
	
	function get_type_lamp(){
		$id = $this->input->post('id',TRUE);
		$data = json_decode(ecurl('GET','brandtype/'.$id),true);
		echo json_encode($data);
	}
	
	public function print_spec()
	{
		$exp = explode("_",$_GET['id']);
		$idcart=$exp[0];		
		$data['dt'] = json_decode(ecurl('GET','getcartdetilprint/'.$idcart))->data;
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "outline-specification.pdf";
		$this->pdf->load_view('catalog/laporan_pdf', $data);
	}
	
	
	public function cartproject_json() {
		
		$userData = $this->session->userdata();
		$iduser = $userData['id_user'];
		$code = $_GET['code'];
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$searchtext = $this->input->get('searchtext');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		// $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		// $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		// $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		);
		#var_dump('>>'.$searchtext);
		//$result = json_decode(ecurl('GET','cartlist?id='.$code.'&limit='.$limit.'&start='.$start.'&iduser='.$iduser),true);
		
		$result = json_decode(ecurl('GET','cartlist?id='.$code.'&limit='.$limit.'&start='.$start.'&iduser='.$iduser),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	public function cartprojectsearch_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		
		$code = $pdata['code'];
		$adv_lamp_side = $pdata['adv_lamp_side'];		 
		$adv_cat_indoor = $pdata['adv_cat_indoor'];		
		$adv_cat_outdoor = $pdata['adv_cat_outdoor'];
		$codelamp = $pdata['codelamp'];
		$lamp = $pdata['lamp'];
		$id_product_brand = $pdata['id_product_brand'];
		$power = $pdata['power'];
		$lumen = $pdata['lumen'];
		$product_colour = $pdata['product_colour'];
		$reflector_finish = $pdata['reflector_finish'];
		$accesories = $pdata['accesories'];
		
		$limit = $pdata['length'];
		$start = $pdata['start'];
		
		$result = json_decode(ecurl('GET','cartprojectsearch?code='.$code.'&codelamp='.$codelamp.'&adv_lamp_side='.$adv_lamp_side.'&adv_cat_indoor='.$adv_cat_indoor.'&adv_cat_outdoor='.$adv_cat_outdoor.'&lamp='.$lamp.'&id_product_brand='.$id_product_brand.'&power='.$power.'&lumen='.$lumen.'&product_colour='.$product_colour.'&reflector_finish='.$reflector_finish.'&accesories='.$accesories.'&limit='.$limit.'&start='.$start),true);

		echo json_encode($result);
    }
	
	
	public function inputSelected() {

	$userData = $this->session->userdata();
		//header('Content-Type: application/json');		
		$pdata = $this->input->post();		
		$selCheck = $pdata['selCheck'];
		$project = $pdata['project'];
		$id_user = $userData['id_user'];
		//die(print_r($selCheck));
		
				$pilih = explode(',',$selCheck);
				//$categories = '';
				foreach($pilih as $sel) {
					$id_lamp = trim($sel);
					//$categories = '';
					//$categories .= "-" . $sel . "ok<br>";
					
				ecurl('POST','inputcart',http_build_query(array('code'=>$project,'id_user'=>$id_user,'id_lamp'=>$id_lamp,'status'=>'SAVE')));
				//die(print_r($project));
				insert_log('TAMBAH PRODUK CART');
				//header('location: '.base_url().'catalog/cart?idcart='.$project.'');	
				
				}
		
    }
	
	public function laporan_pdf(){
		
		$dataku = '<!DOCTYPE html>
<html>
<body>

<h1>My First Heading</h1>
<p>My first paragraph.</p>
<ul>
	<li>tes</li>
	<li>ok</li>
	<li>lagi deh</li>
</ul>
</body>
</html> ';

		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan.pdf";
		$this->pdf->load_view('catalog/laporan_pdf', $dataku);


	}
	
	public function brand($aksi='', $id=''){
			$userData = $this->session->userdata();
			$data['userData'] = $userData;
					if ($aksi == 't') {
						$p = "user_tambah";
						$data['judul_web'] 	  = "Tambah Brand";
					
					}
					elseif ($aksi == 'e') {
						$p = "user_edit";
						$data['query'] = json_decode(ecurl('GET','userdetil/'.$id))->data;
						$data['judul_web'] 	  = "Edit Brand";
					}
					elseif ($aksi == 'h') {
						$data['judul_web'] 	  = "Hapus Brand";
						// Cek Relasi
						
							insert_log('BRAND : Delete ID: '.$id.'');
							ecurl('DELETE','pengguna/'.$id);
							$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">User Berhasil dihapus.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
							);
						
						redirect('catalog/brand');
					} else {
						$p = "brand";
						$data['judul_web'] 	  = "BRAND";						
					}

						$this->load->view('catalog/header', $data);
						$this->load->view("catalog/master/$p", $data);
						$this->load->view('catalog/footer');

						if (isset($_POST['btnsimpan'])) {
						
							$nip   					= htmlentities(strip_tags($this->input->post('nip')));
							$username				= htmlentities(strip_tags($this->input->post('username')));
							$nama_lengkap   		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
														
									$data = array(
												'nip'	 				=> $nip,
												'username'	 			=> $username,
												'nama_lengkap'	 		=> $nama_lengkap
											);
											ecurl('POST','user',http_build_query($data));
											insert_log('TAMBAH USER');
											$this->session->set_flashdata('msg',
												'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Data User berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
											);

										redirect('catalog/user/t');
						}

						if (isset($_POST['btnupdate'])) {
							
							$nip   					= htmlentities(strip_tags($this->input->post('nip')));
							$username				= htmlentities(strip_tags($this->input->post('username')));
							$nama_lengkap   		= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						
											$data = array(
												'nip'	 				=> $nip,
												'username'	 			=> $username,
												'nama_lengkap'	 		=> $nama_lengkap
											);
										
										ecurl('PUT','user/'.$id,http_build_query($data));
										insert_log('BRAND: Edit ID: '.$id.'');
										$this->session->set_flashdata('msg',
											'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Data User berhasil diUpdate.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
										);
										redirect('catalog/user/e/'.$id);
						}
	}
	
}

//https://yesporn.vip/hipster-queens-clown-boys-for-clicks-52ea60e1/
//http://103.105.48.16/video-z38f117/two_stunning_ladies_swap_partners_for_a_wild_night_ lacy elenon gianna dior
//https://allavtv.com/#/videos?title=asian
//https://vidioan.xyz/video-13cran62/_tianmei_media_domestically_produced_original_av_sentimental_goddess_takes_you_to_experience_lily_love_series_feature_film
//https://vidioan.xyz/video-11jf1h2d/_domestic_madou_media_s_products_must_be_fine_products
//https://vidioan.xyz/video-136chb0f/_tianmei_media_domestically_produced_original_av_big_penis_marshmallow_hole_and_the_rhythm_of_your_body
//https://vidioan.xyz/video-jfzxnb0/this_girl_is_the_perfect_whore
//https://vidioan.xyz/video-jcr5d06/ngentot_tante_cantik
//https://vidioan.xyz/video-x5937f4/big_breast_bombshells_kyra_hot_and_lucie_wilde_get_their_deep_cleavage_titty_fucked
//https://vidioan.xyz/video-py1a1af/see_cock-addict_cristina_miller_s_shaved_wet_pink_fucked_balls_deep_on_the_couch
//https://vidioan.xyz/video-15a9npa8/japan_amateur_xxx
//https://vidioan.xyz/video-udsyveb/nerd_pawg_in_glasses_has_convulsing_strong_full_body_orgasms
//https://vidioan.xyz/video-16nue256/big_butt_big_tit_thick_emo_creaming_and_squirting_intensely
//https://vidioan.xyz/video-15q8j59d/massage_rooms_big_boobs_asian_beauty_sloppy_handjob_on_milking_table
//https://vidioan.xyz/video-opobj90/asian_big_natural_tits_with_tight_pussy
//https://vidioan.xyz/video-wci9r99/hispanic_milf_has_nasty_gushy_wet_squirt_orgasms
//https://vidioan.xyz/video-12ie7dfc/_tianmei_media_domestically_produced_original_av_wife_finally_paid_off_her_debts_but_her_body_is_not_satisfied
//https://vidioan.xyz/video-16emkr75/tmf001_super_dick_gangbang_group_sex
//https://vidioan.xyz/video-12ieynd1/_tianmei_media_domestically_produced_original_av_screaming_bitch_girl_psychedelic_and_cleverly_manipulated_freely._feature_film
//https://vidioan.xyz/video-12s2dpdc/_tianmei_media_domestically_produced_original_av_wake_up_exercises_in_those_years_feature_film#show-related
//https://vidioan.xyz/video-12ib6pc1/_tianmei_media_a_domestically_produced_original_av_boyfriend_has_a_high_fever._in_order_to_take_care_of_him_i_use_my_body_to_help_him_cool_down.
//https://vidioan.xyz/video-nk9crf7/asian_giving_bbc_blowjob jahan
//https://vidioan.xyz/video-13rsrr42/vegas_sex_asian_fucking_big_dick jahan
//https://vidioan.xyz/video-11d7h900/bangbros_-_fun_behind_the_scenes_clips_from_moc_part_two_
//https://vidioan.xyz/video-16ydoucf/_domestic_madou_media_must_be_a_high-quality_product
//https://vidioan.xyz/video-12dlrx93/_domestic_madou_media_s_products_must_be_fine_products
//https://vidioan.xyz/video-xpckt52/best_dick_best_asian_pussy
//https://vidioan.xyz/video-w9vgd03/black_dick_stuffing_asian_pussy_creampie_
//https://vidioan.xyz/video-t59ktc1/petite_asian_beauty_fucked_doggystyle
//https://vidioan.xyz/video-162p0h6a/_jelly_media_madou
//https://vidioan.xyz/video-15qn6ha0/_jellymedia_chinese_domestic_madou_91_4p_
//https://vidioan.xyz/video-15svad62/_jellymedia_media_madou_domestic_original_plot_uncensored_free
//https://vidioan.xyz/video-kmxqd25/realitykings_-_happy_tugs_-_mila_fyre_-_asian_masseuse_sixtynines_and_tugs
//https://vidioan.xyz/video-16jmn79d/virgin_muslim_teen_sucking_her_american_boyfriend
//https://vidioan.xyz/video-kfz7t05/cute_hijab_girl_penetrated
//https://vidioan.xyz/video-14hw2bf9/please_don_t_use_a_condom_i_want_to_bear_your_offspring_-_nicolove
//https://www.pornhub.com/view_video.php?viewkey=ph6164fc7e15b1a
//https://vidioan.xyz/video-12nryd83/shower_sex_and_getting_cum_on_my_face_-_nicolove
//https://vidioan.xyz/video-12q0uf0b/when_sensual_massage_turned_into_intense_love_making_-_nicolove
//https://vidioan.xyz/video-128vfj88/big_titty_latina_milf_gets_fucked_outside_her_rv_during_vacation
//https://vidioan.xyz/video-1175rld1/_domestic_madou_media_s_products_must_be_fine_products beauty
//https://vidioan.xyz/video-11745r2f/_domestic_madou_media_s_products_must_be_fine_products
//https://vidioan.xyz/video-11hosx97/_domestic_madou_media_s_products_must_be_fine_products
//https://vidioan.xyz/video-z25hl6b/busty_tattooed_chick_gets_a_new_tattoo_on_her_face
//https://vidioan.xyz/video-ux90n8b/beautiful_busty_blonde_uses_a_toy_while_having_her_arm_tattooed
//https://vidioan.xyz/video-wzy73d4/busty_australian_babe_has_her_butthole_tattooed_after_she_fucks_the_tattoo_artist
//https://vidioan.xyz/video-17cqqr8a/_domestic_madou_media_must_be_a_high-quality_product 3 banyak
//https://vidioan.xyz/video-16v6sqf9/_domestic_madou_media_must_be_a_high-quality_product
//https://vidioan.xyz/video-16ryx396/_domestic_madou_media_must_be_a_high-quality_product
//https://vidioan.xyz/video-15t1dp67/_ milf
//https://vidioan.xyz/video-13cl7x6e/_tianmei_media_domestically_produced_original_av_reverie_of_youth_memories_feature_film
//http://103.105.48.16/video-16vhrabf/cute_nurse_sucks_dick_and_fucks_with_client
//http://103.105.48.16/video-rw56l89/japanese_love_japanese_sex_asian_sex_diary_japanase_love_story_memek_bersih_mario_ozawa
//http://103.105.48.16/video-158l0z47/thai_whore_-_asian_teen_fuck
//https://vidioan.xyz/video-13sgax1e/_tianmei_media_domestically_produced_original_av_yifei_treats_zi_qiao_for_emotional_and_anti-quilt_routines
//https://www.pornhub.com/video/search?search=elle+lee
//https://www.pornhub.com/video/search?search=nicolove
//https://www.pornhub.com/view_video.php?viewkey=ph632183884dd00
//https://www.pornhub.com/view_video.php?viewkey=ph632d7ae9569a4
//https://www.pornhub.com/view_video.php?viewkey=ph631f2fd94c9f0
//https://www.pornhub.com/view_video.php?viewkey=ph617aced548fcb
//https://www.pornhub.com/view_video.php?viewkey=ph6334d4aa32ef0
//https://www.pornhub.com/view_video.php?viewkey=ph633286cce6f34
//https://www.pornhub.com/view_video.php?viewkey=ph5e7ce626480ed
//https://www.pornhub.com/channels/modelmediaasia
//https://www.pornhub.com/view_video.php?viewkey=ph60dc402c13e16

//https://www.pornhub.com/view_video.php?viewkey=ph61760ac249c06
//https://www.pornhub.com/view_video.php?viewkey=ph63072b4b6a170
//https://www.pornhub.com/view_video.php?viewkey=ph5e7f806a74e46
//https://vidioan.xyz/video-16z0l414/_domestic_madou_media_must_be_a_high-quality_product
//https://nontonx.xyz/video-15axa98b/_domestic_madou_media_must_be_a_high-quality_product
//https://nontonx.xyz/video-11onv52e/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/search/Ariana+Marie
//https://nontonx.xyz/video-13bgsrcd/having_sex_while_watching_a_game_part_1_-_nicolove
//https://nontonx.xyz/video-147f6ff5/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/video-136hjzfc/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/video-129do5a9/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/video-15jupvae/_domestic_madou_media_must_be_a_high-quality_product
//https://nontonx.xyz/video-v772543/the_widow_s_pussy_is_so_smooth
//https://nontonx.xyz/video-a4eepb3/desahan_lisa_abg_hot
//https://nontonx.xyz/video-14yk1fa6/blacked_best_orgasm_comp
//https://nontonx.xyz/video-16finb76/chicas_loca_-_apolonia_lapiedra_alexa_tomas_-_ffm_sex_session_with_horny_spanish_chicks
//https://nontonx.xyz/video-vdfof2d/young_lesbian_stepdaughters_stepfamily_fuck_white_stepfather_after_catching_them_masturbating
//https://nontonx.xyz/video-13ni071b/sexy_asian_realtor_selene_sun_fucks_client
//https://nontonx.xyz/video-1459z330/sexy_asian_raya_nguyen_bangs_her_associate
//https://nontonx.xyz/video-16r86pc6/i_really_want_to_touch_this_breast
//https://nontonx.xyz/video-16epd94a/_domestic_madou_media_must_be_a_high-quality_product
//https://nontonx.xyz/video-134v3fd4/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/video-12h4md2c/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/video-12ts3v22/_domestic_madou_media_s_products_must_be_fine_products
//https://nontonx.xyz/video-12ts6h12/_domestic_madou_media_s_products_must_be_fine_products