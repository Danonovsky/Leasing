<?php
if(count($list)>0) {
  for($i=0;$i<count($list['basic']);$i++) {
    ?>
    <p>
      <?php if(!empty($list['pics'][$i]))
      { ?>
        <span><img src="<?=base_url($list['pics'][$i][0]['path'])?>" class="previewPicture"></span>
        <?php } ?>
      <span><?=$list['basic'][$i]['title']?></span>
      <span><?=anchor(site_url('profile/renewAnnouncment/'.$list['basic'][$i]['id']),'Odnów ogłoszenie')?></span>
      <span><?=anchor(site_url('profile/deleteAnnouncment/'.$list['basic'][$i]['id']),'Usuń ogłoszenie')?></span>
      <span>Do: <?=$list['basic'][$i]['untilDate']?></span>
    </p>
    <?php
  }
}
?>
<p>
  <?=anchor(site_url('profile'),'Powrót')?>
</p>
