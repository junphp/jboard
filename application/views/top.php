<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Wallog - all the joy in the world. </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/ico">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!--font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
//comment add ajax
  $(document).ready(function(){
      var form = $('#comment_form');
      var submit =$('#comment_submit');
      var comment_article = $("#comment_article").val();
      form.on('submit',function(e){
          //prevent default action
          e.preventDefault();
          //send ajax requert
          //$('.comment-block').html('');

          $.ajax({
              url:'<?php echo base_url()?><?php echo $this->uri->segment(1);?>/insert_comment/<?php echo $this->uri->segment(3)?>',
              dataType:'json',
              type:'POST',
              cache: false,

              data: form.serialize(),


                success: function(data){
                  if (data =='failed'){
                    alert('please enter comment')
                  }else{

                    $('div#update').append('<div class="comment_box">'+'<span class="comment_auth">'+data['user_name']+'</span>'+'<span class="comment_date">'+data['created']+'</span>'+'<div class="comment_body">'+data['article']+'</div>'+'</div>').fadeIn('slow');
                    //$('div#update li:last').fadeIn('slow').addClass('comment_auth');

                    //var item = $(data).hide().fadeIn(200);
                    //$('.comment_box').append(item);
                    //$(data).hide().insertBefore('#comment-test-box').slideDown();
                    //$('#body').val('');
                    //$('#comment_box').append(data.user_name).addClass('comment_auth');
                    //$('#comment_box').append(data.article).addClass('comment_body');
                    //$('#comment_box').fadeIn('slow');

                    form.trigger('reset'); // reset form
                    //$this.closest('div[id^=comment-block]').append(data)
                    //var item = $(data.article).hide().fadeIn(800);
                    //$('.comment-block').append(item);
                    //console.log(data);
                    //alert(data.article);

                      }
                    }

                });
            });
        });

//page scroll  up
$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#scroll').fadeIn();
        } else {
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 700);
        return false;
    });
});

// voting system
$(document).ready(function(){
      $('.voteme').click(function(){
        var vote_status = this.id;
      $('#already-like').html('<img src="http://localhost/img/ajax-loader.gif">');

      $.ajax({
                type:'post',
                url:'<?php echo base_url()?><?php echo $this->uri->segment(1);?>/up_vote/<?php echo $this->uri->segment(3,0);?>',
                cache:false,
                dataType:'json',
                data:{'votetype':vote_status},

                success: function(data){

                      if(data==1){
                            var newValue = parseInt($('#'+vote_status+'_count').text())+1;
                            $('#'+vote_status+'_count').html(newValue);
                            $('#dislike').attr('disabled','disabled');
                      }
                      else if(data==-1){

                            $('#already-like').html('Already voted!');

                      }else if(data='false'){
                        alert('Please log in to continue');
                        //window.location.replace('<?php echo base_url()?>/auth/login');
                        $('#login-modal').modal('show');
                        }
                        setTimeout(function(){
                            $('#already-like').fadeOut(1200);
                        });

                }
          });
      });
});
//modal size
$(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');

        // Dividing by two centers the modal exactly, but dividing by three
        // or four works better for larger screens.
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
});

// modal log in
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
//$("img[src*='data:image']").addClass("img-responsive");
//$("img").addClass("img-responsive");

//add class auto imag class
$(document).ready(function(){
  $('img').each(function(){
      $('img').addClass('img-responsive');
  });
});

//image max size
$(document).ready(function(){
  $('#me img').each(function(){
    var maxwidth = 900;
    var maxheight = 200;
    var width = $(this).width();
    var height =$(this).height();

    if(width > maxwidth){
      $(this).css('width',maxwidth);

    }
  });
});


//login1 ajax function
$(document).ready(function(){
    var form = $('#login-form');
    var submit =$('#modalresult');

    form.on('submit',function(e){
        //prevent default action
        e.preventDefault();
        $('#formload').html('<img src="/img/form-loader.gif" class="lodingani">');
        //send ajax requert
        //$('.comment-block').html('');

        $.ajax({
            url:'<?= base_url() ?>auth/authentication?returnURL=<?=current_url()?>',
            dataType:'json',
            type:'POST',
            cache: false,

            data: form.serialize(),


              success: function(data){

                if (data == 0){
                  $('#error_message').html('Looks like these are not your correct details. Please try again.');
                  $('#login_email').focus();
                  formloading();
                }else{
                  	url = data['redirect'];
                    window.location = data['redirect'];
                    formloading();
                }
                  }

              });
          });
      });

//login and register change without page refresh
      $(function() {

          $('#login-form-link').click(function(e) {
      		$("#login-form").delay('slow').fadeIn('slow');
       		$("#register-form").fadeOut('slow');
      		$('#register-form-link').removeClass('active');
      		$(this).addClass('active');
      		e.preventDefault();
      	});
      	$('#register-form-link').click(function(e) {
      		$("#register-form").delay('slow').fadeIn('slow');
       		$("#login-form").fadeOut('slow');
      		$('#login-form-link').removeClass('active');
      		$(this).addClass('active');
      		e.preventDefault();
      	});

      });


      $(function() {

          $('#login-form-link-r').click(function(e) {
      		$("#login-form-r").delay('slow').fadeIn('slow');
       		$("#register-form-r").fadeOut('slow');
      		$('#register-form-link-r').removeClass('active');
      		$(this).addClass('active');
      		e.preventDefault();
      	});
      	$('#register-form-link-r').click(function(e) {
      		$("#register-form-r").delay('slow').fadeIn('slow');
       		$("#login-form-r").fadeOut('slow');
      		$('#login-form-link-r').removeClass('active');
      		$(this).addClass('active');
      		e.preventDefault();
      	});

      });
