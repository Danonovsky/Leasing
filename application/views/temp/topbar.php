<section class="top-panel">
  <div class="col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10 text-right top-padding">
      <?php
      if($logged) {
        ?>
        <p>
          <span><?=anchor('profile','My profile ', $arrayName = array('class' => 'user-anchor'))?></span>
          <span><?=anchor('page/logout','Log Out ', $arrayName = array('class' => 'user-anchor'))?></span>
        </p>
        <?php
      }
      else {
        ?>
        <p>
          <span><?=anchor('page/register','Zarejestruj się  <span class="glyphicon glyphicon-pencil">  </span>', $arrayName = array('class' => 'user-anchor'))?></span>
          <span><?=anchor('page/login','Zaloguj się <span class="glyphicon glyphicon-user">  </span>', $arrayName = array('class' => 'user-anchor'))?></span>
        </p>
        <?php
      }
      ?>
  </div>
</section>
