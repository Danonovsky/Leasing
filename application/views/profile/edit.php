<?=validation_errors()?>

<?=form_open('profile/edit')?>
  <p>
    <label for="name">Imię: </label>
    <input type="text" name="name" value="<?=$this->session->userdata('name')?>">
  </p>

  <p>
    <label for="surname">Nazwisko: </label>
    <input type="text" name="surname" value="<?=$this->session->userdata('surname')?>">
  </p>

  <p>
    <label for="phoneNr">Numer telefonu: </label>
    <input type="text" name="phoneNr" value="<?=$this->session->userdata('phoneNr')?>">
  </p>

  <p>
    <label for="city">Miasto: </label>
    <input type="text" name="city" value="<?=$this->session->userdata('city')?>">
  </p>

  <p>
    <input type="submit" name="submit" value="Zapisz zmiany">
  </p>
</form>

<?php
if($this->session->flashdata('updateMessage')) {
  echo $this->session->flashdata('updateMessage');
}
?>
<p>
  <?=anchor(site_url('profile'),'Powrót')?>
</p>
