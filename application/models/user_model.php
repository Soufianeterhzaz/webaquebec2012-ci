<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

  var $username = '';

  function __construct() {
    parent::__construct();
  }

  public function validate() {
    $this->db->where('username', $this->input->post('username'));
    $this->db->where('password', $this->input->post('password'));

    $query = $this->db->get('users');
    return $query->num_rows == 1;
  }

}