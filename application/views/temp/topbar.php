<section>
  <?php
  if($logged) {
    ?>
    <p>
      <span><?=anchor('profile','Mój profil')?></span>
      <span><?=anchor('page/logout','Wyloguj')?></span>
    </p>
    <?php
  }
  else {
    ?>
    <p><?=anchor('page/register','Zarejestruj się').', '.anchor('page/login','Zaloguj się')?></p>
    <?php
  }
  ?>
</section>
