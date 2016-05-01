


<div id="wrap">
  <div id="formload"></div>

  <div class="navbar-wrapper">
      <div class="container-fluid">
          <nav class="navbar navbar-fixed-top">
              <div class="container">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand"  style="display:inline-block;outline:0;margin-top:-8px;" href="/"><img src="/img/wallog-logo-w-1.png" width="55px;" style="display:inline-block;float:left;"><span class="logoti" style="display:inline-block;vertical-align:middle;">Wal</span><span class="logtitle" style="display:inline-block;vertical-align:middle;">log</span></a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                      <ul class="nav navbar-nav">

                        <li class="dropdown">	<a class="dropdown-toggle nana" data-toggle="dropdown" href="#">Interests<b class="caret" style="display:none;"></b></a>

                                <ul class="dropdown-menu active">
                                    <!-- 1st Top Nav links -->
                                    <li><a href="/auto">Auto</a>
                                    </li>
                                    <li><a href="/wall">wall</a>
                                    </li>
                                    <li><a href="/picture">picture</a>
                                    </li>
                                    <li><a href="#">Separated link</a>
                                    </li>
                                    <li><a href="#">One more separated link</a>
                                    </li>
                        </ul>
                        </li>



                          <li class="active"><a href="#" class="dropdown-toggle " data-toggle="dropdown" >Life<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                    <li >
                                        <a href="/car" class="dropdown-toggle "  role="button" aria-haspopup="true" aria-expanded="false">Car</a>
                                    </li>
                                  <li><a href="/wall">wall</a></li>
                                  <li><a href="/picture">YouTube</a></li>
                              </ul>
                          </li>

                          <li><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hobby<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                      <li class=" dropdown">
                                          <a href="/picture" class="dropdown-toggle "  role="button" aria-haspopup="true" aria-expanded="false">Game</a>
                                      </li>
                                      <li><a href="#">YouTube</a></li>
                                </ul>
                          </li>
                          <li><a href="#">Food</a></li>
                          <li><a href="#">Sport</a></li>
                      </ul>
                      <ul class="nav navbar-nav pull-right">
                        <?php
                            if($this->session->userdata('is_login')){
                          ?>
                              <li><a href="/auth/logout">Log Out</a></li>
                            <?php
                            } else {
                            ?>
                              <li><a href="#" data-toggle="modal" data-target="#login-modal" style="outline: 0;">Log In</a></li>
                              <li><a href="#" data-toggle="modal" data-target="#register-modal" style="outline: 0;">Register</a></li>

                            <?php
                            }
                            ?>
                      </ul>
                  </div>
              </div>
          </nav>
      </div>
  </div>























<!--login form modal-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
      <div class="loginmodal-container">
        <div style="text-align:center;margin-top:0px;"><img src="/img/wallog-logo-2.png" style="display:inline-block" width="55px"><span class="tti" style="display:inline-block;vertical-align:middle;">Wal</span><span class="logtitle" style="display:inline-block;vertical-align:middle;">log</span></div>
                <form role="form"  method="post" id="login-form" style="display: block;">

                    <h1>Login to Your Account</h1><br>

                    <input type="email" id="login_email" tabindex="1" name="email" placeholder="Useremail" value="<?php echo set_value('email'); ?>" required autofocus>

                    <input type="password" id="login_password" tabindex="2" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required autofocus>

                    <div id="error_message" style="color:red;text-align:center;margin-top:15px;margin-bottom:15px;"></div>

                    <input type="submit" name="login" class="login loginmodal-submit" value="Login" id="modalresult">

                    <div class="login-help">

                        <div class="left">
                              <a class="signup-btn" href="#" >Forgot Password</a>
                        </div>

                        <div class="right">
                              <a class="signup-btn" id="register-form-link" href="#" style="opacity: 1;font-weight:bold;text-align:right;">Create New Account</a>
                        </div>

                    </div>
                      <div id="cleared"></div>
                </form>

                <form id="register-form" action="<?=base_url() ?>auth/register?returnURL=<?=current_url()?>" method="post" role="form" style="display: none;">

                      <h1>Create New Account</h1><br>

                      <div class="form-group">
                            <input type="text" name="nickname" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo set_value('nickname'); ?>" style="height:44px;"required autofocus>
                            <div id="rnerror" style="color:red;font-size:13px;"></div>
                      </div>
                      <div class="form-group">
                            <input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="Email Address" value="<?php echo set_value('email'); ?>" required autofocus>
                            <div id="reerror" style="color:red;font-size:13px;" ></div>
                      </div>
                      <div class="form-group">
                            <input type="password" name="password" id="password" tabindex="3" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required autofocus>
                            <div id="rperror" style="color:red;font-size:13px;"></div>
                      </div>
                      <div class="form-group">
                            <input type="password" name="re_password" id="confirm-password" tabindex="4" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('re_password'); ?>" required autofocus>
                            <div id="rrperror" style="color:red;font-size:13px;"></div>
                      </div>
                      <div class="form-group">
                            <input type="submit" name="register-submit" id="register-submit" class="login loginmodal-submit" value="Register Now">
                      </div>

                      <div class="login-help" style="float:right;">

                      <a class="signup-btn" id="login-form-link" href="#" style="opacity: 1;padding-left:10px;font-weight:bold;float:right;">Already have an account? Log In</a>

                      </div>
                </form>


      </div>
    </div>
  </div>

