<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('peserta_j')) {
	function peserta_j($idq,$idpeserta,$iddiklat){		
		//$ar = array(2,1,4);
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->from('diklat_evaluasi_a');
		//$ci->db->where_in('id_que',$arr);
		$ci->db->where('id_que',$idq);
		$ci->db->where('id_peserta',$idpeserta);
		$ci->db->where('id_diklat',$iddiklat);
		//$ci->db->order_by('id_q', 'desc');
		$query = $ci->db->get()->row();
		return $query;
	}
}
