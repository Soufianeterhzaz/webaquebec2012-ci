<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Iron_web extends CI_Controller {

	public function index() {
	  $data = array('title' => 'Iron Web');
		$this->my_controller->load_view('contact', $data);
	}
}