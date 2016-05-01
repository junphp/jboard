<div class="col-md-9">
<p><span class="tti"><?= ucfirst(strtolower($table_name)); ?></span> <span class="logtitle">log</span></p>

<table class="table table-hover">
  <tr class="listtable">
    <td class="col-md-1">No</td>
    <td class="col-md-6">Title</td>
    <td class="col-md-2">UserName</td>
    <td class="col-md-1" style="text-align:center">Date</td>
    <td class="col-md-1" style="text-align:center">View</td>
    <td class="col-md-1" style="text-align:center">like</td>
  </tr>



    <?php foreach ($result as $entry){ ?>

    <tr class="active">
      <td class="col-md-1"><?=$entry->id ?></td>
      <td class="col-md-6"><a href="/<?= $table_name?>/get/<?=$entry->id?>/?page=<?=$this->uri->segment(3);?>"><?= character_limiter($entry->title,60) ?></a>  &nbsp;<span style="color:#ff6600"><?= $entry->tcomment ?></span> &nbsp;<?php if($today == date("m-d-Y",human_to_unix($entry->created))){echo '<span style="font-size:50%;vertical-align: middle;" class="label label-danger">N</span>';}?></td>
      <td class="col-md-2"><?=$entry->user_name ?></td>
      <td class="col-md-1" style="text-align:center"><?= date("m-d-Y",human_to_unix($entry->created)); ?></td>
      <td class="col-md-1" style="text-align:center"><?=$entry->view ?></td>
      <td class="col-md-1" style="text-align:center"><?=$entry->vote ?></td>
      <td class="col-md-1 hidden" style="text-align:center"><div><input name="pagenn"><?php echo $this->uri->segment(3);?></div></td>
    </tr>
  <?php } ?>
</table>
<?php if($this->session->userdata('is_login')){ ?>
<div class="pull-right" style="clear:both">
  <a href="/<?= $this->uri->segment(1); ?>/write/" class="btn btn-info btn-sm" >write</a>
</div>
<?php
}
?>

<nav class="text-center">

  <?php echo $page_link; ?>

</nav>
<div class="row" style="margin:30px"></div>
</div>
