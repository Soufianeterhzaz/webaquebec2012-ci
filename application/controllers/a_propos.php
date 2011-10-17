<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class A_propos extends CI_Controller {

	public function index() {
	  $data = array('title' => 'À propos de l\'Iron Web');
		$this->my_controller->load_view('a_propos', $data);
	}
}