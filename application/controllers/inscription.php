<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscription extends CI_Controller {

	public function index() {
	  $data = array('title' => 'Inscription');
		$this->my_controller->load_view('inscription', $data);
	}
}
