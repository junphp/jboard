<div class="col-md-9" style="margin-top:70px;">

<table class="table table-hover">
  <tr class="listtable">
    <td class="col-md-1">No</td>
    <td class="col-md-6">Title</td>
    <td class="col-md-2">UserName</td>
    <td class="col-md-1" style="text-align:center">Date</td>
    <td class="col-md-1" style="text-align:center">View</td>
    <td class="col-md-1" style="text-align:center">Like</td>
  </tr>



    <?php foreach($result as $entry){  ?>

    <tr class="active">
      <?php if($this->uri->segment(3) == $entry->id){?>
      <td class="col-md-1"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></td>
      <?php }else{ ?>
      <td class="col-md-1"><?=$entry->id ?></td>
      <?php }?>
      <td class="col-md-6"><a href="/<?= $table_name?>/get/<?=$entry->id?>/?page=<?php echo $page_index ?>"><?=$entry->title ?></a></td>
      <td class="col-md-2"><?=$entry->user_name ?></td>
      <td class="col-md-1" style="text-align:center"><?=date("m-d-Y",human_to_unix($entry->created)); ?></td>
      <td class="col-md-1" style="text-align:center"><?=$entry->view ?></td>
      <td class="col-md-1" style="text-align:center"><?=$entry->vote ?></td>

      </tr>
      <?php }?>


</table>

<nav class="text-center">

<?php echo $pagination; ?>

</nav>

</div>
