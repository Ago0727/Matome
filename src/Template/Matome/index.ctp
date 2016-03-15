<div class="">
  <?php
  // var_dump($thread_url);
  // var_dump($thread_title);
  // var_dump($thread_num);
  for($i = 0; $i< count($thread_url); $i++) :
    if($thread_num[$i] >= 100) :
      $url = $thread_url[$i];
      $thread_detail[$i] = $thread_url[$i];
      // echo "<a href='$url'>" . $thread_title[$i] . '</a><br><br>';?>
      <?=$this->Html->link($thread_title[$i],['controller' => 'Matome','action'=>'thread','val'=> $thread_detail[$i]]) ?>
      <br>
      <?php
    endif;
  endfor;
  ?>
</div>
