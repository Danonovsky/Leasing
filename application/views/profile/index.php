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
  <?=anchor('profile/edit','Edit data')?>
</p>
<p>
  <?=anchor('profile/changePassword','Change password')?>
</p>
