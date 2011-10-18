<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscriptions extends CI_Controller {

	public function index() {
		$data = array('title' => 'Inscription à l\'Iron Web');
		$this->load->model('Inscription');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom_complet', 'Nom complet', 'required');
		$this->form_validation->set_rules('courriel', 'Courriel', 'required');
		$this->form_validation->set_rules('telephone', 'Téléphone', 'required');
		$this->form_validation->set_rules('age', 'Âge', 'required');
		$this->form_validation->set_message('required', 'Le champs %s est requis');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->my_controller->load_view('inscription', $data);
		}
		else
		{
			$this->my_controller->load_view('inscription', $data);
		}
	}
}