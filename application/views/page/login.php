<section>
<div class="col-lg-4 col-lg-offset-4 col-md-offset-1 col-md-10"><?php echo validation_errors(); ?></div>

  <?=form_open('page/login')?>
  <div class="fill col-lg-6 col-lg-offset-3 col-md-offset-1 col-md-10">
    <div class="user-access bg-white col-lg-8 col-lg-offset-2">
      <p>
        <label class="margin label label-default" for="email">E-mail: </label>
        <input class="margin form-control input-sizer" type="email" name="email">
      </p>
      <p>
        <label class="margin label label-default" for="password">Password:</label>
        <input class="margin form-control input-sizer" type="password" name="password">
      </p>
      <p>
        Haven't created account yet? <?=anchor('page/register','Create one',$arrayName = array('class' => 'user-anchor' ))?>
      </p>
      <p>
        <input class="margin btn btn-default" type="submit" value="Log In">
      </p>
      <p>
        <?=$this->session->flashdata('loginMessage')?>
      </p>
    </div>
  </form>
</div>
</section>
