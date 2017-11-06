<?=validation_errors()?>

<?=form_open('profile/changePassword')?>
  <p>
    <label for="actualPassword">Actual password: </label>
    <input type="password" name="actualPassword">
  </p>

  <p>
    <label for="password">New password: </label>
    <input type="password" name="password">
  </p>

  <p>
    <label for="password1">Repeat new password: </label>
    <input type="password" name="password1">
  </p>

  <p>
    <input type="submit" name="submit" value="Save changes">
  </p>
</form>

<?php
if($this->session->flashdata('passwordMessage')) {
  echo $this->session->flashdata('passwordMessage');
}
?>
<p>
  <?=anchor('profile','Return')?>
</p>
