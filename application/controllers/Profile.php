<?php
class Profile extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('url','text'));
    $this->load->library('session');
    $this->load->model('userModel');
    $this->load->model('profileModel');
  }

  public function index() {
    $this->userModel->checkLogged();
    $data['title']='Mój profil';
    $data['logged']=$this->userModel->isLogged();
    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('profile/index');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function edit() {
    $this->userModel->checkLogged();
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name','"Imię"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('surname','"Nazwisko"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('phoneNr','"Numer telefonu"','trim|required|numeric|exact_length[9]');
    $this->form_validation->set_rules('city','"Miasto"','trim|required');

    $data['title']='Edycja danych';
    $data['logged']=$this->userModel->isLogged();

    if($this->form_validation->run()===true) {
      if($this->profileModel->updateUserData()) {
        $this->userModel->updateSessionData();
        redirect('profile/edit');
      }
    }
    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('profile/edit');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function changePassword() {
    $this->userModel->checkLogged();
    $this->load->library('form_validation');

    $this->form_validation->set_rules('actualPassword','"Aktualne hasło"','trim|required');
    $this->form_validation->set_rules('password','"Nowe hasło"','trim|required');
    $this->form_validation->set_rules('password1','"Powtórz nowe hasło"','trim|required|matches[password]');

    $data['title']='Zmiana hasła';
    $data['logged']=$this->userModel->isLogged();

    if($this->form_validation->run()===true) {
      $this->profileModel->updateUserPassword();
      redirect('profile/changePassword');
    }
    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('profile/changePassword');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }
}
