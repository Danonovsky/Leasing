<?php
if($this->session->flashdata('highlightMessage')) {
  ?>
  <p>
    <?=$this->session->flashdata('highlightMessage')?>
  </p>
  <?php
}
?>

<p>
  <?=anchor(site_url('profile/myAnnouncments'),'Powrót')?>
</p>
