<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <?=form_open(site_url('management/newEmployee'))?>

    <p>
      <label class="margin label label-default" for="name">Name:</label>
      <input class="margin form-control input-sizer" type="text" name="name">
    </p>

    <p>
      <label class="margin label label-default" for="surname">Surname:</label>
      <input class="margin form-control input-sizer" type="text" name="surname">
    </p>

    <p>
      <label class="margin label label-default" for="email">E-mail:</label>
      <input class="margin form-control input-sizer" type="email" name="email">
    </p>

    <p>
      <label class="margin label label-default" for="password">Password:</label>
      <input class="margin form-control input-sizer" type="password" name="password">
    </p>

    <p>
      <label class="margin label label-default" for="password1">Repeat password:</label>
      <input class="margin form-control input-sizer" type="password" name="password1">
    </p>

    <p>
      <label class="margin label label-default" for="city">City:</label>
      <input class="margin form-control input-sizer" type="text" name="city">
    </p>

    <p>
      <label class="margin label label-default" for="phoneNr">Phone number:</label>
      <input class="margin form-control input-sizer" type="text" name="phoneNr">
    </p>

    <p>
      <label class="margin label label-default" for="rank">Rank:</label>
      <select class="margin form-control input-sizer" name="rank">
        <?php
        foreach($ranks as $a) {
          ?>
          <option value="<?=$a['id']?>"><?=$a['name']?></option>
          <?php
        }
        ?>
      </select>
    </p>

    <p>
      <input class="btn btn-default" type="submit" value="Add employee">
    </p>

    <p>
      <?=anchor('management/manageEmployees','Return', $arrayName = array('class' => 'user-anchor' ))?>
    </p>

    <?=$this->session->flashdata('newEmployeeMessage')?>

    </form>
  </div>
</div>
