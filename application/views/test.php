<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
<button class="btn" name="like" name="button" placeholder="like">like</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$(document).on("ready",function(){
  loadData();
});

var loadData=function(){
  $.ajax({
          type:'post',
          url:"http://localhost/index.php/vote/test",
        }).done(function(data){
            console.log(data);

        });
  }




</script>
</body>
</html>
