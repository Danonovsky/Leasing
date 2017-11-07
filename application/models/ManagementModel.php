<?php
class ManagementModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function getEmployees() {
    $this->db->select('e.*, r.name as rank');
    $this->db->from('employees e, ranks r');
    $this->db->where('r.id=e.rankId and e.id!=1');
    return $this->db->get()->result_array();
  }

  public function getRanks() {
    $this->db->where('id!=1');
    return $this->db->get('ranks')->result_array();
  }

  public function checkRank($id) {
    if($id!=$this->session->userdata('employeeRank')) {
      redirect('management');
    }
  }

  public function addEmployee() {
    $data=array(
      'name'=>$this->input->post('name'),
      'surname'=>$this->input->post('surname'),
      'email'=>$this->input->post('email'),
      'password'=>md5($this->input->post('password')),
      'phoneNr'=>$this->input->post('phoneNr'),
      'city'=>$this->input->post('city'),
      'rankId'=>$this->input->post('rank'),
    );
    if($this->db->insert('employees',$data)) $mess='New employee added.';
    else $mess='Error. Try again';
    $this->session->set_flashdata('newEmployeeMessage', $mess);
  }

  public function editEmployee($id) {
    $data=array(
      'name'=>$this->input->post('name'),
      'surname'=>$this->input->post('surname'),
      'email'=>$this->input->post('email'),
      'phoneNr'=>$this->input->post('phoneNr'),
      'city'=>$this->input->post('city'),
      'rankId'=>$this->input->post('rank'),
    );
    $where=array(
      'id'=>$id
    );
    if($this->db->update('employees',$data,$where)) $mess='Data updated successful.';
    else $mess='Error. Try again.';
    $this->session->set_flashdata('editEmployeeMessage', $mess);
  }

  public function checkEmployeeExists($id) {
    $r=$this->db->get_where('employees',array('id'=>$id))->result_array();
    if(count($r)<1) {
      redirect('management');
    }
  }

  public function getEmployee($id) {
    return $this->db->get_where('employees',array('id'=>$id))->row_array();
  }

  public function deleteEmployee($id) {
    $this->db->delete('employees',array('id'=>$id));
  }

  public function checkCarExists($id) {
    $r=$this->db->get_where('cars',array('id'=>$id))->result_array();
    if(count($r)<1) {
      redirect('management');
    }
  }

  public function getFrom($table) {
    return $this->db->get($table)->result_array();
  }

  public function getCars() {
    return $this->db->get('getCars')->result_array();
  }

  public function newCar() {
    $data=array(
      'id'=>null,
      'name'=>$this->input->post('name'),
      'modelId'=>$this->input->post('model'),
      'capacity'=>$this->input->post('capacity'),
      'year'=>$this->input->post('year'),
      'fuelId'=>$this->input->post('fuel'),
      'bodyId'=>$this->input->post('body')
    );
    if($this->db->insert('cars',$data)) $mess='Car added successful.';
    else $mess='Error. Car not added.';

    $this->session->set_flashdata('newCarMessage',$mess);
  }

  public function deleteCar($id) {
    $this->db->delete('cars',array('id'=>$id));
  }
}
