<div class="">
  <?php
  $n = 0;
  for($i = 0; $i< count($thread_title); $i++) :
    if($thread_num[$i] >= 100) :
  ?>
      <?=$this->Html->link($thread_title[$i],['controller' => 'Matome','action'=>'thread','thread_dat'=> $thread_dat[$i],'thread_name'=> $thread_title[$i]]) ?>
      <br>
      <?php
    endif;
  endfor;
  ?>
</div>
