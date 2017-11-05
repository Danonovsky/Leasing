<?=validation_errors()?>

<h2><?=$result['basic']['title']?></h2>

<?=form_open(site_url('profile/editAnnouncment/'.$result['basic']['id']))?>

<input type="hidden" name="basicId" value="<?=$result['basic']['id']?>">
<input type="hidden" name="detailsId" value="<?=$result['details']['id']?>">
<p>
  <label for="description">Opis: </label>
  <textarea name="description"><?=$result['basic']['description']?></textarea>
</p>

<p>
  <label for="price">Cena: </label>
  <input type="number" name="price" step="0.01" min="0" value="<?=$result['basic']['price']?>">
</p>

<?php
foreach($result['details'] as $key=>$val) {
  if($key!='id' && $key!='announcmentId') {
    ?>
    <p>
      <label for="<?=$key?>"><?=$key?>: </label>
      <input type="text" name="<?=$key?>"value="<?=$val?>">
    </p>
    <?php
  }
}
?>

<p>
  <input type="submit" value="Zapisz zmiany">
</p>
<p>
  <?=anchor(site_url('profile/myAnnouncments'),'Powrót')?>
</p>
</form>
