<?php
class Management extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('employeeModel');
    $this->load->model('managementModel');
  }

  public function index() {
    $data['title']='Zarządzanie - strona główna';

    if($this->employeeModel->employeeLogged()) {
      $this->load->view('temp/header',$data);
      $this->load->view('temp/managementTopbar');
      $this->load->view('temp/navbar');
      $this->load->view('management/management');
      $this->load->view('temp/footer');
      $this->load->view('temp/end');
    }
    else {
      $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email');
      $this->form_validation->set_rules('password','"Hasło"','trim|required|min_length[3]|alpha');

      if($this->form_validation->run()===false) {
        $this->load->view('temp/header',$data);
        $this->load->view('temp/navbar');
        $this->load->view('management/login');
        $this->load->view('temp/footer');
        $this->load->view('temp/end');
      }
      else {
        if($this->employeeModel->login()) {
          redirect('management');
        }
      }
    }
  }

  public function manageEmployees() {
    $this->employeeModel->checkEmployee();

    $data['title']='Zarządzanie - pracownicy';
    $data['employees']=$this->managementModel->getEmployees();
    $this->load->view('temp/header',$data);
    $this->load->view('temp/managementTopbar');
    $this->load->view('temp/navbar');
    $this->load->view('management/manageEmployees',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function newEmployee() {
    $this->employeeModel->checkEmployee();

    $this->managementModel->checkRank(1);

    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title']=' Zarządzanie - nowy pracownik';
    $data['ranks']=$this->managementModel->getRanks();

    $this->form_validation->set_rules('name','"Imię"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('surname','"Nazwisko"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password','"Hasło"','trim|required');
    $this->form_validation->set_rules('password1','"Powtórz hasło"','trim|required|matches[password]');
    $this->form_validation->set_rules('phoneNr','"Numer telefonu"','trim|required|numeric|exact_length[9]');
    $this->form_validation->set_rules('city','"Miasto"','trim|required');
    $this->form_validation->set_rules('rank','"Ranga"','trim|required');

    if($this->form_validation->run()===true) {
      $this->managementModel->addEmployee();
    }
    $this->load->view('temp/header',$data);
    $this->load->view('temp/managementTopbar');
    $this->load->view('temp/navbar');
    $this->load->view('management/newEmployee',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function editEmployee($id=false) {
    if(!$id) {
      redirect('management/manageEmployees');
    }

    $this->employeeModel->checkEmployee();

    $this->managementModel->checkEmployeeExists($id);

    $this->managementModel->checkRank(1);

    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title']=' Zarządzanie - nowy pracownik';
    $data['ranks']=$this->managementModel->getRanks();
    $data['employee']=$this->managementModel->getEmployee($id);

    $this->form_validation->set_rules('name','"Name"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('surname','"Surname"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('phoneNr','"Phone number"','trim|required|numeric|exact_length[9]');
    $this->form_validation->set_rules('city','"City"','trim|required');
    $this->form_validation->set_rules('rank','"Rank"','trim|required');

    if($this->form_validation->run()===true) {
      $this->managementModel->editEmployee($id);
      redirect('management/editEmployee/'.$id);
    }
    $this->load->view('temp/header',$data);
    $this->load->view('temp/managementTopbar');
    $this->load->view('temp/navbar');
    $this->load->view('management/editEmployee',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function deleteEmployee($id=false) {
    if(!$id) {
      redirect('management/manageEmployees');
    }

    $this->employeeModel->checkEmployee();
    $this->managementModel->checkEmployeeExists($id);
    $this->managementModel->checkRank(1);

    $this->managementModel->deleteEmployee($id);
    redirect('management/manageEmployees');
  }

  public function newMark() {
    $this->employeeModel->checkEmployee();

    $data['title']='Zarządzanie - nowy model';

    $this->form_validation->set_rules('name','"Nazwa"','trim|required|alpha_numeric_spaces|is_unique[mark.name]');

    if($this->form_validation->run()===false) {
      $this->load->view('temp/header',$data);
      $this->load->view('temp/managementTopbar');
      $this->load->view('temp/navbar');
      $this->load->view('management/newMark');
      $this->load->view('temp/footer');
      $this->load->view('temp/end');
    }
    else {
      $this->managementModel->newCategory();
      redirect('management');
    }
  }

  public function deleteMark($id=false) {
    $this->employeeModel->checkEmployee();
    if($id===false) {
      redirect('management');
    }
    else {
      $this->managementModel->deleteCategory($id);
      redirect('management');
    }
  }

  public function previewCategory($id=false) {
    $this->employeeModel->checkEmployee();
    if($id===false) {
      redirect('management');
    }
    else {
      $data['title']='Zarządzanie - podgląd';
      if(($r=$this->managementModel->getFields($id))===false) {
        redirect('management');
      }
      else {
        $data['fields']=$r;
        $data['category']=$this->managementModel->getCategory($id);
        $this->load->view('temp/header',$data);
        $this->load->view('temp/managementTopbar');
        $this->load->view('temp/navbar');
        $this->load->view('management/previewCategory',$data);
        $this->load->view('temp/footer');
        $this->load->view('temp/end');
      }
    }
  }

  public function logout() {
    $this->employeeModel->checkEmployee();
    $this->employeeModel->logout();
    redirect('management');
  }
}
