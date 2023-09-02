<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// --------------------- SOURCE DATA ---------------------------
// ---------------- GANTI DENGAN REST API ----------------------

if (!function_exists('Menu_data')) {	
	function Menu_data () {
		$ci =& get_instance();
		$ci->load->helper('config_helper');
		$ci->load->library('session');
		
		$data['userid'] = $ci->session->userdata['id_user'];
		$data['groupid'] = $ci->session->userdata['groupid'];

		//$hasil = json_decode(ecurl('POST', $endpoint,http_build_query($data) ),true);
		$hasil = json_decode(ecurl('GET' ,'menu'))->data;
		return $hasil;
	}
}
