<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	
 public function __construct()
  {
    parent::__construct();
    $this->load->helper('notif_helper');
	$this->load->helper('tanggal_helper');
	$this->load->helper('config_helper');
  }
	
	public function coba() {
		$get = $this->Mcrud->get_browser_dash(date('m'),NULL)->result();
		$gett = $this->Mcrud->get_browser_dash(date('m'),1)->num_rows();
			
			$rowt = array();
			foreach ($get as $row) {
			  $rowt[]="{name:'$row->browser', y:$row->tbrowser/$gett * 100}";
			}
			echo implode(",",$rowt);
			
					
	}
	public function index()
	{
		$ceks = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users_dash(6);
			$data['cusers']  	 = $this->Mcrud->get_users_dash(6)->num_rows();
			
			$data['logs']  		 = $this->Mcrud->get_log(5);
			
			$data['getbrow'] = $this->Mcrud->get_browser_dash(date('m'),NULL)->result();
			$data['getbrowt'] = $this->Mcrud->get_browser_dash(date('m'),1)->num_rows();
			
			$data['getos'] = $this->Mcrud->get_os_dash(date('m'),NULL)->result();
			$data['getost'] = $this->Mcrud->get_os_dash(date('m'),1)->num_rows();
			
			$data['judul_web'] = "Dashboard";

			$this->load->view('users/header', $data);
			$this->load->view('users/beranda', $data);
			$this->load->view('users/footer');

		}
	}
	public function backupdb($aksi='', $id='') {
		$ceks = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		$data['atur']  		 = $this->Mcrud->get_atur(1)->row();
		$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
		$data['db']   	 = $this->Mcrud->get_bu_db();
		$data['judul_web'] 		= "Backup Database";

			$this->load->view('users/header', $data);
			$this->load->view('users/pengaturan/db', $data);
			$this->load->view('users/footer');
			
			if ($aksi == 'h') {

					$data['query'] = $this->db->get_where("tbl_backup", "id_bu = '$id'")->row();
					$data['judul_web'] 	  = "Delete Database";

					
						$this->Mcrud->insertlog($id_user,'Delete Database: ID: '.$id.'');
						unlink("./backup/".$data['query']->file_backup);
						$this->Mcrud->delete_db_by_id($id);
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> File Database berhasil dihapus.
							</div>'
						);
					
					redirect('users/backupdb');
			}

			if (isset($_POST['btnbackup'])) {
				$this->load->dbutil();
					$data = array(
							'format' 	=> 'zip',
							'filename' 	=> 'app_database_backup'
					);
					
					$backup =& $this->dbutil->backup($data);
					$name = 'backup_db_'.date('Ymd_His').'.zip';
					$simpan = './backup/'.$name;
					
					$this->load->helper('file');
					write_file($simpan, $backup);
					
					$this->Mcrud->insertdb_bu($name,$id_user);
					$this->Mcrud->insertlog($id_user,'Backup Database');
					
					$this->load->helper('download');
					//force_download($name, $backup);
					
					

							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Database telah dibackup.
								</div>'
							);
							redirect('users/backupdb');
							
			}
	}
	public function pengaturan($pilih)
	{
		$ceks = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($pilih == 'themes') {
				$data['atur']  		 = $this->Mcrud->get_atur(1)->row();
				$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] 		= "Themes";

					$this->load->view('users/header', $data);
					$this->load->view('users/pengaturan/'.$pilih, $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate'])) {
						$nama	 	= htmlentities(strip_tags($this->input->post('app_name')));
						$title	 	= htmlentities(strip_tags($this->input->post('title_text')));
						$header	 	= htmlentities(strip_tags($this->input->post('header_text')));
						$footer	 	= htmlentities(strip_tags($this->input->post('footer_text')));
						$email	 	= htmlentities(strip_tags($this->input->post('email')));
						$theme	 	= htmlentities(strip_tags($this->input->post('theme')));
						$sidebar	 	= htmlentities(strip_tags($this->input->post('sidebar')));

									$data = array(
										'config'	=> $nama.'#'.$title.'#'.$header.'#'.$footer.'#'.$email.'#'.$theme.'#'.$sidebar
									);
									$this->Mcrud->update_atur(array('id_atur' => 1), $data);
									/*$configtxt = fopen("./config.txt", "w") or die("Unable to open file!");
									fwrite($configtxt, $nama.'#'.$title.'#'.$header.'#'.$footer.'#'.$email.'#'.$theme.'#'.$sidebar);
									fclose($configtxt);*/
									
									$this->Mcrud->insertlog($id_user,'Themes & Title Update');

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Pengaturan Themes & Title berhasil disimpan.
										</div>'
									);
									redirect('users/pengaturan/'.$pilih.'');
					}
			}
			else if ($pilih == 'bg') {
					$data['atur']  		 = $this->Mcrud->get_atur(2)->row();
					$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
					$data['judul_web'] 		= "Background & Icons";

					$this->load->view('users/header', $data);
					$this->load->view('users/pengaturan/'.$pilih, $data);
					$this->load->view('users/footer');
					
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
							
							$this->Mcrud->insertlog($id_user,'Background & Icons: Background Image Update');
						  }
						  else {
							  $bgd	 	= htmlentities(strip_tags($this->input->post('bgd_now')));
						  }
						// FAVICON
						  if (!empty($_FILES['fav']['name'])) {
							$config['upload_path'] = './assets/images/favicon/';
							$config['allowed_types'] = 'png';
							$config['max_size'] = 2000;
							$config['file_name'] = 'favicon_'.date('YmdHis');
							
							$this->upload->initialize($config);
							$this->load->library('upload', $config);
							
							if (!$this->upload->do_upload('fav')) {
								exit($this->upload->display_errors());
							}
	
							$fav = $this->upload->data()['file_name'];
							
							$this->Mcrud->insertlog($id_user,'Background & Icons: Favicon Update');
						  }
						  else {
							  $fav	 	= htmlentities(strip_tags($this->input->post('fav_now')));
						  }
						// LOGO
						   if (!empty($_FILES['logo']['name'])) {
							$config['upload_path'] = './assets/images/logo/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = 2000;
							$config['file_name'] = 'logo'.date('YmdHis');
							
							$this->upload->initialize($config);
							$this->load->library('upload', $config);
							
							if (!$this->upload->do_upload('logo')) {
								exit($this->upload->display_errors());
							}
	
							$logo = $this->upload->data()['file_name'];
							
							$this->Mcrud->insertlog($id_user,'Background & Icons: Logo Update');
						  }
						  else {
							  $logo	 	= htmlentities(strip_tags($this->input->post('logo_now')));
						  }
						 

									$data = array(
										'config'	=> $bgd.'#'.$fav.'#'.$logo
									);
									$this->Mcrud->update_atur(array('id_atur' => 2), $data);
									/*$bgtxt = fopen("./bg.txt", "w") or die("Unable to open file!");
									fwrite($bgtxt, $bgd.'#'.$fav.'#'.$logo);
									fclose($bgtxt);*/

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Pengaturan Background & Icons berhasil disimpan.
										</div>'
									);
									redirect('users/pengaturan/'.$pilih.'');
					}
			}
			else {
				redirect('404_content');
			}
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profile";

					$this->load->view('users/header', $data);
					$this->load->view('users/profile', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate'])) {
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$email	 				= htmlentities(strip_tags($this->input->post('email')));
						$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
						$telp	 					= htmlentities(strip_tags($this->input->post('telp')));
						$pengalaman	 	  = htmlentities(strip_tags($this->input->post('pengalaman')));

									$data = array(
										'nama_lengkap'	=> $nama_lengkap,
										'email'					=> $email,
										'alamat'				=> $alamat,
										'telp'					=> $telp,
										'pengalaman'	  => $pengalaman
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);
									
									$this->Mcrud->insertlog($id_user,'Profile: Detail Update');

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Profile berhasil disimpan.
										</div>'
									);
									redirect('users/profile');
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
										 <strong>Gagal!</strong> Katasandi tidak cocok.
									</div>'
								);
						}else{
									$data = array(
										'password'	=> md5($password)
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);
									
									$this->Mcrud->insertlog($id_user,'Profile: Ubah Sandi');

									$this->session->set_flashdata('msg2',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Katasandi berhasil disimpan.
										</div>'
									);
						}
									redirect('users/profile');
					}


		}
	}

	public function pengguna($aksi='', $id='')
	{
		$ceks = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
			}

			$this->db->order_by('id_user', 'DESC');
			$data['level_users']  = $this->Mcrud->get_level_users();

				if ($aksi == 't') {
					$p = "pengguna_tambah";

					$data['judul_web'] 	  = "Tambah Pengguna";
				}elseif ($aksi == 'd') {
					$p = "pengguna_detail";

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
					$data['judul_web'] 	  = "Detail Pengguna";
				}elseif ($aksi == 'e') {
					$p = "pengguna_edit";

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
					$data['judul_web'] 	  = "Edit Pengguna";
				}elseif ($aksi == 'h') {

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
					$data['judul_web'] 	  = "Hapus Pengguna";

					if ($ceks == $data['query']->username) {
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Gagal!</strong> Maaf, Anda tidak bisa menghapus Nama Pengguna "'.$ceks.'" ini.
							</div>'
						);
					}else{
						$this->Mcrud->insertlog($id_user,'USER: Delete User ID: '.$id.'');
						$this->Mcrud->delete_user_by_id($id);
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Pengguna berhasil dihapus.
							</div>'
						);
					}
					redirect('users/pengguna');
				}else{
					$p = "pengguna";

					$data['judul_web'] 	  = "Pengguna";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/master/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$username   	 	= htmlentities(strip_tags($this->input->post('username')));
						$password	 		  = htmlentities(strip_tags($this->input->post('password')));
						$password2	 		= htmlentities(strip_tags($this->input->post('password2')));
						$level	 				= htmlentities(strip_tags($this->input->post('level')));

						$cek_user = $this->db->get_where("tbl_user", "username = '$username'")->num_rows();
						if ($cek_user != 0) {
								$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Nama Pengguna "'.$username.'" Sudah ada.
									</div>'
								);
						}else{
								if ($password != $password2) {
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Gagal!</strong> Katasandi tidak cocok.
											</div>'
										);
								}else{
										$data = array(
											'username'	 	 => $username,
											'nama_lengkap' => $username,
											'password'	 	 => md5($password),
											'email' 			 => '-',
											'alamat' 			 => '-',
											'telp' 				 => '-',
											'pengalaman' 	 => '-',
											'status' 			 => 'aktif',
											'level'			 	 => $level,
											'tgl_daftar' 	 => $tgl
										);
										$this->Mcrud->save_user($data);
										$this->Mcrud->insertlog($id_user,'USER: Tambah User ID: '.$this->db->insert_id().'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Pengguna berhasil ditambahkan.
											</div>'
										);
								}
						}

									redirect('users/pengguna/t');
					}

					if (isset($_POST['btnupdate'])) {
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$email	 				= htmlentities(strip_tags($this->input->post('email')));
						$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
						$telp	 					= htmlentities(strip_tags($this->input->post('telp')));
						$pengalaman	 	  = htmlentities(strip_tags($this->input->post('pengalaman')));
						$level	 				= htmlentities(strip_tags($this->input->post('level')));

									$data = array(
										'nama_lengkap' => $nama_lengkap,
										'email'				 => $email,
										'alamat'			 => $alamat,
										'telp'				 => $telp,
										'pengalaman'	  => $pengalaman,
										'status' 			 => 'aktif',
										'level'			 	 => $level,
										'tgl_daftar' 	 => $tgl
									);
									$this->Mcrud->update_user(array('id_user' => $id), $data);
									$this->Mcrud->insertlog($id_user,'USER: Edit User ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Pengguna berhasil diupdate.
										</div>'
									);
									redirect('users/pengguna');
					}

		}
	}


	public function bagian($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'user') {
					redirect('404_content');
			}

			$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
					$this->db->where('tbl_bagian.id_user', "$id_user");
			}
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get("tbl_bagian");

				if ($aksi == 't') {
					$p = "bagian_tambah";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Bagian";
				}elseif ($aksi == 'e') {
					$p = "bagian_edit";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Bagian";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data bagian.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/bagian');
					// }

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
					$data['judul_web'] 	  = "Hapus Bagian";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data bagian.
					// 			</div>'
					// 		);
					// }else {
							$this->Mcrud->insertlog($id_user,'BAGIAN: Delete ID: '.$id.'');
							$this->Mcrud->delete_bagian_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Bagian berhasil dihapus.
								</div>'
							);
					// }

					redirect('users/bagian');
				}else{
					$p = "bagian";

					$data['judul_web'] 	  = "Bagian";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/master/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));

										$data = array(
											'nama_bagian'	 => $nama_bagian,
											'id_user'		   => $id_user
										);
										$this->Mcrud->save_bagian($data);
										$this->Mcrud->insertlog($id_user,'BAGIAN: Tambah ID: '.$this->db->insert_id().'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Bagian berhasil ditambahkan.
											</div>'
										);

									redirect('users/bagian/t');
					}

					if (isset($_POST['btnupdate'])) {
							$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));

									$data = array(
										'nama_bagian'	 => $nama_bagian
									);
									$this->Mcrud->update_bagian(array('id_bagian' => $id), $data);
									$this->Mcrud->insertlog($id_user,'BAGIAN: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Bagian berhasil diupdate.
										</div>'
									);
									redirect('users/bagian');
					}

		}
	}
	
	public function tipe($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'user') {
					redirect('404_content');
			}

			/*$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
					$this->db->where('tbl_bagian.id_user', "$id_user");
			}
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');*/
			$data['tipe'] 		  = $this->db->get("tbl_tipe_surat");

				if ($aksi == 't') {
					$p = "tipesurat_tambah";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Tipe Surat";
				}elseif ($aksi == 'e') {
					$p = "tipesurat_edit";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_tipe_surat", array('id_ts' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Tipe Surat";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data bagian.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/bagian');
					// }

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_tipe_surat", array('id_ts' => "$id"))->row();
					$data['judul_web'] 	  = "Hapus Tipe Surat";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data bagian.
					// 			</div>'
					// 		);
					// }else {
							$this->Mcrud->insertlog($id_user,'TIPE SURAT: Delete ID: '.$id.'');
							$this->Mcrud->delete_tipe_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Tipe Surat berhasil dihapus.
								</div>'
							);
					// }

					redirect('users/tipe');
				}else{
					$p = "tipesurat";

					$data['judul_web'] 	  = "Tipe Surat";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/master/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$tipe_surat   	 	= htmlentities(strip_tags($this->input->post('tipe_surat')));
						$desc   	 	= htmlentities(strip_tags($this->input->post('desc')));

										$data = array(
											'name_ts'	 		=> $tipe_surat,
											'desc_ts'		   => $desc
										);
										$this->Mcrud->save_tipe($data);
										$this->Mcrud->insertlog($id_user,'TIPE SURAT: Tambah ID: '.$this->db->insert_id().'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Tipe Surat berhasil ditambahkan.
											</div>'
										);

									redirect('users/tipe/t');
					}

					if (isset($_POST['btnupdate'])) {
							$tipe_surat   	 	= htmlentities(strip_tags($this->input->post('tipe_surat')));
							$desc   	 	= htmlentities(strip_tags($this->input->post('desc')));

									$data = array(
											'name_ts'	 		=> $tipe_surat,
											'desc_ts'		   => $desc
										);
									$this->Mcrud->update_tipe(array('id_ts' => $id), $data);
									$this->Mcrud->insertlog($id_user,'TIPE SURAT: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Tipe Surat berhasil diupdate.
										</div>'
									);
									redirect('users/tipe');
					}

		}
	}

	public function kode($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'user') {
					redirect('404_content');
			}

			//$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
			/*if ($data['user']->row()->level == 'user') {
					$this->db->where('tbl_bagian.id_user', "$id_user");
			}*/
			$this->db->order_by('tbl_kode_surat.name_kode', 'ASC');
			$data['kode'] 		  = $this->db->get("tbl_kode_surat");

				if ($aksi == 't') {
					$p = "kode_tambah";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Kode Surat";
				}elseif ($aksi == 'e') {
					$p = "kode_edit";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_kode_surat", array('id_kode' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Kode Surat";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data bagian.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/bagian');
					// }

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_kode_surat", array('id_kode' => "$id"))->row();
					$data['judul_web'] 	  = "Hapus Kode Surat";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data bagian.
					// 			</div>'
					// 		);
					// }else {
							$this->Mcrud->insertlog($id_user,'KODE SURAT: Delete ID: '.$id.'');
							$this->Mcrud->delete_kode_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Kode Surat berhasil dihapus.
								</div>'
							);
					// }

					redirect('users/kode');
				}else{
					$p = "kode";

					$data['judul_web'] 	  = "Kode Surat";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/master/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$no_kode   	 	= htmlentities(strip_tags($this->input->post('no_kode')));
						$nama_kode   	 	= htmlentities(strip_tags($this->input->post('nama_kode')));
						$desc_kode   	 	= htmlentities(strip_tags($this->input->post('desc_kode')));

										$data = array(
											'no_kode'	 => $no_kode,
											'name_kode'	 => $nama_kode,
											'desc_kode'	 => $desc_kode
										);
										$this->Mcrud->save_kode($data);
										$this->Mcrud->insertlog($id_user,'KODE SURAT: Tambah ID: '.$this->db->insert_id().'');
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Kode Surat berhasil ditambahkan.
											</div>'
										);

									redirect('users/kode/t');
					}

					if (isset($_POST['btnupdate'])) {
							$no_kode   	 	= htmlentities(strip_tags($this->input->post('no_kode')));
							$nama_kode   	 	= htmlentities(strip_tags($this->input->post('nama_kode')));
							$desc_kode   	 	= htmlentities(strip_tags($this->input->post('desc_kode')));

									$data = array(
											'no_kode'	 => $no_kode,
											'name_kode'	 => $nama_kode,
											'desc_kode'	 => $desc_kode
									);
									$this->Mcrud->update_kode(array('id_kode' => $id), $data);
									$this->Mcrud->insertlog($id_user,'KODE SURAT: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Kode Surat berhasil diupdate.
										</div>'
									);
									redirect('users/kode');
					}

		}
	}



	public function ns($aksi='', $id='')
	{
		//redirect('404_content');
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			$this->db->where('tbl_bagian.id_user', "$id_user");
			$this->db->order_by('nama_bagian', 'ASC');
			$data['bagian']			  = $this->db->get("tbl_bagian")->result();

			if ($data['user']->row()->level == 'admin') {
					redirect('404_content');
			}

			// $this->db->join('tbl_bagian', 'tbl_bagian.id_bagian=tbl_ns.id_bagian');
			$this->db->order_by('tbl_ns.id_ns', 'DESC');
			$data['ns'] 		  = $this->db->get("tbl_ns");

				if ($aksi == 't') {
					$p = "ns_tambah";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Nomor Surat";
				}elseif ($aksi == 'e') {
					$p = "ns_edit";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_ns", array('id_ns' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Edit Nomor Surat";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data nomor surat.
								</div>'
							);

							redirect('users/ns');
					}

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_ns", array('id_ns' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Hapus Nomor Surat";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data nomor surat.
								</div>'
							);
					}else {
							$this->Mcrud->delete_ns_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Nomor surat berhasil dihapus.
								</div>'
							);
					}

					redirect('users/ns');
				}else{
					$p = "ns";

					$data['judul_web'] 	  = "Nomor surat";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/master/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$separator 	 		= htmlentities(strip_tags($this->input->post('separator')));

						$no_posisi 	 		= htmlentities(strip_tags($this->input->post('no_posisi')));
						$no 	 					= htmlentities(strip_tags($this->input->post('no')));

						$org_posisi 		= htmlentities(strip_tags($this->input->post('org_posisi')));
						$org 	 					= htmlentities(strip_tags($this->input->post('org')));

						$bag_posisi 		= htmlentities(strip_tags($this->input->post('bag_posisi')));
						$bag 	 					= htmlentities(strip_tags($this->input->post('bag')));

						$subbag_posisi 	= htmlentities(strip_tags($this->input->post('subbag_posisi')));
						$subbag 	 			= htmlentities(strip_tags($this->input->post('subbag')));

						$bln_posisi 	 	= htmlentities(strip_tags($this->input->post('bln_posisi')));
						$bln 	 					= htmlentities(strip_tags($this->input->post('bln')));

						$thn_posisi 	 	= htmlentities(strip_tags($this->input->post('thn_posisi')));
						$thn 	 					= htmlentities(strip_tags($this->input->post('thn')));
						$reset_no 		 	= htmlentities(strip_tags($this->input->post('reset_no')));

						$prefix 	 			= htmlentities(strip_tags($this->input->post('prefix')));
						$prefix_posisi 	= htmlentities(strip_tags($this->input->post('prefix_posisi')));

						$jenis_ns 		 	= htmlentities(strip_tags($this->input->post('jenis_ns')));
						$ket 	 					= htmlentities(strip_tags($this->input->post('ket')));

						//1
						if ($no_posisi == 1) {
								$no1 = $no;
						}elseif ($no_posisi == 2) {
								$no2 = $no;
						}elseif ($no_posisi == 3) {
								$no3 = $no;
						}elseif ($no_posisi == 4) {
								$no4 = $no;
						}elseif ($no_posisi == 5) {
								$no5 = $no;
						}elseif ($no_posisi == 6) {
								$no6 = $no;
						}

						//2
						if ($org_posisi == 1) {
								$no1 = $org;
						}elseif ($org_posisi == 2) {
								$no2 = $org;
						}elseif ($org_posisi == 3) {
								$no3 = $org;
						}elseif ($org_posisi == 4) {
								$no4 = $org;
						}elseif ($org_posisi == 5) {
								$no5 = $org;
						}elseif ($org_posisi == 6) {
								$no6 = $org;
						}

						//3
						if ($bag_posisi == 1) {
								$no1 = $bag;
						}elseif ($bag_posisi == 2) {
								$no2 = $bag;
						}elseif ($bag_posisi == 3) {
								$no3 = $bag;
						}elseif ($bag_posisi == 4) {
								$no4 = $bag;
						}elseif ($bag_posisi == 5) {
								$no5 = $bag;
						}elseif ($bag_posisi == 6) {
								$no6 = $bag;
						}

						//4
						if ($subbag_posisi == 1) {
								$no1 = $subbag;
						}elseif ($subbag_posisi == 2) {
								$no2 = $subbag;
						}elseif ($subbag_posisi == 3) {
								$no3 = $subbag;
						}elseif ($subbag_posisi == 4) {
								$no4 = $subbag;
						}elseif ($subbag_posisi == 5) {
								$no5 = $subbag;
						}elseif ($subbag_posisi == 6) {
								$no6 = $subbag;
						}

						//5
						if ($bln_posisi == 1) {
								$no1 = $bln;
						}elseif ($bln_posisi == 2) {
								$no2 = $bln;
						}elseif ($bln_posisi == 3) {
								$no3 = $bln;
						}elseif ($bln_posisi == 4) {
								$no4 = $bln;
						}elseif ($bln_posisi == 5) {
								$no5 = $bln;
						}elseif ($bln_posisi == 6) {
								$no6 = $bln;
						}

						//6
						if ($thn_posisi == 1) {
								$no1 = $thn;
						}elseif ($thn_posisi == 2) {
								$no2 = $thn;
						}elseif ($thn_posisi == 3) {
								$no3 = $thn;
						}elseif ($thn_posisi == 4) {
								$no4 = $thn;
						}elseif ($thn_posisi == 5) {
								$no5 = $thn;
						}elseif ($thn_posisi == 6) {
								$no6 = $thn;
						}

						if ($no1 != '') {
								if ($no2 != '') {
										$no1 = "$no1$separator";
								}else{
										$no1 = "$no1";
								}
						}
						if ($no2 != '') {
								if ($no3 != '') {
										$no2 = "$no2$separator";
								}else{
										$no2 = "$no2";
								}
						}
						if ($no3 != '') {
								if ($no4 != '') {
										$no3 = "$no3$separator";
								}else{
										$no3 = "$no3";
								}
						}
						if ($no4 != '') {
								if ($no5 != '') {
										$no4 = "$no4$separator";
								}else{
										$no4 = "$no4";
								}
						}
						if ($no5 != '') {
								if ($no6 != '') {
										$no5 = "$no5$separator";
								}else{
										$no5 = "$no5";
								}
						}

						if ($prefix_posisi == "kiri") {
								$p_kiri  = "$prefix$separator";
								$p_kanan = '';
						}elseif ($prefix_posisi == "kanan") {
								$p_kiri  = '';
								$p_kanan = "$separator$prefix";
						}else{
								$p_kiri  = '';
								$p_kanan = '';
						}

						if ($reset_no == '') {
								$reset_no = 'thn';
						}

						$no_surat = "$p_kiri$no1$no2$no3$no4$no5$no6$p_kanan";

						if ($ket == '') {
								$ket = '-';
						}
										$data = array(
											'separator'			 => $separator,
											'no_posisi'			 => $no_posisi,
											'no'			  		 => $no,
											'org_posisi'		 => $org_posisi,
											'org'			  		 => $org,
											'bag_posisi'		 => $bag_posisi,
											'bag'						 => $bag,
											'subbag_posisi'	 => $subbag_posisi,
											'subbag'			   => $subbag,
											'bln_posisi'		 => $bln_posisi,
											'bln'			   		 => $bln,
											'thn_posisi'		 => $thn_posisi,
											'thn'		 				 => $thn,
											'reset_no'			 => $reset_no,
											'prefix'			   => $prefix,
											'prefix_posisi'	 => $prefix_posisi,
											'jenis_ns'			 => $jenis_ns,
											'ket'			   		 => $ket,
											'no_surat'			 => $no_surat,
											'id_user'			   => $id_user,
											'tgl_ns'				 => $tgl
										);
										$this->Mcrud->save_ns($data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Nomor Surat berhasil ditambahkan.
											</div>'
										);

									redirect('users/ns/t');
					}

					if (isset($_POST['btnupdate'])) {
						$separator 	 		= htmlentities(strip_tags($this->input->post('separator')));

						$no_posisi 	 		= htmlentities(strip_tags($this->input->post('no_posisi')));
						$no 	 					= htmlentities(strip_tags($this->input->post('no')));

						$org_posisi 		= htmlentities(strip_tags($this->input->post('org_posisi')));
						$org 	 					= htmlentities(strip_tags($this->input->post('org')));

						$bag_posisi 		= htmlentities(strip_tags($this->input->post('bag_posisi')));
						$bag 	 					= htmlentities(strip_tags($this->input->post('bag')));

						$subbag_posisi 	= htmlentities(strip_tags($this->input->post('subbag_posisi')));
						$subbag 	 			= htmlentities(strip_tags($this->input->post('subbag')));

						$bln_posisi 	 	= htmlentities(strip_tags($this->input->post('bln_posisi')));
						$bln 	 					= htmlentities(strip_tags($this->input->post('bln')));

						$thn_posisi 	 	= htmlentities(strip_tags($this->input->post('thn_posisi')));
						$thn 	 					= htmlentities(strip_tags($this->input->post('thn')));
						$reset_no 		 	= htmlentities(strip_tags($this->input->post('reset_no')));

						$prefix 	 			= htmlentities(strip_tags($this->input->post('prefix')));
						$prefix_posisi 	= htmlentities(strip_tags($this->input->post('prefix_posisi')));

						$jenis_ns 		 	= htmlentities(strip_tags($this->input->post('jenis_ns')));
						$ket 	 					= htmlentities(strip_tags($this->input->post('ket')));

						$no1 = '';
						$no2 = '';
						$no3 = '';
						$no4 = '';
						$no5 = '';
						$no6 = '';

						//1
						if ($no_posisi == 1) {
								$no1 = $no;
						}elseif ($no_posisi == 2) {
								$no2 = $no;
						}elseif ($no_posisi == 3) {
								$no3 = $no;
						}elseif ($no_posisi == 4) {
								$no4 = $no;
						}elseif ($no_posisi == 5) {
								$no5 = $no;
						}elseif ($no_posisi == 6) {
								$no6 = $no;
						}

						//2
						if ($org_posisi == 1) {
								$no1 = $org;
						}elseif ($org_posisi == 2) {
								$no2 = $org;
						}elseif ($org_posisi == 3) {
								$no3 = $org;
						}elseif ($org_posisi == 4) {
								$no4 = $org;
						}elseif ($org_posisi == 5) {
								$no5 = $org;
						}elseif ($org_posisi == 6) {
								$no6 = $org;
						}

						//3
						if ($bag_posisi == 1) {
								$no1 = $bag;
						}elseif ($bag_posisi == 2) {
								$no2 = $bag;
						}elseif ($bag_posisi == 3) {
								$no3 = $bag;
						}elseif ($bag_posisi == 4) {
								$no4 = $bag;
						}elseif ($bag_posisi == 5) {
								$no5 = $bag;
						}elseif ($bag_posisi == 6) {
								$no6 = $bag;
						}

						//4
						if ($subbag_posisi == 1) {
								$no1 = $subbag;
						}elseif ($subbag_posisi == 2) {
								$no2 = $subbag;
						}elseif ($subbag_posisi == 3) {
								$no3 = $subbag;
						}elseif ($subbag_posisi == 4) {
								$no4 = $subbag;
						}elseif ($subbag_posisi == 5) {
								$no5 = $subbag;
						}elseif ($subbag_posisi == 6) {
								$no6 = $subbag;
						}

						//5
						if ($bln_posisi == 1) {
								$no1 = $bln;
						}elseif ($bln_posisi == 2) {
								$no2 = $bln;
						}elseif ($bln_posisi == 3) {
								$no3 = $bln;
						}elseif ($bln_posisi == 4) {
								$no4 = $bln;
						}elseif ($bln_posisi == 5) {
								$no5 = $bln;
						}elseif ($bln_posisi == 6) {
								$no6 = $bln;
						}

						//6
						if ($thn_posisi == 1) {
								$no1 = $thn;
						}elseif ($thn_posisi == 2) {
								$no2 = $thn;
						}elseif ($thn_posisi == 3) {
								$no3 = $thn;
						}elseif ($thn_posisi == 4) {
								$no4 = $thn;
						}elseif ($thn_posisi == 5) {
								$no5 = $thn;
						}elseif ($thn_posisi == 6) {
								$no6 = $thn;
						}

						if ($no1 != '') {
								if ($no2 != '') {
										$no1 = "$no1$separator";
								}else{
										$no1 = "$no1";
								}
						}
						if ($no2 != '') {
								if ($no3 != '') {
										$no2 = "$no2$separator";
								}else{
										$no2 = "$no2";
								}
						}
						if ($no3 != '') {
								if ($no4 != '') {
										$no3 = "$no3$separator";
								}else{
										$no3 = "$no3";
								}
						}
						if ($no4 != '') {
								if ($no5 != '') {
										$no4 = "$no4$separator";
								}else{
										$no4 = "$no4";
								}
						}
						if ($no5 != '') {
								if ($no6 != '') {
										$no5 = "$no5$separator";
								}else{
										$no5 = "$no5";
								}
						}


						if ($prefix_posisi == "kiri") {
								$p_kiri  = "$prefix$separator";
								$p_kanan = '';
						}else{
								$p_kiri  = '';
								$p_kanan = "$separator$prefix";
						}

						if ($reset_no == '') {
								$reset_no = 'thn';
						}

						$no_surat = "$p_kiri$no1$no2$no3$no4$no5$no6$p_kanan";

						if ($ket == '') {
								$ket = '-';
						}
										$data = array(
											'separator'			 => $separator,
											'no_posisi'			 => $no_posisi,
											'no'			  		 => $no,
											'org_posisi'		 => $org_posisi,
											'org'			  		 => $org,
											'bag_posisi'		 => $bag_posisi,
											'bag'						 => $bag,
											'subbag_posisi'	 => $subbag_posisi,
											'subbag'			   => $subbag,
											'bln_posisi'		 => $bln_posisi,
											'bln'			   		 => $bln,
											'thn_posisi'		 => $thn_posisi,
											'thn'		 				 => $thn,
											'reset_no'			 => $reset_no,
											'prefix'			   => $prefix,
											'prefix_posisi'	 => $prefix_posisi,
											'jenis_ns'			 => $jenis_ns,
											'ket'			   		 => $ket,
											'no_surat'			 => $no_surat,
											'id_user'			   => $id_user
										);
									$this->Mcrud->update_ns(array('id_ns' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Nomor Surat berhasil diupdate.
										</div>'
									);
									redirect('users/ns');
					}

		}
	}


	public function sm($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			// if ($data['user']->row()->level == 'admin') {
			// 		redirect('404_content');
			// }

			// $this->db->join('tbl_user', 'tbl_sm.id_user=tbl_user.id_user');
			// if ($data['user']->row()->level == 'user') {
			// 		$this->db->where('tbl_sm.id_user', "$id_user");
			// }
			$this->db->order_by('tbl_sm.id_sm', 'DESC');
			//$data['sm'] 		  = $this->db->get("tbl_sm");
			$data['sm'] 		  = $this->Mcrud->get_sm_join(NULL);

				if ($aksi == 'tm') {
					$p = "sm_tambah";
					
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Surat Masuk";
					$data['data_ns']			= $this->Mcrud->data_ns('sm', "$id_user");
				}elseif ($aksi == 'd') {
					$p = "sm_detail";

					//$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
					$data['query'] = $this->Mcrud->get_sm_join($id)->row();
					$data['judul_web'] 	  = "Detail Surat Masuk";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat masuk.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/sm');
					// }
					if ($data['user']->row()->level != 'user') {
							$data2 = array(
								'dibaca' => '1'
							);
							$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					}

					if (isset($_POST['btndisposisi'])) {
							$data2 = array(
								'disposisi' => '1'
							);
							$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);

							redirect('users/sm');
					}

					if (isset($_POST['btndisposisi0'])) {
							$data2 = array(
								'disposisi' => '0'
							);
							$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);

							redirect('users/sm');
					}
				}elseif ($aksi == 'e') {
					$p = "sm_edit";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					//$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
					$data['query'] = $this->Mcrud->get_sm_join($id)->row();
					$data['judul_web'] 	  = "Edit Surat Masuk";

					// if ($data['query']->id_user == '' or $data['query']->level != 'admin') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat masuk.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/sm');
					// }

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Hapus Surat Masuk";
					

					if ($data['query']->level == 'user') {
							// $this->session->set_flashdata('msg',
							// 	'
							// 	<div class="alert alert-warning alert-dismissible" role="alert">
							// 		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// 			 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							// 		 </button>
							// 		 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data surat masuk.
							// 	</div>'
							// );

							$data2 = array(
								'id_user'		   	 => ''
							);
							$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);

					}else {

							$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
							foreach ($query_h->result() as $baris) {
								unlink('lampiran/'.$baris->nama_berkas);
							}

							$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
							$this->Mcrud->insertlog($id_user,'SURAT MASUK: Delete ID: '.$id.'');
							$this->Mcrud->delete_sm_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil dihapus.
								</div>'
							);
					}

					redirect('users/sm');
				}else{
					$p = "sm";

					$data['judul_web'] 	  = "Surat Masuk";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pemrosesan/$p", $data);
					$this->load->view('users/footer');


					if (isset($_POST['ns'])) {

						$this->upload->initialize(array(
							"upload_path"   => "./lampiran",
							"allowed_types" => "*" //jpg|jpeg|png|gif|bmp
						));

						if($this->upload->do_upload('userfile')){
							// $ns   	 			= htmlentities(strip_tags($this->input->post('ns')));
							$no_asal   	 	= htmlentities(strip_tags($this->input->post('no_asal')));
							// $tgl_ns   	 	= htmlentities(strip_tags($this->input->post('tgl_ns')));
							$tgl_no_asal  = htmlentities(strip_tags($this->input->post('tgl_no_asal')));
							// $pengirim   	= htmlentities(strip_tags($this->input->post('pengirim')));
							$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
							$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
							$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));

							date_default_timezone_set('Asia/Jakarta');
							$waktu = date('Y-m-d H:m:s');
							$tgl 	 = date('d-m-Y');

							$token = md5("$id_user-$ns-$waktu");

							$cek_status = $this->db->get_where('tbl_sm', "token_lampiran='$token'")->num_rows();
								if ($cek_status == 0) {
									$data = array(
										'no_surat'			 => $no_asal,
										'kode_surat'		=> $kode,
										'tgl_ns'		   	 => $tgl_no_asal,
										'no_asal'		  	 => $no_asal,
										'tgl_no_asal'	   => $tgl_no_asal,
										'pengirim'		   => $data['user']->row()->id_user,
										'penerima'	 		 => $penerima,
										'perihal'		   	 => $perihal,
										'token_lampiran' => $token,
										'id_user'				 => $id_user,
										'dibaca'				 => 0,
										'disposisi'			 => 0,
										'tgl_sm'				 => $tgl,
										'id_user'				 => $penerima
									);
									$this->Mcrud->save_sm($data);
									$this->Mcrud->insertlog($id_user,'SURAT MASUK: Tambah ID: '.$this->db->insert_id().'');

									// $cek_ns = $this->db->get_where('tbl_ns',"no_surat='$ns'")->row();
									// $jumlah_no 			= strlen($cek_ns->no);
									// $noUrut 	 			= substr($cek_ns->no, 0, $jumlah_no);
									// $noUrut++;
									// if ($jumlah_no < 10) {
									// 	$banyak_nol = "0".$jumlah_no."s";
									// }else{
									// 	$banyak_nol = $banyak_nol."s";
									// }
									// $no							= sprintf("%$banyak_nol", $noUrut);
									// $no_posisi  		= $cek_ns->no_posisi;
									// $org						= $cek_ns->org;
									// $org_posisi			= $cek_ns->org_posisi;
									// $bag						= $cek_ns->bag;
									// $bag_posisi			= $cek_ns->bag_posisi;
									// $subbag					= $cek_ns->subbag;
									// $subbag_posisi	= $cek_ns->subbag_posisi;
									// $bln						= $cek_ns->bln;
									// $bln_posisi			= $cek_ns->bln_posisi;
									// $thn						= $cek_ns->thn;
									// $thn_posisi			= $cek_ns->thn_posisi;
									// $prefix					= $cek_ns->prefix;
									// $prefix_posisi	= $cek_ns->prefix_posisi;
									// $separator			= $cek_ns->separator;
									// $reset_no				= $cek_ns->reset_no;
									//
									// if ($reset_no == 'thn') {
									// 		if ($thn != date('Y')) {
									// 			$thn = date('Y');
									// 			$no	 = sprintf("%$banyak_nol", 1);
									// 		}
									// 		$reset_no = 'thn';
									// }elseif ($reset_no == 'bln') {
									// 		$array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
									// 		$bulan = $array_bulan[date('n')];
									//
									// 		if ($bln != $bulan) {
									// 			$bln = $bulan;
									// 			$no	 = sprintf("%$banyak_nol", 1);
									// 		}
									//
									// 		$reset_no = 'bln';
									// }else{
									// 		$reset_no = 'thn';
									// }
									//
									// $no1 = '';
									// $no2 = '';
									// $no3 = '';
									// $no4 = '';
									// $no5 = '';
									// $no6 = '';
									//
									// //1
									// if ($no_posisi == 1) {
									// 		$no1 = $no;
									// }elseif ($no_posisi == 2) {
									// 		$no2 = $no;
									// }elseif ($no_posisi == 3) {
									// 		$no3 = $no;
									// }elseif ($no_posisi == 4) {
									// 		$no4 = $no;
									// }elseif ($no_posisi == 5) {
									// 		$no5 = $no;
									// }elseif ($no_posisi == 6) {
									// 		$no6 = $no;
									// }
									//
									// //2
									// if ($org_posisi == 1) {
									// 		$no1 = $org;
									// }elseif ($org_posisi == 2) {
									// 		$no2 = $org;
									// }elseif ($org_posisi == 3) {
									// 		$no3 = $org;
									// }elseif ($org_posisi == 4) {
									// 		$no4 = $org;
									// }elseif ($org_posisi == 5) {
									// 		$no5 = $org;
									// }elseif ($org_posisi == 6) {
									// 		$no6 = $org;
									// }
									//
									// //3
									// if ($bag_posisi == 1) {
									// 		$no1 = $bag;
									// }elseif ($bag_posisi == 2) {
									// 		$no2 = $bag;
									// }elseif ($bag_posisi == 3) {
									// 		$no3 = $bag;
									// }elseif ($bag_posisi == 4) {
									// 		$no4 = $bag;
									// }elseif ($bag_posisi == 5) {
									// 		$no5 = $bag;
									// }elseif ($bag_posisi == 6) {
									// 		$no6 = $bag;
									// }
									//
									// //4
									// if ($subbag_posisi == 1) {
									// 		$no1 = $subbag;
									// }elseif ($subbag_posisi == 2) {
									// 		$no2 = $subbag;
									// }elseif ($subbag_posisi == 3) {
									// 		$no3 = $subbag;
									// }elseif ($subbag_posisi == 4) {
									// 		$no4 = $subbag;
									// }elseif ($subbag_posisi == 5) {
									// 		$no5 = $subbag;
									// }elseif ($subbag_posisi == 6) {
									// 		$no6 = $subbag;
									// }
									//
									// //5
									// if ($bln_posisi == 1) {
									// 		$no1 = $bln;
									// }elseif ($bln_posisi == 2) {
									// 		$no2 = $bln;
									// }elseif ($bln_posisi == 3) {
									// 		$no3 = $bln;
									// }elseif ($bln_posisi == 4) {
									// 		$no4 = $bln;
									// }elseif ($bln_posisi == 5) {
									// 		$no5 = $bln;
									// }elseif ($bln_posisi == 6) {
									// 		$no6 = $bln;
									// }
									//
									// //6
									// if ($thn_posisi == 1) {
									// 		$no1 = $thn;
									// }elseif ($thn_posisi == 2) {
									// 		$no2 = $thn;
									// }elseif ($thn_posisi == 3) {
									// 		$no3 = $thn;
									// }elseif ($thn_posisi == 4) {
									// 		$no4 = $thn;
									// }elseif ($thn_posisi == 5) {
									// 		$no5 = $thn;
									// }elseif ($thn_posisi == 6) {
									// 		$no6 = $thn;
									// }
									//
									// if ($no1 != '') {
									// 		if ($no2 != '') {
									// 				$no1 = "$no1$separator";
									// 		}else{
									// 				$no1 = "$no1";
									// 		}
									// }
									// if ($no2 != '') {
									// 		if ($no3 != '') {
									// 				$no2 = "$no2$separator";
									// 		}else{
									// 				$no2 = "$no2";
									// 		}
									// }
									// if ($no3 != '') {
									// 		if ($no4 != '') {
									// 				$no3 = "$no3$separator";
									// 		}else{
									// 				$no3 = "$no3";
									// 		}
									// }
									// if ($no4 != '') {
									// 		if ($no5 != '') {
									// 				$no4 = "$no4$separator";
									// 		}else{
									// 				$no4 = "$no4";
									// 		}
									// }
									// if ($no5 != '') {
									// 		if ($no6 != '') {
									// 				$no5 = "$no5$separator";
									// 		}else{
									// 				$no5 = "$no5";
									// 		}
									// }
									//
									//
									// if ($prefix_posisi == "kiri") {
									// 		$p_kiri  = "$prefix$separator";
									// 		$p_kanan = '';
									// }else{
									// 		$p_kiri  = '';
									// 		$p_kanan = "$separator$prefix";
									// }
									//
									//
									// $no_surat = "$p_kiri$no1$no2$no3$no4$no5$no6$p_kanan";
									//
									// $data2 = array(
									// 	'no'		   	 => $no,
									// 	'no_surat'	 => $no_surat
									// );
									// $this->Mcrud->update_ns(array('no_surat' => "$ns"), $data2);

								}

								$nama   = $this->upload->data('file_name');
								$ukuran = $this->upload->data('file_size');

								$this->db->insert('tbl_lampiran',array('nama_berkas'=>$nama,'ukuran'=>$ukuran,'token_lampiran'=>"$token"));

						}
							// $this->session->set_flashdata('msg',
							// 	'
							// 	<div class="alert alert-success alert-dismissible" role="alert">
							// 		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// 			 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							// 		 </button>
							// 		 <strong>Sukses!</strong> Surat Masuk berhasil ditambahkan.
							// 	</div>'
							// );
							//
							// redirect('users/sm');
					}

					if (isset($_POST['btnupdate'])) {
						$no_asal   	 	= htmlentities(strip_tags($this->input->post('no_asal')));
						// $tgl_ns   	 	= htmlentities(strip_tags($this->input->post('tgl_ns')));
						$tgl_no_asal  = htmlentities(strip_tags($this->input->post('tgl_no_asal')));
						// $pengirim   	= htmlentities(strip_tags($this->input->post('pengirim')));
						$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
						$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
						$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));

								$data = array(
									'tgl_ns'		   	 => $tgl_no_asal,
									'kode_surat'		   	 => $kode,
									'no_asal'		  	 => $no_asal,
									'tgl_no_asal'	   => $tgl_no_asal,
									'pengirim'		   => $data['user']->row()->id_user,
									'penerima'	 		 => $penerima,
									'perihal'		   	 => $perihal,
									'id_user'				 => $penerima
								);
								$this->Mcrud->update_sm(array('id_sm' => $id), $data);
								$this->Mcrud->insertlog($id_user,'SURAT MASUK: Edit ID: '.$id.'');

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Surat Masuk berhasil diupdate.
										</div>'
									);
									redirect('users/sm');
					}

		}
	}


	public function sk($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			// if ($data['user']->row()->level == 'admin') {
			// 		redirect('404_content');
			// }
			/*
			$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
					$this->db->where('tbl_sk.id_user', "$id_user");
			}*/
			$this->db->order_by('tbl_sk.id_sk', 'DESC');
			//$data['sk'] 		  = $this->db->get("tbl_sk");
			$data['sk'] 		  = $this->Mcrud->get_sk_join(NULL);
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get_where("tbl_bagian","id_user='$id_user'")->result();

				if ($aksi == 'tk') {
					$p = "sk_tambah";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Surat Keluar";
					$data['bagian'] 	= $this->db->get("tbl_bagian")->result();
					$data['data_ns'] = $this->Mcrud->data_ns('sk', "$id_user");
				}elseif ($aksi == 'd') {
					$p = "sk_detail";

					/*//$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
					$this->db->select('tbl_sk.*,tbl_kode_surat.no_kode,tbl_kode_surat.name_kode,a.nama_lengkap as npengirim,b.nama_lengkap as npenerima,tbl_bagian.nama_bagian');
					//$this->db->from("tbl_sk");
					$this->db->join('tbl_kode_surat', 'tbl_kode_surat.id_kode=tbl_sk.kode_surat');
					$this->db->join('tbl_bagian', 'tbl_bagian.id_bagian=tbl_sk.id_bagian');
					$this->db->join('tbl_user a', 'a.id_user=tbl_sk.pengirim');
					$this->db->join('tbl_user b', 'b.id_user=tbl_sk.penerima');*/
					//$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id"))->row();
					$data['query'] = $this->Mcrud->get_sk_join($id)->row();
					$data['judul_web'] 	  = "Detail Surat Keluar";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat keluar.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/sk');
					// }
					if ($data['user']->row()->level == 'admin') {
							$data2 = array(
								'dibaca' => '1'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
					}

					if (isset($_POST['btndisposisi'])) {
							$data2 = array(
								'disposisi' => $_POST['bagian_real']
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}

					if (isset($_POST['btndisposisi0'])) {
							$data2 = array(
								'disposisi' => '0'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}

					if (isset($_POST['btnperingatan'])) {
							$data2 = array(
								'peringatan' => '1'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}

					if (isset($_POST['btnperingatan0'])) {
							$data2 = array(
								'peringatan' => '0'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}
				}elseif ($aksi == 'e') {
					$p = "sk_edit";
					if ($data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					// $this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
					//$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
					$data['query'] = $this->Mcrud->get_sk_join($id)->row();
					$data['judul_web'] 	  = "Edit Surat Keluar";
					$data['bagian'] 	= $this->db->get("tbl_bagian")->result();
					$data['penerima'] 	= $this->db->get("tbl_user")->result();
					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat keluar.
								</div>'
							);

							redirect('users/sk');
					}

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Hapus Surat Keluar";

					if ($data['query']->id_user != '') {
							// $this->session->set_flashdata('msg',
							// 	'
							// 	<div class="alert alert-warning alert-dismissible" role="alert">
							// 		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// 			 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							// 		 </button>
							// 		 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data surat keluar.
							// 	</div>'
							// );
							$data2 = array(
								'id_user'		   	 => ''
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
					}else {

							$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $data['query']->token_lampiran));
							foreach ($query_h->result() as $baris) {
								unlink('lampiran/'.$baris->nama_berkas);
							}

							$this->Mcrud->delete_lampiran($data['query']->token_lampiran);
							$this->Mcrud->insertlog($id_user,'SURAT KELUAR: Hapus ID: '.$id.'');
							$this->Mcrud->delete_sk_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat keluar berhasil dihapus.
								</div>'
							);
					}

					redirect('users/sk');
				}else{
					$p = "sk";

					$data['judul_web'] 	  = "Surat Keluar";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pemrosesan/$p", $data);
					$this->load->view('users/footer');

					if (isset($_POST['ns'])) {

						$this->upload->initialize(array(
							"upload_path"   => "./lampiran",
							"allowed_types" => "*" //jpg|jpeg|png|gif|bmp
						));

						if($this->upload->do_upload('userfile')){
							$ns   	 			= htmlentities(strip_tags($this->input->post('ns')));
							$tgl_ns   	 	= htmlentities(strip_tags($this->input->post('tgl_ns')));
							$bagian   		= htmlentities(strip_tags($this->input->post('bagian')));
							//$bagian   		= $this->input->post('bagian');
							$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
							$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
							$kode   	= htmlentities(strip_tags($this->input->post('kode')));
							$tipe   	= htmlentities(strip_tags($this->input->post('tipe_surat')));

							date_default_timezone_set('Asia/Jakarta');
							$waktu = date('Y-m-d H:m:s');
							$tgl 	 = date('d-m-Y');

							$token = md5("$id_user-$ns-$waktu");

							$cek_status = $this->db->get_where('tbl_sk', "token_lampiran='$token'")->num_rows();
								if ($cek_status == 0) {
									$data = array(
										'no_surat'			 => $ns,
										'kode_surat'			 => $kode,
										'tipe_surat'			 => $tipe,
										'tgl_ns'		   	 => $tgl_ns,
										'pengirim'			 => $data['user']->row()->id_user,
										'penerima'	 		 => $penerima,
										'id_bagian'		 	 => $bagian,
										'perihal'		   	 => $perihal,
										'token_lampiran' => $token,
										'id_user'				 => $data['user']->row()->id_user,
										'dibaca'				 => 0,
										'disposisi'			 => '',
										'peringatan'		 => '',
										'tgl_sk'				 => $tgl
									);
									$this->Mcrud->save_sk($data);
									$this->Mcrud->insertlog($id_user,'SURAT KELUAR: Tambah ID: '.$this->db->insert_id().'');
									// $cek_ns = $this->db->get_where('tbl_ns',"no_surat='$ns'")->row();
									// $jumlah_no 			= strlen($cek_ns->no);
									// $noUrut 	 			= substr($cek_ns->no, 2, $jumlah_no);
									// $noUrut++;
									// if ($jumlah_no < 10) {
									// 	$banyak_nol = "0".$jumlah_no."s";
									// }else{
									// 	$banyak_nol = $banyak_nol."s";
									// }
									// $no							= sprintf("%$banyak_nol", $noUrut);
									//
									// $no_posisi  		= $cek_ns->no_posisi;
									// $org						= $cek_ns->org;
									// $org_posisi			= $cek_ns->org_posisi;
									// $bag						= $cek_ns->bag;
									// $bag_posisi			= $cek_ns->bag_posisi;
									// $subbag					= $cek_ns->subbag;
									// $subbag_posisi	= $cek_ns->subbag_posisi;
									// $bln						= $cek_ns->bln;
									// $bln_posisi			= $cek_ns->bln_posisi;
									// $thn						= $cek_ns->thn;
									// $thn_posisi			= $cek_ns->thn_posisi;
									// $prefix					= $cek_ns->prefix;
									// $prefix_posisi	= $cek_ns->prefix_posisi;
									// $separator			= $cek_ns->separator;
									// $reset_no				= $cek_ns->reset_no;
									//
									// if ($reset_no == 'thn') {
									// 		if ($thn != date('Y')) {
									// 			$thn = date('Y');
									// 			$no	 = sprintf("%$banyak_nol", 1);
									// 		}
									// 		$reset_no = 'thn';
									// }elseif ($reset_no == 'bln') {
									// 		$array_bulan = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
									// 		$bulan = $array_bulan[date('n')];
									//
									// 		if ($bln != $bulan) {
									// 			$bln = $bulan;
									// 			$no	 = sprintf("%$banyak_nol", 1);
									// 		}
									//
									// 		$reset_no = 'bln';
									// }else{
									// 		$reset_no = 'thn';
									// }
									//
									// $no1 = '';
									// $no2 = '';
									// $no3 = '';
									// $no4 = '';
									// $no5 = '';
									// $no6 = '';
									//
									// //1
									// if ($no_posisi == 1) {
									// 		$no1 = $no;
									// }elseif ($no_posisi == 2) {
									// 		$no2 = $no;
									// }elseif ($no_posisi == 3) {
									// 		$no3 = $no;
									// }elseif ($no_posisi == 4) {
									// 		$no4 = $no;
									// }elseif ($no_posisi == 5) {
									// 		$no5 = $no;
									// }elseif ($no_posisi == 6) {
									// 		$no6 = $no;
									// }
									//
									// //2
									// if ($org_posisi == 1) {
									// 		$no1 = $org;
									// }elseif ($org_posisi == 2) {
									// 		$no2 = $org;
									// }elseif ($org_posisi == 3) {
									// 		$no3 = $org;
									// }elseif ($org_posisi == 4) {
									// 		$no4 = $org;
									// }elseif ($org_posisi == 5) {
									// 		$no5 = $org;
									// }elseif ($org_posisi == 6) {
									// 		$no6 = $org;
									// }
									//
									// //3
									// if ($bag_posisi == 1) {
									// 		$no1 = $bag;
									// }elseif ($bag_posisi == 2) {
									// 		$no2 = $bag;
									// }elseif ($bag_posisi == 3) {
									// 		$no3 = $bag;
									// }elseif ($bag_posisi == 4) {
									// 		$no4 = $bag;
									// }elseif ($bag_posisi == 5) {
									// 		$no5 = $bag;
									// }elseif ($bag_posisi == 6) {
									// 		$no6 = $bag;
									// }
									//
									// //4
									// if ($subbag_posisi == 1) {
									// 		$no1 = $subbag;
									// }elseif ($subbag_posisi == 2) {
									// 		$no2 = $subbag;
									// }elseif ($subbag_posisi == 3) {
									// 		$no3 = $subbag;
									// }elseif ($subbag_posisi == 4) {
									// 		$no4 = $subbag;
									// }elseif ($subbag_posisi == 5) {
									// 		$no5 = $subbag;
									// }elseif ($subbag_posisi == 6) {
									// 		$no6 = $subbag;
									// }
									//
									// //5
									// if ($bln_posisi == 1) {
									// 		$no1 = $bln;
									// }elseif ($bln_posisi == 2) {
									// 		$no2 = $bln;
									// }elseif ($bln_posisi == 3) {
									// 		$no3 = $bln;
									// }elseif ($bln_posisi == 4) {
									// 		$no4 = $bln;
									// }elseif ($bln_posisi == 5) {
									// 		$no5 = $bln;
									// }elseif ($bln_posisi == 6) {
									// 		$no6 = $bln;
									// }
									//
									// //6
									// if ($thn_posisi == 1) {
									// 		$no1 = $thn;
									// }elseif ($thn_posisi == 2) {
									// 		$no2 = $thn;
									// }elseif ($thn_posisi == 3) {
									// 		$no3 = $thn;
									// }elseif ($thn_posisi == 4) {
									// 		$no4 = $thn;
									// }elseif ($thn_posisi == 5) {
									// 		$no5 = $thn;
									// }elseif ($thn_posisi == 6) {
									// 		$no6 = $thn;
									// }
									//
									// if ($no1 != '') {
									// 		if ($no2 != '') {
									// 				$no1 = "$no1$separator";
									// 		}else{
									// 				$no1 = "$no1";
									// 		}
									// }
									// if ($no2 != '') {
									// 		if ($no3 != '') {
									// 				$no2 = "$no2$separator";
									// 		}else{
									// 				$no2 = "$no2";
									// 		}
									// }
									// if ($no3 != '') {
									// 		if ($no4 != '') {
									// 				$no3 = "$no3$separator";
									// 		}else{
									// 				$no3 = "$no3";
									// 		}
									// }
									// if ($no4 != '') {
									// 		if ($no5 != '') {
									// 				$no4 = "$no4$separator";
									// 		}else{
									// 				$no4 = "$no4";
									// 		}
									// }
									// if ($no5 != '') {
									// 		if ($no6 != '') {
									// 				$no5 = "$no5$separator";
									// 		}else{
									// 				$no5 = "$no5";
									// 		}
									// }
									//
									//
									// if ($prefix_posisi == "kiri") {
									// 		$p_kiri  = "$prefix$separator";
									// 		$p_kanan = '';
									// }else{
									// 		$p_kiri  = '';
									// 		$p_kanan = "$separator$prefix";
									// }
									//
									//
									// $no_surat = "$p_kiri$no1$no2$no3$no4$no5$no6$p_kanan";

									// $data2 = array(
									// 	'no'		   	 => $no,
									// 	'no_surat'	 => $no_surat
									// );
									// $this->Mcrud->update_ns(array('no_surat' => "$ns"), $data2);
								}

								$nama   = $this->upload->data('file_name');
								$ukuran = $this->upload->data('file_size');

								$this->db->insert('tbl_lampiran',array('nama_berkas'=>$nama,'ukuran'=>$ukuran,'token_lampiran'=>"$token"));

						}
					}

					if (isset($_POST['btnupdate'])) {
						$tgl_ns   	 	= htmlentities(strip_tags($this->input->post('tgl_ns')));
						$bagian   		= htmlentities(strip_tags($this->input->post('bagian')));
						$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));
						$kode   	 	= htmlentities(strip_tags($this->input->post('kode')));
						$tipe   	 	= htmlentities(strip_tags($this->input->post('tipe_surat')));

								$data = array(
									'tgl_ns'		   	 => $tgl_ns,
									'kode_surat'	 	 => $kode,
									'tipe_surat'	 	 => $tipe,
									'id_bagian'	 		 => $bagian,
									'perihal'		   	 => $perihal
								);
								$this->Mcrud->update_sk(array('id_sk' => $id), $data);
								$this->Mcrud->insertlog($id_user,'SURAT KELUAR: Edit ID: '.$id.'');
									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Surat Keluar berhasil diupdate.
										</div>'
									);
									redirect('users/sk');
					}

		}
	}


	public function memo($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			// if ($data['user']->row()->level == 'admin') {
			// 		redirect('404_content');
			// }

			/*$this->db->join('tbl_user', 'tbl_memo.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
				$this->db->where('tbl_memo.id_user', "$id_user");
			}
			$this->db->order_by('tbl_memo.judul_memo', 'ASC');
			$data['memo'] 		  = $this->db->get("tbl_memo");*/
			$data['memo_m'] 	= $this->Mcrud->get_memo_m_by_id($id_user);
			$data['memo_k'] 	= $this->Mcrud->get_memo_k_by_id($id_user);
			
				if ($aksi == 'mm') {
					$p = "mm";
					$data['judul_web'] 	  = "Memo Masuk";
				}
				else if ($aksi == 'mk') {
					$p = "mk";
					$data['judul_web'] 	  = "Memo Keluar";
				}

				else if ($aksi == 'tme') {
					$p = "memo_tambah";
					/*if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}*/

					$data['judul_web'] 	  = "Tambah Memo";
				}elseif ($aksi == 'em') {
					$p = "memo_edit";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_memo", array('id_memo' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Edit Memo";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data memo.
								</div>'
							);

							redirect('users/memo');
					}

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_memo", array('id_memo' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Hapus Memo";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data memo.
								</div>'
							);
					}else {
							$this->Mcrud->delete_memo_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Memo berhasil dihapus.
								</div>'
							);
					}

					redirect('users/memo/mm');
				}else{
					$p = "memo";
					$data['judul_web'] 	  = "Memo";
					redirect('users/memo/mm');
					
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/memo/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$judul_memo   	 	= htmlentities(strip_tags($this->input->post('judul_memo')));
						$memo   	 				= htmlentities(strip_tags($this->input->post('memo')));
						$to_user_id   	 				= htmlentities(strip_tags($this->input->post('penerima')));

										$data = array(
											'judul_memo'	 => $judul_memo,
											'memo'				 => $memo,
											'id_user'		   => $id_user,
											'to_id_user'		=> $to_user_id,
											'time_memo'			=> date("Y-m-d H:i:s")
										);
										$this->Mcrud->save_memo($data);
										$this->Mcrud->insertlog($id_user,'MEMO: Tambah Memo ID: '.$this->db->insert_id().'');

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Memo berhasil ditambahkan.
											</div>'
										);

									redirect('users/memo/t');
					}

					if (isset($_POST['btnupdate'])) {
						$judul_memo   	 	= htmlentities(strip_tags($this->input->post('judul_memo')));
						$memo   	 				= htmlentities(strip_tags($this->input->post('memo')));
						$to_user_id   	 				= htmlentities(strip_tags($this->input->post('penerima')));

										$data = array(
											'judul_memo'	 => $judul_memo,
											'memo'				 => $memo,
											'id_user'		   => $id_user,
											'to_id_user'		=> $to_user_id 
										);
									$this->Mcrud->update_memo(array('id_memo' => $id), $data);
									$this->Mcrud->insertlog($id_user,'MEMO: Edit Memo ID: '.$id.'');

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Memo berhasil diupdate.
										</div>'
									);
									redirect('users/memo');
					}

		}
	}


	public function lap_sk()
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Keluar";

					$this->load->view('users/header', $data);
					$this->load->view('users/laporan/lap_sk', $data);
					$this->load->view('users/footer');

					if (isset($_POST['data_lap'])) {
						$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
						$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));
						
						$this->Mcrud->insertlog($id_user,'LAPORAN: Surat Keluar Submit: '.$tgl1.' - '.$tgl2);

						redirect("users/data_sk/$tgl1/$tgl2");
					}
		}

	}


	public function data_sk($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

						if ($tgl1 != '' AND $tgl2 != '') {
								$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");

								$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
								$data['judul_web'] = "Data Laporan Surat Keluar";
								$this->load->view('users/header', $data);
								$this->load->view('users/laporan/data_sk', $data);
								$this->load->view('users/footer', $data);

								if (isset($_POST['btncetak'])) {
									$this->Mcrud->insertlog($id_user,'LAPORAN: Surat Keluar Cetak '.$tgl1.' - '.$tgl2);
									redirect("users/cetak_sk/$tgl1/$tgl2");
								}

						}else{
								redirect('404_content');
						}

			}
	}


	public function cetak_sk($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

					if ($tgl1 != '' AND $tgl2 != '') {
							$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");

							$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
							$data['judul_web'] = "Data Laporan Surat Keluar";

							$this->load->view('users/laporan/cetak_sk', $data);

					}else{
							redirect('404_content');
					}

			}
	}


	public function lap_sm()
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Masuk";

					$this->load->view('users/header', $data);
					$this->load->view('users/laporan/lap_sm', $data);
					$this->load->view('users/footer');

					if (isset($_POST['data_lap'])) {
						$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
						$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));
						
						$this->Mcrud->insertlog($id_user,'LAPORAN: Surat Masuk Submit '.$tgl1.' - '.$tgl2);

						redirect("users/data_sm/$tgl1/$tgl2");
					}
		}

	}

	public function data_sm($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

						if ($tgl1 != '' AND $tgl2 != '') {
								$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE (tgl_sm BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");

								$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
								$data['judul_web'] = "Data Laporan Surat Masuk";
								$this->load->view('users/header', $data);
								$this->load->view('users/laporan/data_sm', $data);
								$this->load->view('users/footer', $data);

								if (isset($_POST['btncetak'])) {
									$this->Mcrud->insertlog($id_user,'LAPORAN: Surat Masuk Cetak '.$tgl1.' - '.$tgl2);
									redirect("users/cetak_sm/$tgl1/$tgl2");
								}

						}else{
								redirect('404_content');
						}

			}
	}

	public function cetak_sm($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

					if ($tgl1 != '' AND $tgl2 != '') {
							$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE (tgl_sm BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");

							$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
							$data['judul_web'] = "Data Laporan Surat Masuk";

							$this->load->view('users/laporan/cetak_sm', $data);

					}else{
							redirect('404_content');
					}

			}
	}
	
	public function log()
	{
		$ceks 	 = $this->session->userdata('eoffice@hana');
		$id_user = $this->session->userdata('id_eoffice@hana');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

						
								$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
								$data['judul_web'] 		= "Log";
								$data['logs']  		 = $this->Mcrud->get_log(NULL);
								$this->load->view('users/header', $data);
								$this->load->view('users/laporan/logs', $data);
								$this->load->view('users/footer', $data);
						

			}
	}


}
