<?php

switch($this->session->userdata('employeeId')) {
  case 1: {
    ?>
    <p>
      <?=anchor('management/manageEmployees','Manage employees')?>
    </p>
    <p>
      <?=anchor('management/history','Leasing history')?>
    </p>
    <?php
    break;
  }
  case 2: {
    ?>
    <p>
      <?=anchor('management/addMark','Add new mark')?>
    </p>
    <p>
      <?=anchor('management/addModel','Add new model')?>
    </p>
    <p>
      <?=anchor('management/addCar','Add new car')?>
    </p>
    <?php
    break;
  }
  case 3: {
    ?>
    <?php
    break;
  }
}

?>
