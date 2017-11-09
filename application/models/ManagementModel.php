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
    return $this->db->get('carsv')->result_array();
  }

  public function newCar() {
    $this->db->trans_start();
    //basic upload

    $data=array(
      'id'=>null,
      'name'=>$this->input->post('name'),
      'modelId'=>$this->input->post('model'),
      'capacity'=>$this->input->post('capacity'),
      'year'=>$this->input->post('year'),
      'fuelId'=>$this->input->post('fuel'),
      'bodyId'=>$this->input->post('body'),
      'wage'=>$this->input->post('wage')
    );

    $this->db->insert('cars',$data);

    $id=$this->db->insert_id();
    //photo upload

    $dir='img/';
    $files=$_FILES['pictures'];
    $file=$dir.date('YmdHis').$this->session->userdata('id');
    $photos=array();
    for($i=0;$i<count($files['name']);$i++) {
      $tmp=$files['tmp_name'][$i];
      $name=$files['name'][$i];
      $end = pathinfo($name,PATHINFO_EXTENSION);
      if(is_uploaded_file($tmp)) {
        $path=$file.$i.'.'.$end;
        move_uploaded_file($tmp,$path);
        $photos[]=array('id'=>null,'carId'=>$id,'path'=>$path);
      }
    }
    if(count($photos)>0) {
      $this->db->insert_batch('pictures',$photos);
    }

    $this->db->trans_complete();

    if($this->db->trans_status()===false) $mess='Error. Car not added.';
    else $mess='Car added successful.';

    $this->session->set_flashdata('newCarMessage',$mess);
  }

  public function deleteCar($id) {
    $this->db->delete('cars',array('id'=>$id));
  }

  public function getLoans() {
    return $this->db->get('loanv')->result_array();
  }

  public function acceptLoan($id) {
    $data=array(
      'employeeId'=>$this->session->userdata('employeeId'),
      'confirmed'=>true
    );
    $r=$this->db->get_where('loan',array('id'=>$id))->row_array();
    $user=$this->db->get_where('users',array('id'=>$r['userId']))->row_array();
    $to=$user['email'];

    $this->db->trans_start();

    $this->db->update('loan',$data,array('id'=>$id));

    $this->db->trans_complete();

    if($this->db->trans_status()===false) $mess='Error. Loan currently managed.';
    else
    {
      $mess='Loan accepted successful.';
      $headers = "From: " .$to. "\r\n";
      $headers .= "Reply-To: ".$to. "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      $subject='Loan Commit';
      $message='Your loan was accepted. Now we need you to contact us (IP, or by phone) to submit everything. Greetings, LeasIt.com team.';


      mail($to, $subject, $message, $headers);
    }

    $this->session->set_flashdata('eLoanMessage',$mess);
  }

  public function isLoaned($id) {
    $r=$this->db->get_where('loan',array('id'=>$id,'confirmed'=>true))->result_array();
    if(count($r)>0) return true;
    else return false;
  }

  public function deleteLoan($id) {
    $this->db->delete('loan',array('id'=>$id));
  }
}
