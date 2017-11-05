<?php

class UserModel extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function register() {
    $data= array(
      'email'=>$this->input->post('email'),
      'password'=>md5($this->input->post('password')),
      'name'=>$this->input->post('name'),
      'surname'=>$this->input->post('surname'),
      'phoneNr'=>$this->input->post('phoneNr'),
      'city'=>$this->input->post('city'),
      'confirmed'=>false
    );

    return $this->db->insert('users',$data);
  }

  public function confirm($key) {
    $r=$this->db->get_where('users',array('confirmed'=>false))->result_array();
    if(count($r)==0) {
      return 'Błędny link.';
    }
    else {
      $updated=false;
      foreach($r as $a) {
        if(md5($a['id'])==$key) {
          $this->db->update('users',array('confirmed'=>true),array('id'=>$a['id']));
          $updated=true;
          return 'Konto aktywowane. Zapraszamy do logowania.';
        }
      }
      if(!$updated) {
        $r=$this->db->get_where('users',array('confirmed'=>true))->result_array();
        $accepted=false;
        foreach($r as $a) {
          if(md5($a['id'])==$key) {
            $accepted=true;
            break;
          }
        }
        if($accepted) return 'Konto zostało już aktywowane.';
        return 'Błędny link.';
      }
    }
  }

  public function checkLogged() {
    if(!$this->session->userdata('logged')) redirect(site_url());
  }

  public function isLogged() {
    if($this->session->userdata('logged')) return true;
    else return false;
  }

  public function login() {
    $data=array(
      'email'=>$this->input->post('email'),
      'password'=>md5($this->input->post('password'))
    );

    if(($result=$this->db->get_where('users',$data)->row_array())) {
      if($result['confirmed']) {
        $data=array(
          'logged'=>true,
          'id'=>$result['id'],
          'email'=>$result['email'],
          'name'=>$result['name'],
          'surname'=>$result['surname'],
          'phoneNr'=>$result['phoneNr'],
          'city'=>$result['city']
        );
        $this->session->set_userdata($data);
      }
      else {
        $this->session->set_flashdata('loginMessage','Konto nie zostało aktywowane.');
      }
    }
    else {
      $this->session->set_flashdata('loginMessage','Błędny email i/lub hasło.');
      return false;
    }
  }

  public function logout() {
    $data=array(
      'logged',
      'id',
      'email',
      'name',
      'surname',
      'phoneNr',
      'city'
    );
    $this->session->unset_userdata($data);
    redirect(site_url());
  }

  public function updateSessionData() {
    $result=$this->db->get_where('users',array('id'=>$this->session->userdata('id')))->row_array();
    $data=array(
      'name'=>$result['name'],
      'surname'=>$result['surname'],
      'phoneNr'=>$result['phoneNr'],
      'city'=>$result['city']
    );
    $this->session->set_userdata($data);
  }


}
