<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('sum_jpl')) {
	function sum_jpl($id){
		$mod_sel = explode(",", $id);
		$ci =& get_instance();
		$ci->load->database();	
		// query
		$ci->db->from('diklat_modul');
		$ci->db->where_in('id_mod',$mod_sel);
		$ci->db->order_by('id_mod', 'desc');
		$query = $ci->db->get();
		
		$modul_in = $query->result();
		$total=0;
		foreach($modul_in as $min) {
			$total+= $min->jpl;;
		}
		return $total;
	}
}

if (!function_exists('sum_peserta')) {
	function sum_peserta($id){
		$ci =& get_instance();
		$ci->load->database();	
		// query
		$ci->db->from('diklat_peserta');
		$ci->db->where('id_diklat',$id);
		$query = $ci->db->get()->num_rows();
		return $query;
	}
}


