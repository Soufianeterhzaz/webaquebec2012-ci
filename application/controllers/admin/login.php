<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct() {
    parent::__construct();

    $this->load->library('session');
  }

  function index() {

    if ($this->session->userdata('is_logged_in')) {
      redirect('admin/dashboard/');
    } else {
      $data['view'] = 'login_view';
      $this->load->view('admin/layouts/admin_layout', $data);
    }
  }

  function validate_credentials() {

    $this->load->model('user_model');
    $valid = $this->user_model->validate();

    if ($valid) {

      $data = array(
        'username' => $this->input->post('username'),
        'is_logged_in' => true
      );

      $this->session->set_userdata($data);

      redirect('admin/dashboard/');

    } else {

      $data = array(
        'view' => 'login_view',
        'error' => '<p class="error">Le nom d’utilisateur ou le mot de passe que vous avez saisi est incorrect.</p>'
      );

      $this->load->view('admin/layouts/admin_layout', $data);
    }
  }

  function logout() {
    $this->session->sess_destroy();
    $this->index();
  }

}