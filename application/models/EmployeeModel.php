<?php
class EmployeeModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function login() {
    $data=array(
      'email'=>$this->input->post('email'),
      'password'=>md5($this->input->post('password'))
    );
    $r=$this->db->get_where('employees',$data)->row_array();
    if($r) {
      $this->session->set_userdata(
        array(
          'employeeLogged'=>true,
          'employeeId'=>$r['id'],
          'employeeName'=>$r['name'],
          'employeeSurname'=>$r['surname'],
          'employeeRank'=>$r['rankId']
        )
      );
      return true;
    }
    else {
      return false;
    }
  }

  public function logout() {
    $data=array(
      'employeeLogged',
      'employeeId',
      'employeeName',
      'employeeSurname',
      'employeeRank'
    );
    $this->session->unset_userdata($data);
  }

  public function checkEmployee() {
    if(!$this->session->userdata('employeeLogged')) {
      redirect('management');
      exit();
    }
  }

  public function employeeLogged() {
    if($this->session->userdata('employeeLogged')) return true;
    else return false;
  }
}
