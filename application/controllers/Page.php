<?php
class Page extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->helper('url');
  }

  public function index() {
    $data['title']='Strona główna';
    $this->load->view('temp/header',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
    echo 'strona główna';
  }
}
