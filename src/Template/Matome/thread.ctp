<?php
  print $thread_name;
  for ($i=1; $i <= $res_count; $i++) {
    print '<dt id="'.$i.'">'.$i.'．名前：<span class="name">'.$name_2ch[$i].'</span> '.$mail_2ch[$i].' 投稿日：'.$datetime_id_2ch[$i].'</dt>';
    print(PHP_EOL);
    print '<dd>';
    print $text_2ch[$i] .'</dd>';
    $mach_count = preg_match_all('/(ttps?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/',$text_2ch[$i],$maches);
    if($mach_count>0){
      for($n=0; $n < $mach_count; $n++){
        $img_url = $maches[0][$n];
        $replace = "<img src='h{$img_url}' style = 'width: 20%;'><br>";
        echo $replace;
      }
    }
    // $mach_count = preg_match_all('/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/',$text_2ch[$i],$maches);
    // if($mach_count > 0){
    //   //var_dump($maches);
    //   for($j=0; $j < $mach_count; $j++){
    //     $url = $maches[0][$j];
    //     $replace = "<a href='h{$url}'>". $url . "</a><br>";
    //     echo $replace;
    //
    //   }
    // }
    print(PHP_EOL);
  }
?>
