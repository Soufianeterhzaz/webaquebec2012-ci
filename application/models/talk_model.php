<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Talk_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function getAll() {
    $this->db->select('*')->from('talks');
    $query = $this->db->get();
    return $query->result();
  }

  public function getAllWithSpeakers() {
    $this->db->select('*')->from('talks');
    $query = $this->db->get();
    return $this->addSpeakers($query->result());
  }

  function get($id) {
    $this->db->select('*')->from('talks')->where('id', $id);
    $query = $this->db->get();
    $result = $query->result();
    return $result[0];
  }

  function getWithSpeakers($id) {
    $this->db->select('*')->from('talks')->where('id', $id);
    $query = $this->db->get();
    $result = $this->addSpeakers($query->result());
    return $result[0];
  }

  public function save($data) {

    $originalData = $data;
    unset($data['speakers']);

    // create
    if(!isset($data['id'])) {
      $this->db->insert('talks', $data);

      $talk_id = $this->db->insert_id();

    // update
    } else {

      $this->db->where('id', $data['id']);
      $this->db->update('talks', $data);

      $talk_id = $data['id'];

      $this->deleteRelatedSpeakers($talk_id);
    }

    $insertSpeakers = array();
    foreach ($originalData['speakers'] as $speaker_id) {
      $insertSpeakers[] = array(
        'talk_id' => $talk_id,
        'speaker_id' => $speaker_id
      );
    }

    $this->db->insert_batch('speakers_talks', $insertSpeakers);

    return $talk_id;

  }

  public function delete($id=null) {
    if(is_array($id)) {
      $this->deleteRelatedSpeakers($id);
      $this->db->where_in('id', $id);
      $this->db->delete('talks');
    }
  }

  private function addSpeakers($talks) {

    $items = array();

    $this->db->select('
      speakers.id,
      speakers.first_name,
      speakers.last_name,
      speakers.site_url,
      speakers.twitter_url,
      speakers.bio,
      speakers.photo_path,
      speakers_talks.speaker_id,
      speakers_talks.talk_id');

    $this->db->from('speakers');
    $this->db->join('speakers_talks', 'speakers.id = speakers_talks.speaker_id', 'left');
    $query = $this->db->get();
    $speakers = $query->result();

    foreach($talks as $talk) {

      $talkSpeakers = array();

      foreach($speakers as $speaker) {
        if($speaker->talk_id == $talk->id) {
          $talkSpeakers[] = $speaker;
        }
      }

      $talk->speakers = $talkSpeakers;

      $items[] = $talk;

    }

    return $items;
  }

  private function deleteRelatedSpeakers($id) {
    $this->db->where_in('talk_id', $id);
    $this->db->delete('speakers_talks');
  }

}