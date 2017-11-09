<input type="hidden" id="baseUrl" data-baseurl="<?=base_url()?>">
<input type="hidden" id="page" data-page="<?=$page?>">

<p>
  <label>Order by: </label>
  <select id="offerOrder">
    <option data-orderby="none" data-way="none">none</option>
    <option data-orderby="mark" data-way="ASC">Mark /\</option>
    <option data-orderby="mark" data-way="DESC">Mark \.</option>
    <option data-orderby="model" data-way="ASC">Model /\</option>
    <option data-orderby="model" data-way="DESC">Model \/</option>
    <option data-orderby="wage" data-way="ASC">Wage /\</option>
    <option data-orderby="wage" data-way="DESC">Wage \/</option>
  </select>
</p>

<section class="offers">
</section>

<?=form_open('offer/perSite')?>
<label for="perSite">Ile na stronę:</label>
<select name="perSite">
  <option value="5" <?php if($this->session->userdata('offersPerPage')==5) echo 'selected' ?>>5</option>
  <option value="10"<?php if($this->session->userdata('offersPerPage')==10) echo 'selected' ?>>10</option>
  <option value="20"<?php if($this->session->userdata('offersPerPage')==20) echo 'selected' ?>>20</option>
  <option value="99"<?php if($this->session->userdata('offersPerPage')==99) echo 'selected' ?>>wszystkie</option>
  <input type="submit" value="Zmień">
</select>
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
