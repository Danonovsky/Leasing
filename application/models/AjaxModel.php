<?php
class AjaxModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function getModels() {
    return $this->db->get_where('model',array('markId'=>$this->input->post('mark')))->result_array();
  }
}
