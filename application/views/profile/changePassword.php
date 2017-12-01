<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <?=form_open('profile/changePassword')?>
      <p>
        <label class="margin label label-default" for="actualPassword">Actual password: </label>
        <input class="margin form-control input-sizer" type="password" name="actualPassword">
      </p>

      <p>
        <label class="margin label label-default" for="password">New password: </label>
        <input class="margin form-control input-sizer" type="password" name="password">
      </p>

      <p>
        <label class="margin label label-default" for="password1">Repeat new password: </label>
        <input class="margin form-control input-sizer" type="password" name="password1">
      </p>

      <p>
        <input class="btn btn-default" type="submit" name="submit" value="Save changes">
      </p>
    </form>

    <?php
    if($this->session->flashdata('passwordMessage')) {
      echo $this->session->flashdata('passwordMessage');
    }
    ?>
    <p>
      <?=anchor('profile','Return', $arrayName = array('class' => 'user-anchor' ))?>
    </p>
  </div>
</div>
