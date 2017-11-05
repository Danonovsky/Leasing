<?php
class Page extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->library('session');
    $this->load->helper('url');

    $this->load->model('userModel');
  }

  public function index() {
    $data['title']='Strona główna';
    $data['logged']=$this->userModel->isLogged();
    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('page/index');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }

  public function register() {
    if($this->userModel->isLogged()) {
      redirect(site_url());
    }

    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title']=' Rejestracja';
    $data['logged']=$this->userModel->isLogged();

    $this->form_validation->set_rules('name','"Imię"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('surname','"Nazwisko"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password','"Hasło"','trim|required');
    $this->form_validation->set_rules('password1','"Powtórz hasło"','trim|required|matches[password]');
    $this->form_validation->set_rules('phoneNr','"Numer telefonu"','trim|required|numeric|exact_length[9]');
    $this->form_validation->set_rules('city','"Miasto"','trim|required');

    if($this->form_validation->run()===false) {
      $this->load->view('temp/header',$data);
      $this->load->view('temp/topbar',$data);
      $this->load->view('temp/navbar');
      $this->load->view('page/register');
      $this->load->view('temp/footer');
      $this->load->view('temp/end');
    }
    else {
      if($this->userModel->register()) {
        $id=$this->db->insert_id();
        $to=$this->input->post('email');

        $headers = "From: " .$to. "\r\n";
        $headers .= "Reply-To: ".$to. "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $subject='Potwierdzenie rejestracji';
        $message='Konto o podanym adresie zarejestrowało się w naszym serwisie. Jeśli byłeś to Ty, '.anchor(site_url('page/confirm/'.md5($id)),'kliknij tutaj').', aby dokończyć rejestrację. Pozdrawiamy, zespół LeasIt.com';


        if( mail($to, $subject, $message, $headers) ) {
          $data['info']="Aby dokończyć rejestrację kliknij w odnośnik, który otrzymałeś/aś na podany adres e-mail.";
        } else {
          $data['info']= "Wystąpił błąd podczas rejestracji. Spróbuj ponownie.";
          $this->db->delete('users',array('id'=>$id));
        }
        $this->load->view('temp/header',$data);
        $this->load->view('temp/topbar',$data);
        $this->load->view('temp/navbar');
        $this->load->view('page/sendInfo',$data);
        $this->load->view('temp/footer');
        $this->load->view('temp/end');
      }
    }

  }

  public function login() {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email','"E-mail"','trim|required|valid_email');
    $this->form_validation->set_rules('password','"Hasło"','trim|required');

    if($this->form_validation->run()===true) {
      $this->userModel->login();
    }

    if($this->userModel->isLogged()) {
      redirect(site_url());
    }

    $data['title']='Strona główna';
    $data['logged']=$this->userModel->isLogged();
    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('page/login');
    $this->load->view('temp/footer');
    $this->load->view('temp/end');
  }


  public function logout() {
    $this->userModel->logout();
    redirect(site_url());
  }

  public function confirm($key=false) {
    if($key===false) {
      redirect(site_url());
    }
    $data['title']='Potwierdzenie rejestracji';
    $data['logged']=$this->userModel->isLogged();
    $data['result']=$this->userModel->confirm($key);

    $this->load->view('temp/header',$data);
    $this->load->view('temp/topbar',$data);
    $this->load->view('temp/navbar');
    $this->load->view('page/confirm',$data);
    $this->load->view('temp/footer');
    $this->load->view('temp/end');

    $this->userModel->confirm($key);
  }
}
