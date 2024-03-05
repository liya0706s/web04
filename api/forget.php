<?php
include_once "db.php";
// 根據郵件來取得使用者資料
$user=$User->find(['email'=>$_GET['email']]);

if(empty($user)){
    echo "查無此資料";
}else{
    echo "您的密碼為:".$user['pw'];
}

?>