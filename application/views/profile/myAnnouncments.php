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
      <span><?=anchor(site_url('profile/editAnnouncment/'.$list['basic'][$i]['id']),'Edytuj ogłoszenie')?></span>
      <span><?=anchor(site_url('profile/highlightAnnouncment/'.$list['basic'][$i]['id']),'Wyróżnij ogłoszenie')?></span>
      <span><?=anchor(site_url('profile/deleteAnnouncment/'.$list['basic'][$i]['id']),'Usuń ogłoszenie')?></span>
      <span>Do: <?=$list['basic'][$i]['untilDate']?></span>
    </p>
    <?php
  }
}
else {
  ?>
  <p>Obecnie nie posiadasz żadnych aktywnych ogłoszeń. Możesz dodać nowe ogłoszenie <?=anchor('profile/newAnnouncment','tutaj')?>.</p>
  <?php
}
?>
<p>
  <?=anchor(site_url('profile'),'Powrót')?>
</p>
