<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function oauth2($username,$password){
	$ci =& get_instance();
	$ci->config->load('config', TRUE);
	$url_oauth2 = $ci->config->item('oauth2_url', 'config');
	$grand_type = 'password';
	$scope = 'read write';
	$auth = base64_encode("web-sisjaksa-client-id:kadalijo");
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_URL => $url_oauth2,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "grant_type=$grand_type&username=$username&password=$password&scope=$scope",
		CURLOPT_HTTPHEADER => array(
		"Authorization: Basic $auth",
		"Content-Type: application/x-www-form-urlencoded"
		),
	));
	$response = curl_exec($curl);
	if(curl_error($curl))
	{
		echo 'error:' . curl_error($curl);
	}
	curl_close($curl);	
	$token = json_decode($response);
	return $token->access_token;
}


if (!function_exists('ecurl')) {
	function ecurl($method,$url,$array=''){
		$ci =& get_instance();
		$ci->config->load('config', TRUE);
		$url_api = $ci->config->item('api_url', 'config');
		$ci->load->library('session');
		//$token = $ci->session->userdata['token'];
		$token = 'token';
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_SSL_VERIFYHOST => false,
		  CURLOPT_URL => $url_api."".$url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $method,
		  CURLOPT_POSTFIELDS => $array,
		  CURLOPT_HTTPHEADER => array(
			/*"Authorization: Bearer $token",*/
			"Content-Type: application/x-www-form-urlencoded"
			),
		));
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
	}
}

if (!function_exists('configx')) {
	function configx(){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, base_url().'assets/config_theme.txt');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
		$output = curl_exec($ch); 
		curl_close($ch);
		return $output;
	}
}

if (!function_exists('bgx')) {
	function bgx(){
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, base_url().'assets/config_bg.txt');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
		$output = curl_exec($ch); 
		curl_close($ch);
		return $output;
	}
}

if (!function_exists('insert_log')) {
	function insert_log($note){
		$ci =& get_instance();
		$actionlog = array(
			'user_id'		=> $ci->session->userdata('id_user'),
			'ipadd'			=> $ci->input->ip_address(),
			'browser'		=> $ci->agent->browser(),
			'browser_version' => $ci->agent->version(),
			'os'			  => $ci->agent->platform(),
			'logtime'		  => date("Y-m-d H:i:s"),
			'logdetail'		  => $note
		);

		ecurl('POST','logs',http_build_query($actionlog));
	}
}

if (!function_exists('ver')) {
	function ver(){
		$ci =& get_instance();
		$ci->config->load('config', TRUE);
		$ver = $ci->config->item('app_version', 'config');
		return $ver;
	}
}

if (!function_exists('notifikasi')) {
	function notifikasi(){
		$ci =& get_instance();
			return json_decode(ecurl('GET','notifikasi/'.$ci->session->userdata('id_user')))->data;
		
	}
	/* function notifikasi(){
		$ci =& get_instance();
		if($ci->session->userdata('kewenangan') != 'admin' or $ci->session->userdata('kewenangan_id') != 1) {
			return json_decode(ecurl('GET','notifikasi/'.$ci->session->userdata('id_user')))->data;
		}
		else {
			return json_decode(ecurl('GET','notifikasi/admin/'.$ci->session->userdata('id_user')))->data;
		}		
	} */
}

if (!function_exists('showMessage')) {	
	function showMessage($title,$info,$type = 'warning'){
		$ci =& get_instance();
		$ci->load->library('session');		
		$ci->session->set_flashdata('msg',$type.'#'.$title.'#'.$info);
	}	
}

/* if (!function_exists('getMenu')) {
	function getMenu($currgroup,$curmenu){
		$ci =& get_instance();
		$ci->config->load('config', TRUE);
		$ci->load->library('session');
		$ci->load->helper('data_helper');
		
		$data = getDataDiklat('role',array('id_groupuser'=>$ci->session->userdata['groupid']));       
		//aasort($data, "group");
		$tmp = "";
		$htm = "";
		$hasul = false;
		foreach($data as $row){
			if ($row['oread'] && $row['showinpanel']){
				$type_count = 0;
				$namamenu = $row['menu'];
				
				foreach($data as $v) {
					if($v['group'] == $row['group']){
						$type_count++;
					}
				}
				
				if (strpos($row['url'],"/")){
					$key = substr($row['url'],strpos($row['url'],"/")+1);
					
					$statusdata = getDataDiklat("status",array('id_user'=>$ci->session->userdata['id_user'],'jenis'=>"'".$key."'",'status'=>0));
					if ($statusdata) $str = '<span class="pull-right" style="margin-right:-10px;"><small class="label label-primary notif-small">'.count($statusdata).'</small></span>';
					else $str = '';
				}else{
					$str = '';
				}
				
				if ($tmp != $row["group"]){ 
					if ($tmp != "" && $hasul) $htm .= "</ul></li>";
					//<span class="fa-stack"><i class="fa fa-square fa-stack-2x" style="color: #00923F"></i>***fa-stack-1x fa-inverse****</span>
					//<span class="fa-stack"><i class="fa fa-square fa-stack-2x" style="color: #00923F"></i>****</span>
					if ($type_count == 1){
						$htm .= '<li class="'.(strpos(strtolower($row["url"]),strtolower($currgroup)) ? 'active' : '').'">
								<a href="'.$row['url'].'"><i style="color: #00923F;" class="fa fa-'.$row["icon"].'" aria-hidden="true"></i><span style="margin-left :10px;" >'.$namamenu.'</span>'.$str.'</a></li>';
						$hasul = false;
					}else{
						if ($ci->session->userdata['groupid'] == 1){
							$strg = '<span class="pull-right mr-5"><small class="lblsaveorder label label-primary notif-small"><i style="color: #FFFFFF" class="fa fa-hdd-o" aria-hidden="true"></i></small></span>';
						}else{
							$strg = '';
						}
						$htm .= '<li class="'.(strpos(strtolower($row["url"]),strtolower($currgroup)) ? 'active' : '').'">
							<a href="#"><i style="color: #00923F;" class="fa fa-'.$row["icon"].'" aria-hidden="true"></i><span style="margin-left :10px;">'.$row['group'].$strg.'</span></a>
							<ul><li id="menu-'.$row["id_menu"].'" class="'.(strpos(strtolower($row["url"]),strtolower('/'.$curmenu)) ? 'active' : '').'"><a href="'.$row['url'].'"><i class="fa fa-'.$row["icon"].'" aria-hidden="true"></i>'.$namamenu.$str.'</a></li>';
					
						$hasul = true;
					}
				}else{
					$htm .= '<li id="menu-'.$row["id_menu"].'" class="'.(strpos(strtolower($row["url"]),strtolower('/'.$curmenu)) ? 'active' : '').'"><a href="'.$row['url'].'"><i class="fa fa-'.$row["icon"].'" aria-hidden="true"></i>'.$namamenu.$str.'</a></li>';
				}	
				$tmp = $row["group"];
			}
		}		
		if ($hasul) $htm .= "</ul></li>";

		return $htm;
	}
} */