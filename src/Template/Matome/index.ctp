<div class="">
  <?php
  // var_dump($thread_url);
  // var_dump($thread_title);
  // var_dump($thread_num);
  for($i = 1; $i<= count($ita_name); $i++) :
      // echo "<a href='$url'>" . $thread_title[$i] . '</a><br><br>';?>
      <?=$this->Html->link($ita_name[$i],['controller' => 'Matome','action'=>'ita','ita_name'=>$ita_name[$i],'ita_url'=> $ita_url[$i],'ita_dat'=>$ita_dat[$i]]) ?>
      <br>
      <?php
  endfor;
  ?>
</div>
