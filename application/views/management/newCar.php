<?=validation_errors()?>

<input type="hidden" id="baseUrl" data-baseurl="<?=base_url()?>">

<?=form_open('management/newCar')?>

<p>
  <label for="mark">Mark</label>
  <select name="mark" id="mark">
    <?php
    foreach($marks as $a) {
      ?>
      <option value="<?=$a['id']?>"><?=$a['name']?></option>
      <?php
    }
    ?>
  </select>
</p>

<p>
  <label for="model">Model</label>
  <select name="model" id="model">
  </select>
</p>

<p>
  <label for="body">Body</label>
  <select name="body">
    <?php
    foreach($bodies as $a) {
      ?>
      <option value="<?=$a['id']?>"><?=$a['name']?></option>
      <?php
    }
    ?>
  </select>
</p>

<p>
  <label for="fuel">Fuel</label>
  <select name="fuel">
    <?php
    foreach($fuels as $a) {
      ?>
      <option value="<?=$a['id']?>"><?=$a['name']?></option>
      <?php
    }
    ?>
  </select>
</p>

<p>
  <label for="capacity">Capacity</label>
  <input type="text" name="capacity">
</p>

<p>
  <label for="year">Year</label>
  <input type="text" name="year">
</p>

<p>
  <label for="name">Name</label>
  <input type="text" name="name">
</p>

<p>
  <input type="submit" value="Add car">
</p>

<p>
  <?=anchor('management','Return')?>
</p>

<p>
  <?=$this->session->flashdata('newCarMessage')?>
</p>
