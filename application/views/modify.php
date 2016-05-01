<div class="col-md-9 panel panel-default" style="margin-bottom:50px;">
<form action='/<?php echo $this->uri->segment(1);?>/updatepost/<?php echo $this->uri->segment(3);?>' method='post' class="form-group" enctype="multipart/form-data">

<div class="form-group">
<input type="text" style="display:none" name="id" placeholder="Id" value="<?= $single_result->id ?>" class="input-block-level form-control" />
</div>
<div class="form-group">
  <label for="inputTitle">Title</label>
  <input type="text" name="title" placeholder="Title" value="<?=$single_result->title?>" class="input-block-level form-control" />
</div>
<div class="form-group">
  <label for="inputDescription">Description</label>
  <textarea name="description" placeholder="Description" class="input-block-level form-control" rows="15"/><?= $single_result->description ?></textarea>
</div>
  <button class="btn btn-large btn-primary" type="submit" style="margin-top:30px;">Save</button>

</form>
<script src="/static/lib/ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.config.height='700px';
  CKEDITOR.replace('description',{
    'filebrowserUploadUrl':'/<?php echo $this->uri->segment(1);?>/upload_receive_from_ck'
  });
  $(document).ready(function() {
   CKEDITOR.config.removePlugins = 'about,maximize';
});

CKEDITOR.replace( 'editor', {
    plugins: 'wysiwygarea,toolbar,sourcearea,image,basicstyles',
    on: {
        instanceReady: function() {
            this.dataProcessor.htmlFilter.addRules( {
                elements: {
                    img: function( el ) {
                        // Add an attribute.
                        //if ( !el.attributes.alt )
                            //el.attributes.alt = 'An image';

                        // Add some class.
                        el.addClass( 'img-responsive' );
                    }
                }
            } );
        }
    }
} );
</script>
</div>
