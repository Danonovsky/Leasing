<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <?php echo form_open('management'); ?>

      <label class="margin label label-default" for='email'>E-mail:</label>
      <input class="margin form-control input-sizer" type="email" name="email">
      <br>

      <label class="margin label label-default" for='password'>Password:</label>
      <input class="margin form-control input-sizer" type="password" name="password">
      <br>

      <input class="btn btn-default" type="submit" name="submit" value="Log in">

    </form>

    <?php
    if($this->session->flashdata('adminLoginMessage')) {
      echo $this->session->flashdata('adminLoginMessage');
    }
    ?>
  </div>
</div>
