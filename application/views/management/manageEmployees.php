<div class="fill">
  <div class="bg-white">
    <table class="table table-bordered" style="text-align: center;">
      <thead>
        <tr>
          <th>Id</th>
          <th>Data</th>
          <th>Rank</th>
          <th colspan="2">Management</th>
        </tr>
      </thead>
      <tbody>
    <?php
    if($employees) {
      foreach($employees as $a) {
        ?>
        <tr>
          <td><?=$a['id']?></td>
          <td><?=$a['name'].' '.$a['surname']?></td>
          <td><?=$a['rank']?></td>
          <td><?=anchor('management/editEmployee/'.$a['id'],'Edit', $arrayName = array('class' => 'user-anchor' ))?></td>
          <td><?=anchor('management/deleteEmployee/'.$a['id'],'Delete', $arrayName = array('class' => 'user-anchor' ))?></td>
        </tr>
        <?php
      }

    }
    ?>
        <tr>
          <td colspan="5">
            <?=anchor('management/newEmployee','New employee', $arrayName = array('class' => 'user-anchor' ))?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
