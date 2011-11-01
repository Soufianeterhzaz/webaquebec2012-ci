<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class A_propos extends CI_Controller {

	public function index() {
	  $data = array('title' => 'À propos du Web à Québec');
		$this->my_controller->load_view('a_propos', $data);
	}
}
