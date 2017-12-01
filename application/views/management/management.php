<div class="fill">
  <div class="user-access bg-white col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <?php

    switch($this->session->userdata('employeeRank')) {
      case 1: {
        ?>
        <p>
          <?=anchor('management/manageEmployees','Manage employees', $arrayName = array('class' => 'user-anchor' ))?>
        </p>
        <p>
          <?=anchor('management/history','Leasing history', $arrayName = array('class' => 'user-anchor' ))?>
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
                <th>Wage</th>
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
                    <td><?=$a['wage']?></td>
                    <td><?=anchor('management/deleteCar/'.$a['id'],'Delete', $arrayName = array('class' => 'user-anchor'))?></td>
                  </tr>
                  <?php
                }
              }
              ?>
              <tr>
                <td class="text-center" colspan="9"><?=anchor('management/newCar','Add new car', $arrayName = array('class' => 'user-anchor'))?></td>
              </tr>
            </tbody>
          </table>
        </p>
        <?php
        break;
      }
      case 3: {
        ?>
        <p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Id</th>
                <th>Start</th>
                <th>End</th>
                <th>Client ID</th>
                <th>Client Data</th>
                <th>Employee ID</th>
                <th>Employee Data</th>
                <th>Car ID</th>
                <th>Car Name</th>
                <th>Car Data</th>
                <th>Cost</th>
                <th>Confirmed</th>
                <th colspan="2">Management</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if($loans) {
                foreach($loans as $a) {
                  ?>
                  <tr>
                    <td><?=$a['id']?></td>
                    <td><?=$a['startDate']?></td>
                    <td><?=$a['endDate']?></td>
                    <td><?=$a['userId']?></td>
                    <td><?=$a['userName'].' '.$a['userSurname']?></td>
                    <td><?=$a['employeeId']?></td>
                    <td><?=$a['employeeName'].' '.$a['employeeSurname']?></td>
                    <td><?=$a['carId']?></td>
                    <td><?=$a['carName']?></td>
                    <td><?=$a['carMark'].' '.$a['carModel']?></td>
                    <td><?=$a['cost']?></td>
                    <td><?=$a['confirmed']?></td>
                    <td>
                      <?php
                      if(!$a['confirmed']) {
                        echo anchor('management/acceptLoan/'.$a['id'],'Accept', $arrayName = array('class' => 'user-anchor' ));
                      }
                      else {
                        echo 'Accepted';
                      }
                      ?>
                    </td>
                    <td><?=anchor('management/deleteLoan/'.$a['id'],'Delete', $arrayName = array('class' => 'user-anchor' ))?></td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </p>

        <p>
          <?=$this->session->flashdata('eLoanMessage')?>
        </p>
        <?php
        break;
      }
    }

    ?>
  </div>
</div>
