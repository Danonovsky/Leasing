<?php
class AjaxModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function getModels() {
    return $this->db->get_where('model',array('markId'=>$this->input->post('mark')))->result_array();
  }

  public function getCars() {
    $offers=$this->session->userdata('offersPerPage');
    $page=$this->input->post('page');
    $arr=array();
    if($offers==99) {
      //all
      if($this->input->post('orderby')=='none' && $this->input->post('way')=='none') {
        $arr['basic']=$this->db->get('carsv')->result_array();
      }
      else {

        $this->db->order_by($this->input->post('orderby'),$this->input->post('way'));
        $arr['basic']=$this->db->get('carsv')->result_array();
      }
    }
    else {
      //parted
      if($this->input->post('orderby')=='none' && $this->input->post('way')=='none') {
        $arr['basic']=$this->db->get('carsv',$offers,($page-1)*$offers)->result_array();
      }
      else {
        $this->db->order_by($this->input->post('orderby'),$this->input->post('way'));
        $arr['basic']=$this->db->get('carsv',$offers,($page-1)*$offers)->result_array();
      }
    }
    foreach($arr['basic'] as $a) {
      $arr['pics'][]=$this->db->get_where('pictures',array('carId'=>$a['id']))->result_array();
    }
    return $arr;
  }
}
