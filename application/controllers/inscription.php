<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscription extends CI_Controller {

	public function index() {
<<<<<<< HEAD
	  $data = array('title' => 'Contact');
=======
	  $data = array('title' => 'Inscription');
>>>>>>> master
		$this->my_controller->load_view('inscription', $data);
	}
}
