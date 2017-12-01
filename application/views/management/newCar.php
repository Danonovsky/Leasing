<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <input type="hidden" id="baseUrl" data-baseurl="<?=base_url()?>">
    <?=form_open_multipart('management/newCar')?>

    <p>
      <label class="margin label label-default" for="mark">Mark</label>
      <select class="margin form-control input-sizer" name="mark" id="mark">
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
      <label class="margin label label-default" for="model">Model</label>
      <select class="margin form-control input-sizer" name="model" id="model">
      </select>
    </p>

    <p>
      <label class="margin label label-default" for="body">Body</label>
      <select class="margin form-control input-sizer" name="body">
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
      <label class="margin label label-default" for="fuel">Fuel</label>
      <select class="margin form-control input-sizer" name="fuel">
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
      <label class="margin label label-default" for="capacity">Capacity</label>
      <input class="margin form-control input-sizer" type="text" name="capacity">
    </p>

    <p>
      <label class="margin label label-default" for="year">Year</label>
      <input class="margin form-control input-sizer" type="text" name="year">
    </p>

    <p>
      <label class="margin label label-default" for="name">Name</label>
      <input class="margin form-control input-sizer" type="text" name="name">
    </p>

    <p>
      <label class="margin label label-default" for="wage">Wage (monthly): </label>
      <input class="margin form-control input-sizer" type="text" name="wage">
    </p>

    <p>
      <label class="margin label label-default" for="pictures">Pictures (1st is main): </label>
      <input class="margin form-control input-sizer" type="file" name="pictures[]" accept="image/*" multiple>
    </p>

    <p>
      <input class="btn btn-default" type="submit" value="Add car">
    </p>

    <p>
      <?=anchor('management','Return', $arrayName = array('class' => 'user-anchor' ))?>
    </p>

    <p>
      <?=$this->session->flashdata('newCarMessage')?>
    </p>
  </div>
</div>
