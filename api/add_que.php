<?php
include_once "db.php";

// 1. 先判斷主題有無存在
// 2. 新增主題資料
// 3. 找到最大的id代表是 次選單變數
if(isset($_POST['subject'])){
    $Que->save(['text'=>$_POST['subject'],
                'subject_id'=>0,
                'vote'=>0]);

$subject_id=$Que->max('id');
}

// 1. 判斷(多個)次選單有無存在
// 2. 用foreach迴圈列出多個選項
// 3. 新增選項資料
if(isset($_POST['option'])){
    foreach($_POST['option'] as $option){
        $Que->save(['text'=>$option,
                    'subject_id'=>$subject_id,
                    'vote'=>0]);
    }
}

to("../back.php?do=que");




?>