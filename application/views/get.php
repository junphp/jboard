<div class="col-md-9 panel panel-default" style="margin-bottom:50px;">

<h3 style="font-weight:bold;"><?=$single_result->title?></h3>
<div style="width:100%;clear:both;display: inline-block;">
<div class="left">
<span class="fa fa-reddit-alien arti-info" ><span class="arti-icons"><?=$single_result->user_name?></span></span>|
<span class="fa fa-calendar arti-info" ><span class="arti-icons"><?=$single_result->created?></span></span>|
<span class="fa fa-search arti-info" ><span class="arti-icons"><?=$single_result->view ?></span></span>|
<span class="fa fa-commenting-o arti-info" ><span class="arti-icons"><?=$single_result->tcomment ?></span></span>|
</div>
<div class="right">
<?php
    if($this->uri->segment(3) > 1 && $this->uri->segment(3) < $last->id){
?>
<a href="/<?php echo $this->uri->segment(1);?>/get/<?php echo $next->id?>/?page=<?php echo $page_index ?>" class="btn btn-info" ><i class="fa fa-angle-left"></i></a>
<a href="/<?php echo $this->uri->segment(1);?>/get/<?php echo $pre->id?>/?page=<?php echo $page_index ?>" class="btn btn-info" ><i class="fa fa-angle-right"></i></a>
<?php
}elseif($this->uri->segment(3) > $last->id){
?>
<a href="/<?php echo $this->uri->segment(1);?>/get/<?php echo $pre->id?>/?page=<?php echo $page_index ?>" class="btn btn-info" ><i class="fa fa-angle-right"></i></a>
<?php
}elseif($next === 0 && $this->uri->segment(3) == 1){
?>

<?php
}elseif($this->uri->segment(3) == $last->id){
?>
<a href="/<?php echo $this->uri->segment(1);?>/get/<?php echo $pre->id?>/?page=<?php echo $page_index ?>" class="btn btn-info" ><i class="fa fa-angle-right"></i></a>
<?php
}elseif($this->uri->segment(3) == 1){
?>
<a href="/<?php echo $this->uri->segment(1);?>/get/<?php echo $next->id?>/?page=<?php echo $page_index ?>" class="btn btn-info" ><i class="fa fa-angle-left"></i></a>
<?php
}
 ?>
</div>
</div>
<hr style="margin-bottom:20px;border-color:#4d90fe;margin-top:0px;margin-bottom:10px;">
<div id="me">

  <?=$single_result->description?>

