<div class="col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10 top-padding">
  <div class="bg-white padding-left margin-bottom offer-text">
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
      <input type="button" class="unactive btn btn-primary" value="Car currently loaned">
      <?php
    }

    elseif($logged) {
      ?>
      <div class="form">
        <?=form_open('offer/loan/'.$car['basic']['id'])?>
        <input type="hidden" name="wage" value="<?=$car['basic']['wage']?>">
        <p>
          <label class="margin label label-default font-sizer-bigger" for"startDate">Start date: </label>
          <input class="margin form-control input-sizer display-fix" type="date" name="startDate" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>">
        </p>

        <p>
          <label class="margin label label-default font-sizer-bigger" for"endDate">End date: </label>
          <input class="margin form-control input-sizer display-fix" type="date" name="endDate" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>">
        </p>

        <input class="btn btn-primary" type="submit" value="Loan">

        </form>
      </div>
      <?php
    }
    else {
      ?>
      <input type="button" class="unactive btn btn-primary" value="To loan, you need to sign up">
      <?php
    }
    ?>
  </div>
</div>
