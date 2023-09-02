<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dcrud extends CI_Model {

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
	
	var $tbl_diklat_ps			 	 = 'diklat_peserta';
	var $tbl_diklat_py			 	 = 'diklat_penyelenggara';
	var $tbl_diklat_wd			 	 = 'diklat_widyaiswara';
	var $tbl_diklat_th			 	 = 'diklat_tahun';
	var $tbl_diklat_ak			 	 = 'diklat_angkatan';
	var $tbl_diklat_dk			 	 = 'diklat_diklat';
	var $tbl_diklat_kel			 	 = 'diklat_kel_diklat';
	var $tbl_diklat_mod			 	 = 'diklat_modul';
	var $tbl_diklat_mdk			 	 = 'diklat_master_diklat';
	
	var $tbl_diklat_eva_q		 	 = 'diklat_evaluasi_q';
	var $tbl_diklat_eva_a		 	 = 'diklat_evaluasi_a';
	var $tbl_diklat_eva_asg			 = 'diklat_evaluasi_asg';
	
	// Peserta
	public function get_peserta()
	{
			$this->db->select($this->tbl_diklat_ps.'.*,b.name_dk_m as ndiklat');
			$this->db->from($this->tbl_diklat_ps);
			$this->db->join($this->tbl_diklat_dk.' a', 'a.id_dk='.$this->tbl_diklat_ps.'.id_diklat');
			$this->db->join($this->tbl_diklat_mdk.' b', 'b.id_dk_m=a.id_dk_master');
			$this->db->order_by('id_ps', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_peserta_id($id)
	{
			$this->db->from($this->tbl_diklat_ps);
			$this->db->where('id_ps', $id);
			$query = $this->db->get();
			return $query;
	}
	public function where_peserta_id_detail($id)
	{
			$this->db->select($this->tbl_diklat_ps.'.*,b.name_dk_m as ndiklat');
			$this->db->from($this->tbl_diklat_ps);
			$this->db->join($this->tbl_diklat_dk.' a', 'a.id_dk='.$this->tbl_diklat_ps.'.id_diklat');
			$this->db->join($this->tbl_diklat_mdk.' b', 'b.id_dk_m=a.id_dk_master');
			$this->db->where('id_ps', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_peserta($where, $data)
	{
		$this->db->update($this->tbl_diklat_ps, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Penyelenggara
	public function get_penyelenggara()
	{
			$this->db->from($this->tbl_diklat_py);
			$this->db->order_by('id_py', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_penyelenggara_id($id)
	{
			$this->db->from($this->tbl_diklat_py);
			$this->db->where('id_py', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_penyelenggara($where, $data)
	{
		$this->db->update($this->tbl_diklat_py, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Widyaiswara
	public function get_widyaiswara()
	{
			$this->db->from($this->tbl_diklat_wd);
			$this->db->order_by('id_wd', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_widyaiswara_id($id)
	{
			$this->db->from($this->tbl_diklat_wd);
			$this->db->where('id_wd', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_widyaiswara($where, $data)
	{
		$this->db->update($this->tbl_diklat_wd, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Master Diklat
	public function get_mstdiklat()
	{
			$this->db->from($this->tbl_diklat_mdk);
			$this->db->order_by('id_dk_m', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_mstdiklat_id($id)
	{
			$this->db->from($this->tbl_diklat_mdk);
			$this->db->where('id_dk_m', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_mstdiklat($where, $data)
	{
		$this->db->update($this->tbl_diklat_mdk, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Tahun
	public function get_tahun()
	{
			$this->db->from($this->tbl_diklat_th);
			$this->db->order_by('id_th', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_tahun_id($id)
	{
			$this->db->from($this->tbl_diklat_th);
			$this->db->where('id_th', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_tahun($where, $data)
	{
		$this->db->update($this->tbl_diklat_th, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Angkatan
	public function get_angkatan()
	{
			$this->db->from($this->tbl_diklat_ak);
			$this->db->order_by('id_ak', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_angkatan_id($id)
	{
			$this->db->from($this->tbl_diklat_ak);
			$this->db->where('id_ak', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_angkatan($where, $data)
	{
		$this->db->update($this->tbl_diklat_ak, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Evaluasi - Kuesioner
	public function get_kuesioner()
	{
			$this->db->from($this->tbl_diklat_eva_q);
			$this->db->order_by('id_q', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_evaq_id($id)
	{
			$this->db->from($this->tbl_diklat_eva_q);
			$this->db->where('id_q', $id);
			$query = $this->db->get();
			return $query;
	}
	
	public function update_evaq_id($where, $data)
	{
		$this->db->update($this->tbl_diklat_eva_q, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function update_eva_asg_id($where, $data)
	{
		$this->db->update($this->tbl_diklat_eva_asg, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function where_evaasg_id($id)
	{
			$this->db->from($this->tbl_diklat_eva_asg);
			$this->db->where('id_asg', $id);
			$query = $this->db->get();
			return $query;
	}
	
	public function get_dkuesioner()
	{
			$this->db->select($this->tbl_diklat_eva_asg.'.*,b.name_dk_m as ndiklat');
			$this->db->from($this->tbl_diklat_eva_asg);
			$this->db->join($this->tbl_diklat_dk.' a', 'a.id_dk='.$this->tbl_diklat_eva_asg.'.id_diklat');
			$this->db->join($this->tbl_diklat_mdk.' b', 'b.id_dk_m=a.id_dk_master');
			$this->db->order_by('id_asg', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function get_que_where_in($arr)
	{
			$this->db->from($this->tbl_diklat_eva_q);
			$this->db->where_in('id_q',$arr);
			$this->db->order_by('id_q', 'desc');
			$query = $this->db->get();
			return $query;
	}
	public function get_que_where_not_in($arr)
	{
			$this->db->from($this->tbl_diklat_eva_q);
			$this->db->where_not_in('id_q',$arr);
			$this->db->order_by('id_q', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function get_nilaiq($arr,$id_dk)
	{
			//$this->db->select($this->tbl_diklat_eva_q.'.*,sum(a.jawaban_a) as nilai,count(a.jawaban_a) as total'); SQL MODE Case
			$this->db->select('sum(a.jawaban_a) as nilai,count(a.jawaban_a) as total, max('.$this->tbl_diklat_eva_q.'.judul_q) as judul');
			$this->db->from($this->tbl_diklat_eva_q);
			$this->db->join($this->tbl_diklat_eva_a.' a', 'a.id_que='.$this->tbl_diklat_eva_q.'.id_q');
			$this->db->where_in('id_q',$arr);
			$this->db->where('a.id_diklat', $id_dk);
			$this->db->group_by($this->tbl_diklat_eva_q.'.id_q');
			$this->db->order_by('id_q', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function totalpesertaq($id_dk)
	{
			//$this->db->select('COUNT(*) as total, a.id_peserta, b.name_ps as nama_peserta'); SQL MODE Case
			$this->db->select('COUNT(*) as total, a.id_peserta, max(b.name_ps) as nama_peserta');
			$this->db->from($this->tbl_diklat_eva_a.' a');
			$this->db->join($this->tbl_diklat_ps.' b', 'b.id_ps=a.id_peserta');
			$this->db->where('a.id_diklat', $id_dk);
			$this->db->group_by('a.id_peserta');
			$query = $this->db->get();
			return $query;
	}
	
	public function get_que_peserta_where_in($arr,$idpeserta,$iddiklat)
	{
			$this->db->from($this->tbl_diklat_eva_a);
			$this->db->where_in('id_que',$arr);
			$this->db->where('id_peserta',$idpeserta);
			$this->db->where('id_diklat',$iddiklat);
			//$this->db->order_by('id_q', 'desc');
			$query = $this->db->get();
			return $query;
	}
	 
	
	
	
	// Kelompok Diklat
	public function get_keldik()
	{
			$this->db->from($this->tbl_diklat_kel);
			$this->db->order_by('id_kel', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_keldik_id($id)
	{
			$this->db->from($this->tbl_diklat_kel);
			$this->db->where('id_kel', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_keldik($where, $data)
	{
		$this->db->update($this->tbl_diklat_kel, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Modul
	public function get_modul()
	{
			$this->db->select($this->tbl_diklat_mod.'.*,a.name_wd as widya');
			$this->db->from($this->tbl_diklat_mod);
			$this->db->join($this->tbl_diklat_wd.' a', 'a.id_wd='.$this->tbl_diklat_mod.'.id_wd');
			$this->db->order_by('id_mod', 'desc');
			$query = $this->db->get();
			return $query;
	}
	
	public function where_modul_id($id)
	{
			$this->db->from($this->tbl_diklat_mod);
			$this->db->where('id_mod', $id);
			$query = $this->db->get();
			return $query;
	}
	public function get_modul_where_in($arr)
	{
			$this->db->from($this->tbl_diklat_mod);
			$this->db->where_in('id_mod',$arr);
			$this->db->order_by('id_mod', 'desc');
			$query = $this->db->get();
			return $query;
	}
	public function get_modul_where_not_in($arr)
	{
			$this->db->from($this->tbl_diklat_mod);
			$this->db->where_not_in('id_mod',$arr);
			$this->db->order_by('id_mod', 'desc');
			$query = $this->db->get();
			return $query;
	}
	public function where_modul_by_id($id)
	{
			$this->db->select($this->tbl_diklat_mod.'.*,a.name_wd as widya');
			$this->db->from($this->tbl_diklat_mod);
			$this->db->join($this->tbl_diklat_wd.' a', 'a.id_wd='.$this->tbl_diklat_mod.'.id_wd');
			$this->db->where('id_mod', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_modul($where, $data)
	{
		$this->db->update($this->tbl_diklat_mod, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Diklat
	public function get_diklat($id='')
	{
			$this->db->select($this->tbl_diklat_dk.'.*,a.name_ak as angkatan,b.tahun_th as tahun,c.name_py as penyelenggara,d.name_kel as kelompok,e.name_dk_m as ndiklat');
			$this->db->from($this->tbl_diklat_dk);
			$this->db->order_by('id_dk', 'desc');
			$this->db->join($this->tbl_diklat_ak.' a', 'a.id_ak='.$this->tbl_diklat_dk.'.id_angkatan');
			$this->db->join($this->tbl_diklat_th.' b', 'b.id_th='.$this->tbl_diklat_dk.'.id_tahun');
			$this->db->join($this->tbl_diklat_py.' c', 'c.id_py='.$this->tbl_diklat_dk.'.id_penyelenggara');
			$this->db->join($this->tbl_diklat_kel.' d', 'd.id_kel='.$this->tbl_diklat_dk.'.id_kel_diklat');
			$this->db->join($this->tbl_diklat_mdk.' e', 'e.id_dk_m='.$this->tbl_diklat_dk.'.id_dk_master');
			if ($id != NULL) {
				$this->db->where('id_dk', $id);
			}
			$query = $this->db->get();
			return $query;
	}
	
	public function where_diklat_id($id)
	{
			$this->db->select($this->tbl_diklat_dk.'.*,a.name_dk_m as ndiklat');
			$this->db->from($this->tbl_diklat_dk);
			$this->db->join($this->tbl_diklat_mdk.' a', 'a.id_dk_m='.$this->tbl_diklat_dk.'.id_dk_master');
			$this->db->where('id_dk', $id);
			$query = $this->db->get();
			return $query;
	}
	public function update_diklat($where, $data)
	{
		$this->db->update($this->tbl_diklat_dk, $data, $where);
		return $this->db->affected_rows();
	}
	
	// Common
	public function save_common($data,$table)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	public function del_common($id,$field,$table)
	{
		$this->db->where($field, $id);
		$this->db->delete($table);
	}
	public function save_b4_del($id,$idsel,$fromtable,$totable)
	{
		$sql = "INSERT INTO $totable SELECT * FROM $fromtable WHERE $idsel ='$id'";
		//$sql = "SELECT * INTO $totable FROM $fromtable WHERE id_mod = $id";    
		$query = $this->db->query($sql);
	}
	
	public function get_where_common($where,$table)
    {
		  $query = $this->db
			->where($where)
			->get($table);
		  return $query;
    }
	public function get_like_common($like,$table)
    {
		$this->db->from($table);
		$this->db->like($like);
		$query = $this->db->get();
		return $query;
    }



}
