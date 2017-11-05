<?php
class Profile extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('url','text'));
    $this->load->library('session');
    $this->load->library('pagination');
    $this->load->model('userManager');
    $this->load->model('profileManager');
  }

  public function index() {
    $this->userManager->checkLogged();
    $data['title']='Mój profil';
    $data['active']=$this->profileManager->countActiveAnnouncments();
    $data['unactive']=$this->profileManager->countUnactiveAnnouncments();
    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/index',$data);
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
  }

  public function view($id=false) {
    $data['user']=$this->profileManager->getUserData($id);
    if($data['user']) {
      $data['title']='Profil użytkownika '.$data['user']['name'].' '.$data['user']['surname'];
      $this->load->view('templates/header',$data);
      $this->load->view('templates/topbar');
      $this->load->view('templates/navbar');
      $this->load->view('profile/view');
      $this->load->view('templates/footer');
      $this->load->view('templates/end');
    }
    else show_404();
  }

  public function myAnnouncments($offset=1) {
    $this->userManager->checkLogged();

    if($offset!=1 && $offset>ceil($this->profileManager->countActiveAnnouncments()/30)) redirect(site_url('profile/myAnnouncments'));

    $data['title']='Moje ogłoszenia';
    $data['list']=$data['announcments']=$this->profileManager->getAnnouncments($offset);

    $config['base_url'] = site_url('profile/myAnnouncments');
    $config['total_rows'] = $this->profileManager->countActiveAnnouncments();
    $config['per_page'] = 30;
    $config['use_page_numbers']=TRUE;

    $this->pagination->initialize($config);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/myAnnouncments',$data);
    $this->load->view('templates/paginator');
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
    }

  public function myUnactiveAnnouncments($offset=1) {
    $this->userManager->checkLogged();

    if($offset!=1 && $offset>ceil($this->profileManager->countUnactiveAnnouncments()/30)) redirect(site_url('profile/myUnactiveAnnouncments'));

    $data['title']='Nieaktywne ogłoszenia';
    $data['list']=$data['announcments']=$this->profileManager->getUnactiveAnnouncments($offset);

    $config['base_url'] = site_url('profile/myUnactiveAnnouncments');
    $config['total_rows'] = $this->profileManager->countUnactiveAnnouncments();
    $config['per_page'] = 1;
    $config['use_page_numbers']=TRUE;

    $this->pagination->initialize($config);

    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/myUnactiveAnnouncments',$data);
    $this->load->view('templates/paginator');
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
  }

  public function edit() {
    $this->userManager->checkLogged();
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name','"Imię"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('surname','"Nazwisko"','trim|required|min_length[3]|alpha');
    $this->form_validation->set_rules('phoneNr','"Numer telefonu"','trim|required|numeric|exact_length[9]');
    $this->form_validation->set_rules('city','"Miasto"','trim|required');

    $data['title']='Edycja danych';

    if($this->form_validation->run()===true) {
      if($this->profileManager->updateUserData()) {
        $this->userManager->updateSessionData();
      }
    }
    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/edit');
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
  }

  public function changePassword() {
    $this->userManager->checkLogged();
    $this->load->library('form_validation');

    $this->form_validation->set_rules('actualPassword','"Aktualne hasło"','trim|required');
    $this->form_validation->set_rules('password','"Nowe hasło"','trim|required');
    $this->form_validation->set_rules('password1','"Powtórz nowe hasło"','trim|required|matches[password]');

    $data['title']='Zmiana hasła';

    if($this->form_validation->run()===true) {
      $this->profileManager->updateUserPassword();
    }
    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/changePassword');
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
  }

  public function newAnnouncment() {
    $this->userManager->checkLogged();
    $this->load->library('form_validation');
    $this->load->model('categoryManager');

    $config['upload_path']='./img/';
    $config['allowed_types']= 'gif|jpg|png';
    $config['file_name']=date('YmdHis').'_'.$this->session->userdata('id');
    $this->load->library('upload',$config);

    $this->form_validation->set_rules('title','"Tytuł"','trim|required');
    $this->form_validation->set_rules('price','"Cena"','trim|required|greater_than_equal_to[0]');
    $this->form_validation->set_rules('description','"Opis"','trim|required');
    $this->form_validation->set_rules('category','"Kategoria"','greater_than[-1]');//todo ładny message
    $this->form_validation->set_message('greater_than','Musisz wybrać kategorię.');
    $this->form_validation->set_message('required','{field} nie może być pusty/a.');

    if($this->form_validation->run()===true) {
      if($this->profileManager->addAnnouncment()) {
        redirect(site_url('profile/success'));
      }
      else {
        $data['title']='Nowe ogłoszenie';
        $data['js']='newAnnouncment.js';
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/navbar');
        $this->load->view('profile/newAnnouncment',$data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script',$data);
        $this->load->view('templates/end');
      }
    }
    else {
      $data['categories']=$this->categoryManager->getCategories();
      if(!$data['categories']) {
        show_404();
      }
      $data['title']='Nowe ogłoszenie';
      $data['js']='newAnnouncment.js';
      $this->load->view('templates/header',$data);
      $this->load->view('templates/topbar');
      $this->load->view('templates/navbar');
      $this->load->view('profile/newAnnouncment',$data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script',$data);
      $this->load->view('templates/end');
    }
  }

  public function success() {
    if($this->session->flashdata('addAnnouncmentSuccess')) {
      $data['title']='Gratulacje!';
      $this->load->view('templates/header',$data);
      $this->load->view('templates/topbar');
      $this->load->view('templates/navbar');
      $this->load->view('profile/success');
      $this->load->view('templates/footer');
      $this->load->view('templates/end');
    }
    else redirect(site_url('profile'));
  }

  public function editAnnouncment($id=false) {
    if(!$id) {
      redirect(site_url('profile'));
    }
    $this->userManager->checkAnnouncmentOwnership($id);

    $this->load->library('form_validation');
    $data['result']=$this->profileManager->getDataToEdit($id);

    $this->form_validation->set_rules('price','"Cena"','trim|required|greater_than_equal_to[0]');
    $this->form_validation->set_rules('description','"Opis"','trim|required');

    if($this->form_validation->run()===true) {
      if($this->profileManager->updateAnnouncment()===true) {
        redirect(site_url('profile/editAnnouncment/'.$id));
      }
    }

    $data['title']='Edycja danych';
    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/editAnnouncment',$data);
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
  }

  public function deleteAnnouncment($id=false) {
    if(!$id) {
      redirect(site_url('profile'));
    }
    $this->userManager->checkAnnouncmentOwnership($id);

    $pics=$this->db->get_where('pictures',array('announcmentId'=>$id))->result_array();

    if($this->db->delete('announcments',array('id'=>$id))) {
      foreach($pics as $a) {
        unlink('./'.($a['path']));
      }
    }

    redirect(site_url('profile/myAnnouncments'));
  }

  public function renewAnnouncment($id=false) {
    if(!$id) {
      redirect(site_url('profile'));
    }
    $this->userManager->checkAnnouncmentOwnership($id);

    $this->profileManager->renewAnnouncment($id);

    redirect(site_url('profile/myUnactiveAnnouncments'));
  }

  public function highlightAnnouncment($id=false) {
    if(!$id) {
      redirect(site_url('profile'));
    }
    $this->userManager->checkAnnouncmentOwnership($id);

    $this->profileManager->highlightAnnouncment($id);

    $data['title']='Wyróżnianie ogłoszenia';
    $this->load->view('templates/header',$data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/navbar');
    $this->load->view('profile/highlightAnnouncment');
    $this->load->view('templates/footer');
    $this->load->view('templates/end');
  }
}
