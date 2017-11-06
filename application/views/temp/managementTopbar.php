<p>
  <span><?=anchor('management','Management - Home Page')?></span>
  <span>Welcome <?=$this->session->userdata('employeeName').' '.$this->session->userdata('employeeSurname')?></span>
  <span><?=anchor('management/logout','Log Out')?></span>
</p>
