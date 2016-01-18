<div class="container" style="margin-top:70px;">
<div class="row">
<table class="table table-hover">
  <tr>
    <td class="col-md-1">No</td>
    <td class="col-md-7">Title</td>
    <td class="col-md-1">Author</td>
    <td class="col-md-2">Date</td>
    <td class="col-md-1">View</td>
  </tr>

  <? if ($result) : ?>

    <?php
    foreach($result as $entry){  ?>

    <tr class="active">
      <td class="col-md-1"><?=$entry->id ?></td>
      <td class="col-md-7"><a href="/index.php/jboard/get/<?=$entry->id?>"><?=$entry->title ?></a></td>
      <td class="col-md-1"><?=$entry->author ?></td>
      <td class="col-md-2"><?=date($entry->created) ?></td>
      <td class="col-md-1" style="align:center"><?=$entry->view ?></td>
    </tr>
  <?php
  }
   ?>
</table>

<nav class="text-center">
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>
</div>
