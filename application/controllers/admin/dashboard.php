<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->library('session');
    
    if(!$this->session->userdata('is_logged_in')) {
      redirect('admin/login/');
    }
  }
  
  function index() {
    $data = array(
      'view' => 'dashboard_view',
      'controller' => 'dashboard'
    );
    $this->load->view('admin/layouts/admin_layout', $data);
  }

}