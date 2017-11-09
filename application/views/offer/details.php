<?php
if(count($car['pictures'])>0) $hasPictures=true;
else $hasPictures=false;

if($hasPictures) {
  $src=base_url($car['pictures'][0]['path']);
  $alt="picture";
}
else {
  $src=base_url('img/nopic.png');
  $alt="no picture";
}
?>

<h2><?=$car['basic']['name']?></h2>
<p>Mark: <?=$car['basic']['mark']?></p>
<p>Model: <?=$car['basic']['model']?></p>
<p>Year: <?=$car['basic']['year']?></p>
<p>Capacity: <?=$car['basic']['capacity']?></p>
<p>Fuel: <?=$car['basic']['fuel']?></p>
<p>Body: <?=$car['basic']['body']?></p>
<p>Wage (monthly): <?=$car['basic']['wage']?></p>

<h2>Pictures</h2>
<div class="main">
  <img src="<?=$src?>" alt="<?=$alt?>">
</div>
<?php
if($hasPictures) {
  ?>
  <div class="small">
    <?php
    foreach($car['pictures'] as $a) {
      ?>
      <img id="<?=$a['id']?>" class="smallPic" src="<?=base_url($a['path'])?>" alt="picture">
      <?php
    } ?>
  </div>
  <?php
}

if($loaned) {
  ?>
  <input type="button" class="unactive" value="Car currently loaned">
  <?php
}

elseif($logged) {
  ?>
  <div class="form">
    <?=form_open('offer/loan/'.$car['basic']['id'])?>
    <input type="hidden" name="wage" value="<?=$car['basic']['wage']?>">
    <p>
      <label for"startDate">Start date: </label>
      <input type="date" name="startDate" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>">
    </p>

    <p>
      <label for"endDate">End date: </label>
      <input type="date" name="endDate" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>">
    </p>

    <input type="submit" value="Loan">

    </form>
  </div>
  <?php
}
else {
  ?>
  <input type="button" class="unactive" value="To loan, you need to sign up">
  <?php
}
?>
