<?=validation_errors()?>

<?=form_open_multipart('profile/newAnnouncment')?>
  <p>
    <label for="title">Tytuł ogłoszenia: </label>
    <input type="text" name="title">
  </p>

  <p>
    <label for="category">Kategoria: </label>
    <select name="category" id="category">
      <option value="-1">Kategoria</option>
      <?php
      foreach($categories as $a) {
        ?>
        <option value="<?=$a['id']?>"><?=str_replace('_',' ',$a['name'])?></option>
        <?php
      }
      ?>
    </select>
  </p>

  <span id="subData">
  </span>

  <p>
    <label for="price">Cena: </label>
    <input type="number" name="price" step="0.01" min="0">
  </p>

  <p>
    <label for="description">Opis: </label>
    <textarea name="description" placeholder="Opis..."></textarea>
  </p>

  <p>
    <label for="pictures">Zdjęcia (1-sze jest główne): </label>
    <input id="pictures" type="file" name="pictures[]" accept="image/*" multiple>
    <div class="previewPictures">
    </div>
  </p>

  <p>
    <input type="submit" name="submit" value="Zapisz zmiany">
  </p>

  <p>
    <?php
    if($this->session->flashdata('addAnnouncmentError')) echo $this->session->flashdata('addAnnouncmentError');
    ?>
  </p>
</form>

<p>
  <?=anchor(site_url('profile'),'Powrót')?>
</p>
