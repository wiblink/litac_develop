<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('notif_sm')) {
	function notif_sm(){
		$ci =& get_instance();
		$ci->load->database();	
		$ci->db->select('id_sm');
		$ci->db->where('dibaca','0');
		$query = $ci->db->get('tbl_sm');
		if ($query->num_rows() > 0) {
			//return '<span class="pull-right"><small class="label label-success">'.$query->num_rows().'</small></span>';
			return $query->num_rows();
		}
		else {
			return '0';
		}
	}
}

if (!function_exists('notif_sk')) {
	function notif_sk(){
		$ci =& get_instance();
		$ci->load->database();	
		$ci->db->select('id_sk');
		$ci->db->where('dibaca','0');
		$query = $ci->db->get('tbl_sk');
		if ($query->num_rows() > 0) {
			//return '<span class="pull-right"><small class="label label-success">'.$query->num_rows().'</small></span>';
			return $query->num_rows();
		}
		else {
			return '0';
		}
		
	}
}

if (!function_exists('notif_memo')) {
	function notif_memo($userid){
		$ci =& get_instance();
		$ci->load->database();	
		$ci->db->select('id_memo');
		$ci->db->where('dibaca','0');
		$ci->db->where('to_id_user',$userid);
		$query = $ci->db->get('tbl_memo');
		if ($query->num_rows() > 0) {
			//return '<span class="pull-right"><small class="label label-success">'.$query->num_rows().'</small></span>';
			return $query->num_rows();
		}
		else {
			return '0';
		}
		
	}
}