//register1 ajax
     $(document).ready(function(){
          var form = $('#register-form');
          var submit =$('#register-submit');

          form.on('submit',function(e){
              //prevent default action
              e.preventDefault();
              $('#formload').html('<img src="/img/form-loader.gif" class="lodingani">');
              //send ajax requert
              //$('.comment-block').html('');

              $.ajax({
                  url:'<?php base_url() ?>auth/register',
                  dataType:'json',
                  type:'POST',
                  cache: false,

                  data: form.serialize(),


                    success: function(data){
                      if (data['result'] ==0){
                        //error: function(){alert('Error');}
                        $('#rnerror').html(data['username']);
                        $('#reerror').html(data['email']);
                        $('#rperror').html(data['password']);
                        $('#rrperror').html(data['re_password']);
                        formloading();
                      }else{
                        alert('you have successfully registered!');
                        window.location = '/';
                        formloading();

                      }
                        }

                    });
                });
            });

            //login2 ajax function
            $(document).ready(function(){
                var form = $('#login-form-r');
                var submit =$('#modalresult-r');

                form.on('submit',function(e){
                    //prevent default action
                    e.preventDefault();
                    $('#formload').html('<img src="/img/form-loader.gif" class="lodingani">');
                    //send ajax requert
                    //$('.comment-block').html('');

                    $.ajax({
                        url:'<?=base_url() ?>auth/authentication?returnURL=<?=current_url()?>',
                        dataType:'json',
                        type:'POST',
                        cache: false,

                        data: form.serialize(),


                          success: function(data){
                            if (data ==0){
                              $('#error_message-r').html('Looks like these are not your correct details. Please try again.');
                              $('#login_email').focus();
                              formloading();
                            }else{
                              	url = data['redirect'];
                                window.location = data['redirect'];
                                formloading();
                            }
                              }

                          });
                      });
                  });

                  //register2 ajax
                       $(document).ready(function(){
                            var form = $('#register-form-r');
                            var submit =$('#register-submit-r');

                            form.on('submit',function(e){
                                //prevent default action
                                e.preventDefault();
                                $('#formload').html('<img src="/img/form-loader.gif" class="lodingani">');
                                //send ajax requert
                                //$('.comment-block').html('');

                                $.ajax({
                                    url:'<?php base_url() ?>auth/register',
                                    dataType:'json',
                                    type:'POST',
                                    cache: false,

                                    data: form.serialize(),


                                      success: function(data){
                                        if (data['result'] ==0){
                                          //error: function(){alert('Error');}
                                          $('#rnerror-r').html(data['username']);
                                          $('#reerror-r').html(data['email']);
                                          $('#rperror-r').html(data['password']);
                                          $('#rrperror-r').html(data['re_password']);
                                          formloading();
                                        }else{
                                          alert('you have successfully registered!');
                                          window.location = '/';
                                          formloading();

                                        }
                                          }

                                      });
                                  });
                              });

            $( document ).ready(function() {
                $(".tile").height($("#tile1").width());
                $(".carousel").height($("#tile1").width());
                 $(".item").height($("#tile1").width());

                $(window).resize(function() {
                if(this.resizeTO) clearTimeout(this.resizeTO);
            	this.resizeTO = setTimeout(function() {
            		$(this).trigger('resizeEnd');
            	}, 10);
                });

                $(window).bind('resizeEnd', function() {
                	$(".tile").height($("#tile1").width());
                    $(".carousel").height($("#tile1").width());
                    $(".item").height($("#tile1").width());
                });

            });

//contact form
            $(document).ready(function(){
              var form = $('#contact_form');
              var submit =$('#contact_submit');

              form.on('submit',function(e){
                  //prevent default action
                  e.preventDefault();
                  //send ajax requert
                  //$('.comment-block').html('');
                  $('#submit_ani').html('<img src="http://localhost/img/ajax-loader.gif">');
                  $.ajax({
                      url:'<?=base_url() ?>jboard/send_mail',
                      dataType:'json',
                      type:'POST',
                      cache: false,

                      data: form.serialize(),


                        success: function(data){
                          if (data['result'] == 0){

                            //error: function(){alert('Error');}
                            $('#contact_n').html(data['name']);
                            $('#contact_e').html(data['email']);
                            $('#contact_s').html(data['subject']);
                            $('#contact_m').html(data['message']);
                            $('#submit_ani').addClass('hidden');
                          }else if(data ==1){
                            formSuccess();



                          }else{
                            alert('sending mail failed, please try again!!');
                          }

                        }
                          });
                      });
                  });

                  function formSuccess(){
                    $( "#msgSubmit" ).removeClass( "hidden" ).fadeIn('slow');
                    $('#submit_ani').addClass('hidden');
                  }

                  function formloading(){
                    $('#formload').addClass( "hidden" ).fadeIn('slow');
                  }


                  $(function(){
                    $(".dropdown").hover(
                      function() {
                                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                                $(this).toggleClass('open');
                                $('b', this).toggleClass("caret caret-up");
                            },
                            function() {
                                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                                $(this).toggleClass('open');
                                $('b', this).toggleClass("caret caret-up");
                            });
                    });



</script>

  </head>
  <body>
    <a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;"><span></span></a>
