<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ijazah_model extends CI_Model{
    private $end_point = "ijazah";
	private $fieldname = array('id', 'id_diklat', 'tgl_ijazah', 'id_user', 'created', 'createdby', 'modified', 'modifiedby');
	
	/*  linkfield for reference "menu" => "url" */
	private $linkfield = array(array('label'=>'Jadwal','url'=>'learning/jadwal','fieldvalue'=>'id_jadwal','fieldurl'=>'id'),
								array('label'=>'Materi','url'=>'learning/materi','fieldvalue'=>'id_materi','fieldurl'=>'id'),
							);
	private $template = '';
	private $refarray = null;
	private $refurl = '';
	private $modul = 'ijazah';
	
	private $ci = null;
	private $allbase = "";
	private $base = "";
	private $tmpl = array (
		  'table_open'          => '<table id="tbldata" class="rax-table table datatable-basic" width="100%" border="0" cellpadding="0" cellspacing="0">',
		  'heading_row_start'   => '<tr class="heading">',
		  'heading_row_end'     => '</tr>',
		  'heading_cell_start'  => '<th>',
		  'heading_cell_end'    => '</th>',
		  'row_start'           => '<tr>',
		  'row_end'             => '</tr>',
		  'cell_start'          => '<td>',
		  'cell_end'            => '</td>',
		  'row_alt_start'       => '<tr class="alt">',
		  'row_alt_end'         => '</tr>',
		  'cell_alt_start'      => '<td>',
		  'cell_alt_end'        => '</td>',
		  'table_close'         => '</table>'
	);
	
	public function __construct(){
        parent::__construct();
		$this->ci =& get_instance();
		$this->ci->config->load('config', TRUE);
		$this->ci->load->library('session');
		$this->ci->load->library('table');
		$this->ci->load->helper('data_helper');
		$this->ci->load->helper('form_helper');
		$this->ci->load->library('form_builder');
		$this->ci->load->library('form_validation');
		$this->ci->load->helper('config_helper');
		
		$this->base = 'kediklatan/ijazah';
		$this->allbase = $this->ci->config->item('base_url', 'config').$this->base;
		if ($this->linkfield){
			$this->template = '&nbsp;<div class="dropdown dropup btn-group" data-dropup-auto="false">
									<a class="dropdown-toggle btn btn-primary btn-xs" data-toggle="dropdown" data-hover="dropdown">
										<span>Lainnya</span>
										<i class="fa fa-caret-square-o-down"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-right">{rowmenu}</ul>
								</div>';
		}
	}
	
	public function setRef($fieldrefarray){ 
		$this->refarray = $fieldrefarray; 
		$this->refurl = "/";
		foreach ($this->refarray as $k => $v){
			$this->refurl .= "$k/$v/";
		}
		$this->refurl = substr($this->refurl,0,-1);
	}
	public function getbase(){ return $this->base;}
	public function getrefurl(){ return $this->refurl;}
	
	public function generateLinkField($data){
		$bodyTpl = '';
		$num = 0;
		if ($this->linkfield){
			foreach($this->linkfield as $row){
				$url = $row['url'];
				$fieldvalue = $row['fieldvalue'];
				$fieldurl = $row['fieldurl'];
				$label = $row['label'];
				if (getAkses('read',$url)){
					if (array_key_exists($fieldvalue,$data)){
						$dtmenu = getMenuFromUrl($url);
						$bodyTpl .= '<li><a rel="nofollow" href="'.$url.'/'.$fieldurl.'/'.$data[$fieldvalue].'" title="'.$label.'"><i class="fa fa-'.$dtmenu['icon'].'"></i></i>'.$label.'</a></li>';
						$num++;	
					}
				}
			}
			
			if ($num) return str_replace('{rowmenu}', $bodyTpl, $this->template);
			else return '';
		}else return "";
	}
	
	public function getTableData(){
		$tabledata = array();
		
		$databahan = $this->getAll();
		$this->ci->table->set_template($this->tmpl); 
		$tabledata['judultable'] = 'Daftar '.ucfirst($this->modul);
		
		if (!getAkses('create',$this->base)) $tabledata['btntambah'] = "";
		else $tabledata['btntambah'] = '<br><a href="'.$this->base.'/t'.$this->refurl.'" class="btn btn-primary">+ <i class="fa fa-bookmark-o" aria-hidden="true"></i> Tambah '.ucfirst($this->modul).'</a>';
		
		$this->table->set_heading('Diklat', 'Nama Peserta', 'Ijazah',  'Aksi');

		foreach($databahan as $row)
		{
		  $bahanid = $row['id'];
		  $this->ci->table->add_row(
			'<label class="control-label" >Diklat : <strong>'.$row['master'].'</strong></label><br>
			<label class="control-label" >Angkatan : <strong>'.$row['angkatan'].'</strong></label><br>
			<label class="control-label" >Tahun : <strong>'.$row['tahun'].'</strong></label><br>
			<label class="control-label" >Kelompok : <strong>'.$row['kelompok'].'</strong></label><br>
			<label class="control-label" >Penyelenggara : <strong>'.$row['penyelenggara'].'</strong></label>',
			'<label class="control-label" >Nip : <strong>'.$row['nip'].'</strong></label><br>
			<label class="control-label" >Nama : <strong>'.$row['nama_lengkap'].'</strong></label>',
			'<label class="control-label" ><strong>'.anchor("$this->base/v/$bahanid", '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Lihat sertifikat',array('class' => 'btn btn-success btn-xs')).'</strong></label>',
			(
			(getAkses('update',$this->base) ? anchor("$this->base/e/$bahanid", '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>',array('class' => 'btn btn-success btn-xs')).'&nbsp;' : '').
			(getAkses('delete',$this->base) ? anchor("$this->base/h/$bahanid", '<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-xs" onclick="return confirm(\'Apakah Anda yakin?\')"') : '')
			). $this->generateLinkField($row)
		  );
		}
		
		$tabledata['table'] = $this->ci->table->generate();
		return $tabledata;    
	}
	
    public function getFormData($id){
        $formdata = array();
		$formdata['action'] = $this->base;
		$formdata['defaultvalue'] = null;
		
		$tmp = getDataDiklat("diklat");
		$dsdiklat = array();
		if (!$tmp){
			$dsdiklat['0'] = 'No Data Found!!!';
		}else{
			foreach($tmp as $row){
				$dsdiklat[$row['id']] = $row['master'].' '.$row['angkatan'].' '.$row['tahun'].' '.$row['kelompok'].' '.$row['penyelenggara'];
			}
		}
		
		$tmp = getDataDiklat("peserta");
		$dspeserta = array();
		if (!$tmp){
			$dspeserta['0'] = 'No Data Found!!!';
		}else{
			foreach($tmp as $row){
				$dspeserta[$row['id_user']] = $row['nama_lengkap'];
			}
		}
		
		$curdata = null;
		if ($id){
			$curdata = $this->getById($id);
			$formdata['defaultvalue'] = $curdata;
		}
		
		$field = array(array('id' => 'id',
							'type' => 'hidden',
							'value' => ($id ? $id : '')
					),($this->refarray ? (array_key_exists('id_user',$this->refarray) ? array('id' => 'id_user','type' => 'hidden','value' => $this->refarray['id_user']) :
																						  array(
																								'id' => 'id_user',
																								'label' => 'Peserta',
																								'type' => 'dropdown',
																								'class' => 'valid select',
																								'options' => $dspeserta,
																								'value' => ($id ? $curdata['id_user'] : 0))) :
										array(  'id' => 'id_user',
												'label' => 'Peserta',
												'type' => 'dropdown',
												'class' => 'valid select',
												'rules' => 'required',
												'options' => $dspeserta,
												'value' => ($id ? $curdata['id_user'] : 0))
					),($this->refarray ? (array_key_exists('id_diklat',$this->refarray) ? array('id' => 'id_diklat','type' => 'hidden','value' => $this->refarray['id_diklat']) :
																						  array(
																								'id' => 'id_diklat',
																								'label' => 'Diklat',
																								'type' => 'dropdown',
																								'class' => 'valid select',
																								'rules' => 'required',
																								'options' => $dsdiklat,
																								'value' => ($id ? $curdata['id_diklat'] : 0))) :
										array(  'id' => 'id_diklat',
												'label' => 'Diklat',
												'type' => 'dropdown',
												'class' => 'valid select',
												'rules' => 'required',
												'options' => $dsdiklat,
												'value' => ($id ? $curdata['id_diklat'] : 0))
					),array(
							'id' => 'tgl_ijazah',
							'name' => 'tgl_ijazah',
							'placeholder' => 'Tanggal Ijazah',
							'label' => 'Tanggal Ijazah',
							'class' => 'date',
							'type' => 'date',
							'rules' => 'required',
							'value' => ($id ? $curdata['tgl_ijazah'] : '')
					)
					);
		if (!$id){	
			$formdata['judulform'] = "Tambah ".ucfirst($this->modul);
			array_push($field, array('label'=>'',
											'type' => 'combine',
											'class' =>'col-lg-12',
											'elements' => array_filter(array(
																array(
																		'type' => 'a',
																		'href'=> $this->allbase.$this->refurl,
																		'value'=>"Back",
																		'label' => 'Back'
																),
																(getAkses('create',$this->base) ? array(
																		'id' => 'btnsimpan',
																		'type' => 'submit',
																		'label' => 'Tambah Data',
																		'style' => 'margin-left: 5px;',
																) : null)))
									));
		}else{
			$formdata['judulform'] = "Update ".ucfirst($this->modul);
			array_push($field, array('label'=>'',
									'type' => 'combine',
									'class' =>'col-lg-12',
									'elements' => array_filter(array(
														array(
																'type' => 'a',
																'href'=> $this->allbase.$this->refurl,
																'value'=>"Back",
																'label' => 'Back'
														),
														(getAkses('create',$this->base) ? array(
																'id' => 'btnupdate',
																'type' => 'submit',
																'label' => 'Update Data',
																'style' => 'margin-left: 5px;',
														) : null)))
							));
		}			
		$formdata['field'] = $field;
		return $formdata;
    }
	
	public function ViewIjazah($id_sertifikat){
		$formdata = array();
		
		$curdata = $this->getById($id_sertifikat);
		if ($curdata){
			$formdata['judulform'] = "Sertifikat diklat ".$curdata['master'];
			$field = array( array('id' => 'nip',
								'name' => 'nip',
								'placeholder' => 'NIP',
								'label' => 'NIP',
								'disabled' => 'disabled',
								'value' => $curdata['nip']
						),array('id' => 'nama',
								'name' => 'nama',
								'placeholder' => 'Nama',
								'label' => 'Nama',
								'disabled' => 'disabled',
								'value' => $curdata['nama_lengkap']
						),array('id' => 'email',
								'name' => 'email',
								'placeholder' => 'Email',
								'label' => 'Email',
								'disabled' => 'disabled',
								'value' => $curdata['email']
						),array('id' => 'master',
								'name' => 'master',
								'placeholder' => 'Diklat',
								'label' => 'Diklat',
								'disabled' => 'disabled',
								'value' => $curdata['master']
						),array('id' => 'angkatan','name' => 'angkatan',
								'placeholder' => 'Angkatan',
								'label' => 'Angkatan',
								'disabled' => 'disabled',
								'value' => $curdata['angkatan']
						),array('id' => 'tahun','name' => 'tahun',
								'placeholder' => 'Tahun',
								'label' => 'Tahun',
								'disabled' => 'disabled',
								'value' => $curdata['tahun']
						),array('id' => 'kelompok','name' => 'kelompok',
								'placeholder' => 'Kelompok',
								'label' => 'Kelompok',
								'disabled' => 'disabled',
								'value' => $curdata['kelompok']
						)
					);
		
			$formdata['form'] = $this->form_builder->open_form(array('action' => $this->base.$this->refurl)).$this->form_builder->build_form_horizontal($field,$curdata).$this->form_builder->close_form();
			$formdata['image'] = "data:image/jpeg;base64,".base64_encode( $this->createImage($curdata['nama_lengkap'],$curdata['tgl_ijazah']) );
		}else{
			$formdata['judulform'] = "Sertifikat Kosong";
			$formdata['form'] = '';
			$formdata['image'] = "data:image/jpeg;base64,".base64_encode( $this->createImage("","") );
		}
		return $formdata;
	}	
		
	private function createImage($nama,$tgl){	
		if (empty($nama)){
			$gambar = FCPATH ."/files/sertifikat/1.jpg";
		}else {
			$gambar = FCPATH ."/files/sertifikat/sertifikat.jpg";
		}
		$image = imagecreatefromjpeg($gambar);
		$white = imageColorAllocate($image, 255, 255, 255);
		$black = imageColorAllocate($image, 0, 0, 0);
		$font = FCPATH ."/files/sertifikat/QuinchoScript_PersonalUse.ttf";
		$size = 42;
		//definisikan lebar gambar agar posisi teks selalu ditengah berapapun jumlah hurufnya
		$image_width = imagesx($image);  
		//membuat textbox agar text centered
		$text_box = imagettfbbox($size,0,$font,$nama);
		$text_width = $text_box[2]-$text_box[0]; // lower right corner - lower left corner
		$text_height = $text_box[3]-$text_box[1];
		$x = ($image_width/2) - ($text_width/2);
		//generate sertifikat beserta namanya
		imagettftext($image, $size, 0, $x, 400, $black, $font, $nama);
		
		if (!empty($tgl)) {
			$font = FCPATH ."/files/sertifikat/ALGER.TTF";
			imagettftext($image, 24, 0, 220, 530, $black, $font, $tgl);
		}	
		//tampilkan di browser
		//header("Content-type:  image/jpeg");
		
		ob_start();
		imagejpeg($image);
		imagedestroy($image);
		
		$final_image = ob_get_contents();

		ob_end_clean();

		return $final_image;
	}
	
	public function generateIjazah($registrasiid){
		$data = getDataDiklat('peserta',array('id'=>$registrasiid));
		if ($data){
			$curdata = $data[0];
			date_default_timezone_set('Asia/Jakarta');
			$postdata = array();
			$postdata['id_diklat'] = $curdata['id_diklat'];
			$postdata['id_user'] = $curdata['id_user'];
			$postdata['tgl_ijazah'] = date("Y-m-d");
			$postdata['createdby'] = $this->ci->session->userdata['id_user'];
			$postdata['modifiedby'] = $this->ci->session->userdata['id_user'];
			
			$data = getDataDiklat($this->modul,array('id_diklat'=>$curdata['id_diklat'],'id_user'=>$curdata['id_user']));
			if (!$data){
				$hasil = Simpan_data($this->end_point,$postdata);
				if(in_array('statusCode',array_keys($hasil))){
					if ($hasil['statusCode'] == 200) return $hasil['data']['id'];
					else return false;
				}else return false;
				return true;
			}else return false;
		}else return false;
	}
	
    public function getAll(){
		return getDataDiklat($this->modul,$this->refarray);
    }
    
    public function getById($id){
		$data = getDataDiklat($this->modul,array('id'=>$id));
		if ($data) return $data[0];
		else return array();
    }

    public function save(){
	    $post = $this->input->post();
		$postdata = array();
		foreach($this->fieldname as $v){
			if (isset($post[$v])) $postdata[$v] = $post[$v];
		}
		
		$data = getDataDiklat($this->modul,array('id_diklat'=>$postdata['id_diklat'],'id_user'=>$postdata['id_user']));
		$dataregistrasi = getDataDiklat('peserta',array('id_diklat'=>$postdata['id_diklat'],'id_user'=>$postdata['id_user']));
		
		if (!$data && $dataregistrasi){
			$hasil = Simpan_data($this->end_point,$postdata);
			if(in_array('statusCode',array_keys($hasil))){
				if ($hasil['statusCode'] == 200){
					$dataregistrasi = $dataregistrasi[0];
					$peserta = array();
					$peserta['id'] = $dataregistrasi['id'];
					$peserta['id_sertifikat'] = $hasil['data']['id'];
					
					$hasil = Update_data('peserta',$peserta,$peserta['id']);
					if(in_array('statusCode',array_keys($hasil))){
						if ($hasil['statusCode'] == 200) return true;
						else return false;
					}else return false;
				}else return false;
			}else return false;
			return true;
		}else return false;
    }

    public function update(){
        $post = $this->input->post();
        $postdata = array();
		foreach($this->fieldname as $v){
			if (isset($post[$v])) $postdata[$v] = $post[$v];
		}
		$hasil = Update_data($this->end_point,$postdata,$postdata['id']);
		if(in_array('statusCode',array_keys($hasil))){
			if ($hasil['statusCode'] == 200) return true;
			else return false;
		}else return false;
    }

    public function delete($id){
        $hasil = Delete_data($this->end_point,$id);
		if(in_array('statusCode',array_keys($hasil))){
			if ($hasil['statusCode'] == 200) return true;
			else return false;
		}else return false;
	}
}

?>