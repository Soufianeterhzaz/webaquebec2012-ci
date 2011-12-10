<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Talk extends CI_Controller {

  function __construct() {
    parent::__construct();

    $this->load->library('session');

    if(!$this->session->userdata('is_logged_in')) {
      redirect('admin/login/');
    }

    $this->load->model('talk_model');
  }

  function index() {

    $data = array(
         'title' => 'Conférences',

         'controller' => 'talk',
         'breadcrumbs' => array('Conférences' => 'talk'),
         'columns' => array('Titre', 'Conférencier(s)', 'Date', 'Heure début', 'Heure fin', 'Salle'),
         'row_template' => 'talk_row_template',

         'list' => $this->talk_model->getAllWithSpeakers(),
         'view' => 'list_view'
       );

       $this->load->view('admin/layouts/admin_layout', $data);
  }

  function add() {

    $this->load->model('speaker_model');

    $data = array(
      'title' => 'Ajout > Conférence',

      'controller' => 'talk',
      'breadcrumbs' => array('Conférences' => 'talk', 'Ajout' => 'talk/add'),

      'speaker_choices' => $this->speaker_model->getAll(),

      'form_template' => 'talk_form_template',
      'view' => 'form_view',
    );

    $this->load->view('admin/layouts/admin_layout', $data);

  }

  function edit($id) {

    $this->load->model('speaker_model');

    $item = $this->talk_model->getWithSpeakers($id);

    $speakerChoices = $this->speaker_model->getAll();

    $speakers = array();

    foreach ($speakerChoices as $speakerChoice) {
      $push = true;
      foreach ($item->speakers as $speaker) {
        if ($speakerChoice->id == $speaker->id) {
          $push = false;
          break;
        }
      }
      if ($push) {
        $speakers[] = $speakerChoice;
      }
    }

    $data = array(

      'item' => $item,

      'title' => 'Édition > Conférences',

      'controller' => 'talk',
      'breadcrumbs' => array('Conférences' => 'talk', 'Édition' => 'talk/edit/'.$id),

      'speaker_choices' => $speakers,

      'form_template' => 'talk_form_template',
      'view' => 'form_view'
    );

    $this->load->view('admin/layouts/admin_layout', $data);
  }

  function save() {
    $id = $this->talk_model->save($this->input->post());
    redirect('admin/talk');
  }

  function delete() {
    $post = $this->input->post();
    $this->talk_model->delete($post['id']);
  }
}