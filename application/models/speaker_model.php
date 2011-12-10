<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Speaker_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function getAll() {
    $this->db->select('*')->from('speakers');
    $query = $this->db->get();
    return $query->result();
  }

  function get($id) {
    $this->db->select('*')->from('speakers')->where('id', $id);
    $query = $this->db->get();
    $result = $query->result();
    return $result[0];
  }

  public function save($data) {

    // create
    if(!isset($data['id'])) {
      $this->db->insert('speakers', $data);

      return $this->db->insert_id();

    // update
    } else {

      $this->db->where('id', $data['id']);
      $this->db->update('speakers', $data);

      return $data['id'];
    }
  }

  public function delete($id=null, $imagePath) {

    if (is_array($id)) {

      $this->db->where_in('id', $id);
      $this->db->select('photo_path')->from('speakers');
      $query = $this->db->get();

      $files = $query->result();

      if (count($files) > 0) {

        foreach($files as $file) {
          $path = './'.$imagePath.'/'.$file->photo_path;

          if (file_exists($path) && is_file($path)) {
            unlink($path);
          }
        }
      }

      $this->db->where_in('id', $id);
      $this->db->delete('speakers');
    }
  }

}