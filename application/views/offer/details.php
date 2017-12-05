<div class="container">
  <div class="panel panel-default">
    <?php
    if(count($car['pictures'])>0) $hasPictures=true;
    else $hasPictures=false;

    if($hasPictures) {
      $src=base_url($car['pictures'][0]['path']);
      $alt="picture";
    }
    else {
      $src=base_url('img/nopic.png');
      $alt="no picture";
    }
    ?>
    <div class="panel-heading">
      <h2><?=$car['basic']['name']?></h2>
    </div>
    <div class="panel-body">
      <div class="col-xs-12 col-md-4">
        <?php
        if($hasPictures) {
          ?>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php
            for($i=0;$i<count($car['pictures']);$i++) {
              ?>
              <li data-target="#myCarousel" data-slide-to="<?=$i?>" <?php if($i==0) echo 'class="active"';?>></li>
              <?php
            }
             ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <?php
            for($i=0;$i<count($car['pictures']);$i++) {
              ?>
              <div class="item <?php if($i==0) echo 'active' ?>">
                <img src="<?=base_url($car['pictures'][$i]['path'])?>" alt="<?=$alt?>">
              </div>
              <?php
            }
             ?>
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
          <?php
        }
        else {
          ?>
          <img class="img-responsive" src="<?=$src?>" alt="<?=$alt?>">
          <?php
        }
         ?>
      </div>
      <div class="col-xs-12 col-md-8">
        <p><strong>Mark</strong>: <?=$car['basic']['mark']?></p>
        <p><strong>Model</strong>: <?=$car['basic']['model']?></p>
        <p><strong>Year</strong>: <?=$car['basic']['year']?></p>
        <p><strong>Capacity</strong>: <?=$car['basic']['capacity']?></p>
        <p><strong>Fuel</strong>: <?=$car['basic']['fuel']?></p>
        <p><strong>Body</strong>: <?=$car['basic']['body']?></p>
        <p><strong>Wage (monthly)</strong>: <?=$car['basic']['wage']?></p>
        <hr>
        <?php
        if($loaned) {
          ?>
          <input type="button" class="unactive btn btn-primary" value="Car currently loaned">
          <?php
        }
        elseif($logged) {
          ?>
          <div class="form">
            <?=form_open('offer/loan/'.$car['basic']['id'])?>
            <input type="hidden" name="wage" value="<?=$car['basic']['wage']?>">
            <p>
              <label class="margin label label-default font-sizer-bigger" for"startDate">Start date: </label>
              <input class="margin form-control input-sizer display-fix" type="date" name="startDate" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>">
            </p>

            <p>
              <label class="margin label label-default font-sizer-bigger" for"endDate">End date: </label>
              <input class="margin form-control input-sizer display-fix" type="date" name="endDate" min="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>">
            </p>

            <input class="btn btn-primary" type="submit" value="Loan">

            </form>
          </div>
          <?php
        }
        else {
          ?>
          <input type="button" class="unactive btn btn-primary" value="To loan, you need to sign up">
          <?php
        }
        ?>
      </div>

    </div>
  </div>
</div>
