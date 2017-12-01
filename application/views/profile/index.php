<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <p>
      Personal data: <?=$this->session->userdata('name').' '.$this->session->userdata('surname')?>
    </p>
    <p>
      City: <?=$this->session->userdata('city')?>
    </p>
    <p>
      Phone Number: <?=$this->session->userdata('phoneNr')?>
    </p>
    <p>
      <?=anchor('profile/edit','Edit data', $arrayName = array('class' => 'user-anchor' ))?>
    </p>
    <p>
      <?=anchor('profile/changePassword','Change password', $arrayName = array('class' => 'user-anchor' ))?>
    </p>
  </div>
</div>
