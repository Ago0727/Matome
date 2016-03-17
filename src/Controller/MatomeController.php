<?php
  namespace App\Controller;
  use App\Controller\AppController;
  use Cake\ORM\TableRegistry;


  class MatomeController extends AppController{
    //板一覧を処理してビューに渡す
    public function index(){
      $tableTitles = TableRegistry::get('SubjectUrl');
      $query = $tableTitles->find();
      $i =0;
      foreach ($query as $row) {
        $i++;
        $ita_name[$i] = $row->subject_name;
        $ita_url[$i] = $row->subject_url;
        $ita_dat[$i] = $row->dat_data;
      }
      $this->set('ita_name',$ita_name);
      $this->set('ita_url',$ita_url);
      $this->set('ita_dat',$ita_dat);
    }
    //板のスレッドを取得してビューに渡す
    public function ita(){
      $name=htmlspecialchars($this->request->query['ita_name'],ENT_QUOTES);//取得する板名
      $url=htmlspecialchars($this->request->query['ita_url'],ENT_QUOTES);//板のURL
      $thread_dat = $this->request->query['ita_dat'];
      $i = 0;
      //txtファイルを開ける
      $thread_list=@fopen($url,'r');
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

             $thread_url[$i] = $thread_dat . $thread_id[$i]. ".dat";
             //  print "スレURL : <a href='$thred_url[$i]'>" . $thread_id[$i] . '</a><br>
  		       //  レス数：'.$num[$i].'<br>
  		       //  スレ名：'.$thread_name[$i].'<br><br>';
             $this->set('thread_dat',$thread_url);
             $this->set('thread_title',$thread_name);
             $this->set('thread_num',$num);
             $i++;
	        }
       }
       //ファイルを閉める
       fclose($thread_list);
    }
    //スレッドを処理してビューに渡す
    public function thread(){
      $dat = htmlspecialchars($this->request->query['thread_dat'],ENT_QUOTES);
      $dat_match = $this->request->query['thread_dat'];
      $thread_name = htmlspecialchars($this->request->query['thread_name'],ENT_QUOTES);
      if(isset($dat) && strpos($dat,".dat") == true){
        $html=@file_get_contents($dat);//DATファイル取得
        if($html == true){
          $html=mb_convert_encoding($html,'utf8','sjis-win');//UTFに変換

          //余計な文字を削除
          $html=str_replace('<b>','',$html);//余計な</b><b>が入っている場合があるので、一つずつ削除
          $html=str_replace('</b>','',$html);
          $html=preg_replace('@<a(?:>| [^>]*?>)(.*?)</a>@s','$1',$html);//アンカーのリンクは邪魔なので外す。@はデリミタ

          //各要素をばらす
          preg_match_all('/(.*?)\n/u',$html,$lines);//行ごとになっている各レスを独立
          $i=1;
          foreach($lines[0] as $line){
             preg_match_all('/(.*?)<>/u',$line,$elements);//名前、日時、ID、書き込みを各要素別にバラす
              $res_2ch=array($elements[0]);//foreachの中にforeachを入れたら、なぜか文字化けするので多次元配列に
              $name_2ch[$i]=str_replace('<>','',$res_2ch[0][0]);//名前
              $mail_2ch[$i]=str_replace('<>','',$res_2ch[0][1]);//メルアド
              $datetime_id_2ch[$i]=str_replace('<>','',$res_2ch[0][2]);//日時
              $text_2ch[$i]=str_replace(' <>','',$res_2ch[0][3]);//本文
              $this->set('res_count',$i);
              $this->set('name_2ch',$name_2ch);
              $this->set('mail_2ch',$mail_2ch);
              $this->set('datetime_id_2ch',$datetime_id_2ch);
              $this->set('text_2ch',$text_2ch);
              // print '<dt id="'.$i.'">'.$i.'．名前：<span class="name">'.$name_2ch.'</span> '.$mail_2ch.' 投稿日：'.$datetime_id_2ch.'</dt>';
              // print(PHP_EOL);
              // print '<dd>';

              $res=preg_replace('/^ */','$1',$text_2ch);//行頭の半角スペースを削除
              $text=preg_replace('/ <br> /','<br />',$res);//半角スペース付き<br>を半角スペースなしの<br />に変換

              // print $text.'</dd>';
              // print(PHP_EOL);
              $i++;
            }
            $this->set('thread_name',$thread_name);

        }else {
          echo 'datファイルが読み込めません';
        }
      }else {
        var_dump($dat);
        var_dump($dat_match);
      }
    }
  }

?>
