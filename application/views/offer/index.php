<input type="hidden" id="baseUrl" data-baseurl="<?=base_url()?>">
<input type="hidden" id="page" data-page="<?=$page?>">

  <div class="col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <p>
      <h2>Our company offers wide selection of cars </h2>
      <div class="form-group">
        <label for="offerOrder" class="label label-default font-sizer-bigger">Order by: </label>
        <select class="form-control input-sizer-small display-fix" id="offerOrder">
        <option data-orderby="none" data-way="none">none</option>
        <option data-orderby="mark" data-way="ASC">Mark /\</option>
        <option data-orderby="mark" data-way="DESC">Mark \.</option>
        <option data-orderby="model" data-way="ASC">Model /\</option>
        <option data-orderby="model" data-way="DESC">Model \/</option>
        <option data-orderby="wage" data-way="ASC">Wage /\</option>
        <option data-orderby="wage" data-way="DESC">Wage \/</option>
      </select>
    </div>
    </p>

    <section class="offers">
    </section>

    <?=form_open('offer/perSite')?>
    <div class="form-group">
      <label for="perSite" class="label label-default font-sizer-bigger">Ile na stronę:</label>
      <select class="form-control input-sizer-small display-fix" name="perSite">
        <option value="5" <?php if($this->session->userdata('offersPerPage')==5) echo 'selected' ?>>5</option>
        <option value="10"<?php if($this->session->userdata('offersPerPage')==10) echo 'selected' ?>>10</option>
        <option value="20"<?php if($this->session->userdata('offersPerPage')==20) echo 'selected' ?>>20</option>
        <option value="99"<?php if($this->session->userdata('offersPerPage')==99) echo 'selected' ?>>wszystkie</option>
        <input class="btn btn-default" type="submit" value="Zmień">
      </select>
    </div>
    </form>
    <?php
    if($this->session->userdata('offersPerPage')!=99) {
      ?>
      <section class="pagination">
      <?=$this->pagination->create_links()?>
      </section>
      <?php
    }
    ?>
  </div>
