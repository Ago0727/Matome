
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php
    echo $this->Html->css("test.css");
    ?>
  </head>
  <body>
    <header>
      <p>2chまとめ風</p>
    </header>
    <div id = "wrap" class="container-fluid text-center">
      <div id="nav" class="col-sm-2 hidden-xs col-sm-offset-1" >
      </div>
      <div id = "thread" class="col-sm-6">
        <?php
          print "<h1>" . $thread_name . "</h1>";
          $text_decolate = array('text-muted','text-information','text-warning','text-danger');
          for ($i=1; $i <= $res_count; $i++) {
            $rand = rand(0,3);
            $text = $text_decolate[$rand];
            ?>
            <div class="text-left">
            <?php
            print '<h4 id="'.$i.'">'.$i.'．<span class="text-success"> 名前：'.$name_2ch[$i].'</span> '.$mail_2ch[$i].' 投稿日：'.$datetime_id_2ch[$i].'</h4>';
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
                $replacement = "<a class='text-center img-rounded' href= '{$img_url}' target='_blank' ><img src='{$img_url}' style = 'width: 50%;'></a><br>";
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
                $replacement = "<p class='text-primary'>" . $res . "</p>";
                $text_line[$j] = preg_replace('/&gt;&gt;[0-9]{1,4}/',$replacement,$text_line[$j]);
              }
              echo "<p class = '$text'>" . $text_line[$j] . "</p><br>";
              // echo $text_line[$j] .  "<br>";

            }
          }
        ?>
        </div>
      </div>
      <div class="col-sm-2">
      </div>
    </div>
  </body>
</html>
