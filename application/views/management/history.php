<div class="fill">
  <div class="bg-white">
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
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>
  </p>
  <p class="text-center">
    <?=anchor('management','Return', $arrayName = array('class' => 'user-anchor' ))?>
  </p>
  </div>
</div>
