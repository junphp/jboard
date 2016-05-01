<div class="col-md-3" style="margin-bottom:50px;">
  <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background-color:#4d90fe;color:#ffffff;"><?= ucfirst(strtolower($table_name)); ?> log Recent Posts</div>

    <!-- List group -->
<?php foreach($latest as $entry){?>
    <ul class="list-group">
      <li class="list-group-item"><a href="<?= base_url()?><?= $table_name ?>/get/<?= $entry->id ?>"><?= $entry = character_limiter($entry->title,27); ?></a></li>
    </ul>
<?php } ?>
  </div>



    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading" style="background-color:#4d90fe;color:#ffffff;"><?= ucfirst(strtolower($table_name)); ?> log Recent Popular Posts</div>

      <!-- List group -->
  <?php foreach($popular as $entry){?>
      <ul class="list-group">
        <li class="list-group-item"><a href="<?= base_url()?><?= $table_name ?>/get/<?= $entry->id ?>"><?= $entry=character_limiter($entry->title,27); ?></a></li>
      </ul>
  <?php } ?>
    </div>

    <div>



      <div class="panel-heading" style="background-color:#4d90fe;color:#ffffff;"><?= ucfirst(strtolower($table_name)); ?> log Recent Popular Posts</div>
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>-->

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <img src="/static/user/fighternew_31601.png" alt="...">
                <div class="carousel-caption">
                  <h5>Heading</h5>
                </div>
              </div>
              <div class="item">
                <img src="/static/user/fighternew_31601.png" alt="...">
                <div class="carousel-caption">
                  <h5>Heading</h5>
                </div>
              </div>
              <div class="item">
                <img src="/static/user/fighternew_31601.png" alt="...">
                <div class="carousel-caption">
                  <h5>Heading</h5>
                </div>
              </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>




</div>

<!-- image banner
<img class="img-responsive" src="/static/user/side-1.png" width="auto;">
<img class="img-responsive" src="/static/user/side-2.png" width="auto;">
<img class="img-responsive" src="/static/user/side.jpg" width="auto;">
-->
</div>
