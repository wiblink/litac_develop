<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketatausahaan extends CI_Controller {
	
 public function __construct(){
    parent::__construct();
    
	$this->load->helper('tanggal_helper');
	$this->load->helper('config_helper');
	//$this->load->helper('menu_helper');
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
		//$data['getmenu'] = json_decode(ecurl('GET','menutes'))->data;
		$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
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
			$data['reportsurat'] = json_decode(ecurl('GET','reportsurat/fromDate/'.$this_week_sd.'/toDate/'.$this_week_ed))->data;
		}
		$this->load->view('ketatausahaan/header', $data);
		$this->load->view('ketatausahaan/dashboard', $data);
		$this->load->view('ketatausahaan/footer');
	}
	
	
	// Profile
	public function profile()
	{
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Profile";
		$data['profile'] = json_decode(ecurl('GET','profile/'.$userData['id_user']))->data;
		$data['jumlah_meja'] = json_decode(ecurl('GET','jumlah_meja'));
		$this->load->view('ketatausahaan/header', $data);
		$this->load->view('ketatausahaan/profile', $data);
		$this->load->view('ketatausahaan/footer', $data);		


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
							redirect('ketatausahaan/profile');
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
							redirect('ketatausahaan/profile');
			}
			
			if (isset($_POST['btnupdatemeja'])) {
				
				$id = $this->input->post('idmeja');
									$jumlah_meja = $this->input->post('jumlah_meja');
										
									$data = array(
										'jumlah_meja' => $jumlah_meja
										);
										ecurl('PUT','jumlah_meja_edit/'.$id,http_build_query($data));
										insert_log('JUMLAH MEJA: Edit');
									
									
									$this->session->set_flashdata('msgm',
										'<div class="alert alert-success alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <!-- SVG icon code with class="alert-icon" -->
											</div>
											<div>
											  <h4 class="alert-title">Sukses</h4>
											  <div class="text-muted">Jumlah Meja berhasil disimpan.</div>
											</div>
										  </div>
										  <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
										</div>'
									);
									redirect('ketatausahaan/profile');
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

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view('ketatausahaan/pengaturan/'.$pilih, $data);
					$this->load->view('ketatausahaan/footer');

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
									write_file('./assets/config_theme.txt', $cfg);

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
									redirect('ketatausahaan/pengaturan/'.$pilih.'');
					}
			}
			else if ($pilih == 'bg') {
					$data['userData'] = $userData;
					$data['judul_web'] 		= "Background & Icons";

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view('ketatausahaan/pengaturan/'.$pilih, $data);
					$this->load->view('ketatausahaan/footer');
					
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
									redirect('ketatausahaan/pengaturan/'.$pilih.'');
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
		$this->load->view('ketatausahaan/header', $data);
		$this->load->view('ketatausahaan/laporan/logs', $data);
		$this->load->view('ketatausahaan/footer', $data);	
	}
	
	// Jabatan Organisasi
	public function jabatanorganisasi(){
		$userData = $this->session->userdata();
		$data['userData'] 	= $userData;
		$data['judul_web'] 	= "Jabatan Organisasi";
		$data['jabatan'] = ecurl('GET','jabatanorganisasi');
		$this->load->view('ketatausahaan/header', $data);
		$this->load->view('ketatausahaan/laporan/jabatan', $data);
		$this->load->view('ketatausahaan/footer', $data);	
	}
	
	// Fungsi JSON
    public function tipesurat_json() {
		
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
		$result = json_decode(ecurl('GET','tipesurat?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// Tipe Surat
	public function tipesurat($aksi='', $id=''){
			$userData = $this->session->userdata();
			$data['userData'] = $userData;
			$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;

					if ($aksi == 't') {
						$p = "tipesurat_tambah";
						$data['judul_web'] 	  = "Tambah Tipe Surat";
					}
					elseif ($aksi == 'e') {
						$p = "tipesurat_edit";
						$data['query'] = json_decode(ecurl('GET','tipesuratedit/'.$id))->data;
						$data['judul_web'] 	  = "Edit Tipe Surat";
					}
					elseif ($aksi == 'h') {
						$data['judul_web'] 	  = "Hapus Tipe Surat";
						// Cek Relasi Tipe Surat
						$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_tahun/diklat_diklat'));
						if($cekrelasi->status == 'no data') {
							insert_log('TIPE SURAT: Delete ID: '.$id.'');
							ecurl('DELETE','tipesurat/'.$id);
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Tipe Surat berhasil dihapus.
									</div>'
							);
						}
						else {
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Tipe Surat masih dipakai.
									</div>'
							);
						}
						redirect('ketatausahaan/tipesurat');
					}else{
						$p = "tipesurat";
						$data['judul_web'] 	  = "Tipe Surat";
					}

						$this->load->view('ketatausahaan/header', $data);
						$this->load->view("ketatausahaan/master/$p", $data);
						$this->load->view('ketatausahaan/footer');

						if (isset($_POST['btnsimpan'])) {
							$tipe_surat   	 	= htmlentities(strip_tags($this->input->post('tipe_surat')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc')));

											$data = array(
												'tipe_surat'	 => $tipe_surat,
												'deskripsi'	 => $deskripsi
											);
											ecurl('POST','tipesurat',http_build_query($data));
											insert_log('TAMBAH TIPE SURAT');
											$this->session->set_flashdata('msg',
												'
												<div class="alert alert-success alert-dismissible" role="alert">
													 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
														 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
													 </button>
													 <strong>Sukses!</strong> Tipe Surat berhasil ditambahkan.
												</div>'
											);

										redirect('ketatausahaan/tipesurat/t');
						}

						if (isset($_POST['btnupdate'])) {
							$tipe_surat   	 	= htmlentities(strip_tags($this->input->post('tipe_surat')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc')));

										
											$data = array(
												'tipe_surat'	 => $tipe_surat,
												'deskripsi'	 => $deskripsi
											);
										ecurl('PUT','tipesurat/'.$id,http_build_query($data));
										insert_log('TIPE SURAT: Edit ID: '.$id.'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Tipe Surat berhasil diupdate.
											</div>'
										);
										redirect('ketatausahaan/tipesurat');
						}
	}
	
	
	// Fungsi JSON
    public function jenissurat_json() {
		
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
		$result = json_decode(ecurl('GET','jenissurat?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// Jenis Surat
	public function jenissurat($aksi='', $id=''){
			$userData = $this->session->userdata();
			$data['userData'] = $userData;
			$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;

					if ($aksi == 't') {
						$p = "jenissurat_tambah";
						$data['judul_web'] 	  = "Tambah Jenis Surat";
					}
					elseif ($aksi == 'e') {
						$p = "jenissurat_edit";
						$data['query'] = json_decode(ecurl('GET','jenissuratedit/'.$id))->data;
						$data['judul_web'] 	  = "Edit Jenis Surat";
					}
					elseif ($aksi == 'h') {
						$data['judul_web'] 	  = "Hapus Jenis Surat";
						// Cek Relasi Jenis Surat
						$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_tahun/diklat_diklat'));
						if($cekrelasi->status == 'no data') {
							insert_log('JENIS SURAT: Delete ID: '.$id.'');
							ecurl('DELETE','jenissurat/'.$id);
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Jenis Surat berhasil dihapus.
									</div>'
							);
						}
						else {
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Jenis Surat masih dipakai.
									</div>'
							);
						}
						redirect('ketatausahaan/jenissurat');
					}else{
						$p = "jenissurat";
						$data['judul_web'] 	  = "Jenis Surat";
					}

						$this->load->view('ketatausahaan/header', $data);
						$this->load->view("ketatausahaan/master/$p", $data);
						$this->load->view('ketatausahaan/footer');

						if (isset($_POST['btnsimpan'])) {
							$jenis_surat   	 	= htmlentities(strip_tags($this->input->post('jenis_surat')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc')));

											$data = array(
												'jenis_surat'	 => $jenis_surat,
												'deskripsi'	 => $deskripsi
											);
											ecurl('POST','jenissurat',http_build_query($data));
											insert_log('TAMBAH JENIS SURAT');
											$this->session->set_flashdata('msg',
												'
												<div class="alert alert-success alert-dismissible" role="alert">
													 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
														 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
													 </button>
													 <strong>Sukses!</strong> Jenis Surat berhasil ditambahkan.
												</div>'
											);

										redirect('ketatausahaan/jenissurat/t');
						}

						if (isset($_POST['btnupdate'])) {
							$jenis_surat   	 	= htmlentities(strip_tags($this->input->post('jenis_surat')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc')));

										
											$data = array(
												'jenis_surat'	 => $jenis_surat,
												'deskripsi'	 => $deskripsi
											);
										ecurl('PUT','jenissurat/'.$id,http_build_query($data));
										insert_log('JENIS SURAT: Edit ID: '.$id.'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> JENIS Surat berhasil diupdate.
											</div>'
										);
										redirect('ketatausahaan/jenissurat');
						}
	}
	
	// Fungsi JSON
    public function kodesurat_json() {
		
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
		$result = json_decode(ecurl('GET','kodesurat?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// Kode Surat
	public function kodesurat($aksi='', $id=''){
		
			$userData = $this->session->userdata();
			$data['userData'] = $userData;
			//$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;

					if ($aksi == 't') {
						$p = "kodesurat_tambah";
						$data['judul_web'] 	  = "Tambah Kode Surat";
					}
					elseif ($aksi == 'e') {
						$p = "kodesurat_edit";
						$data['query'] = json_decode(ecurl('GET','kodesuratedit/'.$id))->data;
						$data['judul_web'] 	  = "Edit Kode Surat";
					}
					elseif ($aksi == 'h') {
						$data['judul_web'] 	  = "Hapus Kode Surat";
						// Cek Relasi Kode Surat
						$cekrelasisuratmasuk = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_kode_surat/tbl_surat_masuk'));
						$cekrelasisuratkeluar = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_kode_surat/tbl_surat_keluar'));
						if($cekrelasisuratmasuk->status == 'no data') {
								insert_log('KODE SURAT: Delete ID: '.$id.'');
								ecurl('DELETE','kodesurat/'.$id);
								$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Kode Surat berhasil dihapus.
										</div>'
								);
						} 
						else {
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Kode Surat masih dipakai.
									</div>'
							);
						}
						redirect('ketatausahaan/kodesurat');
					}else{
						$p = "kodesurat";
						$data['judul_web'] 	  = "Kode Surat";
					}

						$this->load->view('ketatausahaan/header', $data);
						$this->load->view("ketatausahaan/master/$p", $data);
						$this->load->view('ketatausahaan/footer');

						if (isset($_POST['btnsimpan'])) {
							$no_kode   	 	= htmlentities(strip_tags($this->input->post('no_kode')));
							$kode_surat   	 	= htmlentities(strip_tags($this->input->post('nama_kode')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc_kode')));

											$data = array(
												'no_kode'	 => $no_kode,
												'kode_surat'	 => $kode_surat,
												'deskripsi'	 => $deskripsi
											);
											ecurl('POST','kodesurat',http_build_query($data));
											insert_log('TAMBAH KODE SURAT');
											$this->session->set_flashdata('msg',
												'
												<div class="alert alert-success alert-dismissible" role="alert">
													 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
														 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
													 </button>
													 <strong>Sukses!</strong> Kode Surat berhasil ditambahkan.
												</div>'
											);

										redirect('ketatausahaan/kodesurat/t');
						}

						if (isset($_POST['btnupdate'])) {
							$no_kode   	 	= htmlentities(strip_tags($this->input->post('no_kode')));
							$kode_surat   	 	= htmlentities(strip_tags($this->input->post('nama_kode')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc_kode')));

										
											$data = array(
												'no_kode'	 => $no_kode,
												'kode_surat'	 => $kode_surat,
												'deskripsi'	 => $deskripsi
											);
										ecurl('PUT','kodesurat/'.$id,http_build_query($data));
										insert_log('KODE SURAT: Edit ID: '.$id.'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Kode Surat berhasil diupdate.
											</div>'
										);
										redirect('ketatausahaan/kodesurat');
						}
	}
	
	public function search_kodesurat_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$search = $pdata['search'];
		$searchtext = $pdata['searchtext'];		 
		$limit = $pdata['length'];
		$start = $pdata['start'];
		//echo $search.'<>'.$searchtext;		 
		$result = json_decode(ecurl('GET','kodesurat?search='.$search.'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);			
		echo json_encode($result);
    }
	
	
	// Disposisi
		// Fungsi srat masuk JSON
    public function disposisi_json() {
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		/* $data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		); */
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','suratdisposisi?='.$search['value'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	public function suratdisposisi($aksi='', $id=''){
			$userData = $this->session->userdata();
			//$data['getmenu'] = json_decode(ecurl('GET','menu'))->data;
			$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				//$data['suratdisposisi'] = json_decode(ecurl('GET','suratdisposisi'))->data;
			}
			
					if ($aksi == 't') {
						$p = "kodesurat_tambah";
						$data['judul_web'] 	  = "Tambah Kode Surat";
					}
					elseif ($aksi == 'e') {
						$p = "kodesurat_edit";
						$data['query'] = json_decode(ecurl('GET','kodesurat/'.$id))->data;
						$data['judul_web'] 	  = "Edit Kode Surat";
					}
					elseif ($aksi == 'd') {
						$p = "dp_detail";
						$data['query'] = json_decode(ecurl('GET','suratdisposisi/'.$id))->data;
						$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
						$data['judul_web'] 	  = "Detail Surat Disposisi";
							/*if ($data['query']->disposisi_pelaksana == $userData['id_user']) {
								ecurl('PUT','suratmasuk/'.$id,http_build_query(array('disposisi_diterima'=>date('Y-m-d H:i:s'))));
							}*/
					}
					elseif ($aksi == 'haa') {
						$data['judul_web'] 	  = "Hapus Kode Surat";
						// Cek Relasi Kode Surat
						$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_tahun/diklat_diklat'));
						if($cekrelasi->status == 'no data') {
							insert_log('DIKLAT: KODE SURAT: Delete ID: '.$id.'');
							ecurl('DELETE','kodesurat/'.$id);
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Kode Surat berhasil dihapus.
									</div>'
							);
						}
						else {
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Kode Surat masih dipakai.
									</div>'
							);
						}
						redirect('ketatausahaan/kodesurat');
					}else{
						$p = "dp";
						$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
						$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
						$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
						$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
						$data['judul_web'] 	  = "Surat Disposisi";
					}

						$this->load->view('ketatausahaan/header', $data);
						$this->load->view("ketatausahaan/pemrosesan/$p", $data);
						$this->load->view('ketatausahaan/footer');

						// Tanggapan Disposisi Submit
						if (isset($_POST['terimadisp'])) {
							$data = array();
							$respon = $this->input->post('respon_disposisi');
							if($respon == 'terima') {
								$data['disposisi_diterima_status'] = 1;
							}
							else {
								$data['disposisi_diterima_status'] = 0;
							}
							$data['disposisi_diterima_tanggapan'] = $this->input->post('tanggapan_disposisi');
							$data['disposisi_diterima'] = date('Y-m-d H:i:s');
							
							ecurl('PUT','suratdisposisi/'.$id,http_build_query($data));
							insert_log('DISPOSISI: Tambah Tanggapan ID: '.$id.' | <strong>'.strtoupper($respon).'</strong> | <small>"<em>'.$data['disposisi_diterima_tanggapan'].'</em></small>"');
							$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Penerimaan Disposisi berhasil dikirim.
									</div>'
							);
							redirect('ketatausahaan/suratdisposisi/d/'.$id);
						}
						
						// Proses Disposisi Submit
						if (isset($_POST['prosesdisp'])) {
							$data = array();
							$data['disposisi_proses_tanggapan'] = $this->input->post('proses_disposisi');
							$data['disposisi_proses'] = date('Y-m-d H:i:s');
							
							ecurl('PUT','suratdisposisi/'.$id,http_build_query($data));
							insert_log('DISPOSISI: Proses ID: '.$id.' | <small>"<em>'.$data['disposisi_proses_tanggapan'].'</em></small>"');
							$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Proses Disposisi berhasil dikirim.
									</div>'
							);
							redirect('ketatausahaan/suratdisposisi/d/'.$id);
						}
						
						// Selesai Disposisi Submit
						if (isset($_POST['selesaidisp'])) {
							$data = array();
							$data['surat_selesai_tanggapan'] = $this->input->post('selesai_disposisi');
							$data['surat_selesai'] = date('Y-m-d H:i:s');
							
							ecurl('PUT','suratdisposisi/'.$id,http_build_query($data));
							insert_log('DISPOSISI: Selesai ID: '.$id.' | <small>"<em>'.$data['surat_selesai_tanggapan'].'</em></small>"');
							$this->session->set_flashdata('msg',
									'<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Disposisi telah selesai.
									</div>'
							);
							redirect('ketatausahaan/suratdisposisi/d/'.$id);
						}
	}

	// Fungsi srat masuk JSON
    public function suratmasuk_json() {
		
		header('Content-Type: application/json');
	
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		/* $data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		); */
		#var_dump('>>'.$searchtext);
		#$result = json_decode(ecurl('GET','suratmasuk?date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
		
		
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				$result = json_decode(ecurl('GET','suratmasuk?date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
			}
			else {
				$result = json_decode(ecurl('GET','suratmasuk?userid='.$userData['id_user'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
			}
			
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// Surat Masuk
	public function suratmasuk($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;

				if ($aksi == 't') {
					$p = "sm_tambah";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Tambah Surat";
				}
				elseif ($aksi == 'e') {
					$p = "sm_edit";
					$data['query'] = json_decode(ecurl('GET','menudetil/'.$id))->data;
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Edit Surat Masuk";
					
				}
				elseif ($aksi == 'd') {
					$p = "sm_detail";
					$data['query'] = json_decode(ecurl('GET','suratmasukdetil/'.$id))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['judul_web'] 	  = "Detail Surat Masuk";
					if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','suratmasuk/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
						redirect('ketatausahaan/suratmasuk/d/'.$id);
					}
				}
				elseif ($aksi == 'disposisi') {
					$p = "sm_disposisi";
					$data['query'] = json_decode(ecurl('GET','suratmasukdetil/'.$id))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['judul_web'] 	  = "Disposisikan Surat Masuk";
					if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','suratmasuk/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
					}
				}
				elseif ($aksi == 'h') {
					$surat = json_decode(ecurl('GET','suratmasukdetil/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Surat Masuk";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					if(!empty($lampiran)) {
						foreach ($lampiran as $baris) {
							unlink('lampiran/'.$baris->nama_berkas);
						}
					}
					ecurl('DELETE','lampiran/'.$surat->lampiran);
					insert_log('SURAT MASUK: Delete ID: '.$id.'');
					ecurl('DELETE','suratmasuk/'.$id);
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Surat masuk berhasil dihapus.
						</div>'
							);					

					redirect('ketatausahaan/suratmasuk');
				}elseif ($aksi == 'del') {
					//die(print_r($id));
					$_expid = explode("_",$id);
					$id = $_expid['0'];
					$idpage = $_expid['1'];
					$surat = json_decode(ecurl('GET','lampirandetil/'.$id))->data;
					//die(print_r($surat->id));
					$data['judul_web'] 	  = "Hapus Surat Masuk";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					unlink('lampiran/'.$surat->nama_berkas);
					//die(print_r($surat->id));
					ecurl('DELETE','lampiranfile/'.$surat->id);
					insert_log('LAMPIRAN SURAT MASUK: Delete ID: '.$id.'');
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Lampiran berhasil dihapus.
						</div>'
							);

					redirect('ketatausahaan/suratmasuk/e/'.$idpage);
				}else{
					$p = "sm";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Surat Masuk";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("ketatausahaan/pemrosesan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah Surat Masuk Submit
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
								$newname = $y.'_'.$m.'_'.$d.'_'.'suratmasuk_'.$_FILES['files']['name'][$i];
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
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'imgmenu')));
								}
							}
							
						}						
							$menu_name	= $this->input->post('menu_name');
							$desk   	= $this->input->post('desk');
							$price   	= htmlentities(strip_tags($this->input->post('price')));
							$cat   	= $this->input->post('cat');
							
							$waktu = date('Y-m-d H:i:s');
									$data = array(
										'menu_name'	=> $menu_name,
										'desk'		=> $desk,
										'price'		=> $price,
										'image'		=> $token,
										'cat'		=> $cat
		
									);
							ecurl('POST','inputmenu',http_build_query($data));
							insert_log('SURAT MASUK: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil Diinput.
								</div>'
								);
								redirect('ketatausahaan/suratmasuk/t');
							
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
								$newname = $y.'_'.$m.'_'.$d.'_'.'suratmasuk_'.$_FILES['files']['name'][$i];
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
						redirect('ketatausahaan/suratmasuk/e/'.$id_surat);
						
					}
					// Edit Surat Masuk Submit
					if (isset($_POST['btnupdate'])) {
						$idmenu   	= $this->input->post('idmenu');
						$menu_name	= $this->input->post('menu_name');
						$desk   	= $this->input->post('desk');
						$price   	= htmlentities(strip_tags($this->input->post('price')));
						$cat   	= $this->input->post('cat');
						
						$data = array();
						$data['nomor_surat'] = $no_surat;
						$data['menu_name'] = $menu_name;
						$data['desk'] = $desk;
						$data['price'] = $price;
						$data['cat'] = $cat;
												
						ecurl('PUT','updatemenu/'.$idmenu,http_build_query($data));
						insert_log('UBAH MENU: Edit ID '.$idmenu.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil diUpdate.
								</div>'
						);
						redirect('ketatausahaan/suratmasuk/e/'.$idmenu);
					}
					// Add Disposisi Submit
					if (isset($_POST['addbtndisp'])) {
						$data = array();
						$data['disposisi_pelaksana'] = htmlentities(strip_tags($this->input->post('pelaksana_disposisi')));
						$data['disposisi_perintah'] = $this->input->post('perintah_disposisi');
						$data['disposisi_dikirim'] = date('Y-m-d H:i:s');
						
						ecurl('PUT','suratmasuk/'.$id,http_build_query($data));
						insert_log('SURAT MASUK: Tambah Disposisi ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Disposisi berhasil dikirim.
								</div>'
						);
						redirect('ketatausahaan/suratmasuk');
						
					}

	}
	
	// Fungsi surat keluar JSON
    public function suratkeluar_json() {
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		/* $data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		); */
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','suratkeluar?='.$search['value'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// Surat Keluar
	public function suratkeluar($aksi='', $id=''){
		$userData = $this->session->userdata();
			$data['userData'] = $userData;
			$data['suratkeluar'] = json_decode(ecurl('GET','suratkeluar'))->data;

				if ($aksi == 't') {
					$p = "sk_tambah";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Tambah Surat";
				}
				elseif ($aksi == 'e') {
					$p = "sk_edit";
					$data['query'] = json_decode(ecurl('GET','suratkeluar/'.$id))->data;
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Edit Surat Keluar";
				}
				elseif ($aksi == 'd') {
					$p = "sk_detail";
					$data['query'] = json_decode(ecurl('GET','suratkeluar/'.$id))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['judul_web'] 	  = "Detail Surat Keluar";
					if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','suratkeluar/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
						redirect('ketatausahaan/suratkeluar/d/'.$id);
					}
				}
				elseif ($aksi == 'h') {
					$surat = json_decode(ecurl('GET','suratkeluar/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Surat Keluar";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					if(!empty($lampiran)) {
						foreach ($lampiran as $baris) {
							unlink('lampiran/'.$baris->nama_berkas);
						}
					}
					ecurl('DELETE','lampiran/'.$surat->lampiran);
					insert_log('SURAT MASUK: Delete ID: '.$id.'');
					ecurl('DELETE','suratkeluar/'.$id);
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Surat masuk berhasil dihapus.
						</div>'
							);					

					redirect('ketatausahaan/suratkeluar');
				}elseif ($aksi == 'del') {
					//die(print_r($id));
					$_expid = explode("_",$id);
					$id = $_expid['0'];
					$idpage = $_expid['1'];
					$surat = json_decode(ecurl('GET','lampirandetil/'.$id))->data;
					//die(print_r($surat->id));
					$data['judul_web'] 	  = "Hapus Surat Keluar";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					unlink('lampiran/'.$surat->nama_berkas);
					//die(print_r($surat->id));
					ecurl('DELETE','lampiranfile/'.$surat->id);
					insert_log('LAMPIRAN SURAT KELUAR: Delete ID: '.$id.'');
					$this->session->set_flashdata('msg',
						'<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Lampiran berhasil dihapus.
						</div>'
							);

					redirect('ketatausahaan/suratkeluar/e/'.$idpage);
				}else{
					$p = "sk";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Surat Keluar";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("ketatausahaan/pemrosesan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					if (isset($_POST['btnsimpansk'])) {
						
						$_token= date('Y-m-d H:i');
						$token = md5($_token.''.rand());
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
								$newname = $y.'_'.$m.'_'.$d.'_'.'suratkeluar_'.$_FILES['files']['name'][$i];
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
ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'suratkeluar')));
								}
							}
							
						}
							$waktu 			= date('Y-m-d H:i:s');
							$no_surat   	= $this->input->post('no_surat');
							$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
							$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
							$ringkasan   	= htmlentities(strip_tags($this->input->post('ringkasan')));
							$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
							$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe')));
							$jenis   	 	= htmlentities(strip_tags($this->input->post('jenis')));
							$tglsurat   	= date("Y-m-d", strtotime($this->input->post('tgl_no_asal')));
									$data = array(
										'nomor_surat'		=> $no_surat,
										'tgl_dikirim'		=> $waktu,
										'tgl_surat'			=> $tglsurat,
										'id_jenis_surat'	=> $jenis,
										'id_kode_surat'		=> $kode,
										'id_tipe_surat'		=> $tipe,
										'pengirim'			=> $userData['id_user'],
										'penerima'			=> $penerima,
										'perihal'			=> $perihal,
										'isi_ringkas'		=> $ringkasan,
										'lampiran'			=> $token
		
									);
							ecurl('POST','suratkeluar',http_build_query($data));
							insert_log('SURAT KELUAR: Tambah');
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat Keluar berhasil diinput.
								</div>'
							);
							redirect('ketatausahaan/suratkeluar/t');
							
							
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
								$newname = $y.'_'.$m.'_'.$d.'_'.'suratkeluar_'.$_FILES['files']['name'][$i];
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
	#ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload)));
	ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token,'tgl'=>$d,'bln'=>$m,'thn'=>$y,'tgl_upload'=>$tgl_upload,'jenis'=>'suratkeluar')));
									insert_log('SURAT KELUAR: Edit Lampiran ID '.$id.'');
								}
							}
							
						}
						redirect('ketatausahaan/suratkeluar/e/'.$id_surat);
						
					}
					
					if (isset($_POST['btnupdate'])) {
						$id_surat   	= $this->input->post('id');
						$no_surat   	= $this->input->post('no_surat');
						$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
						$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
						$ringkasan   	= htmlentities(strip_tags($this->input->post('ringkasan')));
						$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
						$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe')));
						$jenis   	 	= htmlentities(strip_tags($this->input->post('jenis')));
						$tglsurat   	= date("Y-m-d", strtotime($this->input->post('tgl_no_asal')));
						
						$data = array();
						$data['nomor_surat'] = $no_surat;
						$data['tgl_surat'] = $tglsurat;
						$data['id_jenis_surat'] = $jenis;
						$data['id_kode_surat'] = $kode;
						$data['id_tipe_surat'] = $tipe;
						$data['penerima'] = $penerima;
						$data['perihal'] = $perihal;
						$data['isi_ringkas'] = $ringkasan;
						
						ecurl('PUT','suratkeluar/'.$id_surat,http_build_query($data));
						insert_log('SURAT KELUAR: Edit surat keluar ID '.$id.'');
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat Keluar berhasil diUpdate.
								</div>'
							);
							
						redirect('ketatausahaan/suratkeluar/e/'.$id_surat);
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
	
	public function akses($aksi='', $id=''){
		$userData = $this->session->userdata();		
			$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				#$data['suratmasuk'] = json_decode(ecurl('GET','suratmasuk'))->data;
				#die(print_r($data['suratmasuk']));
			}
			else {
				$data['suratmasuk'] = json_decode(ecurl('GET','suratmasuk/userid/'.$userData['id_user']))->data;
			}
				if ($aksi == 't') {
					$p = "sm_tambah";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Tambah Surat";
				}
				elseif ($aksi == 'e') {
					$p = "sm_edit";
					$data['query'] = json_decode(ecurl('GET','suratmasukdetil/'.$id))->data;
					if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					}
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Edit Surat Masuk";
					
				}
				elseif ($aksi == 'd') {
					$p = "sm_detail";
					$data['query'] = json_decode(ecurl('GET','suratmasukdetil/'.$id))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['judul_web'] 	  = "Detail Surat Masuk";
					if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','suratmasuk/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
						redirect('ketatausahaan/suratmasuk/d/'.$id);
					}
				}
				elseif ($aksi == 'h') {
					$surat = json_decode(ecurl('GET','suratmasuk/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Surat Masuk";
					$lampiran = json_decode(ecurl('GET','lampiran/'.$surat->lampiran))->data;
					if(!empty($lampiran)) {
						foreach ($lampiran as $baris) {
							unlink('lampiran/'.$baris->nama_berkas);
						}
					}
					ecurl('DELETE','lampiran/'.$surat->lampiran);
					insert_log('SURAT MASUK: Delete ID: '.$id.'');
					ecurl('DELETE','suratmasuk/'.$id);
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Surat masuk berhasil dihapus.
						</div>'
							);
					

					redirect('ketatausahaan/suratmasuk');
				}else{
					$p = "akses";
					$data['pengguna'] 	= json_decode(ecurl('GET','penerima'))->data;
					$data['judul_web'] 	= "Hak Akses";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("ketatausahaan/akses/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah Surat Masuk Submit
					if (isset($_POST['addsuratmasuk'])) {
					
						
						$config['upload_path'] = './lampiran/';
						$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
						
						$this->upload->initialize($config);
						$this->load->library('upload', $config);
					

						if($this->upload->do_upload('userfile')){
							date_default_timezone_set('Asia/Jakarta');
							$waktu = date('Y-m-d H:i:s');
							$tgl 	 = date('d-m-Y');
							$token = md5("$waktu");
							$nama   = $this->upload->data('file_name');
							$ukuran = $this->upload->data('file_size');
							ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$nama,'ukuran'=>$ukuran,'token_lampiran'=>"$token")));
						}
						
							$no_surat   	= $this->input->post('no_surat');
							$agenda   	 	= $this->input->post('agenda');
							$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
							$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
							$ringkasan   	= htmlentities(strip_tags($this->input->post('ringkasan')));
							$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
							$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe')));
							$jenis   	 	= htmlentities(strip_tags($this->input->post('jenis')));
							$tglsurat   	= date("Y-m-d", strtotime($this->input->post('tgl_no_asal')));
							$surateksternal = $this->input->post('surat_eksternal');
									$data = array(
										'nomor_surat'		=> $no_surat,
										'id_nomor_agenda'	=> $agenda,
										'tgl_dikirim'		=> $waktu,
										'tgl_surat'			=> $tglsurat,
										'id_jenis_surat'	=> $jenis,
										'id_kode_surat'		=> $kode,
										'id_tipe_surat'		=> $tipe,
										'pengirim'			=> $userData['id_user'],
										'penerima'			=> $penerima,
										'perihal'			=> $perihal,
										'isi_ringkas'		=> $ringkasan,
										'lampiran'			=> $token,
										'surat_eksternal'	=> $surateksternal
		
									);
							ecurl('POST','suratmasuk',http_build_query($data));
							insert_log('SURAT MASUK: Tambah');
							
					}
					// Edit Lampiran Submit
					if (isset($_POST['editsuratmasuk'])) {
						
								$config['upload_path'] = './lampiran/';
								$config['allowed_types'] =  '*'; //'gif|jpg|png|jpeg';
								
								$this->upload->initialize($config);
								$this->load->library('upload', $config);
								
								if($this->upload->do_upload('userfile')){
									date_default_timezone_set('Asia/Jakarta');
									$waktu = date('Y-m-d H:i:s');
									$tgl 	 = date('d-m-Y');
									$token = md5("$waktu");
									$nama   = $this->upload->data('file_name');
									$ukuran = $this->upload->data('file_size');
									ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$nama,'ukuran'=>$ukuran,'token_lampiran'=>"$token")));
								}
								
						$id_surat   	= $this->input->post('id');
						$data = array();
						$data['id_surat'] = $id_surat;
						$data['lampiran'] = $token;
					
						ecurl('PUT','suratmasuk/'.$id_surat,http_build_query($data));
						insert_log('SURAT MASUK: Edit Lampiran ID '.$id.'');
					}
					// Edit Surat Masuk Submit
					if (isset($_POST['btnupdate'])) {
						$id_surat   	= $this->input->post('id');
						$no_surat   	= $this->input->post('no_surat');
						$agenda   	 	= $this->input->post('agenda');
						$penerima   	= htmlentities(strip_tags($this->input->post('hidden_penerima')));
						$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
						$ringkasan   	= htmlentities(strip_tags($this->input->post('ringkasan')));
						$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
						$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe')));
						$jenis   	 	= htmlentities(strip_tags($this->input->post('jenis')));
						$tglsurat   	= date("Y-m-d", strtotime($this->input->post('tgl_no_asal')));
						
						$data = array();
						$data['nomor_surat'] = $no_surat;
						$data['id_nomor_agenda'] = $agenda;
						$data['tgl_surat'] = $tglsurat;
						$data['id_jenis_surat'] = $jenis;
						$data['id_kode_surat'] = $kode;
						$data['id_tipe_surat'] = $tipe;
						$data['penerima'] = $penerima;
						$data['perihal'] = $perihal;
						$data['isi_ringkas'] = $ringkasan;
						
						ecurl('PUT','suratmasuk/'.$id_surat,http_build_query($data));
						insert_log('SURAT MASUK: Edit ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil diUpdate.
								</div>'
						);
						redirect('ketatausahaan/suratmasuk/e/'.$id_surat);
					}
					// Add Disposisi Submit
					if (isset($_POST['addbtndisp'])) {
						$data = array();
						$data['disposisi_pelaksana'] = htmlentities(strip_tags($this->input->post('pelaksana_disposisi')));
						$data['disposisi_perintah'] = $this->input->post('perintah_disposisi');
						$data['disposisi_dikirim'] = date('Y-m-d H:i:s');
						
						ecurl('PUT','suratmasuk/'.$id,http_build_query($data));
						insert_log('SURAT MASUK: Tambah Disposisi ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Disposisi berhasil dikirim.
								</div>'
						);
						redirect('ketatausahaan/suratmasuk');
						
					}

	}
	
	
	// Kearsipan
	public function arsip($aksi='', $id=''){
		$userData = $this->session->userdata();
		//$data['getmenu'] = json_decode(ecurl('GET','menutes'))->data;
			$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				
			}
			else {
				$data['suratmasuk'] = json_decode(ecurl('GET','suratmasuk/userid/'.$userData['id_user']))->data;
			}
				if ($aksi == 'd') {
					
					#die(print_r($id));
					//jenis surat
					$data['jenis'] = json_decode(ecurl('GET','getjenissurat/'.$id))->data;					
					$data['query'] = json_decode(ecurl('GET','dokumenlampirandetil/'.$id))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					
					
					if ($data['jenis']->jenis == 'suratmasuk')
					{
						$data['judul_web'] 	  = "Detail Surat Masuk";
						$p = "arsip_detail";
					
					} else if ($data['jenis']->jenis == 'suratkeluar')
					{
						$data['judul_web'] 	  = "Detail Surat Masuk";
						$p = "sk_detail";
					}
					
					
					
					//die(print_r($data['query']->penerima));
					/* if ($data['query']->penerima == $userData['id_user'] AND $data['query']->tgl_diterima == NULL) {
						ecurl('PUT','suratmasuk/'.$id,http_build_query(array('tgl_diterima'=>date('Y-m-d H:i:s'))));
						redirect('ketatausahaan/suratmasuk/d/'.$id);
					} */
				}else{
					$p = "arsip";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] = "Dokumen Administrasi";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("ketatausahaan/pemrosesan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah Surat Masuk Submit
					if (isset($_POST['btnsimpan'])) {
						$_token= date('Y-m-d H:i');
						$token = md5($_token.''.rand());
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
								$config['file_name'] = $_FILES['files']['name'][$i];
									
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
									ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token)));
								}
							}
							
						}						
							$no_surat   	= $this->input->post('no_surat');
							$agenda   	 	= $this->input->post('agenda');
							$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
							$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
							$ringkasan   	= htmlentities(strip_tags($this->input->post('ringkasan')));
							$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
							$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe')));
							$jenis   	 	= htmlentities(strip_tags($this->input->post('jenis')));
							$tglsurat   	= date("Y-m-d", strtotime($this->input->post('tgl_no_asal')));
							$surateksternal = $this->input->post('surat_eksternal');
							$waktu = date('Y-m-d H:i:s');
									$data = array(
										'nomor_surat'		=> $no_surat,
										'id_nomor_agenda'	=> $agenda,
										'tgl_dikirim'		=> $waktu,
										'tgl_surat'			=> $tglsurat,
										'id_jenis_surat'	=> $jenis,
										'id_kode_surat'		=> $kode,
										'id_tipe_surat'		=> $tipe,
										'pengirim'			=> $userData['id_user'],
										'penerima'			=> $penerima,
										'perihal'			=> $perihal,
										'isi_ringkas'		=> $ringkasan,
										'lampiran'			=> $token,
										'surat_eksternal'	=> $surateksternal
		
									);
							ecurl('POST','suratmasuk',http_build_query($data));
							insert_log('SURAT MASUK: Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil Diinput.
								</div>'
								);
								redirect('ketatausahaan/suratmasuk/t');
							
					}
					// Edit Lampiran Submit
					if (isset($_POST['btnupdatelampiran'])) {
						$id_surat   	= $this->input->post('id');
						$token = $this->input->post('tokenlampiran');
			
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
								$config['file_name'] = $_FILES['files']['name'][$i];
									
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
									ecurl('POST','lampiran',http_build_query(array('nama_berkas'=>$filename,'ukuran'=>$ukuran,'token_lampiran'=>$token)));
									insert_log('SURAT MASUK: Edit Lampiran ID '.$id.'');
								}
							}
							
						}
						redirect('ketatausahaan/suratmasuk/e/'.$id_surat);
						
					}
					// Edit Surat Masuk Submit
					if (isset($_POST['btnupdate'])) {
						$id_surat   	= $this->input->post('id');
						$no_surat   	= $this->input->post('no_surat');
						$agenda   	 	= $this->input->post('agenda');
						$penerima   	= htmlentities(strip_tags($this->input->post('hidden_penerima')));
						$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
						$ringkasan   	= htmlentities(strip_tags($this->input->post('ringkasan')));
						$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
						$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe')));
						$jenis   	 	= htmlentities(strip_tags($this->input->post('jenis')));
						$tglsurat   	= date("Y-m-d", strtotime($this->input->post('tgl_no_asal')));
						
						$data = array();
						$data['nomor_surat'] = $no_surat;
						$data['id_nomor_agenda'] = $agenda;
						$data['tgl_surat'] = $tglsurat;
						$data['id_jenis_surat'] = $jenis;
						$data['id_kode_surat'] = $kode;
						$data['id_tipe_surat'] = $tipe;
						$data['penerima'] = $penerima;
						$data['perihal'] = $perihal;
						$data['isi_ringkas'] = $ringkasan;
						
						ecurl('PUT','suratmasuk/'.$id_surat,http_build_query($data));
						insert_log('SURAT MASUK: Edit ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil diUpdate.
								</div>'
						);
						redirect('ketatausahaan/suratmasuk/e/'.$id_surat);
					}
					// Add Disposisi Submit
					if (isset($_POST['addbtndisp'])) {
						$data = array();
						$data['disposisi_pelaksana'] = htmlentities(strip_tags($this->input->post('pelaksana_disposisi')));
						$data['disposisi_perintah'] = $this->input->post('perintah_disposisi');
						$data['disposisi_dikirim'] = date('Y-m-d H:i:s');
						
						ecurl('PUT','suratmasuk/'.$id,http_build_query($data));
						insert_log('SURAT MASUK: Tambah Disposisi ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Disposisi berhasil dikirim.
								</div>'
						);
						redirect('ketatausahaan/suratmasuk');
						
					}
	}
	
	public function arsip_json() {
		
		header('Content-Type: application/json');
		$search = $this->input->get('search');
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		/* $data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		); */
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','arsip?='.$search['value'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);
		echo json_encode($result);
    }
	
	public function imagearchives_json() {
		
		header('Content-Type: application/json');
		
		$tgl_start = $this->input->get('tgl_start');
		$tgl_end = $this->input->get('tgl_end');
		$jenis = $this->input->get('jenis');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		/* $data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		); */
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','imagearchives?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&jenis='.$jenis.'&limit='.$limit.'&start='.$start),true);
		#var_dump($result);
		echo json_encode($result);
    }
	
	
	public function search_imagearchives_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$tgl_start = $pdata['tgl_start'];	
		$tgl_end = $pdata['tgl_end'];		
		$jenis = $pdata['jenis']; 
		$limit = $pdata['length'];
		$start = $pdata['start'];
		
		//echo $search.'<>'.$searchtext;		 
		$result = json_decode(ecurl('GET','imagearchives?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&jenis='.$jenis.'&limit='.$limit.'&start='.$start),true);			
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
	
	public function search_suratmasuk_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$id_user = $pdata['id_user'];
		$tgl_start = $pdata['tgl_start'];
		$tgl_end = $pdata['tgl_end'];
		$no_surat = $pdata['no_surat'];
		$agenda = $pdata['agenda'];
		$kode = $pdata['kode'];
		$tipe = $pdata['tipe'];
		$jenis = $pdata['jenis'];
		$penerima = $pdata['penerima'];
		$surat_eksternal = $pdata['surat_eksternal'];
		
		$limit = $pdata['length'];
		$start = $pdata['start'];
		
		
		
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
					
				$result = json_decode(ecurl('GET','searchsuratmasuk?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&no_surat='.$no_surat.'&agenda='.$agenda.'&kode='.$kode.'&tipe='.$tipe.'&jenis='.$jenis.'&penerima='.$penerima.'&surat_eksternal='.$surat_eksternal.'&limit='.$limit.'&start='.$start),true);
				
			}
			else {
				#$result = json_decode(ecurl('GET','suratmasuk?userid='.$userData['id_user'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
				
				$result = json_decode(ecurl('GET','searchsuratmasuk?id_user='.$id_user.'&tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&no_surat='.$no_surat.'&agenda='.$agenda.'&kode='.$kode.'&tipe='.$tipe.'&jenis='.$jenis.'&penerima='.$penerima.'&surat_eksternal='.$surat_eksternal.'&limit='.$limit.'&start='.$start),true);
				
			}
			
			
		#$result = json_decode(ecurl('GET','searchsuratmasuk?id_user='.$id_user.'&tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&no_surat='.$no_surat.'&agenda='.$agenda.'&kode='.$kode.'&tipe='.$tipe.'&jenis='.$jenis.'&penerima='.$penerima.'&surat_eksternal='.$surat_eksternal.'&limit='.$limit.'&start='.$start),true);
		#$result = json_decode(ecurl('GET','searchsuratmasuk?userid='.$id_user.'&no_surat='.$no_surat.'&limit='.$limit.'&start='.$start),true);			
		echo json_encode($result);
    }
	
	public function search_suratkeluar_json() {
		
		header('Content-Type: application/json');		
		$pdata = $this->input->post();
		$id_user = $pdata['id_user'];
		$tgl_start = $pdata['tgl_start'];
		$tgl_end = $pdata['tgl_end'];
		$no_surat = $pdata['no_surat'];
		$kode = $pdata['kode'];
		$tipe = $pdata['tipe'];
		$jenis = $pdata['jenis'];
		$penerima = $pdata['penerima'];
		
		$limit = $pdata['length'];
		$start = $pdata['start'];
		#var_dump('>>'.$no_surat);
		//echo $search.'<>'.$searchtext;		 
		$result = json_decode(ecurl('GET','searchsuratkeluar?id_user='.$id_user.'&tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&no_surat='.$no_surat.'&kode='.$kode.'&tipe='.$tipe.'&jenis='.$jenis.'&penerima='.$penerima.'&limit='.$limit.'&start='.$start),true);
		echo json_encode($result);
    }
	
	public function search_disposisi_json() {
		
		header('Content-Type: application/json');
		
		$pdata = $this->input->post();
		$id_user = $pdata['id_user'];
		$tgl_start = $pdata['tgl_start'];
		$tgl_end = $pdata['tgl_end'];
		$no_surat = $pdata['no_surat'];
		$agenda = $pdata['agenda'];
		$kode = $pdata['kode'];
		$tipe = $pdata['tipe'];
		$jenis = $pdata['jenis'];
		$penerima = $pdata['penerima'];
		$surat_eksternal = $pdata['surat_eksternal'];
		
		$limit = $pdata['length'];
		$start = $pdata['start'];
		#var_dump('>>'.$no_surat);
		//echo $search.'<>'.$searchtext;		 
		$result = json_decode(ecurl('GET','searchsuratdisposisi?id_user='.$id_user.'&tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&no_surat='.$no_surat.'&agenda='.$agenda.'&kode='.$kode.'&tipe='.$tipe.'&jenis='.$jenis.'&penerima='.$penerima.'&surat_eksternal='.$surat_eksternal.'&limit='.$limit.'&start='.$start),true);
		echo json_encode($result);
    }
	
	
	// Surat Masuk
	public function advanced_search(){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
					$p = "adv_search";
					$data['penerima'] = json_decode(ecurl('GET','penerima'))->data;
					$data['kodesurat'] = json_decode(ecurl('GET','kodesurat'))->data;
					$data['tipesurat'] = json_decode(ecurl('GET','tipesurat'))->data;
					$data['jenissurat'] = json_decode(ecurl('GET','jenissurat'))->data;
					$data['judul_web'] 	  = "Advanced Search";
				
					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("ketatausahaan/pemrosesan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
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
						
						redirect('ketatausahaan/user');
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
										redirect('ketatausahaan/user');									
					} else {
						$p = "user";
						$data['judul_web'] 	  = "User";						
					}

						$this->load->view('ketatausahaan/header', $data);
						$this->load->view("ketatausahaan/master/$p", $data);
						$this->load->view('ketatausahaan/footer');

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

										redirect('ketatausahaan/user/t');
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
										redirect('ketatausahaan/user/e/'.$id);
						}
	}
	
	
	// Kearsipan
	public function dokumen_arsip($aksi='', $id=''){
		$userData = $this->session->userdata();
		//$data['getmenu'] = json_decode(ecurl('GET','menutes'))->data;
			$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				
			}
			else {
				$data['suratmasuk'] = json_decode(ecurl('GET','suratmasuk/userid/'.$userData['id_user']))->data;
			}
				if ($aksi == 't') {
					$p = "dokumen_arsip_tambah";
					$data['ruang'] = json_decode(ecurl('GET','ruang'))->data;
					$data['rak'] = json_decode(ecurl('GET','rak'))->data;
					$data['judul_web'] 	  = "Tambah Arsip";
				} elseif ($aksi == 'e') {
					$p = "dokumen_arsip_edit";
					//die(print_r($id));
					$data['query'] = json_decode(ecurl('GET','dokumenarsipedit/'.$id))->data;
					$data['ruang'] = json_decode(ecurl('GET','ruang'))->data;
					$data['rak'] = json_decode(ecurl('GET','rak'))->data;
					$data['judul_web'] 	  = "Edit Arsip";
				} elseif ($aksi == 'h') {
						$data['judul_web'] 	  = "Hapus Arsip";
						// Cek Relasi Jenis Surat
						$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_arsip/tbl_arsip'));
						if($cekrelasi->status == 'no data') {
							insert_log('JENIS SURAT: Delete ID: '.$id.'');
							ecurl('DELETE','jenissurat/'.$id);
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Jenis Surat berhasil dihapus.
									</div>'
							);
						}
						else {
							$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Jenis Surat masih dipakai.
									</div>'
							);
						}
						redirect('ketatausahaan/jenissurat');
				}else{
					$p = "dokumen_arsip";
					$data['ruang'] = json_decode(ecurl('GET','ruang'))->data;
					$data['rak'] = json_decode(ecurl('GET','rak'))->data;
					$data['judul_web'] = "Dokumen Arsip";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("ketatausahaan/pemrosesan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah arsip Submit
					if (isset($_POST['btnsimpanarsip'])) {
												
							$kode_arsip   	= $this->input->post('kode_arsip');
							$nama_arsip   	= $this->input->post('nama_arsip');
							$deskripsi   	= htmlentities(strip_tags($this->input->post('deskripsi')));
							$id_ruang   	= htmlentities(strip_tags($this->input->post('id_ruang')));
							$id_rak   	 	= htmlentities(strip_tags($this->input->post('id_rak')));
							$tanggal_arsip  = date("Y-m-d", strtotime($this->input->post('tanggal_arsip')));
							
							$waktu = date('Y-m-d H:i:s');
									$data = array(
										'kode_arsip'	=> $kode_arsip,
										'nama_arsip'	=> $nama_arsip,
										'deskripsi'		=> $deskripsi,
										'tanggal_arsip'	=> $tanggal_arsip,
										'id_ruang'	    => $id_ruang,
										'id_rak'		=> $id_rak		
									);
							ecurl('POST','dokumen_arsip',http_build_query($data));
							insert_log('DOKUMEN ARSIP : Tambah');
							$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Dokumen Arsip berhasil Diinput.
								</div>'
								);
								redirect('ketatausahaan/dokumen_arsip/t');
							
					}
					// Edit dokumen arsip Submit
					if (isset($_POST['btnupdate'])) {
						$id_arsip   	= $this->input->post('id');
						$kode_arsip   	= $this->input->post('kode_arsip');
						$nama_arsip   	= $this->input->post('nama_arsip');
						$deskripsi   	= htmlentities(strip_tags($this->input->post('deskripsi')));
						$id_ruang   	= htmlentities(strip_tags($this->input->post('id_ruang')));
						$id_rak   	 	= htmlentities(strip_tags($this->input->post('id_rak')));
						$tanggal_arsip  = date("Y-m-d", strtotime($this->input->post('tanggal_arsip')));
						
						$data = array();
						$data['kode_arsip'] = $kode_arsip;
						$data['nama_arsip'] = $nama_arsip;
						$data['deskripsi'] = $deskripsi;
						$data['id_ruang'] = $id_ruang;
						$data['id_rak'] = $id_rak;
						$data['tanggal_arsip'] = $tanggal_arsip;
												
						ecurl('PUT','dokumen_arsip/'.$id_arsip,http_build_query($data));
						insert_log('DOKUMEN ARSIP: Edit ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong>Dokumen Arsip berhasil diUpdate.
								</div>'
						);
						redirect('ketatausahaan/dokumen_arsip/e/'.$id_arsip);
					}
	}
	
	public function dokumenarsip_json() {
		
		header('Content-Type: application/json');
		
		$tgl_start = $this->input->get('tgl_start');
		$tgl_end = $this->input->get('tgl_end');
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		/* $data = array(
			'searchtext' => $searchtext,
			'limit' => $limit,
			'start' => $start
		); */
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','dokumenarsip?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&limit='.$limit.'&start='.$start),true);
		#var_dump($result);
		echo json_encode($result);
    }
	
	public function search_dokumenarsip_json() {
		
		header('Content-Type: application/json');
				
		$pdata = $this->input->post();
		
		$tgl_start = $pdata['tgl_start'];
		$tgl_end = $pdata['tgl_end'];
		$nama_arsip = $pdata['nama_arsip'];
		$id_ruang = $pdata['id_ruang'];
		$id_rak = $pdata['id_rak'];
		$limit = $pdata['length'];
		$start = $pdata['start'];
				
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','dokumenarsip?tgl_start='.$tgl_start.'&tgl_end='.$tgl_end.'&nama_arsip='.$nama_arsip.'&id_ruang='.$id_ruang.'&id_rak='.$id_rak.'&limit='.$limit.'&start='.$start),true);
		#var_dump($result);
		echo json_encode($result);
    }

}