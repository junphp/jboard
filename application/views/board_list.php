<div class="container" style="margin-top:70px;">
<div class="row">
<p align="left" >Total : <?= $total ?></p>
<table class="table table-hover">
  <tr>
    <td class="col-md-1">No</td>
    <td class="col-md-7">Title</td>
    <td class="col-md-1">Author</td>
    <td class="col-md-2">Date</td>
    <td class="col-md-1">View</td>
  </tr>

  <? if ($result) : ?>

    <?php foreach ($result as $entry){ ?>

    <tr class="active">
      <td class="col-md-1"><?=$entry->id ?></td>
      <td class="col-md-7"><a href="/index.php/jboard/get/<?=$entry->id?>"><?=$entry->title ?></a></td>
      <td class="col-md-1"><?=$entry->author ?></td>
      <td class="col-md-2"><?=date($entry->created) ?></td>
      <td class="col-md-1" style="align:center"><?=$entry->view ?></td>
    </tr>
  <?php } ?>
</table>
<div class="pull-right" style="margin-top:30px;">
  <a href="/index.php/jboard/add" class="btn btn-primary btn-sm" >write</a>
</div>
<nav class="text-center">
<div>
<ul>
  <?= $page_link ?>
</ul>
</div>
</nav>
</div>
</div>
