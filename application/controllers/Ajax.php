<?php

class Ajax extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->model('employeeModel');
    $this->load->model('managementModel');
    $this->load->model('ajaxModel');
  }

  public function getModels() {
    echo json_encode($this->ajaxModel->getModels());
  }
}
