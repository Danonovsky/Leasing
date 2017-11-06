<?=validation_errors()?>

<?=form_open(site_url('management/newEmployee'))?>

<p>
  <label for="name">Name:</label>
  <input type="text" name="name">
</p>

<p>
  <label for="surname">Surname:</label>
  <input type="text" name="surname">
</p>

<p>
  <label for="email">E-mail:</label>
  <input type="email" name="email">
</p>

<p>
  <label for="password">Password:</label>
  <input type="password" name="password">
</p>

<p>
  <label for="password1">Repeat password:</label>
  <input type="password" name="password1">
</p>

<p>
  <label for="city">City:</label>
  <input type="text" name="city">
</p>

<p>
  <label for="phoneNr">Phone number:</label>
  <input type="text" name="phoneNr">
</p>

<p>
  <label for="rank">Rank:</label>
  <select name="rank">
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
  <input type="submit" value="Add employee">
</p>

<p>
  <?=anchor('management/manageEmployees','Return')?>
</p>

<?=$this->session->flashdata('newEmployeeMessage')?>

</form>
