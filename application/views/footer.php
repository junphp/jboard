      </div>
  </div>
</div>


<div id="footer">
      <div class="container">
            <div class="text-muted credit col-xs-6" style="display:inline-block;padding-top:10px;text-align:left">Wallog.net ©2016 Rights Reserved</div>
            <div class="btn text-muted credit col-xs-6 cotactbtn" style="display:inline-block;text-align:right"><a data-toggle="modal" data-target="#contact" data-original-title>Contact</a></div>
      </div>
</div>




<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="panel" style="border:0px;padding:30px;">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span style="color:#5d5d5d">×</span></button>
                        <div style="text-align:center;margin-top:0px;"><img src="/img/wallog-logo-2.png" style="display:inline-block" width="55px"><span class="tti" style="display:inline-block;vertical-align:middle;">Wal</span><span class="logtitle" style="display:inline-block;vertical-align:middle;">log</span></div>
                        <h3 style="text-align:center;color:#4d90fe;font-weight:bold;">Contact</h3>
                    </div>
                    <form action="#" method="post" accept-charset="utf-8" role="form" id="contact_form">
                    <div class="modal-body" style="padding: 5px;">

                          <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                    <input class="form-control" name="name" placeholder="Name" type="text" value="<?php echo set_value('name'); ?>" required autofocus />
                                    <div id="contact_n" style="color:red;font-size:13px;"></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                    <input class="form-control" name="email" placeholder="Email" type="email" value="<?php echo set_value('email'); ?>" required />
                                    <div id="contact_e" style="color:red;font-size:13px;"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                    <input class="form-control" name="subject" placeholder="Subject" type="text" value="<?php echo set_value('subject'); ?>" required />
                                    <div id="contact_s" style="color:red;font-size:13px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea style="resize:vertical;" class="form-control" placeholder="Message..." rows="6" name="message" value="<?php echo set_value('message'); ?>" required></textarea>
                                    <div id="contact_m" style="color:red;font-size:13px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="margin-bottom:-14px;border-top:0px;">
                            <input type="submit" class="btn btn-success" value="Send" id="contact_submit"/>
                                <!--<span class="glyphicon glyphicon-ok"></span>-->
                            <input type="reset" class="btn btn-danger" value="Clear" />
                                <!--<span class="glyphicon glyphicon-remove"></span>-->
                                <div id="submit_ani" class="contacthani"></div>
                                <div id="msgSubmit" class="contacthmsg hidden" align="center">Message Submitted!</div>
                            <button style="float: right;" type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/lib/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
