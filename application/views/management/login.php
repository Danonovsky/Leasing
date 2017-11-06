<?php echo validation_errors(); ?>

<?php echo form_open('management'); ?>

  <label for='email'>E-mail:</label>
  <input type="email" name="email">
  <br>

  <label for='password'>Password:</label>
  <input type="password" name="password">
  <br>

  <input type="submit" name="submit" value="Log in">

</form>

<?php
if($this->session->flashdata('adminLoginMessage')) {
  echo $this->session->flashdata('adminLoginMessage');
}
?>
