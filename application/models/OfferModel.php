<?php
class OfferModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function carExists($id) {
    $a=$this->db->get_where('carsv',array('id'=>$id))->result_array();
    if(count($a)>0) return true;
    else return false;
  }

  public function getCarData($id) {
    $arr['basic']=$this->db->get_where('carsv',array('id'=>$id))->row_array();
    $arr['pictures']=$this->db->get_where('pictures',array('carId'=>$id))->result_array();

    return $arr;
  }

  public function isLoaned($id) {
    $this->db->where("carId='$id' and confirmed=1 and '".date('Y-m-d')."' between startDate and endDate");
    $r=$this->db->get('loan')->result_array();
    if(count($r)>0) return true;
    else return false;
  }

  public function loan($id) {
    $start=new DateTime($this->input->post('startDate'));
    $end=new DateTime($this->input->post('endDate'));

    if(!$this->input->post('startDate') || !$this->input->post('endDate') || !$this->input->post('wage')) redirect('offer');

    if($end<$start || $end==$start) {
      $this->session->set_flashdata('loanMessage','Bad date format');
      exit();
    }

    $interval=$end->diff($start);
    $months=$interval->m + 12*$interval->y;
    if($interval->d>0) $months++;

    $data=array(
      'id'=>null,
      'startDate'=>$this->input->post('startDate'),
      'endDate'=>$this->input->post('endDate'),
      'userId'=>$this->session->userdata('id'),
      'employeeId'=>1,
      'carId'=>$id,
      'confirmed'=>false,
      'cost'=>($months*$this->input->post('wage'))
    );

    if($this->db->insert('loan',$data)) {
      $this->session->set_flashdata('loanMessage','Loan added. Now you need to wait for our response via e-mail.');
    }
    else {
      $this->session->set_flashdata('loanMessage','Error. Loan not added. Try again.');
    }
  }
}
