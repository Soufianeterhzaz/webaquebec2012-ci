<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscriptions extends CI_Controller {

	public function index() {
		$data = array(
		  'title' => 'Inscription au l\'Iron Web 2012',
			'view_data'=>array()
		);
		$this->load->model('Inscription');
		$this->load->library('form_validation');
		// Validations rukes
		$this->form_validation->set_rules('nom_complet', 'Nom complet', 'required');
		$this->form_validation->set_rules('courriel', 'Courriel', 'email|required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 'required');
		$this->form_validation->set_rules('age', 'Âge', 'required');
		$this->form_validation->set_rules('profil', 'Profil', 'required');
		$this->form_validation->set_rules('linkedin', 'Linkedin', 'required');
		$this->form_validation->set_rules('twitter', 'Nom d\'utilisateur Twitter ', 'required');
		$this->form_validation->set_rules('question1', '', 'required');
		$this->form_validation->set_rules('question2', '', 'required');
		$this->form_validation->set_rules('question3', '', 'required');
		$this->form_validation->set_rules('urgenec_nom', '', 'required');
		$this->form_validation->set_rules('urgence_tel', '', 'required');
		$this->form_validation->set_rules('profil', 'Profil', 'required');
		$this->form_validation->set_rules('profil', 'Profil', 'required');
		// Validations messages
		$this->form_validation->set_message('required', 'Ce champ est requis');
		$this->form_validation->set_message('email', 'Courriel invalide');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == FALSE)
		{
		  $data['view_data']['saved'] = false;
			$this->my_controller->load_view('inscription', $data);
		}
		else
		{
			$data['view_data']['saved'] = true;
			$this->my_controller->load_view('inscription', $data);
			$this->db->insert('inscriptions', $_POST); 
		}
	}
}