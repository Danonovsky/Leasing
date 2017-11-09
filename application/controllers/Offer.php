<?php
class Offer extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('userModel');
    $this->load->model('managementModel');
    $this->load->model('offerModel');

    if(!$this->session->userdata('offersPerPage')) {
      $this->session->set_userdata('offersPerPage',5);
    }
  }

  public function index($page=1) {
    $this->load->library('pagination');

    $data['page']=$page;
    $data['scriptName']='getCars.js';
    $data['title']='Offer';
    $data['logged']=$this->userModel->isLogged();

    $config['base_url'] = site_url('offer/index/');
    $config['total_rows'] = count($this->managementModel->getCars());
    $config['per_page'] = $this->session->userdata('offersPerPage');
    $config['use_page_numbers']=TRUE;

    $this->pagination->initialize($config);

    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('offer/index',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/loadJs',$data);
    $this->load->view('temp/end');
  }

  public function perSite() {
    $this->session->set_userdata('offersPerPage',$this->input->post('perSite'));
    redirect('offer');
  }

  public function details($id=false) {
    if($id===false) {
      redirect('offer');
    }

    if(!$this->offerModel->carExists($id)) show_404();

    $data['title']='Details';
    $data['car']=$this->offerModel->getCarData($id);
    $data['logged']=$this->userModel->isLogged();
    $data['loaned']=$this->offerModel->isLoaned($id);

    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar');
    $this->load->view('temp/navbar');
    $this->load->view('offer/details',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function loan($id) {
    if($id===false) redirect('offer');
    if($this->offerModel->isLoaned($id) || !$this->offerModel->carExists($id) || !$this->userModel->isLogged()) redirect('offer');

    $this->offerModel->loan($id);

    $data['title']='Loan Summary';
    $data['logged']=$this->userModel->isLogged();

    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar');
    $this->load->view('temp/navbar');
    $this->load->view('offer/loan');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }
}
