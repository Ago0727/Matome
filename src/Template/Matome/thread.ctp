<?php
  print $thread_name;
  for ($i=1; $i <= $res_count; $i++) {
    print '<dt id="'.$i.'">'.$i.'．名前：<span class="name">'.$name_2ch[$i].'</span> '.$mail_2ch[$i].' 投稿日：'.$datetime_id_2ch[$i].'</dt>';
    print(PHP_EOL);
    print '<dd>';
    //画像の表示
    $text_line = explode("<br>",$text_2ch[$i]);
    $text_line = str_replace("<>","",$text_line);
    for($j = 0; $j<count($text_line); $j++){
      //画像のリンクを表示
      $mach_count_img = preg_match_all('/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/',$text_line[$j],$maches_img);
      if($mach_count_img > 0){
        $img_url = $maches_img[0][0];
        $replacement = "<a href= '{$img_url}' target='_blank' ><img src='{$img_url}' style = 'width: 20%;'></a><br>";
        echo $replacement;
      }
      //urlのリンク表示
      $mach_count_url = preg_match_all('/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/',$text_line[$j],$maches_url);
      if($mach_count_url > 0){
        $url = $maches_url[0][0];
        $replacement = "<a href = '{$url}' target ='_blank'>" . $url . "</a><br>";
        $text_line[$j] = preg_replace('/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/',$replacement,$text_line[$j]);
      }
      //レスの返信に文章タグを作る
      $mach_count_res = preg_match_all('/&gt;&gt;[0-9]{1,4}/',$text_line[$j],$mach_res);
      if($mach_count_res > 0){
        $res = $mach_res[0][0];
        $replacement = "<p class='res'>" . $res . "</p>";
        $text_line[$j] = preg_replace('/&gt;&gt;[0-9]{1,4}/',$replacement,$text_line[$j]);
      }
      //echo "<p class = 'writing'>" . $text_line[$j] . "</p><br>";
      echo $text_line[$j] .  "<br>";

    }
  }
?>
