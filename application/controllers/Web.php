<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	
	public function __construct()
  {
    parent::__construct();
	$this->load->helper('config_helper');
	//$this->load->library('curl');
  }
  
  public function coba(){
	    //echo oauth2();
		//$token = json_decode(oauth2());
		//echo $token->access_token;
		//echo ecurl('GET','penggunas/1');
		/*$hash = '{bcrypt}$2a$10$SNE4Vn01QmmFvAFr2FJ.X.xWEtFuiCQUtRnHRfahZjmLaycIGYn/C';

		if (password_verify('coba', $hash)) {
			echo 'Password is valid!';
		} else {
			echo 'Invalid password.';
		}*/
		//$this->config->load('config', TRUE);
		//$coba = $this->config->item('api_url', 'config');
		//echo $coba;
		echo '<br />';
		//$ceklogin = json_decode(ecurl('GET','modul'));
		//echo ecurl('GET','modul');
		//echo FCPATH;
		//phpinfo();
		if( ini_get('allow_url_fopen') ) {
			echo 'enable';
		}
		else {
			echo 'disabled';
		}
	}
  

	public function index()
	{
		$ceks = $this->session->userdata('nip');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			redirect('catalog');
		}
	}
	public function neural() {
		echo '['.json_decode(ecurl('get','facelogin'))->data[0].']';
	}

	public function login()
	{
		
		$ceks = $this->session->userdata('nip');
		if(isset($ceks)) {
			redirect('catalog');
		}else{
			$this->load->view('web/header');
			//$this->load->view('web/loginFace');
			$this->load->view('web/login');
			$this->load->view('web/footer');

				if (isset($_POST['btnlogin'])){
						if (isset($_POST['btnlogin'])) {
							$nip = htmlentities(strip_tags($_POST['nip']));
							$pass	= $_POST['password'];
							$facelogin = '';
							$logintype = 'Account';
						}
						 $ceklogin = json_decode(ecurl('POST','pengguna/login','nip='.$nip.'&password='.$pass));
						#die(print_r('>>'.$ceklogin->statusCode.'<'));

							$this->load->helper("string");
							$str = random_string("alnum", 16);
							$random_str = $this->input->ip_address()."-".$str;
							#die(print_r('>>'.$random_str.'<'));	
						 if($ceklogin->statusCode == 200) {	
								 $userData = array(
									'id_user' => $ceklogin->data->id,
									'nip' => $ceklogin->data->nip,
									'kewenangan' => $ceklogin->data->kewenangan,
									'kewenangan_id' => $ceklogin->data->kewenangan_id,
									'email' => $ceklogin->data->email,
									'nama' => $ceklogin->data->namaLengkap,
									'jabatan_organisasi' => $ceklogin->data->jabatan_organisasi,
									'jabatan_organisasi_id' => $ceklogin->data->jabatan_organisasi_id,
									'jabatan_organisasi_parent_id' => $ceklogin->data->jabatan_organisasi_parent_id,
									'login_etatausaha' => date('Ymd'),
									'trans_session' => $random_str
								  );
								
								$this->session->set_userdata($userData);
								

								date_default_timezone_set('Asia/Jakarta');
								$tgl = date('Y-m-d H:i:s');
								$data = array(
									'terakhir_login'		=> $tgl
									);
								insert_log('LOGIN: '.$logintype);
								redirect('web');
						 } else {
								$this->session->set_flashdata('msg',
									 '<div class="alert alert-warning alert-dismissible" role="alert">
										  <div class="d-flex">
											<div>
											  <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
											</div>
											<div>
											  <h4 class="alert-title">Gagal Login</h4>
											  <div class="text-muted">Salah Username atau Password.</div>
											</div>
										  </div>
										</div>'
								);
								redirect('web/login');
						 }
						
				}
		}
	}


	public function logout() {
	insert_log('LOGOUT');
    $this->session->sess_destroy();
	redirect('');
  }

	function error_not_found(){
		$this->load->view('404_content');
	}

}
