<?php
class ProfileManager extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function getUserData($id=false) {
    if($id==true) {
      return $this->db->get_where('users',array('id'=>$id))->row_array();
    }
    else return false;
  }

  public function updateUserData() {
    $data=array(
      'name'=>$this->input->post('name'),
      'surname'=>$this->input->post('surname'),
      'phoneNr'=>$this->input->post('phoneNr'),
      'city'=>$this->input->post('city')
    );
    $where=array(
      'id'=>$this->session->userdata('id')
    );
    $result=$this->db->update('users',$data,$where);
    if($result) {
      $this->session->set_flashdata(array('updateMessage'=>'Zapisano zmiany.'));
      return true;
    }
    else {
      $this->session->set_flashdata(array('updateMessage'=>'Nie udało się zapisać zmian.'));
      return false;
    }
  }

  public function updateUserPassword() {
    $data=array(
      'password'=>md5($this->input->post('password'))
    );

    $where=array(
      'id'=>$this->session->userdata('id')
    );

    $actual=md5($this->input->post('actualPassword'));
    $result=$this->db->get_where('users',array('password'=>$actual))->row_array();
    $password=$result['password'];

    if(md5($this->input->post('actualPassword'))==$password) {
      $result=$this->db->update('users',$data,$where);
      if($result) {
        $this->session->set_flashdata(array('passwordMessage'=>'Hasło zostało zmienione.'));
      }
      else {
        $this->session->set_flashdata(array('passwordMessage'=>'Nie udało się zmienić hasła.'));
      }
    }
    else {
      $this->session->set_flashdata(array('passwordMessage'=>'Podane hasło jest nieprawidłowe.'));
    }
  }

  public function countActiveAnnouncments() {
    $id=$this->session->userdata('id');
    $date=date('Y-m-d');
    $sql="select * from announcments where userId='$id' and untilDate>='$date'";
    $query=$this->db->query($sql);
    return $query->num_rows();
  }

  public function countUnactiveAnnouncments() {
    $id=$this->session->userdata('id');
    $date=date('Y-m-d');
    $sql="select * from announcments where userId='$id' and untilDate<'$date'";
    $query=$this->db->query($sql);
    return $query->num_rows();
  }

  public function addAnnouncment($data=false) {
    $slug=url_title(convert_accented_characters($this->input->post('title')),'dash',true);
    $date = strtotime(date('Y-m-d'));
    $newDate = date("Y-m-d", strtotime("+1 month", $date));

    //TRANSACTION START

    $this->db->trans_start();

    //BASIC DATA IMPORT

    $data=array(
      'id'=>null,
      'userId'=>$this->session->userdata('id'),
      'categoryId'=>$this->input->post('category'),
      'description'=>$this->input->post('description'),
      'price'=>$this->input->post('price'),
      'untilDate'=>$newDate,
      'title'=>$this->input->post('title'),
      'slug'=>$slug
    );
    $basicFields=array('title','category','price','description','submit','0');
    $this->db->insert('announcments',$data);
    $id=$this->db->insert_id();

    //ADDITIONAL DATA IMPORT

    $category=$this->db->get_where('categories',array('id'=>$this->input->post('category')))->row_array();
    $subCatname=strtolower($category['name'].'Details');

    $data1=array(
      'id'=>null,
      'announcmentId'=>$id
    );
    foreach($this->input->post() as $key=>$val) {
      if(!in_array($key,$basicFields)) {
        $data1[$key]=$val;
      }
    }
    $this->db->insert($subCatname,$data1);

    //IMAGES IMPORT

    $dir='img/';
    $files=$_FILES['pictures'];
    $file=$dir.date('YmdHis').$this->session->userdata('id');
    $photos=array();
    for($i=0;$i<count($files['name']);$i++) {
      $tmp=$files['tmp_name'][$i];
      $name=$files['name'][$i];
      $end = pathinfo($name,PATHINFO_EXTENSION);
      if(is_uploaded_file($tmp)) {
        $path=$file.$i.'.'.$end;
        move_uploaded_file($tmp,$path);
        $photos[]=array('id'=>null,'announcmentId'=>$id,'path'=>$path);
      }
    }
    print_r($photos);
    if(count($photos)>0) {
      $this->db->insert_batch('pictures',$photos);
    }

    //TRANSACTION END

    $this->db->trans_complete();

    if($this->db->trans_status()===false) {
      $this->session->set_flashdata('addAnnouncmentError','Wystąpił błąd podczas dodawania ogłoszenia. Spróbuj ponownie.');
      return false;
    }
    else {
      $this->session->set_flashdata('addAnnouncmentSuccess',$id.'/'.$slug);
      return true;
    }
  }

  public function getAnnouncments($offset) {
    $this->db->where('untilDate>=',date('Y-m-d'));
    $res=$this->db->get_where('announcments',array('userId'=>$this->session->userdata('id')),30,$offset*30-30)->result_array();
    foreach($res as $a) {
      $category=$this->db->get_where('categories',array('id'=>$a['categoryId']))->row_array();
      $details[]=$this->db->get_where(strtolower($category['name'].'Details'),array('announcmentId'=>$a['id']))->row_array();
      $pics[]=$this->db->get_where('pictures',array('announcmentId'=>$a['id']))->result_array();
    }
    if(count($res)>0) {
      $arr=array('basic'=>$res,'details'=>$details,'pics'=>$pics);
    }
    else $arr=array();
    return $arr;
  }

  public function getUnactiveAnnouncments($offset) {
    $this->db->where('untilDate<',date('Y-m-d'));
    $res=$this->db->get_where('announcments',array('userId'=>$this->session->userdata('id')),30,$offset*30-30)->result_array();
    foreach($res as $a) {
      $category=$this->db->get_where('categories',array('id'=>$a['categoryId']))->row_array();
      $details[]=$this->db->get_where(strtolower($category['name'].'Details'),array('announcmentId'=>$a['id']))->row_array();
      $pics[]=$this->db->get_where('pictures',array('announcmentId'=>$a['id']))->result_array();
    }
    if(count($res)>0) {
      $arr=array('basic'=>$res,'details'=>$details,'pics'=>$pics);
    }
    else $arr=array();
    return $arr;
  }

  public function getDataToEdit($id) {
    $basic=$this->db->get_where('announcments',array('id'=>$id))->row_array();
    $category=$this->db->get_where('categories',array('id'=>$basic['categoryId']))->row_array();
    $catName=$category['name'];
    $details=$this->db->get_where(strtolower($catName.'Details'),array('announcmentId'=>$id))->row_array();
    return array('basic'=>$basic,'details'=>$details);
  }

  public function updateAnnouncment() {
    $basicId=$this->input->post('basicId');
    $detailsId=$this->input->post('detailsId');

    $prod=$this->db->get_where('announcments',array('id'=>$basicId))->row_array();
    $category=$this->db->get_where('categories',array('id'=>$prod['categoryId']))->row_array();
    $catName=$category['name'];

    $basic=array(
      'description'=>$this->input->post('description'),
      'price'=>$this->input->post('price')
    );
    $details=array();

    $staticData=array('basicId','detailsId','description','price');

    foreach($this->input->post() as $key=>$val) {
      if(!in_array($key,$staticData)) {
        $details[$key]=$val;
      }
    }

    $this->db->trans_start();

    $this->db->update('announcments',$basic,array('id'=>$basicId));
    $this->db->update(strtolower($catName.'Details'),$details,array('id'=>$detailsId));

    $this->db->trans_complete();

    if($this->db->trans_status()===false) {
      return false;
    }
    else {
      return true;
    }

  }

  public function renewAnnouncment($id) {
    $ann=$this->db->get_where('announcments',array('id'=>$id))->row_array();

    $date = strtotime(date('Y-m-d'));
    $newDate = date("Y-m-d", strtotime("+1 month", $date));
    $arr= array('untilDate'=>$newDate);

    $this->db->update('announcments',$arr,array('id'=>$id));
  }

  public function highlightAnnouncment($id) {
    $willBeHighlighted=true;
    $highlighted=$this->db->get('highlighted')->result_array();
    foreach($highlighted as $a) {
      $single=$this->db->get_where('announcments',array('id'=>$a['announcmentId']))->row_array();
      if($this->session->userdata('id')==$single['userId']) $willBeHighlighted=false;
    }

    if(!$willBeHighlighted) {
      $this->session->set_flashdata('highlightMessage','Posiadasz już jedno wyróżnione ogłoszenie.');
    }
    else {
      $ann=$this->db->get_where('announcments',array('id'=>$id))->row_array();

      $date = strtotime(date('Y-m-d'));
      $newDate = date("Y-m-d", strtotime("+7 day", $date));

      $this->db->trans_start();
      if($newDate>$ann['untilDate']) {
        self::renewAnnouncment($id);
      }

      $arr=array(
        'id'=>null,
        'announcmentId'=>$id,
        'untilDate'=>$newDate
      );
      $this->db->insert('highlighted',$arr);

      $this->db->trans_complete();

      if($this->db->trans_status()===false) {
        $this->session->set_flashdata('highlightMessage','Wystąpił błąd. Spróbuj ponownie.');
      }
      else {
        $this->session->set_flashdata('highlightMessage','Ogłoszenie zostało wyróżnione.');
      }
    }
  }
}
