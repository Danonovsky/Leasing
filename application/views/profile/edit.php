<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <?=form_open('profile/edit')?>
      <p>
        <label class="margin label label-default" for="name">Name: </label>
        <input class="margin form-control input-sizer" type="text" name="name" value="<?=$this->session->userdata('name')?>">
      </p>

      <p>
        <label class="margin label label-default" for="surname">Surname: </label>
        <input class="margin form-control input-sizer" type="text" name="surname" value="<?=$this->session->userdata('surname')?>">
      </p>

      <p>
        <label class="margin label label-default" for="phoneNr">Phone Number: </label>
        <input class="margin form-control input-sizer" type="text" name="phoneNr" value="<?=$this->session->userdata('phoneNr')?>">
      </p>

      <p>
        <label class="margin label label-default" for="city">City: </label>
        <input class="margin form-control input-sizer" type="text" name="city" value="<?=$this->session->userdata('city')?>">
      </p>

      <p>
        <input class="btn btn-default" type="submit" name="submit" value="Save changes">
      </p>
    </form>

    <?php
    if($this->session->flashdata('updateMessage')) {
      echo $this->session->flashdata('updateMessage');
    }
    ?>
    <p>
      <?=anchor('profile','Return', $arrayName = array('class' => 'user-anchor' ))?>
    </p>
  </div>
</div>
