<?=validation_errors()?>

<?=form_open(site_url('page/register'))?>

<p>
  <label for="name">Imię:</label>
  <input type="text" name="name">
</p>

<p>
  <label for="surname">Nazwisko:</label>
  <input type="text" name="surname">
</p>

<p>
  <label for="email">E-mail:</label>
  <input type="email" name="email">
</p>

<p>
  <label for="password">Hasło:</label>
  <input type="password" name="password">
</p>

<p>
  <label for="password1">Powtórz hasło:</label>
  <input type="password" name="password1">
</p>

<p>
  <label for="city">Miasto:</label>
  <input type="text" name="city">
</p>

<p>
  <label for="phoneNr">Nr telefonu:</label>
  <input type="text" name="phoneNr">
</p>

<p>
  <input type="submit" value="Zarejestruj się">
</p>

</form>
