<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Controller extends CI_Controller {
  
  function __construct() {
    $this->CI =& get_instance();
      
    // layout data
    $this->view = array();
  }
  
  private function prepare_view_data() {
    /*
      TODO add layout data here
    */
  }
  
  public function load_view($view = '', $data = array()) {
    
    if ($view != '') {
      
      $view_data = (isset($data['view_data'])) ? $data['view_data'] : '';
      
      $this->view['page_content'] = $this->CI->load->view($view, $view_data, true);
    }
    
    $this->prepare_view_data();
    
    $data = array_merge($this->view, $data);
    
    $this->CI->load->view('layouts/application_layout', $data);
  }
}