<section>
  <?=validation_errors()?>

  <?=form_open('page/login')?>
    <p>
      <label for="email">E-mail: </label>
      <input type="email" name="email">
    </p>
    <p>
      <label for="password">Password:</label>
      <input type="password" name="password">
    </p>
    <p>
      Haven't created account yet?? <?=anchor('page/register','Create one')?>
    </p>
    <p>
      <input type="submit" value="Log In">
    </p>
    <p>
      <?=$this->session->flashdata('loginMessage')?>
    </p>
  </form>
</section>
