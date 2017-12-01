<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <?=form_open(site_url('management/editEmployee/'.$employee['id']))?>

    <p>
      <label class="margin label label-default" for="name">Name:</label>
      <input class="margin form-control input-sizer" type="text" name="name" value="<?=$employee['name']?>">
    </p>

    <p>
      <label class="margin label label-default" for="surname">Surname:</label>
      <input class="margin form-control input-sizer" type="text" name="surname" value="<?=$employee['surname']?>">
    </p>

    <p>
      <label class="margin label label-default" for="email">E-mail:</label>
      <input class="margin form-control input-sizer" type="email" name="email" value="<?=$employee['email']?>">
    </p>

    <p>
      <label class="margin label label-default" for="city">City:</label>
      <input class="margin form-control input-sizer" type="text" name="city" value="<?=$employee['city']?>">
    </p>

    <p>
      <label class="margin label label-default" for="phoneNr">Phone Number:</label>
      <input class="margin form-control input-sizer" type="text" name="phoneNr" value="<?=$employee['phoneNr']?>">
    </p>

    <p>
      <label class="margin label label-default" for="rank">Rank:</label>
      <select class="margin form-control input-sizer" name="rank">
        <?php
        foreach($ranks as $a) {
          ?>
          <option <?php if($a['id']==$employee['rankId']) echo 'selected'; ?> value="<?=$a['id']?>"><?=$a['name']?></option>
          <?php
        }
        ?>
      </select>
    </p>

    <p>
      <input class="btn btn-default" type="submit" value="Save changes">
    </p>

    <p>
      <?=anchor('management/manageEmployees','Return',$arrayName = array('class' => 'user-anchor' ))?>
    </p>

    <?=$this->session->flashdata('editEmployeeMessage')?>

    </form>
  </div>
</div>
