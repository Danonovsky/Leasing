<?=validation_errors()?>

<?=form_open(site_url('management/editEmployee/'.$employee['id']))?>

<p>
  <label for="name">Name:</label>
  <input type="text" name="name" value="<?=$employee['name']?>">
</p>

<p>
  <label for="surname">Surname:</label>
  <input type="text" name="surname" value="<?=$employee['surname']?>">
</p>

<p>
  <label for="email">E-mail:</label>
  <input type="email" name="email" value="<?=$employee['email']?>">
</p>

<p>
  <label for="city">City:</label>
  <input type="text" name="city" value="<?=$employee['city']?>">
</p>

<p>
  <label for="phoneNr">Phone Number:</label>
  <input type="text" name="phoneNr" value="<?=$employee['phoneNr']?>">
</p>

<p>
  <label for="rank">Rank:</label>
  <select name="rank">
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
  <input type="submit" value="Save changes">
</p>

<p>
  <?=anchor('management/manageEmployees','Return')?>
</p>

<?=$this->session->flashdata('editEmployeeMessage')?>

</form>
