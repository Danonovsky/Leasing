<?php

switch($this->session->userdata('employeeRank')) {
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
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Mark</th>
            <th>Model</th>
            <th>Engine</th>
            <th>Year</th>
            <th>Body</th>
            <th>Management</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($cars) {
            foreach($cars as $a) {
              ?>
              <tr>
                <td><?=$a['id']?></td>
                <td><?=$a['name']?></td>
                <td><?=$a['mark']?></td>
                <td><?=$a['model']?></td>
                <td><?=$a['capacity'].' '.$a['fuel']?></td>
                <td><?=$a['year']?></td>
                <td><?=$a['body']?></td>
                <td><?=anchor('management/deleteCar/'.$a['id'],'Delete')?></td>
              </tr>
              <?php
            }
          }
          ?>
          <tr>
            <td colspan="8"><?=anchor('management/newCar','Add new car')?></td>
          </tr>
        </tbody>
      </table>
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
