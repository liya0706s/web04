<?php
include_once "db.php";

// 找到要按讚的那一筆
$news=$News->find($_POST['news']);

// 執行good()函式，有POST傳值的news和使用者紀錄的帳號，按讚紀錄表執行刪除
if($Log->count(['news'=>$_POST['news'], 'acc'=>$_SESSION['user']])>0){
    $Log->del(['news'=>$_POST['news'], 'acc'=>$_SESSION['user']]);
    // 新聞文章資料表新聞欄減一
    $news['good']--;
}else{
    $Log->save(['news'=>$_POST['news'], 'acc'=>$_SESSION['user']]);
    $news['good']++;
}
$News->save($news);
?>