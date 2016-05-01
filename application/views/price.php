<?php
  $web_page_data = file_get_contents('http://www.pricetree.com/search.aspx?q=moto+x');
  echo 'below data is display for one website';
  echo '---------------------------------------------------'."<br/>";

  $item_list = explode('<div class="items-wrap">' , $web_page_data);

  //print_r($item_list);

  //avoid array[0] and loop for 4 items-wrap
  for($i=1; $i<5; $i++){

    //echo $item_list[$i];
    //it is printing 4items

    $url_link1= explode('href="', $item_list[$i]);
    $url_link2= explode('"', $url_link1[1]);
    //echo $url_link2[0]."</br>";

    $image_link1= explode('data-original="', $item_list[$i]);
    $image_link2= explode('"', $image_link1[1]);
    //echo $image_link2[0]."</br>";

    $title1 = explode('title="',$item_list[$i]);
    $title2 = explode('"', $title1[1]);

    $avaliavle1 = explode('avail-stores">', $item_list[$i]);
    $avaliable = explode('</div>', $avaliavle1[1]);
    if(strcmp($avaliable[0],"not available") == 0){

        continue;

    }

    $item_title = $title2[0];
    $item_like = $url_link2[0];
    $item_image_link = $image_link2[0];
    $item_id1 = explode("-",$item_like);
    $item_id =end($item_id1);
      echo $item_title."</br>";
      echo $item_like."</br>";
      echo $item_image_link."</br>";
      echo $item_id."</br>";

  }






?>


<?php
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://www.sitepoint.com');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
  $data = curl_exec($ch);
  file_put_contents("text.txt", $data);
  curl_close($ch);
?>
