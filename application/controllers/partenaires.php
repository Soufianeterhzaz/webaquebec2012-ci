<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partenaires extends CI_Controller {

	public function index() {
		$data = array('title' => 'Partenaires');
		$this->my_controller->load_view('partenaires', $data);
	}
}
