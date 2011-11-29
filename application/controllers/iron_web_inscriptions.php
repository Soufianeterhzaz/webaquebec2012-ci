<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Iron_Web_Inscriptions extends CI_Controller {

	public function index() {
		$data = array(
		  'title' => 'Inscription au l\'Iron Web 2012',
			'view_data'=>array()
		);
		$this->load->library('form_validation');
		// Validations rukes
		$this->form_validation->set_rules('nom_complet', 'Nom complet', 'required');
		$this->form_validation->set_rules('courriel', 'Courriel', 'email|required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 'required');
		$this->form_validation->set_rules('age', 'Âge', 'required');
		$this->form_validation->set_rules('profil', 'Profil', 'required');
		$this->form_validation->set_rules('question1', '', 'required');
		$this->form_validation->set_rules('question2', '', 'required');
		$this->form_validation->set_rules('question3', '', 'required');
		$this->form_validation->set_rules('environnement', '', 'required');
		$this->form_validation->set_rules('fonction', '', 'required');
		// Validations messages
		$this->form_validation->set_message('required', 'Ce champ est requis');
		$this->form_validation->set_message('email', 'Courriel invalide');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == FALSE)
		{
		  $data['view_data']['saved'] = false;
		}
		else
		{
			if($this->db->insert('iron_web_inscriptions', $_POST))
			{
			  $data['view_data']['saved'] = true;
			}
		}
		$this->my_controller->load_view('iron_web_inscriptions', $data); 
	}
}