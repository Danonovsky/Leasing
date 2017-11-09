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
    $data['title']='Management - Home';

    if($this->employeeModel->employeeLogged()) {
      $data['cars']=$this->managementModel->getCars();
      $data['loans']=$this->managementModel->getLoans();
      $this->load->view('temp/header',$data);
      $this->load->view('temp/managementTopbar');
      $this->load->view('temp/navbar');
      $this->load->view('management/management',$data);
      $this->load->view('temp/footer');
      $this->load->view('temp/end');
    }
    else {
      $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email');
      $this->form_validation->set_rules('password','"Password"','trim|required|min_length[3]|alpha');

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

    $this->managementModel->checkRank(1);

    $data['title']='Management - Employees';
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

    $this->form_validation->set_rules('name','"Name"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('surname','"Surname"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password','"Password"','trim|required');
    $this->form_validation->set_rules('password1','"Repeat Password"','trim|required|matches[password]');
    $this->form_validation->set_rules('phoneNr','"Phone Number"','trim|required|numeric|exact_length[9]');
    $this->form_validation->set_rules('city','"City"','trim|required');
    $this->form_validation->set_rules('rank','"Rank"','trim|required');

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

    $data['title']=' Management - New Employee';
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

  public function history() {
    $this->employeeModel->checkEmployee();
    $this->managementModel->checkRank(1);

    $data['title']='History';
    $data['loans']=$this->managementModel->getLoans();

    $this->load->view('temp/header',$data);
    $this->load->view('temp/managementTopbar');
    $this->load->view('temp/navbar');
    $this->load->view('management/history',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function newCar() {
    $this->employeeModel->checkEmployee();

    $data['title']='Management - New Car';

    $this->managementModel->checkRank(2);

    $this->form_validation->set_rules('mark','"Mark"','trim|required');
    $this->form_validation->set_rules('model','"Model"','trim|required');
    $this->form_validation->set_rules('capacity','"Capacity"','trim|required|numeric|greater_than[0]');
    $this->form_validation->set_rules('year','"Year"','trim|required|numeric|greater_than[0]');
    $this->form_validation->set_rules('fuel','"Fuel"','trim|required');
    $this->form_validation->set_rules('body','"Body"','trim|required');
    $this->form_validation->set_rules('name','"Name"','trim|required');

    if($this->form_validation->run()===true) {
      $this->managementModel->newCar();
      redirect('management/newCar');
    }
    $data['marks']=$this->managementModel->getFrom('mark');
    $data['bodies']=$this->managementModel->getFrom('body');
    $data['fuels']=$this->managementModel->getFrom('fuel');
    $data['scriptName']='getModels.js';
    $this->load->view('temp/header',$data);
    $this->load->view('temp/managementTopbar');
    $this->load->view('temp/navbar');
    $this->load->view('management/newCar',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/loadJs',$data);
    $this->load->view('temp/end');
  }

  public function deleteCar($id=false) {
    if($id===false) {
      redirect('management');
    }
    else {
      $this->employeeModel->checkEmployee();
      $this->managementModel->checkRank(2);
      $this->managementModel->checkCarExists($id);
      $this->managementModel->deleteCar($id);
      redirect('management');
    }
  }

  public function acceptLoan($id=false) {
    if(!$id) {
      redirect('management');
    }
    $this->employeeModel->checkEmployee();
    $this->managementModel->checkRank(3);

    if($this->managementModel->isLoaned($id)) redirect('management');

    $this->managementModel->acceptLoan($id);

    redirect('management');
  }

  public function deleteLoan($id=false) {
    if(!$id) {
      redirect('management');
    }
    $this->employeeModel->checkEmployee();
    $this->managementModel->checkRank(3);

    $this->managementModel->deleteLoan($id);

    redirect('management');
  }

  public function logout() {
    $this->employeeModel->checkEmployee();
    $this->employeeModel->logout();
    redirect('management');
  }
}
