<section>
  <?php
  if($logged) {
    ?>
    <p>
      <span><?=anchor('profile','My profile')?></span>
      <span><?=anchor('page/logout','Log Out')?></span>
    </p>
    <?php
  }
  else {
    ?>
    <p>
      <span><?=anchor('page/register','Register')?></span>
      <span><?=anchor('page/login','Log in')?></span>
    </p>
    <?php
  }
  ?>
</section>
