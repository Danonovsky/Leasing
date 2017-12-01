<section class="top-panel">
  <div class="col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10 text-right top-padding">
    <p>
      <span><?=anchor('management','Management - Home Page', $arrayName = array('class' => 'user-anchor'))?></span>
      <span>Welcome <?=$this->session->userdata('employeeName').' '.$this->session->userdata('employeeSurname')?></span>
      <span><?=anchor('management/logout','Log Out', $arrayName = array('class' => 'user-anchor'))?></span>
    </p>
  </div>
</section>
