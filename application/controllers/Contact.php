<?php

class Contact extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('userModel');
  }

  public function index() {
    $data['title']='Contact';
    $data['logged']=$this->userModel->isLogged();
    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('page/contact');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }
}
