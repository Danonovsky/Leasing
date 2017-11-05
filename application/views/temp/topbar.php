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
    <p>
      <span><?=anchor('page/register','Zarejestruj się')?></span>
      <span><?=anchor('page/login','Zaloguj się')?></span>
    </p>
    <?php
  }
  ?>
</section>