<!--register modal-->
  <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <div style="text-align:center;margin-top:0px;"><img src="/img/wallog-logo-2.png" style="display:inline-block" width="55px"><span class="tti" style="display:inline-block;vertical-align:middle;">Wal</span><span class="logtitle" style="display:inline-block;vertical-align:middle;">log</span></div>
                  <form role="form"  action="<?=base_url() ?>auth/authentication?returnURL=<?=current_url()?>" method="post" id="login-form-r" style="display: none;">

                      <h1>Login to Your Account</h1><br>

                      <input type="email" id="login_email" tabindex="1" name="email" placeholder="Useremail" value="<?php echo set_value('email'); ?>" required autofocus>

                      <input type="password" id="login_password" tabindex="2" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required autofocus>

                      <div id="error_message-r" style="color:red;text-align:center;margin-top:15px;margin-bottom:15px;"></div>

                      <input type="submit" name="login" class="login loginmodal-submit" value="Login" id="modalresult-r">

                      <div class="login-help">

                          <div class="left">
                                <a class="signup-btn" href="#" >Forgot Password</a>
                          </div>

                          <div class="right">
                                <a class="signup-btn" id="register-form-link-r" href="#" style="opacity: 1;font-weight:bold;text-align:right;">Create New Account</a>
                          </div>

                      </div>
                        <div id="cleared"></div>
                  </form>

                  <form id="register-form-r" action="<?=base_url() ?>auth/register?returnURL=<?=current_url()?>" method="post" role="form" style="display: block;">

                      <h1>Create New Account</h1><br>

                        <div class="form-group">
                              <input type="text" name="nickname" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo set_value('nickname'); ?>" style="height:44px;"required autofocus>
                              <div id="rnerror-r" style="color:red;font-size:13px;"></div>
                        </div>
                        <div class="form-group">
                              <input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="Email Address" value="<?php echo set_value('email'); ?>" required autofocus>
                              <div id="reerror-r" style="color:red;font-size:13px;" ></div>
                        </div>
                        <div class="form-group">
                              <input type="password" name="password" id="password" tabindex="3" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" required autofocus>
                              <div id="rperror-r" style="color:red;font-size:13px;"></div>
                        </div>
                        <div class="form-group">
                              <input type="password" name="re_password" id="confirm-password" tabindex="4" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('re_password'); ?>" required autofocus>
                              <div id="rrperror-r" style="color:red;font-size:13px;"></div>
                        </div>
                        <div class="form-group">
                              <input type="submit" name="register-submit" id="register-submit-r" class="login loginmodal-submit" value="Register Now">
                        </div>

                        <div class="login-help" style="float:right;">

                        <a class="signup-btn" id="login-form-link-r" href="#" style="opacity: 1;padding-left:10px;font-weight:bold;float:right;">Already have an account? Log In</a>

                        </div>
                  </form>


        </div>
      </div>
    </div>














<!--- old modal login
      <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

       Modal content
      <div class="modal-content">
        <div class="modal-header" style="background-color:#333;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="background-color:#333;"><span class="glyphicon glyphicon-log-in"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form"  action="<?=base_url() ?>auth/authentication?returnURL=<?=current_url()?>" method="post" id="login_form">

            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-envelope"></span> Username</label>
              <input type="email" class="form-control" id="username" placeholder="Enter email" name="email" value="<?php echo set_value('email');?>" required autofocus>
              <?php echo form_error('eamil');?>
            </div>

            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-lock"></span> Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo set_value('password');?>" required><span id="password_verify" class="verify">
                <?php echo form_error('password');?>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off" id="login_submit"></span> Login</button>
                        <div  id="login_error"></div>
          </form>
            <div style="color:red"><?php echo validation_errors(); ?></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>

    </div>
  </div>
old moal login end --->







<div class="container">
    <div class="row">
