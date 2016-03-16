<?php
  print $thread_name;
  for ($i=1; $i <= $res_count; $i++) {
    print '<dt id="'.$i.'">'.$i.'．名前：<span class="name">'.$name_2ch[$i].'</span> '.$mail_2ch[$i].' 投稿日：'.$datetime_id_2ch[$i].'</dt>';
    print(PHP_EOL);
    print '<dd>';
    print $text_2ch[$i] .'</dd>';
    print(PHP_EOL);
  }
?>
