
<form action='/index.php/jboard/updatepost' method='post' class="form-group" enctype="multipart/form-data">

<div class="form-group">
<input type="text" style="display:none" name="id" placeholder="Id" value="<?=$single_result->id?>" class="input-block-level form-control" />
</div>
<div class="form-group">
  <label for="inputTitle">Title</label>
  <input type="text" name="title" placeholder="Title" value="<?=$single_result->title?>" class="input-block-level form-control" />
</div>
<div class="form-group">
  <label for="inputDescription">Description</label>
  <textarea name="description" placeholder="Description" class="input-block-level form-control"/><?=$single_result->description?></textarea>
</div>
  <button class="btn btn-large btn-primary" type="submit" style="margin-top:30px;">Save</button>

</form>
<script src="/static/lib/ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description',{
    'filebrowserUploadUrl':'/index.php/jboard/upload_receive_from_ck'
  });
</script>
