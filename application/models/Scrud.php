<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrud extends CI_Model {

	var $tbl_users				 = 'tbl_user';
	var $tbl_bagian		 		 = 'tbl_bagian';
	var $tbl_ns		 				 = 'tbl_ns';
	var $tbl_sm		 				 = 'tbl_sm';
	var $tbl_sk		 				 = 'tbl_sk';
	var $tbl_memo	 				 = 'tbl_memo';
	var $tbl_kode_surat	 			 = 'tbl_kode_surat';
	var $tbl_tipe_surat	 			 = 'tbl_tipe_surat';
	var $tbl_pengaturan 			 = 'tbl_pengaturan';
	var $tbl_log			 		 = 'tbl_log';
	
	var $soal_bank			 		 = 'soal_bank';
	var $soal_ujian		 			 = 'soal_ujian';
	var $soal_jawab	 			 	 = 'soal_jawab';
	
	public function get_ujian($id)
	{
			$this->db->from($this->soal_ujian);
			$this->db->where('id_u',$id);
			$query = $this->db->get();

			return $query;
	}
	public function get_soal($ids)
	{
			$this->db->from($this->soal_bank);
			$this->db->where_in('id_p', $ids);
			$query = $this->db->get();

			return $query;
	}
	
	public function insert_jaw($id_siswa,$id_soal,$jaw)
		{
			$data = array(
					'id_siswa'		=> $id_siswa,
					'id_soal'		=> $id_soal,
					'jawab'		=> $jaw
			);
			$this->db->insert($this->soal_jawab, $data);					
		}
	
	
	//Sent mail
			public function sent_mail($username, $email, $aksi)
			{
				$email_saya = "";
				$pass_saya  = "";

				//konfigurasi email
				$config = array();
				$config['charset'] = 'utf-8';
				$config['useragent'] = 'jkp.ordodev.com';
				$config['protocol']= "smtp";
				$config['mailtype']= "html";
				$config['smtp_host']= "ssl://smtp.gmail.com";
				$config['smtp_port']= "465";
				$config['smtp_timeout']= "465";
				$config['smtp_user']= "$email_saya";
				$config['smtp_pass']= "$pass_saya";
				$config['crlf']="\r\n";
				$config['newline']="\r\n";

				$config['wordwrap'] = TRUE;
				//memanggil library email dan set konfigurasi untuk pengiriman email

				$this->email->initialize($config);
				//$ipaddress = get_real_ip(); //untuk mendeteksi alamat IP

				date_default_timezone_set('Asia/Jakarta');
				$waktu 	  = date('Y-m-d H:i:s');
				$tgl 			= date('Y-m-d');

				$id = md5("$email * $tgl");

				if ($aksi == 'reg') {
						$link			= base_url().'web/verify';
						$pesan    = "Hello $username,
													<br /><br />
													Welcome to Jam Kerja Proyek!<br/>
													Untuk melengkapi pendaftaran Anda, silahkan klik link berikut<br/>
													<br /><br />
													<b><a href='$link/$id/$username'>Klik Aktivasi disini :)</a></b>
													<br /><br />
													Terimakasih ^_^,
													";
						$subject = 'Aktivasi Akun | JKP';

				}elseif ($aksi == 'lp') {
						$link			= base_url().'web/konfirm_pass';
						$pesan    = "Hello $username,
													<br /><br />
													Welcome to Jam Kerja Proyek!<br/>
													Untuk membuat password baru, silahkan klik link berikut<br/>
													<br /><br />
													<b><a href='$link/$id/$username'>Klik disini untuk merubah Password baru :)</a></b>
													<br /><br />
													Terimakasih ^_^,
													";
						 $subject = 'Lupa Password | JKP';
				}

				$this->email->from("$email_saya");
				$this->email->to("$email");
				$this->email->subject($subject);
				$this->email->message($pesan);
			}
	//End Sent mail
	
	public function get_atur($id)
	{
			$this->db->from($this->tbl_pengaturan);
			$this->db->where('id_atur',$id);
			$query = $this->db->get();

			return $query;
	}
	
	public function insertlog($user_id,$note)
		{
			$browser = $this->agent->browser();
			$browser_version = $this->agent->version();
			$os = $this->agent->platform();
			$actionlog = array(
					'user_id'		=> $user_id,
					'ipadd'			=> $this->input->ip_address(),
					'browser'		=> $browser,
					'browser_version'		=> $browser_version,
					'os'		=> $os,
					'logtime'		=> date("Y-m-d H:i:s"),
					'logdetail'		=> $note
			);
			$this->db->insert($this->tbl_log, $actionlog);					
		}
	
	
	public function get_users_dash($jum)
	{
			$this->db->from($this->tbl_users);
			if ($jum != NULL) {
					$this->db->limit($jum);
				}
			$query = $this->db->get();

			return $query;
	}
	
	public function get_users()
	{
			$this->db->from($this->tbl_users);
			$query = $this->db->get();

			return $query;
	}

	public function get_users_daftar()
	{
			$this->db->from($this->tbl_users);
			$this->db->where('status','terdaftar');
			$query = $this->db->get();

			return $query;
	}

	public function get_level_users()
	{
			$this->db->from($this->tbl_users);
			// $this->db->where('tbl_user.level', 'user');
			$query = $this->db->get();

			return $query;
	}

	public function get_users_by_un($id)
	{
				$this->db->from($this->tbl_users);
				$this->db->where('username',$id);
				$query = $this->db->get();

				return $query;
	}
	
	public function get_users_by_id($id)
	{
				$this->db->from($this->tbl_users);
				$this->db->where('id_user',$id);
				$query = $this->db->get();

				return $query;
	}

	public function get_level_users_by_id($id)
	{
			$this->db->from($this->tbl_users);
			$this->db->where('tbl_user.level', 'user');
			$this->db->where('tbl_user.id_user', $id);
			$query = $this->db->get();

			return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}
	
	public function update_atur($where, $data)
	{
		$this->db->update($this->tbl_pengaturan, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function save_tipe($data)
	{
		$this->db->insert($this->tbl_tipe_surat, $data);
		return $this->db->insert_id();
	}
	
	public function update_tipe($where, $data)
	{
		$this->db->update($this->tbl_tipe_surat, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_tipe_by_id($id)
	{
		$this->db->where('id_ts', $id);
		$this->db->delete($this->tbl_tipe_surat);
	}


	public function save_bagian($data)
	{
		$this->db->insert($this->tbl_bagian, $data);
		return $this->db->insert_id();
	}

	public function update_bagian($where, $data)
	{
		$this->db->update($this->tbl_bagian, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_bagian_by_id($id)
	{
		$this->db->where('id_bagian', $id);
		$this->db->delete($this->tbl_bagian);
	}
	
	public function delete_kode_by_id($id)
	{
		$this->db->where('id_kode', $id);
		$this->db->delete($this->tbl_kode_surat);
	}
	
	public function update_kode($where, $data)
	{
		$this->db->update($this->tbl_kode_surat, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function save_kode($data)
	{
		$this->db->insert($this->tbl_kode_surat, $data);
		return $this->db->insert_id();
	}

	public function save_ns($data)
	{
		$this->db->insert($this->tbl_ns, $data);
		return $this->db->insert_id();
	}

	public function update_ns($where, $data)
	{
		$this->db->update($this->tbl_ns, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_ns_by_id($id)
	{
		$this->db->where('id_ns', $id);
		$this->db->delete($this->tbl_ns);
	}


	// get data dropdown
    function data_ns($aksi='', $id='')
    {
        // ambil data dari db
				if ($aksi != 'semua') {
					$this->db->where('jenis_ns', $aksi);
				}
				// $this->db->where('id_user', $id);
				$this->db->order_by('no_surat', 'asc');
				$query = $this->db->get('tbl_ns')->result();

        return $query;
    }

	public function save_sm($data)
	{
		$this->db->insert($this->tbl_sm, $data);
		return $this->db->insert_id();
	}

	public function update_sm($where, $data)
	{
		$this->db->update($this->tbl_sm, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_sm_by_id($id)
	{
		$this->db->where('id_sm', $id);
		$this->db->delete($this->tbl_sm);
	}
	
	public function get_sm_join($id)
	{		
			$this->db->select('tbl_sm.*,tbl_kode_surat.no_kode,tbl_kode_surat.name_kode,a.nama_lengkap as npengirim,b.nama_lengkap as npenerima');
			$this->db->from($this->tbl_sm);
			$this->db->join('tbl_kode_surat', 'tbl_kode_surat.id_kode=tbl_sm.kode_surat');
			$this->db->join('tbl_user a', 'a.id_user=tbl_sm.pengirim');
			$this->db->join('tbl_user b', 'b.id_user=tbl_sm.penerima');
			if ($id != NULL) {
				$this->db->where('id_sm', $id);
			}
			$query = $this->db->get();
			return $query;
	}
	
	public function get_sk_join($id)
	{		
			$this->db->select('tbl_sk.*,tbl_kode_surat.no_kode,tbl_kode_surat.name_kode,a.nama_lengkap as npengirim,b.nama_lengkap as npenerima,tbl_bagian.nama_bagian,tbl_tipe_surat.id_ts,tbl_tipe_surat.name_ts');
			$this->db->from($this->tbl_sk);
			$this->db->join('tbl_kode_surat', 'tbl_kode_surat.id_kode=tbl_sk.kode_surat');
			$this->db->join('tbl_bagian', 'tbl_bagian.id_bagian=tbl_sk.id_bagian');
			$this->db->join('tbl_tipe_surat', 'tbl_tipe_surat.id_ts=tbl_sk.tipe_surat');
			$this->db->join('tbl_user a', 'a.id_user=tbl_sk.pengirim');
			$this->db->join('tbl_user b', 'b.id_user=tbl_sk.penerima');
			if ($id != NULL) {
				$this->db->where('id_sk', $id);
			}
			$query = $this->db->get();
			return $query;
	}


	public function delete_lampiran($id)
	{
		$this->db->where('token_lampiran', $id);
		$this->db->delete('tbl_lampiran');
	}


	public function save_sk($data)
	{
		$this->db->insert($this->tbl_sk, $data);
		return $this->db->insert_id();
	}

	public function update_sk($where, $data)
	{
		$this->db->update($this->tbl_sk, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_sk_by_id($id)
	{
		$this->db->where('id_sk', $id);
		$this->db->delete($this->tbl_sk);
	}

	public function save_memo($data)
	{
		$this->db->insert($this->tbl_memo, $data);
		return $this->db->insert_id();
	}

	public function update_memo($where, $data)
	{
		$this->db->update($this->tbl_memo, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_memo_by_id($id)
	{
		$this->db->where('id_memo', $id);
		$this->db->delete($this->tbl_memo);
	}
	public function get_log($jum)
	{
				$this->db->select('tbl_log.*,tbl_user.username,tbl_user.nama_lengkap');
				$this->db->from($this->tbl_log);
				$this->db->join('tbl_user', 'tbl_user.id_user=tbl_log.user_id');
				//$this->db->where('username',$id);
				$this->db->order_by('id_log', 'desc');
				if ($jum != NULL) {
					$this->db->limit($jum);
				}
				$query = $this->db->get();

				return $query;
	}
	
	public function get_browser_dash($month,$tot)
	{
		$logtime1 	= '2020-'.$month.'-01 00:00:01';
		$logtime2 	= '2020-'.$month.'-31 23:59:59';
		if ($tot == NULL) {
			return $this->db->query("SELECT count(browser) as tbrowser, user_id, browser FROM tbl_log WHERE (logtime BETWEEN '$logtime1' AND '$logtime2') GROUP BY browser ORDER BY id_log DESC");
		}
		else {
			return $this->db->query("SELECT user_id, browser FROM tbl_log WHERE (logtime BETWEEN '$logtime1' AND '$logtime2') ORDER BY id_log DESC");
		}
		
	}
	
	

}