</div>


    <div class="row" style="margin-top:50px;margin-bottom:-50px;" >
        <div style="text-align:center;color:red;margin-bottom:30px;" id="loading"></div>
        <div style="text-align:center;color:red;margin-bottom:30px;" id="already-like"></div>
    </div>

    <div class="row" style="margin-top:70px;margin-bottom:70px;text-align:center;" >

      <div class="col-xs-6 " style="text-align:right;display: inline-block;"><button class="btn btn-circle btn-xl btn-primary voteme" id="like" type="button" name="like"><span  id="like_count"><i class="fa fa-smile-o"></i><?=$single_result->vote?></span></button></div>

      <div class="col-xs-6 " style="text-align:left;display: inline-block;" ><button class="btn btn-default btn-circle btn-xl voteme" id="dislike" type="button" name="unlike"><span id="dlike_count"><i class="fa fa-meh-o"></i><?=$single_result->dis_vote?></span></button></div>

    </div>

    <hr class="hrstyle" style="margin-top:70px;margin-bottom:20px;">
      <div class="com">
          <div class="left" ><span style="color:#ff6600;font-size:24px"><?= $total_comment ?></span> Comments</div>
          <div class="right">
            <?php
              if($single_result->user_id === $this->session->userdata('id')){
            ?>

                  <a href="/<?= $this->uri->segment(1);?>/write" class="btn btn-info" ><i class="glyphicon glyphicon-pencil"></i> <strong>Write</strong></a>
                  <a href="/<?= $this->uri->segment(1);?>/update/<?= $this->uri->segment(3); ?>" class="btn btn-info" ><i class="glyphicon glyphicon-edit"></i> <strong>Edit</strong></a>
                  <a class="btn btn-info" data-toggle="modal" data-target="#deleteModal"><i class="glyphicon glyphicon-trash"></i> <strong>Delete</strong></a>
                  <a href="/<?= $this->uri->segment(1);?>/index/<?php echo $page_index ?>" class="btn btn-info" ><i class="glyphicon glyphicon-list"></i> <strong>List</strong></a>

            <?php
          } elseif($this->session->userdata('is_login')) {
            ?>

                  <a href="/<?= $this->uri->segment(1); ?>/write" class="btn btn-info" ><i class="glyphicon glyphicon-pencil"></i> <strong>Write</strong></a>
                  <input type="hidden" name="refer_from" value="<?= current_url(); ?>" />
                  <a href="/<?= $this->uri->segment(1); ?>/index/<?php echo $page_index ?>" class="btn btn-info" ><i class="glyphicon glyphicon-list"></i> <strong>List</strong></a>
                  <a href="<?= $this->uri->uri_string(); ?>" class="btn btn-info" ><i class="glyphicon glyphicon-refresh"></i> <strong>Refresh</strong></a>

            <?php
          }else{
            ?>
            <a href="/<?= $this->uri->segment(1) ?>/index/<?php echo $page_index ?>" class="btn btn-info" ><i class="glyphicon glyphicon-list"></i> <strong>List</strong></a>
            <a href="<?= $this->uri->uri_string(); ?>" class="btn btn-info" ><i class="glyphicon glyphicon-refresh"></i> <strong>Refresh</strong></a>
          <?php
          }
          ?>
          </div>
      </div>
    <div id="update">
    <?php foreach($comment_result as $entry){ ?>

          <div class="comment_box">
            <div>
              <span class="comment_auth"><?= $entry->user_name ?></span>
              <span class="comment_date"><?= $entry->created ?></span>
            </div>
              <div class="comment_body"><?= $entry->article ?></div>

              <form id="reply_box" action="<?= base_url()?>jboard/child_comment/<?= $entry->id ?>/<?=$single_result->id?>"method="post" style="display:none;margin-top:20px;">
                <textarea class="form-control" id="reply_article" name="reply_article" rows="3" wrap="hard"></textarea>
                <button id="reply_submit" type="submit" value="submit reply" class="btn btn-default" style="margin-top:10px;margin-bottom:20px">Submit</button>
              </form>
          </div>
      <?php } ?>
    </div>
      <div id="comment_box" style="display:none;"></div>

        <?php
          if($this->session->userdata('is_login')){
        ?>

        <div style="margin-top:30px;margin-bottom:30px"></div>
            <form id="comment_form" method="post">
                <textarea class="form-control" id="comment_article" name="comment_article" rows="3" wrap="hard" placeholder="leave comment here!"></textarea>
                <button id="comment_submit" type="submit" onclick="check_form" value="submit comment" class="btn btn-default" style="margin-top:10px;margin-bottom:20px">Submit</button>
            </form>

        <?php
      }else{
        ?>
        <textarea class="form-control" id="comment_article" name="comment_article" rows="3" wrap="hard" placeholder="Please Login to leave comment"></textarea>
        <div style="margin-top:30px;margin-bottom:30px"></div>
        <?php
        }
        ?>
</div>


<!-- Modal -->
  <div class="modal dfade" id="deleteModal" role="dialog" data-easein="expandIn" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">>
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm!</h4>
        </div>
        <div class="modal-body">
          <p style="text-align:center;">Are you sure?</p>
        </div>
        <div class="modal-footer">
          <form action="/<?php echo $this->uri->segment(1);?>/delete/<?=$single_result->id?>" method="post">
          <button type="submit"  class="btn btn-warning" id="delete">Delete</button>
          <button type="button" class="btn" value="cancel">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
