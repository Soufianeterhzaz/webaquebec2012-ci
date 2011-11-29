<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Infos_pratiques extends CI_Controller {

	public function index() {
	  $data = array('title' => 'Informations pratiques');
		$this->my_controller->load_view('infos_pratiques', $data);
	}
}