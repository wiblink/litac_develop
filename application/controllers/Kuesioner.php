<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends CI_Controller {
	
	public function __construct()
  {
    parent::__construct();
	$this->load->helper('config_helper');
  }

	public function index()
	{
		redirect('404_content');
	}
	
	public function diklat($id='') {
		// /kuesioner/diklat/1
		$cek_dkq = $this->Dcrud->get_where_common(array('id_asg' => $id),'diklat_evaluasi_asg')->row();
		if (!$cek_dkq) redirect('404_content');
		if ($cek_dkq->id_evas == NULL) redirect('404_content');
		$data_asg = $this->Dcrud->where_evaasg_id($id)->row();
		$q_arr = explode(",", $data_asg->id_evas);
		$data['arr'] = $q_arr;
		$data['qwherein'] = $this->Dcrud->get_que_where_in($q_arr);
		$data['judul_web'] 	  = "Kuesioner";
		$this->load->view("web/form_kuesioner", $data);
		if (isset($_POST['kirim_k'])) {
			$idpeserta   	 	= $this->input->post('peserta');
			$iddiklat   	 	= $this->input->post('diklat');
			
			$cek_ps = $this->Dcrud->get_where_common(array('id_ps' => $idpeserta,'id_eva !=' => NULL),'diklat_peserta')->row();
			if (!$cek_ps) {
				foreach($q_arr as $q) {
				$jawab   	 		= $this->input->post('q'.$q);
				$data = array(
					'id_que'	 => $q,
					'id_diklat'	 => $iddiklat,
					'id_peserta' => $idpeserta,
					'jawaban_a'	 => $jawab,
					'created'	 => date('Y-m-d H:m:s')
				);
				$this->Dcrud->save_common($data,'diklat_evaluasi_a');
				}
				$data = array(
					'id_eva'	 => $id
				);
				$this->Dcrud->update_peserta(array('id_ps' => $idpeserta), $data);
					
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Terima kasih telah mengisi Kuesioner.
						</div>'
					);

				redirect('kuesioner/diklat/'.$id);
			}
			else {
				echo '<script>alert("Anda telah mengikuti Kuesioner ini sebelumnya");</script>';
			}
			
		}
	}

}
