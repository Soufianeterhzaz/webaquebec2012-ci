<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Speaker extends CI_Controller {

  function __construct() {
    parent::__construct();

    $this->load->library('session');

    if(!$this->session->userdata('is_logged_in')) {
      redirect('admin/login/');
    }

    $this->load->model('speaker_model');
  }

  function index() {

    $data = array(
         'title' => 'Conférenciers',

         'controller' => 'speaker',
         'breadcrumbs' => array('Conférenciers' => 'speaker'),
         'columns' => array('Conférencier'),
         'row_template' => 'speaker_row_template',

         'list' => $this->speaker_model->getAll(),
         'view' => 'list_view'
       );

       $this->load->view('admin/layouts/admin_layout', $data);
  }

  function add() {

    $data = array(
      'title' => 'Ajout > Conférencier',

      'controller' => 'speaker',
      'breadcrumbs' => array('Conférenciers' => 'speaker', 'Ajout' => 'speaker/add'),

      'form_template' => 'speaker_form_template',
      'view' => 'form_view',
    );

    $this->load->view('admin/layouts/admin_layout', $data);

  }

  function edit($id) {

    $data = array(

      'item' => $this->speaker_model->get($id),

      'photo_path' => base_url().$this->config->item('speakersPhotoPath'),

      'title' => 'Édition > Conférencier',

      'controller' => 'speaker',
      'breadcrumbs' => array('Conférenciers' => 'speaker', 'Édition' => 'speaker/edit'),

      'form_template' => 'speaker_form_template',
      'view' => 'form_view',
    );

    $this->load->view('admin/layouts/admin_layout', $data);
  }

  function save() {

    $postData = $this->input->post();

    if ($_FILES['photo_path']['tmp_name']) {

      $config = array(
        'upload_path' => './'.$this->config->item('speakersPhotoPath'),
        'allowed_types' => 'gif|jpg|jpeg|png'
      );

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('photo_path')) {

        $uploadData = $this->upload->data();

        $data = array(
          'photo_path' => $uploadData['file_name'],
        );

        $data = array_merge($postData, $data);

        chmod('./'.$this->config->item('speakersPhotoPath').'/'.$uploadData['file_name'], 0777);

        $this->speaker_model->save($data);

        redirect('admin/speaker');

      }

    } else {
      $this->speaker_model->save($postData);
      redirect('admin/speaker');
    }

  }

  function delete() {
    $post = $this->input->post();
    $this->speaker_model->delete($post['id'], $this->config->item('speakersPhotoPath'));
  }
}