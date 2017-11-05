<?=validation_errors()?>

<?=form_open('profile/changePassword')?>
  <p>
    <label for="actualPassword">Aktualne hasło: </label>
    <input type="password" name="actualPassword">
  </p>

  <p>
    <label for="password">Nowe hasło: </label>
    <input type="password" name="password">
  </p>

  <p>
    <label for="password1">Powtórz nowe hasło: </label>
    <input type="password" name="password1">
  </p>

  <p>
    <input type="submit" name="submit" value="Zapisz zmiany">
  </p>
</form>

<?php
if($this->session->flashdata('passwordMessage')) {
  echo $this->session->flashdata('passwordMessage');
}
?>
<p>
  <?=anchor(site_url('profile'),'Powrót')?>
</p>
