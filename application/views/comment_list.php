<div style="margin-top:30px;margin-bottom:30px"></div>

  <div class="col-md-9" style="margin-bottom:50px;">
    <table class="table">
      <tr>
        <td class="col-md-2">Author</td>
        <td class="col-md-2">Date</td>
      </tr>
<?php foreach($comment_result as $entry){ ?>
      <tr class="active">
        <td class="col-md-1"><?= $entry->user_name ?></td>
        <td class="col-md-2"><?= $entry->article ?></td>
      </tr>
      <?php } ?>
    </table>
</div>

<div style="margin-top:30px;margin-bottom:30px"></div>
<form action="/index.php/jboard/comment" method="post">
  <textarea class="form-control" rows="3"></textarea>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
