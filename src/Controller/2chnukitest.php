<?php
//板のスレッドをすべて取得し、スレッド数を取得
//取得したいレス以上の範囲
$range = 100;
$this->autoRender = false;
$url = "http://hayabusa.open2ch.net/news4vip/";
$sledUrl = "http://hayabusa.open2ch.net/test/read.cgi/news4vip/";
$subject = "subject.txt";
$urlSubject = $url . $subject;
$getsled = mb_convert_encoding(file_get_contents($urlSubject),"utf-8","auto");
$sledres = explode("<>",$getsled);
$sledkeys = array();
//スレッドを取得
var_dump($sledres);
$i = 0;
//配列のキー番号(0~)とid.datタイトルを格納している　
foreach($sledres as $key => $val)
{
  $i ++;
  if(preg_match("/[0-9]{10}.dat/",$val,$matches))
  {
    if(preg_match("/\([0-9]{1,4}\)/",$val,$sledcounts)){
        $count = str_replace("(","",$sledcounts[0]);
        $count = str_replace(")","",$count);
        $count = intval($count);
        //指定したレス数以上のスレッドを取得
        if ($count >= $range){
          // $sledTitle[$i] =  substr($sledres[$key],0,-14);
          // $sledkey[$i] = $urlKeys;
          // $sledcount[$i] = $count;
          $keys = $matches[0];
          $urlKeys = $sledUrl . $keys;
          $urlKeys = str_replace(".dat","/",$urlKeys);
          $sledkeys[$i] = array(
            // "filekey" => $keys,
            //後ろのidを削除
            "url" => $urlKeys . substr($sledres[$key],0,-14),
          );
        }

    }
  }
}
$this->set('sled', $sledkeys);

?>
