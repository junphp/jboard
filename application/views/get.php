<div class="col-md-10" style="margin-bottom:50px;">
<article>
<h1><?=$single_result->title?></h1>
<hr/>
<div class="row-fluid">
<div class="span6"><?=$single_result->author?></div>
<div class="span6"><?=$single_result->created?></div>
</div>
<div>
  <?=$single_result->description?>
</div>
</article>

    <?php
      if($this->session->userdata('is_login')){
    ?>
        <div style="margin-top:30px;">
          <a href="/index.php/jboard/add" class="btn btn-info" >Write</a>
          <a href="/index.php/jboard/update/<?=$single_result->id?>" class="btn btn-info" >Modify</a>
          <a href="/index.php/jboard/delete/<?=$single_result->id?>" class="btn btn-info" >Delete</a>
          <a href="/index.php/jboard" class="btn btn-info" >Back to List</a>
        </div>
    <?php
    } else {
    ?>
        <div style="margin-top:30px;">
          <a href="/index.php/jboard" class="btn btn-info" >Back to List</a>
        </div>
    <?php
    }
    ?>
</div>
