<section>
  <?=validation_errors()?>

  <?=form_open('page/login')?>
    <p>
      <label for="email">E-mail: </label>
      <input type="email" name="email">
    </p>
    <p>
      <label for="password">Hasło:</label>
      <input type="password" name="password">
    </p>
    <p>
      Nie posiadasz konta? <?=anchor('page/register','Zarejestruj się')?>
    </p>
    <p>
      <input type="submit" value="Zaloguj się">
    </p>
    <p>
      <?=$this->session->flashdata('loginMessage')?>
    </p>
  </form>
</section>
