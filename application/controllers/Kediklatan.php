<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kediklatan extends CI_Controller {
	
 public function __construct(){
    parent::__construct();
    //$this->load->helper('notif_helper');
	$this->load->helper('tanggal_helper');
	$this->load->helper('config_helper');
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
		$this->load->view('ketatausahaan/header', $data);
		$this->load->view('ketatausahaan/profile', $data);
		$this->load->view('ketatausahaan/footer', $data);		


			if (isset($_POST['btnupdate'])) {


							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Profile berhasil disimpan.
								</div>'
							);
							redirect('ketatausahaan/profile');
			}


			if (isset($_POST['btnupdate2'])) {
				$password 	= htmlentities(strip_tags($this->input->post('password')));
				$password2 	= htmlentities(strip_tags($this->input->post('password2')));

				if ($password != $password2) {
						$this->session->set_flashdata('msg2',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Gagal!</strong> Password tidak cocok.
							</div>'
						);
				}else{
							$this->session->set_flashdata('msg2',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Password berhasil disimpan.
								</div>'
							);
				}
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
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Pengaturan Themes & Title berhasil disimpan.
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
							$config['upload_path'] = './assets/images/backgrounds/';
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
							$config['upload_path'] = FCPATH.'assets/images/favicon/';
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
							$config['upload_path'] = FCPATH.'assets/images/logo/';
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
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Pengaturan Background & Icons berhasil disimpan.
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
	
	// Fungsi JSON
    public function penyelenggara_json() {
		
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
		$result = json_decode(ecurl('GET','penyelenggara?search='.$search['value'].'&searchtext='.$searchtext.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// penyelenggara
	public function penyelenggara($aksi='', $id=''){
		$userData = $this->session->userdata();		
			$data['userData'] = $userData;
			#$data['penyelenggara'] = json_decode(ecurl('GET','penyelenggara'))->data;
				if ($aksi == 't') {
					$p = "penyelenggara_tambah";
					$data['judul_web'] 	  = "Tambah Penyelenggara";
				}
				elseif ($aksi == 'e') {
					$p = "penyelenggara_edit";
					$data['query'] = json_decode(ecurl('GET','penyelenggara/'.$id))->data;
					$data['judul_web'] 	  = "Edit Penyelenggara";
				}
				elseif ($aksi == 'h') {
					$data['judul_web'] 	  = "Hapus Penyelenggara";

					// Cek Relasi Penyelenggara
					$cekrelasi = json_decode(ecurl('GET','/cekrelasi/'.$id.'/id_penyelenggara/diklat_diklat'));
					if($cekrelasi->status == 'no data') {
						insert_log('DIKLAT: PENYELENGGARA: Delete ID: '.$id.'');
						ecurl('DELETE','/penyelenggara/'.$id);
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Penyelenggara berhasil dihapus.
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
									 <strong>Gagal!</strong> Penyelenggara masih dipakai di Diklat.
								</div>'
						);
					}

					redirect('kediklatan/penyelenggara');
				}else{
					$p = "list_penyelenggara";
					$data['judul_web'] 	  = "Data Penyelenggara";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah penyelenggara
					if (isset($_POST['btnsimpan'])) {
										$data = array(
											'penyelenggara'	 => htmlentities(strip_tags($this->input->post('nama_penyelenggara'))),
											'created'	 => date('Y-m-d H:m:s')
										);
										ecurl('POST','penyelenggara',http_build_query($data));
										insert_log('DIKLAT: TAMBAH PENYELENGGARA');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Penyelenggara berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/penyelenggara/t');
					}

					// Edit penyelenggara Submit
					if (isset($_POST['btnupdate'])) {

									$data = array(
										'penyelenggara'	 => htmlentities(strip_tags($this->input->post('nama_penyelenggara')))
									);
									ecurl('PUT','penyelenggara/'.$id,http_build_query($data));
									insert_log('DIKLAT: PENYELENGGARA: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Penyelenggara berhasil diupdate.
										</div>'
									);
									redirect('kediklatan/penyelenggara');
					}
	}
	
	// Fungsi JSON
    public function widyaiswara_json() {
		
		header('Content-Type: application/json');
		
		$limit = $this->input->get('length');
		$start = $this->input->get('start');
				
		$data = array(
			
			'limit' => $limit,
			'start' => $start
		);
		#var_dump('>>'.$searchtext);
		$result = json_decode(ecurl('GET','widyaiswara?limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
// Widyaiswara
	public function widyaiswara($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		//$data['widyaiswara'] = json_decode(ecurl('GET','widyaiswara'))->data;

				if ($aksi == 't') {
					$p = "widyaiswara_tambah";
					$data['pengguna'] = json_decode(ecurl('GET','pengguna'))->data;
					$data['judul_web'] 	  = "Tambah Widyaiswara";
				}
				elseif ($aksi == 'e') {
					$p = "widyaiswara_edit";
					$data['query'] = json_decode(ecurl('GET','widyaiswara/'.$id))->data;
					$data['pengguna'] = json_decode(ecurl('GET','pengguna'))->data;
					$data['judul_web'] 	  = "Edit Widyaiswara";
				}
				elseif ($aksi == 'h') {
					$data['judul_web'] 	  = "Hapus Widyaiswara";
					// Cek Relasi Widyaiswara
					$cekrelasi = json_decode(ecurl('GET','/cekrelasi/'.$id.'/id_widyaiswara/diklat_reg_modul'));
					#$cekrelasi = json_decode(ecurl('GET','/cekrelasi/'.$id.'/id/diklat_modul'));
					/* if($cekrelasi->status == 'no data') {
						insert_log('DIKLAT: WIDYAISWARA: Delete ID: '.$id.'');
						ecurl('DELETE','widyaiswara/'.$id);
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Widyaiswara berhasil dihapus.
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
									 <strong>Gagal!</strong> Widyaiswara masih dipakai di Diklat.
								</div>'
						);
					} */
					insert_log('DIKLAT: WIDYAISWARA: Delete ID: '.$id.'');
						ecurl('DELETE','widyaiswara/'.$id);
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Widyaiswara berhasil dihapus.
								</div>'
						);
					redirect('kediklatan/widyaiswara');
				}else{
					$p = "list_widyaiswara";
					$data['judul_web'] 	  = "Widyaiswara";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');

					if (isset($_POST['btnsimpan'])) {
						$widyaiswara   	 	= htmlentities(strip_tags($this->input->post('widyaiswara')));
						$id_user   			= htmlentities(strip_tags($this->input->post('id_user')));

										$data = array(
											'widyaiswara' => $widyaiswara,
											'id_user'	  => $id_user,
											'created'	  => date('Y-m-d H:m:s')
										);
										ecurl('POST','widyaiswara',http_build_query($data));
										insert_log('DIKLAT: TAMBAH WIDYAISWARA');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Widyaiswara berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/widyaiswara/t');
					}

					if (isset($_POST['btnupdate'])) {
							$widyaiswara   	 	= htmlentities(strip_tags($this->input->post('widyaiswara')));
							$id_user   			= htmlentities(strip_tags($this->input->post('id_user')));
									$data = array(
										'widyaiswara'	 => $widyaiswara,
										'id_user'	  => $id_user
									);
									ecurl('PUT','widyaiswara/'.$id,http_build_query($data));
									insert_log('DIKLAT: WIDYAISWARA: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Widyaiswara berhasil diupdate.
										</div>'
									);
									redirect('kediklatan/widyaiswara');
					}
}

// Tahun
	public function tahun($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		//$data['tahun'] = json_decode($this->curl->simple_get(restapi().'/tahun'));
		$data['tahun'] = json_decode(ecurl('GET','tahun'))->data;

				if ($aksi == 't') {
					$p = "tahun_tambah";
					$data['judul_web'] 	  = "Tambah Tahun";
				}
				elseif ($aksi == 'e') {
					$p = "tahun_edit";
					//$data['query'] = json_decode($this->curl->simple_get(restapi().'/tahun/'.$id));
					$data['query'] = json_decode(ecurl('GET','tahun/'.$id))->data;
					$data['judul_web'] 	  = "Edit Tahun";
				}
				elseif ($aksi == 'h') {
					$data['judul_web'] 	  = "Hapus Tahun";
					// Cek Relasi Tahun
					//$cekrelasi = json_decode($this->curl->simple_get(restapi().'/cekrelasi/'.$id.'/id_tahun/diklat_diklat'));
					$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_tahun/diklat_diklat'));
					if($cekrelasi->status == 'no data') {
						insert_log('DIKLAT: TAHUN: Delete ID: '.$id.'');
						//$this->curl->simple_delete(restapi().'/tahun/'.$id);
						ecurl('DELETE','tahun/'.$id);
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Tahun berhasil dihapus.
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
									 <strong>Gagal!</strong> Tahun masih dipakai di Diklat.
								</div>'
						);
					}
					redirect('kediklatan/tahun');
				}else{
					$p = "tahun";
					$data['judul_web'] 	  = "Tahun";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');

					if (isset($_POST['btnsimpan'])) {
						$nama_tahun   	 	= htmlentities(strip_tags($this->input->post('nama_tahun')));

										$data = array(
											'tahun'	 => $nama_tahun,
											'created'	 => date('Y-m-d H:m:s')
										);
										//$this->curl->simple_post(restapi().'/tahun',$data);
										ecurl('POST','tahun',http_build_query($data));
										insert_log('DIKLAT: TAMBAH TAHUN');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Tahun berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/tahun/t');
					}

					if (isset($_POST['btnupdate'])) {
							$nama_tahun   	 	= htmlentities(strip_tags($this->input->post('nama_tahun')));

									$data = array(
										'tahun'	 => $nama_tahun
									);
									//$this->curl->simple_put(restapi().'/tahun/'.$id,$data);
									ecurl('PUT','tahun/'.$id,http_build_query($data));
									insert_log('DIKLAT: TAHUN: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Tahun berhasil diupdate.
										</div>'
									);
									redirect('kediklatan/tahun');
					}
	}
	
	
	// Angkatan
public function angkatan($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		$data['angkatan'] = json_decode(ecurl('GET','angkatan'))->data;

				if ($aksi == 't') {
					$p = "angkatan_tambah";
					$data['judul_web'] 	  = "Tambah Tahun";
				}
				elseif ($aksi == 'e') {
					$p = "angkatan_edit";
					$data['query'] = json_decode(ecurl('GET','angkatan/'.$id))->data;
					$data['judul_web'] 	  = "Edit Angkatan";
				}
				elseif ($aksi == 'h') {
					$data['judul_web'] 	  = "Hapus Angkatan";
					// Cek Relasi Angkatan
					$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_angkatan/diklat_diklat'));
					if($cekrelasi->status == 'no data') {
						insert_log('DIKLAT: ANGKATAN: Delete ID: '.$id.'');
						ecurl('DELETE','angkatan/'.$id);
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Angkatan berhasil dihapus.
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
									 <strong>Gagal!</strong> Angkatan masih dipakai di Diklat.
								</div>'
						);
					}
					redirect('kediklatan/angkatan');
				}else{
					$p = "angkatan";
					$data['judul_web'] 	  = "Angkatan";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');

					if (isset($_POST['btnsimpan'])) {
						$nama_angkatan   	 	= htmlentities(strip_tags($this->input->post('nama_angkatan')));

										$data = array(
											'angkatan'	 => $nama_angkatan,
											'created'	 => date('Y-m-d H:m:s')
										);
										ecurl('POST','angkatan',http_build_query($data));
										insert_log('DIKLAT: TAMBAH ANGKATAN');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Angkatan berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/angkatan/t');
					}

					if (isset($_POST['btnupdate'])) {
							$nama_angkatan   	 	= htmlentities(strip_tags($this->input->post('nama_angkatan')));

									$data = array(
										'angkatan'	 => $nama_angkatan
									);
									ecurl('PUT','angkatan/'.$id,http_build_query($data));
									insert_log('DIKLAT: ANGKATAN: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Angkatan berhasil diupdate.
										</div>'
									);
									redirect('kediklatan/angkatan');
					}
}


	// Kelompok
	public function kelompok($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		$data['kelompok'] = json_decode(ecurl('GET','kelompok'))->data;

				if ($aksi == 't') {
					$p = "kelompok_tambah";
					$data['judul_web'] 	  = "Tambah Kelompok Diklat";
				}
				elseif ($aksi == 'e') {
					$p = "kelompok_edit";
					$data['query'] = json_decode(ecurl('GET','kelompok/'.$id))->data;
					$data['judul_web'] 	  = "Edit Kelompok Diklat";
				}
				elseif ($aksi == 'h') {
					$data['judul_web'] 	  = "Hapus Kelompok Diklat";
					// Cek Relasi Kelompok Diklat
					$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_kelompok/diklat_diklat'));
					if($cekrelasi->status == 'no data') {
						insert_log('DIKLAT: KELOMPOK DIKLAT: Delete ID: '.$id.'');
						ecurl('DELETE','kelompok/'.$id);
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Kelompok Diklat berhasil dihapus.
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
									 <strong>Gagal!</strong> Kelompok Diklat masih dipakai di Diklat.
								</div>'
						);
					}
					redirect('kediklatan/kelompok');
				}else{
					$p = "kelompok";
					$data['judul_web'] 	  = "Kelompok Diklat";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');

					if (isset($_POST['btnsimpan'])) {
						$nama_kelompok   	 	= htmlentities(strip_tags($this->input->post('nama_kelompok')));
						$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc_kelompok')));

										$data = array(
											'kelompok'	 => $nama_kelompok,
											'deskripsi'	 => $deskripsi,
											'created'	 => date('Y-m-d H:m:s')
										);
										ecurl('POST','kelompok',http_build_query($data));
										insert_log('DIKLAT: TAMBAH KELOMPOK');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Kelompok Diklat berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/kelompok/t');
					}

					if (isset($_POST['btnupdate'])) {
							$nama_kelompok   	 	= htmlentities(strip_tags($this->input->post('nama_kelompok')));
							$deskripsi   	 	= htmlentities(strip_tags($this->input->post('desc_kelompok')));

									$data = array(
										'kelompok'	 => $nama_kelompok,
										'deskripsi'	 => $deskripsi
									);
									ecurl('PUT','kelompok/'.$id,http_build_query($data));
									insert_log('DIKLAT: KELOMPOK: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Kelompok Diklat berhasil diupdate.
										</div>'
									);
									redirect('kediklatan/kelompok');
					}
}

// Master Diklat
public function masterdiklat($aksi='', $id=''){
		$userData = $this->session->userdata();
		$data['userData'] = $userData;
		$data['masterdiklat'] = json_decode(ecurl('GET','masterdiklat'))->data;

				if ($aksi == 't') {
					$p = "master_diklat_tambah";
					$data['judul_web'] 	  = "Tambah Master Diklat";
				}
				elseif ($aksi == 'e') {
					$p = "master_diklat_edit";
					$data['query'] = json_decode(ecurl('GET','masterdiklat/'.$id))->data;
					$data['judul_web'] 	  = "Edit Master Diklat";
				}
				elseif ($aksi == 'h') {
					$data['judul_web'] 	  = "Hapus Master Diklat";
					// Cek Relasi Master Diklat
					$cekrelasi = json_decode(ecurl('GET','cekrelasi/'.$id.'/id_master_diklat/diklat_diklat'));
					if($cekrelasi->status == 'no data') {
						insert_log('DIKLAT: MASTER DIKLAT: Delete ID: '.$id.'');
						ecurl('DELETE','/masterdiklat/'.$id);
						$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Master Diklat berhasil dihapus.
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
									 <strong>Gagal!</strong> Master Diklat masih dipakai di Diklat.
								</div>'
						);
					}
					redirect('kediklatan/masterdiklat');
				}else{
					$p = "master_diklat";
					$data['judul_web'] 	  = "Master Diklat";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');

					if (isset($_POST['btnsimpan'])) {
						$master   	 	= htmlentities(strip_tags($this->input->post('master')));

										$data = array(
											'master'	 => $master,
											'created'	 => date('Y-m-d H:m:s')
										);
										ecurl('POST','masterdiklat',http_build_query($data));
										insert_log('DIKLAT: TAMBAH MASTER DIKLAT');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Master Diklat berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/masterdiklat/t');
					}

					if (isset($_POST['btnupdate'])) {
							$master   	 	= htmlentities(strip_tags($this->input->post('master')));

									$data = array(
										'master'	 => $master
									);
									ecurl('PUT','masterdiklat/'.$id,http_build_query($data));
									insert_log('DIKLAT: MASTER DIKLAT: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Master Diklat berhasil diupdate.
										</div>'
									);
									redirect('kediklatan/masterdiklat');
					}
}

	// Fungsi peserta JSON
    public function peserta_json() {
		
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
		$result = json_decode(ecurl('GET','pesertadiklat?='.$search['value'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	// data registrasi peserta
	public function peserta($aksi='', $id=''){
		$userData = $this->session->userdata();		
			$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				$data['peserta'] = json_decode(ecurl('GET','pesertadiklat'))->data;
				#die(print_r($data['suratmasuk']));
			}
			else {
				$data['peserta'] = json_decode(ecurl('GET','pesertadiklat/id/'.$userData['id']))->data;
			}
				if ($aksi == 't') {
					$p = "peserta_diklat_tambah";
					$data['judul_web'] = "Tambah Peserta";					
					$data['pengguna'] = json_decode(ecurl('GET','pengguna'))->data;
					$data['ref_diklat'] = json_decode(ecurl('GET','ref_diklat'))->data;
					$data['ref_kewenangan'] = json_decode(ecurl('GET','ref_kewenangan'))->data;
					
				}
				elseif ($aksi == 'e') {
					$p = "peserta_diklat_edit";
					$data['query'] = json_decode(ecurl('GET','pesertadiklatedit/id/'.$id))->data;
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['pengguna'] = json_decode(ecurl('GET','pengguna'))->data;
					$data['ref_diklat'] = json_decode(ecurl('GET','ref_diklat'))->data;
					$data['ref_kewenangan'] = json_decode(ecurl('GET','ref_kewenangan'))->data;
					$data['judul_web'] 	  = "Edit Peserta";
					
				}
				elseif ($aksi == 's') {
					
					$this->load->model("ijazah_model");
					$this->load->model("peserta_model");
					/* if (!getAkses('create',$this->ijazah_model->getbase())){
						showMessage('No Akses','Tidak mempunyai akses menambah ijazah/sertifikat','info');						
						redirect($this->ijazah_model->getbase().$this->ijazah_model->getrefurl());					
					} */
					if (is_numeric($id)){
						$idsertfikat = $this->ijazah_model->generateIjazah($id);
						if ($idsertfikat){
							if ($this->peserta_model->updatesertifikatpeserta($id,$idsertfikat)){
								showMessage('Generate Sertifikat','Sertifikat sukses tergenerate dan sertifikat peserta terupdate','info');
							}else{
								showMessage('Generate Sertifikat','Sertifikat sukses tergenerate, sertifikat peserta gagal terupdate','info');
							}
						}else showMessage('Generate Sertifikat','Sertifikat gagal tergenerate','error');
					}else showMessage('Generate Sertifikat','Parameter generate sertifikat invalid','error');

					redirect($this->peserta_model->getbase().$this->peserta_model->getrefurl());
				
				}
				elseif ($aksi == 'h') {
					$diklat = json_decode(ecurl('GET','pesertadiklat/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Peserta Diklat";
					insert_log('PESERTA DIKLAT: Delete ID: '.$id.'');
					ecurl('DELETE','peserta_diklat/'.$id);
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Peserta diklat berhasil dihapus.
						</div>'
							);
					

					redirect('kediklatan/peserta');
				}else{
					$p = "peserta";
					$data['judul_web'] 	  = "Peserta Diklat";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah Surat Masuk Submit
					if (isset($_POST['btnsimpan'])) {	
							
							$id_user   	  = htmlentities(strip_tags($this->input->post('id_user')));
							$id_diklat    = htmlentities(strip_tags($this->input->post('id_diklat')));
							$id_groupuser = htmlentities(strip_tags($this->input->post('id_groupuser')));
				
									$data = array(
										'id_user'	   => $id_user,
										'id_diklat'	   => $id_diklat,
										'id_groupuser' => $id_groupuser
		
									);
							ecurl('POST','peserta_diklat',http_build_query($data));
							insert_log('TAMBAH PESERTA DIKLAT: Tambah');
							
					}
					// Edit Lampiran Submit
					if (isset($_POST['btnupdate'])) {
						$id 	= $this->input->post('idt');						
						$id_user   	  = htmlentities(strip_tags($this->input->post('id_user')));
						$id_diklat    = htmlentities(strip_tags($this->input->post('id_diklat')));
						$id_groupuser = htmlentities(strip_tags($this->input->post('id_groupuser')));
											
						$data = array();
						$data['id_user'] = $id_user;
						$data['id_diklat'] = $id_diklat;
						$data['id_groupuser'] = $id_groupuser;
								#die(print_r(ecurl('PUT','peserta_diklat/'.$id,http_build_query($data)).'<>'.$id));			
						ecurl('PUT','peserta_diklat/'.$id,http_build_query($data));
						insert_log('PESERTA DIKLAT: Edit ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Peserta Diklat berhasil diUpdate.
								</div>'
						);
						redirect('kediklatan/peserta/e/'.$id);
					}


	}
	
	// Fungsi peserta JSON
    public function regmodul_json() {		
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
		$result = json_decode(ecurl('GET','regmodul?='.$search['value'].'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&start='.$start),true);
		// var_dump($result);		
		echo json_encode($result);
    }
	
	public function regmodul($aksi='', $id=''){
		$userData = $this->session->userdata();		
			$data['userData'] = $userData;
			if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				//$data['peserta'] = json_decode(ecurl('GET','regmodul'))->data;
				#die(print_r($data['suratmasuk']));
			}
			else {
				$data['peserta'] = json_decode(ecurl('GET','regmodul/id/'.$userData['id']))->data;
			}
				if ($aksi == 't') {
					$p = "peserta_widyaiswara_tambah";
					$data['judul_web'] = "Tambah Peserta";					
					$data['ref_widyaiswara'] = json_decode(ecurl('GET','ref_widyaiswara'))->data;
					$data['ref_diklat'] = json_decode(ecurl('GET','ref_diklat'))->data;
					$data['ref_modul'] = json_decode(ecurl('GET','ref_modul'))->data;
					
				}
				elseif ($aksi == 'e') {
					$p = "peserta_widyaiswara_edit";
					$data['query'] = json_decode(ecurl('GET','regmoduledit/id/'.$id))->data;
					/* if ($data['query']->pengirim != $userData['id_user']) {
						redirect('404_content');
					} */
					$data['ref_widyaiswara'] = json_decode(ecurl('GET','ref_widyaiswara'))->data;
					$data['ref_diklat'] = json_decode(ecurl('GET','ref_diklat'))->data;
					$data['ref_modul'] = json_decode(ecurl('GET','ref_modul'))->data;
					$data['judul_web'] 	  = "Edit Peserta";
					
				}
				elseif ($aksi == 's') {
					
					$this->load->model("ijazah_model");
					$this->load->model("peserta_model");
					/* if (!getAkses('create',$this->ijazah_model->getbase())){
						showMessage('No Akses','Tidak mempunyai akses menambah ijazah/sertifikat','info');						
						redirect($this->ijazah_model->getbase().$this->ijazah_model->getrefurl());					
					} */
					if (is_numeric($id)){
						$idsertfikat = $this->ijazah_model->generateIjazah($id);
						if ($idsertfikat){
							if ($this->peserta_model->updatesertifikatpeserta($id,$idsertfikat)){
								showMessage('Generate Sertifikat','Sertifikat sukses tergenerate dan sertifikat peserta terupdate','info');
							}else{
								showMessage('Generate Sertifikat','Sertifikat sukses tergenerate, sertifikat peserta gagal terupdate','info');
							}
						}else showMessage('Generate Sertifikat','Sertifikat gagal tergenerate','error');
					}else showMessage('Generate Sertifikat','Parameter generate sertifikat invalid','error');

					redirect($this->peserta_model->getbase().$this->peserta_model->getrefurl());
				
				}
				elseif ($aksi == 'h') {
					$diklat = json_decode(ecurl('GET','regmodul/'.$id))->data;
					$data['judul_web'] 	  = "Hapus Peserta Widyaiswara";
					insert_log('PESERTA DIKLAT: Delete ID: '.$id.'');
					ecurl('DELETE','peserta_widyaiswara/'.$id);
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Peserta widyaiswara berhasil dihapus.
						</div>'
							);
					

					redirect('kediklatan/regmodul');
				}else{
					$p = "peserta_widyaiswara";
					$data['judul_web'] 	  = "Peserta Diklat";
				}

					$this->load->view('ketatausahaan/header', $data);
					$this->load->view("kediklatan/$p", $data);
					$this->load->view('ketatausahaan/footer');
					
					// Tambah Surat Masuk Submit
					if (isset($_POST['btnsimpan'])) {	
							
							$id_diklat      = htmlentities(strip_tags($this->input->post('id_diklat')));
							$id_modul   	= htmlentities(strip_tags($this->input->post('id_modul')));
							$id_widyaiswara = htmlentities(strip_tags($this->input->post('id_widyaiswara')));
							$status 		= $this->input->post('status');
				
									$data = array(
										'id_diklat'	     => $id_diklat,
										'id_modul'	     => $id_modul,
										'id_widyaiswara' => $id_widyaiswara,
										'active' 		 => $status		
									);
							ecurl('POST','peserta_widyaiswara',http_build_query($data));
							insert_log('TAMBAH PESERTA WIDYAISWARA: Tambah');
							
					}
					// Edit Lampiran Submit
					if (isset($_POST['btnupdate'])) {
						$id 	= $this->input->post('idt');						
						$id_diklat      = htmlentities(strip_tags($this->input->post('id_diklat')));
						$id_modul   	= htmlentities(strip_tags($this->input->post('id_modul')));
						$id_widyaiswara = htmlentities(strip_tags($this->input->post('id_widyaiswara')));
						$status 		= $this->input->post('status');
											
						$data = array();
						
						$data['id_diklat'] = $id_diklat;
						$data['id_modul'] = $id_modul;
						$data['id_widyaiswara'] = $id_widyaiswara;
						$data['active'] = $status;
						
						ecurl('PUT','peserta_widyaiswara/'.$id,http_build_query($data));
						insert_log('PESERTA DIKLAT: Edit ID '.$id.'');
						$this->session->set_flashdata('msg',
								'<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Peserta Diklat Widyaiswara berhasil diUpdate.
								</div>'
						);
						redirect('kediklatan/regmodul/e/'.$id);
					}


	}
	
		public function diklat($aksi='', $id='',$id2 = ''){
	$userData = $this->session->userdata();		
			$data['userData'] = $userData;
	if($userData['kewenangan_id'] == 1 OR $userData['kewenangan_id'] == 2) {
				$data['diklat_mod'] = json_decode(ecurl('GET','modul_diklat'))->data;
				//die(print_r($data['diklat_mod']));
			}
			else {
				$data['diklat_mod'] = json_decode(ecurl('GET','modul_diklat/'.$userData['id']))->data;
			}
			
	
	if ($aksi == 't') {
		$p = "diklat_tambah";
		$data['judul_web'] = "Tambah Diklat tes";		
		$data['penyelenggara'] = json_decode(ecurl('GET','penyelenggara'))->data;
		$data['master'] = json_decode(ecurl('GET','masterdiklat'))->data;
		$data['tahun'] = json_decode(ecurl('GET','tahun'))->data;
		$data['angkatan'] = json_decode(ecurl('GET','angkatan'))->data;
		$data['kelompok'] = json_decode(ecurl('GET','kelompok'))->data;
	}elseif ($aksi == 'e') {
		$p = "diklat_edit";
		$data['judul_web'] = "Edit Diklat";
		//echo 'id='.$id;
		$data['query'] = json_decode(ecurl('GET','modul_diklat/'.$id))->data;		
		$data['penyelenggara'] = json_decode(ecurl('GET','penyelenggara'))->data;
		$data['master'] = json_decode(ecurl('GET','masterdiklat'))->data;
		$data['tahun'] = json_decode(ecurl('GET','tahun'))->data;
		$data['angkatan'] = json_decode(ecurl('GET','angkatan'))->data;
		$data['kelompok'] = json_decode(ecurl('GET','kelompok'))->data;
	}elseif ($aksi == 'h') {
		/* if (!getAkses('delete',$this->diklat_model->getbase())){
			showMessage('No Akses','Hanya Admin yang dapat mengakses','info');
		} */
		$data['judul_web'] 	  = "Hapus Modul Diklat";

					// Cek Relasi Modul Diklat
					/* $cekrelasi = json_decode(ecurl('GET','/cekrelasi/'.$id.'/id_diklat/diklat_diklat'));
					if($cekrelasi->status == 'no data') { */
						insert_log('DIKLAT: Modul Diklat: Delete ID: '.$id.'');
						ecurl('DELETE','/diklat_diklat/'.$id);
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Modul Diklat berhasil dihapus.
							</div>'
						);
					//}
					redirect('kediklatan/diklat');
	}else{
		
		if (is_numeric($id) && $aksi != '') {
			$this->diklat_model->setRef(array($aksi=>$id));
		}
		$data['judul_web'] 	  = "Daftar Diklat";
		$p='list_diklat';
		
		
	}
		$this->load->view('ketatausahaan/header', $data);
		$this->load->view("kediklatan/$p", $data);
		$this->load->view('ketatausahaan/footer');
	
	// Tambah Surat Masuk Submit
	if (isset($_POST['btnsimpan'])) {	
	
		$lokasi   	  = htmlentities(strip_tags($this->input->post('lokasi')));
		$total_jpl    = htmlentities(strip_tags($this->input->post('total_jpl')));		
		$_jadwal_start    = $this->input->post('jadwal_start');
		$_jadwal_end    = $this->input->post('jadwal_end');		
		$id_master_diklat = htmlentities(strip_tags($this->input->post('id_master_diklat')));
		$id_tahun = htmlentities(strip_tags($this->input->post('id_tahun')));
		$id_angkatan = htmlentities(strip_tags($this->input->post('id_angkatan')));
		$id_kelompok = htmlentities(strip_tags($this->input->post('id_kelompok')));
		$id_penyelenggara = htmlentities(strip_tags($this->input->post('id_penyelenggara')));
		
		$start = explode('-',$_jadwal_start);
		$jadwal_start = $start['2'].'-'.$start['1'].'-'.$start['0'];
		
		$end = explode('-',$_jadwal_end);
		$jadwal_end = $end['2'].'-'.$end['1'].'-'.$end['0'];
		
		$data = array(
			'lokasi'	   	   => $lokasi,
			'total_jpl'	   	   => $total_jpl,
			'jadwal_start'	   => $jadwal_start,
			'jadwal_end'	   => $jadwal_end,
			'id_master_diklat' => $id_master_diklat,
			'id_tahun' 		   => $id_tahun,
			'id_angkatan' 	   => $id_angkatan,
			'id_kelompok' 	   => $id_kelompok,
			'id_penyelenggara' => $id_penyelenggara
			);
			
			ecurl('POST','diklat_diklat',http_build_query($data));
			insert_log('TAMBAH PESERTA DIKLAT: Tambah');
			$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Modul Diklat berhasil ditambahkan.
											</div>'
										);

									redirect('kediklatan/diklat/t');
	}

	// Edit Diklat Modul Submit
	if (isset($_POST['btnupdate'])) {
			$id 	= $this->input->post('idt');						
			
		$lokasi   	  = htmlentities(strip_tags($this->input->post('lokasi')));
		$total_jpl    = htmlentities(strip_tags($this->input->post('total_jpl')));		
		$_jadwal_start    = $this->input->post('jadwal_start');
		$_jadwal_end    = $this->input->post('jadwal_end');		
		$id_master_diklat = htmlentities(strip_tags($this->input->post('id_master_diklat')));
		$id_tahun = htmlentities(strip_tags($this->input->post('id_tahun')));
		$id_angkatan = htmlentities(strip_tags($this->input->post('id_angkatan')));
		$id_kelompok = htmlentities(strip_tags($this->input->post('id_kelompok')));
		$id_penyelenggara = htmlentities(strip_tags($this->input->post('id_penyelenggara')));
		
		$start = explode('-',$_jadwal_start);
		$jadwal_start = $start['2'].'-'.$start['1'].'-'.$start['0'];
		
		$end = explode('-',$_jadwal_end);
		$jadwal_end = $end['2'].'-'.$end['1'].'-'.$end['0'];
		
		$data = array(
			'lokasi'	   	   => $lokasi,
			'total_jpl'	   	   => $total_jpl,
			'jadwal_start'	   => $jadwal_start,
			'jadwal_end'	   => $jadwal_end,
			'id_master_diklat' => $id_master_diklat,
			'id_tahun' 		   => $id_tahun,
			'id_angkatan' 	   => $id_angkatan,
			'id_kelompok' 	   => $id_kelompok,
			'id_penyelenggara' => $id_penyelenggara
			);
			//die(print_r($id));
			ecurl('PUT','diklat_diklat/'.$id,http_build_query($data));
			insert_log('PESERTA DIKLAT: Edit ID '.$id.'');
			$this->session->set_flashdata('msg',
					'<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
						 </button>
						 <strong>Sukses!</strong> Peserta Diklat berhasil diUpdate.
					</div>'
			);
			redirect('kediklatan/diklat/e/'.$id);
		}
		
	}







}