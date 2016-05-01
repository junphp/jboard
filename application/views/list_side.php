<div class="col-md-3" style="margin-bottom:50px;">
  <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background-color:#4d90fe;color:#ffffff;"><?= ucfirst(strtolower($table_name)); ?> log Weekly Best
        <div class="shape">
          <div class="shape-text">BEST</div>
        </div>
    </div>

    <!-- List group -->
<?php foreach($side_bar as $entry){?>
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



    
</div>
