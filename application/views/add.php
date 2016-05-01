<div class="col-md-9" style="margin-bottom:50px;">

<form action='/<?php echo $this->uri->segment(1)?>/add/' method='post' class="form-group" style="padding:20px">
  <?php echo validation_errors(); ?>
<div class="form-group">
  <label for="inputTitle">Title</label>
  <input type="text" name="title" placeholder="Title" class="input-block-level form-control" />
</div>
<div class="form-group">
  <label for="inputDescription" style="display:inline-block">Content</label><div class="pull-right" style="color:red;display:inline-block">Max upload file size 2MB( 2048 KB )</div>
  <textarea name="description" placeholder="Description" class="input-block-level form-control" id="body_box"></textarea>
</div>

  <button class="btn btn-large btn-primary" type="submit" style="margin-top:30px;">Save</button>
</form>

</div>
<script src="/static/lib/ckeditor/ckeditor.js"></script>
<script>

  CKEDITOR.replace('description',{
    'filebrowserUploadUrl':'/jboard/upload_receive_from_ck'
  });

  $(document).ready(function() {
   CKEDITOR.config.removePlugins = 'about,maximize,cut';
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
