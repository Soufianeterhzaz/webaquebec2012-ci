<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Programmation extends CI_Controller {

	public function index() {
		$data = array('title' => 'Programmation');
		$this->my_controller->load_view('programmation', $data);
	}
}