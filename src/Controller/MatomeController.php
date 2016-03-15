<?php
  namespace App\Controller;
  use App\Controller\AppController;


  class MatomeController extends AppController{
    public function index(){
      $name='ニュー速＋';//取得する板名
      $url='http://hayabusa.open2ch.net/news4vip/';//板のURL
      $thread_suburl = 'http://hayabusa.open2ch.net/test/read.cgi/news4vip/';
      $thread=$url.'subject.txt';//スレ一覧txtのURL
      $i = 0;
      //txtファイルを開ける
      $thread_list=@fopen($thread,'r');
      if($thread_list){
	       while(!feof($thread_list)){//ファイルの最後まで読みに行く
		         $line=fgets($thread_list);//1行ずつ取得
		         $line=mb_convert_encoding($line,'utf8','sjis-win');//UTF-8に変換

		         //スレナンバーを取得
		         $thread_id_num=mb_strpos($line,'.dat<>');//.dat<>が何文字目か、0から数える
		         $thread_id[$i]=mb_substr($line,0,$thread_id_num);//0番目からスレナンバーの桁分抽出

		         //レス数を取得
		         $last=mb_strrpos($line,')')-1;//「)」が最後に現れる文字が何番目か
		         $first=mb_strrpos($line,' (')+1;//「 (」が最後に現れる文字が何番目か
		         $n=$last-$first;//レス数の桁
		         $num[$i]=mb_substr($line,$first+1,$n);//スレナンバー抽出
             //スレ名を取得
  		       $name=$first-7-$thread_id_num;//スレ名の文字数、7は「.dat<>」の文字数と0番目の1文字
  		       $thread_name[$i]=mb_substr($line,$thread_id_num+6,$name);//6は「.dat<>」の文字数

             $thread_url[$i] = $thread_suburl . $thread_id[$i];
             //  print "スレURL : <a href='$thred_url[$i]'>" . $thread_id[$i] . '</a><br>
  		       //  レス数：'.$num[$i].'<br>
  		       //  スレ名：'.$thread_name[$i].'<br><br>';
             $this->set('thread_url',$thread_url);
             $this->set('thread_title',$thread_name);
             $this->set('thread_num',$num);
             $i++;
	        }
       }
       //ファイルを閉める
       fclose($thread_list);
    }
    public function thread(){
      $this->autoRender = false;
      if(isset($this->request->query['val'])){
        $page = $this->request->query['val'];
        var_dump($page);
        //http://hayabusa.open2ch.net/news4vip/dat/1458061198.dat datファイルで読み込む
      }
    }
  }

?>
