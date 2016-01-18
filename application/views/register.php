
    <?php echo validation_errors(); ?>
    <form class="form-horizontal" action="/index.php/auth/register" method="post">
      <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>
        <div class="controls">
          <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="nickname">NickName</label>
        <div class="controls">
          <input type="text" id="nickname" name="nickname" value="<?php echo set_value('nickname'); ?>"  placeholder="NickName">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls">
          <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>"   placeholder="Password">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="re_password">Confirm Password</label>
        <div class="controls">
          <input type="password" id="re_password" name="re_password" value="<?php echo set_value('re_password'); ?>"   placeholder="Confirm Password">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
          <input type="submit" class="btn btn-primary" value="회원가입" />
        </div>
      </div>
    </form>
