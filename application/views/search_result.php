<div class="container" style="margin-top:70px;">
<div class="row">
<div><h3>Search Keyword :<?= $keyword?></h3></div>
<div><span style="font-size:20px"><?= $search_total?> results found</span></div>
<table class="table table-hover" style="margin-top:30px">
  <tr>
    <td class="col-md-1">No</td>
    <td class="col-md-6">Title</td>
    <td class="col-md-2">Author</td>
    <td class="col-md-1" style="text-align:center">Date</td>
    <td class="col-md-1" style="text-align:center">View</td>
    <td class="col-md-1" style="text-align:center">like</td>
  </tr>

  <?php if($search_result >0 ){

     foreach($search_result as $entry){ ?>

            <tr class="active">
              <td class="col-md-1"><?=$entry->id ?></td>
              <td class="col-md-6"><a href="/index.php/jboard/get/<?=$entry->id?>"><?= substr($entry->title,0,100) ?></a>  &nbsp;[<?= $entry->tcomment ?>]</td>
              <td class="col-md-2"><?=$entry->user_name ?></td>
              <td class="col-md-2" style="text-align:center"><?= date("m-d-Y",human_to_unix($entry->created)); ?></td>
              <td class="col-md-1" style="text-align:center"><?=$entry->view ?></td>
              <td class="col-md-1" style="text-align:center"><?=$entry->vote ?></td>
            </tr>
    <?php } ?>
</table>
<?php }else{ ?>
        <tr>
            <td class="col-md-12"colspan="12" style="text-align:center">There is no result, please try again.</td>
        </tr>
<?php } ?>
</div>
</div>
