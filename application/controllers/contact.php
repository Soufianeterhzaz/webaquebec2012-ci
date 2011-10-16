<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index() {
	  $data = array('title' => 'Contact');
		$this->my_controller->load_view('contact', $data);
	}
}