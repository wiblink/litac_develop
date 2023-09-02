<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// --------------------- SOURCE DATA ---------------------------
// ---------------- GANTI DENGAN REST API ----------------------

if (!function_exists('getMenuFromUrl')) {	
	function getMenuFromUrl($url){
		$ci =& get_instance();
		$ci->load->library('session');
		
		$data = getDataDiklat('role',array('id_groupuser'=>$ci->session->userdata['groupid']));
		$found = false;
		if ($data){
			foreach($data as $row){
				if (strtolower($url) == strtolower($row['url'])){
					return $row;
					break;
				}
			}
		} 
		return null;
	}
}
	
if (!function_exists('getAkses')) {		
	function getAkses($proc,$url){
		$ci =& get_instance();
		$ci->load->library('session');
		
		$data = getDataDiklat('role',array('id_groupuser'=>'1'));
		$found = false;
		if ($data){
			foreach($data as $row){
				if (strtolower($url) == strtolower($row['url'])){
					$found = true;
					break;
				}
			}
			if ($found) return intval($row['o'.$proc]);
			else return false;
		}else return false;
	}
}

if (!function_exists('getDataDiklat')) {	
	function getDataDiklat ($namadata,$refdata = null) {
		$ci =& get_instance();
		$ci->load->helper('config_helper');
		$ci->load->library('session');
		
		$str = $namadata.'?';
		if ($refdata){
			if(in_array('userid',array_keys($refdata))){
				$str .= '&userid='.$refdata['userid'];
			}else{
				$str .= '&userid='.$ci->session->userdata['id_user'];
			}
			if(in_array('userid',array_keys($refdata))){
				$str .= '&groupid='.$refdata['groupid'];
			}else{
				$str .= '&groupid='.$ci->session->userdata['groupid'];
			}
		}else{
			$str .= 'userid='.$ci->session->userdata['id_user'].'&groupid='.$ci->session->userdata['groupid'] ;
		}
		
		
		//$str = $namadata.'?userid='.$ci->session->userdata['id_user'].'&groupid='.$ci->session->userdata['groupid'] ;

		if (is_array($refdata)){
			foreach($refdata as $k=> $v){
				$str .= "&".$k."=".urldecode(htmlspecialchars_decode($v));
			}						
		}		
		$hasil = json_decode(ecurl('GET', $str ),true);
		if ($hasil){
			if(in_array('statusCode',array_keys($hasil))){
				if ($hasil['statusCode'] == 200){
					$data = $hasil['data'];
				}else $data = array();
			}else $data = array();
		}else $data = array();
		return $data;
	}
}

if (!function_exists('Simpan_data')) {	
	function Simpan_data ($endpoint,$data) {
		$ci =& get_instance();
		$ci->load->helper('config_helper');
		$ci->load->library('session');
		
		insert_log('DIKLAT: TAMBAH '.$endpoint);
		$data['userid'] = $ci->session->userdata['id_user'];
		$data['groupid'] = $ci->session->userdata['groupid'];

		$hasil = json_decode(ecurl('POST', $endpoint,http_build_query($data) ),true);
		return $hasil;
	}
}
if (!function_exists('Update_data')) {	
	function Update_data ($endpoint,$data,$id) {
		$ci =& get_instance();
		$ci->load->helper('config_helper');
		$ci->load->library('session');
		
		insert_log('DIKLAT: UPDATE '.$endpoint);
		$data['userid'] = $ci->session->userdata['id_user'];
		$data['groupid'] = $ci->session->userdata['groupid'];
		$data['id'] = $id;
		$hasil = json_decode(ecurl('PUT',$endpoint,http_build_query($data)),true);
		return $hasil;
	}
}
if (!function_exists('Delete_data')) {	
	function Delete_data ($endpoint,$id) {
		$ci =& get_instance();
		$ci->load->helper('config_helper');
		$ci->load->library('session');
		
		insert_log('DIKLAT: DELETE '.$endpoint);
		$data= array();
		$data['userid'] = $ci->session->userdata['id_user'];
		$data['groupid'] = $ci->session->userdata['groupid'];
		$data['id'] = $id;

		$hasil = json_decode(ecurl('DELETE',$endpoint,http_build_query($data)),true);  //
		return $hasil;
		
	}
}

